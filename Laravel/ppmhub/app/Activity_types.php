<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class Activity_types extends Model
{
    /**
     * Added just to demonstrate that models work
     * @return String
     */
    protected $table = 'activity_types';
	protected $primaryKey = 'activity_id';
	protected $fillable   = ['activity_id','activity_type', 'activity_description','cost_element','cost_element_description','validity_start','validity_end','status','created_by','changed_by'];
	protected $activity_id = 0;
	protected $activity_type = '';
	protected $activity_description = '';
	protected $cost_element = '';
	protected $cost_element_description ='';
	protected $validity_start ='';
	protected $validity_end ='';
	protected $status ='';
	protected $changed_by ='';
	protected $created_by ='';
	public $timestamps = true; // for false updated_at and created_at


	function scopeByCompany($query, $company_id=false)
	{
		return $query->where('company_id', ($company_id) ? $company_id : Auth::user()->company_id );
	}


}
