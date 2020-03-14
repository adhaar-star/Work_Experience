<?php

namespace App\Http\Controllers\Api\V1;

use \App\Models\Deal;

class DealController extends ApiController {
	
	
	public function getList( \Illuminate\Http\Request $request ) {

		$limit = $request->get('limit', 15);

		$deals = Deal::with('category', 'store');

		if ($request->has('vendorId')) {
			$deals = $deals->where('offerVendorId', $request->get('vendorId'));
		}

		if ($request->has('categoryId')) {
			$deals = $deals->where('offerCategoryId', $request->get('categoryId'));
		}

		if ($request->has('orderBy')) {
			$order = 'desc';
			if (in_array($request->get('order'), ['asc', 'desc'])) {
				$order = $request->get('order');
			}
			$deals = $deals->orderBy($request->get('orderBy'), $order);
		}

		$deals = $deals->paginate($limit);

		$data['items'] = $deals->all();
		$data['pages'] = $deals->lastPage();
		$data['count'] = $deals->count();

		return $this->response($data);


	}

	public function getView($id) {

		$deal = Deal::find($id);

		if (!$deal) abort(404);

		return $this->response($deal);

	}

	
}