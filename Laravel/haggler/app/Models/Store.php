<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Store extends Model {

	protected $table = 'stores';

	protected $primaryKey = 'storeId';


	protected $hidden = ['created_at', 'updated_at'];


	public static function rules( $type = 'create' )
	{
	    $rules =  [
	      'storeName'        => 'required',
	      'storeDescription' => 'required',
	      'storeImage'       => 'required|mimes:png,jpg,jpeg|max:2048',
	      'address'			=> 'required',
	      'city'			=> 'required',
	      'state'			=> 'required',
	      'lat'				=> 'required',
	      'lng'  			=> 'required'
	    ];

	    if ($type == 'update') {
	    	unset($rules['storeImage']);
	    }

	    return $rules;
	}

	public function toArray() {
		$array = parent::toArray();
		$array['storeImage'] = $this->getstoreImage();

		foreach ($array as $k => $v) {
			if (empty($v)) {
				$array[$k] = "";
			} else {
				$array[$k] = $v;
			}
		}

		return $array;
	}

	
	public function getstoreImage() {
		if (empty($this->attributes['storeImage'])) return "";

		return url('assets/images/store', [$this->attributes['storeImage']]);
	}

	public function getvendorProfilePic() {
		return $this->getstoreImage();
	}
		
	public function getstoreImageAttribute() {

		if (!isset($this->attributes['storeImage'])) return "";

		return \URL::to('assets/images/store/' . $this->attributes['storeImage'] );
	}

	public function setstoreDescriptionAttribute($v) {
		$this->attributes['storeDescription'] = htmlspecialchars($v);
	}

	public function getstoreDescriptionAttribute() {
		if (isset($this->attributes['storeDescription'])) 
			return htmlspecialchars_decode($this->attributes['storeDescription']);
		
	}

	public function getFollowersAttribute() {

		if (empty($this->attributes['followers']) || @$this->attributes['followers'] == 0) return 0;

		return $this->attributes['followers']; 
	}




}