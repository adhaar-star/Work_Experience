<?php

namespace App\Http\Controllers\Backend;
use App\Models\User;
use App\Models\VendorPincode;
use App\Models\Product;
use App\Models\Deal;
class SettingController extends BackendController{

	public function __construct() {
		parent::__construct();
	
		view()->share(['active_nav' => 'setting']);
			
	}

	public function getIndex(){

        if(\Auth::user()->role == 'admin'){
        	$vendors = User::where('role','vendor')->orWhere('role','admin')->get();
			$this->layout->content = view('backend.setting.index',['vendors' => $vendors  ]);
			return $this->layout;
        }else{

        	die("Not Authorized !");
        }
        
		
	}



	public function getVendor($vendorId){
		$settings = ['pincode','change_password'];

        if(\Auth::user()->role == 'vendor' && $vendorId!= \Auth::user()->id){

        	die("Not Authorized !");
        }
        if(\Auth::user()->role == 'admin' &&  $vendorId == \Auth::user()->id){
        	array_push($settings,"products_of_the_day","deals_of_the_day");
        }
        
		$vendor = User::where('id',$vendorId)->first();
       
         	$this->layout->content = view('backend.setting.vendor-setting',['vendor' => $vendor  ,'settings' => $settings ]);
		
		return $this->layout;
	}

	public function getPincode($action,$id = null){

		switch($action){

			case 'view':
			      if(\Auth::user()->role == 'vendor' && $id!= \Auth::user()->id){

        	            die("Not Authorized !");
                  }
				  $vendorPins = VendorPincode::where('vendorId',$id)->get();
				  $vendor = User::where('id',$id)->first();
				  $this->layout->content = view('backend.setting.vendor-pins',['vendorPins' => $vendorPins ,'vendor' => $vendor ]);
		    break;	

		    case 'create':
		          $vendors = User::where('role','vendor')->orWhere('role','admin')->get();
		          $this->layout->content = view('backend.setting.pin_form',['vendors' => $vendors ]);
		    break;     

		    case 'delete':

		          $pin =VendorPincode::find($id);
		          if(($pin->vendorId == \Auth::user()->id && \Auth::user()->role == 'vendor') || (\Auth::user()->role == 'admin')){

		          	 $delete =  $pin->delete();
		          }

		          if(isset($delete) && $delete)
		          	return redirect()->back()->with(['message' => ['text' => 'pincode deleted successfully !','class' => 'alert-success']]);
		           return redirect()->back()->with(['message' => ['text' => 'Unable to delete pincode !','class' => 'alert-danger']]);
		     break;     	
		               



		}

		return $this->layout;

	}
	public function postPincode(\Illuminate\Http\Request $request){
        
		$pincode = new VendorPincode();
		$pincode->vendorId = $request->get('vendor_id');
		$pincode->address = $request->get('address');
		$pincode->pincode = $request->get('pincode');
		if($pincode->save()){

			return redirect($this->adminBase('setting/pincode/view/'.$request->get('vendor_id')))->with(['message' => ['text' => 'pincode saved !','class' => 'alert-success']]);
		}

		return redirect()->back()->with(['message' => ['text' => 'Unable to save pincode !','class' => 'alert-danger']]);
	}

	public function getProductsOfTheDay(){

		if(\Auth::user()->role != 'admin'){
			die("Not Authorized !");
		}

        $products = Product::where('visible','yes')->get();
		$this->layout->content = view('backend.setting.products_of_the_day',['products' => $products]);

		return $this->layout;
	}

	public function postProductsOfTheDay(\Illuminate\Http\Request $request){
		if(\Auth::user()->role != 'admin'){
			die("Not Authorized !");
		}

		$pod = $request->get('pod');
		$pr = Product::where('product_of_the_day','yes')->update(['product_of_the_day' => 'no']);
		$product = Product::whereIn('productId',$pod)->update(['product_of_the_day' => 'yes']);
		 return redirect()->back()->with(['message' => ['text' => 'Product Setting Saved.','class' => 'alert-success']]);
	}


	public function getDealsOfTheDay(){

		if(\Auth::user()->role != 'admin'){
			die("Not Authorized !");
		}

        $deals = Deal::where('offerEndDate', '>=', date("Y-m-d"))->get();
		$this->layout->content = view('backend.setting.deals_of_the_day',['deals' => $deals]);

		return $this->layout;
	}

	public function postDealsOfTheDay(\Illuminate\Http\Request $request){
		if(\Auth::user()->role != 'admin'){
			die("Not Authorized !");
		}

		$dod = $request->get('dod');
		$dl = Deal::where('deal_of_the_day','yes')->update(['deal_of_the_day' => 'no']);
		$product = Deal::whereIn('offerId',$dod)->update(['deal_of_the_day' => 'yes']);
		 return redirect()->back()->with(['message' => ['text' => 'Deals Setting Saved.','class' => 'alert-success']]);
	}


	public function getChangePassword(\Illuminate\Http\Request $request,$vid = null){

	    $user = \Auth::user();

          if(\Auth::user()->role == "admin")
              $user = User::where("id",$vid)->first();

          $this->layout->content = view('backend.setting.change_password',['user' => $user]);

		return $this->layout;



	}

	public function postChangePassword(\Illuminate\Http\Request $request){

		$user = \Auth::user();

        if(\Auth::user()->role == "admin")
            $user = User::where("id",$request->get('user_id'))->first();

		$valid = \Validator::make($request->all(), [
				 'password' => 'required|confirmed'

			]);

		if($valid->fails()){

           	return redirect()->back()->with([
				'message' => ['text' => 'Unable to save info',
				'class' => 'alert-danger']
				])
			->withErrors($valid);
         }
         $user->password = $request->get('password','');

         if($user->save()){
                return redirect()->back()->with(['message' => ['text' => 'Password changed successfully !','class'=>'alert-success']]);
           }

           return redirect()->back()->with(['message' => ['text' => 'Unable to change password !','class'=>'alert-danger']]);




	}
}