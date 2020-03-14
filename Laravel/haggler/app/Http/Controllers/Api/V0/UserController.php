<?php



namespace App\Http\Controllers\Api\V0;



use \App\Models\Address;
use \App\Models\Store;
use \App\Models\Deal;
use \App\Models\Event;
use \App\Models\BuzAlert;
use \App\Models\Product;
use \App\Models\Cart;
use \App\Models\User;
use \App\Models\UserDeal;
use \App\Models\Message;
use \App\Models\MessageThread;
use \App\Models\Order;
use \App\Models\RewardPoint;
use \App\Models\OrderItem;
use \App\Models\OrderPayment;
use \App\Models\Wallet;
use \App\Models\Category;
use Mail;
use \DB;
use \Hash;
use \Auth;



class UserController extends ApiController {

	protected $disableSecurity = false;

	public function updateDeviceInfo(\Illuminate\Http\Request $request) {
		$user = Auth::user();
		$user->device_id = $request->get('device_id');
		$user->device_type = $request->get('device_type');
		$user->save();
		return $this->response();
	}

	public function getAddress(\Illuminate\Http\Request $request) {
		$address = new Address;
		if ($request->has('type')) {
			$address = $address->where('type', $request->get('type'));
		}
		$address = $address->where('userId', \Auth::id())->get();
		if(empty($address->all())){
			$this->addError('No address found for this vendor.');
		}
		return $this->response($address);
	}

	public function postAddress(\Illuminate\Http\Request $request) {
		$valid = \Validator::make($request->all(), Address::rules());
		if ($valid->fails()) {
			$this->addMessage($valid->errors());
			$this->addError('Validation errors');
			return $this->response();
		}
		$address = new Address;
		$oldAddress = Address::where('userId', \Auth::id())->where('type', $request->get('type'))->first();
		if ($oldAddress) {
			$address = Address::find($oldAddress->id);
		}
		$address->userId = \Auth::id();
		$address->name = $request->get('name');
		$address->address = $request->get('address');
		$address->city = $request->get('city');
		$address->state = $request->get('state');
		$address->country = $request->get('country');
		$address->zipcode = $request->get('zipcode');
		$address->type = $request->get('type');
		if (!$address->save()) {
			$this->addError('Unable to save address');
		}
		if ($request->get('type') == 'billing' && $request->get('useAsShippingAddress', 0) == 1) {
			$oldShiping = Address::where('userId', \Auth::id())->where('type', 'shipping')->first();
			if (!$oldShiping) {
				$oldShiping = new Address;
			}
			$oldShiping->userId = \Auth::id();
			$oldShiping->name = $request->get('name');
			$oldShiping->address = $request->get('address');
			$oldShiping->city = $request->get('city');
			$oldShiping->state = $request->get('state');
			$oldShiping->country = $request->get('country');
			$oldShiping->zipcode = $request->get('zipcode');
			$oldShiping->type = 'shipping';
			$oldShiping->save();
		}
		return $this->response();
	}

	public function store(\Illuminate\Http\Request $request) {
		$vendorID = $request->get('vendorId');
		$store = Store::selectRaw('storeName as vendorName, storeImage as vendorProfilePic, storeImage, vendorId, storeDescription')
		->where('vendorId', $vendorID)->first();
		$store = $store->toArray();
		$store['followers'] = 0;
		$products = Product::where('productVendorId', $store['vendorId'])->orderBy('id', 'desc')->take(10)->get();
		$store['products'] = $products->all();
		$store['totalProducts'] = $products->count();
		$store['deals'] = Deal::where('offerVendorId', $store['vendorId'])->orderBy('id', 'desc')->take(10)->get();
		return $this->response($store);
	}

	public function followStore(\Illuminate\Http\Request $request) {
		$vendorID = $request->get('vendorId');
		$s = Store::where('vendorId', $vendorID)->first();
		if (!$s) abort(404);
		$f = \DB::table('store_followers')->where('user_id', \Auth::id())->where('vendor_id', $vendorID)->first();
		if ($f) {
			$this->addError('Already following the store.');
			return $this->response();
		}
		\DB::table('store_followers')->insert(['vendor_id' => $vendorID, 'user_id' => \Auth::id()]);
		$s->followers = $s->followers + 1;
		$s->save();
		return $this->response(); 
	}

