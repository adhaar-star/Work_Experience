<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {

	protected $table = 'pages';

	protected $primaryKey = 'id';


	public $timestamps = false;


	public static function rules($what = 'create', $id = null)
	{
	    $rules =  [
	      'slug'  => 'required|max:200|unique:pages,slug',
	      'title' => 'required|max:180',
	      'content' => 'required',
	   
	    ];
		
		if ($what == 'update') {
			$rules['slug'] = 'required|unique:pages,slug,'.$id;
		}
	   
	    return $rules;
	}

	public function setContentAttribute($value) {
		$this->attributes['content'] = htmlspecialchars($value);
	}
	
	public function getContentAttribute() {
		if (empty($this->attributes['content'])) return '';
		
		return htmlspecialchars_decode($this->attributes['content']);
	}
	
	
}