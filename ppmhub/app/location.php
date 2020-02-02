<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model {

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $table    = 'state_subrub';
    
    protected $fillable = [
          'postcode',
          'subrub',
          'state',
          'latitude',
          'longitude',
          'created_by',
          'modified_by',
          'created_date',
          'modified_date',
          'status',
          'company_id',
          'deleted'  
    ];
    
    public $timestamps = false;
    
    
   /* 
    public function customer()
    {
        return $this->hasOne('App\Customer', 'id', 'customer_id');
    }


    public function user()
    {
        return $this->hasOne('App\User', 'id', 'user_id');
    }


    public function status()
    {
        return $this->hasOne('App\Status', 'id', 'status_id');
    }
    public function plan()
    {
        return $this->hasOne('App\Plans', 'id', 'plan_id');
    } */

    
    
    
}