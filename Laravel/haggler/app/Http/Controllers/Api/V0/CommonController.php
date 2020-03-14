<?php



namespace App\Http\Controllers\Api\V0;



use \App\Models\Product;

use \App\Models\Category;

use \App\Models\Deal;

use \App\Models\Store;

use \App\Models\User;

use \App\Models\Page;

use \App\Models\Event;
use \App\Models\Contact;

use Input;

use DB;



class CommonController extends ApiController {


	public function getStores( \Illuminate\Http\Request $request ) {

		
		$s = new Store();

		$limit = $request->get('limit', 15);


		$followed = "false";

		if (Input::has('userId')) {
			$s = $s->whereNotIn('vendorId', function ($q) {
				return $q->from('store_followers')->select('vendor_id')->where('user_id', Input::get('userId'));
			});
		}
		

		$s = $s->paginate($limit);

		$stores = [];

		if (!empty($s->all())) {

			foreach ($s as $s) {

				/*if (Input::has('userId')) {
					$u = DB::table('store_followers')->select('id')->where('user_id', Input::get('userId'))->first();
					if ($u) {
						$followed = "true";
					}
				}*/

				$stores[] = [
						'vendorName' => $s->storeName,
						'vendorProfilePic' => $s->storeImage,
						'followers' => $s->followers,
						'storeDescription' => $s->storeDescription,
						'storeImage' => $s->storeImage,
						'vendorId' => $s->vendorId,
						//'followed' => $followed
					]; 
				
			}

		}

		



		return $this->response($stores);

	}


	public function getStore() {

		$id = Input::get('vendorId');



		$s = Store::where('vendorId', $id)->first();



		if (!$s){

			$this->addError('Invalid Vendor.');
			return $this->response();
		}



		$p_count = Product::where('productVendorId', $s->vendorId)->count();

		$products = Product::selectRaw('productId as id, productId, productName as name, productVendorId, productPrice as price, productDescription as description, hasOffer, offerName, offerPrice, offerStartDate, offerEndDate, productTags as tags, productThumbnail as image, productThumbnail')->where('productVendorId', $s->vendorId)->where('visible', 'yes')->take(10)->get();



		$deals = Deal::selectRaw('offerId as id, offerId, offerVendorId, offerCategoryId, offerName as name, offerHighlightedText, description, offerPrice as price, offerDiscount, offerTags as tags, offerStartDate, offerEndDate, offerDiscountType as type, offerImage as image, offerImage, originalPrice, productOfferPrice')->where('offerVendorId', $s->vendorId)->where('offerEndDate', '>=', date("Y-m-d"))->where('visible', 'yes')->take(10)->get();

		$d_count = Deal::where('offerVendorId', $s->vendorId)->where('offerEndDate', '>=', date("Y-m-d"))->count();



		$e_count = Event::where('eventVendorId', $s->vendorId)->where('eventEndDate', '>=', date("Y-m-d"))->count();

		$events = Event::selectRaw('eventId as id, eventVendorId, eventTitle as name, 	eventDescription as description, eventStartDate, eventEndDate, eventAddress, eventImage as image, eventImage')->where('eventVendorId', $s->vendorId)->where('eventEndDate', '>=', date("Y-m-d"))->where('eventStatus', 'active')->take(10)->get();

		$followed = "false";

		if (Input::has('userId')) {
			$u = DB::table('store_followers')->select('id')->where('user_id', Input::get('userId') )->where('vendor_id',$id)->first();
			if ($u) {
				$followed = "true";
			}
		}

		$store = [

			'vendorName' => $s->storeName,

			'vendorProfilePic' => $s->storeImage,

			'followers' => $s->followers,

			'storeDescription' => $s->storeDescription,

			'storeImage' => $s->storeImage,

			'vendorId' => $s->vendorId,

			'totalProducts' => $p_count,

			'totalOffers' => $d_count,

			'totalEvents' => $e_count,

			'products' => $products->toArray(),

			'deals' => $deals->toArray(),

			'events' => $events->toArray(),

			'followed' => $followed

		]; 



		return $this->response($store);

	}

	public function getProductSearch() {

		$q = \Input::get('search');

		$limit = \Input::get('limit', 20);

		$products = Product::selectRaw('productId as id, productId, productName as name, productVendorId, productPrice as price, productDescription as description, hasOffer, offerName, offerPrice, offerStartDate, offerEndDate, productTags as tags, productThumbnail as image, productThumbnail')
		->with('categories')->where('productName', 'like', "%$q%")->orWhere('productTags', 'like', "%$q%")->where('visible', 'yes')->paginate($limit);

		
		$data['products'] = $products->all();
		$data['pages'] = $products->lastPage();
		$data['count'] = $products->count();

		return $this->response($data);

	}

