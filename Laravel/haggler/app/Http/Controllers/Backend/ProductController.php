<?php

namespace App\Http\Controllers\Backend;

use App\Models\BuzAlert;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductMedia;
use App\Models\Upload;
use App\Models\User;
use App\Models\ProductCategory;
use App\Models\ProductAttribute;
use App\Models\SliderImage;
use DB;
use Auth;

class ProductController extends BackendController {

	public function __construct() {
		parent::__construct();
	
		view()->share(['active_nav' => 'product']);
			
	}
	
	public function getIndex(\Illuminate\Http\Request $request) {

		$pr = $request->get("productPermission");


		// if($pr['view'] != 1)
		// 	return redirect('vendor/dashboard')->with(['message' => $this->alert('Unable to access product.', 'alert-danger')]);

		$product = new Product();

		$products = $product->with('store', 'categories');


		if (!empty($request->get('from'))) {
			$products = $products->where('created_at', '>=', $request->get('from'));
		}

		if (!empty($request->get('to'))) {
			$products = $products->where('created_at', '<=', $request->get('to'));
		}


		if (!empty($request->get('q'))) {

			$q = $request->get('q');

			$products = $products->where(function ($w) use($q) {
				return $w->where('productName', 'like', "%$q%")
				->orWhere('offerName', 'like', "%$q%")
				->orWhere('productTags', 'like', "%$q%")
				->orWhere('productDescription', 'like', "%$q%")
				->orWhereIn('productVendorId',function($query) use($q){
					$query->select('vendorId')->from('stores')
					->where('storeName','like',"%$q%");
				});
			});
		}

		if (!empty($request->get('vendor'))) {
			$products = $products->where('productVendorId', $request->get('vendor'));
		}



		if (\Auth::user()->role === 'admin') {
			 $products = $products->orderBy('productId', 'desc');
		} else {
		  $products = $products->where('productVendorId', \Auth::id())->orderBy('productId', 'desc');
		}

		$products = $products->paginate(30);
		

		$this->layout->content = view('backend.product.index', ['products' => $products]);
		return $this->layout;
	}

	public function getCreate() {

	


		$categories = Category::where('categoryParentId', 0)->get();
		$vendors = User::with('store')->where('role', 'vendor')->get();
		$adminVendor = User::with('store')->where('role', 'admin')->get();
		$this->layout->content = view('backend.product.form', ['product' => new Product,'vendors' => $vendors, 'adminVendor' => $adminVendor,  'categories' => $categories, 'page_title' => 'New Product']);
		return $this->layout;

	}

	public function getEdit( $productId ) {

		$product = new Product();

		$product = $product->with('categories', 'product_attributes', 'images');
		$vendors = User::with('store')->where('role', 'vendor')->get();
		$adminVendor = User::with('store')->where('role', 'admin')->get();

		$categories = Category::where('categoryParentId', 0)->get();

		if (\Auth::user()->role === 'admin') {
			$product = $product->find($productId);
		} else{
			$product = $product->where('productVendorId', \Auth::id())->find($productId);
		}

		if (!$product) abort(404);

		 $sliderImage =SliderImage::where('type','product')->where('type_id',$productId)->first();

		$this->layout->content = view('backend.product.form', ['product' => $product, 'categories' => $categories,'vendors' => $vendors, 'adminVendor' => $adminVendor, 'page_title' => 'Edit Product','sliderImage' => $sliderImage]);

		return $this->layout;

	}

	public function getSecondLevelCat(\Illuminate\Http\Request $request){

		$secondLevelCat = Category::where('categoryParentId',$request->get('p_id'))->get();
		return response()->json($secondLevelCat);
	}

	public function getThirdLevelCat(\Illuminate\Http\Request $request){

		$thirdLevelCat = Category::where('categoryParentId',$request->get('s_id'))->get();
		return response()->json($thirdLevelCat);

	}

