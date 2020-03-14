<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Support\Facades\Auth;
use App\Models\Helper;
use App\Models\Message;
use App\Models\MessageThread;

class BackendController extends \App\Http\Controllers\Controller {
	
	protected $disableSecurity = false;

	public function __construct() {
		parent::__construct();

		if (!$this->disableSecurity) {
			$this->middleware('auth');
		}

		$id = Auth::id();

		$result = Message::where('is_read', '=', 0)->where('receiver_id', '=', $id)->get();
		$count = count($result);
		$thread_ids = [];
		foreach ($result as $res) {
			$thread_ids[] = $res->thread_id;
		}
		if($count > 0){
			view()->share(['header_title' => 'Haggler Portal', 'title' => 'Haggler Portal', 'page_title' => 'Haggler', 'active_nav' => '', 'count_message' => $count, 'thread_ids' => $thread_ids]);
		}else{
			$count = '';
			view()->share(['header_title' => 'Haggler Portal', 'title' => 'Haggler Portal', 'page_title' => 'Haggler', 'active_nav' => '', 'count_message' => $count, 'thread_ids' => $thread_ids]);
		}
	
		$this->layout = view('layouts.backend');

		if (\Auth::check()) {
			$this->layout->navbar = view('backend.partials.navbar');
		}
	}

	protected function adminBase( $uri = null ) {
		return Helper::adminBase( $uri );
	}

}