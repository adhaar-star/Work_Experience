<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class purchase_order extends Model {

    protected $table = 'purchase_order';
    public $timestamps = false;
    protected $fillable = [
        'purchase_order_number',
        'header_note',
        'approver_1',
        'approver_2',
        'approver_3',
        'approver_4',
        'approved_indicator',
        'approver_token',
        'company_id'

    ];

    public static function purchaseOrderReport($reportProject_from = NULL, $reportProject_to = NULL) {
        $query = self::query()
                ->select('purchase_order.*', 'purchaseorder_item.item_no', 'purchaseorder_item.project_id', 'purchaseorder_item.vendor',DB::raw('DATE_FORMAT(purchaseorder_item.delivery_date, "%d-%m-%Y") as delivery_date '),DB::raw('purchaseorder_item.item_quantity * purchaseorder_item.item_cost as item_cost'),'purchase_order.approved_indicator as status', 'project.id as project_uid', 'project.id as project_uid', 'project.person_responsible', 'project.project_name', 'project.bucket_id', 'project.cost_centre', 'project.project_desc', 'project.project_Id','project.start_date', 'project.end_date', 'project.a_start_date', 'project.a_end_date', 'project.f_start_date', 'project.f_end_date', 'project.sch_date', 'project.p_end_date', 'project.created_by', 'project.p_start_date','project_type.name as project_type_name','department_type.name as department_name','buckets.name as bucket_name',DB::raw('CONCAT_WS(" ",er.employee_first_name, er.employee_middle_name,er.employee_last_name) AS responsible_person'), 'vendor.name as vendor_name', 'portfolio.name as portfolio_name', 'portfolio.port_id as portfolio_id', 'portfolio_type.name as portfolio_type', 'portfolio.port_id as portfolio_id', 'project.bucket_id', 'project_phase.phase_Id as project_phase_id','state_subrub.subrub as location','cost_centres.cost_centre as cost_centre_name')
                ->leftJoin('purchaseorder_item', 'purchaseorder_item.purchase_order_number', '=', 'purchase_order.purchase_order_number')
                ->leftJoin('project', 'project.id', '=', 'purchaseorder_item.project_id')
                ->leftJoin('project_type', 'project_type.id', '=', 'project.project_type')
                ->leftJoin('portfolio', 'portfolio.id', '=', 'project.portfolio_id')
                ->leftJoin('portfolio_type', 'portfolio_type.id', '=', 'portfolio.type')
                ->leftJoin('department_type', 'department_type.id', '=', 'project.department')
                ->leftJoin('buckets', 'buckets.id', '=', 'project.bucket_id')
                ->leftJoin('employee_records as er', 'er.employee_id', '=', 'project.person_responsible')
                ->leftJoin('vendor', 'vendor.id', '=', 'purchaseorder_item.vendor')
                ->leftJoin('project_phase', 'project_phase.project_id', '=', 'project.project_id')
                ->leftJoin('state_subrub', 'state_subrub.id', '=', 'project.location_id')
                ->leftJoin('cost_centres', 'cost_centres.cost_id', '=', 'project.cost_centre')
                ->where('purchase_order.company_id', '=', Auth::user()->company_id)
                ->orderBy('purchase_order.id', 'desc');
        
        if(isset($reportProject_from) && isset($reportProject_to)) 
            $query->whereBetween('project.id', [$reportProject_from, $reportProject_to]);
        
        return $query->get();
    }
	
	public static function purchaseOrderReportGraph($reportProject_from, $reportProject_to) {
        $query = self::query()
		->select( 'vendor.vendor_id',DB::raw('sum(purchaseorder_item.item_quantity * purchaseorder_item.item_cost) as total_order_cost'))
		->leftJoin('purchaseorder_item', 'purchaseorder_item.purchase_order_number', '=', 'purchase_order.purchase_order_number')
		->leftJoin('project', 'project.id', '=', 'purchaseorder_item.project_id')
		->leftJoin('vendor', 'vendor.id', '=', 'purchaseorder_item.vendor')
		->where('purchase_order.company_id', '=', Auth::user()->company_id)
		->groupBy(DB::raw("vendor.vendor_id"));
		 if(isset($reportProject_from) && isset($reportProject_to)) 
            $query->whereBetween('project.id', [$reportProject_from, $reportProject_to]);
		return $query->get();
    }
}
