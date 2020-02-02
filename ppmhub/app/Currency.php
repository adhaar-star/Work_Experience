<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Currency extends Model {

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'currencies';
    
    
    
    protected $fillable = [
        'short_code',
        'fullname',
        'status',
        'company_id'
    ];
    public $timestamps = true;
      

    /*
     * public function customer()
     * {
     * return $this->hasOne('App\Customer', 'id', 'customer_id');
     * }
     *
     *
     * public function user()
     * {
     * return $this->hasOne('App\User', 'id', 'user_id');
     * }
     *
     *
     * public function status()
     * {
     * return $this->hasOne('App\Status', 'id', 'status_id');
     * }
     * public function plan()
     * {
     * return $this->hasOne('App\Plans', 'id', 'plan_id');
     * }
     */
}
