<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TasksSubtask extends Model {

  protected $table = 'tasks_subtask';
  protected $primaryKey = 'id';
  protected $fillable = [
      'task_Id',
      'task_name',
      'task_type',
      'project_id',
      'phase_id',
      'parent_id',
      'sub_task_id',
      'start_date',
      'end_date',
      'duration',
      'completion',
      'status',
      'time_sheet_user_id',
      'time_sheet_approver_id',
      'status',
      'created_by',
      'total_demand',
      'updated_by',
      'company_id',
      'successor_task_id',
      'pre_task_id'];

  public static function taskDetailReport($reportProject_from, $reportProject_to) {
    $query = TasksSubtask::query();
    $query->select('project.project_Id', 'project.project_desc', 'project_phase.phase_Id as project_phase_id', 'project_phase.phase_name', 'tasks_subtask.task_Id', 'tasks_subtask.task_name', DB::raw('DATE_FORMAT(tasks_subtask.start_date , "%d-%m-%Y") as start_date '), DB::raw('DATE_FORMAT(tasks_subtask.end_date , "%d-%m-%Y") as end_date '), 'tasks_subtask.completion', 'tasks_subtask.duration', DB::raw('CONCAT_WS(" ",employee_records.employee_first_name, employee_records.employee_middle_name,employee_records.employee_last_name) AS firstName'), 'tasks_subtask.status as task_sub_status');
    $query->leftJoin('project', 'project.project_Id', '=', 'tasks_subtask.project_id');
    $query->leftJoin('project_type', 'project_type.id', '=', 'project.project_type');
    $query->leftJoin('portfolio', 'portfolio.id', '=', 'project.portfolio_id');
    $query->leftJoin('portfolio_type', 'portfolio_type.id', '=', 'portfolio.type');
    $query->leftJoin('department_type', 'department_type.id', '=', 'project.department');
    $query->leftJoin('buckets', 'buckets.id', '=', 'project.bucket_id');
    $query->leftJoin('users', 'users.id', '=', 'project.person_responsible');
    $query->leftJoin('createrole', 'createrole.id', '=', 'project.created_by');
    $query->leftJoin('project_phase', 'project_phase.phase_Id', '=', 'tasks_subtask.phase_id');
    $query->leftJoin('personassignment', 'personassignment.task', '=', 'tasks_subtask.id');
    $query->leftJoin('employee_records', 'personassignment.resource_name', '=', 'employee_records.employee_id');
    $query->leftJoin('users as usr', 'usr.id', '=', 'tasks_subtask.created_by');
    $query->leftJoin('state_subrub as location', 'location.id', '=', 'project.location_id');
    $query->leftJoin('cost_centres', 'cost_centres.cost_id', '=', 'project.cost_centre');

    if (isset($reportProject_from)) {
      $query->where('project.id', '>=', $reportProject_from);
    }

    if (isset($reportProject_to)) {
      $query->where('project.id', '<=', $reportProject_to);
    }

    $query->where('project.company_id', '=', Auth::user()->company_id);

    $report = $query->get();
    return $report;
  }

  public static function actualCost($portfolioId) {
    $actualCost = DB::table('tasks_subtask')
      ->select(DB::raw('sum(actual_cost) as actualCost'))
      ->leftjoin('project', 'project.project_Id', '=', 'tasks_subtask.project_id')
      ->where('project.portfolio_id', '=', $portfolioId)
      ->first();
    return $actualCost;
  }

  public static function getTaskData($projectId, $endConst, $compConst) {
    $query = TasksSubtask::query();
    $taskStatus = $query->select(DB::raw('count(*) as taskCount'))
      ->whereDate('end_date', $endConst, date('Y-m-d'))
      ->where('completion', $compConst, 100)
      ->where('project_id', $projectId)
      ->first();
    return $taskStatus;
  }

  /**
   * Get Task/Subtask chart data based on project 
   * @param type $projectId
   * @return type
   */
  public static function getTaskChartData($projectId) {
    $taskDelayed = self::getTaskData($projectId, '<', '<');
    $taskOnTrack = self::getTaskData($projectId, '<', '=');
    $taskNotStarted = self::getTaskData($projectId, '>', '<=');
    return ['taskDelayed' => intval($taskDelayed->taskCount), 'taskOnTrack' => intval($taskOnTrack->taskCount), 'taskNotStarted' => intval($taskNotStarted->taskCount)];
  }

  /**
   * Get Task/Subtask Schedule Data 
   * @param type $projectId
   * @return type
   */
  public static function getTaskSchedule($projectId) {
    $query = TasksSubtask::query();
    $taskData = $query->select('id', 'task_name', DB::raw("DATE_FORMAT(start_date, '%Y,%m,%d') as start_date"), DB::raw("DATE_FORMAT(end_date, '%Y,%m,%d') as end_date"), 'completion')
        ->where('project_id', $projectId)
        ->get()->toArray();
    return $taskData;
  }

}
