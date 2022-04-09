<?php

namespace App\Http\Controllers;

use Auth;
use Stripe;
// use Omnipay\Common\CreditCard;
// use Omnipay\Omnipay;
use App\User;
use App\UserCard;
use App\Payment;
use App\UserWallet;
use GuzzleHttp\Client;
use App\WalletTransection;
use App\PaymentRequestSent;
use App\UserWithdrawalRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use GuzzleHttp\Exception\GuzzleException;
use App\Notifications\UserContactNotification;
use App\Notifications\RequestPaymentNotification;

class UserWalletController extends Controller
{
  public $gateway;

  public function __construct()
  {
    $this->middleware('auth');

  }
  public function my_wallet()
  {

    // dd($this->check_account_balance());
    $data['total_send'] = WalletTransection::where([['user_id',Auth::id()],['transection_type','send']])->sum('amount');
    $data['total_receive'] = WalletTransection::where([['user_id',Auth::id()],['transection_type','receive']])->sum('amount');
    $data['deposits'] = WalletTransection::where([['user_id',Auth::id()],['transection_type','deposit']])->orderBy('id','DESC')->get();
    $data['send'] = WalletTransection::where([['user_id',Auth::id()],['transection_type','send']])->orderBy('id','DESC')->get();
    $data['receive'] = WalletTransection::where([['user_id',Auth::id()],['transection_type','receive']])->orderBy('id','DESC')->get();
    $data['withdraw'] = UserWithdrawalRequest::where('user_id',Auth::id())->orderBy('id','DESC')->get();
    $data['total_withdraw'] = UserWithdrawalRequest::where([['user_id',Auth::id()],['status','Complete']])->sum('amount');

    return view('user.my_wallet',compact('data'));
  }


   public function deposit_into_wallet(Request $request)
  {
    $this->validate($request,[
      'amount' => 'required|numeric',
    ]);

    $prev_card = UserCard::where([['user_id',Auth::id()],['card_number',$request->card_number]])->first();
    if(!$prev_card)
    {
      $user_card = new UserCard;
      $user_card->user_id = Auth::id();
      $user_card->card_number = $request->card_number;
      $user_card->expiration_month = $request->expiration_month;
      $user_card->expiration_year = $request->expiration_year;
      $user_card->card_cvc = $request->cvc;
      $user_card->save();
    }
    $amount = $request->amount;

    // $this->stripe_payment($request,$amount);
    $this->paypal_payment($request,$amount);


  }

  public function stripe_payment($request,$amount)
  {

    Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    $stripe = Stripe\Charge::create ([
      "amount" => $amount * 100,
      "currency" => "usd",
      "source" => $request->stripeToken,
      "description" => "Deposit into Wallet."
    ]);

    if($stripe->id && $stripe->status == 'succeeded')
    {
      $user_wallet = UserWallet::where('user_id',Auth::id())->first();
      if($user_wallet)
      {
        $prev_balance = $user_wallet->withdrawable_funds;
        $new_balance = $user_wallet->withdrawable_funds + $amount;
        $user_wallet->withdrawable_funds = $new_balance;
        $user_wallet->save();
      }
      else{
        $prev_balance = 0;
        $new_balance = $amount;

        $new_user_wallet = new UserWallet;
        $new_user_wallet->user_id = Auth::id();
        $new_user_wallet->withdrawable_funds = $new_balance;
        $new_user_wallet->non_withdrawable_funds = 0;
        $new_user_wallet->save();
      }

      $transection = new WalletTransection;
      $transection->user_id = Auth::id();
      $transection->payment_id = $stripe->id;
      $transection->payment_mode = ($stripe->livemode == false) ? 'test': 'live';
      $transection->transection_type = 'deposit';
      $transection->amount = $amount;
      $transection->currency = '$';
      $transection->funds_type = 'withdrawable';
      $transection->previous_balance = $prev_balance;
      $transection->new_balance = $new_balance;
      $transection->description = "Deposit into Wallet.";
      $transection->save();

    }

    return redirect()->back()->with('success','Funds deposit into your account.');
  }

