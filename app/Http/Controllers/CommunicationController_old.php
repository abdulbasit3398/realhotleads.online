<?php

namespace App\Http\Controllers;

use DB;
use Mail;
use Auth;
use Helper;
use App\AdminSetting;
use App\UserContact;
use App\UserSmsHistory;
use App\UserPhoneNumber;
use Illuminate\Http\Request;
 use Twilio\Rest\Client as TClient;
use Generator as Coroutine;
use SignalWire\Relay\Consumer;
use SignalWire\Rest\Client as SClient;

class CommunicationController extends Controller
{
  protected $number_len_US = 10;

  public function __construct()
  {
    $this->middleware('auth',['except' => 'get_communication_reply']);
  }

  public function communication_sms()
  {
    $data['history'] = array();

    if(isset($_GET['n']))
    {
      $num = '+1'.$this->us_number_format($_GET['n']);
      $data['history'] = UserSmsHistory::where([['user_id',Auth::id()],['type','sms'],['contact_phone_number',$num]])->orderBy('created_at','ASC')->get();

      $data['contact'] = UserContact::where([['user_id',Auth::id()],['us_number_format',$num]])->first();

      if($data['contact']){
        $data['contact_name'] = $data['contact']->contact_name;
        $data['contact_id'] = $data['contact']->id;
      }
      else{
        $data['contact_name'] = 'No Name';
        $data['contact_id'] = 'other';
      }

    }
    $user_number = Auth::user()->signal_wire_phone_number->phone_number;
    if($user_number)
    {

      $data['numbers'] = UserSmsHistory::where([['user_id',Auth::id()],['type','sms']])->groupBy('contact_phone_number')->orderBy('created_at','DESC')->get();
    }
    else
    {
      $data['numbers'] = array();
    }

    $data['contacts'] = UserContact::where([['user_id',Auth::id()],['contact_phone','!=','']])->get();

    return view('user.communication_sms',compact('data'));


  }
  public function new_send_communication_sms()
  {
    $data['contacts'] = UserContact::where([['user_id',Auth::id()],['contact_phone','!=','']])->get();
    return view('user.new_communication_sms',compact('data'));
  }
  public function send_communication_sms(Request $request)
  {
    $this->validate($request,[
      'user_type' => 'required',
      'message' => 'required'
    ]);

    if($request->user_type == 'To new number')
    {
      $this->validate($request,[
        'sms_recipient_number' => 'required',
      ]);
      $contact_arr = array();
      $number_arr = array();
      $numbers = explode(",",$request->sms_recipient_number);

      for($i=0;$i<count($numbers);$i++)
      {

        $contact = UserContact::where([['user_id',Auth::id()],['contact_phone','like','%'.$numbers[$i].'%']])->first();
        if($contact)
          $number = $contact->contact_phone;
        else
        {
          $number = $numbers[$i];

          $contact = new UserContact;
          $contact->user_id = Auth::id();
          $contact->contact_name = 'No name';
          $contact->contact_phone = $number;
          $contact->save();

        }

        $number = $this->us_number_format($number);
        if(strlen($number) == $this->number_len_US)
          $number_arr[] = '+1'.$number;

        $contact_arr = $contact->id;
      }
      // $number = $this->us_number_format($number);
      // if(strlen($number) != $this->number_len_US)
      //   return redirect()->back()->with('error','Number is not correct format.');

      // $number = '+1'.$number;


    }
    else
    {
      $this->validate($request,[
        'sms_recipient_contact' => 'required',
      ]);
      $number_arr = array();
      $contact_arr = array();

      $sms_recipient_contact = $request->sms_recipient_contact;

      for($i = 0; $i < count($sms_recipient_contact); $i++)
      {
        $contact = UserContact::where([['user_id',Auth::id()],['id',$sms_recipient_contact[$i]]])->first();

        // if(!$contact)
          // return redirect()->back()->with('error','No contact found.');

        $number = $this->us_number_format($contact->contact_phone);

        if(strlen($number) != $this->number_len_US)
          return redirect()->back()->with('error','Number is not correct format.');

        $number_arr[] = '+1'.$number;
        $contact_arr[] = $contact->id;

      }

    }

    $name = '';

    if(isset($request->file_mms) && $request->hasFile('file_mms'))
    {
      $this->validate($request,[
        'file_mms' => 'mimes:jpg,bmp,png,doc,docx,txt'
      ]);
      $image = $request->file('file_mms');
      $name = time().'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/assets/mms_files');
      $imagePath = $destinationPath. "/". $name;
      $image->move($destinationPath, $name);

    }

