<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model {


	protected $table = 'contact';
	public $timestamps = false;

	public static function rules(){

		$rules =  [
	      'name'  => 'required',
	      'email' => 'required',
	      'message' => 'required',
	   
	    ];

	    return $rules;
	}
}