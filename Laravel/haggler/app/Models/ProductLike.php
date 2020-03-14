<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLike extends Model {

	protected $table = 'product_likes';

	public $timestamps = false;

	//protected $hidden = ['productId', 'id', 'user_id', 'likes'];


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
	public function product() {
		return $this->hasOne('\App\Models\Product', 'productId', 'productId')->selectRaw('productId as id, productId, productName as name, productPrice as price,productThumbnail as image, productThumbnail');
	}
	
}