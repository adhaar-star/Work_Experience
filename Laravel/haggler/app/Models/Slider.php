<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model {

	protected $table = 'slider';

	protected $hidden = ['created_at', 'updated_at'];


	public static function rules( $type = 'create' )
	{
	    $rules =  [
	      'title'   => 'required|max:200',
	      'image_1' => 'required|mimes:png,jpg,jpeg|max:2048',
	      'image_2' => 'mimes:png,jpg,jpeg|max:2048',
	      'image_3' => 'mimes:png,jpg,jpeg|max:2048',
	      'image_4' => 'mimes:png,jpg,jpeg|max:2048',

	    ];

	    return $rules;
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

	public function getMetaDataAttribute() {
		if (isset($this->attributes['meta_data']))
			return unserialize($this->attributes['meta_data']);
	}

	public function setMetaDataAttribute($value) {
			$this->attributes['meta_data'] = serialize($value);
	}

	public function getType($i) {

		$i = $i-1;

		$data = $this->getMetaDataAttribute();

		if (!empty($data[$i]['type']))
			return $data[$i]['type'];

	}

	public function getSource($i) {

		$i = $i-1;

		$data = $this->getMetaDataAttribute();

		if (!empty($data[$i]['source']))
			return $data[$i]['source'];

	}

	public function getID($i) {

		$i = $i-1;

		$data = $this->getMetaDataAttribute();

		if (!empty($data[$i]['id']))
			return $data[$i]['id'];

	}

	public function getImage($i) {

		$i = $i-1;
		
		$data = $this->getMetaDataAttribute();

		if (!empty($data[$i]['image']))
			return $data[$i]['image'];

	}

		

}