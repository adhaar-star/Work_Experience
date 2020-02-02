<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\quotation;
use Illuminate\Support\Facades\Auth;
use App\customer_master;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\materialmaster;
use Illuminate\Support\Facades\DB;
use App\materialgroup;
use App\Cost_centres;
use App\Employee_records;
use Illuminate\Support\Facades\Session;
use App\quotationNumber;
use App\salesregion;
use App\Projectphase;
use App\quotationItem;
use PDF;
use Illuminate\Support\Facades\Mail;
use App\Mail\QuotationMail;

class QuotationController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $quotation_data = DB::table('quotation')
      ->select('quotation.*', 'employee_records.employee_first_name', 'users.name', 'customer_master.customer_id', 'salesorganization.sales_organization', 'salesregion.sales_region')
      ->leftJoin('employee_records', 'quotation.requested_by', '=', 'employee_records.employee_id')
      ->leftJoin('users', 'quotation.created_by', '=', 'users.id')
      ->leftJoin('customer_master', 'quotation.customer', '=', 'customer_master.id')
      ->leftJoin('salesorganization', 'quotation.sales_organization', '=', 'salesorganization.id')
      ->leftJoin('salesregion', 'quotation.sales_region', '=', 'salesregion.id')
      ->where('quotation.company_id', Auth::user()->company_id)
      ->get();
    return view('admin.quotation.index', compact('quotation_data'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    //get inquiry number
    $inquiry_no = array();
    $inquiry_number = \App\customerinquiry::where('company_id', Auth::user()->company_id)->get();
    foreach ($inquiry_number as $value) {
      $inquiry_no[$value->inquiry_number] = $value->inquiry_number;
    }
    //created quotation date
    $quotation_createdDate = date("Y-m-d");
    //get maximum quotation number
    $max_quotationnumber = DB::table('quotation')->MAX('quotation_number');
    $quotation_number = '';
    $range = quotationNumber::all();
    $start_range = array();
    $end_range = array();
    foreach ($range as $value) {
      $start_range = isset($value->start_range) ? $value->start_range : '';
      $end_range = isset($value->end_range) ? $value->end_range : '';
    }
    if ($max_quotationnumber == null || $max_quotationnumber == 0) {
      $quotation_number = $start_range;
    } else {
      $quotation_number = $max_quotationnumber + 1;
      if ($quotation_number > $end_range) {
        session()->flash('flash_message', 'Please change end range of quotation number in settings...');
        $quotation_number = '';
      }
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
    return view('admin.quotation.create', compact('inquiry_no', 'reasonRejection', 'salesorg', 'cost', 'phase_ids', 'pid', 'tid', 'requestedby', 'material', 'quotation_createdDate', 'pid', 'salesregion', 'customer_id', 'quotation_number', 'created_on', 'username'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {

    $quotation_data = Input::all();
    $elementdata = $quotation_data['elementdata'];
    $quotation = $quotation_data['obj'];
    $quotation['company_id'] = Auth::user()->company_id;
    $quotation['created_by'] = Auth::User()->id;
    $quotation['created_on'] = date("Y-m-d");

    $validationmessages = [
        'quotation_description.required' => 'Please enter quotation description',
        'quotation_description.min' => 'Please enter at least 3 characters',
        'quotation_description.max' => 'Please enter no more than 250 characters',
        'customer.required' => "Please select customer",
        'sales_organization.required' => 'Please select sales organization',
        'sales_region.required' => "Please select sales region",
        'quotation_type.required' => "Please select quotation type",
    ];

    $validator = Validator::make($quotation, [
          'quotation_description' => "required|min:3|max:250",
          'customer' => "required",
          'sales_organization' => "required",
          'sales_region' => "required",
          'quotation_type' => "required",
        ], $validationmessages);
    if ($validator->fails()) {
      $msgs = $validator->messages();
      return response()->json($msgs);
    }
    foreach ($elementdata as $index => $row) {

      $row['quotation_number'] = $quotation['quotation_number'];
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
          'contact_person_name.regex' => 'Please enter contact name in character in ' . ($index + 1) . ' record',
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
            'contact_person_name' => "regex:/^[A-Za-z.\s-_]+$/"
          ], $validationmsgitem);

      if ($validator->fails()) {
        $msgs = $validator->messages();
        return response()->json($msgs);
      }

      $matchThese = array('quotation_number' => $quotation['quotation_number'], 'item_no' => $row['item_no']);
      quotationItem::updateOrCreate($matchThese, $row);
    }

    quotation::create($quotation);
    session()->flash('flash_message', 'Quotation Created successfully...');
    return response()->json(array('redirect_url' => 'admin/quotation'));
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    $quotation = DB::table('quotation')
      ->select('quotation.*', 'employee_records.employee_first_name', 'users.name', 'customer_master.customer_id', 'salesorganization.sales_organization', 'salesregion.sales_region')
      ->leftJoin('employee_records', 'quotation.requested_by', '=', 'employee_records.employee_id')
      ->leftJoin('users', 'quotation.created_by', '=', 'users.id')
      ->leftJoin('customer_master', 'quotation.customer', '=', 'customer_master.id')
      ->leftJoin('salesorganization', 'quotation.sales_organization', '=', 'salesorganization.id')
      ->leftJoin('salesregion', 'quotation.sales_region', '=', 'salesregion.id')
      ->where('quotation_number', $id)
      ->first();
    if (count($quotation) > 0) {
      Session::forget('flash_message');
      $id = $quotation->quotation_number;
      return view('admin.quotation.viewModel', compact('quotation', 'id'));
    } else {
      session()->flash('flash_message', 'Quotation has been deleted...');
      return redirect('admin/customer_inquiry');
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    //get inquiry number
    $inquiry_no = array();
    $inquiry_number = \App\customerinquiry::where('company_id', Auth::user()->company_id)->get();
    foreach ($inquiry_number as $value) {
      $inquiry_no[$value->inquiry_number] = $value->inquiry_number;
    }
    //get quotation data
    $quotation = quotation::find($id);

    //get quotation item data
    $item = DB::table('quotation_item')
      ->select('quotation_item.*')
      ->where('quotation_number', $quotation->quotation_number)
      ->where('company_id', Auth::user()->company_id)
      ->get();
    foreach ($item as $key => $value) {
      $itemData = $value;
    }
    $created_by = DB::table('users')
      ->select('users.name')
      ->where('id', $quotation->created_by)
      ->where('company_id', Auth::user()->company_id)
      ->first();

    $changed_by = DB::table('users')
      ->select('users.name')
      ->where('id', $quotation->changed_by)
      ->where('company_id', Auth::user()->company_id)
      ->first();
    //get customer
    $customer_data = customer_master::all();
    foreach ($customer_data as $customer) {
      $customer_id[$customer->id] = isset($customer->customer_id) ? $customer->customer_id : '';
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

    $quotation_item_data = quotationItem::where('quotation_number', $quotation->quotation_number)->get();
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

    $createdDate = date('Y-m-d', strtotime($quotation->created_on));
    return view('admin.quotation.edit', compact('inquiry_no', 'reasonRejection', 'changed_by', 'salesorg', 'createdDate', 'customerName', 'itemData', 'created_by', 'phase_ids', 'quotation_item_data', 'id', 'material', 'po_item', 'salesregion', 'quotation', 'customer_id', 'material_no', 'pid', 'tid', 'materialgrp', 'cost', 'requestedby', 'quotation_id'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    $quotation_data = Input::all();

    $elementdata = $quotation_data['elementdata'];

    $quotation = $quotation_data['obj'];
    unset($quotation['optradio']);
    $validationmessages = [
        'quotation_description.required' => 'Please enter quotation description',
        'quotation_description.min' => 'Please enter at least 3 characters',
        'quotation_description.max' => 'Please enter no more than 250 characters',
        'customer.required' => "Please select customer",
        'sales_organization.required' => 'Please select sales organization',
        'sales_region.required' => "Please select sales region",
        'quotation_type.required' => "Please select quotation type",
    ];

    $validator = Validator::make($quotation, [
          'quotation_description' => "required|min:3|max:250",
          'customer' => "required",
          'sales_organization' => "required",
          'sales_region' => "required",
          'quotation_type' => "required",
        ], $validationmessages);
    if ($validator->fails()) {
      $msgs = $validator->messages();
      return response()->json($msgs);
    }
    if (isset($elementdata)) {
      foreach ($elementdata as $index => $row) {
        $row['quotation_number'] = $quotation['quotation_number'];
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
            'contact_person_name.regex' => 'Please enter contact name in character in ' . ($index + 1) . ' record',
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
              'contact_person_name' => "regex:/^[A-Za-z.\s-_]+$/"
            ], $validationmsgitem);
        if ($validator->fails()) {
          $msgs = $validator->messages();
          return response()->json($msgs);
        }
        $row['company_id'] = Auth::user()->company_id;
        $row['changed_by'] = Auth::User()->id;
        $row['changed_on'] = date("Y-m-d");
        $matchThese = array('quotation_number' => $quotation['quotation_number'], 'item_no' => $row['item_no']);
        quotationItem::updateOrCreate($matchThese, $row);
      }
    }
    unset($quotation['_token']);
    unset($quotation['_method']);
    $quotation['changed_by'] = Auth::User()->id;
    $quotation['changed_on'] = date("Y-m-d");
    quotation::where('id', $id)
      ->update($quotation);
    session()->flash('flash_message', 'Quotation updated successfully...');
    return response()->json(array('redirect_url' => 'admin/quotation'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    $quotation_id = quotation::find($id);
    $quotation_no = $quotation_id->quotation_number;
    $item_inquiryno = '';
    $item_data = DB::table('quotation_item')
      ->select('quotation_item.quotation_number')
      ->where('quotation_number', $quotation_no)
      ->where('company_id', Auth::user()->company_id)
      ->get();
    foreach ($item_data as $value) {
      $item_inquiryno = $value->quotation_number;
    }
    if ($quotation_no == $item_inquiryno) {
      session()->flash('flash_message', 'Quotation cannot be deleted , there is a items in this quotation...');
      return redirect('admin/quotation');
    } else {
      $quotation_id->delete();
      session()->flash('flash_message', 'Quatition deleted successfully...');
      return redirect('admin/quotation');
    }
  }

  public function create_ref_inquiry() {
    //get maximum quotation number
    $max_quotationnumber = DB::table('quotation')->MAX('quotation_number');
    $quotation_number = '';
    $range = quotationNumber::all();
    $start_range = array();
    foreach ($range as $value) {
      $start_range = $value->start_range;
    }
    if ($max_quotationnumber == null || $max_quotationnumber == 0) {
      $quotation_number = $start_range;
    } else {
      $quotation_number = $max_quotationnumber + 1;
    }
    //get inquiry number 
    $inquiry_number = DB::table('customer_inquiry')
      ->get();
    $inquiry = array();
    foreach ($inquiry_number as $inquiryid) {

      $inquiry[$inquiryid->inquiry_number] = $inquiryid->inquiry_number . ' ( ' . $inquiryid->inquiry_description . ' )';
    }
    return view('admin.quotation.create_ref_form', compact('quotation_number', 'inquiry'));
  }

  public function insert_inquiry_to_quotation(Request $request) {
    $inquiry_number = $request['inquiry'];

    $created_on = date('Y-m-d');

    //get login details
    $user = Auth::user();
    if (Auth::check()) {
      $username = $user->id;
    }

    $inquiry_data = DB::table('customer_inquiry')
      ->select('customer_inquiry.*')
      ->where('inquiry_number', $inquiry_number)
      ->first();

    $inquiry_item = DB::table('customer_inquiry_item')
      ->select('customer_inquiry_item.*')
      ->where('inquiry_number', $inquiry_number)
      ->get();
    foreach ($inquiry_item as $value) {
      DB::table('quotation_item')
        ->insert(array('quotation_number' => $request['quotation_number'], 'status' => $value->status, 'project_id' => $value->project_id, 'cost_center' => $value->cost_center, 'item_no' => $value->item_no, 'tota_amt' => $value->tota_amt, 'material' => $value->material, 'customer_material_no' => $value->customer_material_no, 'material_description' => $value->material_description, 'cost_unit' => $value->cost_unit, 'order_qty' => $value->order_qty, 'task' => $value->task, 'material_group' => $value->material_group, 'reason' => $value->reason, 'phaseid' => $value->phaseid, 'company_name' => $value->company_name, 'contact_person_name' => $value->contact_person_name, 'phone_no' => $value->phone_no, 'short_description' => $value->short_description, 'company_id' => 0, 'processing_status' => $value->processing_status, 'gross_price' => $value->gross_price, 'discount' => $value->discount, 'discount_amt' => $value->discount_amt, 'discount_gross_price' => $value->discount_gross_price, 'sales_tax' => $value->sales_tax, 'sales_taxamt' => $value->sales_taxamt, 'net_price' => $value->net_price, 'freight_charges' => $value->freight_charges, 'total_price' => $value->total_price, 'created_on' => $created_on, 'created_by' => $username));
    }

    DB::table('quotation')
      ->insert(array('quotation_number' => $request['quotation_number'], 'quotation_type' => $request['quotation_type'], 'customer' => $inquiry_data->customer, 'inquiry' => $inquiry_data->inquiry_number, 'sales_order' => $inquiry_data->sales_order, 'sales_region' => $inquiry_data->sales_region, 'requested_by' => $inquiry_data->requested_by, 'quotation_description' => $inquiry_data->inquiry_description, 'customer_name' => $inquiry_data->customer_name, 'sales_organization' => $inquiry_data->sales_organization, 'quotation_gross_price' => $inquiry_data->inquiry_gross_price, 'quotation_discount' => $inquiry_data->inquiry_discount, 'quotation_discount_amt' => $inquiry_data->inquiry_discount_amt, 'quotation_discount_gross_price' => $inquiry_data->inquiry_discount_gross_price, 'quotation_sales_taxamt' => $inquiry_data->inquiry_sales_taxamt, 'quotation_net_price' => $inquiry_data->inquiry_net_price, 'quotation_freight_charges' => $inquiry_data->inquiry_freight_charges, 'quotation_total_price' => $inquiry_data->inquiry_total_price, 'created_on' => $created_on, 'created_by' => $username, 'company_id' => 0));

    $quotation_no = DB::table('quotation')
      ->select('quotation.quotation_number')
      ->where('inquiry', $inquiry_number)
      ->first();

    DB::table('customer_inquiry')
      ->where('inquiry_number', $inquiry_number)
      ->update(array('quotation' => $quotation_no->quotation_number));

    session()->flash('flash_message', 'Quotation created with ref successfully...');
    return redirect('admin/quotation');
  }

  public function deleteItem($id) {
    $quotation_id = quotationItem::find($id);
    $quotation_id->delete($id);
    session()->flash('flash_message', 'Quotation item deleted successfully...');
    return redirect('admin/quotation');
  }

  public function pdfview(Request $request, $id) {
    $quotation_data = DB::table('quotation')
      ->select('quotation.*', 'employee_records.employee_first_name', 'customer_master.customer_id')
      ->leftJoin('employee_records', 'quotation.requested_by', '=', 'employee_records.employee_id')
      ->leftJoin('customer_master', 'quotation.customer', '=', 'customer_master.id')
      ->where('quotation.quotation_number', $id)
      ->first();
    $quotation_item = DB::table('quotation_item')
      ->select('quotation_item.*')
      ->where('quotation_number', $quotation_data->quotation_number)
      ->get();
    $to = DB::table('customer_master')
      ->select('customer_master.contact_email')
      ->where('id', $quotation_data->customer)
      ->first();
    view()->share('quotation_data', $quotation_data);
    view()->share('quotation_item', $quotation_item);
    if ($request->has('download')) {
      $flag = 1;
      view()->share('flag', $flag);
    }
    if ($request->has('download')) {
      $pdf = PDF::loadView('admin/quotation/quotationpdfview');
      $flag = 1;
      view()->share('flag', $flag);
      return $pdf->download('Quotationpdf.pdf');
    }
    if ($request->has('email')) {
      if ($to->contact_email != '') {
        Mail::to($to->contact_email)->send(new QuotationMail($quotation_data, $quotation_item));
        session()->flash('flash_message', 'Mail is sent to customer successfully..');
        return redirect('admin/quotation');
      } else {
        session()->flash('flash_message', 'Customer contact email address is not correct, Please add valid email address for customer');
        return redirect('admin/quotation');
      }
    }
    return view('admin.quotation.quotationpdfview');
  }

  public function viewpdf($id) {
    $quotation_data = DB::table('quotation')
      ->select('quotation.*', 'employee_records.employee_first_name', 'customer_master.customer_id')
      ->leftJoin('employee_records', 'quotation.requested_by', '=', 'employee_records.employee_id')
      ->leftJoin('customer_master', 'quotation.customer', '=', 'customer_master.id')
      ->where('quotation.quotation_number', $id)
      ->first();
    $quotation_item = DB::table('quotation_item')
      ->select('quotation_item.*')
      ->where('quotation_number', $quotation_data->quotation_number)
      ->get();
    return view('admin.quotation.quotationpdfview', compact('quotation_data', 'quotation_item'));
  }

}
