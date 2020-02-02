<?php

namespace App\Models\Projects;

use App\Project;
use Illuminate\Database\Eloquent\Model;

class ProjectMilestone extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'project_milestone';
    protected $primaryKey = 'project_milestone_id';
    protected $fillable = [
        'milestone_no',
        'milestone_name',
        'milestone_type',

        'company_id',
        'project_id',
        'phase_id',
        'task_id',

        'billing_plan',
        'progress',

        'start_date',
        'finish_date',
        'fixed_date',
        'actual_date',
        'schedule_date',
        'progress_date',
        'event_date',

        'status',
        'billing_status',
    ];



    function scopeByCompany($query, $company_id=null)
    {
        $company_id = ($company_id == null) ? Auth::user()->company_id : $company_id;
        return $query->where('company_id', $company_id);
    }

    public function getFullInfoAttribute()
    {
        return preg_replace('/\s+/', ' ',$this->milestone_no.' '.$this->milestone_name);
    }


    public function project()
    {
        return $this->belongsTO(Project::class, 'project_id', 'id');
    }


    function scopeIsActive($query)
    {
        return $query->where('status', 1);
    }

    function scopeIsBillable($query)
    {
        return $query->where('milestone_type', 'billing');
    }


}
