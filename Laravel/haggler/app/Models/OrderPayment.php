<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderPayment extends Model {

	protected $table = 'order_payments';

	 protected $fillable = ['order_id', 'status', 'txn_id', 'payloads'];

	 public $timestamps = false;

	public static function rules() {

		return [
			'status' => 'required',
			'txn_id'	=> 'required',
			'payloads'	=> 'required'
		];

	}

	public function order() {
		return $this->belongsTo('App\Models\Order', 'order_id', 'id');
	}

}