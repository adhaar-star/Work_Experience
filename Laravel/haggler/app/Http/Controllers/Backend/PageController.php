<?php


namespace App\Http\Controllers\Backend;

use App\Models\Page;


class PageController extends BackendController {

	public function __construct() {
		parent::__construct();
	
		view()->share(['active_nav' => 'page']);
			
	}

	public function getManage() {
		$pages = Page::orderBy('title', 'asc')->paginate(30);

		$this->layout->content = view('backend.page.index', ['pages' => $pages]);
		return $this->layout;
	}

	
	public function getCreate() {


		$this->layout->content = view('backend.page.form', ['page' => new Page, 'page_title' => 'New Page']);
		return $this->layout;

	}

	public function getEdit( $id ) {

		$page = Page::find($id);

		if (!$page) abort(404);


		$this->layout->content = view('backend.page.form', ['page' => $page,  'page_title' => 'Edit Page']);

		return $this->layout;


	}

	public function postSave(\Illuminate\Http\Request $request) {

		$page = new Page;

		$rules = 'create';

		
		if (!empty($request->get('id'))) {
			$page = Page::find($request->get('id'));
			$rules = 'update';

			if (!$page) {
				abort(404);
			}
		}

		$valid = \Validator::make($request->all(), Page::rules($rules, $page->id));

		if ($valid->fails()) {
			return redirect()->back()
			->withErrors($valid)
			->withInput($request->all());
		}

	
		$page->title = $request->get('title');
		$page->slug = $request->get('slug');
		$page->label = $request->get('label');
		$page->content = $request->get('content');
		

		if ( $page->save() ) {
			return redirect($this->adminBase('page/manage'));
		} 

		return redirect()->back()->with(['message' => $this->alert('Unable to save page.', 'alert-danger')])->withInput($request->all());

	}

	public function getDelete($id) {

		$page = Page::find($id);

		if (!$page) {
			abort(404);
		}
		
		$page ->delete();

		return redirect($this->adminBase('page/manage'))->with(['message' => $this->alert('Page deleted successfully.', 'alert-success')]);

	}
	
}