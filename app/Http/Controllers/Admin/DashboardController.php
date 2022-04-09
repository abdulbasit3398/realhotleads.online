<?php

namespace App\Http\Controllers\Admin;

use Mail;
use App\User;
use App\UserBankDetail;
use App\UserClockStatus;
use App\ContactGenerator;
use App\UserWithdrawalRequest;
use App\CustomPackageRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }
  public function index()
  {
    $data['user_clock'] = UserClockStatus::orderBy('id','DESC')->get();
    $data['user'] = User::where('type','user')->get();
    $data['custom_packages'] = CustomPackageRequest::all();
    return view('admin.dashboard',compact('data'));
  }
  public function save_contact_file(Request $request)
  {
    $this->validate($request,[
      'contact_id' => 'required',
      'contact_file' => 'required',
      'contacts_used' => 'required|integer',
    ]);

    if(!$request->hasFile('contact_file'))
      return redirect()->back();

    $image = $request->file('contact_file');
    $name = 'contact_'.time().'.'.$image->getClientOriginalExtension();
    $destinationPath = public_path('/assets/contacts');
    $imagePath = $destinationPath. "/". $name;
    $image->move($destinationPath, $name);

    $contact = ContactGenerator::findOrFail($request->contact_id);
    $contact->status = 1;
    $contact->contact_file = $name;
    $contact->save();

    $user = User::findOrFail($contact->user_id);
    $user->remaining_contacts -= $request->contacts_used;
    $user->save();

    return redirect()->back()->with('success','File save successfully.');
  }

  public function user_withdrawal_request(Request $request)
  {
    $data['requests'] = UserWithdrawalRequest::orderBy('id','DESC')->get(); 
    return view('admin.user_withdrawal_request',compact('data'));
  }
  public function show_withdrawal_request($id)
  {
    $data['withdrawal_request'] = UserWithdrawalRequest::findOrFail($id);
    $data['user_bank_details'] = UserBankDetail::where('user_id',$data['withdrawal_request']->user_id)->get();
    $data['user'] = User::findOrFail($data['withdrawal_request']->user_id);
    return view('admin.show_withdrawal_request',compact('data'));
  }
  public function complete_withdrawal_request($id)
  {
    $data['withdrawal_request'] = UserWithdrawalRequest::findOrFail($id);
    $data['withdrawal_request']->status = 'Complete';
    $data['withdrawal_request']->save();

    return redirect()->back()->with('success','Withdrawal Complete.');

  }
  public function send_withdrawal_notification(Request $request)
  {
    $this->validate($request,[
      'withdrawal_request_id' => 'required',
      'notification_message' => 'required'
    ]);
    $data['withdrawal_request'] = UserWithdrawalRequest::findOrFail($request->withdrawal_request_id);
    
    $data['user'] = User::findOrFail($data['withdrawal_request']->user_id);
    $data['subject'] = 'Withdrawal Notification';
    $data['notification_message'] = $request->notification_message;

    Mail::send('mail.withdrawal_notification',['data' => $data], function($message) use ($data)
    {
      $message->to($data['user']->email, 'Admin')->subject($data['subject']);
    });

    return redirect()->back()->with('success','Notification Sent.');

  }
}
