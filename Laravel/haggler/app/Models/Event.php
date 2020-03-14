<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model {

	protected $table = 'events';

	protected $primaryKey = 'eventId';


	protected $hidden = ['created_at', 'updated_at'];


	public static function rules( $type = 'create' )
	{
	    $rules =  [
	      'eventTitle'        => 'required|max:200',
	      'eventImage'       => 'required|mimes:png,jpg,jpeg|max:2048',
	      'eventStartDate' => 'required|date_format:Y-m-d',
	      'eventEndDate' => 'required|date_format:Y-m-d',
	      'offerStatus' => 'in:active,inactive',
	      'eventDescription' => 'required',
	      'eventAddress' => 'required|max:250'
	    ];

	    if ($type == 'update') {
	    	unset($rules['eventImage']);
	    }

	    return $rules;
	}

	public function toArray() {
		$array = parent::toArray();

		$array['image'] = [$this->geteventImageAttribute()];
		$array['eventImage'] = $this->geteventImageAttribute();

		foreach ($array as $k => $v) {
			if (empty($v)) {
				$array[$k] = "";
			} else {
				$array[$k] = $v;
			}
		}

		return $array;
	}

		
	public function geteventImageAttribute() {

		if (!isset($this->attributes['eventImage'])) return "";

		return \URL::to('assets/images/event/' . $this->attributes['eventImage'] );
	}

	public function delete() {

		if (!empty($this->attributes['eventImage'])) {

			@unlink(public_path('assets/images/event/thumb-' . $this->attributes['eventImage']));
			@unlink(public_path('assets/images/event/' . $this->attributes['eventImage']));
		}

		return parent::delete();
	}

	

}