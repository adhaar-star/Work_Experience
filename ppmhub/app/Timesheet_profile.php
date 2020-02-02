<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Timesheet_profile extends Model
{
    protected $table = 'time_sheet_profiles';
    protected $primaryKey = 'time_sheet_profile_id';
    protected $fillable   = [
		'time_sheet_profile_id',
		'time_sheet_profile_number',
		'time_sheet_entry_period',
		'time_sheet_number_days',
		'time_sheet_description',
		'status',
		'created_by',
		'updated_by',
		'company_id'
	];
	
    public function creator() {
        return $this->hasOne('App\User', 'id', 'created_by');
    }
    public function updator() {
        return $this->hasOne('App\User', 'id', 'updated_by');
    }
}
