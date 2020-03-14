<?php

namespace App\Http\Controllers\Api\V1;

use \App\Models\Address;

class UserController extends ApiController {

	protected $disableSecurity = false;
	
	
	public function getAddress(\Illuminate\Http\Request $request) {

		$address = new Address;

		if ($request->has('type')) {
			$address = $address->where('type', $request->get('type'));
		}

		$address = $address->where('userId', \Auth::id())->get();
		
		return $this->response($address);

	}

	public function postAddress(\Illuminate\Http\Request $request) {

		$valid = \Validator::make($request->all(), Address::rules());

		if ($valid->fails()) {
			$this->addMessage($valid->errors());
			$this->addError('Validation errors');
			return $this->response();
		}



		$address = new Address;

	
		$oldAddress = Address::where('userId', \Auth::id())->where('type', $request->get('type'))->first();

		if ($oldAddress) {
			$address = Address::find($oldAddress->id);
		}

		

		$address->userId = \Auth::id();
		$address->name = $request->get('name');
		$address->address = $request->get('address');
		$address->city = $request->get('city');
		$address->state = $request->get('state');
		$address->country = $request->get('country');
		$address->zipcode = $request->get('zipcode');
		$address->type = $request->get('type');

		if (!$address->save()) {
			$this->addError('Unable to save address');
		}

		return $this->response();


	}



}