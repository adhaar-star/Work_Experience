<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class Order extends Model {

	

	protected $table = 'orders';



	public static function rules() {

		return [

			//'name' => 'required|max:100',

			//'email'	=> 'email|required',

			//'telephone' => 'required|max:16',

			//'address'	=>	'required|max:200',

			//'city'	=> 'required|max:30',

			//'state'	=> 'required|max:30',

			//'zipcode' => 'required|max:7',

			//'shipping_name' => 'required|max:100',

			//'shipping_email'	=> 'email',

			//'shipping_telephone' => 'required|max:16',

			//'shipping_address'	=>	'required|max:200',

			//'shipping_city'	=> 'required|max:30',

			//'shipping_state'	=> 'required|max:30',

			//'shipping_zipcode' => 'required|max:7',

			//'total' => 'required|numeric',

			'order_status' => 'in:pending,confirmed,shipped,cancelled,delivered,returned',



		];

	}



	public function vendor() {

		return $this->belongsTo('App\Models\User', 'user_id', 'id')->select('id', 'firstname', 'lastname');

	}



	public function user() {

		return $this->belongsTo('App\Models\User', 'user_id', 'id');

	}



	public function items() {

		return $this->hasMany('App\Models\OrderItem', 'order_id', 'id');

	}

	public static function orderStatus(){

		return  [
          'pending' => 'pending',
          'confirmed' => 'confirmed',
          'shipped' => 'shipped',
          'delivered' => 'delivered',
          'cancelled' => 'cancelled',
          'returned' => 'returned'
		];

		
	}



}