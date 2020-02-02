<?php

namespace App\Http\Controllers;

use App\Models\Master\RangeNumber;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Session;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    protected function getRangeNumber($max_number, $model, $company_id){
        $customer_number = null;
        $range = RangeNumber::ByCompany($company_id)->ByModel($model)->first();
        if(!empty($range)){
            if ($max_number == null || $max_number == 0 || $max_number <  $range->start) {
                $customer_number =  $range->start;
            }else{
                $customer_number = $max_number + 1;
                if ($customer_number > $range->end) {
                    $customer_number = null;
                    Session::flash('alert-danger', 'Please change end range of  number range in settings');
                }
            }
            return $customer_number;
        }else{
            Session::flash('alert-danger', 'Please Update range in settings');
            return $customer_number;
        }
    }
}
