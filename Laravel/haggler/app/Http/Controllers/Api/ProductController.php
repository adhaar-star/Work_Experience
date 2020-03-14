<?php

namespace App\Http\Controllers\Api;

class ProductController extends ApiController {
	
	
	public function getList() {

		$product = new Product();

		if ($request->has('vendorId')) {
			$product = $product->where('productVendorId', $request->get('vendorId'));
		}

		if ($request->has('categoryId')) {
			$product = $product->whereIn('productId', function ($q) {
				$q->select('productId')->from('product_categories')->where('categoryId', \Input::get('categoryId'))
			});
		}

		if ($request->has('orderBy')) {
			$order = 'desc';
			if (in_array($request->get('order'), ['asc', 'desc'])) {
				$order = $request->get('order');
			}
			$product = $product->orderBy($request->get('orderBy'), $order);
		}

		$limit = $request->get('limit', 15);

		$results = $product->paginate($limit);

		$this->response();

	}

	public function getView($id) {

		$product = Product::find($id);

		$this->response($product);

	}


}