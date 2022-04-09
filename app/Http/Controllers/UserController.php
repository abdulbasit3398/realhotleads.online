<?php

namespace App\Http\Controllers;

use App\Event;
use App\Package;
use App\PackageTag;
use Excel;
use Auth;
use Mail;
use Google\Service\TagManager\Tag;
use Illuminate\Support\Facades\Storage;
use Stripe;
use App\User;
use SoapClient;
use App\UserData;
use App\UserWallet;
use App\AdditionalNote;
use App\UserContact;
use App\UserInventory;
use App\UserBankDetail;
use Mailgun\Mailgun;
use App\ContactGenerator;
use App\UserClockStatus;
use App\UserPackageDetail;
use App\UserListCleanRecord;
use App\UserPhoneNumber;
use App\UserTaskManagement;
use App\CustomPackageRequest;
use App\TaskManagementMember;
use App\Imports\ListCleanImport;
use App\Imports\UserContactsImport;
use App\Exports\ListCleanExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserContactNotification;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Twilio\Rest\Client as TClient;
use SignalWire\Rest\Client as SClient;
use function foo\func;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth',['except','index']);
  }
  public function test_api()
  {
    $client = new Client();
    $result = $client->request('POST','https://api.sandbox.transferwise.tech/v2/quotes', [
      'headers' => [
        'Authorization' => 'Bearer 3570f922-8e5d-4ebd-80fb-c47e0ead0386',
        'Accept' => 'application/json',
        'Content-Type'  => 'application/json',
      ],
      'form_params' => [
        'profile'     => 16241504,
        'sourceCurrency' => 'GBP',
        'targetCurrency' => 'GBP',
        // 'targetAmount' => 105
        'sourceAmount' => 100
      ]
    ]);
    $response_data = (string) $result->getBody();
    $json = json_decode($response_data);
    dd($json);
  }
  public function index(Request $request)
  { 
      if($request->ajax()) {
          $data = Event::where('user_id',auth()->id())->whereDate('start', '>=', $request->start)
              ->whereDate('end',   '<=', $request->end)

              ->get(['id', 'title', 'start', 'end']);

          return response()->json($data);

      }

    $data['contacts'] = UserContact::where('user_id',Auth::id())->get();
    $user_data = UserData::where('user_id', Auth::user()->id)->first();
    $table_data = array();
    $column_count = 0;
    $row_count = 0;

    if($user_data != null){
      $table_data = json_decode($user_data->data);
      $column_count = $user_data->column_count;
      $row_count = isset($table_data->field1) ? sizeof($table_data->field1) : 0;
      // $row_count = 0;
    }

    $data['task_management'] = UserTaskManagement::where('user_id',Auth::id())->get();
    // dd((array)$table_data);
    $data['table_data'] = (array)$table_data;
    // $target_url = 'https://ecm.signalwire.com/api/laml/2010-04-01/Accounts/8ce390f9-1f15-46ce-b97c-c87985a93a03/Messages.json';
    // $post = array (
    //  'To' => '+19293747445',
    //  'From' => '+14075569943',
    //  'Body' => 'Test Message'
    // );
    // $auth = 'OGNlMzkwZjktMWYxNS00NmNlLWI5N2MtYzg3OTg1YTkzYTAzOlBUYjZmZjIwMDVhMjZkZGY1YjBmMmY3NDI5MmVmMWFmN2FjY2I5MzVjZDlkNmM2MTRl';
    // $headers = array(
    //     'Content-Type: application/x-www-form-urlencoded',
    //     'Authorization: Basic '.$auth
    // );
    // $ch = curl_init();
    // curl_setopt($ch,CURLOPT_URL, $target_url);
    // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // curl_setopt($ch,CURLOPT_POST, 1);
    // curl_setopt($ch,CURLOPT_HEADER, 1);
    // curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
    // curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0(compatible;)");
    // curl_setopt($ch,CURLOPT_HTTPHEADER,$headers);
    // curl_setopt($ch,CURLOPT_FRESH_CONNECT, 1);
    // curl_setopt($ch, CURLOPT_FORBID_REUSE, 1);
    // curl_setopt($ch,CURLOPT_TIMEOUT,100);
    // curl_setopt($ch, CURLOPT_POSTFIELDS,'To=%2B19293747445&From=%2B14075569943&Body=hi%20i%20am%20Ronnie');
    // $result = curl_exec ($ch); if ($result === FALSE) {
    // echo "Error sending" . $fname . " " . curl_error($ch);
    // curl_close ($ch);
    // }else{
    //  curl_close ($ch);
    // echo "Result: " . $result;
    // }
    // dd('sd');
    $data['user_clock'] = UserClockStatus::where('user_id',Auth::id())->orderBy('id','DESC')->get();
    $data['latest_user_clock'] = UserClockStatus::where('user_id',Auth::id())->orderBy('id','DESC')->first();

    if(Auth::user()->type == 'admin')
      return redirect()->route('admin.dashboard');
    elseif(Auth::user()->type == 'staff')
      return redirect()->route('staff.dashboard');

    $users = User::where('referrer_id',Auth::id())->get();
    $notes = AdditionalNote::where('user_id',Auth::id())->first();

//      $drive_files = cache()->remember('google_files', now()->addDay(), function () {
//          return Storage::disk('google')->allFiles();
//      });



    // $drive_files = Storage::disk('google')->allFiles();
    // $directories = Storage::disk('google')->allDirectories();

    $drive_files = array();
    $directories = array();
    return view('user.dashboard',compact('users','notes','data', 'column_count', 'row_count','drive_files','directories'));
  }


    public function calender(Request $request)
    {

        switch ($request->type) {
            case 'add':
                $event = Event::create([
                    'user_id' => auth()->id(),
                    'title' => $request->title,
                    'color' => $request->start,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'update':
                $event = Event::find($request->id)->update([
                    'title' => $request->title,
                    'color' => $request->start,
                    'start' => $request->start,
                    'end' => $request->end,
                ]);

                return response()->json($event);
                break;

            case 'delete':
                $event = Event::find($request->id)->delete();
                return response()->json($event);
                break;

            default:
                break;
        }
    }

  public function saveData(Request $request){

    // dd(sizeof($request->heading));
    $get_user_data = UserData::where('user_id', Auth::user()->id)->first();
    if($get_user_data != null)
    {
      $get_user_data->data = json_encode($request->except(['_token']));
      $get_user_data->column_count = sizeof($request->heading);
      $get_user_data->update();
        // dd($get_user_data);
    } else {
      $user_data = new UserData();
      $user_data->user_id = Auth::user()->id;
      $user_data->column_count = sizeof($request->heading);
      $user_data->data = json_encode($request->except(['_token']));
      $user_data->save();
      // dd($user_data);
    }

    // dd("done");
    // dd(json_decode($user_data)->data);

    return redirect()->back();
  }
  public function contact_generator()
  {
    $GOOGLE_RECAPTCHA_KEY = $this->admin_setting('GOOGLE_RECAPTCHA_KEY');
    $contacts = ContactGenerator::where('user_id',Auth::id())->orderBy('id','DESC')->get();
    return view('user.contact_generator',compact('contacts','GOOGLE_RECAPTCHA_KEY'));
  }
  public function search_contact(Request $request)
  {
    $this->validate($request,[
      'area_code' => 'required',
      'g-recaptcha-response' => 'required|recaptcha'
    ]);

    $contact = new ContactGenerator;
    $contact->user_id = Auth::id();
    $contact->search_key = $request->area_code;
    $contact->key_word = $request->key_word;
    $contact->mobile_b2b = isset($request->mobile_b2b) ? json_encode($request->mobile_b2b) : '';
    $contact->save();

    return redirect()->back()->with('success','Your request submited successfully.');
  }
  public function pricing()
  {
      $tags = PackageTag::where('id',1)->get();
//      $packages = Package::where('package_tag_id',1)->get();
      return view('user.pricing-funnel',compact('tags'));
      // return view('user.pricing',compact('tags'));
  }
  public function contact_price_pay(Request $request)
  {
    $this->validate($request,[
      'package_id' => 'required'
    ]);

    $contact = ContactGenerator::where([['id',$request->package_id],['user_id',Auth::id()]])->firstOrFail();
    if($contact->status == 1 && $contact->downloadable == 0 && $contact->price != 0)
    {
      Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      $stripe = Stripe\Charge::create ([
        "amount" => $contact->price * 100,
        "currency" => "usd",
        "source" => $request->stripeToken,
        "description" => "Payment for contacts"
      ]);

      if($stripe->id && $stripe->status == 'succeeded')
      {
        $contact->downloadable = 1;
        $contact->save();

        $package_detail = new UserPackageDetail;
        $package_detail->user_id = Auth::id();
        $package_detail->payment_id = $stripe->id;
        $package_detail->payment_for = 'contacts';
        $package_detail->product_id = $request->package_id;
        $package_detail->package_price = $contact->price;
        $package_detail->save();

        return redirect()->back()->with('success','You can access file now.');
      }

    }

    return redirect()->back();
  }
  public function subscribe_package(Request $request)
  {

    $this->validate($request,[
      'package_id' => 'required',
      'g-recaptcha-response' => 'required|recaptcha'
    ]);

    $total_contacts = 0;

    if($request->package_id == 'unlimited_contacts' && $request->time == 'month'){
      $product['product_name'][] = 'contacts';
      $product['quantity'][] = -1;
      $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));
      $package_price = 300;

    }
    elseif($request->package_id == 'unlimited_contacts' && $request->time == 'year'){
      $product['product_name'][] = 'contacts';
      $product['quantity'][] = -1;
      $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));
      $package_price = 3000;
    }
    elseif($request->package_id == 'unlimited_communication' && $request->time == 'month'){
      $this->buy_phone_number();
      $product['product_name'][] = 'sms_mms';
      $product['quantity'][] = -1;
      $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));

      $product['product_name'][] = 'phone_calls';
      $product['quantity'][] = -1;
      $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));

      $product['product_name'][] = 'emails';
      $product['quantity'][] = -1;
      $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));

      $package_price = 300;
    }
    elseif($request->package_id == 'unlimited_communication' && $request->time == 'year'){
      $this->buy_phone_number();
      $product['product_name'][] = 'sms_mms';
      $product['quantity'][] = -1;
      $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));

      $product['product_name'][] = 'phone_calls';
      $product['quantity'][] = -1;
      $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));

      $product['product_name'][] = 'emails';
      $product['quantity'][] = -1;
      $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));

      $package_price = 3000;
    }
    elseif($request->package_id == 'unlimited_both' && $request->time == 'month'){
      $this->buy_phone_number();
      $product['product_name'][] = 'contacts';
      $product['quantity'][] = -1;
      $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));

      $product['product_name'][] = 'sms_mms';
      $product['quantity'][] = -1;
      $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));

      $product['product_name'][] = 'phone_calls';
      $product['quantity'][] = -1;
      $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));

      $product['product_name'][] = 'emails';
      $product['quantity'][] = -1;
      $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));

      $package_price = 407;
    }
    elseif($request->package_id == 'unlimited_both' && $request->time == 'year'){
      $this->buy_phone_number();
      $product['product_name'][] = 'contacts';
      $product['quantity'][] = -1;
      $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));

      $product['product_name'][] = 'sms_mms';
      $product['quantity'][] = -1;
      $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));

      $product['product_name'][] = 'phone_calls';
      $product['quantity'][] = -1;
      $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));

      $product['product_name'][] = 'emails';
      $product['quantity'][] = -1;
      $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));

      $package_price = 3168;
    }
    elseif($request->package_id == 'biz_opp_leads')
    {
      if($request->time == '30')
      {
        $product['product_name'][] = 'leads';
        $product['quantity'][] = 30;
        $product['validity'][] = -1;
        $package_price = 100;
      }
      elseif($request->time == '130')
      {
        $product['product_name'][] = 'leads';
        $product['quantity'][] = 130;
        $product['validity'][] = -1;
        $package_price = 300;
      }
    }
    elseif($request->package_id == 'biz_opp_prospects')
    {
      if($request->time == '15')
      {
        $product['product_name'][] = 'prospects';
        $product['quantity'][] = 15;
        $product['validity'][] = -1;
        $package_price = 220;
      }
      elseif($request->time == '50')
      {
        $product['product_name'][] = 'prospects';
        $product['quantity'][] = 50;
        $product['validity'][] = -1;
        $package_price = 730;
      }
      elseif($request->time == '100')
      {
        $product['product_name'][] = 'prospects';
        $product['quantity'][] = 100;
        $product['validity'][] = -1;
        $package_price = 1400;
      }
    }
    elseif($request->package_id == '20 usd package')
    {
      $product['product_name'][] = 'sms_mms';
      $product['quantity'][] = 1500;
      $product['validity'][] = -1;

      $product['product_name'][] = 'phone_calls';
      $product['quantity'][] = 1500;
      $product['validity'][] = -1;

      $product['product_name'][] = 'emails';
      $product['quantity'][] = 1500;
      $product['validity'][] = -1;

      $package_price = 20;
    }
    elseif($request->package_id == 'custom_biz_opp_leads'){
      $custom = new CustomPackageRequest;
      $custom->user_id = Auth::id();
      $custom->package_name = 'Custom Biz Opp Leads';
      $custom->answer = $request->package_notes;
      $custom->save();

      return redirect()->back()->with('success','Your request submited.');

    }
    elseif($request->package_id == 'custom_prospects'){
      $custom = new CustomPackageRequest;
      $custom->user_id = Auth::id();
      $custom->package_name = 'Custom Prospects';
      $custom->answer = $request->package_notes;
      $custom->save();

      return redirect()->back()->with('success','Your request submited.');
    }
    else
      return redirect()->back();

    $total_price = $payment_done = $deduct_from_wallet = 0;

    if($request->use_wallet == 1 && \Auth::user()->user_wallet)
    {
      $wallet = \Auth::user()->user_wallet->withdrawable_funds + \Auth::user()->user_wallet->non_withdrawable_funds;
      if($wallet >= $package_price)
      {
        $total_price = 0;
        $deduct_from_wallet = $package_price;
      }
      else
      {
        $total_price = $package_price - $wallet;
        $deduct_from_wallet = $wallet;
      }

    }
    else
      $total_price = $package_price;

    if($total_price > 0)
    {
      //Stripe accept minimum 0.5$
      if($total_price < 0.5)
        $total_price = 0.5;

      Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
      $stripe = Stripe\Charge::create([
        "amount" => $total_price * 100,
        "currency" => "usd",
        "source" => $request->stripeToken,
        "description" => "Payment for package in ACG"
      ]);

      if($stripe->id && $stripe->status == 'succeeded'){
        $payment_done = 1;
        $payment_id = $stripe->id;
      }
      else
        return redirect()->back();
    }
    else{
      $payment_done = 1;
      $payment_id = 'wallet';
    }


    if($payment_done == 1)
    {

      $package_detail = new UserPackageDetail;
      $package_detail->user_id = Auth::id();
      $package_detail->payment_id = $payment_id;
      $package_detail->package_name = $request->package_id;
      $package_detail->package_price = $package_price;
      $package_detail->package_start_date = date('Y-m-d H:i:s');
      $package_detail->package_end_date = date('Y-m-d H:i:s');
      $package_detail->total_contacts = $total_contacts;
      $package_detail->save();

      foreach($product['product_name'] as $key => $value) {
        // $prev_inv = UserInventory::where([['user_id',Auth::id()],['product_name',$product['product_name'][$key]]])->first();
        // if($prev_inv)
        // {
        //   $prev_inv->product_name = $product['product_name'][$key];
        // }
        // else
        // {
        $inventory = new UserInventory;
        $inventory->user_id = Auth::id();
        $inventory->product_name = $product['product_name'][$key];
        $inventory->quantity = $product['quantity'][$key];
        $inventory->validity = $product['validity'][$key];
        $inventory->save();
        // }


      }
      $phone_number =
      $user = User::find(Auth::id());
      $user->payment_id = $payment_id;
      // $user->current_package = $package_detail->id;
      // $user->package_validation = date('Y-m-d H:i:s');
      // $user->total_contacts += $total_contacts;
      // $user->remaining_contacts += $total_contacts;
      $user->save();

      $this->deduct_from_wallet($deduct_from_wallet);

      return redirect()->back()->with('success','Your order completed.');
    }

    return redirect()->back();
  }

  public function under_construction()
  {
    $message = 'This page is under construction.';
    return view('user.under_construction',compact('message'));
  }

  public function user_profile()
  {
    return view('user.user_profile');
  }
  public function edit_user_profile(Request $request)
  {
    $user = User::find(Auth::id());
    if(isset($request->new_password))
    {
      $user->password = Hash::make($request->new_password);
      $user->save();
      return redirect()->back()->with('success','Your password changed.');
    }
    elseif(isset($request->profile_image) && $request->hasFile('profile_image'))
    {
      $image = $request->file('profile_image');
      $name = time().'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/assets/images/users');
      $imagePath = $destinationPath. "/". $name;
      $image->move($destinationPath, $name);

      $user->profile_image = $name;
      $user->save();
      return redirect()->back()->with('success','Your Profile image changed.');
    }
    elseif(isset($request->affiliate))
    {
      $user->affiliate_account = 1;
      $user->save();
      return redirect()->back()->with('success','Account status changed.');
    }
    elseif(isset($request->first_name) || isset($request->last_name) || isset($request->company_name))
    {
      $user->first_name = $request->first_name;
      $user->last_name = $request->last_name;
      $user->company_name = $request->company_name;
      $user->save();
      return redirect()->back()->with('success','Information updated.');
    }
    elseif(isset($request->bank_details))
    {
      unset($request['_token']);
      unset($request['bank_details']);
      foreach($request->all() as $key => $requ)
      {
        $prev = UserBankDetail::where([['user_id',Auth::id()],['attr_name',$key]])->first();
        if($prev)
        {
          $prev->attr_value = $requ;
          $prev->save();
        }
        else
        {
          $new = new UserBankDetail;
          $new->user_id = Auth::id();
          $new->attr_name = $key;
          $new->attr_value = $requ;
          $new->save();
        }
      }

      return redirect()->back()->with('success','Account information updated.');
    }


  }

  public function save_additional_notes(Request $request)
  {
    // $this->validate($request,[
    //   'additional_notes' => 'required'
    // ]);
    $prev_notes = AdditionalNote::where('user_id',Auth::id())->first();
    if($prev_notes)
    {
      $prev_notes->notes = $request->additional_notes;
      $prev_notes->save();
    }
    else
    {
      $notes = new AdditionalNote;
      $notes->user_id = Auth::id();
      $notes->notes = $request->additional_notes;
      $notes->save();
    }

    return redirect()->back();
  }

  public function user_contacts()
  {
    $contacts = UserContact::where('user_id',Auth::id())->get();
    return view('user.user_contacts',compact('contacts'));
  }
  public function save_user_contacts(Request $request)
  {
    $this->validate($request,[
      'contact_name' => 'required',
    ]);
    $prev_contact = UserContact::where([['user_id',Auth::id()],['contact_name',$request->contact_name]])->first();
    if($prev_contact)
      return redirect()->back()->with('success','Contact already exist.');

    $contact = new UserContact;
    $contact->user_id = Auth::id();
    $contact->contact_name = $request->contact_name;
    $contact->contact_email = $request->email;
    $contact->contact_phone = $request->phone_no;
    $contact->us_number_format = $this->us_number_format($request->phone_no);
    $contact->company_name = $request->company;
    $contact->notes = $request->note;

    if(isset($request->contact_file) && $request->hasFile('contact_file'))
    {
      $this->validate($request,[
        'contact_file' => 'max:10240|mimes:jpg,jpeg,bmp,png,mp3,mp4,mkv,txt,doc,docx,xlsx,xls'
      ]);
      $image = $request->file('contact_file');
      $name = time().'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/assets/images/users');
      $imagePath = $destinationPath. "/". $name;
      $image->move($destinationPath, $name);

      $contact->contact_avatar = $name;
    }
    $contact->save();

    return redirect()->back()->with('success','Contact saved successfully.');

  }
  public function show_user_contact($id)
  {
    $contact = UserContact::where([['id',$id],['user_id',Auth::id()]])->firstOrFail();
    return view('user.show_user_contact',compact('contact'));
  }
  public function edit_user_contact($id)
  {
    $contact = UserContact::where([['id',$id],['user_id',Auth::id()]])->firstOrFail();

    return view('user.edit_contacts',compact('contact'));
  }
  public function update_user_contact(Request $request)
  {
    $this->validate($request,[
      'contact_name' => 'required',
    ]);

    $contact = UserContact::where([['id',$request->contact_id],['user_id',Auth::id()]])->firstOrFail();
    $contact->contact_name = $request->contact_name;
    $contact->contact_email = $request->email;
    $contact->contact_phone = $request->phone_no;
    $contact->company_name = $request->company;
    $contact->notes = $request->note;

    if(isset($request->contact_file) && $request->hasFile('contact_file'))
    {

      $this->validate($request,[
        'contact_file' => 'max:10240|mimes:jpg,jpeg,bmp,png,mp3,mp4,mkv,txt,doc,docx,xlsx,xls'
      ]);
      if($contact->contact_avatar != 'avatar-1.png')
        // unlink(public_path('/assets/images/users/').$contact->contact_avatar);

      $image = $request->file('contact_file');
      $name = time().'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/assets/images/users');
      $imagePath = $destinationPath. "/". $name;
      $image->move($destinationPath, $name);

      $contact->contact_avatar = $name;
    }

    $contact->save();

    return redirect()->route('dashboard')->with('success','Contact updated');

  }
  public function delete_user_contacts($id)
  {
    $contact = UserContact::where([['user_id',Auth::id()],['id',$id]])->firstOrFail();
    if($contact->contact_avatar != 'avatar-1.png')
      unlink(public_path('/assets/images/users/').$contact->contact_avatar);

    $contact->delete();
    return redirect()->back()->with('success','Contact deleted successfully.');
  }
  public function deduct_from_wallet($amount)
  {
    $user_wallet = UserWallet::where('user_id',Auth::id())->first();

    if($user_wallet)
    {
      if($amount > $user_wallet->withdrawable_funds)
      {
        $user_wallet->non_withdrawable_funds = $user_wallet->non_withdrawable_funds - ($amount - $user_wallet->withdrawable_funds);
        $user_wallet->withdrawable_funds = 0;
      }
      else
      {
        $user_wallet->withdrawable_funds = $user_wallet->withdrawable_funds - $amount;
      }

      $user_wallet->save();
    }




  }
  


  public function save_time_track(Request $request)
  {
    $clock = new UserClockStatus;
    $clock->user_id = Auth::id();
    $clock->job_code = $request->job_code;
    $clock->clock_status = $request->clock;
    $clock->save();

  }

  public function save_job_management(Request $request)
  {
    $this->validate($request,[
      'contact_file' => 'max:10240|mimes:jpg,jpeg,bmp,png',
      'taskname' => 'required',
      'start_date' => 'required',
      'end_date' => 'required',
      'taskbudget' => 'required',
    ]);

    $task = new UserTaskManagement;
    $task->user_id = Auth::id();
    $task->task_name = $request->taskname;
    $task->task_description = $request->task_description;
    $task->start_date = $request->start_date;
    $task->end_date = $request->end_date;
    $task->budget = $request->taskbudget;
    $task->save();

    if(isset($request->team_member_name))
    {
      for($i = 0; $i < count($request->team_member_name); $i++)
      {

        $task_member = new TaskManagementMember;
        $task_member->task_management_id = $task->id;
        $task_member->team_member_name = $request->team_member_name[$i];

        if(isset($request->team_member_avatar[$i]))
        {
          $image = $request->team_member_avatar[$i];
          $destinationPath = public_path('/assets/images/users');
          $name = time().'.'.$image->getClientOriginalExtension();
          $imagePath = $destinationPath. "/". $name;
          $image->move($destinationPath, $name);

          $task_member->team_member_avatar = $name;

        }

        $task_member->save();
      }

    }

    return redirect()->back()->with('success','Project created successfully');
  }
  public function list_cleaner()
  {
    return view('user.list_cleaner');
  }
  public function check_list_cleaner(Request $request)
  {
    $this->validate($request,[
      'phone_number' => 'required'
    ]);
    $client = new SoapClient('https://ws.cdyne.com/phoneverify/phoneverify.asmx?wsdl');

    $param = array(
      'PhoneNumbers' => array($request->phone_number),
      'LicenseKey' => $this->admin_setting('CDYNE_LICENSE_KEY')
    );

    $result = $client->CheckPhoneNumbers($param);

    $data['valid'] = $result->CheckPhoneNumbersResult->PhoneReturn->Valid;
    $data['clean_number'] = $result->CheckPhoneNumbersResult->PhoneReturn->CleanNumber;

    return $data;
  }
  public function bulk_import_list_clean(Request $request)
  {
   $this->validate($request,[
    'contact_file' => 'required|max:50000|mimes:xlsx,csv,xls'
  ]);
   $number = array();

   $array = Excel::toArray(new ListCleanImport, request()->file('contact_file'));

   if(count($array[0]) > 999)
    return redirect()->back()->with('error','You can only upload 999 numbers in one file');

   for($i=1; $i < count($array[0]); $i++)
    if($array[0][$i][0] != null)
      $number[] = $array[0][$i][0];

    if(count($number) <= 0)
      return redirect()->back()->with('error','There is no data in file.');

    try{
      $client = new SoapClient('https://ws.cdyne.com/phoneverify/phoneverify.asmx?wsdl');
      $param = array(
        'PhoneNumbers' => $number,
        'LicenseKey' => $this->admin_setting('CDYNE_LICENSE_KEY')
      );

      $result = $client->CheckPhoneNumbers($param);
    }
    catch(\Exception $e)
    {
      dd($e);
      return redirect()->back()->with('error','There is error in connection. Please try again later.');
    }


    $valid_numbers = array();

    if(isset($result->CheckPhoneNumbersResult->PhoneReturn->Valid))
      $valid_numbers[] = $result->CheckPhoneNumbersResult->PhoneReturn->CleanNumber;
    else
    {
      for($i = 0; $i < count($result->CheckPhoneNumbersResult->PhoneReturn); $i++)
        if($result->CheckPhoneNumbersResult->PhoneReturn[$i]->Valid == true)
          $valid_numbers[] = $result->CheckPhoneNumbersResult->PhoneReturn[$i]->CleanNumber;
    }



    $image = $request->file('contact_file');
    $name = $image->getClientOriginalName();
    $destinationPath = public_path('/assets/user_list_clean');
    $imagePath = $destinationPath. "/".time().$name;
    $image->move($destinationPath, $name);

    $clean_name = 'cleaned '.$image->getClientOriginalName();

    $new_file = new UserListCleanRecord;
    $new_file->user_id = Auth::id();
    $new_file->orignal_file = $name;
    $new_file->clean_file = $clean_name;
    $new_file->no_of_contacts = count($number);
    $new_file->save();

    (new ListCleanExport($valid_numbers))->store(time().$clean_name);
    return (new ListCleanExport($valid_numbers))->download($clean_name);
 }

 public function ivr_rvm()
 {
   return view('user.ivr_rvm');
 }

  public function auto_responder()
  {
   return view('user.auto_responder');
  }

  public function email_marketing()
  {
   return view('user.email_marketing');
  }
  public function create_referal_user(Request $request)
  {
    $this->validate($request,[
      'email' => 'required|string|email|max:255|unique:users',
      'password' => 'required|min:8|string'
    ]);

    $user =  new User;
    $user->first_name =  ($request->first_name) ? $request->first_name : '';
    $user->last_name =  ($request->last_name) ? $request->last_name : '';
    $user->email =  $request->email;
    $user->password =  Hash::make($request->password);
    $user->referrer_id =  Auth::id();
    $user->save();

    return redirect()->back()->with('success','User created successfully.');
  }

  public function sales_outsourcing()
  {
    return view('user.sales_outsourcing');
  }

  public function buy_phone_number()
  {
    $phone_number = 0;

    $user_phone_num = UserPhoneNumber::where('user_id',Auth::id())->first();
    if($user_phone_num){
      $phone_number = $user_phone_num->phone_number;
      return $phone_number;
    }


    $project_id = config('signal_wire_api.signal_wire.project_id');
    $token      = config('signal_wire_api.signal_wire.token');
    $space_url  = config('signal_wire_api.signal_wire.space_url');
    $from       = config('signal_wire_api.signal_wire.from');
    $client     = new SClient($project_id, $token, array("signalwireSpaceUrl" => $space_url));

    $numbers = $client->availablePhoneNumbers('US')->local->read();

    for($i = 0; $i < count($numbers); $i++)
    {
      $incoming_phone_number = $client->incomingPhoneNumbers->
                                  create(
                                    array(
                                      "friendlyName" => Auth::user()->email,
                                      "phoneNumber" => $numbers[$i]->phoneNumber,
                                      "smsUrl" => route("get-communication-reply"),
                                    )
                                  );
      if(isset($incoming_phone_number->sid))
      {
        $new_user_phone_num = new UserPhoneNumber;
        $new_user_phone_num->user_id = Auth::id();
        $new_user_phone_num->phone_number = $numbers[$i]->phoneNumber;
        $new_user_phone_num->status = 1;
        $new_user_phone_num->save();

        $phone_number = $numbers[$i]->phoneNumber;
        return $phone_number;
      }
    }

  }

  public function contacts()
  {
    $data['contacts'] = UserContact::where('user_id',Auth::id())->get();
    return view('user.contacts',compact('data'));
  }

  public function import_contacts(Request $request)
  {
    $this->validate($request,[
      'import_excel' => 'required|max:10240|mimes:txt,doc,docx,xlsx,xls,csv'
    ]);

    Excel::import(new UserContactsImport, request()->file('import_excel'));

    return redirect()->back();
  }
  public function checkout()
  {
    $GOOGLE_RECAPTCHA_KEY = $this->admin_setting('GOOGLE_RECAPTCHA_KEY');
    $packages = session()->get('packages');
    return view('user.checkout',compact('GOOGLE_RECAPTCHA_KEY','packages'));
  }
}
