<?php

namespace App\Http\Controllers\Api\V1;

use \App\Models\User; 

class AuthController extends ApiController {
	
	public function postLogin(\Illuminate\Http\Request $request) {

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
        'status' => 'active',
        //'role' => 'customer'
        ]);

		if (!$auth) {
			$this->addError('Username or password is incorrect');
			return $this->response([], 401);
		}

		$user = \Auth::user();
		$user->api_token = str_random(rand(40,60));
		$user->save();

		return $this->response($user);

	}

	
	public function getLogout() {

		
		if (!\Auth::check()) {
			$this->addError('You are already logout');
			return $this->response();
		}
		$user = \Auth::user();
		$user->api_token = null;
		$user->save();

		return $this->response();

	}

	public function postRegister(\Illuminate\Http\Request $request) {

		$valid = \Validator::make($request->all(), [
				'username'        => 'required|unique:users,username',
		        'email' => 'required|email|unique:users,email',
		        'password' => 'required|min:5',
			]);

		if ($valid->fails()) {
			$this->addMessage($valid->errors());
			$this->addError('Validation errors');
			return $this->response();
		}

		$user = new User();
		$user->api_token = str_random(rand(40,60));
		$user->username = $request->get('username');
		$user->password = $request->get('password');
		$user->email = $request->get('email');
		$user->status = 'active';
		$user->role = 'customer';
		if ($user->save()) return $this->response($user);


		$this->addError('Unable to process request');
		return $this->response();

	}

}