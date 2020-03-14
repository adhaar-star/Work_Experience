<?php


namespace App\Http\Controllers\Backend;

use App\Models\DealCategory;
use App\Models\User;
use App\Models\Deal;
use App\Models\Product;
use App\Models\UserDeal;
use Auth;
use DB;
use Input;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ProductCategory;
use App\Models\Category;
use App\Models\Wallet;


class SaleController extends BackendController {


	public function __construct() {
		parent::__construct();

		view()->share(['active_nav' => 'sale']);

	}

	public function getDealHistory($deal_id ) {

		$d = new UserDeal();
		$d = $d->with('vendor', 'buyer', 'deal')->where('deal_id', $deal_id);
		if (\Auth::user()->role != 'admin') {
			$d = $d->whereIn('user_id', function ($t) {
				return $t->select('offerVendorId')->from('deals')->where('offerVendorId', \Auth::id());
			});
		} 

		$o = $d->paginate(20);

		$this->layout->content = view('backend.sale.deal-hisory', ['deals' => $o]);
		return $this->layout;
	}

	public function getDeals( \Illuminate\Http\Request $request ) {

		$d = new UserDeal();
		$d = $d->with('buyer', 'deal');


		if (!empty($request->get('from'))) {
			$d = $d->where('created_at', '>=', $request->get('from'));
		}

		if (!empty($request->get('to'))) {
			$d = $d->where('created_at', '>=', $request->get('to'));
		}

		if (!empty($request->get('type') &&  $request->get('type')!='all')) {
			$d = $d->whereIn("deal_id",function($query) use($request){

				$query->select('offerId')->from('deals')
				->where('offerType',$request->get('type'));
			});
		}

		if (!empty($request->get('status'))) {

			switch ($request->get('status')) {

				case 'used':
				$d = $d->where('status', 'used');
				break;

				case 'un-used':
				$d = $d->where('status', 'not-used')
				->whereIn('deal_id',function($query){
					$query->select('offerId')->from('deals')
					->where('offerEndDate','>',date('Y-m-d'));
				});
				break;

				case 'expired':
				$d = $d->where('status', 'not-used')
				->whereIn('deal_id',function($query){
					$query->select('offerId')->from('deals')
					->where('offerEndDate','<',date('Y-m-d'));
				});
				break;

			}

			if(!empty($request->get('code'))){
				$d = $d->where('code',$request->get('code'));
			}

			//$d = $d->where('created_at', '>=', $request->get('to'));
		}

		if (\Auth::user()->role != 'admin') {
			$d = $d->whereIn('deal_id', function ($t) {
				return $t->select('offerId')->from('deals')->where('offerVendorId', \Auth::id());
			});
		} 

		$d = $d->orderBy('id', 'desc');

		$o = $d->paginate(20);

		$used = UserDeal::where('status', 'used');
		if (\Auth::user()->role != 'admin') {
			$used = $used->whereIn('deal_id', function ($t) {
				return $t->select('offerId')->from('deals')->where('offerVendorId', \Auth::id());
			});
		} 
		$used = $used->count();
		$unusedDeals = UserDeal::where('status', 'not-used')
		->whereIn('deal_id',function($query){
			$query->select('offerId')->from('deals')
			->where('offerEndDate','>',date('Y-m-d'));
		});
		if (\Auth::user()->role != 'admin') {
			$unusedDeals = $unusedDeals->whereIn('deal_id', function ($t) {
				return $t->select('offerId')->from('deals')->where('offerVendorId', \Auth::id());
			});
		} 
		$unusedDeals = $unusedDeals->count();

		$expiredDeals = UserDeal::where('status', 'not-used');
		if (\Auth::user()->role != 'admin') {
			$expiredDeals = $expiredDeals->whereIn('deal_id', function ($t) {
				return $t->select('offerId')->from('deals')->where('offerVendorId', \Auth::id());
			});
		} 
		$expiredDeals = $expiredDeals->whereIn('deal_id', function ($t) {
			return $t->select('offerId')->from('deals')->where('offerEndDate', '<=', date('Y-m-d'));
		})->count();


		$this->layout->content = view('backend.sale.deals', ['deals' => $o, 'usedDeals' => $used, 'expiredDeals' => $expiredDeals, 'unusedDeals' => $unusedDeals]);
		return $this->layout;
	}

