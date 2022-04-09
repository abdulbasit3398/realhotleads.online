<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Session;
use Stripe;
use App\User;
use App\BillingAddress;
use App\UserCpanelEmailAddress;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';
    protected $packages = ['products','outsourced','unlimited'];
    protected $cpanel;

    public function __construct()
    {
        
        $this->middleware('guest');

    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'company_name' => ['string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    
    public function showRegistrationForm()
    {
        return redirect()->route('register_product',['website'=>'kC0+H0TnykPfIcjca6pCb4KmKxZMBdqVbwOn', 'product'=>'tyovFQ==']);
    }

    protected function create(array $data)
    {
        
    }

    public function create_free(Request $data)
    {
        $referrer_id = 0;
        if($data['referal_user'] != null)
        {
            $referal = $this->check_referal($data['referal_user'],$data['website']);
            if($referal == '0')
                return redirect()->back()->with('error','No referal user found with that record.');
            else
                $referrer_id = $referal;
        }

        $user =  User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'company_name' => $data['company_name'],
            // 'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'website' => $data['website'],
            'referrer_id' => $referrer_id,
            'affiliate_account' => isset($data['affiliate']) ? $data['affiliate'] : 0,
        ]);

        $string = $data['email'];

        if(strpos($data['email'], '@'))
            $string = substr($data['email'], 0, strpos($data['email'], '@'));
        
        $cpanel = new \myPHPnotes\cPanel(env('CPANEL_USERNAME'),env('CPANEL_PASSWORD'), env('CPANEL_HOST'));

        $response = $cpanel->uapi(
            'Email',
            'add_pop',
            array (
                'email' => $string.time(),
                'password' => $data['password'],
                'domain' => env('CPANEL_DOMAIN'),
            )
        );
        if ($response->status) {
            $email = str_replace("+","@",$response->data);

            UserCpanelEmailAddress::create([
                'user_id' => $user->id,
                'email_address' => $email,
                'password' => $data['password'],
            ]);
        }

        Auth::login($user);
        return redirect()->route('dashboard');
    }

    protected function create_product(Request $data)
    {
        $referrer_id = 0;
        if(isset($data['referal_user']))
        {

            $referal = $this->check_referal($data['referal_user'],$data['website']);
            if($referal == '0')
                return redirect()->back()->with('error','No referal user found with that record.');
            else
                $referrer_id = $referal;
        }

        // Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

        // $package_price = 0;
        // if($data['package_name'] == 'products')
        //     $package_price = 4;
        // else if($data['package_name'] == 'outsourced')
        //     $package_price = 40;
        // else if($data['package_name'] == 'unlimited')
        //     $package_price = 400;
        // else
        //     return redirect()->back();

        // $stripe = Stripe\Charge::create ([
        //     "amount" => $package_price * 100,
        //     "currency" => "usd",
        //     "source" => $data['stripeToken'],
        //     "description" => "Payment for PRODUCTS on ".env('APP_NAME') 
        // ]);

        // if($stripe->id)
        // {
            $user = User::create([
                'username' => $data['username'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'payment_id' => '',
                'website' => $data['website'],
                'package_name' => $data['package_name'],
                'package_price' => $package_price,
                'referrer_id' => $referrer_id
            ]);

            // $billing = new BillingAddress;
            // $billing->user_id = $user->id;
            // $billing->first_name = $data['first_name'];
            // $billing->last_name = $data['last_name'];
            // $billing->address_1 = $data['address_1'];
            // $billing->address_2 = $data['address_2'];
            // $billing->city = $data['city'];
            // $billing->postal_code  = $data['postal_code'];
            // $billing->country  = $data['country'];
            // $billing->phone  = $data['phone'];
            // $billing->state  = $data['state'];
            // $billing->save();

            Auth::login($user);
            return redirect()->route('dashboard');
        // }
        // else
        //     return redirect()->back();
    }
    // public function register_product($website,$product)
    // {

    //     $website = $this->decrypt_string($website);
    //     $product = $this->decrypt_string($product);

    //     if(in_array($product, $this->packages))
    //         return view('auth.register-product',compact('product','website'));
    //     elseif($product == 'free')
    //         return view('auth.register',compact('product','website'));
    //     else
    //         return view('auth.login');
        
    // }

    public function register_product($website)
    {
        // dd($this->encrypt_string('Automated Contact Generator'));
        $website = $this->decrypt_string($website);

        return view('auth.register',compact('website'));
    }

    public function decrypt_string($encrypted_string)
    {
        $decryption_iv = env('DECRYPTION_IV');
        $decryption_key = env('DECRYPTION_KEY');
        $ciphering = env('CIPHERING');
        $decryption = openssl_decrypt ($encrypted_string, $ciphering,$decryption_key, 0, $decryption_iv);

        return $decryption;
    }

    public function encrypt_string($string)
    {
        //openssl_encrypt(text4pay) => pT0yBB32318=
        //openssl_encrypt(free) => tyovFQ==
        //openssl_encrypt(products) => oSolFFzlylU=
        //openssl_encrypt(outsourced) => vi0+A0bzzEXeZQ==
        //openssl_encrypt(unlimited) => pDYmGUTvykPf

        $ciphering = env('CIPHERING');
        $iv_length = openssl_cipher_iv_length($ciphering);
        $encryption_iv = env('DECRYPTION_IV');
        $encryption_key = env('DECRYPTION_KEY');
        $encryption = openssl_encrypt($string, $ciphering,$encryption_key,0, $encryption_iv);

        return $encryption;
    }

    public function check_referal($user,$website)
    {
        $user = User::where([['username',$user],['website',$website]])->orWhere([['email',$user],['website',$website]])->first();

        if($user)
            return $user->id;
        else
            return 0;
        
    }

    public function guest_register(Request $request)
    {
        // $this->validate($request,[
        //     'referal_user' => 'required'
        // ]);

        $referal = 0;
        if(isset($request['referal_user']))
            $referal = $this->check_referal($request['referal_user'],$request['website']);

        $time = time();
        $start = substr($time,0,5);
        $end = substr($time,5);

        $username = 'ID'.$start.'-'.$end;

        $user =  User::create([
            'first_name' => 'Guest',
            'last_name' => $username,
            'company_name' => '',
            // 'username' => $data['username'],
            'email' => 'Guest'.$username,
            'password' => Hash::make('123456'),
            'website' => $request['website'],
            'referrer_id' => $referal,
            'affiliate_account' => 0,
            'guest' => 1,
        ]);

        // $cpanel = new \myPHPnotes\cPanel(env('CPANEL_USERNAME'),env('CPANEL_PASSWORD'), env('CPANEL_HOST'));

        // $response = $cpanel->uapi(
        //     'Email',
        //     'add_pop',
        //     array (
        //         'email' => $username,
        //         'password' => $username,
        //         'domain' => env('CPANEL_DOMAIN'),
        //     )
        // );
        
        // if ($response->status) {
        //     $email = str_replace("+","@",$response->data);

        //     UserCpanelEmailAddress::create([
        //         'user_id' => $user->id,
        //         'email_address' => $email,
        //         'password' => $username,
        //     ]);
        // }

        Auth::login($user);
        return redirect()->route('dashboard');
        

    }   
}