	public function unfollowStore(\Illuminate\Http\Request $request) {

		$vendorID = $request->get('vendorId');
		$s = Store::where('vendorId', $vendorID)->first();
		if (!$s) abort(404);
		$f = \DB::table('store_followers')->where('user_id', \Auth::id())->where('vendor_id', $vendorID)->first();
		if (!$f) {
			$this->addError('You are not following this store.');
			return $this->response();
		}
		\DB::table('store_followers')->where(['vendor_id' => $vendorID, 'user_id' => \Auth::id()])->delete();
		$s->followers = (($s->followers - 1) < 0) ? 0 : ($s->followers - 1);
		$s->save();
		return $this->response(); 
	}

	public function getDeal() {
		$id = \Input::get('offerId');
		$deal = Deal::with('store')->find($id);
		if (!$deal) abort(404);
		$d = UserDeal::where('user_id', \Auth::id())->where('deal_id', $id)->first();
		// if ($d) {
		// 	$this->addError('Deal is already in your account.');
		// 	return $this->response();
		// }
		$d = new UserDeal();
		$d->deal_id = $id;
		$d->user_id = \Auth::id();
		$d->code = strtoupper(str_random(rand(6,8)));
		$d->type = $deal->offerType;
		$d->status = 'not-used';
		// if ($deal->offerType == 'exclusive') {
  		//          $d->status = "draft";
		// }
		
		$d->save();
			
		
				$user = \Auth::user();
		
			$query=\Mail::send('api.email.deal', ['deal' => $deal,'userdeal'=> $d,'id' => $id,'user'=>$user], function ($m) use ($d,$id,$user) {
            $m->from("testingbytes15@gmail.com","Haggler")->to($user->email)->subject("Deal No -{$d->deal_id}")->replyTo("info@haggler.in","Haggler");
        });
\Mail::getSwiftMailer()->getTransport()->stop();
           
			if($query){
$mailresponse="Mail successfully sent";
			}
			else{
		$mailresponse="Error Sending Mail";	
			}
		
			$adminUser = User::where("id",User::ADMIN_USER_ID)->first();

		$query2=\Mail::send('api.email.deal', ['deal' => $deal,'userdeal'=> $d,'id' => $id,'user'=>$user], function ($m) use ($d,$id,$adminUser,$user) {
            $m->from("testingbytes15@gmail.com","Haggler")->to($adminUser->email)->subject("Deal No -{$d->deal_id}")->replyTo("info@haggler.in","Haggler");
        });

           
			if($query2){
$mailresponse2="Mail to admin successfully sent";
			}
			else{
		$mailresponse2="Error Sending Mail to admin";	
			}
					return $this->response(['id'=> $d->id,'offerId'=>$id,'code' => $d->code,'Mail Response'=>$mailresponse,'Admin Mail Response'=>$mailresponse2]);

	\Mail::getSwiftMailer()->getTransport()->stop();
		
		$this->addError('Unable to serve the request.');
		return $this->response();
	}

	public function confirmDeal() {
		$id = \Input::get('order_id');
		$d = UserDeal::where('user_id', \Auth::id())->where("id",$id)->first();
		$v = \Validator::make(\Input::all(), [
			'txn_id' => 'required',
		]);
		$d->txn_id = \Input::get('txn_id');
		$d->payload = \Input::get('payload');
		$d->type = "paid";
		$user = \Auth::user();
		// $d->status = "success";
	$d->save();
			
		
				$user = \Auth::user();
		
			$query=\Mail::send('api.email.deal', ['deal' => $deal,'userdeal'=> $d,'id' => $id,'user'=>$user], function ($m) use ($d,$id,$user) {
            $m->from("testingbytes15@gmail.com","Haggler")->to($user->email)->subject("Deal No -{$d->deal_id}")->replyTo("info@haggler.in","Haggler");
        });
\Mail::getSwiftMailer()->getTransport()->stop();
           
			if($query){
$mailresponse="Mail successfully sent";
			}
			else{
		$mailresponse="Error Sending Mail";	
			}
		
				$adminUser = User::where("id",User::ADMIN_USER_ID)->first();

		$query2=\Mail::send('api.email.deal', ['deal' => $deal,'userdeal'=> $d,'id' => $id,'user'=>$user], function ($m) use ($d,$id,$adminUser,$user) {
            $m->from("testingbytes15@gmail.com","Haggler")->to($adminUser->email)->subject("Deal No -{$d->deal_id}")->replyTo("info@haggler.in","Haggler");
        });
           
			if($query2){
$mailresponse2="Mail to admin successfully sent";
			}
			else{
		$mailresponse2="Error Sending Mail to admin";	
			}
					return $this->response(['id'=> $d->id,'offerId'=>$id,'code' => $d->code,'Mail Response'=>$mailresponse,'Admin Mail Response'=>$mailresponse2]);

\Mail::getSwiftMailer()->getTransport()->stop();
		
		$this->addError('Unable to serve the request.');
		return $this->response();
	}

