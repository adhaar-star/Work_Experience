<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Page;

class PageController extends \App\Http\Controllers\Controller {
	
	public function getIndex($slug) {

		$orginal_slug = str_replace('.html', '', $slug);

		$p = Page::where('slug', $orginal_slug)->first();

		return view('api.page_layout',['title' => $p->title, 'content' => $p->content]);

	}

}