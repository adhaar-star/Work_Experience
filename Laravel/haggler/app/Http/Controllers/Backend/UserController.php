<?php


namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Upload;
use App\Models\PasswordReset;
use App\Models\VendorPermission;

class UserController extends BackendController {

	public function __construct() {
		parent::__construct();
	
		view()->share(['active_nav' => 'user']);
			
	}

	public function getVendors(\Illuminate\Http\Request $request,$action = null) {

		$vendors = User::whereIn('role', ['vendor','admin'])->orderBy('id', 'desc');

		if (!empty($request->get('q'))) {

			$q = $request->get('q');

			$vendors = $vendors->where(function ($w) use($q) {
				return $w->where('username', 'like', "%$q%")
				->orWhere('email', 'like', "%$q%")
				->orWhereIn('id',function($query) use($q){
					$query->select('vendorId')->from('stores')
					->where('storeName','like',"%$q%");

				});
			});
		}



		if (!empty($request->get('from'))) {
			$vendors = $vendors->where('created_at', '>=', $request->get('from'));
		}

		if (!empty($request->get('to'))) {
			$vendors = $vendors->where('created_at', '<=', $request->get('to'));
		}

		if(!empty($request->get('st'))) 
		{
          $vendors = $vendors->where("status",$request->get('st'));
		}
		$vendors = $vendors->paginate(30);

		$this->layout->content = view('backend.user.vendor.index', ['vendors' => $vendors]);
		return $this->layout;
	}

	 public function getCustomers(\Illuminate\Http\Request $request){
          $customers = User::where('role', 'customer')->with('reward')->orderBy('id', 'desc');
          $customers = $customers->paginate(20);
          // echo "</pre>";
          //  print_r($customers->toJson());
          // echo "</pre>";
          // exit;
          $this->layout->content = view('backend.user.customer.index', ['customers' => $customers]);
		  return $this->layout;
          

	  }		

	  public function getCustomer($action, $id= null){
            
            switch($action){

            	case 'edit' :
            	$user = User::find($id);
            	$this->layout->content = view('backend.user.customer.form', ['user' => $user]);
            	break;

            	case 'delete':
            	if(\Auth::user()->role == 'admin'){

                      $del = User::find($id)->delete();
                      if($del){

                      	 return redirect()->back()->with(['message' => ['text' => 'User deleted successfully !', 'class' => 'alert-success']]);
                      }

                       return redirect()->back()->with(['message' => ['text' => 'Unable to delete user !', 'class' => 'alert-danger']]);

            	}else{
                         return redirect()->back()->with(['message' => ['text' => 'Unable to delete user !', 'class' => 'alert-danger']]);

            	}


            }
            return $this->layout;

	  }


	  public function getPermissions() {

		$vendorPr = VendorPermission::groupBy("type")->get();
		$permissions = $vendorPr->toArray();

		$eventPr = unserialize($permissions[1]['permissions']);
		$dealPr = unserialize($permissions[0]['permissions']);
		$productPr = unserialize($permissions[2]['permissions']);


		$this->layout->content = view('backend.user.vendor.permission',['productPr' => $productPr,"dealPr" => $dealPr, "eventPr" => $eventPr]);
		return $this->layout;

	  }

	   public function postPermissions(\Illuminate\Http\Request $request) {

	   		// Product
		    $productPr = VendorPermission::where("type","product")->first();
		    $productData = [];
		    if(!empty($request->get('product_add'))){
		    	$productData['add'] = 1;
		    }else{
		    	$productData['add'] = 0;
		    }
		     if(!empty($request->get('product_edit'))){
		    	$productData['edit'] = 1;
		    }else{
		    	$productData['edit'] = 0;
		    }
		     if(!empty($request->get('product_delete'))){
		    	$productData['delete'] = 1;
		    }else{
		    	$productData['delete'] = 0;
		    }
		    $productData = serialize($productData);
		    $productPr->permissions = $productData;
		    $productPr->save();

		    // Deal
		    $dealPr = VendorPermission::where("type","deal")->first();
		    $dealData = [];
		    if(!empty($request->get('deal_add'))){
		    	$dealData['add'] = 1;
		    }else{
		    	$dealData['add'] = 0;
		    }
		     if(!empty($request->get('deal_edit'))){
		    	$dealData['edit'] = 1;
		    }else{
		    	$dealData['edit'] = 0;
		    }
		     if(!empty($request->get('deal_delete'))){
		    	$dealData['delete'] = 1;
		    }else{
		    	$dealData['delete'] = 0;
		    }
		    $dealData = serialize($dealData);
		    $dealPr->permissions = $dealData;
		    $dealPr->save();

		    $eventPr = VendorPermission::where("type","events")->first();
		    $eventData = [];
		    if(!empty($request->get('event_add'))){
		    	$eventData['add'] = 1;
		    }else{
		    	$eventData['add'] = 0;
		    }
		     if(!empty($request->get('event_edit'))){
		    	$eventData['edit'] = 1;
		    }else{
		    	$eventData['edit'] = 0;
		    }
		     if(!empty($request->get('event_delete'))){
		    	$eventData['delete'] = 1;
		    }else{
		    	$eventData['delete'] = 0;
		    }
		    $eventData = serialize($eventData);
		    $eventPr->permissions = $eventData;
		    $eventPr->save();

		    return redirect($this->adminBase('user/permissions'))->with(['message' => $this->alert('Permissions updated.', 'alert-success')]);

	  }


