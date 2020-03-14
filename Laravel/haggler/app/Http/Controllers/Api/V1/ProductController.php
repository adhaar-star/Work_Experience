<?php

namespace App\Http\Controllers\Api\V1;

use \App\Models\Product;
use \App\Models\Category;

class ProductController extends ApiController {
	
	
	public function getCategories(\Illuminate\Http\Request $request) {
		$category = Category::with('children');

		if ($request->has('categoryParentId')) {
			$category = $category->where('categoryParentId', $request->get('categoryParentId', 0));
		} else {
			$category = $category->where('categoryParentId', 0);
		}

		if ($request->has('orderBy')) {
			$order = 'desc';
			if (in_array($request->get('order'), ['asc', 'desc'])) {
				$order = $request->get('order');
			}
			$category = $category->orderBy($request->get('orderBy', 'categoryId'), $order);
		}


		$limit = $request->get('limit', 15);

		$results = $category->paginate($limit);

		$data['items'] = $results->all();
		$data['pages'] = $results->lastPage();
		$data['count'] = $results->count();

		return $this->response($data);

	}

	public function getList(\Illuminate\Http\Request $request) {

		$product = new Product();

		$product = $product->with('categories.category');

		if ($request->has('vendorId')) {
			$product = $product->where('productVendorId', $request->get('vendorId'));
		}

		if ($request->has('categories')) {
			$product = $product->whereIn('productId', function ($q) {
				return $q->select('productId')
				->from('product_categories')
				->whereIn('categoryId', explode(',', \Input::get('categories')));
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

		$data['items'] = $results->all();
		$data['pages'] = $results->lastPage();
		$data['count'] = $results->count();

		return $this->response($data);

	}

	public function getView($id) {

		$product = Product::with('product_attributes', 'store')->find($id);

		if (!$product) abort(404);

		$product_formated = [];

		foreach ($product->toArray() as $field => $value) {
			if ($field == 'product_attributes') {
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
				$product_formated[$field] = $value;
			}
		}

		return $this->response($product_formated);

	}


}