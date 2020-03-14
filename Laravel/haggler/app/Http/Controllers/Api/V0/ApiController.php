<?php

namespace App\Http\Controllers\Api\V0;

use App\Models\Helper;


class ApiController extends \App\Http\Controllers\Controller {

	protected $data = [];
	protected $error = '';
	protected $success = true;
	protected $messages;
	protected $disableSecurity = true;
	
	
	public function __construct() {

		$this->messages = new \stdclass;
		
		
		if (!$this->disableSecurity) {
			$this->middleware('api');
		}

		

	}

	protected function addError($key) {
		$this->error = $key;
		$this->success = false;
	}

	protected function addMessage($key, $message = null) {

		if (!is_array($this->messages)) {
			$this->messages = [];
		}

		if (is_null($message)) {
			$this->messages = $key;
		} else {

			$this->messages[$key] = $message;
		}

	}

	protected function response($data = [], $status = 200) {
		
		$out = $this->getResponse($data);

		return response()->json($out);
	}

	protected function getResponse($data = []) {
		$out['success'] = $this->success;
		$out['error'] = $this->error;
		$out['data'] = $data;
		$out['messages'] = $this->messages;

		return $out;
	}

	

}