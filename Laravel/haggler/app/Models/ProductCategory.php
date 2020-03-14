<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model {

	protected $table = 'product_categories';

	public $timestamps = false;

	protected $hidden = ['created_at', 'updated_at'];
	
	public function category() {
		return $this->belongsTo('\App\Models\Category', 'categoryId', 'categoryId');
	}

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