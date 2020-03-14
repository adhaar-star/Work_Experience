<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductAttribute extends Model {

	protected $table = 'product_attributes';

	public $timestamps = false;

	protected $hidden = ['productId', 'id', 'custom_price', 'price'];


	public function toArray()
    {
        $array = parent::toArray();

        foreach ($array as $k => $v) {
			if (empty($v)) {
				$array[$k] = "";
			} else {
				$array[$k] = $v;
			}
		}
		
        return $array;
    }
	
}