  public function add_credit_paypal(Request $request)
  {
    $orderId = $request->orderID;
    $capture = $request->capture;
    $amount = $request->amount;
    $capture = @json_decode(@json_encode($capture), false);
    $currency = 'USD';
    $txn_id = $capture->purchase_units[0]->payments->captures[0]->id;
    if(!empty($capture))
    {
      $user_wallet = UserWallet::where('user_id',Auth::id())->first();
      if($user_wallet)
      {
        $prev_balance = $user_wallet->withdrawable_funds;
        $new_balance = $user_wallet->withdrawable_funds + $amount;
        $user_wallet->withdrawable_funds = $new_balance;
        $user_wallet->save();
      }
      else{
        $prev_balance = 0;
        $new_balance = $amount;

        $new_user_wallet = new UserWallet;
        $new_user_wallet->user_id = Auth::id();
        $new_user_wallet->withdrawable_funds = $new_balance;
        $new_user_wallet->non_withdrawable_funds = 0;
        $new_user_wallet->save();
      }

      $transection = new WalletTransection;
      $transection->user_id = Auth::id();
      $transection->payment_id = $txn_id;
      $transection->payment_mode = env('PayPal_Env') == 'sandbox'? 'test': 'live';
      $transection->transection_type = 'deposit';
      $transection->amount = $amount;
      $transection->currency = '$';
      $transection->funds_type = 'withdrawable';
      $transection->previous_balance = $prev_balance;
      $transection->new_balance = $new_balance;
      $transection->description = "Deposit into Wallet.";
      $transection->save();

    }

    return 'Done';
  }


  public function send_payment()
  {
    return view('user.send_payment');
  }

  public function proceed_payment(Request $request)
  {
    $this->validate($request,[
      'user_email' => 'required',
      'amount' => 'required|numeric'
    ]);

    $receiver = User::where('email',$request->user_email)->first();
    if(!$receiver)
      return redirect()->back()->with('error','No user found with this email.');

    $amount_to_send = $request->amount;

    $user_wallet = UserWallet::where('user_id',Auth::id())->first();
    if(!$user_wallet)
      return redirect()->back()->with('error','You don\'t have enough balance.');

    if($amount_to_send > ($user_wallet->withdrawable_funds + $user_wallet->non_withdrawable_funds))
      return redirect()->back()->with('error','You don\'t have enough balance.');

    $sender_prev_balance = $sender_new_balance = $recever_prev_balance = $recever_new_balance = 0;

    $sender_prev_balance = $user_wallet->non_withdrawable_funds + $user_wallet->withdrawable_funds;

    if($amount_to_send > $user_wallet->withdrawable_funds)
    {

      $withdrawable = $user_wallet->withdrawable_funds;
      $non_withdrawable =  $amount_to_send - $user_wallet->withdrawable_funds;

      $user_wallet->non_withdrawable_funds = $user_wallet->non_withdrawable_funds - ($amount_to_send - $user_wallet->withdrawable_funds);
      $user_wallet->withdrawable_funds = 0;
    }
    else
    {
      $user_wallet->withdrawable_funds = $user_wallet->withdrawable_funds - $amount_to_send;
      $withdrawable = $amount_to_send;
      $non_withdrawable = 0;
    }

    $user_wallet->save();

    $sender_new_balance = $user_wallet->non_withdrawable_funds + $user_wallet->withdrawable_funds;

    $receiver_wallet = UserWallet::where('user_id',$receiver->id)->first();
    if(!$receiver_wallet)
    {
      $new_receiver_wallet = new UserWallet;
      $new_receiver_wallet->user_id = $receiver->id;
      $new_receiver_wallet->withdrawable_funds = $withdrawable;
      $new_receiver_wallet->non_withdrawable_funds = $non_withdrawable;
      $new_receiver_wallet->save();

      $recever_prev_balance = 0;
      $recever_new_balance = $withdrawable + $non_withdrawable;

    }
    else
    {
      $recever_prev_balance = $receiver_wallet->withdrawable_funds + $receiver_wallet->non_withdrawable_funds;

      $receiver_wallet->withdrawable_funds += $withdrawable;
      $receiver_wallet->non_withdrawable_funds += $non_withdrawable;
      $receiver_wallet->save();

      $recever_new_balance = $receiver_wallet->withdrawable_funds + $receiver_wallet->non_withdrawable_funds;;
    }

    $s_transection = new WalletTransection;
    $s_transection->user_id = Auth::id();
    $s_transection->payment_id = 0;
    $s_transection->payment_mode = 'live';
    $s_transection->sender_or_recipient = $receiver->id;
    $s_transection->transection_type = 'send';
    $s_transection->amount = $request->amount;
    $s_transection->currency = '$';
    $s_transection->previous_balance = $sender_prev_balance;
    $s_transection->new_balance = $sender_new_balance;
    $s_transection->description = $request->description;
    $s_transection->save();

    $r_transection = new WalletTransection;
    $r_transection->user_id = $receiver->id;
    $r_transection->payment_id = 0;
    $r_transection->payment_mode = 'live';
    $r_transection->sender_or_recipient = Auth::id();
    $r_transection->transection_type = 'receive';
    $r_transection->amount = $request->amount;
    $r_transection->currency = '$';
    $r_transection->previous_balance = $recever_prev_balance;
    $r_transection->new_balance = $recever_new_balance;
    $r_transection->description = $request->description;
    $r_transection->save();

    return redirect()->route('my-wallet')->with('success','Funds transfer to user.');
  }
  public function request_payment()
  {
    return view('user.request_payment');
  }
  public function proceed_request_payment(Request $request)
  {
    $this->validate($request,[
      'user_email' => 'required',
      'amount' => 'required|numeric'
    ]);

    $receiver = User::where('email',$request->user_email)->first();
    if(!$receiver)
      return redirect()->back()->with('error','No user found with this email.');

    $receiver->notify(new RequestPaymentNotification($request->amount));

    $new = new PaymentRequestSent;
    $new->user_id = Auth::id();
    $new->requested_user_id = $receiver->id;
    $new->requested_amount = $request->amount;
    $new->description = $request->description;
    $new->save();

    return redirect()->route('my-wallet')->with('success','Payment request send.');
  }

