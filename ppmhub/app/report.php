<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;


use Illuminate\Database\Eloquent\SoftDeletes;

class Report extends Model {

    /**
    * The attributes that should be mutated to dates.
    *
    * @var array
    */
    protected $table    = 'portfolio';
    
    protected $fillable = [
          'name',
          'port_id',
          'type',
          'currency',
          'planning_unit',
          'capacity_unit',
          'description',
          'created_by',
          'updated_by',
          'updated_at',
          'created_at',
          'company_id',
          'status',
          'deleted',
    ];
   
    public function currency()
    {
        return $this->hasOne('App\Currency', 'short_code', 'currency');
    }
    public function portfolio_type()
    {
        return $this->hasOne('App\Reporttype', 'id', 'type');
    }
     public function capacity_units()
    {
        return $this->hasOne('App\Capacityunits', 'id', 'capacity_unit');
    }
     public function planning_units()
    {
        return $this->hasOne('App\Planningunit', 'id', 'planning_unit');
    }
    public function portfolio_buckets()
    {
        return $this->hasOne('App\Buckets', 'id', 'buckets');
    }
    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }
    public function updator() {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }
    

 /*
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