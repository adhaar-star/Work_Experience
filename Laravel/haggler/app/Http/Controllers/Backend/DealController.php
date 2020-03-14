<?php


namespace App\Http\Controllers\Backend;

use App\Models\BuzAlert;
use App\Models\DealCategory;
use App\Models\User;
use App\Models\Upload;
use App\Models\Deal;
use App\Models\Store;
use App\Models\DealImage;
use App\Models\SliderImage;
use DB;
use Auth;

class DealController extends BackendController {

	public function __construct() {
		parent::__construct();
	
		view()->share(['active_nav' => 'deal']);
			
	}

	public function getIndex(\Illuminate\Http\Request $request) {

		$deals = Deal::with('category', 'vendor')->orderBy('offerId', 'desc');

		if (!empty($request->get('from'))) {
			$deals = $deals->where('created_at', '>=', $request->get('from'));
		}

		if (!empty($request->get('to'))) {
			$deals = $deals->where('created_at', '>=', $request->get('to'));
		}

		if (!empty($request->get('q'))) {

               $q = $request->get('q');
               $deals = $deals->where(function($w) use($q){
                   return $w->where('offerName','like',"%$q%")
                   ->orWhere('offerId',$q)
                   ->orWhereIn('offerVendorId',function($query) use($q){

                   	  $query->select('vendorId')->from('stores')
                   	  ->where('storeName','like',"%$q%");
                   });
               });

		}

		if (!empty($request->get('vendor'))) {
			$deals = $deals->where('offerVendorId', $request->get('vendor'));
		}

		if (\Auth::user()->role === 'admin') {
			$deals = $deals->paginate(10);
		} else {
		  	$deals = $deals->where('offerVendorId', \Auth::id())->paginate(10);
		}



		$this->layout->content = view('backend.deals.index', ['deals' => $deals]);
		return $this->layout;
	}
	
	public function getCreate() {

		$deal = new Deal;
	
		$vendors = User::with('store')->where('role', 'vendor')->get();
		$adminVendor = User::with('store')->where('role', 'admin')->get();
		$categories = DealCategory::orderBy('categoryName', 'asc')->get();

		$this->layout->content = view('backend.deals.form', ['deal' => $deal, 'vendors' => $vendors, 'adminVendor' => $adminVendor, 'categories' => $categories->all(), 'page_title' => 'New Deal']);
		return $this->layout;

	}

	public function getEdit( $id ) {

		if (\Auth::user()->role === 'admin') {
			$deal = Deal::with('images')->find($id);
		} else{
			$deal = Deal::with('images')->where('offerVendorId', \Auth::id())->find($id);
		}

		if (!$deal) abort(404);

		$vendors = User::with('store')->where('role', 'vendor')->get();
		$adminVendor = User::with('store')->where('role', 'admin')->get();

		$categories = DealCategory::orderBy('categoryName', 'asc')->get();

		$sliderImage =SliderImage::where('type','deal')->where('type_id',$id)->first();

		$this->layout->content = view('backend.deals.form', ['deal' => $deal, 'vendors' => $vendors,'adminVendor' => $adminVendor,'categories' => $categories->all(), 'page_title' => 'Edit Deal','sliderImage' => $sliderImage]);

		return $this->layout;


	}