	public function getApproveDeal(\Illuminate\Http\Request $request) {

		$id = $request->get('deal');

		$d = new UserDeal();

		if (\Auth::user()->role != 'admin') {
			$d = $d->whereIn('deal_id', function ($t) {
				return $t->select('offerId')->from('deals')->where('offerVendorId', \Auth::id());
			});
		} 

		$d = $d->find($id);

		if (!$d) {
			return redirect()->back()->with(['message' => $this->alert('Invalid deal.', 'alert-danger')]);
		}

		if ($d->status == 'used') {
			return redirect()->back()->with(['message' => $this->alert('Deal is already approved.', 'alert-danger')]);
		}

		if ($d->status != 'used' && $d->deal->offerEndDate < date('Y-m-d')) {
			return redirect()->back()->with(['message' => $this->alert('Deal is expired.', 'alert-danger')]);
		}

		$d->status = 'used';
		$d->save();

		return redirect()->back()->with(['message' => $this->alert('Deal approved.', 'alert-success')]);


	}

	public function getValidateDeal() {
		// $u = UserDeal::where('code', $code)->first();
		$code = \Input::get('deal_code', 'somecode');

		$d = new UserDeal();

		if (\Auth::user()->role != 'admin') {
			$d = $d->whereIn('user_id', function ($t) {
				return $t->select('offerVendorId')->from('deals')->where('offerVendorId', \Auth::id());
			});
		} 

		$d = $d->where('code', $code)->first();
		$val = 1;
		if (!$d) {
			return redirect()->back()->with(['message' => $this->alert('Invalid deal.', 'alert-danger'), 'scroll' => $val]);
		}

		if ($d->status == 'used') {
			return redirect()->back()->with(['message' => $this->alert('Deal is already approved.', 'alert-danger'),"scroll" => 1]);
		}

		if ($d->status != 'used' && $d->deal->offerEndDate < date('Y-m-d')) {
			return redirect()->back()->with(['message' => $this->alert('Deal is expired.', 'alert-danger')]);
		}

		$d->status = 'used';
		$d->save();

		return redirect()->back()->with(['message' => $this->alert('Deal approved.', 'alert-success'), 'current_deal' => $d]);
		// if (\Auth::user()->role == 'admin') {
		// } else {
		// 	$u = UserDeal::with('deal', 'buyer', 'vendor')->where('code', $code)->whereIn('deal_id', function ($t) {
		// 		return $t->select('offerId')->from('deals')->where('offerVendorId', \Auth::id());
		// 	})->first();
		// }

		// if (!$u) {
		// 	return redirect()->back()->with(['inline_error' => $this->alert('Invalid deal code.', 'alert-danger')]);
		// }

		// return redirect()->back()->with(['current_deal' => $u]);
	}

	public function getOrders(\Illuminate\Http\Request $request) {

		$o = Order::where('order_status','!=','draft');

		if (!empty($request->get('q'))) {
			$q = $request->get('q');
			//$o = $o->where('q', 'like', "%$q%");

			$o = $o->where(function($w)use($q){

				return $w->where("name",'like',"%$q%")
				->orWhere('order_status','like',"%$q%")
				->orWhere('id','like',"%$q%");

			});
		}

		if (!empty($request->get('from')) && !empty($request->get('to')) ) {
			$o = $o->whereBetween(\DB::raw('date(created_at)'), [$request->get('from'), $request->get('to')]);
		}else{

			if (!empty($request->get('from'))) {
				$o = $o->where('created_at', '>=', $request->get('from'));
			}

			if (!empty($request->get('to'))) {
				$o = $o->where('created_at', '<=', $request->get('to'));
			}
		}

		if (!empty($request->get('o_s'))) {
			$o = $o->where('order_status', '=', $request->get('o_s'));
		}
		$o = $o->orderBy("id","desc");
		//echo $o->toSql();
		//exit;
		$o = $o->paginate(20);

		$this->layout->content = view('backend.sale.orders', ['orders' => $o->appends(Input::except('page'))]);
		return $this->layout;

	}