  public function withdraw_funds(Request $request)
  {
    $this->validate($request,[
      'amount' => 'required|numeric|min:2'
    ]);

    $user_wallet = UserWallet::where('user_id',Auth::id())->first();
    if(!$user_wallet)
      return redirect()->back()->with('error','You don\'t have enough withdrawable funds.');

    $total = Auth::user()->user_wallet->withdrawable_funds + Auth::user()->withdrawl_request('Pending');

    if($request->amount > $total)
      return redirect()->back()->with('error','You don\'t have enough withdrawable funds.');

    $withdrawl_request = new UserWithdrawalRequest;
    $withdrawl_request->user_id = Auth::id();
    $withdrawl_request->amount = $request->amount;
    $withdrawl_request->save();

    $prev_balance = $user_wallet->withdrawable_funds;
    $new_balance = $user_wallet->withdrawable_funds - $request->amount;

    $user_wallet->withdrawable_funds -= $request->amount;
    $user_wallet->save();


    $transection = new WalletTransection;
    $transection->user_id = Auth::id();
    $transection->transection_type = 'withdraw';
    $transection->amount = $request->amount;
    $transection->currency = '$';
    $transection->funds_type = 'withdrawable';
    $transection->previous_balance = $prev_balance;
    $transection->new_balance = $new_balance;
    $transection->description = "Funds withdraw.";
    $transection->save();

    return redirect()->route('my-wallet')->with('success','Your withdraw is being processed, please allow up to 5 business days.');

    // $wise_balance_usd = $this->check_account_balance();
    // if($wise_balance_usd <= 0 || $wise_balance_usd < $request->amount)
    //   return redirect()->back()->with('error','There is some error. Please try again after some time.');

    // $wise_env = $this->admin_setting('WISE_ENV');
    // $wise_api_key = $this->admin_setting('WISE_API_KEY_'.$wise_env);
    // $wise_profile_id = $this->admin_setting('WISE_PROFILE_ID_'.$wise_env);

    // $client = new Client();
    // try
    // {

    //   $result = $client->request('POST','https://api.sandbox.transferwise.tech/v2/quotes', [
    //     'headers' => [
    //       'Authorization' => 'Bearer 3570f922-8e5d-4ebd-80fb-c47e0ead0386',
    //       'Accept' => 'application/json',
    //       'Content-Type'  => 'application/json',
    //     ],
    //     'form_params' => [
    //       'profile'     => 16241504,
    //       'sourceCurrency' => 'GBP',
    //       'targetCurrency' => 'GBP',
    //       // 'targetAmount' => 105
    //       'sourceAmount' => 100
    //     ]
    //   ]);
    //   $response_data = (string) $result->getBody();
    //   $json = json_decode($response_data);

    // }
    // catch(\Exception $e)
    // {
    //   dump($e);
    // }

    // $client = new Client();
    // $result = $client->request('POST','https://api.sandbox.transferwise.tech/v2/quotes', [
    //   'headers' => [
    //     'Authorization' => 'Bearer 3570f922-8e5d-4ebd-80fb-c47e0ead0386',
    //     'Accept' => 'application/json',
    //     'Content-Type'  => 'application/json',
    //   ],
    //   'form_params' => [
    //     'profile'     => 16241504,
    //     'sourceCurrency' => 'GBP',
    //     'targetCurrency' => 'GBP',
    //     // 'targetAmount' => 105
    //     'sourceAmount' => 100
    //   ]
    // ]);
    // $response_data = (string) $result->getBody();
    // $json = json_decode($response_data);
    // dd($json);

  }