	public function addToCart(\Illuminate\Http\Request $request) {
		$id = $request->get('productId');
		$qty = $request->get('productQuantity');
		$size = $request->get('productSize');
		$product = Product::where('visible', 'yes')->find($id);
		if (!$product) {
			$this->addError('Product doesn\'t exists.');
			return $this->response();
		}
		$c = new Cart();
		$o = $c->where('user_id', \Auth::id())->where('product_id', $id)->first();
		if ($o) {
			$c = Cart::find($o->id);
			$qty = $qty + $o->quantity; 
		}
		$c->quantity = $qty;
		$c->user_id = \Auth::id();
		$c->product_id = $id;
		$c->size = $size;
		$c->save();
		return $this->response();
	}

	public function setCartProductQty(\Illuminate\Http\Request $request) {
		$id = $request->get('productId');
		$qty = $request->get('productQuantity');
		$product = Product::where('visible', 'yes')->find($id);
		if (!$product) {
			$this->addError('Product doesn\'t exists.');
			return $this->response();
		}
		$c = new Cart();
		$o = $c->where('user_id', \Auth::id())->where('product_id', $id)->first();
    	if (!$o) {
			$this->addError('Product doesn\'t exists in cart.');
		}
		$c = Cart::find($o->id);
		$c->quantity = $qty;
		$c->save();
		return $this->response();
	}

	public function removeFromCart() {
		$id = \Input::get('productId');
		$o = Cart::where('product_id', $id)->where('user_id', \Auth::id())->delete();
		if (!$o) {
			$this->addError('Product doesn\'t exists in cart.');
		}
		return $this->response();
	}

	public function getCartItems() {
		$c = Cart::with('product')->where('user_id', \Auth::id())->get();
		return $this->response($c->toArray());
	}

	public function getMessage(\Illuminate\Http\Request $request){
		date_default_timezone_set('Asia/Kolkata');
    	$timestamp = urldecode(\Input::get('timestamp'));
    	$t = MessageThread::where('sender_id', Auth::id())->find(\Input::get('thread_id'));
		if (!$t) {
			$this->addError('Invalid thread');
			return $this->response();
		}
    	$m = Message::with('sender', 'receiver')->where('thread_id', \Input::get('thread_id'))->where(function ($t) {
			$t->where('receiver_id', \Auth::id())->orWhere('sender_id', \Auth::id());
		});
		$m = $m->where('created_at', '>', $timestamp);
		$m = $m->get();
		$data['items'] = $m->toArray();
		$data['last_message_timestamp'] = $t->last_update;
    	return $this->response($data);
	}

	public function getMessageThread(\Illuminate\Http\Request $request) {
		date_default_timezone_set('Asia/Kolkata');
		$t = MessageThread::with('sender', 'receiver')->where('sender_id', \Auth::id());
		$limit = $request->get('limit', 20000);
		$results = $t->orderBy('last_update', 'desc')->paginate($limit);
		$data['items'] = $results->all();
		$data['pages'] = $results->lastPage();
		$data['count'] = $results->count();	
		return $this->response($data);
	}

	/*public function getDeleteMessageThread() {
		$t = MessageThread::where('sender_id', \Auth::id())->find(\Input::get('thread_id'));
		if (!$t) {
			$this->addError('Thread not found');
			return $this->response();
		}
		$t->delete()
		return $this->response();
	}*/

