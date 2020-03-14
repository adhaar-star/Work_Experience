<?php

namespace App\Http\Controllers\Backend;

use \App\Models\Product;
use \App\Models\Deal;
use \App\Models\UserDeal;
use \App\Models\Event;
use \App\Models\Order;


class DashboardController extends BackendController {


	public function getIndex() {

	   // $todayOrders = Order::select(\DB::raw("sum(total) as total_amount, count(id) as total_orders"))->where(\DB::raw("date('created_at')"),'=',date('Y-m-d'))->get();

        $monthOrders = Order::select(\DB::raw("sum(total) as total_amount, count(id) as total_orders"))->whereMonth('created_at','=',date('m'))->get();
        $yearOrders = Order::select(\DB::raw("sum(total) as total_amount, count(id) as total_orders"))->whereYear('created_at','=',date('Y'))->get();


		
		$this->layout->content = view('backend.welcome');

		return $this->layout;
	}

	public function getSearchAll() {

		$q = \Input::get('term');

		$products = Product::where("productName", 'like', "$q%")->orWhere('productId', $q)->where('visible', 'yes')->get();
		$deals = Deal::where("offerName", 'like', "$q%")->orWhere('offerId', $q)->where('visible', 'yes')->get();

		$events = Event::where("eventTitle",'like',"$q%")->where('eventEndDate','>',date('Y-m-d'))->orWhere('eventId',$q)->get();



		$collection = [];

		if (!empty($products->all())) {
			foreach ($products as $product) {
				$label ='Product: # ' . $product->productId . ' - ' . $product->productName;
				array_push($collection, ['value' => $label, 'label' => $label, 'id' => $product->productId, 'type' => 'product']);
			}
		}

		if (!empty($deals->all())) {
			foreach ($deals as $deal) {
				$label = 'Deal: # ' . $deal->offerId . ' - ' . $deal->offerName;
				array_push($collection, ['value' => $label, 'label' => $label, 'id' => $deal->offerId, 'type' => 'deal']);
			}
		}

		if(!empty($events->all())){
			foreach($events->all() as $event){
				$label ='Event: # ' . $event->eventId . ' - ' . $event->eventTitle;
				array_push($collection, ['value' => $label, 'label' => $label, 'id' => $event->eventId, 'type' => 'event']);

			}
		}

		return response()->json($collection);

	}

	/*public function getValidateDeal() {
		$code = \Input::get('deal_code', 'somecode');
		if (\Auth::user()->role == 'admin') {
			$u = UserDeal::with('deal', 'buyer', 'vendor')->where('code', $code)->first();
		} else {
			$u = UserDeal::with('deal', 'buyer', 'vendor')->where('code', $code)->whereIn('deal_id', function ($t) {
				return $t->select('offerId')->from('deals')->where('offerVendorId', \Auth::id());
			})->first();
		}

		if (!$u) {
			return redirect()->back()->with(['inline_error' => $this->alert('Invalid deal code.', 'alert-danger')]);
		}

		return redirect()->back()->with(['current_deal' => $u]);
	}*/

	
}