	public function postSave(\Illuminate\Http\Request $request) {

		$deal = new Deal;

		$rules = 'create';

		$redirect = $this->adminBase('deal/create');


		if (!empty($request->get('offerId'))) {

			$id = $request->get('offerId');

			if (\Auth::user()->role === 'admin') {
					$deal = Deal::find($id);
				} else{
					$deal = Deal::where('offerVendorId', \Auth::id())->find($id);
				}

			
			$redirect = $this->adminBase('deal/edit/' . $request->get('offerId') );
			$rules = 'update';

			if (!$deal) {
				abort(404);
			}
		}

		$valid = \Validator::make($request->all(), Deal::rules($rules, $request->get('offerId')));

		if ($valid->fails()) {
			return redirect($redirect)
			->withErrors($valid)
			->withInput($request->except(['image_1', 'image_2', 'image_3', 'image_4']));
		}

		try {
			
			DB::beginTransaction();
			

			$image_1 = Upload::move('deal', $request, 'image_1');
			$image_2 = Upload::move('deal', $request, 'image_2');
			$image_3 = Upload::move('deal', $request, 'image_3');
			$image_4 = Upload::move('deal', $request, 'image_4');

			if (\Auth::user()->role === 'admin') {
				$deal->offerVendorId = $request->get('offerVendorId');
				$deal->visible = "yes";
			} else{
				$deal->offerVendorId = \Auth::id();
				$deal->visible = "no";
			}

			

			$deal->offerCategoryId = $request->get('offerCategoryId');
			$deal->offerName = $request->get('offerName');
			$deal->description = $request->get('description');
			
			$deal->offerType = $request->get('offerType');
			$deal->originalPrice = $request->get('originalPrice');
			$deal->productOfferPrice = $request->get('productOfferPrice');
			
			$deal->offerHighlightedText = $request->get('offerHighlightedText');
			$deal->offerDiscount = $request->get('offerDiscount');
			$deal->offerDiscountType = $request->get('offerDiscountType');
			$deal->offerPrice = $request->get('offerPrice');
			$deal->offerTags = $request->get('offerTags');
			$deal->offerStartDate = $request->get('offerStartDate');
			$deal->offerEndDate = $request->get('offerEndDate');
			$deal->offerStatus = $request->get('offerStatus', 0);
			$deal->offerTerms = $request->get('offerTerms');

			
			if ($image_1) {
				$deal->offerImage = $image_1;
			}

			$deal->save();


			 /********** add Deal slider **********/
			if($request->get('slider_on') == 'on'){

			if(!empty($request->file('slider_image'))){

                  $sliderImage = $request->file('slider_image');
                  $destinationPath = 'slider_images';
                  $extension = $sliderImage->getClientOriginalExtension();
                  $sliderImageName = 'slider-'.time().".".$extension;
                  $sUpload = $sliderImage->move($destinationPath, $sliderImageName);
                  if($sUpload){
                     	$sI = new SliderImage;

	                  	if(!empty($request->get('offerId'))){

	                  		$sI = SliderImage::where('type','deal')->where('type_id',$request->get('offerId'))->first();
	                  		if(empty($sI)){
	                  			$sI = new SliderImage;
	                  		}

	                  	 }

	                  	 
	                  	 $sI->type = 'deal';
	                  	 $sI->type_id = $deal->offerId;
	                  	 $sI->slider_image = url('slider_images/'.$sliderImageName);
	                  	 $sI->save();

                  }
			}

		}

		   /***** end  Deal slider *******************/

			$dealImage = DealImage::where('deal_id')->first();

			if ($dealImage) {
				$dealImage = DealImage::find($dealImage->id);
				
			} else {
				$dealImage = new DealImage();
				$dealImage->deal_id = $deal->offerId;
			}

			$dealImage->image_1 = $image_1;
			$dealImage->image_2 = $image_2;
			$dealImage->image_3 = $image_3;
			$dealImage->image_4 = $image_4;
			$dealImage->save();

			DB::commit();

			$commited = true;
				
			
		} catch (\Exception $e) {


			DB::rollback();

			echo $e;
			exit;

			$commited = false;
		}

		if ($commited) {
            if (empty($request->get('offerId'))) {
                BuzAlert::add(Auth::user(), 'deal', $deal->offerId);
            }
			return redirect($this->adminBase('deal'))->with(['message' => $this->alert('Deal saved.', 'alert-success')]);
		}

		return redirect($redirect)
		->with(['message' => $this->alert('Unable to save deal.', 'alert-danger')])
		->withInput($request->except('image_1', 'image_2', 'image_3', 'image_4'));
			

	}

	public function getDelete($id) {

		$deal = Deal::find($id);

		if (!$deal) {
			abort(404);
		}
		
		$deal ->delete();
		SliderImage::where('type_id',$id)->where('type','deal')->delete();

		if(\Input::get('home'))
			return redirect($this->adminBase('dashboard'))->with(['message' => $this->alert("Deal deleted successfully.", 'alert-success')]);

		return redirect($this->adminBase('deal'))->with(['message' => $this->alert('Deal deleted successfully.', 'alert-success')]);

	}

	public function getVisibility($status, $id) {

		$deal = Deal::find($id);
		$isAdmin = \Auth::user()->role;

		if (!$deal || $isAdmin !== 'admin') {
			abort(404);
		}

		switch ($status) {
			case 'visible':
			$deal->visible = 'yes';
				$act = 'approved';
			break;
			case 'hidden' :
				$act = 'unapproved';
				$deal->visible = 'no';
			break;
		}

		$deal->save();
		if(\Input::get('home'))
			return redirect($this->adminBase('dashboard'))->with(['message' => $this->alert("Deal $act successfully.", 'alert-success')]);

		return redirect()->back()->with(['message' => $this->alert("Deal $act successfully.", 'alert-success')]);


	}
	
}