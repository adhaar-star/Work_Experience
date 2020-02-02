<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Portfolioresourceplanning extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'portfolio_resource_planning';
    
    public $timestamp = true;

    protected $fillable = [
        'resource_planning_id',
        'resource_planning_name',
        'portfolio_id',
        'portfolio_name',
        'total_period',
        'distribute',
        'planning_start',
        'planning_end',
        'planning_unit',
        'added_by',
        'created_by',
        'created_date',
        'edited_by',
        'edited_date',
        'status',
        'is_delete',
        'created_at',
        'updated_at',
        'planning_type',
        'view_type',
        'costing_type',
        'collection_type',
        'bucket',
        'currency'
    ];
	
	 public function portfolio()
      {
		//return $this->hasOne('App\Portfolio', 'portfolio_id', 'id');
		return $this->belongsTo(Portfolio,'portfolio_id');
      }
	
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