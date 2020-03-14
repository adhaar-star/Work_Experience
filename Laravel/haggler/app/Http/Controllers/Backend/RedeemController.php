<?php

namespace App\Http\Controllers\Backend;

use \App\Models\Product;
use \App\Models\Deal;
use \App\Models\UserDeal;
use \App\Models\Event;

class RedeemController extends BackendController {

	public function __construct() {
		parent::__construct();
		view()->share(['active_nav' => 'redeem']);
	}

	public function getIndex() {
		$this->layout->content = view('backend.redeem.index');
		return $this->layout;
	}

	public function getValidateDeal() {
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

		return redirect()->back()->with(['current_deal' => $u, 'scroll' => 1]);
	}

	
}