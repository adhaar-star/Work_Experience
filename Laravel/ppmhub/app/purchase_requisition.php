<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\purchase_item;

class purchase_requisition extends Model {

  protected $table = 'purchase_requisition';
  public $timestamps = false;
  protected $fillable = [
      'requisition_number',
      'header_note',
      'approver_1',
      'approver_2',
      'approver_3',
      'approver_4',
      'approved_indicator',
      'approver_token',
      'company_id'
  ];

  public static function purchaseRequisitionReport($reportProject_from, $reportProject_to) {
    
    //report data
    $query = purchase_requisition::query();
    $query->select('project.project_Id','project.project_desc','purchase_requisition.requisition_number','purchase_item.item_no',DB::raw('(purchase_item.item_cost * purchase_item.item_quantity) as item_cost'), DB::raw('CONCAT_WS(" ",er.employee_first_name, er.employee_middle_name,er.employee_last_name) AS responsible_person') ,'portfolio_type.name as portfoliotype_name', 'vendor.name as vendor_name',DB::raw('DATE_FORMAT(purchase_item.delivery_date, "%d-%m-%Y") as delivery_date'), 'purchase_requisition.approved_indicator as approved_indicator', 'project.id as project_uid', 'project_type.name as projecttype_name', 'project_phase.phase_Id', 'project.*', 'project.id as project_uid', 'project.project_name', 'portfolio.port_id as portfolio_id', 'users.name as created_name', 'state_subrub.subrub as location_name', 'portfolio.name as portfolio_name', 'buckets.bucket_id as bucket_id', 'buckets.name as bucket_name', 'department_type.name as department_name', 'cost_centres.cost_centre');
    $query->leftJoin('purchase_item', 'purchase_item.requisition_number', '=', 'purchase_requisition.requisition_number');
    $query->leftJoin('vendor', 'vendor.id', '=', 'purchase_item.vendor');
    $query->leftJoin('project', 'project.id', '=', 'purchase_item.project_Id');
    $query->leftJoin('taskassign', 'taskassign.project_id', '=', 'project.project_id');
    $query->leftJoin('employee_records as er', 'er.employee_id', '=', 'project.person_responsible');
    $query->leftJoin('project_phase', 'project_phase.project_id', '=', 'project.project_id');
    $query->leftJoin('portfolio', 'portfolio.id', '=', 'project.portfolio_id');
    $query->leftJoin('portfolio_type', 'portfolio_type.id', '=', 'project.portfolio_type');
    $query->leftJoin('project_type', 'project_type.id', '=', 'project.project_type');
    $query->leftJoin('state_subrub', 'state_subrub.id', '=', 'project.location_id');
    $query->leftJoin('department_type', 'department_type.id', '=', 'project.department');
    $query->leftJoin('buckets', 'buckets.id', '=', 'project.bucket_id');
    $query->leftJoin('cost_centres', 'cost_centres.cost_id', '=', 'project.cost_centre');
    $query->leftJoin('users', 'users.id', '=', 'project.created_by');
    $query->orderBy('purchase_requisition.id', 'desc');

    //graph data
    $query2 = purchase_item::query();
    $query2->select(DB::raw('sum(purchase_item.item_quantity * purchase_item.item_cost) as purchase_item_cost'), 'project.project_Id as project_id');
    $query2->join('project', 'project.id', '=', 'purchase_item.project_Id');
    $query2->where('purchase_item.company_id', Auth::user()->company_id);
    $query2->groupBy('project.project_Id');

    if (isset($reportProject_from)) {
      $query->where('project.id', '>=', $reportProject_from);
      $query2->where('project.id', '>=', $reportProject_from);
    }
    if (isset($reportProject_to)) {
      $query->where('project.id', '<=', $reportProject_to);
      $query2->where('project.id', '<=', $reportProject_to);
    }
    
    $query->where('project.company_id', Auth::user()->company_id);

    if (isset($reportProject_from) || isset($reportProject_to)) {
      $report = $query->get();
      $graph = $query2->pluck('project_id', 'purchase_item_cost');
    } else {
      $report = array();
      $graph = array();
    }
    return $report;
  }

	public static function purchaseRequisitionReportGraph($reportProject_from, $reportProject_to) {

		//report data
		$query = purchase_requisition::query();
		$query->select('project.project_Id',DB::raw('sum(purchase_item.item_cost * purchase_item.item_quantity) as total_cost'));
		$query->leftJoin('purchase_item', 'purchase_item.requisition_number', '=', 'purchase_requisition.requisition_number');
		$query->leftJoin('project', 'project.id', '=', 'purchase_item.project_Id');
		$query->groupBy('project.project_Id');

		if (isset($reportProject_from)) {
		  $query->where('project.id', '>=', $reportProject_from);
		}
		if (isset($reportProject_to)) {
		  $query->where('project.id', '<=', $reportProject_to);
		}

		$query->where('project.company_id', Auth::user()->company_id);

		if (isset($reportProject_from) || isset($reportProject_to)) {
		  $report = $query->get();
		} else {
		  $report = array();
		}
		return $report;
	}
  
  
  

}
