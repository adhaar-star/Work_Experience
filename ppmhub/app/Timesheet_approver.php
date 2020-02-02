<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet_approver extends Model
{
    protected $table = 'time_sheet_approvers';
	protected $primaryKey = 'id';
	protected $fillable   = ['time_sheet_user_id', 'time_sheet_approver_id','status','created_by','updated_by','company_id'];
	
	public function users_name()
    {
        return $this->belongsTo('App\Employee_records', 'time_sheet_user_id');
    }
	
	public function approvers()
    {
        return $this->belongsTo('App\Employee_records', 'time_sheet_approver_id');
    }
	
}
