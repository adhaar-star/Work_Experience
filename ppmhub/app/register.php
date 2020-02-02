<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class register extends Model {

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $table    = 'users';
    
    protected $fillable = [
          'name',
          'lname',
          'email',
          'password',
          'phone',
          'verify_code',
          'company_id',
          'role_id',
          'remember_token',
          'created_at',
          'updated_at',
          'status',
          'is_deleted'  
    ];
     public function roles_master()
    {
        return $this->hasOne('App\roles_master', 'id', 'role_id');
    }
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