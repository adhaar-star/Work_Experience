<?php



namespace App\Http\Controllers\Api\V0;



use \App\Models\Product;
use \App\Models\ProductLike;

use \App\Models\Category;

use \App\Models\Deal;

use \App\Models\Store;
use \App\Models\Slider;
use \App\Models\VendorPincode;
use \App\Models\SliderImage;




class ProductController extends ApiController {

	

	public function getHomeItems() {



		$product = Product::selectRaw('productId as id, productId, productName as name, productDescription as description, productPrice as price,productQuantity as quantity, productThumbnail as image, productThumbnail, productTags as tags, hasOffer, offerName, offerPrice, offerStartDate, offerEndDate')->where('visible', 'yes')->orderBy('productId','desc')->where('product_of_the_day','yes')->get();

		$deal = Deal::with('images')->take(10)->selectRaw('offerId as id, offerName as name, description, offerPrice as buyPrice,originalPrice as originalPrice,productOfferPrice as discountedPrice, offerDiscount, offerTags as tags, offerStartDate, offerEndDate, offerDiscountType as type, offerImage, offerType, offerHighlightedText')->orderBy('offerId','desc');
		$deal = $deal->where('offerEndDate', '>=', date("Y-m-d"))->where("visible","yes")->where('deal_of_the_day','yes')->get();

        $sliderImages = SliderImage::selectRaw('type_id as id,type,slider_image as image')->get();

		$data['products'] = $product;

		$data['deals'] = $deal;

		$slider = Slider::first();



		$data['sliderImages'] = $sliderImages;//$slider->meta_data;
		/*$data['sliderImages'] = [ "http://haggler.in/DealsImages/5600241e8c8f9_sliderImages_1442849822.jpg",

									"http://haggler.in/DealsImages/55ee4e1ed20bb_sliderImages_1441680926.jpg",

									"http://haggler.in/DealsImages/55f2e941a8e81_sliderImages_1441982785.jpg",

									"http://haggler.in/DealsImages/55ff68c92bebb_sliderImages_1442801865.jpg",

									"http://haggler.in/DealsImages/5600263503334_sliderImages_1442850357.jpg",

									"http://haggler.in/DealsImages/560026ba3b120_sliderImages_1442850490.jpg"];

*/



		return $this->response($data);



	}

	

	public function getCategories(\Illuminate\Http\Request $request) {

		$category = Category::with('subCat')->selectRaw('categoryId as id, categoryId, categoryName as name, categoryParentId, categoryImage');
		$category2 = Category::with('subCat')->selectRaw('categoryId as id, categoryId, categoryName as name, categoryParentId, categoryImage');



		if ($request->has('categoryParentId')) {

			$category = $category->where('categoryParentId', $request->get('categoryParentId', 0));
			$category2 = $category2->where('categoryParentId', $request->get('categoryParentId', 0));

		} else {

			$category = $category->where('categoryParentId', 0);
			$category2 = $category2->where('categoryParentId', 0);

		}



		$order = 'asc';



		if ($request->has('orderBy')) {

			

			if (in_array($request->get('order'), ['asc', 'desc'])) {

				$order = $request->get('order');

			}

			

		}



		//$category = $category->orderBy($request->get('orderBy', 'name'), $order);
		$ids = array(236,237,238);

        $ids_ordered = implode(',', $ids);
		$category = $category->WhereIn('categoryId',$ids)->orderByRaw(\DB::raw("FIELD(id, $ids_ordered)"))->get();
		$category2 = $category2->whereNotIn('categoryId',$ids)->orderBy($request->get('orderBy', 'name'), $order)->get();
		// echo "<pre>";
		//  print_r($category2);
		// echo "</pre>";
		// exit;
		

		
		

 



		//$limit = $request->get('limit', 15);



		//$results = $category->paginate($limit);



		$data['items'] = array_merge($category->toArray(),$category2->toArray());

		$data['pages'] = 1;

		$data['count'] = 1;



		return $this->response($data);



	}



	public function getList(\Illuminate\Http\Request $request) {



            $product = Product::selectRaw('productId as id, productId, productVendorId, productName as name, productDescription as description, productPrice as price, productThumbnail as image, productThumbnail, productTags as tags, hasOffer, offerName, offerPrice, offerStartDate, offerEndDate');



		/*$product = $product->with(['categories' => function ($q) {

			return $q->with(['category' => function ($q2) {

				return $q2->selectRaw('categoryId, categoryId as catId, categoryName as catName');

			}]);

		}]);*/



		$product = $product->with('categories')->where('visible', 'yes');



		if ($request->has('vendorId')) {

			$product = $product->where('productVendorId', $request->get('vendorId'));

		}



		if ($request->has('catId')) {

			$product = $product->whereIn('productId', function ($q) {

				return $q->select('productId')

				->from('product_categories')

				->whereIn('categoryId', explode(',', \Input::get('catId')));

			});

		}



		$order = 'desc';



		if ($request->has('orderBy')) {

			$order = 'desc';

			if (in_array($request->get('order'), ['asc', 'desc'])) {

				$order = $request->get('order');

			}

			

		}



		$product = $product->orderBy($request->get('orderBy', 'id'), $order);



		$limit = $request->get('limit', 15);



		$results = $product->get();



		$data['items'] = $results->all();

		$data['pages'] = 1;

		$data['count'] = $results->count();	



		return $this->response($data);



	}