	public function getSearch() {

		$q = \Input::get('search');

		$products = Product::selectRaw('productId as id, productId, productName as name, productVendorId, productPrice as price, productDescription as description, hasOffer, offerName, offerPrice, offerStartDate, offerEndDate, productTags as tags, productThumbnail as image, productThumbnail')
		->with('categories')->where('productName', 'like', "%$q%")->orWhere('productTags', 'like', "%$q%")->where('visible', 'yes')->take(50)->get();

		$deals = Deal::selectRaw('offerId as id, offerId, offerVendorId, offerCategoryId, offerName as name, offerHighlightedText, description, offerPrice as price, offerDiscount, offerTags as tags, offerStartDate, offerEndDate, offerDiscountType as type, offerType, offerImage as image, offerImage')
		->with('category', 'images')->where('offerName', 'like', "%$q%")->orWhere('offerTags', 'like', "%$q%")->where('offerEndDate', '>=', date("Y-m-d"))->where('visible', 'yes')->take(50)->get();

		$events = Event::selectRaw('eventId as id, eventVendorId, eventTitle as name, 	eventDescription as description, eventStartDate, eventEndDate, eventAddress, eventImage as image, eventImage')
		->where('eventTitle', 'like', "%$q%")->orWhere('eventAddress', 'like', "%$q%")->where('eventEndDate', '>=', date("Y-m-d"))->where('eventStatus', 'active')->take(50)->get();

		//$data['vendors'] => $products->toArray();

		$data['products'] = $products->toArray();
		$data['deals'] = $deals->toArray();
		$data['events'] = $events->toArray();
		$data['vendors'] = [];

		return $this->response($data);

	}

	public function getSingleSearch() {

		$q = \Input::get('search');
		$t = \Input::get('in', 'products');
		$limit = \Input::get('limit', 15);

		switch ($t) {
			case 'vendors':
			$items = Store::selectRaw('storeId, storeName as vendorName, storeImage as vendorProfilePic, followers, storeDescription, storeImage, vendorId')->where('storeName','like',"%$q%")->orderBy('storeId', 'desc');
			break;

			case 'deals':
			$items = Deal::selectRaw('offerId as id, offerId, offerVendorId, offerCategoryId, offerName as name, offerHighlightedText, description, offerPrice as price, offerDiscount, offerTags as tags, offerStartDate, offerEndDate, offerDiscountType as type, offerType, offerImage as image, offerImage')
		->with('category', 'images')->where('offerName', 'like', "%$q%")
		->orWhere('offerTags', 'like', "%$q%")
		->where('offerEndDate', '>=', date("Y-m-d"))
		->where('visible', 'yes')
		->orderBy('offerId', 'desc');

			break;

			case 'events':
			$items = Event::selectRaw('eventId as id, eventVendorId, eventTitle as name, 	eventDescription as description, eventStartDate, eventEndDate, eventAddress, eventImage as image, eventImage')
		->where('eventTitle', 'like', "%$q%")
		->orWhere('eventAddress', 'like', "%$q%")
		->where('eventEndDate', '>=', date("Y-m-d"))
		->where('eventStatus', 'active')
		->orderBy('eventId', 'desc');

			break;

			default:
			$items = Product::selectRaw('productId as id, productId, productName as name, productVendorId, productPrice as price, productDescription as description, hasOffer, offerName, offerPrice, offerStartDate, offerEndDate, productTags as tags, productThumbnail as image, productThumbnail')
		->with('categories')
		
		->where('productName', 'like', "%$q%")
		->orWhere('productTags', 'like', "%$q%")
		->where('visible', 'yes')
		->orderBy('productId', 'desc');

			break;
		}

		
		
		if (\Input::get('orderBy')) {
			$order = 'desc';
			if (in_array(\Input::get('order'), ['asc', 'desc'])) {
				$order = \Input::get('order');
			}
			$items = $items->orderBy(\Input::get('orderBy', 'id'), $order);
		}

		//$data['vendors'] => $products->toArray();

		$items = $items->paginate($limit);
		//var_dump(json_encode($items->toArray()));
		//exit;
		$data['items'] = $items->all();
		$data['pages'] = $items->lastPage();
		$data['count'] = $items->count();
		

		return $this->response($data);

	}

	public function GetNearByDeals(\Illuminate\Http\Request $request) {

		$limit = $request->get('limit', 15);

		$distance = $request->get('distance', 1);
		$latitude = $request->get('lat');
		$longitude = $request->get('lng');

		$selectRaw = 'offerId as id, offerId, offerVendorId, offerCategoryId, offerName as name, offerHighlightedText, description, offerPrice as price, offerDiscount, offerTags as tags, offerStartDate, offerEndDate, offerDiscountType as type, offerType, offerImage as image, offerImage';

		$q = "SELECT vendorId,(((acos(sin((".$latitude."*pi()/180)) * sin((`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`lat`*pi()/180)) * cos(((".$longitude."- `lng`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance FROM `stores` HAVING distance <= $distance";
		//echo $q;
		$v = \DB::select(\DB::raw($q));


		$vendors = [];

		if (!empty($v)) {	
			foreach ($v as $i) {
				array_push($vendors, $i->vendorId);
			}
		}

		$deals = Deal::selectRaw($selectRaw)->whereIn('offerVendorId', $vendors);

		$deals = $deals->where('visible', 'yes')->where('offerEndDate','>=',date('Y-m-d'));
// print_r($deals);die;
		if ($request->has('orderBy')) {
			$order = 'desc';
			if (in_array($request->get('order'), ['asc', 'desc'])) {
				$order = $request->get('order');
			}
			$deals = $deals->orderBy($request->get('orderBy', 'id'), $order);
		}


		$deals = $deals->paginate($limit);

		$data['items'] = $deals->all();
		$data['pages'] = $deals->lastPage();
		$data['count'] = $deals->count();

		//var_dump($data);

		return $this->response($data);

	}

