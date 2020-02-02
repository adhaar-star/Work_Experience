<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class quantitative_risk_analysis extends Model {

  protected $table = 'quantitative_risk_analysis';
  protected $fillable = [
      'quan_id',
      'project_id', 'risk_mitigation_action', 'created_at', 'updated_at',
      'quan_risk_id', 'risk_type', 'quan_category', 'quan_risk_desc', 'quan_total_loss',
      'quan_currency', 'quan_probability', 'quan_risk_score', 'quan_expected_loss', 'quan_created_by',
      'quan_changed_by', 'company_id', 'status', 'risk_mitigation_action',
      'strategic_context','organisational_context','riskmanagement_context'
  ];
  public $timestamps = false;

  public static function validateQuantitative($post) {
    $validationmessages = [
        'project_id.required' => 'Please select project id',
        'quan_category.required' => 'Please select risk category',
        'quan_risk_desc.required' => 'Please enter risk description',
        'quan_risk_desc.min' => 'Please enter at least 3 characters.',
        'quan_risk_desc.max' => 'Please enter no more than 100 characters.',
        'quan_total_loss.required' => 'Please enter total loss',
        'quan_total_loss.numeric' => 'Please enter only digits.',
        'quan_currency.required' => 'Please select currency',
        'quan_probability.required' => 'Please enter probability between 0 to 100',
        'quan_probability.numeric' => 'Please enter only digits.',
        'quan_probability.min' => 'Please enter a value greater than or equal to 1.',
        'quan_probability.max' => 'Please enter a value less than or equal to 99.',
        'status.required' => 'Please select status',
        'risk_mitigation_action.required' => 'Please enter risk mitigation action',
        'risk_mitigation_action.max' => 'Allow only 250 characters',
        'quan_risk_score.required' => 'Risk score is not set because expected loss is out of range, Please change your quantitative risk score range first.'
    ];

    $validator = Validator::make($post, [
          'project_id' => 'required',
          'quan_category' => 'required',
          'quan_risk_desc' => 'required|min:3|max:100',
          'quan_total_loss' => 'required|numeric',
          'quan_currency' => 'required',
          'quan_probability' => 'required|numeric|min:1|max:99',
          'status' => 'required',
          'risk_mitigation_action' => 'required|max:250',
          'quan_risk_score' => 'required'
        ], $validationmessages);
    return $validator;
  }

  public static function validateQuantitativeContext($post) {
    $validationmessages = [
        'quan_risk_desc.min' => 'Please enter at least 3 characters.',
        'quan_risk_desc.max' => 'Please enter no more than 100 characters.',
        'strategic_context.max' => 'Allow only 300 characters for strategic context',
        'organisational_context.max' => 'Allow only 300 characters for organisational context',
        'riskmanagement_context.max' => 'Allow only 300 characters for riskmanagement context'
    ];

    $validator = Validator::make($post, [
          'quan_risk_desc' => 'min:3|max:100',
          'strategic_context' => 'max:300',
          'organisational_context' => 'max:300',
          'riskmanagement_context' => 'max:300'
        ], $validationmessages);
    return $validator;
  }

  public static function quantitativeReport($projectsFrom, $risktype, $projectsTo, $status) {
    $quantitative_data = array();

    //get quantitative data
    $quantitative_risk_data = quantitative_risk_analysis::query();
    $quantitative_risk_data->select('quantitative_risk_analysis.quan_risk_id as qual_risk_id', 'quantitative_risk_analysis.quan_risk_score as risk_score', 'quantitative_risk_analysis.*', 'quantitative_risk_analysis.status as risk_status', 'portfolio_type.name as portfoliotype_name', 'project_type.name as projecttype_name', 'project.project_Id', 'project.project_name', 'project.*', 'portfolio.port_id as portfolio_id', 'users.name as created_name', 'state_subrub.subrub as location_name', 'portfolio.name as portfolio_name', 'buckets.bucket_id as bucket_id', 'buckets.name as bucket_name', 'department_type.name as department_name', 'employee_records.employee_first_name as name', 'cost_centres.cost_centre');
    $quantitative_risk_data->leftJoin('project', 'project.project_Id', '=', 'quantitative_risk_analysis.project_id');
    $quantitative_risk_data->leftJoin('portfolio', 'portfolio.id', '=', 'project.portfolio_id');
    $quantitative_risk_data->leftJoin('portfolio_type', 'portfolio_type.id', '=', 'project.portfolio_type');
    $quantitative_risk_data->leftJoin('state_subrub', 'state_subrub.id', '=', 'project.location_id');
    $quantitative_risk_data->leftJoin('department_type', 'department_type.id', '=', 'project.department');
    $quantitative_risk_data->leftJoin('buckets', 'buckets.id', '=', 'project.bucket_id');
    $quantitative_risk_data->leftJoin('employee_records', 'employee_records.employee_id', '=', 'project.person_responsible');
    $quantitative_risk_data->leftJoin('cost_centres', 'cost_centres.cost_id', '=', 'project.cost_centre');
    $quantitative_risk_data->leftJoin('users', 'users.id', '=', 'project.created_by');
    $quantitative_risk_data->leftJoin('project_type', 'project_type.id', '=', 'project.project_type');
    $quantitative_risk_data->orderBy('quantitative_risk_analysis.quan_id', 'desc');

    if (isset($projectsFrom)) {
      $quantitative_risk_data->where('project.id', '>=', $projectsFrom);
    }

    if (isset($projectsTo)) {
      $quantitative_risk_data->where('project.id', '<=', $projectsTo);
    }

    if (isset($risktype) && $risktype != "-") {
      $quantitative_risk_data->where('quantitative_risk_analysis.risk_type', $risktype);
    }
    if (isset($status) && $status != "-") {
      $quantitative_risk_data->where('quantitative_risk_analysis.status', $status);
    }
	
    $quantitative_risk_data->where('project.company_id', '=', Auth::user()->company_id);

    if (isset($projectsFrom) || isset($projectsTo) || isset($status) || isset($risktype)) {
      $quantitative_data = $quantitative_risk_data->get()->toArray();
    }
    return $quantitative_data;
  }

 public static function quantitativeReportGraph($projectsFrom, $projectsTo) {
    $quantitative_data = array();

    //get quantitative data
    $quantitative_risk_data = quantitative_risk_analysis::query();
	$quantitative_risk_data->select('project.project_Id',DB::raw('sum(quantitative_risk_analysis.quan_risk_score) as total_risk_score'));
    $quantitative_risk_data->leftJoin('project', 'project.project_Id', '=', 'quantitative_risk_analysis.project_id');
   

    if (isset($projectsFrom)) {
      $quantitative_risk_data->where('project.id', '>=', $projectsFrom);
    }

    if (isset($projectsTo)) {
      $quantitative_risk_data->where('project.id', '<=', $projectsTo);
    }

    if (isset($risktype) && $risktype != "-") {
      $quantitative_risk_data->where('quantitative_risk_analysis.risk_type', '=','Quantitative');
    }
   
    $quantitative_risk_data->where('project.company_id', '=', Auth::user()->company_id);
	$quantitative_risk_data->groupBy(DB::raw("project.project_Id"));
    if (isset($projectsFrom) || isset($projectsTo) || isset($risktype)) {
      $quantitative_data = $quantitative_risk_data->get()->toArray();
    }
    return $quantitative_data;
  }

}
