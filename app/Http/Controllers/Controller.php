<?php

namespace App\Http\Controllers;

use App\AdminSetting;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

  public function admin_setting($field_name)
  {
    $admin_setting = AdminSetting::where('field_name',$field_name)->first();
    if($admin_setting)
      return $admin_setting->field_value;
    else
      return false;
  }
  
  public function us_number_format($number)
  {
    $numbers = explode("\n", $number);
    $us_number = '';
    foreach($numbers as $num)
    {
      $us_number .= preg_replace('~.*(\d{3})[^\d]{0,7}(\d{3})[^\d]{0,7}(\d{4}).*~', '$1$2$3', $num);
    }

    return $us_number;
  }


}
