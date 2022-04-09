<?php

namespace App\Http\Controllers\Package;

use App\Package;
use App\PackageItem;
use Google\Service\AdExchangeBuyer\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class PackageController extends Controller
{
    public function create(){
        $products = \App\Product::all();
        $tags = \App\PackageTag::all();
        return view('user.packages.create',compact('products','tags'));
    }

    public function store(Request $request){


        DB::transaction(function () use ($request){
            $package = Package::create([
                'package_tag_id'=>$request->package_tag_id,
                'title'=>$request->title,
                'description'=>$request->description,
                'price'=>$request->price,
                'per'=>$request->per,
            ]);
            if($request->package_items){
                foreach ($request->package_items as $item){
                    PackageItem::create([
                        'product_id'=>$item['product_id'],
                        'package_id'=>$package->id,
                        'price'=>$item['price'] ? $item['price'] : 0,
                        'is_unlimited'=>array_key_exists('is_unlimited',$item) ? 1 : 0,
                        'qty'=>array_key_exists('qty',$item) ? $item['qty'] : null,
                        'per'=>array_key_exists('per',$item) ? $item['per'] : null,

                    ]);
                }
            }

        });

        session()->put('success','Package added successfully');
        return redirect('packages/create');
    }
}
