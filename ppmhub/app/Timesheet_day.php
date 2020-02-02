<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet_day extends Model
{
    protected $table = 'timesheet_day_entries';
	protected $primaryKey = 'timesheet_day_id';
	protected $fillable   = ['timesheet_day_id','week_id','employee_id', 'week_number','project_id','project_description','task_id','task_description','day_date','billable','monday_start_time','tuesday_start_time','wednesday_start_time','thursday_start_time','friday_start_time','saturday_start_time','sunday_start_time','monday_end_time','tuesday_end_time','wednesday_end_time','thursday_end_time','friday_end_time','saturday_end_time','sunday_end_time','monday_lunch_time','tuesday_lunch_time','wednesday_lunch_time','thursday_lunch_time','friday_lunch_time','saturday_lunch_time','sunday_lunch_time','monday_worked_time','tuesday_worked_time','wednesday_worked_time','thursday_worked_time','friday_worked_time','saturday_worked_time','sunday_worked_time','monday_time','tuesday_time','wednesday_time','thursday_time','friday_time','saturday_time','sunday_time','employee_cost_centre','employee_activity_type','employee_timesheet_profile','approver_id','approver_status','status','created_by','changed_by'];
	protected $timesheet_day_id = 0;
	protected $week_id = '';
	protected $employee_id = '';
	protected $week_number = '';
	protected $project_id = '';
	protected $project_description = '';
	protected $task_id = '';
	protected $task_description = '';
	protected $day_date = '';
	protected $billable = '';
	protected $monday_start_time ='';
	protected $tuesday_start_time ='';
	protected $wednesday_start_time ='';
	protected $thursday_start_time ='';
	protected $friday_start_time ='';
	protected $saturday_start_time ='';
	protected $sunday_start_time ='';
	protected $monday_end_time ='';
	protected $tuesday_end_time ='';
	protected $wednesday_end_time ='';
	protected $thursday_end_time ='';
	protected $friday_end_time ='';
	protected $saturday_end_time ='';
	protected $sunday_end_time ='';
	protected $monday_lunch_time ='';
	protected $tuesday_lunch_time ='';
	protected $wednesday_lunch_time ='';
	protected $thursday_lunch_time ='';
	protected $friday_lunch_time ='';
	protected $saturday_lunch_time ='';
	protected $sunday_lunch_time ='';
	protected $monday_worked_time ='';
	protected $tuesday_worked_time ='';
	protected $wednesday_worked_time ='';
	protected $thursday_worked_time ='';
	protected $friday_worked_time ='';
	protected $saturday_worked_time ='';
	protected $sunday_worked_time ='';
	protected $employee_cost_centre ='';
	protected $employee_activity_type ='';
	protected $employee_timesheet_profile ='';
	protected $approver_id ='';
	protected $approver_status ='';
	protected $status ='';
	protected $changed_by ='';
	protected $created_by ='';
	public $timestamps = true; // for false updated_at and created_at
	
	public function project_name()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }
	
	public function task_name()
    {
        return $this->belongsTo('App\Projecttask', 'task_id');
    }
}