	public function postSave(\Illuminate\Http\Request $request) {



		$redirect = $this->adminBase('product/create');

		try {
			
			DB::beginTransaction();
			$product = new Product;

			$rules = 'create';
			if (!empty($request->get('productId'))) {

				$rules = 'update';

				$productId = $request->get('productId');

				if (\Auth::user()->role === 'admin') {
					$product = $product->with('categories', 'product_attributes')->find($productId);
					$redirect = $this->adminBase('product/edit/' . $productId);
				} else{
					$product = $product->with('categories', 'product_attributes')->where('productVendorId', \Auth::id())->find($productId);
				}
			}

			if (!$product) abort(404);

			$valid = \Validator::make($request->all(), Product::rules($rules, $request->get('productId')));

			if ($valid->fails()) {
				return redirect($redirect)
				->with(['message' => $this->alert('There are some validation error.', 'alert-danger')])
				->withErrors($valid)
				->withInput($request->except('producThumbnail', 'productImage1', 'productImage2', 'productImage3', 'productImage4', 'productImage5'));
			}

			$thumbnail = Upload::move('product', $request, 'productThumbnail');
			$image1 = Upload::move('product', $request, 'productImage1');
			$image2 = Upload::move('product', $request, 'productImage2');
			$image3 = Upload::move('product', $request, 'productImage3');
			$image4 = Upload::move('product', $request, 'productImage4');
			$image5 = Upload::move('product', $request, 'productImage5');

		
			$product->productVendorId = $request->get('productVendorId');
			$product->productName = $request->get('productName');
		
			if (!empty($thumbnail)) {
				$product->productThumbnail =$thumbnail;
			}
		
			$product->productPrice = $request->get('productPrice');
			$product->productQuantity = $request->get('productQuantity');
			$product->hasOffer = $request->get('hasOffer', 'no');
			$product->offerName = $request->get('offerName');
			$product->offerPrice = $request->get('offerPrice');
			$product->offerStartDate = $request->get('offerStartDate');
			$product->offerEndDate = $request->get('offerEndDate');
			$product->productDescription = $request->get('productDescription');
			$product->productTags = $request->get('productTags');

			if (Auth::user()->role == 'admin') {
				$product->visible = "yes";
			} else {
				$product->visible = "no";
			}

			$product->save();

			$media = ProductMedia::where('productId', $product->productId)->first();
			if (!$media) {
				$media = new ProductMedia();
				$media->productId = $product->productId;
			}

			if (!empty($image1)) {
				$media->productImage1 = $image1;
			}

			if (!empty($image2)) {
				$media->productImage2 = $image2;
			}
			if (!empty($image3)) {
				$media->productImage3 = $image3;
			}
			if (!empty($image4)) {
				$media->productImage4 = $image4;
			}
			if (!empty($image5)) {
				$media->productImage5 = $image5;
			}

			$media->save();

			ProductCategory::where('productId', $product->productId)->delete();

			// if (!empty($request->get('categoryIds'))) {
			// 	$categories = [];

			// 	foreach ($request->get('categoryIds') as $cat_id) {
			// 		array_push($categories, ['productId' => $product->productId, 'categoryId' => $cat_id]);
			// 	}

			// 	ProductCategory::insert($categories);
			// }

			if(!empty($request->get('p_cat'))){
				$categories = [];
				array_push($categories,['productId' => $product->productId, 'categoryId' => $request->get('p_cat')]);
			}

			if(!empty($request->get('s_cat'))){
				array_push($categories,['productId' => $product->productId, 'categoryId' => $request->get('s_cat')]);
			}

			if(!empty($request->get('t_cat'))){
				array_push($categories,['productId' => $product->productId, 'categoryId' => $request->get('t_cat')]);
			}

			if(!empty($categories)){

				ProductCategory::insert($categories);
			}
           /********** add product slider **********/
			if($request->get('slider_on') == 'on'){

			if(!empty($request->file('slider_image'))){

                  $sliderImage = $request->file('slider_image');
                  $destinationPath = 'slider_images';
                  $extension = $sliderImage->getClientOriginalExtension();
                  $sliderImageName = 'slider-'.time().".".$extension;
                  $sUpload = $sliderImage->move($destinationPath, $sliderImageName);
                  if($sUpload){
                     	$sI = new SliderImage;

	                  	if(!empty($request->get('productId'))){

	                  		$sI = SliderImage::where('type','product')->where('type_id',$request->get('productId'))->first();
	                  		if(empty($sI)){
	                  			$sI = new SliderImage;
	                  		}

	                  	 }

	                  	 
	                  	 $sI->type = 'product';
	                  	 $sI->type_id = $product->productId;
	                  	 $sI->slider_image = url('slider_images/'.$sliderImageName);
	                  	 $sI->save();

                  }
			}

		}

		   /***** end  product slider *******************/

			ProductAttribute::where('productId', $product->productId)->delete();

			$colors = $request->get('color');

			$sizes = $request->get('size');

			$attributes = [];

			if (!empty($colors)) {
				$colors = explode(',', $colors);

				foreach ($colors as $color) {
					array_push($attributes, ['productId' => $product->productId, 'name' => 'Color', 'key_name' => 'color', 'value' => $color]);
				}
			}

			if (!empty($sizes)) {
				$sizes = explode(',', $sizes);

				foreach ($sizes as $size) {
					array_push($attributes, ['productId' => $product->productId, 'name' => 'Size', 'key_name' => 'size', 'value' => $size]);
				}
			}

			if (!empty($attributes)) {
				ProductAttribute::insert($attributes);
			}

			DB::commit();

			$commited = true;


		} catch (\Exception $e) {
			DB::rollback();
			$commited = false;
		}
			

		if ($commited) {
            if (empty($request->get('productId'))) {

                BuzAlert::add($product->vendor, 'product', $product->productId);
            }
			return redirect($this->adminBase('product'))->with(['message' => $this->alert('Product saved successfully.', 'alert-success')]);

		}

		return redirect($this->adminBase('product/create'))->with(['message' => $this->alert('Unable to save product.', 'alert-danger')]);


	}

