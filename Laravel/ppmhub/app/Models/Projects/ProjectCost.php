<?php

namespace App\Models\Projects;

use App\Activity_rates;
use App\Activity_types;
use App\Employee_records;
use App\Models\timeSheetWorks\StWork;
use App\Project;
use App\TasksSubtask;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class ProjectCost extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'project_costs';
    protected $primaryKey = 'project_cost_id';
    protected $fillable = [
        'employee_id',
        'project_id',
        'task_id',
        'st_work_id',
        'activity_type_id',
        'activity_rate_id',
        'activity_rate',
        'total_time',
        'total_minutes',
        'total_cost',
        'billing_status',
    ];

    public function employee()
    {
        return $this->belongsTO(Employee_records::class, 'employee_id');
    }

    public function project()
    {
        return $this->belongsTO(Project::class, 'project_id');
    }

    public function task()
    {
        return $this->belongsTO(TasksSubtask::class, 'task_id');
    }

    public function activityType()
    {
        return $this->belongsTO(Activity_types::class, 'activity_type_id');
    }

    public function activityRate()
    {
        return $this->belongsTO(Activity_rates::class, 'activity_rate_id');
    }

    public function StWork()
    {
        return $this->belongsTO(StWork::class, 'st_work_id');
    }

    public static function timesheet_cost()
    {
        $timesheet_cost = self::query()
                ->selectRaw('sum(total_cost)')
                ->get();
        return $timesheet_cost;
    }

    public static function timesheet_cost_project_list()
    {
        $timesheet_cost = ProjectCost::query()
                ->select(DB::raw('sum(total_cost) as timesheet_cost '), 'project_id')
                ->groupBy('project_id')
                ->get();

        return $timesheet_cost;
    }

    public static function timesheet_cost_project($pid)
    {
        $timesheet_cost = ProjectCost::query()
                ->select(DB::raw('sum(total_cost) as timesheet_cost '))
                ->groupBy('project_id')
                ->where('project_id', $pid)
                ->first();

        return isset($timesheet_cost->timesheet_cost) ? $timesheet_cost->timesheet_cost : 0;
    }
    
    public static function timesheet_cost_task($tid)
    {
        $timesheet_cost = ProjectCost::query()
                ->select(DB::raw('sum(total_cost) as timesheet_cost'))
                ->groupBy('task_id')
                ->where('task_id', $tid)
                ->first();

        return isset($timesheet_cost->timesheet_cost) ? $timesheet_cost->timesheet_cost : 0;
    }
    
    public static function timeSheetReportData($reportProject_from = NULL,$reportProject_to = NULL){
        $query = self::query()
            ->select('project_costs.project_id',DB::raw('sum(IFNULL(project_costs.total_cost,0)) as resource_cost'),
                     DB::raw('sum(TIME_TO_SEC(project_costs.total_time)) as total_time'),'project.project_Id as PID','project.project_desc')
            ->groupBy('project_costs.project_id') 
            ->join('project','project.id','=','project_costs.project_id')
            ->groupBy('project.project_desc','project.project_Id') ;
        
        if(isset($reportProject_from) && isset($reportProject_to))
            $query->whereBetween('project.id', [$reportProject_from, $reportProject_to]);
        
            $report = $query->get();
        return $report;
    }


    public function scopeSearchBy($query, $request)
    {

        if ($request->get('end_date')) {
            $query->whereDate('created_at', '<=', $request->get('end_date'));
        }
        if ($request->get('start_date')) {
            $query->whereDate('created_at', '>=', $request->get('start_date'));
        }
        return $query;
    }



}
