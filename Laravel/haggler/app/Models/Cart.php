<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {
	
	protected $table = 'cart';

	public $timestamps = false;

	public function product() {
		return $this->hasOne('\App\Models\Product', 'productId', 'product_id')->selectRaw('productId as id, productId, productName as name, productVendorId, productPrice as price,productQuantity as quantity, productDescription as description, hasOffer, offerName, offerPrice, offerStartDate, offerEndDate, productTags as tags, productThumbnail as image, productThumbnail');
	}

}