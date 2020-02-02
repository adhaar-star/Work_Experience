<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Helpers\ProjectHelpers;
use App\OriginalBudget;
use Carbon\Carbon;

class Project extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'project';
    protected $fillable = [
        'project_Id',
        'project_name',
        'project_type',
        'project_desc',
        'portfolio_name',
        'portfolio_id',
        'portfolio_type',
        'bucket_name',
        'bucket_id',
        'location_id',
        'cost_centre',
        'department',
        'start_date',
        'end_date',
        'a_start_date',
        'a_end_date',
        'f_start_date',
        'f_end_date',
        'sch_date',
        'p_start_date',
        'p_end_date',
        'person_responsible',
        'factory_calendar',
        'currency',
        'estimated_cost',
        'physical_progress',
        'cost_progress',
        'created_date',
        'created_by',
        'modified_date',
        'modified_by',
        'company_id',
        'status',
        'deleted',
        'project_commentary',
        'category',
        'scope',
        'quality'
    ];
    protected $editable = [
        'project_Id',
        'project_name',
        'project_type',
        'project_desc',
        'portfolio_name',
        'portfolio_id',
        'portfolio_type',
        'bucket_name',
        'bucket_id',
        'location_id',
        'cost_centre',
        'department',
        'start_date',
        'end_date',
        'a_start_date',
        'a_end_date',
        'f_start_date',
        'f_end_date',
        'sch_date',
        'p_start_date',
        'p_end_date',
        'person_responsible',
        'factory_calendar',
        'currency',
        'modified_date',
        'modified_by',
        'status',
        'estimated_cost',
        'physical_progress',
        'cost_progress',
        'project_commentary',
        'category',
        'scope',
        'quality'
    ];

    public function getEditable()
    {
        return $this->editable;
    }

    public function projectType()
    {
        return $this->belongsTo('App\Portfoliotype', 'project_type');
    }

    public function portfolioId()
    {
        return $this->belongsTo('App\Portfolio', 'portfolio_id');
    }

    public function portfolioType()
    {
        return $this->belongsTo('App\Portfoliotype', 'portfolio_type');
    }

    public function bucketId()
    {
        return $this->belongsTo('App\Buckets', 'bucket_id');
    }

    public function locationId()
    {
        return $this->belongsTo('App\location', 'location_id');
    }

    public function costCentre()
    {
        return $this->belongsTo('App\Costcentretype', 'cost_centre');
    }

    public function departmentType()
    {
        return $this->belongsTo('App\Departmenttype', 'department');
    }

    public function user()
    {
        return $this->hasOne('App\User', 'id', 'created_by');
    }

     public function userchange()
    {
        return $this->hasOne('App\User', 'id', 'modified_by');
    } 

    function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    /**
     * Get projects list with it's id with id and name concatenation
     * @return type
     */
    public static function projectsWithId()
    {
        //Get all projects
        $projects = Project::select(DB::raw("CONCAT(project_Id,' (',project_name, ')') AS project_name"), 'project_Id')
                ->where('project.company_id', '=', Auth::user()->company_id)
                ->pluck('project_name', 'project_Id');

        return $projects;
    }

    public static function totalDemandByProject($id, $company)
    {
        $totalDemand = DB::table('tasks_subtask')
                ->select(DB::raw('sum(total_demand) as totalDemand'))
                ->where('project_id', $id)
                ->where('company_id', $company)
                ->first();
        return $totalDemand;
    }

    public static function personAssignmentByProject($id)
    {
        $personAssign = DB::table('personassignment')
                        ->select('personassignment.*')
                        ->where('project_id', $id)
                        ->where('company_id', Auth::user()->company_id)
                        ->get()->toArray();
        return $personAssign;
    }

    public static function projectByBucket($bucketId)
    {
        $projects = DB::table('project')
                ->select('project.project_Id', 'project.id', 'project.bucket_id', 'project.project_name')
                ->where('bucket_id', $bucketId)
                ->where('company_id', Auth::user()->company_id)
                ->get();
        return $projects;
    }

    public static function projectReport($reportProject_from, $reportProject_to, $reportStart_date, $reportEnd_date)
    {
        $report = array();
        $query = Project::query();
        $query->select('project.*', 'portfolio_type.name as portfoliotype_name', 'portfolio.port_id as portfolio_id', 'users.name as created_name', 'state_subrub.subrub as location_name', 'portfolio.name as portfolio_name', 'buckets.bucket_id as bucket_id', 'buckets.name as bucket_name', 'department_type.name as department_name', 'employee_records.employee_first_name as name', 'cost_centres.cost_centre',DB::raw('DATE_FORMAT(project.created_at, "%d-%m-%Y") as created_date'),DB::raw('DATE_FORMAT(project.start_date, "%d-%m-%Y") as start_date'),DB::raw('DATE_FORMAT(project.end_date, "%d-%m-%Y") as end_date'));
        $query->leftJoin('portfolio', 'portfolio.id', '=', 'project.portfolio_id');
        $query->leftJoin('portfolio_type', 'portfolio_type.id', '=', 'project.portfolio_type');
        $query->leftJoin('state_subrub', 'state_subrub.id', '=', 'project.location_id');
        $query->leftJoin('department_type', 'department_type.id', '=', 'project.department');
        $query->leftJoin('buckets', 'buckets.id', '=', 'project.bucket_id');
        $query->leftJoin('employee_records', 'employee_records.employee_id', '=', 'project.person_responsible');
        $query->leftJoin('cost_centres', 'cost_centres.cost_id', '=', 'project.cost_centre');
        $query->leftJoin('users', 'users.id', '=', 'project.created_by');
        $query->orderBy('project.id', 'desc');

        if (isset($reportProject_from)) {
            $query->where('project.id', '>=', $reportProject_from);
        }

        if (isset($reportProject_to)) {
            $query->where('project.id', '<=', $reportProject_to);
        }

        if (isset($reportStart_date)) {
            $query->where(DB::raw('DATE_FORMAT(project.start_date,"%Y-%m-%d")'), '>=', $reportStart_date);
        }
        if (isset($reportEnd_date)) {
            $query->where(DB::raw('DATE_FORMAT(project.end_date,"%Y-%m-%d")'), '<=', $reportEnd_date);
        }

        $query->where('project.company_id', '=', Auth::user()->company_id);

        if (isset($reportProject_from) || isset($reportProject_to) || isset($reportStart_date) || isset($reportEnd_date)) {
            $report = $query->get();
        }
        return $report;
    }
    
    public static function projectsStatusChart($portfolioId){
        $projectStatus = self::select('status', DB::raw("count(*) as count"))->Where('portfolio_id', $portfolioId)->groupBy('status')->get()->toArray();
        $statusArr = array();
        foreach($projectStatus as $key => $val){
            $color = $val['status'] == 'active'? '#006700' : '#ff0000';
            $statusArr[$key]['y'] = $val['count'];
            $statusArr[$key]['name'] = strtoupper($val['status']);
            $statusArr[$key]['color'] = $color;
        }
        return $statusArr;
    }
    
    public static function projectsPercentCompleteChart($portfolioId){
        
        $projects = self::select('cost_progress')
                        ->Where('portfolio_id', $portfolioId)
                        ->Where('project.company_id', '=', Auth::user()->company_id)
                        ->Where('cost_progress', '!=', null)
                        ->get();
        $projectRange['range0To25'] = $projectRange['range25To50'] = $projectRange['range50To75'] = $projectRange['range75To100'] = 0;
        if(isset($projects)){
            foreach ($projects as $key => $val) {
                if ($val->cost_progress > 0 && $val->cost_progress <= 25){
                    $projectRange['range0To25']++;
                }else if($val->cost_progress > 25 && $val->cost_progress <= 50){
                    $projectRange['range25To50']++;
                }else if($val->cost_progress > 50 && $val->cost_progress <= 75){
                    $projectRange['range50To75']++;
                }else if($val->cost_progress > 75 && $val->cost_progress <= 100){
                    $projectRange['range75To100']++;
                }
            }
        }
        
        return $projectRange;
    }
    
    /**
     * Find no.of projects which actual cost is greater than planned cost
     * @param type $portfolioId
     */
    public static function projectsPlannedCostChart($portfolioId){
        $projects = self::select('id','project_Id')
                        ->Where('portfolio_id', $portfolioId)
                        ->Where('company_id', '=', Auth::user()->company_id)
                        ->get();
        
        $projectCount = 0;
        foreach($projects as $key => $val){
            $actualPlannedCost = DB::table('tasks_subtask')
                    ->select(DB::raw('sum(actual_cost) as actualCost'), DB::raw('sum(planned_cost) as plannedCost'))
                    ->leftjoin('project', 'project.project_Id', '=', 'tasks_subtask.project_id')
                    ->where('tasks_subtask.project_id', '=', $val->project_Id)
                    ->first();
            
            if($actualPlannedCost->actualCost > $actualPlannedCost->plannedCost){
                $projectCount++;
            }
        }
        
        return $projectCount;
    }


    function scopeByCompany($query, $company_id=false)
    {
        return $query->where('company_id', ($company_id) ? $company_id : Auth::user()->company_id );
    }
    public function getFullInfoAttribute()
    {
        return preg_replace('/\s+/', ' ',$this->project_Id.' '.$this->project_name.'');
    }
        
    /**
     * Get Proejct cost and budget
     */
    public static function ProjectCostBudget($pId, $projectId){
        $projectCost = ProjectHelpers::get_actual_cost_project($projectId);
        $budget = OriginalBudget::Where('project_id', $pId)->first();
        
        return ['projectCost' => $projectCost, 'budget' => isset($budget->overall) ? $budget->overall : 0];
    }
    
    /**
     * RAG Scope and Quality
     */
    public static function RAGScopeQuality($array, $value){
        if($value === 0)
            $array['red']++;
        else if($value == 1)
            $array['green']++;
        else if($value == 2)
            $array['yellow']++;
        
        return $array;
    }
    /**
     * Return the traffic light value
     * @param type $array
     * @param type $value
     * @return type
     */
    public static function scopeQualityLight($value){
        $light = 'white';
        if($value === 0)
            $light = 'red';
        else if($value == 1)
            $light = 'green';
        else if($value == 2)
            $light = 'yellow';
        
        return $light;
    }
    
    /**
     * Get project overall status for project dashboard
     * @param type $projectId
     */
    public static function projectOverallStatus($project){
        // find not completed task on time
        $notCompletedTaskOnTime = DB::table('tasks_subtask')
                                    ->where('completion', '!=', 100)
                                    ->whereDate('end_date', '<=', date('Y-m-d'))
                                    ->Where('is_deleted', 'N')
                                    ->where('project_id', $project->project_Id)
                                    ->where('company_id', Auth::user()->company_id)
                                    ->count();
        $issueCritical = ProjectIssue::Where('projectId', $project->id)->Where('priority', 'Critical')->count();
        $costNBudget = self::ProjectCostBudget($project->id, $project->project_Id);
        
        $status = true;
        $projectEndDate = new Carbon($project->end_date);
        $projectActualEndDate = new Carbon($project->a_end_date);
        if($notCompletedTaskOnTime > 0 || $issueCritical > 0 || $costNBudget['projectCost'] > $costNBudget['budget'] || $projectActualEndDate > $projectEndDate)
            $status = false;
        
        return $status;
    }
    
    public static function projectsByCategory($category, $id){
        $projects = self::where('company_id', Auth::user()->company_id)
                        ->Where('bucket_id', $id);
        if($category != 0 && $category != null){
            $projects->Where('category', $category);
        }
        $projects = $projects->get()->toArray();
        
        return $projects;
    }
    
    /**
     * Get All active projects by portfolio id using bucket join
     * @param type $portfolioId
     */
    public static function projectsByPortfolio($portfolioId){
        $projects = Project::select('project.id', 'project.project_name')
                    ->join('buckets', 'project.bucket_id', '=', 'buckets.id')
                    ->join('portfolio', 'portfolio.id', '=', 'buckets.portfolio_id')
                    ->where('project.status', 'active')
                    ->where('portfolio.id', $portfolioId)
                    ->get()
                    ->toArray();
        return $projects;
    }
}
