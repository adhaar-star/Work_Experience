<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model {
	
	protected $table = 'messages';

	public $timestamps = false;

	public static function send($from, $to, $message) {

	}

	public function receiver() {
		return $this->belongsTo('App\Models\User', 'receiver_id', 'id')->select('id', 'username');
	}

	public function sender() {
		return $this->belongsTo('App\Models\User', 'sender_id', 'id')->select('id', 'username');
	}

}