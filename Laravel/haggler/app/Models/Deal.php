<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deal extends Model {

	protected $table = 'deals';

	protected $primaryKey = 'offerId';


	protected $hidden = ['created_at', 'updated_at'];


	public static function rules( $type = 'create', $id = null )
	{
	    $rules =  [
	      'offerName'        => 'required|max:200',
	      'offerVendorId' => 'required|int',
	      'offerCategoryId' => 'required|int',
	      'offerHighlightedText'  => 'required|max:250',
	      'image_1'       => 'required|mimes:png,jpg,jpeg|max:2048',
	      'image_2'       => 'mimes:png,jpg,jpeg|max:2048',
	      'image_3'       => 'mimes:png,jpg,jpeg|max:2048',
	      'image_4'       => 'mimes:png,jpg,jpeg|max:2048',
	      'offerType' => 'in:free,exclusive',
	      //'offerDiscount' => 'required|numeric',
	      'offerDiscountType' => 'required|in:fixed,flexiable',
	      'offerPrice' => 'required_if:offerType,exclusive|numeric',
	      'offerStartDate' => 'required|date_format:Y-m-d',
	      'offerEndDate' => 'required|date_format:Y-m-d',
	      'offerStatus' => 'in:0,1',
	      'offerTerms' => 'required',
	      'offerTags' => 'max:250'
	    ];

	    if ($type == 'update') {
	    	unset($rules['image_1']);
	    }

	    return $rules;
	}

	public function toArray()
    {
        $array = parent::toArray();
        $array['image'] = $this->getofferImageAttribute();
        $array['offerImage'] = $this->getofferImageAttribute();
        $array['offerOriginalImage'] = \URL::to('assets/images/category/' . $this->attributes['offerImage'] );

 

		foreach ($array as $k => $v) {
			if (empty($v)) {
				$array[$k] = "";
			} else {
				$array[$k] = $v;
			}
		}
			
		

        return $array;
    }

	public function getofferImageAttribute() {

		if (!isset($this->attributes['offerImage'])) return "";

		return \URL::to('assets/images/deal/' . $this->attributes['offerImage'] );
	}

	public function getImageSrc() {
		return url('assets/images/store', [$this->storeImage]);
	}

	public function vendor() {
		return $this->belongsTo('\App\Models\User', 'offerVendorId', 'id');
	}

	public function category() {
		return $this->belongsTo('\App\Models\DealCategory', 'offerCategoryId', 'categoryId');
	}

	public function store() {
		return $this->belongsTo('\App\Models\Store', 'offerVendorId', 'vendorId');
	}

	public function images() {
		return $this->hasOne('\App\Models\DealImage', 'deal_id', 'offerId');
	}

	public function delete() {

		if (!empty($this->attributes['offerImage'])) {

			@unlink(public_path('assets/images/deal/thumb-' . $this->attributes['offerImage']));
			@unlink(public_path('assets/images/deal/' . $this->attributes['offerImage']));
		}

		return parent::delete();
	}

}