  public function check_account_balance()
  {
    $wise_env = $this->admin_setting('WISE_ENV');
    $wise_api_key = $this->admin_setting('WISE_API_KEY_'.$wise_env);
    $wise_profile_id = $this->admin_setting('WISE_PROFILE_ID_'.$wise_env);
    $wise_url = $this->admin_setting('WISE_API_URL_'.$wise_env);
    $wise_currency = $this->admin_setting('WISE_CURRENCY_'.$wise_env);

    $client = new Client();
    $result = $client->request('GET',$wise_url.'v1/borderless-accounts?profileId='.$wise_profile_id, [
      'headers' => [
        'Authorization' => 'Bearer '.$wise_api_key,
        // 'Accept' => 'application/json',
        'Content-Type'  => 'application/json',
      ],
      // 'form_params' => [
      //   'profile'     => 16241504,
      //   'sourceCurrency' => 'GBP',
      //   'targetCurrency' => 'GBP',
      //   // 'targetAmount' => 105
      //   'sourceAmount' => 100
      // ]
    ]);
    $response_data = (string) $result->getBody();
    $json = json_decode($response_data);
    for($i = 0; $i < count($json); $i++)
      for($j = 0; $j < count($json[$i]->balances); $j++)
        if($json[$i]->balances[$j]->currency == $wise_currency)
          return $json[$i]->balances[$j]->amount->value;
        else
          return 0;
  }


public function charge(Request $request)
{
    if ($request->input('submit')) {
        try {
            $response = $this->gateway->purchase(array(
                'amount' => $request->input('amount'),
                'currency' => env('PAYPAL_CURRENCY'),
                'returnUrl' => url('paymentsuccess'),
                'cancelUrl' => url('paymenterror'),
            ))->send();

            if ($response->isRedirect()) {
                $response->redirect(); // this will automatically forward the customer
            } else {
                // not successful
                return $response->getMessage();
            }
        } catch (\Throwable $e) {
            return $e->getMessage();
        }
    }
}

public function payment_success(Request $request)
{
    // Once the transaction has been approved, we need to complete it.
    if ($request->input('paymentId') && $request->input('PayerID')) {
        $transaction = $this->gateway->completePurchase(array(
            'payer_id'             => $request->input('PayerID'),
            'transactionReference' => $request->input('paymentId'),
        ));
        $response = $transaction->send();

        if ($response->isSuccessful()) {
            // The customer has successfully paid.
            $arr_body = $response->getData();

            // Insert transaction data into the database
            $isPaymentExist = Paymoney::where('payment_id', $arr_body['id'])->first();

            if (!$isPaymentExist) {
                $payment = new Paymoney();
                $payment->payment_id = $arr_body['id'];
                $payment->payer_id = $arr_body['payer']['payer_info']['payer_id'];
                $payment->payer_email = $arr_body['payer']['payer_info']['email'];
                $payment->amount = $arr_body['transactions'][0]['amount']['total'];
                $payment->currency = env('PAYPAL_CURRENCY');
                $payment->payment_status = $arr_body['state'];
                $payment->save();
            }

            return "Payment is successful. Your transaction id is: " . $arr_body['id'];
        } else {
            return $response->getMessage();
        }
    } else {
        return 'Transaction is declined';
    }
}

public function payment_error()
{
    return 'User is canceled the payment.';
}



}