	public function getMessages(\Illuminate\Http\Request $request) {
		$t = MessageThread::where('sender_id', Auth::id())->find(\Input::get('thread_id'));
		if (!$t) {
			$this->addError('Invalid thread');
			return $this->response();
		}
		$m = Message::with('sender', 'receiver')->where('thread_id', \Input::get('thread_id'))->where(function ($t) {
			$t->where('receiver_id', \Auth::id())->orWhere('sender_id', \Auth::id());
		})->orderBy('id', 'desc');
		date_default_timezone_set('Asia/Kolkata');
		$limit = 200000;
		$results = $m->paginate($limit);
		$data['items'] = array_reverse($results->all());
		$data['pages'] = $results->lastPage();
		$data['count'] = $results->count();
		$data['last_message_timestamp'] = $t->last_update;
		return $this->response($data);
	}

	public function sendMessage(\Illuminate\Http\Request $request) {
		$vendor_id = $request->get('vendor_id');
		$v = Store::where('vendorId', $vendor_id)->first();
		if (!$v) {
			$this->addError('Unknown Vendor.');
			return $this->response();
		}
		$v = \Validator::make($request->all(), [
				'message' => $request->has('thread_id') ? 'required|max:2000' : '',
				'vendor_id' => 'required',
				'subject' => $request->has('thread_id') ? '' : 'required',
			]);
		if ($v->fails()) {
			$this->addMessage($v->errors());
			$this->addError('Validation errors');
			return $this->response();
		}
		$message = urldecode($request->get('message', ''));
		try {
				DB::beginTransaction();
			date_default_timezone_set('Asia/Kolkata');
				$timestamp = date('Y-m-d H:i:s');
				$messageType = "";
				if(!empty($request->get("messageType")))
				{
					$messageType = "redeem";
				}
				if ($request->has('thread_id')){
					$thread_data = ['sender_id' => \Auth::id(), 'receiver_id' => $vendor_id, 'last_message' => $message, 'last_update' => $timestamp,'thread_type' => $messageType];
				}else{
					$thread_data = ['sender_id' => \Auth::id(), 'receiver_id' => $vendor_id, 'subject' => $request->get('subject'), 'last_message' => $message, 'last_update' => $timestamp,'thread_type' => $messageType];
				}
				if ($request->has('thread_id')) {
					$thread_id = $request->get('thread_id');
					MessageThread::updateOrCreate(['id' => $request->get('thread_id'), 'sender_id' => \Auth::id()], $thread_data);
				} else {
					$thread_id = MessageThread::insertGetId($thread_data);
				}
				//if ($request->has('thread_id')) {
					$m = new Message();
					$m->thread_id = $thread_id;
					$m->receiver_id = $request->get('vendor_id');
					$m->sender_id = \Auth::id();
					$m->message = $message;
					$m->created_at = $timestamp;
					$m->save();
				//}
				DB::commit();
				$success = true;
			} catch (\Exception $e) {
				$success = false;
				$this->addError('Unable to send message');
				DB::rollback();
			}
			//'sender', 'receiver'
			$data = [];
			if ($success && $request->has('thread_id')) {
				$data = [
					'created_at' => $timestamp,
					'message'	=> $request->get('message', ''),
					'receiver' => $m->receiver,
					'sender'	=> $m->sender,
					'receiver_id' => $m->receiver_id,
					'sender_id'	=> $m->sender_id,
					'thread_id'	=> $thread_id
				];
			} else {
				$t = MessageThread::with('sender', 'receiver')->find($thread_id);
				$data = $t->toArray();
				/*[
    				'id' => $thread_id,
					'sender_id'	=> $m->sender_id,
					'receiver_id' => $m->receiver_id,
					'subject'	=> $request->get('subject'),
					'last_message' => $request->get('message', ''),
					'last_update'	=> $timestamp,
					'sender'	=> $m->sender,
					'receiver' => $m->receiver,
				];*/
			}
		return $this->response($data);
	}

