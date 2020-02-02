<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class ActivityRate extends Model
{
    protected $table = 'activity_rates';
	protected $primaryKey = 'activity_rate_id';
	protected $fillable   = [

		'activity_rate_id',
		'activity_rate_description',
		'cost_centre_id',
		'activity_type_id',
		'employee_id',

		'activity_actual_rate',
		'activity_plan_rate',
		'billing_rate',

		'activity_validity_start',
		'activity_validity_end',

		'created_by',
		'changed_by',
		'status',

	];

	
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
