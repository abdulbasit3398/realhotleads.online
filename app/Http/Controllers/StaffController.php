<?php

namespace App\Http\Controllers;

use App\Funnel;
use App\User;
use App\BulkSmsEmail;
use App\UserContact;
use App\UserSmsHistory;
use App\UserPhoneNumber;
use App\ContactGenerator;
use Illuminate\Http\Request;
use App\Notifications\UserContactNotification;
use Illuminate\Notifications\Messages\MailMessage;

class StaffController extends CommunicationController
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index()
  {
    $contacts = ContactGenerator::orderBy('id','DESC')->get();
    return view('staff.dashboard',compact('contacts'));
  }

  public function save_contact_file(Request $request)
  {
    $this->validate($request,[
      'contact_id' => 'required',
      // 'contact_file' => 'required',
    ]);

    // if(!$request->hasFile('contact_file'))
      // return redirect()->back();

    $contact = ContactGenerator::findOrFail($request->contact_id);

    $available = $status = 0;

    if(count($contact->user->contacts_available) != 0)
    {
      $available = $contact->user->check_contacts_availability($contact->created_at);
    }
    if($available == 0)
    {
      $this->validate($request,['price_of_file' => 'required']);

      $contact->price = $request->price_of_file;
      $contact->downloadable = 0;
    }

    if($request->hasFile('contact_file'))
    {
      $image = $request->file('contact_file');
      $name = 'contact_'.time().'.'.$image->getClientOriginalExtension();
      $destinationPath = public_path('/assets/contacts');
      $imagePath = $destinationPath. "/". $name;
      $image->move($destinationPath, $name);
      $contact->contact_file = $name;
      $status = 1;
    }


    $contact->status = $status;
    $contact->is_file_complete = ($request->file_complete) ? $request->file_complete : 0;
    $contact->notes = $request->notes;

    $contact->save();

    $user = User::findOrFail($contact->user_id);
    $user->remaining_contacts -= $request->contacts_used;
    $user->save();

    $user->notify(new UserContactNotification($contact));


    return redirect()->back()->with('success','File save successfully.');
  }

  public function funnels(){
      $funnels = Funnel::all();
      return view('staff.custom-funnels',compact('funnels'));
  }

  public function sms_email_request()
  {
    $bulk_sms_email = BulkSmsEmail::orderBy('id','DESC')->get();
    return view('staff.sms_email_request',compact('bulk_sms_email'));
  }

  public function send_bulk_sms_form()
  {

    return view('staff.send_bulk_sms_form');
  }
  public function send_bulk_sms(Request $request)
  {
    $this->validate($request,[
      'sms_recipient_number' => 'required',
      'sender' => 'required'
    ]);

    $user_phone_number = UserPhoneNumber::where('phone_number',$request->sender)->first();
    if(!$user_phone_number)
      return redirect()->back()->with('error','No user found with that phone number.');

    $number_arr = array();
    $numbers = explode(",",$request->sms_recipient_number);

    for($i=0;$i<count($numbers);$i++)
    {

      $contact = UserContact::where([['user_id',$user_phone_number->user_id],['contact_phone','like','%'.$numbers[$i].'%']])->first();
      if($contact)
        $number = $contact->contact_phone;
      else
      {
        $number = $numbers[$i];

        $contact = new UserContact;
        $contact->user_id = $user_phone_number->user_id;
        $contact->contact_name = 'No name';
        $contact->contact_phone = $number;
        $contact->save();

      }

      $number = $this->us_number_format($number);
      if(strlen($number) == $this->number_len_US)
        $number_arr[] = '+1'.$number;

      $contact_arr[] = $contact->id;
    }

    $name = '';
    $from = $request->sender;

    for($i=0;$i< count($number_arr);$i++)
    {
      $id = $this->send_signalwire_sms($from,$number_arr[$i],$request->message,$name);

      if($id != '0')
      {
        $history = new UserSmsHistory;
        $history->user_id = $user_phone_number->user_id;
        $history->contact_id = (count($contact_arr) > 0) ? $contact_arr[$i] : 0;
        $history->contact_phone_number = $number_arr[$i];
        $history->message_to = $number_arr[$i];
        $history->message_from = $request->sender;
        $history->type = 'sms';
        $history->sid = $id;
        $history->message = $request->message;
        $history->media = $name;
        $history->save();

      }

    }

    return redirect()->back()->with('success','Message send successfully.');

  }



}