	public function updateCart() {
		$items = json_decode(\Input::get('data'));
		if (!is_array($items) || empty($items)) {
			$this->addError('Invalid data format');
			return $this->response();
		}
		foreach ($items as $item) {
			if (isset($item->product_id, $item->quantity)) {
				$c = new Cart();
				$c = $c->where('user_id', \Auth::id())->where('product_id', $item->product_id)->first();
				if ($c) {
					$c->quantity = $item->quantity;
					$c->user_id = \Auth::id();
					$c->product_id = $item->product_id;
					if (isset($item->size)) {
						$c->size = $item->size;
					}
					$c->save();
				}
			} else {
				$this->addError('Some of the items have invalid format.');
			}
		}
		return $this->response();
	}

	public function createOrder(\Illuminate\Http\Request $request) {
		$cartItems = Cart::with('product')->where('user_id', \Auth::id())->get();

		//$cartItems = Cart::with('product')->where('user_id', $request->get('user_id'))->get();
		if (empty($cartItems->all())) {
			$this->addError('Cart is empty.');
			return $this->response();
		}
		$o = new Order();
		$o->user_id = \Auth::id();
		$v = \Validator::make($request->all(), Order::rules());
		if ($v->fails()) {
			$this->addMessage($v->errors());
			$this->addError('Validation errors');
			return $this->response();
		}
		$cartTotal = 0;
		foreach ($cartItems as $item) {
            if($item->product->hasOffer == "yes"){
            	$price = $item->product->offerPrice;
            }else{
               $price = $item->product->price;
            }
			$date = date("Ymd");
			$startDate = str_replace('-', '', $item->product->offerStartDate);
			$endDate = str_replace('-', '', $item->product->offerEndDate);
			if ($date >= $startDate &&  $date <= $endDate) {
				$price = $item->product->offerPrice;
			}
			$cartTotal +=  $price * $item->quantity;
		}
		$total = $cartTotal;
		$address = Address::where('userId', \Auth::id())->get();
		if (empty($address->all())) {
			$this->addError('Please save your address first before placing order.');
			return $this->response();
		}
		$shipping_address = [];
		$billing_address = [];
		foreach ($address as $address_item) {
			if ($address_item->type == 'billing') {
				$billing_address = $address_item;
			}
			if ($address_item->type == 'shipping') {
				$shipping_address = $address_item;
			}
		}
		if (empty($billing_address)) {
			$this->addError('Please save your billing address first before placing order.');
			return $this->response();
		}
		if (empty($shipping_address)) {
			$this->addError('Please save your shipping address first before placing order.');
			return $this->response();
		}
		try {
			DB::beginTransaction();
			$o->name = $billing_address->name;
			$o->address = $billing_address->address;
			$o->city = $billing_address->city;
			$o->state = $billing_address->state;
			$o->zipcode = $billing_address->zipcode;
			$o->shipping_name = $shipping_address->name;
			$o->shipping_address = $shipping_address->address;
			$o->shipping_city = $shipping_address->city;
			$o->shipping_state = $shipping_address->state;
			$o->shipping_zipcode = $shipping_address->zipcode;
			$o->total = $total;
			if($request->get('paymode') == "cod"){
				$o->order_status = 'pending';
			}else{
				$o->order_status = 'draft';
			}
			
			$o->save();
			$order_products = [];

			$order_items = [];
			foreach ($cartItems as $item) {
                if($item->product->hasOffer == "yes"){
                    $p = $item->product->offerPrice;
                }else{
                    $p = $item->product->price;
                }
				 $order_item = [
				'order_id' => $o->id,
				'product_id'	=> $item->product->productId,
                 'productVendorId' =>$item->product->productVendorId,
				 'name' => $item->product->name,
				 'size'	=> $item->size,
				 'quantity'	=> $item->quantity,
				 'price'	=>  $p,
				 'total'	=> $p * $item->quantity,
				 ];
				 $order_products[] =  $order_item;
				 $order_items = array_merge($order_item, ['image' => $item->product->getThumbnailAttribute(), 'store' => $item->product->store->storeName]);

			}
			OrderItem::insert($order_products);
			$rewardPoints = RewardPoint::where('user_id',\Auth::id())->first();
			if(!$rewardPoints){
                $rewardPoints = new RewardPoint();
				$order_total = $o->total;
				$previousBalance = ($order_total%25);
				$reward = floor($order_total/25);
				$rewardPoints->user_id = \Auth::id();
				$rewardPoints->previous_balance = $previousBalance;
				$rewardPoints->reward_point = $reward;
				$rewardPoints->save();
			}else{
				$order_total = ($o->total + $rewardPoints->previous_balance);
				$previousBalance = ($order_total%25);
				$reward = floor(($order_total/25) + $rewardPoints->reward_point);
				$rewardPoints->user_id = \Auth::id();
				$rewardPoints->previous_balance = $previousBalance;
				$rewardPoints->reward_point = $reward;
				$rewardPoints->save();
			}
			Cart::where('user_id',\Auth::id())->delete();
			DB::commit();
			$success = true;
		} catch(\Exception $e) {
			$success = false;
			$this->addError('Unable to create order');
			DB::rollback();
		}


		$user = \Auth::user();
		$adminUser = User::where("id",User::ADMIN_USER_ID)->first();

		
$products=Order::with('items')->where("id",$o->id)->first();
		$vendorid=$products->items[0]['productVendorId'];
		$vendor = User::where("id",$vendorid)->first();
		if($vendor->firstname=="" && $vendor->lastname==""){
			$vendorname = $vendor->firstname." ".$vendor->lastname;
		}
		else{
		$vendorname = $vendor->username;
		}
		
        if($request->get('paymode') == "cod") {

$query=\Mail::send('api.email.order.order_create', ['user' => $user,'vendorname' => $vendorname, 'order' => $o], function ($m) use ($user,$adminUser,$vendorname,$o) {
            $m->from("testingbytes15@gmail.com","Haggler")->to($user->email)->subject("Order No -{$o->id}")->replyTo("info@haggler.in","Haggler");
        });
\Mail::getSwiftMailer()->getTransport()->stop();
           
			if($query){
$mailresponse="Mail successfully sent";
			}
			else{
		$mailresponse="Error Sending Mail";	
			}
		
			
		$query2=\Mail::send('api.email.order.order_vendor_create', ['user' => $user,'vendorname' => $vendorname, 'order' => $o], function ($m) use ($user,$adminUser,$vendorname,$o) {
            $m->from("testingbytes15@gmail.com","Haggler")->to($adminUser->email)->subject("Order No -{$o->id}")->replyTo("info@haggler.in","Haggler");
        });
           
			if($query2){
$mailresponse2="Mail to admin successfully sent";
			}
			else{
		$mailresponse2="Error Sending Mail to admin";	
			}
			
			\Mail::getSwiftMailer()->getTransport()->stop();
					
			
				
		}
	
		
		$d = $success ? ['order_id' => $o->id, 'order' => $o, 'items' => $order_items] : [];
		return $this->response($d);
	}

