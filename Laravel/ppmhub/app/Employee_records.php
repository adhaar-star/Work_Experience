<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Employee_records extends Model
{

    /**
     * Added just to demonstrate that models work
     * @return String
     */
    protected $table = 'employee_records';
    protected $primaryKey = 'employee_id';
    protected $fillable = [
        'email_id',
        'employee_first_name',
        'employee_middle_name',
        'employee_last_name',
        'employee_dob',
        'employee_user_id',
        'employee_birth_country',
        'employee_type',
        'employee_cost_centre',
        'employee_activity_type',
        'employee_role',
        'employee_timesheet_profile',
        'employee_start',
        'employee_end',
        'status',
        'created_by',
        'updated_by',
        'company_id'
    ];
    protected $editable = [
        'email_id',
        'employee_first_name',
        'employee_middle_name',
        'employee_last_name',
        'employee_dob',
        'employee_user_id',
        'employee_birth_country',
        'employee_type',
        'employee_cost_centre',
        'employee_activity_type',
        'employee_role',
        'employee_timesheet_profile',
        'employee_start',
        'employee_end',
        'status'
    ];

    public function getEditable()
    {
        return $this->editable;
    }

    public  function users_name()
    {
        return $this->belongsTo('App\User', 'employee_user_id');
    }

    public function cost_centre()
    {
        return $this->belongsTo('App\Cost_centres', 'employee_cost_centre');
    }

    public function activity_type()
    {
        return $this->belongsTo('App\Activity_types', 'employee_activity_type');
    }

    public function timesheet_profile_name()
    {
        return $this->belongsTo('App\Timesheet_profile', 'employee_timesheet_profile');
    }

    public function creator()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

    public function updator()
    {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }

    function scopeByCompany($query, $company_id=false)
    {
        return $query->where('company_id', ($company_id) ? $company_id : Auth::user()->company_id );
    }
    public function getFullNameAttribute()
    {
        return preg_replace('/\s+/', ' ',$this->employee_first_name.' '.$this->employee_middle_name.' '.$this->employee_last_name);
    }


}