	public function getNearByUpdates(\Illuminate\Http\Request $request) {

		$valid = \Validator::make($request->all(), [

				'lat' => 'required|numeric',
				'lng' => 'required|numeric',
				'token'	=> 'required',
		        'device_type' => 'required|in:android,ios'

			]);



		if ($valid->fails()) {

			$this->addError('Bad request');

			return $this->response([], 401);

		}


		$limit = $request->get('limit', 15);

		$distance = $request->get('distance', 6);
		$latitude = $request->get('lat');
		$longitude = $request->get('lng');

		\Log::info(json_encode($request->all()));


		$selectRaw = 'offerId as id, offerId, offerVendorId, offerCategoryId, offerName as name, offerHighlightedText, description, offerPrice as price, offerDiscount, offerTags as tags, offerStartDate, offerEndDate, offerDiscountadmin/Type as type, offerType, offerImage as image, offerImage';

		$q = "SELECT vendorId,(((acos(sin((".$latitude."*pi()/180)) * sin((`lat`*pi()/180))+cos((".$latitude."*pi()/180)) * cos((`lat`*pi()/180)) * cos(((".$longitude."- `lng`)*pi()/180))))*180/pi())*60*1.1515*1.609344) as distance FROM `stores` HAVING distance <= $distance";
		//echo $q;
		$v = \DB::select(\DB::raw($q));

		

		$vendors = [];

		if (!empty($v)) {	
			foreach ($v as $i) {
				array_push($vendors, $i->vendorId);
			}
		}

		$deals = Deal::selectRaw($selectRaw)->with('store')->whereIn('offerVendorId', $vendors);

		$deals = $deals->where('visible', 'yes')->where('offerEndDate','>=',date('Y-m-d'));

		$d = $deals;

		$d = $d->take(4)->orderBy(\DB::raw('RAND()'));	

		$d = $d->get();

		$deals = $deals->first();
		
		$hasUpdates = true;

		if (empty($deals)) {
			$hasUpdates = false;
		}

		if ($hasUpdates) {

			if ($request->get('device_type') == 'ios') {
				$o = \PushNotification::app('appNameIOS');
			}

			if ($request->get('device_type') == 'android') {
				$o = \PushNotification::app('appNameAndroid');
				//$o = false;
			}

			if (is_object($o)) {

				$message = \PushNotification::Message('Near by offers found, Click to Check!',array(
				    
				    'meta_data' => array('type' => 'nearby','message' =>"Near by offers found, Click to Check!", "deals" => $d->toArray(),"lat" => $latitude , "lng" => $longitude  )
				));

           		$o = $o->to($request->get('token'))
            ->send($message);
        	}
		}

		file_put_contents(app_path('near_by.log'), json_encode(['request' => $request->all(), 'hasUpdates' => $hasUpdates]), FILE_APPEND);

		return $this->response([
			'hasUpdates' => $hasUpdates
			]); 


	}

	public function getPages(\Illuminate\Http\Request $request) {
		
		$pages = Page::select('slug', 'title', 'label')->paginate($request->get('limit', 20));

		$data['items'] = $pages->all();
		$data['pages'] = $pages->lastPage();
		$data['count'] = $pages->count();

		
		return $this->response($data);
	}

	public function getPage() {
		$slug = \Input::get('page');
		$page = Page::where('slug', $slug)->first();
	if (!$page) {
			$this->addError('Page not found');
			return $this->response();
		}

		return $this->response($page);
	}

	public function postContact(\Illuminate\Http\Request $request){

		
		$email  = $request->get("email");
		$name = $request->get("name");

		$v = \Validator::make($request->all(), Contact::rules());

		if ($v->fails()) {

			$this->addMessage($v->errors());

			$this->addError('Validation errors');

			return $this->response();

		}

       
          $contact = new Contact();
          $contact->message = urldecode($request->get('message', ''));
          $contact->name = $request->get("name");
          $contact->email = $request->get("email");
          $contact->subject = $request->get("subject");

          if($contact->save()){

          	  return $this->response();
          }

          $this->addError('something went wrong.');
          return $this->response();


	}



}