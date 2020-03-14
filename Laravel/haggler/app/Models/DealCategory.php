<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DealCategory extends Model {

	protected $table = 'deal_categories';

	protected $primaryKey = 'categoryId';


	protected $hidden = ['created_at', 'updated_at'];


	public static function rules( $type = 'create' )
	{
	    $rules =  [
	      'categoryName'        => 'required|max:100',
	      'categoryParentId' => 'int',
	      'categoryPercentage'  => 'numeric',
	      'categoryImage'       => 'mimes:png,jpg,jpeg|max:2048'
	    ];

	    if ($type == 'update') {
	    	unset($rules['categoryImage']);
	    }

	    return $rules;
	}

	public function parent_category() {
		return $this->hasOne('\App\Models\DealCategory', 'categoryId', 'categoryParentId');
	}
	
	public function toArray()
    {
        $array = parent::toArray();
        $array['thumbnail'] = $this->getcategoryImageAttribute();
        $array['image'] = empty($this->attributes['categoryImage']) ? null : \URL::to('assets/images/deal/category/' . $this->attributes['categoryImage'] );
        
        foreach ($array as $k => $v) {
			if (empty($v)) {
				$array[$k] = "";
			} else {
				$array[$k] = $v;
			}
		}
		
        return $array;
    }
    
	public function getcategoryImageAttribute() {

		if (!isset($this->attributes['categoryImage'])) return null;

		return \URL::to('assets/images/deal/category/'. $this->attributes['categoryImage'] );
	}

	public function delete() {

		if (!empty($this->attributes['categoryImage'])) {
			@unlink(public_path('assets/images/deal/category/thumb-' . $this->attributes['categoryImage']));
			@unlink(public_path('assets/images/deal/category/' . $this->attributes['categoryImage']));
		}

		return parent::delete();
	}


}