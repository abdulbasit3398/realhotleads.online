<?php

namespace App\Http\Controllers;

use Auth;
use App\Funnel;
use App\PackageTag;
use Illuminate\Http\Request;

class SalesFunnelController extends Controller
{
  public function __construct()
  {
     $this->middleware('auth',['except' => ['sales_funnels','pricing']]);
   }

   public function sales_funnels()
   {
    return view('user.sales_funnels');
  }
  public function custom_sales_funnels()
  {
    $funnel_types = \App\FunnelType::all();
    return view('user.sales_funnel.custom_sales_funnel',compact('funnel_types'));
  }

  public function custom_sales_funnels_store(Request $request){

    $funnel = Funnel::create($request->except('_token','file'));

    $funnel->update(['user_id'=>auth()->id()]);

    $files = $request->file;
    $this->files($files,$funnel);

    session()->put('success','Funnel Created Successfully!');
    return response()->json(['msg'=>'Funnel Created Successfully'],200);
  }

  public function files($files, $funnel){
    if($files && count($files)>0){
      foreach ($files as $file){
        if($file){
          $file_name = time().rand(1,1000). '.' . $file->getClientOriginalExtension();

          $path = public_path().'/assets/images/custom-funnels/';
          $file->move($path,$file_name);

          $funnel->files()->create([
            'file'=>$file_name,
            'name'=>$file->getClientOriginalName()
          ]);

        }
      }
    }

  }
  public function pricing()
  {
    $tags = PackageTag::where('id',1)->get();
      //      $packages = Package::where('package_tag_id',1)->get();
    return view('user.pricing-funnel',compact('tags'));
            // return view('user.pricing',compact('tags'));
  }
  public function my_pages()
  {
    $pages = Funnel::where('user_id',Auth::id())->get();
     
    return view('user.my_pages',compact('pages'));
  }


}
