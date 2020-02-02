<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Projectchecklist extends Model {

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $table = 'project_checklist';
  protected $fillable = [
      'checklist_id',
      'checklist_name',
      'checklist_text',
      'checklist_type',
      'project_name',
      'project_id',
      'phase_id',
      'phase_name',
      'task_id',
      'task_name',
      'start_date',
      'a_start_date',
      'l_start_date',
      'l_end_date',
      'e_start_date',
      'e_end_date',
      'a_end_date',
      'end_date',
      'duration',
      'person_responsible',
      'created_by',
      'created_on',
      'changed_by',
      'changed_on',
      'status',
      'checklist_status',
      'company_id'
  ];
  public $timestamps = false;

  /*
   * public function customer()
   * {
   * return $this->hasOne('App\Customer', 'id', 'customer_id');
   * }
   *
   *
   * public function user()
   * {
   * return $this->hasOne('App\User', 'id', 'user_id');
   * }
   *
   *
   * public function status()
   * {
   * return $this->hasOne('App\Status', 'id', 'status_id');
   * }
   * public function plan()
   * {
   * return $this->hasOne('App\Plans', 'id', 'plan_id');
   * }
   */

  public static function checkListReport($reportProject_from = NULL, $reportProject_to = NULL, $reportName = NULL, $reportChecklist_id = NULL) {
    $query = self::query()
            ->select('project_checklist.checklist_id', 'project_checklist.checklist_name', 'project_checklist.checklist_text', DB::raw('DATE_FORMAT(project_checklist.created_on, "%d-%m-%Y") as created_on '), 'project_checklist.checklist_status', 'project_checklist.start_date', 'project.status', DB::raw('CONCAT_WS(" ",employee_records.employee_first_name, employee_records.employee_middle_name,employee_records.employee_last_name) AS responsible_person'), 'project.id as project_uid', 'project.project_Id', 'project.project_name', 'project.bucket_id', 'buckets.bucket_id as buck_id', 'project.cost_centre', 'project.project_desc', 'project.start_date as pr_start_date', 'project.end_date as pr_end_date', 'project.a_start_date', 'project.a_end_date', 'project.f_start_date', 'project.f_end_date', 'project.sch_date', 'project.p_end_date', 'project.created_by', 'project.p_start_date', 'buckets.name as bucket_name', 'createrole.role_name as createt_by_role_name', 'portfolio.name as portfolio_name', 'portfolio.port_id as portfolio_id', 'portfolio_type.name as portfolio_type', 'portfolio.port_id as portfolio_id', 'project_type.name as project_type_name', 'project_phase.phase_Id as project_phase_id', 'state_subrub.subrub as location', 'cost_centres.cost_centre as cost_centre_name', 'department_type.name as department_name')
            ->leftjoin('project', 'project.project_Id', '=', 'project_checklist.project_id')
            ->leftJoin('employee_records', 'employee_records.employee_id', '=', 'project_checklist.person_responsible')
            ->leftJoin('project_type', 'project_type.id', '=', 'project.project_type')
            ->leftJoin('portfolio', 'portfolio.id', '=', 'project.portfolio_id')
            ->leftJoin('portfolio_type', 'portfolio_type.id', '=', 'portfolio.type')
            ->leftJoin('department_type', 'department_type.id', '=', 'project.department')
            ->leftJoin('buckets', 'buckets.id', '=', 'project.bucket_id')
            ->leftJoin('project_phase', 'project_phase.project_id', '=', 'project.id')
            ->leftJoin('createrole', 'createrole.id', '=', 'project.created_by')
            ->leftJoin('state_subrub', 'state_subrub.id', '=', 'project.location_id')
            ->leftJoin('cost_centres', 'cost_centres.cost_id', '=', 'project.cost_centre')
            ->where('project.company_id', '=', Auth::user()->company_id)
            ->orderBy('project_checklist.id', 'desc');

    if (isset($reportProject_from) && isset($reportProject_to))
      $query->whereBetween('project.id', [$reportProject_from, $reportProject_to]);

    if (isset($reportChecklist_id) && $reportChecklist_id != "-")
      $query->where('project_checklist.checklist_id', '=', $reportChecklist_id);

    if (isset($reportName) && $reportName != "-")
      $query->where('project_checklist.created_by', 'like', '%' . $reportName . '%');

    return $query->get();
  }

  /**
   * Get Project dashbaord decisionActionPending Chart checklist data
   * @param type $projectId
   * @return type
   */
  public static function getDecisionActionPendingChartData($projectId) {
    $dapChartData = array();
    $decisionActionPendingGraphData = projectchecklist::select(DB::raw('checklist_type.name as checklist_type'), DB::raw("count(*) as count"))
            ->join('checklist_type', 'checklist_type.id', '=', 'project_checklist.checklist_type')
            ->Where('project_id', $projectId)
            ->where('checklist_type', '!=', null)
            ->orderBy("checklist_type", "desc")
            ->groupBy('checklist_type.name')
            ->get()
            ->toArray();


    foreach ($decisionActionPendingGraphData as $key => $checklist) {
      $dapChartData[$key]['y'] = intval($checklist['count']);
      $dapChartData[$key]['label'] = $checklist['checklist_type'];
    }
    return $dapChartData;
  }
  
  
   public static function checkListReportGraph($reportProject_from = NULL, $reportProject_to = NULL) {
    $query = self::query()
            ->select('project_checklist.project_id',DB::raw("count(*) as total_checklist"))
            ->leftjoin('project', 'project.project_Id', '=', 'project_checklist.project_id')
            ->where('project.company_id', '=', Auth::user()->company_id)
            ->groupBy('project_checklist.project_id');

    if (isset($reportProject_from) && isset($reportProject_to))
      $query->whereBetween('project.id', [$reportProject_from, $reportProject_to]);
    return $query->get();
  }

}
