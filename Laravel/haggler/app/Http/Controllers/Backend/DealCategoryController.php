<?php


namespace App\Http\Controllers\Backend;

use App\Models\DealCategory;
use App\Models\Upload;

class DealCategoryController extends BackendController {

	public function __construct() {
		parent::__construct();
	
		view()->share(['active_nav' => 'deal_category']);
			
	}

	public function getIndex(\Illuminate\Http\Request $request) {

		 
		$categories = DealCategory::orderBy('categoryName', 'asc')->paginate(30);

		$this->layout->content = view('backend.deals.category.index', ['categories' => $categories]);
		return $this->layout;
	}

	public function getCreate() {

	
		$this->layout->content = view('backend.deals.category.form', ['category' => new DealCategory, 'page_title' => 'New Category']);
		return $this->layout;

	}

	public function getEdit( $categoryId ) {

		$category = DealCategory::find($categoryId);

		if (!$category) abort(404);

	
		$this->layout->content = view('backend.deals.category.form', ['category' => $category, 'page_title' => 'Edit Category']);

		return $this->layout;


	}

	public function postSave(\Illuminate\Http\Request $request) {

		$category = new DealCategory;

		$rules = 'create';

		$redirect = $this->adminBase('deal/category/create');


		if (!empty($request->get('categoryId'))) {
			$category = DealCategory::find($request->get('categoryId'));
			$redirect = $this->adminBase('deal/category/edit/' . $request->get('categoryId') );
			$rules = 'update';

			if (!$category) {
				abort(404);
			}
		}

		$valid = \Validator::make($request->all(), DealCategory::rules($rules));

		if ($valid->fails()) {
			return redirect($redirect)
			->withErrors($valid)
			->withInput($request->except('categoryImage'));
		}

		$image = Upload::move('deal/category', $request, 'categoryImage');

		
		$category->categoryName = $request->get('categoryName');
		//$category->categoryParentId = $request->get('categoryParentId');
		if (!empty($image)) {
			$category->categoryImage = $image;
		}	
		//$category->categoryPercentage = $request->get('categoryPercentage');

		if ( $category->save() ) {
			return redirect($this->adminBase('deal/category/edit/' . $category->categoryId));
		} 

		return redirect($redirect)->with(['message' => $this->alert('Unable to save category.', 'alert-danger')]);

	}

	public function getDelete($id) {

		$category = DealCategory::find($id);

		if (!$category) {
			abort(404);
		}
		
		$category ->delete();

		return redirect($this->adminBase('deal/category'))->with(['message' => $this->alert('Category deleted successfully.', 'alert-success')]);

	}
	
}