<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Projectmilestone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Projectmilestone extends Model {

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $table = 'project_milestone';
  public $timestamps = false;
  protected $fillable = [
      'milestone_Id',
      'milestone_name',
      'milestone_type',
      'project_id',
      'phase_id',
      'task_id',
      'start_date',
      'finish_date',
      'fixed_date',
      'actual_date',
      'schedule_date',
      'billingplan_date',
      'event_date',
      'progress_date',
      'duration',
      'persion_responsible',
      'phase_approval',
      'template',
      'reference_phase',
      'quality_approval',
      'created_by',
      'modified_by',
      'created_date',
      'modified_date',
      'status',
      'is_deleted'
  ];

  public static function mileStoneReport($reportProject_from, $reportProject_to, $project_phase_id, $project_task_id, $project_milestone_Id) {
    $report = array();
    $query = Projectmilestone::query();
    $query->select('project.project_Id', 'project.project_desc', 'project_phase.phase_Id', 'tasks_subtask.task_Id', 'project_milestone.milestone_Id', 'project_milestone.milestone_name', DB::raw('DATE_FORMAT(project_milestone.schedule_date, "%d-%m-%Y") as schedule_date'), DB::raw('DATE_FORMAT(project_milestone.actual_date, "%d-%m-%Y") as actual_date'));
    $query->join('project', 'project.id', '=', 'project_milestone.project_id');
    $query->leftJoin('tasks_subtask', 'tasks_subtask.id', '=', 'project_milestone.task_id');
    $query->leftJoin('project_phase', 'project_phase.id', '=', 'project_milestone.phase_id');
    $query->leftJoin('portfolio', 'portfolio.id', '=', 'project.portfolio_id');
    $query->leftJoin('portfolio_type', 'portfolio_type.id', '=', 'project.portfolio_type');
    $query->leftJoin('project_type', 'project_type.id', '=', 'project.project_type');
    $query->leftJoin('state_subrub', 'state_subrub.id', '=', 'project.location_id');
    $query->leftJoin('department_type', 'department_type.id', '=', 'project.department');
    $query->leftJoin('buckets', 'buckets.id', '=', 'project.bucket_id');
    $query->leftJoin('employee_records', 'employee_records.employee_id', '=', 'project.person_responsible');
    $query->leftJoin('cost_centres', 'cost_centres.cost_id', '=', 'project.cost_centre');
    $query->leftJoin('users', 'users.id', '=', 'project.created_by');
    $query->orderBy('project_milestone.id', 'desc');

    if (isset($reportProject_from)) {
      $query->where('project.id', '>=', $reportProject_from);
    }

    if (isset($reportProject_to)) {
      $query->where('project.id', '<=', $reportProject_to);
    }

    if (isset($project_phase_id) && $project_phase_id != "-") {
      $query->where('project_milestone.phase_id', '=', $project_phase_id);
    }

    if (isset($project_task_id) && $project_task_id != "-") {
      $query->where('project_milestone.task_id', '=', $project_task_id);
    }

    if (isset($project_milestone_Id) && $project_milestone_Id != "-") {
      $query->where('project_milestone.milestone_Id', '=', $project_milestone_Id);
    }

    $query->where('project.company_id', '=', Auth::user()->company_id);

    if (isset($reportProject_from) || isset($reportProject_to) || isset($project_phase_id) || isset($project_task_id) || isset($project_milestone_Id)) {
      $report = $query->get();
    }

    return $report;
  }
}
