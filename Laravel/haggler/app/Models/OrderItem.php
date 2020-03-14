<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class OrderItem extends Model {

	

	protected $table = 'order_items';
	public $timestamps = false;



	 protected $fillable = ['order_id', 'name', 'size', 'color', 'quantity', 'price', 'total'];



	



	public function order() {

		return $this->belongsTo('App\Models\Order', 'order_id', 'id');

	}

	public function vendor() {
		return $this->belongsTo('\App\Models\User', 'productVendorId', 'id');
	}

	public function product() {
		return $this->hasOne('\App\Models\Product', 'productId', 'product_id')->selectRaw('productId as id, productId, productName as name, productVendorId, productPrice as price,productQuantity as quantity, productDescription as description, hasOffer, offerName, offerPrice, offerStartDate, offerEndDate, productTags as tags, productThumbnail as image, productThumbnail');
	}
	

	public function product_image() {
		return $this->belongsTo('App\Models\Product', 'product_id', 'productId')->select('productThumbnail', 'productId');
	}



}