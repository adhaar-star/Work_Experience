<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\customerinquiry;
use App\customer_master;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\unitofmeasure;
use App\materialmaster;
use Illuminate\Support\Facades\DB;
use App\materialgroup;
use App\Cost_centres;
use App\Employee_records;
use App\inquiry_type;
use App\salesregion;
use App\customer_inquiry_item;
use PDF;
use App\Inquirynumber_range;
use App\Projectphase;
use Illuminate\Support\Facades\Session;

class CustomerInquiryController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        $customer_inquiry = DB::table('customer_inquiry')
                ->select('customer_inquiry.*', 'inquiry_type.inquiry_type', 'employee_records.employee_first_name', 'users.name', 'customer_master.customer_id', 'salesorganization.sales_organization', 'salesregion.sales_region')
                ->leftJoin('employee_records', 'customer_inquiry.requested_by', '=', 'employee_records.employee_id')
                ->leftJoin('users', 'customer_inquiry.created_by', '=', 'users.id')
                ->leftJoin('customer_master', 'customer_inquiry.customer', '=', 'customer_master.id')
                ->leftJoin('salesorganization', 'customer_inquiry.sales_organization', '=', 'salesorganization.id')
                ->leftJoin('salesregion', 'customer_inquiry.sales_region', '=', 'salesregion.id')
                ->leftJoin('inquiry_type', 'customer_inquiry.inquiry_type', '=', 'inquiry_type.id')
                ->get();
        if ($id != null) {
            return view('admin.customerinquiry.index', compact('customer_inquiry', 'id'));
        } else {
            return view('admin.customerinquiry.index', compact('customer_inquiry'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //created inquiry date
        $inquiry_createdDate = date("Y-m-d");
        //get maximum inquiry number
        $max_inquirynumber = DB::table('customer_inquiry')->MAX('inquiry_number');
        $inquiry_number = array();
        $range = Inquirynumber_range::where('company_id', Auth::user()->company_id)->first();

        $start_range = isset($range->start_range) ? $range->start_range : '' ;
        $end_range = isset($range->end_range) ? $range->end_range : '';

        if ($max_inquirynumber == null || $max_inquirynumber == 0 || $max_inquirynumber < $start_range) {
            $inquiry_number = $start_range;
        } else {
            $inquiry_number = $max_inquirynumber + 1;
            if ($inquiry_number > $end_range) {
                session()->flash('flash_message', 'Please change end range of inquiry number in settings...');
                $inquiry_number = '';
            }
        }
        
        //get inquiry type
        $inquirytype = array();
        $temp = null;
        $temp = inquiry_type::all();
        foreach ($temp as $value) {
            $inquirytype [$value['id']] = $value['inquiry_type'];
        }
        //get project
        $project_data = DB::table("project")
                ->select('project_Id')
                ->where('company_id', Auth::user()->company_id)
                ->get();
        $pid = array();
        foreach ($project_data as $key => $projectdata) {
            $pid[$projectdata->project_Id] = isset($projectdata->project_Id) ? $projectdata->project_Id : '';
        }
        //get sales region
        $salesregion = array();
        $temp = null;
        $temp = salesregion::all();
        foreach ($temp as $value) {
            $salesregion [$value['id']] = $value['sales_region'];
        }
        //get sales organization
        $salesorg = array();
        $sales_org = \App\sales_organization::where('company_id', Auth::user()->company_id)->get();
        foreach ($sales_org as $value) {
            $salesorg[$value->id] = $value->sales_organization;
        }
        //get unit of measure
        $unit_of_measure = unitofmeasure::all();
        $unitmeasure = array();
        foreach ($unit_of_measure as $unitofmeasure) {
            $unitmeasure[$unitofmeasure->unitofmeasure] = isset($unitofmeasure->unitofmeasure) ? $unitofmeasure->unitofmeasure : '';
        }
        //get customer
        $customer_data = customer_master::all();
        $customer_id = array();
        foreach ($customer_data as $customer) {
            $customer_id[$customer->id] = isset($customer->customer_id) ? $customer->customer_id : '';
        }
        //get material
        $material = array();
        $temp = materialmaster::all();
        foreach ($temp as $value) {
            $material[$value['material_number']] = $value['material_name'];
        }
        //get requestedby value
        $requestedby = array();
        $temp = Employee_records::where('company_id', Auth::user()->company_id)->get();
        foreach ($temp as $value) {

            $requestedby[$value->employee_id] = isset($value->employee_id) ? $value->employee_id . ' (' . $value->employee_first_name . ') ' : '';
        }
        //get project number
        $project_data = DB::table("project")
                ->select('project.*')
                ->where('company_id', Auth::user()->company_id)
                ->get();
        $pid = array();
        foreach ($project_data as $key => $projectdata) {
            $pid[$projectdata->project_Id] = isset($projectdata->project_Id) ? $projectdata->project_Id . ' (' . $projectdata->project_name . ') ' : '';
        }
        //get task id
        $task_data = DB::table("tasks_subtask")
                ->select('tasks_subtask.*')
                ->where('company_id', Auth::user()->company_id)
                ->get();
        $tid = array();
        foreach ($task_data as $key => $taskdata) {
            $tid[$taskdata->task_Id] = isset($taskdata->task_Id) ? $taskdata->task_Id . ' (' . $taskdata->task_name . ') ' : '';
        }
        $phase_ids = array();
        $phase_data = Projectphase::all();
        foreach ($phase_data as $value) {
            $phase_ids[$value['id']] = $value['phase_Id'] . ' (' . $value['phase_name'] . ') ';
        }
        //get cost_center
        $cost_centre = Cost_centres::where('company_id', Auth::user()->company_id)->get();
        $cost = array();
        foreach ($cost_centre as $costcenter) {
            $cost[$costcenter->cost_centre] = isset($costcenter->cost_centre) ? $costcenter->cost_centre : '';
        }
        //get reason for rejection
        $reasonRejection = array();
        $reason_data = \App\reasonRejection::where('company_id', Auth::user()->company_id)->get();
        foreach ($reason_data as $value) {
            $reasonRejection[$value->id] = $value->reason_rejection;
        }
        return view('admin.customerinquiry.create', compact('reasonRejection', 'salesorg', 'cost', 'phase_ids', 'pid', 'tid', 'requestedby', 'material', 'inquiry_createdDate', 'pid', 'unitmeasure', 'inquirytype', 'salesregion', 'customer_id', 'inquiry_number', 'created_on', 'username'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inquiry_data = Input::all();
        $elementdata = $inquiry_data['elementdata'];
        $inquiry = $inquiry_data['obj'];
        $inquiry['company_id'] = Auth::user()->company_id;
        $inquiry['created_by'] = Auth::User()->id;
        $inquiry['created_on'] = date("Y-m-d");
        $validationmessages = [
            'inquiry_description.required' => 'Please enter inquiry description',
            'inquiry_description.min' => 'Please enter at least 3 characters',
            'inquiry_description.max' => 'Please enter no more than 250 characters',
            'customer.required' => "Please select customer",
            'sales_organization.required' => 'Please select sales organization',
            'sales_region.required' => "Please select sales region",
            'inquiry_type.required' => "Please select inquiry type",
        ];
        $validator = Validator::make($inquiry, [
                    'inquiry_description' => "required|min:3|max:250",
                    'customer' => "required",
                    'sales_organization' => "required",
                    'sales_region' => "required",
                    'inquiry_type' => "required",
                        ], $validationmessages);
        if ($validator->fails()) {
            $msgs = $validator->messages();
            return response()->json($msgs);
        }
        foreach ($elementdata as $index => $row) {
            $row['inquiry_number'] = $inquiry['inquiry_number'];
            $row['company_id'] = Auth::user()->company_id;
            $row['created_on'] = date("Y-m-d");
            $row['created_by'] = Auth::User()->id;
            unset($row['optradio']);
            $validationmsgitem = [
                'order_qty.required' => 'Please enter order quantity' . ($index + 1) . ' record',
                'order_qty.numeric' => 'Please enter order quantity in number' . ($index + 1) . '  record',
                'cost_unit.required' => 'Please enter cost unit' . ($index + 1) . ' record',
                'cost_unit.numeric' => 'Please enter cost unit in number' . ($index + 1) . '  record',
                'short_description.required' => 'Please enter short description' . ($index + 1) . ' record',
                'short_description.min' => 'Please enter at least 3 characters.' . ($index + 1) . ' record',
                'short_description.max' => 'Please enter no more than 40 characters.' . ($index + 1) . ' record',
                'discount.numeric' => 'Please enter discount in number' . ($index + 1) . ' record',
                'sales_tax.required' => 'Please enter sales tax' . ($index + 1) . ' record',
                'sales_tax.numeric' => 'Please enter sales tax in number' . ($index + 1) . ' record',
                'freight_charges.numeric' => 'Please enter freight charges in number' . ($index + 1) . ' record',
                'project_id.required' => 'Please select project' . ($index + 1) . ' record',
                'phaseid.required' => 'Please select phase' . ($index + 1) . ' record',
                'task.required' => 'Please select task' . ($index + 1) . ' record',
                'processing_status.required' => 'Please select status' . ($index + 1) . ' record',
                'company_name.required' => 'Please enter company name' . ($index + 1) . ' record',
            ];
            $validator = Validator::make($row, ['status' => 'required',
                        'order_qty' => "required|numeric",
                        'cost_unit' => "required|numeric",
                        'short_description' => "required|min:3|max:40",
                        'discount' => "numeric",
                        'sales_tax' => "required|numeric",
                        'freight_charges' => "numeric",
                        'project_id' => "required",
                        'phaseid' => "required",
                        'task' => "required",
                        'processing_status' => "required",
                        'company_name' => "required",
                            ], $validationmsgitem);
            if ($validator->fails()) {
                $msgs = $validator->messages();
                return response()->json($msgs);
            }

            $matchThese = array('inquiry_number' => $inquiry['inquiry_number'], 'item_no' => $row['item_no']);
            customer_inquiry_item::updateOrCreate($matchThese, $row);
        }
        customerinquiry::create($inquiry);
        session()->flash('flash_message', 'Customer Inquiry Created successfully...');
        return response()->json(array('redirect_url' => 'admin/customer_inquiry'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer_inquiry = DB::table('customer_inquiry')
                ->select('customer_inquiry.*', 'inquiry_type.inquiry_type', 'employee_records.employee_first_name', 'users.name', 'customer_master.customer_id', 'salesorganization.sales_organization', 'salesregion.sales_region')
                ->leftJoin('employee_records', 'customer_inquiry.requested_by', '=', 'employee_records.employee_id')
                ->leftJoin('users', 'customer_inquiry.created_by', '=', 'users.id')
                ->leftJoin('customer_master', 'customer_inquiry.customer', '=', 'customer_master.id')
                ->leftJoin('salesorganization', 'customer_inquiry.sales_organization', '=', 'salesorganization.id')
                ->leftJoin('salesregion', 'customer_inquiry.sales_region', '=', 'salesregion.id')
                ->leftJoin('inquiry_type', 'customer_inquiry.inquiry_type', '=', 'inquiry_type.id')
                ->where('inquiry_number', $id)
                ->first();
        if (count($customer_inquiry) > 0) {
            Session::forget('flash_message');
            $id = $customer_inquiry->inquiry_number;
            return view('admin.customerinquiry.viewModel', compact('customer_inquiry', 'id'));
        } else {
            session()->flash('flash_message', 'Customer inquiry has been deleted...');
            return redirect('admin/quotation');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //get customer inquiry data
        $customer_inquiry = customerinquiry::find($id);
        //get customer inquiry item data
        $item = DB::table('customer_inquiry_item')
                ->select('customer_inquiry_item.*')
                ->where('inquiry_number', $customer_inquiry->inquiry_number)
                ->where('company_id', Auth::user()->company_id)
                ->get();
        foreach ($item as $key => $value) {
            $itemData = $value;
        }
        $created_by = DB::table('users')
                ->select('users.name')
                ->where('id', $customer_inquiry->created_by)
                ->where('company_id', Auth::user()->company_id)
                ->first();

        $changed_by = DB::table('users')
                ->select('users.name')
                ->where('id', $customer_inquiry->changed_by)
                ->where('company_id', Auth::user()->company_id)
                ->first();
        //get customer
        $customer_data = customer_master::all();
        foreach ($customer_data as $customer) {
            $customer_id[$customer->id] = isset($customer->customer_id) ? $customer->customer_id : '';
        }
        $inquirytype = array();
        $temp = null;
        $temp = inquiry_type::all();
        foreach ($temp as $value) {
            $inquirytype [$value['id']] = $value['inquiry_type'];
        }
        $salesregion = array();
        $temp = null;
        $temp = salesregion::all();
        foreach ($temp as $value) {
            $salesregion [$value['id']] = $value['sales_region'];
        }
        //get sales organization
        $salesorg = array();
        $sales_org = \App\sales_organization::where('company_id', Auth::user()->company_id)->get();
        foreach ($sales_org as $value) {
            $salesorg[$value->id] = $value->sales_organization;
        }
        //get reason for rejection
        $reasonRejection = array();
        $reason_data = \App\reasonRejection::where('company_id', Auth::user()->company_id)->get();
        foreach ($reason_data as $value) {
            $reasonRejection[$value->id] = $value->reason_rejection;
        }
        $material = array();
        $temp = materialmaster::all();
        foreach ($temp as $value) {
            $material[$value['material_number']] = $value['material_name'];
        }
        //get unit of measure
        $unit_of_measure = unitofmeasure::all();

        foreach ($unit_of_measure as $unitofmeasure) {
            $unitmeasure[$unitofmeasure->unitofmeasure] = isset($unitofmeasure->unitofmeasure) ? $unitofmeasure->unitofmeasure : '';
        }
        $customer_item_data = customer_inquiry_item::where('inquiry_number', $customer_inquiry->inquiry_number)->get();
        //get project number
        $project_data = DB::table("project")
                ->select('project.*')
                ->where('company_id', Auth::user()->company_id)
                ->get();
        $pid = '';
        foreach ($project_data as $key => $projectdata) {
            $pid[$projectdata->project_Id] = isset($projectdata->project_Id) ? $projectdata->project_Id . ' (' . $projectdata->project_name . ') ' : '';
        }
        //get task id
        $task_data = DB::table("tasks_subtask")
                ->select('tasks_subtask.*')
                ->where('company_id', Auth::user()->company_id)
                ->get();
        $tid = '';
        foreach ($task_data as $key => $taskdata) {
            $tid[$taskdata->task_Id] = isset($taskdata->task_Id) ? $taskdata->task_Id . ' (' . $taskdata->task_name . ') ' : '';
        }
        $phase_ids = array();
        $phase_data = Projectphase::all();
        foreach ($phase_data as $value) {
            $phase_ids[$value['id']] = $value['phase_Id'] . ' (' . $value['phase_name'] . ') ';
        }
        //get material group
        $material_group = materialgroup::all();
        foreach ($material_group as $group) {
            $materialgrp[$group->materialgroup] = isset($group->materialgroup) ? $group->materialgroup : '';
        }
        //get cost_center
        $cost_centre = Cost_centres::all();
        foreach ($cost_centre as $costcenter) {
            $cost[$costcenter->cost_centre] = isset($costcenter->cost_centre) ? $costcenter->cost_centre : '';
        }
        //get requestedby value
        $requestedby = array();
        $temp = Employee_records::where('company_id', Auth::user()->company_id)->get();
        foreach ($temp as $value) {

            $requestedby[$value->employee_id] = isset($value->employee_id) ? $value->employee_id . ' (' . $value->employee_first_name . ') ' : '';
        }
        $createdDate = date('Y-m-d', strtotime($customer_inquiry->created_on));
        return view('admin.customerinquiry.edit', compact('reasonRejection', 'changed_by', 'salesorg', 'createdDate', 'customerName', 'itemData', 'created_by', 'phase_ids', 'customer_item_data', 'id', 'material', 'po_item', 'salesregion', 'inquirytype', 'customer_inquiry', 'customer_id', 'unitmeasure', 'material_no', 'pid', 'tid', 'materialgrp', 'cost', 'requestedby', 'quotation_id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $customer_inquiry_data = Input::all();
        $elementdata = $customer_inquiry_data['elementdata'];
        $customer_inquiry = $customer_inquiry_data['obj'];
        unset($customer_inquiry['optradio']);
        $validationmessages = [
            'inquiry_description.required' => 'Please enter inquiry description',
            'inquiry_description.min' => 'Please enter at least 3 characters',
            'inquiry_description.max' => 'Please enter no more than 250 characters',
            'customer.required' => "Please select customer",
            'sales_organization.required' => 'Please select sales organization',
            'sales_region.required' => "Please select sales region",
            'inquiry_type.required' => "Please select inquiry type",
        ];
        $validator = Validator::make($customer_inquiry, [
                    'inquiry_description' => "required|min:3|max:250",
                    'customer' => "required",
                    'sales_organization' => "required",
                    'sales_region' => "required",
                    'inquiry_type' => "required",
                        ], $validationmessages);
        if ($validator->fails()) {
            $msgs = $validator->messages();
            return response()->json($msgs);
        }
        if (isset($elementdata)) {
            foreach ($elementdata as $index => $row) {
                $row['inquiry_number'] = $customer_inquiry['inquiry_number'];
                unset($row['optradio']);
                $validationmsgitem = [
                    'order_qty.required' => 'Please enter order quantity' . ($index + 1) . ' record',
                    'order_qty.numeric' => 'Please enter order quantity in number' . ($index + 1) . '  record',
                    'short_description.min' => 'Please enter at least 3 characters.' . ($index + 1) . ' record',
                    'short_description.max' => 'Please enter no more than 40 characters.' . ($index + 1) . ' record',
                    'cost_unit.required' => 'Please enter cost unit' . ($index + 1) . ' record',
                    'cost_unit.numeric' => 'Please enter cost unit in number' . ($index + 1) . '  record',
                    'short_description.required' => 'Please enter short description' . ($index + 1) . ' record',
                    'discount.numeric' => 'Please enter discount in number' . ($index + 1) . ' record',
                    'sales_tax.required' => 'Please enter sales tax' . ($index + 1) . ' record',
                    'sales_tax.numeric' => 'Please enter sales tax in number' . ($index + 1) . ' record',
                    'freight_charges.numeric' => 'Please enter freight charges in number' . ($index + 1) . ' record',
                    'project_id.required' => 'Please select project' . ($index + 1) . ' record',
                    'phaseid.required' => 'Please select phase' . ($index + 1) . ' record',
                    'task.required' => 'Please select task' . ($index + 1) . ' record',
                    'processing_status.required' => 'Please select status' . ($index + 1) . ' record',
                    'company_name.required' => 'Please enter company name' . ($index + 1) . ' record',
                ];
                $validator = Validator::make($row, ['status' => 'required',
                            'order_qty' => "required|numeric",
                            'cost_unit' => "required|numeric",
                            'short_description' => "required|min:3|max:40",
                            'discount' => "numeric",
                            'sales_tax' => "required|numeric",
                            'freight_charges' => "numeric",
                            'project_id' => "required",
                            'phaseid' => "required",
                            'task' => "required",
                            'processing_status' => "required",
                            'company_name' => "required",
                                ], $validationmsgitem);
                if ($validator->fails()) {
                    $msgs = $validator->messages();
                    return response()->json($msgs);
                }
                $row['company_id'] = Auth::user()->company_id;
                $row['changed_by'] = Auth::User()->id;
                $row['changed_on'] = date("Y-m-d");
                $matchThese = array('inquiry_number' => $customer_inquiry['inquiry_number'], 'item_no' => $row['item_no']);
                customer_inquiry_item::updateOrCreate($matchThese, $row);
            }
        }
        unset($customer_inquiry['_token']);
        unset($customer_inquiry['_method']);
        $customer_inquiry['changed_by'] = Auth::User()->id;
        $customer_inquiry['changed_on'] = date("Y-m-d");
        customerinquiry::where('id', $id)
                ->update($customer_inquiry);
        session()->flash('flash_message', 'Cutsomer inquiry updated successfully...');
        return response()->json(array('redirect_url' => 'admin/customer_inquiry'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $inquiry_id = customerinquiry::find($id);
        $inquiry_no = $inquiry_id->inquiry_number;
        $item_inquiryno = '';
        $item_data = DB::table('customer_inquiry_item')
                ->select('customer_inquiry_item.inquiry_number')
                ->where('inquiry_number', $inquiry_no)
                ->where('company_id', Auth::user()->company_id)
                ->get();
        foreach ($item_data as $value) {
            $item_inquiryno = $value->inquiry_number;
        }
        if ($inquiry_no == $item_inquiryno) {
            session()->flash('flash_message', 'Customer inquiry cannot be deleted , there is a items in this inquiry...');
            return redirect('admin/customer_inquiry');
        } else {
            $inquiry_id->delete();
            session()->flash('flash_message', 'Customer inquiry deleted successfully...');
            return redirect('admin/customer_inquiry');
        }
    }

    public function deleteItem($id)
    {
        $inquiry_id = customer_inquiry_item::find($id);
        $inquiry_id->delete($id);
        session()->flash('flash_message', 'Customer inquiry item deleted successfully...');
        return redirect('admin/customer_inquiry');
    }

    public function export_cs()
    {
        $inquiry = customerinquiry::all();
        $header = "InquiryNumber" . ",";
        $header .= "InquiryDescription" . ",";
        $header .= "Quotation" . ",";
        $header .= "SalesOrder" . ",";
        $header .= "Gross Price" . ",";
        $header .= "Discount" . ",";
        $header .= "Discount Amount" . ",";
        $header .= "Discount Gross Price" . ",";
        $header .= "Sales Tax Amount" . ",";
        $header .= "Net Price" . ",";
        $header .= "Freight Charges" . ",";
        $header .= "Total Price" . ",";
        $header .= "Customer" . ",";
        $header .= "SalesOrganization" . ",";
        $header .= "SalesRegion" . ",";
        $header .= "InquiryType" . ",";
        $header .= "RequestedBy" . ",";
        $header .= "CreatedOn" . ",";
        $header .= "CreatedBy" . ",";
        $header .= "ChangedOn" . ",";
        $header .= "ChangedBy" . ",";

        print $header . "\n";
        header("Content-type: application/vnd.ms-excel");
        header("Content-Disposition: attachment; filename=Inquiry.csv");
        header("Pragma: no-cache");
        header("Expires: 0");
        foreach ($inquiry as $inquiry_data) {
            try {

                $requested_by = DB::table('employee_records')
                        ->select('employee_records.employee_first_name')
                        ->where('employee_records.company_id', Auth::user()->company_id)
                        ->where('employee_records.employee_id', $inquiry_data->requested_by)
                        ->first();
                $created_by = DB::table('users')
                        ->select('users.name')
                        ->where('id', $inquiry_data->created_by)
                        ->where('users.company_id', Auth::user()->company_id)
                        ->first();
                $changed_by = DB::table('users')
                        ->select('users.name')
                        ->where('id', $inquiry_data->changed_by)
                        ->where('users.company_id', Auth::user()->company_id)
                        ->first();
                $customerid = DB::table('customer_master')
                        ->select('customer_master.customer_id')
                        ->where('id', $inquiry_data->customer)
                        ->first();
                $salesorg = DB::table('salesorganization')
                        ->select('salesorganization.sales_organization')
                        ->where('id', $inquiry_data->sales_organization)
                        ->where('salesorganization.company_id', Auth::user()->company_id)
                        ->first();
                $salesregion = DB::table('salesregion')
                        ->select('salesregion.sales_region')
                        ->where('id', $inquiry_data->sales_region)
                        ->first();
                $inquiry_type = DB::table('inquiry_type')
                        ->select('inquiry_type.inquiry_type')
                        ->where('id', $inquiry_data->inquiry_type)
                        ->first();
                $row1 = array();
                $row1[] .= '"' . $inquiry_data->inquiry_number . '"';
                $row1[] .= '"' . $inquiry_data->inquiry_description . '"';
                $row1[] .= '"' . $inquiry_data->quotation . '"';
                $row1[] .= '"' . $inquiry_data->sales_order . '"';
                $row1[] .= '"' . $inquiry_data->inquiry_gross_price . '"';
                $row1[] .= '"' . $inquiry_data->inquiry_discount . '"';
                $row1[] .= '"' . $inquiry_data->inquiry_discount_amt . '"';
                $row1[] .= '"' . $inquiry_data->inquiry_discount_gross_price . '"';
                $row1[] .= '"' . $inquiry_data->inquiry_sales_taxamt . '"';
                $row1[] .= '"' . $inquiry_data->inquiry_net_price . '"';
                $row1[] .= '"' . $inquiry_data->inquiry_freight_charges . '"';
                $row1[] .= '"' . $inquiry_data->inquiry_total_price . '"';
                $row1[] .= '"' . $customerid->customer_id . '"';
                $row1[] .= '"' . $salesorg->sales_organization . '"';
                $row1[] .= '"' . $salesregion->sales_region . '"';
                $row1[] .= '"' . $inquiry_type->inquiry_type . '"';
                $row1[] .= '"' . $requested_by->employee_first_name . '"';
                $row1[] .= '"' . $inquiry_data->created_on . '"';
                $row1[] .= '"' . $created_by->name . '"';
                $row1[] .= '"' . $inquiry_data->changed_on . '"';
                $row1[] .= '"' . (isset($changed_by->name) ? $changed_by->name : '') . '"';
                $data = join(",", $row1) . "\n";
                print $data;
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }
        }
    }

    public function pdfview(Request $request)
    {
        $items = DB::table("customer_inquiry")->get()->toArray();
        view()->share('items', $items);
        $headers = ['Content-Type: application/pdf'];
        if ($request->has('download')) {
            $pdf = PDF::loadView('admin/customerinquiry/pdfview');
            return $pdf->download('CustomerInquirypdf.pdf');
        }
        return view('admin.customerinquiry.pdfview');
    }

    //get Material Description based on material no
    public function getMaterialDescription($materialNo)
    {
        $materialData = materialmaster::where('material_number', $materialNo)->first();
        return response()->json(['status' => true, 'data' => $materialData]);
    }

    //get customer name based customer id
    public function getCustomerName($id)
    {
        $customerData = customer_master::where('id', $id)->first();
        return response()->json(['status' => true, 'data' => $customerData]);
    }

}
