<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Projectcostplan;
use App\project_material_cost;
use App\project_miscellanous_cost;
use App\project_hardware_cost;
use App\project_software_cost;
use App\project_travel_cost;
use App\project_contingency_cost;
use App\project_facilities_cost;
use App\project_service_cost;
use App\project_internal_cost;
use App\project_external_cost;
use App\Project;
use App\Currency;
use App\Projecttask;
use App\materialmaster;
use App\purchaseorder_item;
use App\purchase_order;
use App\purchase_item;
use App\Activity_types;
use App\Activity_rates;
use App\Createrole;
use App\Roleauth;
use App\vendor;
use App\Personassignment;
use App\TasksSubtask;
use App\RevenueProductSales;
use App\RevenueServiceOffer;

class ProjectrevenueplanController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id = null)
    {
        Roleauth::check('project.costplan.index');

        $projectcostplan = Projectcostplan::all();
        $materialcostplan = project_material_cost::all();


        $projects = array();
        $project_data = Project::all();
        foreach ($project_data as $key => $project) {
            $projects[$project->project_Id] = $project->project_Id . ' ( ' . $project->project_name . ' )';
        }



        $currency = array();
        $currency_data = Currency::all();
        foreach ($currency_data as $key => $curr) {
            $currency[$curr->short_code] = $curr->short_code;
        }

        $tasks = array();
        $task_data = Projecttask::all();
        foreach ($task_data as $key => $task) {
            $tasks[$task->task_Id] = $task->task_Id . ' ( ' . $task->task_name . ' )';
        }

        $material = array();
        $material_data = materialmaster::all();
        foreach ($material_data as $key => $item) {
            $material[$item->material_number] = $item->material_number . ' ( ' . $item->material_name . ' ) ';
        }



        return view('admin.projectrevenueplan.index', compact('id', 'projectcostplan', 'materialcostplan', 'projects', 'currency', 'tasks', 'material'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function get_material_details($number)
    {
        $material_data = materialmaster::where('material_number', $number)->select(['material_description', 'standard_price', 'currency'])->get()->toArray();

        if (count($material_data) > 0) {
            $currency = Currency::find($material_data[0]['currency']);
            $material_data[0]['currency'] = ($currency != null) ? $currency['short_code'] : '';
            return response()->json(['status' => 'ok', 'data' => $material_data[0]]);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function get_activity_rate(Request $request, $activity)
    {
        $activity = $request->only('data');
        $activity_id = Activity_types::where('activity_type', $activity)->select('activity_id')->first();
        $activity_rate = Activity_rates::where('activity_type_id', $activity_id->activity_id)->select('billing_rate')->get()->toArray();
        return response()->json(['status' => 'ok', 'data' => (isset($activity_rate[0]) ? $activity_rate[0] : 'Not Set')]);
    }

    public function get_unit_rate(Request $request, $dummy)
    {
        $requisition = $request->only('data')['data'];
        $total_cost = 0;
        $currency = 0;
        if (isset($requisition['project'])) {
            if ($requisition['purchase_order'] != '' && $requisition['requisition_item'] != '') {
                $project_id = Project::where('project_Id', $requisition['project'])->select('id')->first();

                $purchase_order_item = purchase_item::where(['project_id' => $project_id->id, 'requisition_number' => $requisition['purchase_order'], 'item_no' => $requisition['requisition_item']])->get();
                foreach ($purchase_order_item as $item) {
                    $total_cost += intval($item->item_cost) * intval($item->item_quantity);
                    $currency = $item->currency;
                }
            } else if ($requisition['requisition_item'] == '') {
                $project_id = Project::where('project_Id', $requisition['project'])->select('id')->first();

                $purchase_order_item = purchase_item::where(['project_id' => $project_id->id, 'requisition_number' => $requisition['purchase_order']])->get();
                foreach ($purchase_order_item as $item) {
                    $total_cost += intval($item->item_cost) * intval($item->item_quantity);
                    $currency = $item->currency;
                }
            }
        } else { //internal cost and external cost modules
            if ($requisition['purchase_order'] != '' && $requisition['requisition_item'] != '') {

                $purchase_order_item = purchase_item::where(['requisition_number' => $requisition['purchase_order'], 'item_no' => $requisition['requisition_item']])->get();

                foreach ($purchase_order_item as $item) {

                    $total_cost += intval($item->item_cost) * intval($item->item_quantity);
                    $currency = $item->currency;
                }
            } else if ($requisition['requisition_item'] == '') {
                $purchase_order_item = purchase_item::where(['requisition_number' => $requisition['purchase_order']])->get();
                foreach ($purchase_order_item as $item) {
                    $total_cost += intval($item->item_cost) * intval($item->item_quantity);
                    $currency = $item->currency;
                }
            }
        }


        if ($currency > 0) {
            $currency = Currency::find($currency)->select('short_code')->first()->short_code;
        }

        if ($total_cost > 0) {
            return response()->json(['status' => 'ok', 'data' => ['unit_rate' => $total_cost, 'currency' => $currency]]);
        } else {
            return response()->json(['status' => 'error', 'data' => ['Unit rate not found']]);
        }
    }

    public function get_task_asignee(Request $request, $dummy)
    {
        $requisition = $request->only('data')['data'];
        $project_id = $requisition['project_id'];
        $project = Project::where('project_Id', $project_id)->where('company_id', Auth::user()->company_id)->first();
        $task_Id = $requisition['task'];
        $role = $requisition['role'];
        $task = TasksSubtask::where(['task_Id' => $task_Id, 'company_id' => Auth::user()->company_id])->first();
        $result = Personassignment::where(['task' => $task->id, 'role' => $role])->first();
        if (count($result) > 0) {
            $employee = \App\Employee_records::where('employee_id', $result->resource_name)->first();
            return response()->json(['status' => 'ok', 'data' => ['resource_id' => $result->resource_name, 'resource_name' => $employee->employee_first_name . ' ' . $employee->employee_middle_name . ' ' . $employee->employee_last_name]]);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function get_resource_name(Request $request, $dummy)
    {
        $requisition = $request->only('data')['data'];
        $id = $requisition['resource_id'];
        $result = \App\Employee_records::where('employee_id', $id)->where('company_id', Auth::user()->company_id)->first();

        if (count($result) > 0) {
            return response()->json(['status' => 'ok', 'data' => ['resource_name' => $result->employee_first_name . ' ' . $result->employee_middle_name . ' ' . $result->employee_last_name]]);
        } else {
            return response()->json(['status' => 'error']);
        }
    }

    public function get_po_details($number)
    {
        $purchase_data = \App\purchase_item::where('requisition_number', $number)->select('item_no')->get()->toArray();
        $purchase_item = array('' => '');
        foreach ($purchase_data as $key => $item) {
            $purchase_item[$item['item_no']] = $item['item_no'];
        }
        if (count($purchase_data) > 0)
            return response()->json(['status' => 'ok', 'data' => $purchase_item]);
        else
            return response()->json(['status' => 'error']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($module)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @return \Illuminate\Http\Response
     */
    public function store($module)
    {
        Roleauth::check('project.costplan.create');

        try {
            switch ($module) {
                case 'product-sales':
                    $material_data = Input::except('_token');
                    $material = $material_data['data'];

                    $material['total_price'] = ((int) $material['quantity']) * ((float) $material['unit_price']);

                    $validationmessages = [
                        'project_number.required' => 'Please Select Project Number',
//                        'task.required' => 'Please Select Task Number',
                        //'material_number.required' => 'Please select Matarial Number',
                        'description.required' => 'Please enter Short Description',
                        'quantity.required' => 'Please select Quantity',
                        'unit_price.required' => 'Please select Unit Price',
                        'revenue_type' => 'Please select Type',
                        'currency.required' => 'Please select Currency',
                        'total_price' => 'Please enter the Total Cost'
                    ];


                    $validator = Validator::make($material, [
                                'project_number' => 'required',
//                                'task' => 'required',
//                                'material_number' => 'required',
                                'description' => 'required|max:200',
                                'unit_price' => 'required',
                                'quantity' => 'required',
                                'revenue_type' => 'required',
                                'currency' => 'required',
                                'total_price' => 'required'
                                    ], $validationmessages);

                    if ($validator->fails()) {
                        $msgs = $validator->messages();
                        return response()->json(['status' => 'error', 'error' => $msgs]);
                    }

                    RevenueProductSales::create($material);


                    break;
                case 'service-offering':

                    $internal_data = Input::except('_token');
                    $internal = $internal_data['data'];
                    $total_hours = 0;
                    $filtred = array();

                    foreach ($internal as $key => $value) {
                        if (preg_match('/hours-/', $key)) {
                            $key = str_replace("hours-", "", $key);
                            $filtred[$key] = $value;
                            $total_hours += (int) $value;
                        }
                    }
                
                    $internal['total_price'] = ($total_hours) * ((float) $internal['unit_price']);
                    $internal['hours'] = json_encode($filtred);
                    $validationmessages = [
                        'project_number.required' => 'Please Select Project Number',
//                        'task.required' => 'Please Select Task Number',
//                        'resource_role.required' => 'Please select Matarial Number',
//                        'band.required' => 'Please select Band',
//                        'hours' => 'Please enter Hours',
                        'unit_price' => 'Please enter Unit Rate',
                        'currency.required' => 'Please select Currency',
                        'total_price' => 'Please enter the Total Cost'
                    ];

//                print_r($internal);exit('------');
                    $validator = Validator::make($internal, [
                                'project_number' => 'required',
//                                'task' => 'required',
//                                'resource_role' => 'required',
//                                'band' => 'required',
//                                'hours' => 'required',
                                'unit_price' => 'required',
                                'currency' => 'required',
                                'total_price' => 'required'
                                    ], $validationmessages);

                    if ($validator->fails()) {
                        $msgs = $validator->messages();
                        return response()->json(['status' => 'error', 'error' => $msgs]);
                    }

                    RevenueServiceOffer::create($internal);

                    break;
                    
                default:
                    break;
            }
        } catch (Exception $e) {
            if ($flag != TRUE) {
                //session()->flash('flash_message', $module . ' Error occured while inserting data ...');
                return response()->json(['status' => 'error', 'error' => $e->getMessage()]);
            }
        }
        //session()->flash('flash_message', $module . ' cost added successfully...');
        return response()->json(['status' => 'ok']);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $revenueProductCostData = RevenueProductSales::selectRaw('sum(unit_price * quantity) as total_price,currency')->groupBy('currency')->where('project_number', $id)->get()->toArray();
        $revenueServiceOfferCostData = RevenueServiceOffer::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $id)->get()->toArray();
        
        $Net_Total = (float) (isset($revenueProductCostData[0]['total_price']) ? $revenueProductCostData[0]['total_price'] : 0);
        $Net_Total += (isset($revenueServiceOfferCostData[0]['total_price']) ? $revenueServiceOfferCostData[0]['total_price'] : 0); //internal


        $result = [];
        $result['project_cost'] = [
            ['id' => 1, 'values' => ['code' => 'R-101', 'type' => 'Revenue Product Sales', 'amount' => isset($revenueProductCostData[0]['total_price']) ? $revenueProductCostData[0]['total_price'] : '', 'currency' => isset($revenueProductCostData[0]['currency']) ? $revenueProductCostData[0]['currency'] : '']],
            ['id' => 2, 'values' => ['code' => 'R-102', 'type' => 'Revenue Service Offering', 'amount' => isset($revenueServiceOfferCostData[0]['total_price']) ? $revenueServiceOfferCostData[0]['total_price'] : '', 'currency' => isset($revenueServiceOfferCostData[0]['currency']) ? $revenueServiceOfferCostData[0]['currency'] : '']],
            ['id' => 6, 'values' => ['code' => 'R-000', 'type' => 'Amount', 'amount' => $Net_Total, 'currency' => '']],
        ];

        return response()->json($result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function edit($module, $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function update($module, $id)
    {
        Roleauth::check('project.costplan.edit');

        try {
            switch ($module) {
                case 'product-sales':


                    $material_data = Input::except('_token');
                    $material = $material_data['data'];

                    $material['total_price'] = ((int) $material['quantity']) * ((float) $material['unit_price']);

                    $validationmessages = [
                        'project_number.required' => 'Please Select Project Number',
//                        'material_number.required' => 'Please select Matarial Number',
                        'description.required' => 'Please enter Short Description',
                        'quantity.required' => 'Please select Quantity',
                        'unit_price.required' => 'Please select Unit Price',
                        'revenue_type' => 'Please select Type',
                        'currency.required' => 'Please select Currency',
                        'total_price' => 'Please enter the Total Cost'
                    ];


                    $validator = Validator::make($material, [
                                'project_number' => 'required',
//                                'task' => 'required',
//                                'material_number' => 'required',
                                'description' => 'required|max:200',
                                'unit_price' => 'required',
                                'quantity' => 'required',
                                'revenue_type' => 'required',
                                'currency' => 'required',
                                'total_price' => 'required'
                                    ], $validationmessages);

                    if ($validator->fails()) {
                        $msgs = $validator->messages();
                        return response()->json(['status' => 'error', 'error' => $msgs]);
                    }

                    unset($material['id']);

                    RevenueProductSales::find($id)->update($material);

                    break;

                case 'service-offering':

                    $serviceOfferData = Input::except('_token');
                    $serviceOffer = $serviceOfferData['data'];
                    $total_hours = 0;
                    $filtred = array();

                    foreach ($serviceOffer as $key => $value) {
                        if (preg_match('/hours-/', $key)) {
                            $key = str_replace("hours-", "", $key);
                            $filtred[$key] = $value;
                            $total_hours += (int) $value;
                        }
                    }
                    $serviceOffer['total_hours'] = $total_hours;
                    $serviceOffer['total_price'] = ($total_hours) * ((float) $serviceOffer['unit_price']);
                    $serviceOffer['hours'] = json_encode($filtred);
                 
                    $validationmessages = [
                        'project_number.required' => 'Please Select Project Number',
//                        'task.required' => 'Please Select Task Number',
//                        'resource_role.required' => 'Please select Matarial Number',
                        'activity_type.required' => 'Please select Band',
                        'hours' => 'Please enter Hours',
                        'unit_price' => 'Please enter Unit Rate',
                        'currency.required' => 'Please select Currency',
                        'total_price' => 'Please enter the Total Cost'
                    ];


                    $validator = Validator::make($serviceOffer, [
                                'project_number' => 'required',
//                                'task' => 'required',
//                                'resource_role' => 'required',
                                'activity_type' => 'required',
                                'hours' => 'required',
                                'unit_price' => 'required',
                                'currency' => 'required',
                                'total_price' => 'required'
                                    ], $validationmessages);

                    if ($validator->fails()) {
                        $msgs = $validator->messages();
                        return response()->json(['status' => 'error', 'error' => $msgs]);
                    }
                    RevenueServiceOffer::find($id)->update($serviceOffer);

                    break;
                    
                default:
                    break;
            }
        } catch (Exception $e) {
            if ($flag != TRUE) {
                //session()->flash('flash_message', $module . ' Error occured while inserting data ...');
                return response()->json(['status' => 'error', 'error' => $e->getMessage()]);
            }
        }
        //session()->flash('flash_message', $module . ' cost added successfully...');
        return response()->json(['status' => 'ok']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function destroy($module, $id)
    {
        Roleauth::check('project.costplan.delete');

        try {
            switch ($module) {
                case 'product-sales':
                    $projectrevenueplan = RevenueProductSales::find($id);
                    $projectrevenueplan->delete();

                    break;
                case 'service-offering':
                    $projectrevenueplan = RevenueServiceOffer::find($id);
                    $projectrevenueplan->delete();

                    break;
                
                default:
                    break;
            }
        } catch (Exception $e) {
            if ($flag != TRUE) {
                session()->flash('flash_message', $module . ' Error occured while deleting data ...');
                return response()->json(['status' => 'error', 'error' => $e->getMessage()]);
            }
        }


        session()->flash('flash_message', $module . 'cost deleted successfully...');
        return response()->json(['status' => $module . 'cost deleted successfully...']);
    }

    public function getModule($module, $id)
    {
        $projects = array();
        $project_id = Project::where('project_Id', $id)->select('id', 'currency')->first();
        $project_data = Project::all();
        foreach ($project_data as $key => $project) {
            $projects[$project->project_Id] = $project->project_Id . ' ( ' . $project->project_name . ' )';
        }


        $resource = \App\Employee_records::select(DB::raw("CONCAT(employee_first_name,' ',employee_middle_name,' ',employee_last_name) as employee , employee_id "))
                        ->pluck('employee', 'employee_id')->prepend('', '');

//        $currency = $project_id->currency;
//        $currency = Currency::where('id',$currency)->select('short_code')->first();
//        $currency = isset($currency->short_code)?$currency->short_code:'NA';
       
//        if($module == 'product-sales'){
        $currency_data = Currency::all();
        foreach ($currency_data as $key => $curr) {
            $currency[$curr->short_code] = $curr->short_code;
        }
//        }
//        else{
//        $currency = $project_id->currency;
//        $currency = Currency::where('id',$currency)->select('short_code')->first();
//        $currency = isset($currency->short_code)?$currency->short_code:'NA';
//        }

        $tasks = array();
        $task_data = Projecttask::where('project_id', $id)->get();
        foreach ($task_data as $key => $task) {
            $tasks[$task->task_Id] = $task->task_Id . ' ( ' . $task->task_name . ' )';
        }

        $material = array();
        $material_data = materialmaster::all();
        foreach ($material_data as $key => $item) {
            $material[$item->material_number] = $item->material_number . ' ( ' . $item->material_name . ' ) ';
        }

        $activity = array();
        $activity_data = Activity_types::all();
        foreach ($activity_data as $key => $item) {
            $activity[$item->activity_type] = $item->activity_type;
        }

        $purchase_order = array('' => '');
        $purchase_item = array('' => '');

        $purchase_item_data = \App\purchase_requisition::where('company_id', Auth::user()->company_id)
                ->groupby('requisition_number')
                ->select('requisition_number')
                ->get()
                ->toArray();

        foreach ($purchase_item_data as $key => $item) {
            if ($item['requisition_number'] != null || $item['requisition_number'] != "")
                $purchase_order[$item['requisition_number']] = $item['requisition_number'];

            foreach (\App\purchase_item::where(['project_id' => $project_id->id, 'requisition_number' => $item['requisition_number']])
                    ->select('item_no')
                    ->get()
                    ->toArray() as $key => $value) {
                $purchase_item[$item['requisition_number']][$value['item_no']] = $value['item_no'];
            }
        }

        switch ($module) {
            case 'service-offering':

//                $materialCostData = RevenueServiceOffer::where('project_number', $id)->get()->toArray();
//                $roles = Createrole::where('project_id', $project_id->id)->where('company_id', Auth::user()->company_id)->pluck('role_name', 'id');
//                $employe_id = \App\Employee_records::select('employee_id')->pluck('employee_id', 'employee_id');
//                $result = [];
//                foreach ($materialCostData as $key => $value) {
//                    array_push($result, ['id' => $value['id'], 'values' => array_diff_key($value, array_flip(["id"]))]);
//                }
//                array_push($result, ['id' => 'total_cost', 'values' => ['unit_price' => 'Total Cost', 'total_price' => project_material_cost::where('project_number', $project_id->id)->sum('total_price'), 'action' => 'blank']]);
//                return view('admin.projectrevenueplan.module', compact('roles', 'employe_id', 'resource', 'activity','purchase_item_data', 'purchase_order', 'purchase_item', 'id', 'result', 'module', 'projects', 'currency', 'tasks', 'material', 'purchase_order'));
//
//                break;
                
                $revenueServiceOfferCostData = RevenueServiceOffer::where('project_number', $id)->get()->toArray();
                $project_id = Project::where('project_Id', $id)->select('id')->first();
                $employe_id = \App\Employee_records::select('employee_id')->pluck('employee_id', 'employee_id');
                $roles = Createrole::where('project_id', $project_id->id)->where('company_id', Auth::user()->company_id)->pluck('role_name', 'id');
                $result = [];
                foreach ($revenueServiceOfferCostData as $key => $value) {
                    $total_hours = 0;
                    $months = json_decode($value['hours'], true);
                    foreach ($months as $key => $val) {
                        $value['hours-' . $key] = $val;
                        $total_hours +=$val;
                    }
                    $value['total_hours'] = $total_hours;
                    array_push($result, ['id' => $value['id'], 'values' => array_diff_key($value, array_flip(["id"]))]);
                }
                array_push($result, ['id' => 'total_cost', 'values' => ['unit_rate' => 'Total Cost', 'total_price' => RevenueServiceOffer::where('project_number', $id)->sum('total_price'), 'action' => 'blank']]);
                return view('admin.projectrevenueplan.module', compact('roles', 'activity', 'resource', 'employe_id', 'purchase_item_data', 'purchase_order', 'purchase_item', 'id', 'result', 'module', 'projects', 'currency', 'tasks', 'material', 'purchase_order'));

            case 'product-sales':
                $revenueProductSalesCost = RevenueProductSales::where('project_number', $id)->get()->toArray();
                $project_id = Project::where('project_Id', $id)->select('id')->first();
                $employe_id = \App\Employee_records::select('employee_id')->pluck('employee_id', 'employee_id');
                $roles = Createrole::where('project_id', $project_id->id)->where('company_id', Auth::user()->company_id)->pluck('role_name', 'id');
                $result = [];
                foreach ($revenueProductSalesCost as $key => $value) {
//                    $total_hours = 0;
//                    $months = json_decode($value['no_hours'], true);
//                    foreach ($months as $key => $val) {
//                        $value['hours-' . $key] = $val;
//                        $total_hours +=$val;
//                    }
//                    $value['total_hours'] = $total_hours;
                    array_push($result, ['id' => $value['id'], 'values' => array_diff_key($value, array_flip(["id"]))]);
                }
                array_push($result, ['id' => 'total_cost', 'values' => ['unit_rate' => 'Total Cost', 'total_price' => RevenueProductSales::where('project_number', $id)->sum('total_price'), 'action' => 'blank']]);
                return view('admin.projectrevenueplan.module', compact('roles', 'activity', 'resource', 'employe_id', 'purchase_item_data', 'purchase_order', 'purchase_item', 'id', 'result', 'module', 'projects', 'currency', 'tasks', 'material', 'purchase_order'));


                break;
                
            default:
                break;
        }
    }

}