    for($i=0;$i< count($number_arr);$i++)
    {
      $id = $this->send_signalwire_sms($number_arr[$i],$request->message,$name);


      if($id != '0')
      {
        $history = new UserSmsHistory;
        $history->user_id = Auth::id();
        $history->contact_id = (isset($contact_arr)) ? $contact_arr[$i] : 0;
        $history->contact_phone_number = $number_arr[$i];
        $history->message_to = $number_arr[$i];
        $history->message_from = Auth::user()->signal_wire_phone_number->phone_number;
        $history->type = 'sms';
        $history->sid = $id;
        $history->message = $request->message;
        $history->media = $name;
        $history->save();

      }

    }
    return redirect()->back()->with('success','Message sent sussessfully.');

    // $id = $this->send_signalwire_sms($number,$request->message,$name);


    // if($id != '0')
    // {
    //   $history = new UserSmsHistory;
    //   $history->user_id = Auth::id();
    //   $history->contact_id = $contact->id;
    //   $history->contact_phone_number = $number;
    //   $history->message_to = $number;
    //   $history->message_from = Auth::user()->signal_wire_phone_number->phone_number;
    //   $history->type = 'sms';
    //   $history->sid = $id;
    //   $history->message = $request->message;
    //   $history->media = $name;
    //   $history->save();

