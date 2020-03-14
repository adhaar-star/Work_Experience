<?php



namespace App\Models;



use Illuminate\Database\Eloquent\Model;



class WalletRequest extends Model {

    protected $table = 'wallet_request';
    public $timestamps = false;


    public function wallet(){

        return $this->belongsTo('App\Models\Wallet','user_id','user_id');
    }

    public function user(){

        return $this->belongsTo('App\Models\User','user_id','id');
    }

}
