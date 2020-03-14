<?php

namespace App\Http\Controllers\Api\V0;

use \App\Models\Deal;
use \App\Models\DealCategory;
use App\Models\Store;
use \App\Models\UserDeal;

class DealController extends ApiController {
	
	public function getCategories( \Illuminate\Http\Request $request ) {

		$category = DealCategory::selectRaw('categoryId as id, categoryName as name, categoryImage');

		$order = 'asc';

		if ($request->has('orderBy')) {
			$order = 'desc';
			if (in_array($request->get('order'), ['asc', 'desc'])) {
				$order = $request->get('order');
			}
			
		}

		$category = $category->orderBy($request->get('orderBy', 'name'), $order);


		$results = $category->get();

		
		return $this->response($results->toArray());

	}
	
	public function getList( \Illuminate\Http\Request $request ) {

		$limit = $request->get('limit', 15);

		$deals = Deal::with('category', 'store', 'images')->selectRaw('offerId as id, offerId, offerVendorId, offerCategoryId, offerName as name, offerHighlightedText, description, offerPrice as price, offerDiscount, offerTags as tags, offerStartDate, offerEndDate, offerDiscountType as type, offerType, offerImage as image, offerImage, originalPrice, productOfferPrice');

		if ($request->has('vendorId')) {
			$deals = $deals->where('offerVendorId', $request->get('vendorId'));
		}

		if ($request->has('categoryId')) {
			$deals = $deals->where('offerCategoryId', $request->get('categoryId'));
		}

		$order = 'desc';

		if ($request->has('orderBy')) {
			$order = 'desc';
			if (in_array($request->get('order'), ['asc', 'desc'])) {
				$order = $request->get('order');
			}
			
		}
		

		$deals = $deals->where('offerEndDate', '>=', date("Y-m-d"))->where("visible","yes")->orderBy($request->get('orderBy', 'id'), $order);

		$deals = $deals->paginate($limit);

		$data['items'] = $deals->all();
		$data['pages'] = $deals->lastPage();
		$data['count'] = $deals->count();

		//var_dump($data);

		return $this->response($data);


	}

	public function getView() {

	
		$id = \Input::get('offerId');

		$deal = Deal::with('images')->selectRaw('offerId as id, offerId, offerVendorId, offerName as name, offerHighlightedText, description, offerPrice as buyPrice,originalPrice as originalPrice,productOfferPrice as discountedPrice, offerDiscount as discount, offerStartDate, offerEndDate, offerDiscountType as type, offerTerms, offerImage, offerType, originalPrice, productOfferPrice')->where('offerId', $id)->first();

		if (!$deal) abort(404);

		$otherDeals = Deal::selectRaw('offerId as id, offerId, offerVendorId, offerName as name, offerHighlightedText, description, offerPrice as price, offerDiscount as discount, offerStartDate, offerEndDate, offerDiscountType as type, offerImage, offerType, originalPrice, productOfferPrice')->where('offerVendorId', $deal->offerVendorId)->where('offerId','!=',$id)->take(10)->get();

		$store = Store::where('vendorId', $deal->offerVendorId)->first();

		$d = UserDeal::where('user_id', \Auth::id())->where('deal_id', $id)->first();

		$followed = false;

		if ($d) {
			$followed = true;
		}
         $address = $deal->store->address;
		
$products[]=Product::selectRaw('productId,productThumbnail,productName,productPrice')->where('productId',$likes[0]['productId'])->get();
			


		return $this->response(array_merge($deal->toArray(), ['dealVendorName' => $store->storeName, 'profileImage' => $store->getstoreImage(), 'otherVendorDeals' => $otherDeals, 'followed' => $followed, 'address' => $address ]));

	}

	
}