	public function confirmOrder(\Illuminate\Http\Request $request) {
		$o = Order::where('user_id', \Auth::id())->find($request->get('order_id'));
		
		$order_id = $request->get('order_id');
		if (!$o) {
			$this->addError('Order not found.');
			return $this->response();
		}
        $paymode = $request->get("paymode");
		
	
		if($paymode == 'cod'){
			$o->order_status = 'pending';
			$o->save();
		//	return $this->response();
		}
	$payloads = @json_decode(\Input::get('payloads'));
		if (!$payloads && empty($payloads)) {
			$this->addError('Invalid payloads format');
			//return $this->response();
		}
		$v = \Validator::make($request->all(), OrderPayment::rules());
		if ($v->fails()) {
			$this->addMessage($v->errors());
			$this->addError('Validation errors');
			return $this->response();
		}
		try {
			DB::beginTransaction();
			$payment = new OrderPayment();
			$payment->order_id = $o->id;
			$payment->status = $request->get('status');
			$payment->txn_id = $request->get('txn_id');
			$payment->payloads = $request->get('payloads');
			$payment->save();
			$o->order_status = 'pending';
			$o->save();
			/*Send mail*/
//			Mail::send([], [], function ($message) /*use($request, $url, $extension, $mime)*/ {
//
//			   /* $custom_path =  public_path();
//			    $custom_path = $custom_path."custom.pdf";*/
//
//			    //$custom_path = "http://bytesultra.com/custom.pdf";
//
//			    /*$content = '<table>';
//			        foreach ($request->all() as $key => $value) {
//			        if($key != 'image' || $key != 'submit'){
//			            if (!in_array($key, ['_token'])) {
//			                $content .= '<tr><th>'.$key.'</th><td>'.$value.'</td></tr>';
//			            }
//			        }
//			    }
//			    $content .= '</table>';*/
//			    $content = "testing email";
//			    $message->to('arpit.aggarwal@bytesultra.com')
//			    	->subject('Testing email')
//			        ->setBody($content, 'text/html');
//			});*/
			DB::commit();
			$success = true;
				if($paymode!="cod"){
		$cartItems = OrderItem::with('product')->where('order_id',$request->get('order_id'))->get();
		//print_r($cartItems);die;
foreach ($cartItems as $item) {
	
		$updatedquantity=$item->product->quantity - $item->quantity;
				//echo $updatedquantity;die;
				
				if($updatedquantity>=0){
				DB::table('products')->where('productId',$item->product->id)->update(array('productQuantity' => $updatedquantity));
				
}
}
		}
	
		} catch (\Exception $e) {
			$this->addError($e->getMessage());
			//'Unable to confirm order'
			DB::rollback();
		}

        $user = \Auth::user();
        $adminUser = User::where("id",User::ADMIN_USER_ID)->first();

		$products=Order::with('items')->where("id",$order_id)->first();
		$vendorid=$products->items[0]['productVendorId'];
		$vendor = User::where("id",$vendorid)->first();
		if($vendor->firstname=="" && $vendor->lastname==""){
			$vendorname = $vendor->firstname." ".$vendor->lastname;
		}
		else{
		$vendorname = $vendor->username;
		}

		
 \Mail::send('api.email.order.order_create', ['user' => $user,'vendorname' => $vendorname, 'order' => $o], function ($m) use ($user,$adminUser,$vendorname,$o) {
            $m->to($user->email)->subject("Order No -{$o->id}")->replyTo("info@haggler.in","Haggler");
        });
\Mail::getSwiftMailer()->getTransport()->stop();

		return $this->response();
	}	

