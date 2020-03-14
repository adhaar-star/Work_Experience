<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	protected $table = 'products';

	protected $primaryKey = 'productId';


	protected $hidden = ['created_at', 'updated_at', 'productThumbnail'];




	public static function rules( $type = 'create' )
	{
	    $rules =  [
	      'productName'        => 'required|max:200',
	      'categoryIds' => 'array',
	      'productPrice' => 'numeric',
		  'productQuantity' => 'numeric',
	      'hasOffer'  => 'in:yes,no',
	      'offerName' => '',
	      'offerPrice' => 'required_if:hasOffer,yes',
	      'offerStartDate' => 'required_if:hasOffer,yes|date_format:Y-m-d',
	      'offerEndDate' => 'required_if:hasOffer,yes|date_format:Y-m-d',
	      'productDescription' => 'required',
	      'productTags' => 'max:250',
	      'productThumbnail'       => 'required|mimes:png,jpg,jpeg|max:2048',
	      'productImage1'       => 'required|mimes:png,jpg,jpeg|max:2048',
	      'productImage2'       => 'mimes:png,jpg,jpeg|max:2048',
	      'productImage3'       => 'mimes:png,jpg,jpeg|max:2048',
	      'productImage4'       => 'mimes:png,jpg,jpeg|max:2048',
	      'productImage5'       => 'mimes:png,jpg,jpeg|max:2048',
	    ];

	    if ($type == 'update') {
	    	unset($rules['productThumbnail']);
	    	unset($rules['productImage1']);
	    	unset($rules['productImage2']);
	    	unset($rules['productImage3']);
	    	unset($rules['productImage4']);
	    	unset($rules['productImage5']);

	    }

	    return $rules;
	}
	

	public function toArray()
    {
        $array = parent::toArray();
        $array['image'] = $this->getThumbnailAttribute();

        foreach ($array as $k => $v) {
			if (empty($v)) {
				$array[$k] = "";
			} else {
				$array[$k] = $v;
			}
		}
		
        return $array;
    }
   
	public function getThumbnailAttribute() {
		if (!isset($this->attributes['productThumbnail'])) return null;
		return \URL::to('assets/images/product/' . $this->attributes['productThumbnail'] );
	}

	public function vendor() {
		return $this->belongsTo('\App\Models\User', 'productVendorId', 'id');
	}

	public function store() {
		return $this->belongsTo('\App\Models\Store', 'productVendorId', 'vendorId');
	}
	
	

	public function categories() {
		return $this->hasMany('\App\Models\ProductCategory', 'productId', 'productId')->with('category');
	}

	public function images() {
		return $this->hasOne('\App\Models\ProductMedia', 'productId', 'productId');
	}
	
	public function likes() {
	
		return $this->hasOne('\App\Models\ProductLike','productId', 'productId');
	}
	
	public function userlikes() {
		return $this->hasMany('\App\Models\ProductLike', 'user_id','user_id');
	}

	public static function categoryNames($product) {

		$categories = "-";
		if (!empty($product->categories->all())) {
			$categories = [];

			foreach ($product->categories as $item) {
				array_push($categories, @$item->category->categoryName);
			}

			$categories = implode(',', $categories);

		}

		return $categories;
	}

	public static function getAttributeValues($product, $type) {

		$value = null;

		if (!empty($product->product_attributes->all())) {
			$v = [];
			foreach ($product->product_attributes as $attr) {
				if ($attr->key_name == $type) {
					array_push($v, $attr->value);
				}
				$value = implode(',', $v);
			}
		}

		return $value;

	}

	public function getofferStartDateAttribute() {
		if (isset($this->attributes['offerStartDate']) && $this->attributes['offerStartDate'] !== '0000-00-00') {
			return $this->attributes['offerStartDate'];
		}
	}

	public function getofferEndDateAttribute() {
		if (isset($this->attributes['offerEndDate']) && $this->attributes['offerEndDate'] !== '0000-00-00') {
			return $this->attributes['offerEndDate'];
		}
	}


	public function product_attributes() {
		return $this->hasMany('\App\Models\ProductAttribute', 'productId', 'productId');
	}

	public function color() {
		return $this->hasMany('\App\Models\ProductAttribute', 'productId', 'productId')->where('key_name', 'color');
	}

	public function size() {
		return $this->hasMany('\App\Models\ProductAttribute', 'productId', 'productId')->where('key_name', 'size');
	}


}