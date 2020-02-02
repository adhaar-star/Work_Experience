<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class qualitative_risk_analysis extends Model {

  protected $table = 'qualitative_risk_analysis';
  protected $fillable = [
      'id',
      'qual_risk_id', 'project_id', 'risk_type', 'qual_category', 'risk_score', 'qual_risk_desc', 'qual_likelihood', 'qual_consequence', 'qual_created_by', 'qual_changed_by', 'qual_status', 'company_id', 'created_at', 'updated_at', 'risk_mitigation_action',
      'strategic_context', 'organisational_context', 'riskmanagement_context'
  ];
  public $timestamps = false;

  public static function validateQualitative($post) {
    $validationmessages = [
        'project_id.required' => 'Please select project id',
        'qual_category.required' => 'Please select risk category',
        'qual_risk_desc.required' => 'Please enter risk description',
        'qual_risk_desc.min' => 'Please enter at least 3 characters.',
        'qual_risk_desc.max' => 'Please enter no more than 100 characters.',
        'qual_likelihood.required' => 'Please select qualitative likelihood',
        'qual_consequence.required' => 'Please select qualitative consequence ',
        'qual_status.required' => 'Please select status',
        'risk_mitigation_action.required' => 'Please enter risk mitigation action',
        'risk_mitigation_action.max' => 'Allow only 250 characters',
    ];

    $validator = Validator::make($post, [
          'project_id' => 'required',
          'qual_category' => 'required',
          'qual_risk_desc' => 'required|min:3|max:100',
          'qual_likelihood' => 'required',
          'qual_consequence' => 'required',
          'qual_status' => 'required',
          'risk_mitigation_action' => 'required|max:250',
        ], $validationmessages);
    return $validator;
  }

  public static function validateQualitativeContext($post) {
    $validationmessages = [
        'qual_risk_desc.min' => 'Please enter at least 3 characters.',
        'qual_risk_desc.max' => 'Please enter no more than 100 characters.',
        'strategic_context.max' => 'Allow only 300 characters for strategic context',
        'organisational_context.max' => 'Allow only 300 characters for organisational context',
        'riskmanagement_context.max' => 'Allow only 300 characters for riskmanagement context'
    ];

    $validator = Validator::make($post, [
          'qual_risk_desc' => 'min:3|max:100',
          'strategic_context' => 'max:300',
          'organisational_context' => 'max:300',
          'riskmanagement_context' => 'max:300'
        ], $validationmessages);
    return $validator;
  }

  public static function qualitativeReport($risktype, $projectsFrom, $projectsTo, $status) {
    $qualitative_data = array();

    //get qualitative data
    $qualitative_risk_data = qualitative_risk_analysis::query();
    $qualitative_risk_data->select('qualitative_risk_analysis.*', 'portfolio_type.name as portfoliotype_name', 'project_type.name as projecttype_name', 'project.project_Id', 'project.project_name', 'project.*', 'portfolio.port_id as portfolio_id', 'users.name as created_name', 'state_subrub.subrub as location_name', 'portfolio.name as portfolio_name', 'buckets.bucket_id as bucket_id', 'buckets.name as bucket_name', 'department_type.name as department_name', 'employee_records.employee_first_name as name', 'cost_centres.cost_centre', 'qualitative_risk_analysis.qual_status as risk_status');
    $qualitative_risk_data->leftJoin('project', 'project.project_Id', '=', 'qualitative_risk_analysis.project_id');
    $qualitative_risk_data->leftJoin('portfolio', 'portfolio.id', '=', 'project.portfolio_id');
    $qualitative_risk_data->leftJoin('portfolio_type', 'portfolio_type.id', '=', 'project.portfolio_type');
    $qualitative_risk_data->leftJoin('state_subrub', 'state_subrub.id', '=', 'project.location_id');
    $qualitative_risk_data->leftJoin('department_type', 'department_type.id', '=', 'project.department');
    $qualitative_risk_data->leftJoin('buckets', 'buckets.id', '=', 'project.bucket_id');
    $qualitative_risk_data->leftJoin('employee_records', 'employee_records.employee_id', '=', 'project.person_responsible');
    $qualitative_risk_data->leftJoin('cost_centres', 'cost_centres.cost_id', '=', 'project.cost_centre');
    $qualitative_risk_data->leftJoin('users', 'users.id', '=', 'project.created_by');
    $qualitative_risk_data->leftJoin('project_type', 'project_type.id', '=', 'project.project_type');
    $qualitative_risk_data->orderBy('qualitative_risk_analysis.id', 'desc');
    $qualitative_risk_data->where('project.company_id', '=', Auth::user()->company_id);

    if (isset($projectsFrom)) {
      $qualitative_risk_data->where('project.id', '>=', $projectsFrom);
    }

    if (isset($projectsTo)) {
      $qualitative_risk_data->where('project.id', '<=', $projectsTo);
    }

    if (isset($risktype) && $risktype != "-") {
      $qualitative_risk_data->where('risk_type', $risktype);
    }

    if (isset($status) && $status != "-") {
      $qualitative_risk_data->where('qual_status', $status);
    }


    if (isset($projectsFrom) || isset($projectsTo) || isset($status) || isset($risktype)) {
      $qualitative_data = $qualitative_risk_data->get()->toArray();
    }

    return $qualitative_data;
  }

  public static function qualitativeReportGraph($projectsFrom, $projectsTo) {
    $qualitative_data = array();

    //get qualitative data
    $qualitative_risk_data = qualitative_risk_analysis::query();
	$qualitative_risk_data->select('project.project_Id',DB::raw('sum(qualitative_risk_analysis.risk_score) as total_risk_score'));
    $qualitative_risk_data->leftJoin('project', 'project.project_Id', '=', 'qualitative_risk_analysis.project_id');
   
  
    $qualitative_risk_data->where('project.company_id', '=', Auth::user()->company_id);

    if (isset($projectsFrom)) {
      $qualitative_risk_data->where('project.id', '>=', $projectsFrom);
    }

    if (isset($projectsTo)) {
      $qualitative_risk_data->where('project.id', '<=', $projectsTo);
    }

    
    $qualitative_risk_data->where('risk_type', '=','Qualitative');
	$qualitative_risk_data->groupBy(DB::raw("project.project_Id"));
    if (isset($projectsFrom) || isset($projectsTo) || isset($status) || isset($risktype)) {
      $qualitative_data = $qualitative_risk_data->get()->toArray();
    }

    return $qualitative_data;
  }

}
