<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class UserDeal extends Model {

	protected $table = 'user_deals';





	public function deal() {

		return $this->belongsTo('App\Models\Deal', 'deal_id', 'offerId');

	}



	public function buyer() {

		return $this->belongsTo('App\Models\User', 'user_id', 'id');

	}



	public function vendor() {

		return $this->belongsTo('App\Models\User', 'user_id', 'id');

	}

	




}