    //   return redirect()->back()->with('success','Message sent sussessfully.');
    // }
    // else{
    //   return redirect()->back()->with('error','There is some error sending sms.');
    // }

  }

  public function send_signalwire_sms($recipient,$message,$media = '')
  {
    if($media != '')
      $media = asset('public/assets/mms_files/'.$media);

    $project_id = config('signal_wire_api.signal_wire.project_id');
    $token      = config('signal_wire_api.signal_wire.token');
    $space_url  = config('signal_wire_api.signal_wire.space_url');
    $from       = Auth::user()->signal_wire_phone_number->phone_number;
    if(!$from)
      return redirect()->back()->with('error','There is some error sending sms.');

    $client = new SClient($project_id, $token, array("signalwireSpaceUrl" => $space_url));

    try{
      if($media != '')
        $message = $client->messages->create($recipient,array("from" => $from, "body" => $message,"mediaUrl" => $media));

      else
        $message = $client->messages->create($recipient,array("from" => $from, "body" => $message));


      if($message)
        return $message->sid;
      else
        return 0;
    }
    catch(\Exception $e)
    {
      // return 0;
      dd($e->getMessage());
    }

  }

  public function send_twilio_sms($recipient,$message,$media = '')
  {
    if($media != '')
      $media = asset('public/assets/mms_files/'.$media);

    $TWILIO_ACCOUNT_SID = $this->admin_setting('TWILIO_ACCOUNT_SID');
    $TWILIO_AUTH_TOKEN = $this->admin_setting('TWILIO_AUTH_TOKEN');
    $TWILIO_NUMBER = $this->admin_setting('TWILIO_NUMBER');

    $twilio = new TClient($TWILIO_ACCOUNT_SID, $TWILIO_AUTH_TOKEN);
    try{
      if($media != '')
        $message = $twilio->messages->create($recipient, // to
                           [
                            "body" => $message,
                           "from" => $TWILIO_NUMBER,
                           "mediaUrl" => [$media],
                         ]);
      else
        $message = $twilio->messages->create($recipient, // to
                           [
                            "body" => $message,
                           "from" => $TWILIO_NUMBER,
                         ]);


      if($message)
        return $message->sid;
      else
        return 0;
    }
    catch(\Exception $e)
    {
      // return 0;
      dd($e->getMessage());
    }

  }



  public function communication_email()
  {
    $data['contacts'] = UserContact::where('user_id',Auth::id())->get();
    $data['history'] = UserSmsHistory::where([['user_id',Auth::id()],['type','email']])->orderBy('created_at','DESC')->get();
    return view('user.communication_email',compact('data'));
  }

  public function send_communication_email(Request $request)
  {
    $this->validate($request,[
      'sms_recipient_contact' => 'required',
      'mail_subject' => 'required',
      'message' => 'required'
    ]);


    if($request->sms_recipient_contact == 'other')
    {
      $this->validate($request,[
        'sms_recipient_email' => 'required',
      ]);

      $contact = UserContact::where([['user_id',Auth::id()],['contact_email','like','%'.$request->sms_recipient_email.'%']])->first();
      if($contact)
        $email = $contact->contact_email;
      else
      {
        $email = $request->sms_recipient_email;

        $contact = new UserContact;
        $contact->user_id = Auth::id();
        $contact->contact_name = 'No name';
        $contact->contact_email = $email;
        $contact->save();

      }


    }
    else
    {
      $contact = UserContact::where([['user_id',Auth::id()],['id',$request->sms_recipient_contact]])->first();
      if(!$contact)
        return redirect()->back()->with('error','No contact found.');

      $email = $contact->contact_email;

    }

    $data['subject'] = $request->mail_subject;
    $data['body'] = $request->message;

    Mail::send('mail.user_mail',['data' => $data], function($message) use ($email,$data)
    {
      $message->to($email, 'Admin')->subject($data['subject']);
    });

    $history = new UserSmsHistory;
    $history->user_id = Auth::id();
    $history->contact_id = $contact->id;
    $history->type = 'email';
    $history->subject = $data['subject'];
    $history->message = $data['body'];
    $history->save();

    return redirect()->back()->with('success','Mail sent sussessfully.');

  }

  public function communication_phone()
  {
    $data = [];
    return view('user.communication_phone',compact('data'));

  }




    public function send_communication_phone(Request $request)
    {
        $TWILIO_ACCOUNT_SID = $this->admin_setting('TWILIO_ACCOUNT_SID');
        $TWILIO_AUTH_TOKEN = $this->admin_setting('TWILIO_AUTH_TOKEN');
        $TWILIO_NUMBER = $this->admin_setting('TWILIO_NUMBER');



        $this->validate($request,[
            'phone_number' => 'required'
        ]);

        $twilio = new TClient($TWILIO_ACCOUNT_SID, $TWILIO_AUTH_TOKEN);
        // $twilio = $twilio->calls("AC6f5af7ae85d580716ee2d179e36ab84e")->fetch();
        // dd($twilio);

        $call = $twilio->account->calls->create(
            '+1'.$request->phone_number,
            $TWILIO_NUMBER,
            [
                "method" => "POST",
                "statusCallback" => route('get-phone-status-callback'),
                "statusCallbackEvent" => ["initiated",'ringing','completed',"answered"],
                "statusCallbackMethod" => "POST",
                "url" => "http://demo.twilio.com/docs/voice.xml"
            ]
        );


        if($call->sid)
        {
            $data['response'] = 1;
            $data['sid'] = $call->sid;
        }
        else
            $data['response'] = 0;


        return $data;
        // dd($twilio->httpClient->lastResponse);

    }



    public function hangup_communication_phone(Request $request)
  {

    $this->validate($request,[
      'call_sid' => 'required'
    ]);

    $TWILIO_ACCOUNT_SID = $this->admin_setting('TWILIO_ACCOUNT_SID');
    $TWILIO_AUTH_TOKEN = $this->admin_setting('TWILIO_AUTH_TOKEN');
    $TWILIO_NUMBER = $this->admin_setting('TWILIO_NUMBER');
    $twilio = new TClient($TWILIO_ACCOUNT_SID, $TWILIO_AUTH_TOKEN);

    $call_sid = $request->call_sid;

    $call = $twilio->calls($call_sid)
              ->update(["status" => "completed"]);

    if($call->sid)
    {
      $data['response'] = 1;
      $data['sid'] = $call->sid;
    }
    else
      $data['response'] = 0;

    return $data;

  }
  // public function get_phone_status_callback(Request $request)
  // {
  //   // $admin = new AdminSetting;
  //   // $admin->field_name = 'test';
  //   // $admin->field_value = $request->all();
  //   // $admin->save();

  //   DB::insert('insert into test (test_data) values (?)', [$request->all()]);

  //   // DB::table('test')->insert(
  //   //     array('test_data' => $request->all())
  //   // );
  //   info($request->all());

  // }
  public function get_conversation_history(Request $request)
  {
    $contact_id = $request->contact_id;
    $contact = UserContact::where([['id',$contact_id],['user_id',Auth::id()]])->first();
    if(!$contact)
      return 0;

    $sms_history = UserSmsHistory::where([['user_id',Auth::id()],['contact_id',$contact->id]])->get();

    return view('user.conversation_history',compact('sms_history'));
  }

  public function test_sms()
  {
    $sid = $this->admin_setting('TWILIO_ACCOUNT_SID');
    $token = $this->admin_setting('TWILIO_AUTH_TOKEN');
    $TWILIO_NUMBER = $this->admin_setting('TWILIO_NUMBER');

    $twilio = new TClient($sid, $token);

    $call = $twilio->calls
                   ->create("+923247763398", // to
                            $TWILIO_NUMBER, // from
                            ["url" => "http://demo.twilio.com/docs/voice.xml"]
                   );

    print($call->sid);
  }

  public function test_sms_signal()
  {


    // $client = new \SignalWire\Relay\Client([
    //   'project' => '8ce390f9-1f15-46ce-b97c-c87985a93a03',
    //   'token' => 'PTb6ff2005a26ddf5b0f2f74292ef1af7accb935cd9d6c614e'
    // ]);
    $project_id     = config('signal_wire_api.signal_wire.project_id');
    $token          = config('signal_wire_api.signal_wire.token');
    $space_url      = config('signal_wire_api.signal_wire.space_url');
    $client         = new Client($project_id, $token, array("signalwireSpaceUrl" => $space_url));

    // $client->connect();
    // dd($client->connect());
//     +1 (407) 556-9943
// +1 (234) 255-4579

    $params = [
    //   'context' => 'office',
      'from' => '+14075569943',
      'to' => '+12342554579',
      'body' => 'Welcome at SignalWire!'
    ];

// dd($client->messaging->send($params)->done());
    $msg = $client->messaging->send($params)->done(function($sendResult) {
        // dd($sendResult);
      if ($sendResult->isSuccessful()) {
        echo "Message ID: " . $sendResult->getMessageId();
      }
    });

    dd($msg);



    // $sid = $this->admin_setting('TWILIO_ACCOUNT_SID');
    // $token = $this->admin_setting('TWILIO_AUTH_TOKEN');
    // $TWILIO_NUMBER = $this->admin_setting('TWILIO_NUMBER');

    // $twilio = new TClient($sid, $token);

    // $call = $twilio->calls
    //                ->create("+923247763398", // to
    //                         $TWILIO_NUMBER, // from
    //                         ["url" => "http://demo.twilio.com/docs/voice.xml"]
    //                );

    // print($call->sid);
  }

  public function message458()
  {


    // $client = new \SignalWire\Relay\Client([
    //   'project' => '8ce390f9-1f15-46ce-b97c-c87985a93a03',
    //   'token' => 'PTb6ff2005a26ddf5b0f2f74292ef1af7accb935cd9d6c614e'
    // ]);

    $project_id     = config('signal_wire_api.signal_wire.project_id');
    $token          = config('signal_wire_api.signal_wire.token');
    $space_url      = config('signal_wire_api.signal_wire.space_url');
    $client         = new Client($project_id, $token, array("signalwireSpaceUrl" => $space_url));

    $from             = '+14075569943';
    $message        = $client->messages
                        // ->create("+".$request->to, // to
                        ->create("+923158899945", // to
                                array("from" => $from, "body" => 'Welcome at SignalWire!', 'context' => 'office')
                        );
// $this->createResource($message);
dd($message);
    $params = [
      'context' => 'office',
      'from' => '+14075569943',
      'to' => '+19293747445',
      'body' => 'Welcome at SignalWire!'
    ];


// dd($client->messaging->send($params)->done());
    // $msg = $client->messaging->send( $params)->done(function($sendResult) {
    //     // dd($sendResult);
    //   if ($sendResult->isSuccessful()) {
    //     echo "Message ID: " . $sendResult->getMessageId();
    //   }
    // });

    // dd($msg);/

 }

 public function createResource(Request $resource)
 {

    $resource = $request->resource;

    $fields = '{"expires_in":10000, "resource": '.$resource.'}';
    $headers = [
        'Content-Type: application/json'
    ];
    $project_id     = config('signal_wire_api.signal_wire.project_id');
    $token          = config('signal_wire_api.signal_wire.token');
    $space_url      = config('signal_wire_api.signal_wire.space_url');

    $url = 'https://'.$space_url.'/api/relay/rest/jwt';

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL,$url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "$project_id:$token");
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result);

    $data['jwt_token'] = $result->jwt_token;
    $data['project_id'] = $project_id;
    return $data;
  }

  public function search_phone_number()
  {
    $phone_number = 0;
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://ecm.signalwire.com/api/relay/rest/phone_numbers/search',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => array(
        'Authorization: Basic '.config('signal_wire_api.signal_wire.authorization')
      ),
    ));

    $response = curl_exec($curl);
    $response = json_decode($response);

    curl_close($curl);

    if($response->data[0])
      $phone_number = $response->data[0]->e164;

    return $phone_number;

  }

  public function get_communication_reply(Request $request)
  {
    DB::table('test')->insert(
        array('test_data' => $request->all())
    );
    $user_phone_number = UserPhoneNumber::where('phone_number',$request->To)->first();
    if(!$user_phone_number)
      $user_id = 0;
    else
      $user_id = $user_phone_number->user_id;

    $contact = UserContact::where([['user_id',$user_id],['us_number_format',$request->From]])->first();

    if(!$contact)
    {
      $contact = new UserContact;
      $contact->user_id = $user_id;
      $contact->contact_name = 'No name';
      $contact->contact_phone = $request->From;
      $contact->save();
    }
    else
      $contact_id = $contact->id;

    $sms_history = new UserSmsHistory;
    $sms_history->user_id = $user_id;
    $sms_history->contact_id = $contact_id;
    $sms_history->contact_phone_number = $request->From;
    $sms_history->message_to = $request->To;
    $sms_history->message_from = $request->From;
    $sms_history->type = 'sms';
    $sms_history->send_receive = 'receive';
    $sms_history->sid = $request->SmsSid;
    $sms_history->message = $request->Body;
    $sms_history->save();

  }


}
