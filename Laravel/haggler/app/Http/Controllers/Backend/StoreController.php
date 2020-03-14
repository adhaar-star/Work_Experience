<?php


namespace App\Http\Controllers\Backend;

use App\Models\User;
use App\Models\Upload;
use App\Models\Store;

class StoreController extends BackendController {

	public function __construct() {
		parent::__construct();
	
		view()->share(['active_nav' => 'store']);
			
	}

	public function getCreate() {

		$store = new Store();
		
		$this->layout->content = view('backend.user.store.form', ['store' => $store, 'page_title' => 'Setup Store']);
		return $this->layout;
	}

	public function getEdit($id) {

		$store = new Store();

		if (\Auth::user()->role == 'vendor') {
			$store = $store->where('vendorId', \Auth::id());
		}

		$store = $store->find($id);

		if (!$store) {
			return redirect()->back()->with(['message' => $this->alert('No store found for this vendor.', 'alert-danger') ]);
		}

		$this->layout->content = view('backend.user.store.form', ['store' => $store, 'page_title' => $store->storeName]);
		return $this->layout;
	}

	

	public function postSave(\Illuminate\Http\Request $request) {

		$store = new Store;

		$rules = 'create';

		$redirect = $this->adminBase('store/create');

		if (!empty($request->get('storeId'))) {

			$id = $request->get('storeId');
			
			if (\Auth::user()->role == 'vendor') {
				$store = $store->where('vendorId', \Auth::id());
			}

			$store = $store->find($id);



			$rules = 'update';
			$redirect = $this->adminBase('store/edit/' . $request->get('id') );
			if (!$store) {
				abort(404);
			}
		}

		$valid = \Validator::make($request->all(), Store::rules($rules, $store->storeId));

		if ($valid->fails()) {
			return redirect()->back()
			->withErrors($valid)
			->withInput($request->all());
		}

		$storeImage = Upload::move('store', $request, 'storeImage');;
		if(empty($request->get('storeId'))){
			$store->vendorId = \Auth::id();
		}	
		$store->storeName = $request->get('storeName');
		$store->storeDescription = $request->get('storeDescription');
		$store->address = $request->get('address');
		$store->city = $request->get('city');
		$store->state = $request->get('state');
		$store->lat = $request->get('lat');
		$store->lng = $request->get('lng');

		if ($storeImage) {
			$store->storeImage = $storeImage;
		}

		if ( $store->save() ) {
            return redirect()->back()->with(['message' => [ 'text' => 'Store saved successfully !' , 'class' => 'alert-success' ]]);
		} 

		return redirect($redirect)->with(['message' => $this->alert('Unable to setup store.', 'alert-danger')]);

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