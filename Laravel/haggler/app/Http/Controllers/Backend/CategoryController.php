<?php


namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Upload;
use App\Models\ProductCategory;
use App\Models\Product;

class CategoryController extends BackendController {

	public function __construct() {
		parent::__construct();
	
		view()->share(['active_nav' => 'category']);
			
	}

	public function getIndex() {
		$categories = Category::with('parent_category')->orderBy('categoryName', 'asc')->paginate(30);

		$this->layout->content = view('backend.category.index', ['categories' => $categories]);
		return $this->layout;
	}

	public function getTreeView() {
		$categories = Category::with('children')->orderBy('categoryName', 'asc')->where('categoryParentId', 0)->get();

		$this->layout->content = view('backend.category.tree', ['categories' => $categories]);
		return $this->layout;
	}


	public function getCreate() {

		$categories = Category::where('categoryParentId', 0)->get();

		$this->layout->content = view('backend.category.form', ['category' => new Category, 'categories' => $categories->all(), 'page_title' => 'New Category']);
		return $this->layout;

	}

	public function getEdit( $categoryId ) {

		$category = Category::find($categoryId);

		if (!$category) abort(404);

		$categories = Category::where('categoryParentId', 0)->get();

		$this->layout->content = view('backend.category.form', ['category' => $category, 'categories' => $categories->all(), 'page_title' => 'Edit Category']);

		return $this->layout;


	}

	public function postSave(\Illuminate\Http\Request $request) {

		$category = new Category;

		$rules = 'create';

		$redirect = $this->adminBase('category/create');


		if (!empty($request->get('categoryId'))) {
			$category = Category::find($request->get('categoryId'));
			$redirect = $this->adminBase('category/edit/' . $request->get('categoryId') );
			$rules = 'update';

			if (!$category) {
				abort(404);
			}
		}

		$valid = \Validator::make($request->all(), Category::rules($rules));

		if ($valid->fails()) {
			return redirect($redirect)
			->withErrors($valid)
			->withInput($request->except('categoryImage'));
		}

		$image = Upload::move('category', $request, 'categoryImage',false);

		
		$category->categoryName = $request->get('categoryName');
		$category->categoryParentId = $request->get('categoryParentId');
		if (!empty($image)) {
			$category->categoryImage = $image;
		}	
		$category->categoryPercentage = $request->get('categoryPercentage');

		if ( $category->save() ) {
			return redirect($this->adminBase('category/tree-view'));
		} 

		return redirect($redirect)->with(['message' => $this->alert('Unable to save category.', 'alert-danger')]);

	}

	public function getDelete($id) {

		$category = Category::find($id);
		if (!$category) {
			abort(404);
		}

		 $catDel = [];
		 $proDel = [];

		 
		 array_push($catDel,$id);
		
		

			$cat1 = Category::where('categoryParentId',$id)->get();
			if(!empty($cat1->all())){

				foreach($cat1->all() as $c1){
				
                   array_push($catDel,$c1->categoryId);
				}

				if(!empty($catDel)){
                   
                   $cat2 = Category::whereIn('categoryParentId',$catDel)->get();
                   if(!empty($cat2->all())){
                      foreach($cat2->all() as $c2){
				
                           array_push($catDel,$c2->categoryId);
				     }

                   }

				}
			}
      
			if($category->categoryParentId == 0){

				$pd = ProductCategory::whereIn('categoryId',$catDel)->get();
				if(!empty($pd)){

					foreach($pd->all() as $pr){

						array_push($proDel,$pr->productId);
					}
				}
			}

			// echo "Category to be deleted -->";
			// echo "<pre>";
			//   print_r($catDel);
			// echo "</pre>";

			// echo "<br/>";
			// echo "Product to be deleted -->"."<br/>";
			// echo "<pre>";
			//   print_r($proDel);
			// echo "</pre>";
			// exit;
			

		

		
		
		//$category ->delete();

		Category::whereIn('categoryId',$catDel)->delete();
		ProductCategory::where('categoryId',$id)->delete();
		ProductCategory::whereIn('productId',$proDel)->delete();
		Product::whereIn('productId',$proDel)->delete();

		return redirect($this->adminBase('category/tree-view'))->with(['message' => $this->alert('Category deleted successfully.', 'alert-success')]);

	}

	public function getSearch(\Illuminate\Http\Request $request) {
		return Category::select('categoryName as label', 'categoryId as id')->where('categoryName', 'like', $request->get('term') . "%")->orderBy('categoryName', 'asc')->get();

	}
	
}