	public function getOrders(\Illuminate\Http\Request $request) {
		$o = new Order;
		$limit = $request->get('limit', 15);
		$order = $request->get('order', 'desc');
		if (!in_array($order, ['desc', 'asc'])) {
			$order = 'desc';
		}
		$o = $o->orderBy('id', $order);
		$o = $o->paginate($limit);
		$d = [
			'items' => $o->toArray(),
			'pages' => $o->lastPage(),
			'count' => $o->count(),	
		];
		return $this->response($d);
	}

	public function getOrder(\Illuminate\Http\Request $request) {
		$id = $request->get('order_id');
		$o = Order::with(['items' => function ($w) { $w->with('product_image'); } ])->find($id);
		if (!$o) abort(404);
		return $this->response($o);
	}

	public function getFollowedStores(\Illuminate\Http\Request $request) {
		$limit = $request->get('limit', 15);
		$s = Store::selectRaw('vendorId, storeName as vendorName, storeImage, storeImage as vendorProfilePic, followers, storeDescription')->whereIn('vendorId', function ($t) {
			return $t->select('vendor_id')->from('store_followers')->where('user_id', Auth::id());
		});
		$order = 'desc';
		if ($request->has('orderBy')) {
			$order = 'desc';
			if (in_array($request->get('order'), ['asc', 'desc'])) {
				$order = $request->get('order');
			}
		}
		$s = $s->orderBy($request->get('orderBy', 'vendorName'), $order)->paginate($limit);
		$data['items'] = $s->all();
		$data['pages'] = $s->lastPage();
		$data['count'] = $s->count();
		return $this->response($data);
	}

	public function buzlineAlerts() {

		$data = [];
		$o = BuzAlert::where("user_id",Auth::id())->orderBy('id','desc')->get();
		return $this->response($o);

  //       $tempJson = [];
  //       foreach($o->toArray() as $i){

  //       	if($i['type'] == 'deal'){

  //       		$offerId = $i['data_images'][0]->offerId;




  //       	}else{

  //       		array_push($tempJson, $i);

  //       	}
  //       }
		// exit;


		
		
	}

