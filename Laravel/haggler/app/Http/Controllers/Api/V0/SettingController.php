<?php

namespace App\Http\Controllers\Api\V0;
use \App\Models\VendorPincode;
use \DB;
use \Hash;

use \Auth;


class SettingController extends ApiController {

	public function getPincodeValidate(\Illuminate\Http\Request $request){

         $vendorId = $request->get('vendor_id');
         $pincode = $request->get('pincode');
         if(empty($vendorId) || empty($pincode) ){

         	$this->addError('Invalid Request !');
			return $this->response();
         }

          $pincode = VendorPincode::where('vendorId',$vendorId)->where('pincode',$pincode)->first();

          if(!empty($pincode)){
          	 return $this->response();
          }

         $this->addError('Invalid Pincode !');
         return $this->response();

		
	}


}