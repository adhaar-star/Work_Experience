<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity_rates extends Model
{
    protected $table = 'activity_rates';
	protected $primaryKey = 'activity_rate_id';
	protected $fillable   = ['activity_rate_id','activity_actual_rate', 'activity_rate_description','activity_plan_rate','activity_type_id','cost_centre_id','employee_id','activity_validity_start','activity_validity_end','status','created_by','changed_by','billing_rate'];
	protected $activity_rate_id = 0;
	protected $activity_actual_rate = '';
	protected $activity_rate_description = '';
	protected $activity_plan_rate = '';
	protected $activity_type_id ='';
	protected $cost_centre_id ='';
	protected $employee_id ='';
	protected $activity_validity_start ='';
	protected $activity_validity_end ='';
	protected $status ='';
	protected $changed_by ='';
	protected $created_by ='';
	public $timestamps = true; // for false updated_at and created_at
	
	public function cost_centre()
    {
        return $this->belongsTo('App\Cost_centres', 'cost_centre_id');
    }
	
	public function activity_type()
    {
        return $this->belongsTo('App\Activity_types', 'activity_type_id');
    }
	
	public function employee_personnel_number()
    {
        return $this->belongsTo('App\Employee_records', 'employee_id');
    }
}
