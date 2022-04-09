<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\CustomPackageRequest;
use App\UserPhoneNumber;
use Illuminate\Support\Facades\Auth;
use SignalWire\Rest\Client as SClient;
class CartController extends Controller
{

    public function index()
    {
//        $carts=Cart::content();
        $packages = session()->get('packages');
        return view('user.cart',compact('packages'));
    }


    public function create()
    {
        //
    }

//    public function store(Request $request)
//    {
//
//        if($request->package_id == 'unlimited_contacts' && $request->time == 'month'){
//          $product['product_name'][] = 'contacts';
//          $product['quantity'][] = -1;
//          $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));
//          $package_price = 300;
//          $id=9;
//
//        }
//        elseif($request->package_id == 'unlimited_contacts' && $request->time == 'year'){
//          $product['product_name'][] = 'contacts';
//          $product['quantity'][] = -1;
//          $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));
//          $package_price = 3000;
//          $id=8;
//        }
//        elseif($request->package_id == 'unlimited_communication' && $request->time == 'month'){
//          $this->buy_phone_number();
//          $product['product_name'][] = 'unlimited_communication';
//          $product['quantity'][] = -1;
//          $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));
//          $id=7;
//          // $product['product_name'][] = 'phone_calls';
//          // $product['quantity'][] = -1;
//          // $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));
//
//          // $product['product_name'][] = 'emails';
//          // $product['quantity'][] = -1;
//          // $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));
//
//          $package_price = 300;
//        }
//        elseif($request->package_id == 'unlimited_communication' && $request->time == 'year'){
//          $this->buy_phone_number();
//          $product['product_name'][] = 'unlimited_communication';
//          $product['quantity'][] = -1;
//          $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));
//          $id=6;
//          // $product['product_name'][] = 'phone_calls';
//          // $product['quantity'][] = -1;
//          // $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));
//
//          // $product['product_name'][] = 'emails';
//          // $product['quantity'][] = -1;
//          // $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));
//
//          $package_price = 3000;
//        }
//        elseif($request->package_id == 'unlimited_both' && $request->time == 'month'){
//          $this->buy_phone_number();
//          $product['product_name'][] = 'unlimited_both';
//          $product['quantity'][] = -1;
//          $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));
//          $id=5;
//          // $product['product_name'][] = 'sms_mms';
//          // $product['quantity'][] = -1;
//          // $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));
//
//          // $product['product_name'][] = 'phone_calls';
//          // $product['quantity'][] = -1;
//          // $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));
//
//          // $product['product_name'][] = 'emails';
//          // $product['quantity'][] = -1;
//          // $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 30 days'));
//
//          $package_price = 407;
//        }
//        elseif($request->package_id == 'unlimited_both' && $request->time == 'year'){
//          $this->buy_phone_number();
//          $product['product_name'][] = 'contacts';
//          $product['quantity'][] = -1;
//          $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));
//          $id=4;
//          // $product['product_name'][] = 'sms_mms';
//          // $product['quantity'][] = -1;
//          // $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));
//
//          // $product['product_name'][] = 'phone_calls';
//          // $product['quantity'][] = -1;
//          // $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));
//
//          // $product['product_name'][] = 'emails';
//          // $product['quantity'][] = -1;
//          // $product['validity'][] = date('Y-m-d', strtotime(date('Y-m-d'). ' + 365 days'));
//
//          $package_price = 3168;
//        }
//        elseif($request->package_id == 'biz_opp_leads')
//        {
//          if($request->time == '30')
//          {
//            $product['product_name'][] = 'leads';
//            $product['quantity'][] = 30;
//            $product['validity'][] = -1;
//            $package_price = 100;
//            $id=3;
//          }
//          elseif($request->time == '130')
//          {
//            $product['product_name'][] = 'leads';
//            $product['quantity'][] = 130;
//            $product['validity'][] = -1;
//            $package_price = 300;
//            $id=3;
//          }
//        }
//        elseif($request->package_id == 'biz_opp_prospects')
//        {
//          if($request->time == '15')
//          {
//            $product['product_name'][] = 'prospects';
//            $product['quantity'][] = 15;
//            $product['validity'][] = -1;
//            $package_price = 220;
//            $id=2;
//          }
//          elseif($request->time == '50')
//          {
//            $product['product_name'][] = 'prospects';
//            $product['quantity'][] = 50;
//            $product['validity'][] = -1;
//            $package_price = 730;
//            $id=2;
//          }
//          elseif($request->time == '100')
//          {
//            $product['product_name'][] = 'prospects';
//            $product['quantity'][] = 100;
//            $product['validity'][] = -1;
//            $package_price = 1400;
//            $id=2;
//          }
//        }
//        elseif($request->package_id == '20 usd package')
//        {
//          $product['product_name'][] = 'Starter';
//          $product['quantity'][] = 1500;
//          $product['validity'][] = -1;
//          $id=1;
//          // $product['product_name'][] = 'phone_calls';
//          // $product['quantity'][] = 1500;
//          // $product['validity'][] = -1;
//
//          // $product['product_name'][] = 'emails';
//          // $product['quantity'][] = 1500;
//          // $product['validity'][] = -1;
//
//          $package_price = 20;
//        }
//        elseif($request->package_id == 'custom_biz_opp_leads'){
//
//          $product['product_name'][] = 'Custom Biz Opp Leads';
//
//          $id=10;
//          $package_price = 0;
//
//        }
//        elseif($request->package_id == 'custom_prospects'){
//
//          $product['product_name'][] = 'Custom Prospects';
//
//          $id=11;
//          $package_price = 0;
//        }
//        // dd(implode($product['product_name']));
//        $cart = Cart::Add([
//            'id' => $id,
//            'name' => implode($product['product_name']),
//            'qty' => 1,
//            'price' => $package_price,
//            'weight' => 0,
//
//        ]);
//
//        return response()->json(
//            [
//                'success' => true,
//                'count' => Cart::count(),
//                'message' => 'Cart Add Successfully'
//            ],
//            200
//        );
//    }

    public function store(Request $request){

        $request->validate([
           'package_id'=>'required'
        ]);

        $package_id  = $request->package_id;

        if(session()->has('packages')){
            $packages = session()->get('packages');
            if(array_search($package_id,$packages) === false){
                array_push($packages,$package_id);
                session()->put('packages',$packages);
            }

        }else{
            $package = [$package_id];
            session()->put('packages',$package);
        }

        $count = session()->get('packages');

        return response()->json(
            [
                'success' => true,
                'count' => count($count) ,
                'message' => 'Cart Add Successfully'
            ],

            200
        );
    }

    public function qtyUpdate(Request $request)
    {
        $rowId = $request->CartId;
      switch ($request->buttonId){
          case  'add':
              Cart::update(
                  $rowId, [
                  'qty' => $request->qty,
              ]);
              break;
          case 'reduce':
              Cart::update(
                  $rowId, [
                  'qty' => $request->qty,
              ]);

              break;

      }
      }

    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(Request $request,$id)
    {
        //
    }

    public function destroy($id)
    {
        $rowId = explode(',', $id);

        Cart::remove($rowId[1]);
        return response()->json(
            [
                'success' => true,
                'message' => 'Cart Delete Successfully'
            ],
            200
        );
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
          $new_user_phone_num = new UserPhoneNumber();
          $new_user_phone_num->user_id = Auth::id();
          $new_user_phone_num->phone_number = $numbers[$i]->phoneNumber;
          $new_user_phone_num->status = 1;
          $new_user_phone_num->save();

          $phone_number = $numbers[$i]->phoneNumber;
          return $phone_number;
        }
      }





    }
}
