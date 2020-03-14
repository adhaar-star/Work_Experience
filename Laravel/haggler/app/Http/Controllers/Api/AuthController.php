<?php

namespace App\Http\Controllers\Api;

class AuthController extends ApiController {
	
	public function postLogin() {

		$valid = \Validator::make($request->all(), [
				'username' => 'required',
				'password' => 'required'
			]);

		if ($valid->fails()) {
			$this->addError('Invalid login details');
			return $this->response([], 401);
		}

		$field = filter_var($request->get('username'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

		$auth = \Auth::attempt([
        $field  => $request->get('username'),
        'password' => $request->get('password'),
        'status' => 'active']);

		if (!$auth) {
			$this->addError('Username or password is incorrect');
			return $this->response([], 401);
		}

		$user = \Auth::user();

		return $this->response($user);

	}

	
	public function postLogout() {

	}

}