	public function getView() {


		$id = \Input::get('productId');
         		$user_id = \Input::get('user_id');



		$product = Product::with('product_attributes','images')->selectRaw('productId as id, productId, productVendorId, productName as name, productDescription as description, productPrice as price,productQuantity as quantity, productThumbnail as image, productThumbnail, productTags as tags, hasOffer, offerName, offerPrice, offerStartDate, offerEndDate')->find($id);


	$product_formated = [];	
		$likes = $product->likes()->select('likes')->where('user_id',$user_id)->get();
		//echo $likes[0]['likes'];die;
		
	if(isset($likes[0])){
			$product_formated['likes'] = $likes[0]['likes'];
	}
		else{
		$product_formated['likes'] = 0;
			
		}
		if (!$product) abort(404);
//$productdetails=$product->likes;



	
		

//echo $product->likes->user_id;die;
		foreach ($product->toArray() as $field => $value) {
	
			if ($field == 'product_attributes' && !empty($value) && is_array($value)) {

					$product_formated['product_attributes']['color'] = [];

					$product_formated['product_attributes']['size'] = [];

					foreach ($value as $attr) {

						if ($attr['key_name'] == 'color') {



							array_push($product_formated['product_attributes']['color'] , [$attr]);

						}

						if ($attr['key_name'] == 'size') {

							array_push($product_formated['product_attributes']['size'] , [$attr]);

						}

					}



			} else {
if($field!="likes"){
				$product_formated[$field] = $value;
}
			}

		}



		$otherVendorProducts = Product::selectRaw('productId as id, productId, productVendorId, productName as name, productDescription as description, productPrice as price, productThumbnail as image, productThumbnail, productTags as tags, hasOffer, offerName, offerPrice, offerStartDate, offerEndDate');



		$otherVendorProducts = $otherVendorProducts->with('categories')->where('productVendorId', $product_formated['productVendorId'])->where('visible', 'yes')->where('productId','!=',$id)->take(10)->get();




//$likes = ProductLike::selectRaw('likes as likes')->where("productId",$id)->where("user_id",79)->get();



		$vendorName = Store::where('vendorId', $product_formated['productVendorId'])->pluck('storeName');

		$vendorName = Store::where('vendorId', $product_formated['productVendorId'])->pluck('storeName');


		$product_formated['otherVendorProducts'] = $otherVendorProducts->toArray();

		$product_formated['productVendorName'] = empty($vendorName) ? 'Haggler' :  $vendorName;
		$product_formated['vendorPincodes'] = VendorPincode::where('vendorId',$product_formated['productVendorId'])->get();

$product_formated['profileImage'] = null;

		$product_formated['categories'] = Category::selectRaw('categoryName as catName, categoryId as catId')->whereIn('categoryId', function ($q) use($product) {

			return $q->select('categoryId')->from('product_categories')->where('productId', $product->productId);

		})->get();
//$array = ["productId"=>$id,"user_id"=>79];
		




		
return $this->response($product_formated);


	}

public function productLikes(\Illuminate\Http\Request $request){
$product = new ProductLike;
	
	$likestatus = $request->get('likestatus');
$product->productId = $request->get('productId');
			$product->user_id = $request->get('user_id');
	if($likestatus==1){
		$query=$product->select('productId','user_id','likes')->where('user_id',$request->get('user_id'))->where('productId',$request->get('productId'))->get();
		if(isset($query[0])){
		$newlikes=$query[0]['likes'];
		

		if($query && $newlikes==0){
			$product->where('productId',$request->get('productId'))->where('user_id',$request->get('user_id'))->update(array('likes' => 1));
		
		}
		}
		else {
			//$product->likes = 1;
					//$product->save();
		$product->insert(
     array(
            'user_id'     =>   $request->get('user_id'), 
		    'productId'  =>    $request->get('productId'),
            'likes'   =>   $request->get('likestatus')
     )
		
);
		}
	$data['message']='Product liked successfully';

	}
	else{
		$product->where('productId',$request->get('productId'))->where('user_id',$request->get('user_id'))->update(array('likes' => 0));
	//	$product->where('productId', $request->get('productId'))->where('user_id',$request->get('user_id'))->delete();
					$data['message']='Product disliked successfully';

	}
	
return $this->response($data);
}



public function getproductLikes(\Illuminate\Http\Request $request) {
			$user_id= $request->get('user_id');

$array= new ProductLike;

           // $products = ProductLike::selectRaw('productId, likes');
$joinarray=array('product_likes.user_id'=>$user_id,'product_likes.likes'=>1);

	$products= $array
            ->join('products', 'product_likes.productId', '=', 'products.productId')
            ->select('product_likes.likes','products.productId','products.productName', 'products.productThumbnail','products.productPrice')
		    ->where($joinarray)
            ->get();
	

		/*$product = $product->with(['categories' => function ($q) {

			return $q->with(['category' => function ($q2) {

				return $q2->selectRaw('categoryId, categoryId as catId, categoryName as catName');

			}]);

		}]);*/

//print_()





		//$product = $product->orderBy($request->get('orderBy', 'id'), $order);



		$limit = $request->get('limit', 15);



		//$results = $products->get();



		$data['items'] = $products->all();

		$data['pages'] = 1;

		$data['count'] = $products->count();	



		return $this->response($data);



	}

}