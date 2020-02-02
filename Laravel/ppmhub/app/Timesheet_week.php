<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet_week extends Model
{
    protected $table = 'timesheet_week_entries';
	protected $primaryKey = 'timesheet_week_id';
	protected $fillable   = ['timesheet_week_id','employee_id', 'week_number','week_dates','monday_total_time','tuesday_total_time','wednesday_total_time','thursday_total_time','friday_total_time','saturday_total_time','sunday_total_time','employee_cost_centre','employee_activity_type','employee_timesheet_profile','approver_id','approver_status','status','created_by','changed_by'];
	protected $timesheet_week_id = 0;
	protected $employee_id = '';
	protected $week_number = '';
	protected $week_dates = '';
	protected $monday_total_time ='';
	protected $tuesday_total_time ='';
	protected $wednesday_total_time ='';
	protected $thursday_total_time ='';
	protected $friday_total_time ='';
	protected $saturday_total_time ='';
	protected $sunday_total_time ='';
	protected $employee_cost_centre ='';
	protected $employee_activity_type ='';
	protected $employee_timesheet_profile ='';
	protected $approver_id ='';
	protected $approver_status ='';
	protected $status ='';
	protected $changed_by ='';
	protected $created_by ='';
	public $timestamps = true; // for false updated_at and created_at
}
