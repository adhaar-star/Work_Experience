<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageThread extends Model {
	
	protected $table = 'message_threads';

	 protected $fillable = ['receiver_id', 'sender_id', 'subject', 'last_message', 'last_update'];

	public $timestamps = false;


	public function receiver() {
	return $this->belongsTo('App\Models\User', 'receiver_id', 'id')->select('id', 'username');
	}

	public function sender() {
		return $this->belongsTo('App\Models\User', 'sender_id', 'id')->select('id', 'username');
	}

}