	public function getOrder($action,$id){

		$order = Order::with('items')->find($id);
		// echo "<pre>";
		//  print_r($order->toArray());
		// echo "</pre>";
		// exit;
		$this->layout->content = view('backend.sale.order-view', ['order' => $order]);
		return $this->layout;

	}

	public function postOrder(\Illuminate\Http\Request $request){

		//var_dump($request->all());exit;

		$order_id = $request->get('order_id');
		$status = $request->get('status');
		$or = Order::where('id',$order_id)->first();
		/*From here*/
		/*$user = User::where("id",$or->user_id)->first();
		\Mail::queue('backend.email.purchase', ['user' => $user, 'order' => $or, 'status' => $status], function ($m) use ($user,$or,$status) {
			$m->to("arpit.aggarwal@bytesultra.com")->subject("Order No -{$or->id} is $status");
		});
		return redirect()->back()->with(['message' => ['text' => 'Order updated successfully.','class' => 'alert-success']]);*/
		/*To here*/
		if($or->order_status == $status){
			return redirect()->back()->with(['message' => ['text' => "Order is already $status .",'class' => 'alert-danger']]);
		}
		Order::where('id',$order_id)->update(['order_status' => $status]);
		

		if($status == 'delivered'){
			$order =  Order::with('items')->where("id",$order_id)->first();
			
			if(!empty($order->items->all())){
				foreach($order->items->all() as  $key => $oi){
					$vendorId = $oi->productVendorId;
					if($vendorId!= User::ADMIN_USER_ID) {
						$wallet = Wallet::where('user_id', $vendorId)->first();
						try{
							$productCategory = ProductCategory::where('productId', $oi->product_id)->get();
							$size = sizeof($productCategory->toArray());
							$commisionCategory = $productCategory->toArray()[$size - 1]['categoryId'];
							$category = Category::where('categoryId', $commisionCategory)->first();
							$siteCommission = (($oi->total) * ($category->categoryPercentage)) / 100;
							$vendorBalance = ($oi->total) - $siteCommission;

							if (empty($wallet)) {
								$wallet = new Wallet();
								$wallet->user_id = $vendorId;
								$wallet->amount = $vendorBalance;
								$wallet->v_amount = $vendorBalance;
							} else {
								$wallet->user_id = $vendorId;
								$wallet->amount = $wallet->amount + $vendorBalance;
								$wallet->v_amount = $wallet->v_amount + $vendorBalance;
							}
							$wallet->save();
						}catch (exception $ex){
							die($ex);
						}
					}
					$adminWallet = Wallet::where("user_id", User::ADMIN_USER_ID)->first();
					$adminWallet->amount = ($adminWallet->amount) + ($oi->total);
					$adminWallet->save();
				}
			}
		}
		$products=Order::with('items')->where("id",$order_id)->first();
		$vendorid=$products->items[0]['productVendorId'];
		$vendor = User::where("id",$vendorid)->first();
		if($vendor->firstname=="" && $vendor->lastname==""){
			$vendorname = $vendor->firstname." ".$vendor->lastname;
		}
		else{
		$vendorname = $vendor->username;
		}
		$user = User::with('address')->where("id",$or->user_id)->first();
		$adminUser = User::where("id",User::ADMIN_USER_ID)->first();

		\Mail::queue('backend.email.purchase', ['user' => $user, 'order' => $or,'vendorname'=>$vendorname ,'status' => $status], function ($m) use ($user,$adminUser,$or,$vendorname,$status) {
			$m->from("testingbytes15@gmail.com","Haggler")->to($user->email)->subject("Order No -{$or->id} is $status")->replyTo("info@haggler.in","Haggler");;
		});
		if($status == 'delivered'){
		\Mail::queue('backend.email.invoice', ['user' => $user, 'order' => $or,'vendorname'=>$vendorname ,'status' => $status], function ($m) use ($user,$adminUser,$or,$vendorname,$status) {
			$m->from("testingbytes15@gmail.com","Haggler")->to($user->email)->subject("Order No -{$or->id} is $status")->replyTo("info@haggler.in","Haggler");
		});
		}
		return redirect()->back()->with(['message' => ['text' => 'Order updated successfully.','class' => 'alert-success']]);
	}
}
