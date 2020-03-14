<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model {

	protected $table = 'address';

	protected $primaryKey = 'id';


	protected $hidden = ['created_at', 'updated_at', 'id', 'userId'];


	public static function rules()
	{
	    $rules =  [
	      'name'        => 'required|max:100',
	      'address' => 'required|max:200',
	      'city' => 'required|max:30',
	      'state' => 'required|max:30',
	      'country' => 'required|max:30',
	      'zipcode' => 'required|min:6|max:7',
	      'type'  => 'required|in:billing,shipping',

	    ];

	   
	    return $rules;
	}

	public function user() {
		return $this->belongsTo('\App\Models\User', 'userId', 'id');
	}
	
	
}