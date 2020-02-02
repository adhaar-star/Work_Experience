<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
use Auth;


class Projectphase extends Model {

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $table = 'project_phase';
  public $timestamps = false;
  protected $fillable = [
      'phase_Id',
      'company_id',
      'phase_name',
      'phase_type',
      'project_id',
      'prephase_id',
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
      'phase_approval',
      'reference_phase',
      'quality_approval',
      'created_by',
      'modified_by',
      'created_date',
      'updated_at',
      'status',
      'is_deleted',
      'company_id'
  ];

  public function phaseType() {
    return $this->belongsTo('App\phasetype', 'phase_type');
  }

  public function projectId() {
    return $this->belongsTo('App\Project', 'project_id');
  }

  public function personResponsible() {
    return $this->belongsTo('App\Personresponsible', 'person_responsible');
  }

  public static function getPhaseDetails($reportProject_from, $reportProject_to, $phase_id) {
    $report = array();
    $query = Projectphase::query();
    $query->select('project_phase.*',DB::raw('DATE_FORMAT(project_phase.created_date, "%d-%m-%Y") as created_date '),'users.name as created_name', 'state_subrub.subrub as location_name', 'cost_centres.cost_centre as costcentre_name', 'project.created_at', DB::raw('CONCAT_WS(" ",er.employee_first_name, er.employee_middle_name,er.employee_last_name) AS responsible_person'), 'project.id as project_uid', 'project.project_Id', 'project.project_name', DB::raw('DATE_FORMAT(project_phase.start_date, "%d-%m-%Y") as start_date '), DB::raw('DATE_FORMAT(project_phase.end_date, "%d-%m-%Y") as end_date'), 'project.project_desc', 'project.bucket_id', 'project.cost_centre', 'project.project_desc', 'project.a_start_date', 'project.a_end_date', 'project.f_start_date', 'project.f_end_date', 'project.sch_date', 'project.p_end_date', 'project.created_by', 'project.p_start_date', 'buckets.bucket_id as bucket_ID', 'buckets.name as bucket_name', 'department_type.name as department_name', 'users.name as name', 'portfolio.name as portfolio_name', 'portfolio.port_id as portfolio_id', 'portfolio_type.name as portfolio_type', 'portfolio.port_id as portfolio_id', 'project.bucket_id', 'project_type.name as project_type_name');
    $query->leftJoin('project', 'project.id', '=', 'project_phase.project_id');
    $query->leftJoin('state_subrub', 'state_subrub.id', '=', 'project.location_id');
    $query->leftJoin('project_type', 'project_type.id', '=', 'project.project_type');
    $query->leftJoin('portfolio', 'portfolio.id', '=', 'project.portfolio_id');
    $query->leftJoin('portfolio_type', 'portfolio_type.id', '=', 'portfolio.type');
    $query->leftJoin('department_type', 'department_type.id', '=', 'project.department');
    $query->leftJoin('buckets', 'buckets.id', '=', 'project.bucket_id');
    $query->leftJoin('cost_centres', 'cost_centres.cost_id', '=', 'project.cost_centre');
    $query->leftJoin('employee_records as er', 'er.employee_id', '=', 'project.person_responsible');
    $query->leftJoin('users', 'users.id', '=', 'project.created_by');
    $query->orderBy('project_phase.id', 'desc');

    if (isset($reportProject_from)) {
      $query->where('project.id', '>=', $reportProject_from);
    }

    if (isset($reportProject_to)) {
      $query->where('project.id', '<=', $reportProject_to);
    }
    if (isset($phase_id)) {
      $query->where('project_phase.phase_id', '=', $phase_id);
    }

    $query->where('project.company_id', '=', Auth::user()->company_id);

    if (isset($reportProject_from) && isset($reportProject_to) || isset($phase_id)) {
      $report = $query->get();
    }
    return $report;
  }

  function scopeByCompany($query, $company_id=false)
  {
    return $query->where('company_id', ($company_id) ? $company_id : Auth::user()->company_id );
  }

}
