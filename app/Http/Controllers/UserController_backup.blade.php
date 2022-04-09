<?php

namespace App\Http\Controllers;

use Auth;
use Stripe;
use App\User;
use App\UserClockStatus;
use App\UserWallet;
use App\AdditionalNote;
use App\UserContact;
use App\UserInventory;
use App\UserBankDetail;
use App\ContactGenerator;
use App\UserPackageDetail;
use App\CustomPackageRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Notifications\UserContactNotification;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Twilio\Rest\Client as TClient;

class UserController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
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
  public function index()
  {
    $contacts = UserContact::where('user_id',Auth::id())->get();
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

    if(Auth::user()->type == 'admin')
      return redirect()->route('admin.dashboard');
    elseif(Auth::user()->type == 'staff')
      return redirect()->route('staff.dashboard');

    $users = User::where('referrer_id',Auth::id())->get();
    $notes = AdditionalNote::where('user_id',Auth::id())->first();
    return view('user.dashboard',compact('users','notes','contacts'));
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
    return view('user.pricing');
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
      'package_id' => 'required'
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
  public function sales_funnels()
  {
    return view('user.sales_funnels');
  }

  public function test_sms()
  {
    $sid = getenv("TWILIO_ACCOUNT_SID");
    $token = getenv("TWILIO_AUTH_TOKEN");
    $twilio = new TClient($sid, $token);

    $call = $twilio->calls
                   ->create("+923247763398", // to
                            "+15415277223", // from
                            ["url" => "http://demo.twilio.com/docs/voice.xml"]
                   );

    print($call->sid);
  }
  public function save_time_track(Request $request)
  {
    $clock = new UserClockStatus;
    $clock->user_id = Auth::id();
    $clock->job_code = $request->job_code;
    $clock->clock_status = $request->clock;
    $clock->save();

  }

}