	public function getDelete($id) {

		$product = Product::find($id);

		if (!$product) {
			abort(404);
		}
		
		$product ->delete();
		SliderImage::where('type_id',$id)->where('type','product')->delete();

		if(\Input::get('home'))
			return redirect($this->adminBase('dashboard'))->with(['message' => $this->alert("Product deleted successfully.", 'alert-success')]);

		return redirect($this->adminBase('product'))->with(['message' => $this->alert('Product deleted successfully.', 'alert-success')]);

	}

	public function getVisibility($status, $id) {

		$product = Product::find($id);
		$isAdmin = \Auth::user()->role;

		if (!$product || $isAdmin !== 'admin') {
			abort(404);
		}

		switch ($status) {
			case 'visible':
			$product->visible = 'yes';
				$act = 'enabled';
			break;
			case 'hidden' :
				$act = 'disabled';
				$product->visible = 'no';
			break;
		}

		$product->save();
		if(\Input::get('home'))
			return redirect($this->adminBase('dashboard'))->with(['message' => $this->alert("Product $act successfully.", 'alert-success')]);

		return redirect($this->adminBase('product'))->with(['message' => $this->alert("Product $act successfully.", 'alert-success')]);


	}


	public function getProductOfTheDay($status, $id) {

		$product = Product::find($id);
		$isAdmin = \Auth::user()->role;

		if (!$product || $isAdmin !== 'admin') {
			abort(404);
		}

		switch ($status) {
			case 'unmark':
			$product->product_of_the_day = 'no';
				$act = 'removed from product of the day list';
			break;
			case 'mark' :
				$act = 'added to product of the day list';
				$product->product_of_the_day = 'yes';
			break;
		}

		$product->save();

		return redirect($this->adminBase('product'))->with(['message' => $this->alert("Product $act successfully.", 'alert-success')]);


	}


}