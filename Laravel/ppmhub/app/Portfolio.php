<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Portfolio;
use App\Project;
use App\Buckets;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;

class Portfolio extends Model {

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $table = 'portfolio';
  protected $fillable = [
      'name',
      'port_id',
      'type',
      'currency',
      'planning_unit',
      'capacity_unit',
      'description',
      'created_by',
      'updated_by',
      'updated_at',
      'created_at',
      'company_id',
      'status',
      'deleted',
  ];

  public function currency() {
    return $this->hasOne('App\Currency', 'short_code', 'currency');
  }

  public function portfolio_type() {
    return $this->hasOne('App\Portfoliotype', 'id', 'type');
  }

  public function capacity_units() {
    return $this->hasOne('App\Capacityunits', 'id', 'capacity_unit');
  }

  public function planning_units() {
    return $this->hasOne('App\Planningunit', 'id', 'planning_unit');
  }

  public function portfolio_buckets() {
    return $this->hasMany('App\Buckets', 'portfolio_id', 'id');
  }

  public function creator() {
    return $this->hasOne('App\User', 'id', 'created_by');
  }

  public function updator() {
    return $this->hasOne('App\User', 'id', 'updated_by');
  }

  public static function portfolio_report_query($reportbucket_id, $reportportfolio_id, $reportProject_to, $reportProject_from) {
    //data table data
    $query = Project::query();
    $query->select('project.project_Id', 'project.project_name', 'project.project_type', 'project.project_desc', 'project.bucket_id', DB::raw('portfolio.port_id as portfolio_id'), 'project.location_id', 'project.cost_centre', 'project.start_date', 'project.end_date', 'project.a_start_date', 'project.a_end_date', 'project.f_start_date', 'project.f_end_date', 'project.sch_date', 'project.p_start_date', 'project.p_end_date', 'project.created_at', 'buckets.name as bucket_name', 'buckets.bucket_id as buckets_ID', 'department_type.name as department', 'cost_centres.cost_centre', 'portfolio_type.name as portfolio_type', 'portfolio.name as portfolio_name', DB::raw('concat(employee_records.employee_first_name," ",employee_middle_name," ",employee_last_name) as created_by'));

    $query->join('buckets', 'buckets.id', '=', 'project.bucket_id'); //imp should be inner join
    $query->join('portfolio', 'portfolio.id', '=', 'project.portfolio_id'); //imp ,used in condition , should be inner join
    $query->leftJoin('portfolio_type', 'portfolio_type.id', '=', 'portfolio.type'); //imp ,used in condition , should be inner join
    $query->leftJoin('employee_records', 'project.created_by', '=', 'employee_records.employee_id');
    $query->leftJoin('department_type', 'project.department', '=', 'department_type.id');
    $query->leftJoin('cost_centres', 'project.cost_centre', '=', 'cost_centres.cost_id');


    //graph data
    $query2 = Project::query();
    $query2->select(DB::raw('count(*) as prj_count '), 'project.portfolio_id', 'portfolio.name');
    $query2->join('buckets', 'buckets.id', '=', 'project.bucket_id');
    $query2->join('portfolio', 'portfolio.id', '=', 'project.portfolio_id');
    $query2->groupBy('portfolio.name', 'project.portfolio_id');


    if (isset($reportbucket_id)) {
      $query->where('project.bucket_id', '=', $reportbucket_id);
      $query2->where('project.bucket_id', '=', $reportbucket_id);
    }

    if (isset($reportportfolio_id)) {
      $query->where('project.portfolio_id', '=', $reportportfolio_id);
      $query2->where('project.portfolio_id', '=', $reportportfolio_id);
    }

    //2 is date
    //2>1
    if (isset($reportProject_to)) {
      $query->where('project.id', '<=', $reportProject_to);
      $query2->where('project.id', '<=', $reportProject_to);
    }

    //1<2    
    if (isset($reportProject_from)) {
      $query->where('project.id', '>=', $reportProject_from);
      $query2->where('project.id', '>=', $reportProject_from);
    }

    $query->where('project.company_id', '=', Auth::user()->company_id);
    $query2->where('project.company_id', '=', Auth::user()->company_id);




    $report = $query->get();
    $graph = $query2->pluck('portfolio.name', 'prj_count');


    return ['report' => $report, 'graph' => $graph];
  }

  public static function daysCount($startDate, $endDate) {
    $date1 = new Carbon($startDate);
    $date2 = new Carbon($endDate);
    $days = date_diff($date1, $date2->addDays(1)); //Add +1 day to count start date also
    return $days->format("%a");
  }

  public static function validatePortfolio($post) {
    $validationmessages = [
        'name.required' => 'Please enter name',
        'type.required' => 'Please select portfolio type',
    ];

    $validator = Validator::make($post, [
          'name' => 'required',
          'type' => 'required',
        ], $validationmessages);
    return $validator;
  }

}
