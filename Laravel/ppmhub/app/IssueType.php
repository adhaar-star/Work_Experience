<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class IssueType extends Model {

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $table    = 'issuetype';
    
    protected $fillable = [         
          'name'
                
    ];
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