	public function getBuzlineData() {
        $data = [];
		$b = BuzAlert::find(\Input::get('id'));
		if (!$b) {
			$this->addError('Invalid buz.');
			return $this->response();
		}
       if ($b->type == 'product' ) {
           $data = Product::with('categories','images')
               ->selectRaw('productId as id, productId, productVendorId, productName as name, productDescription as description, productPrice as price, productThumbnail as image, productThumbnail, productTags as tags, hasOffer, offerName, offerPrice, offerStartDate, offerEndDate')
               ->whereIn('productId', explode('|', $b->data))->get();
               
       }
       if ($b->type == 'deal' ) {
           $data = Deal::with('category', 'store', 'images')->selectRaw('offerId as id, offerId, offerVendorId, offerCategoryId, offerName as name, offerHighlightedText, description, offerPrice as price, offerDiscount, offerTags as tags, offerStartDate, offerEndDate, offerDiscountType as type, offerType, offerImage as image, offerImage, originalPrice, productOfferPrice')
               ->whereIn('offerId', explode('|', $b->data))->get();

       }
       if ($b->type == 'event' ) {
           $data = Event::selectRaw('eventId as id, eventId, eventTitle as name, eventDescription as description, eventStartDate, eventEndDate, eventAddress, eventImage as image, eventImage, eventStatus')
               ->whereIn('eventId', explode('|', $b->data))->get();
       } 
		return $this->response($data);
	}

	public function postProfile(\Illuminate\Http\Request $request){
		$user = Auth::user();
		$valid = \Validator::make($request->all(), [
			"email" => 'required|email|unique:users,email,'.$user->id
		]);
		if($valid->fails())
		{
			$this->addMessage($valid->errors());
			$this->addError('Validation errors');
			return $this->response();
		}
		$user->firstname =  $request->get("firstname");
		$user->lastname = $request->get("lastname");
		$user->username = $request->get("username");
		$user->device_id = $request->get("api_token");
		$user->email = $request->get("email");
		$user->phone_number = $request->get("phone_number");
		if($user->save())
		{
			$user->reward = $user->reward;
			return $this->response($user);
		}
	}

	public function changePassword( \Illuminate\Http\Request $request ) {
        $v = \Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);
        if ($v->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $v->errors()
            ]);
        }
        $user = Auth::user();
        if ( !Hash::check($request->get('old_password'), $user->password) ) {
            return response()->json([
                'success' => false,
                'message' => ['text' => 'Wrong password', 'class' => 'alert-danger'],
                'errors' => ['old_password' => ['Wrong password']]
            ]);
        }
        $user->password = $request->get('new_password');
        $user->save();
        return response()->json(['success' => true, 'message' => [
            'text' => 'Password updated.',
            'class' => 'alert-success'
        ]]);
    }

    public function getUserDeals(){
    	$user = \Auth::user();
    	$userDeals = UserDeal::where("user_id",$user->id)->with(['deal' => function($d){ $d->with('store');  }])->orderBy('id','desc')->get();
    	return $this->response($userDeals);
    }

    public function getUserDealsById(\Illuminate\Http\Request $request){
    	$user = \Auth::user();
    	$id = $request->get("id");
        $userDeal = UserDeal::where("id",$id)->where('user_id',$user->id)->with('deal')->get();
        return $this->response($userDeal);
    }

    public function getRewards(\Illuminate\Http\Request $request){
    	$user = \Auth::user();
    	$reward = $user->reward;
    	return $this->response($reward);
    }

 //    public function getOrderVerify(\Illuminate\Http\Request $request){
 //     	$url = "https://test.payumoney.com/payment/payment/chkMerchantTxnStatus";
	// 	$ch = curl_init($url);  
	// 	curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST"); 
	// 	curl_setopt($ch, CURLOPT_POST, 1);
	// 	//  curl_setopt($ch,CURLOPT_HEADER, false); 
	// 	curl_setopt($ch, CURLOPT_POSTFIELDS,
	// 	"merchantKey=TZnxq2ig&merchantTransactionIds=100123abc");
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 	curl_setopt($ch, CURLOPT_HTTPHEADER,array( 'Content-Type: application/json'));               
	// 	$output=curl_exec($ch);
	// 	curl_close($ch);
	// 	return $this->response($output);
	// }

}
