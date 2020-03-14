<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductMedia extends Model {

	protected $table = 'product_media';

	public $timestamps = false;

	public function toArray() {
		parent::toArray();
		$array = [];
		if (!empty($this->getproductImage1Attribute())) {
			$array[] = $this->getproductImage1Attribute();
		}
		
		if (!empty($this->getproductImage2Attribute())) {
			$array[] = $this->getproductImage2Attribute();
		}

		if (!empty($this->getproductImage3Attribute())) {
			$array[] = $this->getproductImage3Attribute();
		}

		if (!empty($this->getproductImage4Attribute())) {
			$array[] = $this->getproductImage4Attribute();
		}

		foreach ($array as $k => $v) {
			/*if (empty($v)) {
				$array[$k] = "";
			} else {
				$array[$k] = $v;
			}*/

			if (!empty($v) && !is_null($v)) {
				$array[$k] = $v;
			} 
		}
		
		return $array;
	}

	public function getproductImage1Attribute() {
		if (!empty($this->attributes['productImage1'])) {
			return url('assets/images/product/' . $this->attributes['productImage1']); 
		}
	}

	public function getproductImage2Attribute() {
		if (!empty($this->attributes['productImage2'])) {
			return url('assets/images/product/' . $this->attributes['productImage2']); 
		}
	}

	public function getproductImage3Attribute() {
		if (!empty($this->attributes['productImage3'])) {
			return url('assets/images/product/' . $this->attributes['productImage3']); 
		}
	}

	public function getproductImage4Attribute() {
		if (!empty($this->attributes['productImage4'])) {
			return url('assets/images/product/' . $this->attributes['productImage4']); 
		}
	}

	
}