	public function getVendor( $action, $id = null ) {

		if ( !in_array($action, ['create', 'edit','delete'])) {
			abort(404);
		}

		
		switch ($action) {
			case 'create':
			$this->layout->content = view('backend.user.vendor.form', ['vendor' => new User, 'page_title' => 'Create Vendor']);
			break;
			case 'edit':

			if(\Auth::user()->role == 'admin'){

			   $vendor = User::with('store')->find($id);
			}else{
				$vendor = User::with('store')->where('role', 'vendor')->find($id);
			}

			if (!$vendor) abort(404);

			$this->layout->content = view('backend.user.vendor.form', ['vendor' => $vendor, 'page_title' => 'Edit Vendor']);
			break;

			case 'delete':
			if(\Auth::user()->role == 'admin'){

				$del = User::find($id)->delete();

				if($del){

    		      return redirect()->back()->with(['message' => ['text' => 'Vendor deleted successfully !', 'class' => 'alert-success']]);
    	        }
			}
            	return redirect()->back()->with(['message' => ['text' => 'Unable to delete Vendor !', 'class' => 'alert-danger']]);
            break;

		}

		return $this->layout;

	}
    // public function getDelete($id){
    // 	$del = User::find($id)->delete();
    // 	if($del){

    // 		return redirect()->back()->with(['message' => ['text' => 'Vendor deleted successfully !', 'class' => 'alert-success']]);
    // 	}

    // 	return redirect()->back()->with(['message' => ['text' => 'Unable to delete Vendor !', 'class' => 'alert-danger']]);
           

    // }


	public function postSaveVendor(\Illuminate\Http\Request $request) {

		$vendor = new User;

		$rules = 'create';

		$redirect = $this->adminBase('user/vendor/create');

		if (!empty($request->get('id'))) {
			$vendor = User::where('role', 'vendor')->find($request->get('id'));
			$rules = 'update';
			$redirect = $this->adminBase('user/vendor/edit/' . $request->get('id') );
			if (!$vendor) {
				abort(404);
			}
		}

		$valid = \Validator::make($request->all(), User::vendorRules($rules, $vendor->id));

		if ($valid->fails()) {
			return redirect($redirect)
			->withErrors($valid)
			->withInput($request->all());
		}

				
		$vendor->username = $request->get('username');
		$vendor->password = $request->get('password');
		$vendor->email = $request->get('email');
		$vendor->status = $request->get('status', 'inactive');
		$vendor->role = 'vendor';

		if ( $vendor->save() ) {

            $resetToken = str_random(40);
            $passwordReset = new PasswordReset();
            $passwordReset->email = $vendor->email;
            $passwordReset->token = $resetToken;
            $passwordReset->created_at = date('Y-m-d H:i:s');
            $tokenUrl = \URL::to('admin/reset-password/'.$resetToken);
            if($passwordReset->save()){

                $mStatus = \Mail::send('backend.email.vendor_create',['user' => $vendor,'password' => $request->get('password')], function ($message) use($vendor){
			    $message->from('us@example.com', 'Haggler');
			    $message->subject("Haggler Vendor Information");

			    $message->to($vendor->email);
			    });

			    if($mStatus){

				return redirect($this->adminBase('user/vendors'))->with(['message' => $this->alert('Vendor saved.', 'alert-success')]);
				}

            }

			
           
		} 

		return redirect($redirect)->with(['message' => $this->alert('Unable to save vendor.', 'alert-danger')]);

	}


	public function postSaveCustomer(\Illuminate\Http\Request $request) {

		  	$valid = \Validator::make($request->all(),[
	                 'username' => 'required|unique:users,username,'.$request->get('id'),
	                 'email' => 'required|unique:users,email,'.$request->get('id')
		  		]);

		  	if($valid->fails()){

		  		 return redirect()->back()->withErrors($valid)
		  		 ->withInput($request->all());
		  	}

		  	$user = User::find($request->get('id'));
		  	$user->username = $request->get("username");
		  	$user->email = $request->get("email");
		  	$user->status = $request->get("status");

		  	if($user->save()){

		  		return redirect()->back()->with(['message' => [ 'text' => 'user saved successfully !' , 'class' => 'alert-success' ]]);
		  	}

		  	return redirect()->back()->with(['message' => [ 'text' => 'Unable to save user !' , 'class' => 'alert-danger' ]]);


	  }




	public function getProfile($id = null) {

		$user = \Auth::user();



		if ($user->role == 'vendor') {
			$user = User::where('role', 'vendor')->find($id);
		}

		if (!$user) {
			abort(404);
		}


		$this->layout->content = view('backend.user.vendor.profile', ['user' => $user]);

	}

	public function saveProfile() {

		$user = \Auth::user();



		if ($user->role == 'vendor') {
			$user = User::where('role', 'vendor')->find($request->get('id'));
		}

		if (!$user) {
			abort(404);
		}


	}

	
	
}