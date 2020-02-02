<?php

namespace App\Http\Controllers\Admin\Sales;

use App\customerinquiry;
use App\Models\Master\Customer;
use App\Models\Master\Material;
use App\Models\Projects\ProjectCost;
use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesOrderComment;
use App\Models\Sales\SalesOrderItem;
use App\Project;
use App\quotation;
use App\sales_organization;
use App\TasksSubtask;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Cost_centres;
use App\Employee_records;
use App\salesregion;
use App\Projectphase;
use App\Models\Projects\ProjectMilestone;

use Exception;

class OrdersController extends Controller {



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $orders_count = SalesOrder::ByCompany()->searchBy($request);
        $orders = SalesOrder::ByCompany()->searchBy($request)->orderBy('sales_order_id', 'desc')->paginate(20);

        return view('admin.sales.index',[
            'orders' =>  $orders,
            'gross_price' =>  $orders_count->sum('gross_price'),
            'discount_amount' =>  $orders_count->sum('discount_amount'),
            'profit_margin_amount' =>  $orders_count->sum('profit_margin_amount'),
            'tax_amount' =>  $orders_count->sum('tax_amount'),
            'freight_charges' =>  $orders_count->sum('freight_charges'),
            'total_price' =>  $orders_count->sum('total_price'),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {

        $user = Auth::user();
        $max_number =  SalesOrder::max('sales_order_no');
        return view('admin.sales.create',
        [
            'sales_order_no' =>  $this->getRangeNumber($max_number, 'sales', $user->company_id),
            'inquiries' => customerinquiry::ByCompany($user->company_id)->pluck('inquiry_number', 'inquiry_number'),
            'quotations' => quotation::ByCompany($user->company_id)->pluck('quotation_number', 'quotation_number'),
            'regions' => salesregion::pluck('sales_region', 'id'),
            'organizations' =>  sales_organization::ByCompany($user->company_id)->pluck('sales_organization', 'id'),
            'employees' =>  Employee_records::ByCompany($user->company_id)->get()->pluck( 'full_name', 'employee_id'),
            'customers' =>  Customer::ByCompany($user->company_id)->get()->pluck('full_info', 'customer_id')
        ]);

    }


    public function store(Request $request) {
        $validator = Validator::make($request->input(),
            [
                'approver_1' => 'required',
                'customer' => 'required',
                'sales_order_type' => 'required',

            ],
            [
                'approver_1.required'  => 'approver 1 is Required',
                'customer.required'  => 'Customer is Required',
                'sales_order_type.required'  => 'Order Type is Required',
            ]
        );
        if ($validator->passes()) {
            $user = Auth::user();
            try {
                $max_number = SalesOrder::max('sales_order_no');
                $no = $this->getRangeNumber($max_number, 'sales', $user->company_id);
                if(!$no){
                    throw new Exception('Invalid Information!', 400);
                }

                DB::beginTransaction();

                if(empty($request->approver_2)){
                    if(!empty($request->approver_3)){
                        $request->approver_2 = $request->approver_3;
                        $request->approver_3 = null;
                    }else {
                        if(!empty($request->approver_4)){
                            $request->approver_2 = $request->approver_4;
                            $request->approver_4 = null;
                        }
                    }
                }
                if(empty($request->approver_3)){
                    if(!empty($request->approver_4)){
                        $request->approver_3 = $request->approver_4;
                        $request->approver_4 = null;
                    }
                }

                $salesOrder = SalesOrder::create([
                    'company_id'        => $user->company_id,
                    'sales_order_no'    => $no,
                    'customer'          => $request->customer,
                    'sales_order_type'  => $request->sales_order_type,
                    'sales_order_status'      => 'created',

                    'description'       => $request->description,

                    'down_payment'      => ($request->down_payment > 0 ) ? $request->down_payment : 0,
                    'inquiry'           => $request->inquiry,
                    'region'            => $request->region,
                    'quotation'         => $request->quotation,
                    'organization'      => $request->organization,
                    'requested_by'      => $request->requested_by,

                    'approver_1'      => $request->approver_1,
                    'approver_2'      => $request->approver_2,
                    'approver_3'      => $request->approver_3,
                    'approver_4'      => $request->approver_4,

                    'total_recurring_period' => $request->total_recurring_period,
                    'recurring_period'       => $request->recurring_period,
                    'auto_billing'           => ( $request->sales_order_type == 'service' || $request->sales_order_type == 'goods' ) ? $request->auto_billing : 0,
                    'auto_billing_date'      => ( !empty($request->auto_billing_date) ) ? $request->auto_billing_date : Carbon::now()->format('Y-m-d') ,
                ]);

                if ($salesOrder)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Order Successfully Created.',
                        'url' => route('sales-order-items', $salesOrder->sales_order_id)
                    ]);
                }else{
                    throw new Exception('Invalid Order Information!', 400);
                }
            }catch (Exception $ex) {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => $ex->getMessage()
                ]);
            }
        }else{
            $errors = array_values($validator->errors()->getMessages());
            $message = null;
            foreach ($errors as $error){
                if(!empty($error)){
                    foreach ($error as $errorItem){
                          $message .=  $errorItem .' ';
                    }
                }
            }
            return response()->json([
                'status' => 'validation',
                'message' => ($message != null) ? $message :'Invalid Order Information!'
            ]);
        }

    }

    public function edit(SalesOrder $order) {

        $user = Auth::user();
        if(empty($order) || $order->company_id !=$user->company_id){
           return redirect()->back();
        }
        if($order->sales_order_status != 'created'){
            return redirect()->back();
        }
        return view('admin.sales.edit',[
            'order' =>  $order,
            'inquiries' => customerinquiry::ByCompany($user->company_id)->pluck('inquiry_number', 'inquiry_number'),
            'quotations' => quotation::ByCompany($user->company_id)->pluck('quotation_number', 'quotation_number'),
            'regions' => salesregion::pluck('sales_region', 'id'),
            'organizations' =>  sales_organization::ByCompany($user->company_id)->pluck('sales_organization', 'id'),
            'employees' =>  Employee_records::ByCompany($user->company_id)->get()->pluck( 'full_name', 'employee_id'),
            'customers' =>  Customer::ByCompany($user->company_id)->get()->pluck('full_info', 'customer_id')
        ]);

    }



    public function update(SalesOrder $order, Request $request) {
        $validator = Validator::make($request->input(),
            [
                'approver_1' => 'required',
                'customer' => 'required'

            ],
            [
                'approver_1.required'  => 'approver 1 is Required',
                'customer.required'  => 'Customer is Required'
            ]
        );
        if ($validator->passes()) {
            try {

                if(empty($order) || $order->company_id != Auth::user()->company_id){
                    throw new Exception('Invalid Order Information!', 400);
                }

                if($order->sales_order_status != 'created'){
                    throw new Exception('Invalid Order Information!', 400);
                }

                DB::beginTransaction();
                if(empty($request->approver_2)){
                    if(!empty($request->approver_3)){
                        $request->approver_2 = $request->approver_3;
                        $request->approver_3 = null;
                    }else {
                        if(!empty($request->approver_4)){
                            $request->approver_2 = $request->approver_4;
                            $request->approver_4 = null;
                        }
                    }
                }
                if(empty($request->approver_3)){
                    if(!empty($request->approver_4)){
                        $request->approver_3 = $request->approver_4;
                        $request->approver_4 = null;
                    }
                }


                if(!empty($request->sales_order_type)){
                    $order->sales_order_type =  $request->sales_order_type;
                }

                $order->customer =  $request->customer;
                $order->description =  $request->description;
                $order->inquiry =  $request->inquiry;
                $order->region =  $request->region;
                $order->requested_by =  $request->requested_by;
                $order->quotation =  $request->quotation;
                $order->organization =  $request->organization;
                $order->down_payment =  $request->down_payment;

                $order->approver_1 =  $request->approver_1;
                $order->approver_2 =  $request->approver_2;
                $order->approver_3 =  $request->approver_3;
                $order->approver_4 =  $request->approver_4;

                $order->total_recurring_period =  $request->total_recurring_period;
                $order->recurring_period =  $request->recurring_period;
                $order->auto_billing =  $request->auto_billing;
                $order->auto_billing_date =  $request->auto_billing_date;

                $order->save();

                if ($order)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Order Successfully Update.',
                        'url' => route('sales-order-items', $order->sales_order_id)
                    ]);
                }else{
                    throw new Exception('Invalid Order Information!', 400);
                }
            }catch (Exception $ex) {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => $ex->getMessage()
                ]);
            }
        }else{
            $errors = array_values($validator->errors()->getMessages());
            $message = null;
            foreach ($errors as $error){
                if(!empty($error)){
                    foreach ($error as $errorItem){
                        $message .=  $errorItem .' ';
                    }
                }
            }
            return response()->json([
                'status' => 'validation',
                'message' => ($message != null) ? $message :'Invalid Order Information!'
            ]);
        }
    }


    public function order_submit(SalesOrder $order) {
        $user = Auth::user();
        try {
            if(empty($order) || $order->company_id !=$user->company_id){
                throw new Exception('Invalid Order Information!', 400);
            }
            if($order->sales_order_status != 'created'){
                throw new Exception('Invalid Order Information!', 400);
            }
            $order->sales_order_status = 'pending';
            $order->save();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Order Successfully Submitted.',
                'url' => route('sales-order-items', $order->sales_order_id)
            ]);

        }catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }


    public function order_approve(SalesOrder $order, Request $request) {
        $user = Auth::user();
        try {
            if(empty($order) || $order->company_id !=$user->company_id){
                throw new Exception('Invalid Order Information!', 400);
            }
            if($order->sales_order_status != 'pending'){
                throw new Exception('Invalid Order Information!', 400);
            }
            $order->approve_status = $request->approve_status;
            $nextApproveNumber =  $request->approve_status + 1;
            $nextApproveNumber = "approver_{$nextApproveNumber}";
            $nextApproveNumber = $order->$nextApproveNumber;

            if($nextApproveNumber > 0){
                $order->save();
            }else{
                $order->sales_order_status = 'approved';
                $order->save();
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Order Successfully Approved.',
                'url' => route('sales-order-items', $order->sales_order_id)
            ]);

        }catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function order_reject(SalesOrder $order, Request $request) {
        $user = Auth::user();
        try {
            if(empty($order) || $order->company_id !=$user->company_id){
                throw new Exception('Invalid Order Information!', 400);
            }
            if($order->sales_order_status != 'pending'){
                throw new Exception('Invalid Order Information!', 400);
            }
            $order->sales_order_status = 'created';
            $order->save();
            
            SalesOrderComment::create([
                'company_id' => $user->company_id,
                'user_id' => $user->id,
                'type' => 'order',
                'sales_order_id' => $order->sales_order_id,
                'user_type' => 'approve',
                'description' => $request->comment,
            ]);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Order Successfully Rejected.',
                'url' => route('sales-order-items', $order->sales_order_id)
            ]);

        }catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }



    // ------------  Order Items --------------

    public function order_items(SalesOrder $order, Request $request ) {
        $updateItem = [];
        $updateTasks = [];
        $updatePhases = [];
        if(!empty($request->update_item)){
            $updateItem = SalesOrderItem::ByCompany()->find($request->update_item);
            $project = Project::ByCompany()->find($updateItem->project_id);
            $updateTasks = TasksSubtask::where('project_id', $project->project_Id)->pluck('task_name', 'id');
            $updatePhases = Projectphase::where('project_id', $project->id)->pluck('phase_name', 'id');
        }

        $user = Auth::user();
        return view('admin.sales.entry_items',
        [
          'order' => $order,
          'orderItems' =>  $order->items,

          'updateItem' => $updateItem,
          'updateTasks' => $updateTasks,
          'updatePhases' => $updatePhases,

          'comments' => SalesOrderComment::ByCompany($user->company_id)->where('type', 'order')->where('sales_order_id', $order->sales_order_id)->orderBy('created_at', 'desc')->take(5)->get(),
          'costs_type' => Cost_centres::ByCompany($user->company_id)->pluck( 'cost_centre', 'cost_id'),
          'projects' => Project::ByCompany($user->company_id)->get()->pluck( 'full_info', 'id'),
          'materials' => Material::ByCompany($user->company_id)->Active($user->company_id)->get()->pluck( 'full_info', 'material_id' )
        ]);
    }


    public function save_order_items(SalesOrder $order, Request $request) {
        $validator = Validator::make($request->input(),
            [
                
                'tax' => 'required',
                'project_id'    => 'required',
                'cost_center_id'      => 'required',

            ],
            [

                'tax.required'  => 'Tax  is Required',
                'project_id.required'  => 'Project  is Required',
                'cost_center_id.required'    => 'Cost Center is Required',
            ]
        );
        if ($validator->passes()) {
            $user = Auth::user();
            try {
                if(empty($order) || $order->company_id !=$user->company_id){
                    throw new Exception('Invalid Order Information!', 400);
                }
                if($order->sales_order_status != 'created'){
                    throw new Exception('Invalid Information!', 400);
                }
                    DB::beginTransaction();
                    $material = [];
                    if($order->sales_order_type == 'milestone'){
                        $milestones = ProjectMilestone::isActive()->isBillable()
                            ->where('project_id', $request->project_id)
                            ->where('billing_status', 0)
                            ->where('billing_plan', '>', 0)
                            ->count();
                        if(!$milestones){
                            throw new Exception("Project Doesn't have any Milestone!", 400);
                        }

                        $already = SalesOrderItem::byCompany($user->company_id)->where('sales_order_id', $order->sales_order_id)->where('project_id', $request->project_id)->count();
                        if($already){
                            throw new Exception("Project already Added!", 400);
                        }
                    }

                    if($order->sales_order_type == 'goods'){
                        $gross_price = $request->unit_price * $request->material_quantity;
                        $material = Material::find($request->material);
                    }else{
                        $gross_price = $request->gross_price;
                    }

                    if($gross_price > 0){

                        $totalAmount = $gross_price;
                        $discount_amount = 0.00;
                        if(isset($request->discount) && $request->discount > 0){
                            $discount_amount = $gross_price * $request->discount / 100;
                            $totalAmount -= $discount_amount;
                        }

                        $profit_margin_amount = 0.00;
                        if(isset($request->profit_margin) && $request->profit_margin > 0){
                            $profit_margin_amount = $gross_price * $request->profit_margin / 100;
                            $totalAmount += $profit_margin_amount;
                        }

                        $tax_amount = 0.00;
                        if(isset($request->tax) && $request->tax > 0){
                            $tax_amount = $gross_price * $request->tax / 100;
                            $totalAmount += $tax_amount;
                        }

                        $freight_charges = 0.00;
                        if(isset($request->freight_charges) && $request->freight_charges > 0){
                            $freight_charges = $request->freight_charges;
                            $totalAmount += $request->freight_charges;
                        }

                        if(!empty($request->sales_order_item_id)){

                            $salesOrderItem = SalesOrderItem::find($request->sales_order_item_id);
                            if(!empty($salesOrderItem)){

                                $order->gross_price      -= $salesOrderItem->gross_price;
                                $order->discount_amount  -= $salesOrderItem->discount_amount;
                                $order->tax_amount       -= $salesOrderItem->tax_amount;
                                $order->profit_margin_amount  -= $salesOrderItem->profit_margin_amount;
                                $order->freight_charges  -= $salesOrderItem->freight_charges;
                                $order->total_price      -= $salesOrderItem->total_price;

                                $salesOrderItem->update([

                                    'project_id' => $request->project_id,
                                    'task_id' => $request->task_id,
                                    'phase_id' => $request->phase_id,
                                    'cost_center_id' => $request->cost_center_id,

                                    'material' => (!empty($material)) ?  $material->material_id : null,
                                    'material_no' => (!empty($material)) ?  $material->material_no : null,

                                    'material_quantity' => (!empty($material)) ?  $request->material_quantity : null,

                                    'unit_price' => (!empty($material)) ? $request->unit_price : $request->gross_price ,
                                    'gross_price' => $gross_price,

                                    'discount' => isset( $request->discount) ?  $request->discount : 0.00,
                                    'discount_amount' => $discount_amount,

                                    'profit_margin' => isset( $request->profit_margin) ?  $request->profit_margin : 0.00,
                                    'profit_margin_amount' => $profit_margin_amount,

                                    'tax' => isset( $request->tax) ?  $request->tax : 0.00,
                                    'tax_amount' => $tax_amount,

                                    'freight_charges' => $freight_charges,
                                    'total_price' => $totalAmount,

                                    'company_name' => $request->company_name,
                                    'description' => $request->description,

                                ]);
                                if ($salesOrderItem)
                                {
                                    DB::commit();
                                    $order->gross_price  += $gross_price;
                                    $order->discount_amount  += $discount_amount;
                                    $order->tax_amount  += $tax_amount;
                                    $order->profit_margin_amount  += $profit_margin_amount;
                                    $order->freight_charges  += $freight_charges;
                                    $order->total_price  += $totalAmount;
                                    $order->save();

                                    return response()->json([
                                        'status' => 'success',
                                        'message' => 'Item Successfully Update.',
                                        'url' => route( 'sales-order-items', $order->sales_order_id )
                                    ]);
                                }else{
                                    throw new Exception('Invalid Order Item Information!', 400);
                                }
                                }

                    }else{

                        $max_number = SalesOrderItem::max('sales_order_item_no');
                        $no = $this->getRangeNumber($max_number, 'salesOrderItem', $user->company_id);
                        if(!$no){
                            throw new Exception('Invalid Information!', 400);
                        }

                        $salesOrderItem = SalesOrderItem::create([
                            'company_id' => $user->company_id,
                            'sales_order_id' => $order->sales_order_id,
                            'sales_order_item_no' => $no,

                            'project_id' => $request->project_id,
                            'task_id' => $request->task_id,
                            'phase_id' => $request->phase_id,
                            'cost_center_id' => $request->cost_center_id,

                            'material' => (!empty($material)) ?  $material->material_id : null,
                            'material_no' => (!empty($material)) ?  $material->material_no : null,

                            'material_quantity' => (!empty($material)) ?  $request->material_quantity : null,
                            'unit_price' => (!empty($material)) ? $request->unit_price : $request->gross_price ,

                            'gross_price' => $gross_price,

                            'discount' => isset( $request->discount ) ?  $request->discount : 0.00,
                            'discount_amount' => $discount_amount,

                            'profit_margin' => isset( $request->profit_margin) ?  $request->profit_margin : 0.00,
                            'profit_margin_amount' => $profit_margin_amount,

                            'tax' => isset( $request->tax) ?  $request->tax : 0.00,
                            'tax_amount' => $tax_amount,

                            'freight_charges' => $freight_charges,
                            'total_price' => $totalAmount,

                            'company_name' => $request->company_name,
                            'company_contact_phone' => $request->company_contact_phone,
                            'company_contact_person' => $request->company_contact_person,
                            'delivery_date' => $request->delivery_date,
                            'description' => $request->description,
                            'sales_order_type' => $order->sales_order_type
                        ]);

                        if ($salesOrderItem)
                        {

                            $order->gross_price  += $gross_price;
                            $order->discount_amount  += $discount_amount;
                            $order->tax_amount  += $tax_amount;
                            $order->profit_margin_amount  += $profit_margin_amount;
                            $order->freight_charges  += $freight_charges;
                            $order->total_price  += $totalAmount;
                            $order->save();

                            DB::commit();
                            return response()->json([
                                'status' => 'success',
                                'message' => 'Item Successfully Added.',
                                'url' => route( 'sales-order-items' , $order->sales_order_id )
                            ]);
                        }else{
                            throw new Exception('Invalid Order Item Information!', 400);
                        }
                    }
                }else {
                   throw new Exception('Invalid Order Item Information!', 400);

                }
            }catch (Exception $ex) {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => $ex->getMessage()
                ]);
            }
        }else{
            $errors = array_values($validator->errors()->getMessages());
            $message = null;
            foreach ($errors as $error){
                if(!empty($error)){
                    foreach ($error as $errorItem){
                        $message .=  $errorItem .' ';
                    }
                }
            }
            return response()->json([
                'status' => 'validation',
                'message' => ($message != null) ? $message :'Invalid Information!'
            ]);
        }
    }


    public function order_items_delivery(SalesOrderItem $orderItem, Request $request) {
        $user = Auth::user();
        try {
            if(empty($orderItem) || $orderItem->company_id !=$user->company_id){
                throw new Exception('Invalid Order Information!', 400);
            }
            


            if($orderItem->order->sales_order_status != 'approved' || $orderItem->sales_order_status != 'created'){
                throw new Exception('Invalid Order Information!', 400);
            }

            $orderItem->delivery_info =$request->delivery_info;
            $orderItem->sales_order_status = 'delivery';
            $orderItem->save();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Delivery Information update Successfully.',
                'url' => route('sales-order-items', $orderItem->sales_order_id)
            ]);

        }catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function order_items_delete(SalesOrderItem $orderItem) {
        $user = Auth::user();
        try {
            if(empty($orderItem) || $orderItem->company_id !=$user->company_id){
                throw new Exception('Invalid Order Information!', 400);
            }

            if($orderItem->sales_order_status != 'created'){
                throw new Exception('Invalid Order Information!', 400);
            }

            $order = SalesOrder::ByCompany($user->company_id)->find($orderItem->sales_order_id);
            if(!empty($order)){
                $order->gross_price      -= $orderItem->gross_price;
                $order->discount_amount  -= $orderItem->discount_amount;
                $order->tax_amount       -= $orderItem->tax_amount;
                $order->profit_margin_amount  -= $orderItem->profit_margin_amount;
                $order->freight_charges  -= $orderItem->freight_charges;
                $order->total_price      -= $orderItem->total_price;
                $order->save();
            }
            $orderItem->delete();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Item Successfully Deleted.',
                'url' => route('sales-order-items', $orderItem->sales_order_id)
            ]);

        }catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }



    public function get_order_items_billing(Request $request) {

        $validator = Validator::make($request->input(),
            [
                'sales_order_id' => 'required',
            ],
            [
                'sales_order_id.required'  => 'Sales Order is Required',
            ]
        );
        if ($validator->passes()) {

            $order =  SalesOrder::find($request->sales_order_id);
            if($order->sales_order_type == 'goods' && $order->sales_order_type == 'service' ){
                $SalesOrderItem = SalesOrderItem::where('sales_order_id', $request->sales_order_id)->ByCompany()->isDelivered()->get();
            }else{
                $SalesOrderItem = SalesOrderItem::where('sales_order_id', $request->sales_order_id)->ByCompany()->get();
            }

            if( !empty( $SalesOrderItem->count() )){
                foreach ($SalesOrderItem as $key => $item){
                    if($item->sales_order_type == 'goods'){
                        $SalesOrderItem[$key]->description = 'Material No. '. $item->material_no .'  <br>  ' . 'Quantity '.$item->material_quantity ;
                    }
                    if($item->sales_order_type == 'service'){
                        $SalesOrderItem[$key]->description = 'Project No. '. $item->salesProject->project_Id;
                    }
                    if($item->sales_order_type == 'milestone'){
                        $SalesOrderItem[$key]->description = 'Project No. '. $item->salesProject->project_Id.'  <br>  ';
                        $milestones = ProjectMilestone::isActive()->isBillable()
                            ->where('project_id', $SalesOrderItem[$key]->project_id )
                            ->where('billing_status', 0)
                            ->where('billing_plan', '>', 0)
                            ->get();

                        $milestones_percent =0;
                        $milestones_info = '';
                        foreach ($milestones as $milestone){
                            if($milestone->billing_plan > 0){
                                $milestones_percent += $milestone->billing_plan;
                                $milestones_info .=  $milestone->milestone_name .' - '. $milestone->milestone_Id .' ( '. $milestone->billing_plan .' %)  <br>  ';
                            }
                        }

                        $SalesOrderItem[$key]->description .= ($milestones_info == '') ? 'No Milestone Found!' : $milestones_info;

                        if($milestones_percent > 0 && $milestones_percent <= 100){
                          $total_price =  $SalesOrderItem[$key]->total_price;
                          $total_price =  $total_price * $milestones_percent / 100;
                          $SalesOrderItem[$key]->total_price = $total_price;
                          $SalesOrderItem[$key]->gross_price = $SalesOrderItem[$key]->total_price;
                        }else {
                            $SalesOrderItem[$key]->total_price = 0;
                            $SalesOrderItem[$key]->gross_price = 0;
                        }
                    }
                    if($item->sales_order_type == 'timesheet'){
                        $projectsCost = ProjectCost::where( 'project_id', $SalesOrderItem[$key]->project_id )
                            ->where( 'task_id', $SalesOrderItem[$key]->task_id )
                            ->where( 'billing_status', 0 )
                            ->get();
                        $SalesOrderItem[$key]->description = 'Project No. '. $item->salesProject->project_Id.'  <br>  ';
                        $total_cost =0;
                        $info = '';
                        foreach ($projectsCost as $cost){
                            if($cost->total_cost > 0){
                                $total_cost += $cost->total_cost;
                                $info .= 'Activity Type: '. $cost->activityType->activity_type . ' <br>  ';
                                $info .= 'Cost Element: '. $cost->activityType->cost_element . ' <br>  ';
                            }
                        }
                        $SalesOrderItem[$key]->description .= ($info == '') ? 'No Timesheet cost Found!' : $info;
                        if( $total_cost > 0 ){
                            $SalesOrderItem[$key]->gross_price = $total_cost;
                            $discount_amount_item =  $SalesOrderItem[$key]->discount * $total_cost / 100;
                            $tax_amount_item =  $SalesOrderItem[$key]->tax * $total_cost / 100;
                            $total =  $total_cost + $tax_amount_item - $discount_amount_item;
                            $SalesOrderItem[$key]->total_price = number_format((float)$total, 2, '.', '');
                        }else {
                            $SalesOrderItem[$key]->total_price = 0;
                            $SalesOrderItem[$key]->gross_price = 0;
                        }
                    }
                }
                return response()->json([
                    'status' => 'success',
                    'SalesOrderItem' => $SalesOrderItem
                ]);

            }else{
                return response()->json([
                    'status' => 'validation'
                ]);
            }
        }else{

            return response()->json([
                'status' => 'validation'
            ]);
        }
    }




//    Projects Materials Ajex

    public function get_project_task_phase(Request $request) {
        $validator = Validator::make($request->input(),
            [
                'project_id' => 'required',
            ],
            [
                'project_id.required'  => 'Project  is Required',
            ]
        );
        if ($validator->passes()) {
            $project = Project::ByCompany()->find($request->project_id);
            if(!empty($project)){
                $tasks = TasksSubtask::where('project_id', $project->project_Id)->pluck('task_name', 'id');
                $phase = Projectphase::where('project_id', $project->id)->pluck('phase_name', 'id');
                return response()->json([
                    'status' => 'success',
                    'tasks' => $tasks,
                    'phase' => $phase,
                ]);

            }else{
                return response()->json([
                    'status' => 'validation'
                ]);
            }
        }else{
            return response()->json([
                'status' => 'validation'
            ]);
        }
    }

    public function get_material(Request $request) {

        $validator = Validator::make($request->input(),
            [
                'id' => 'required',
            ],
            [
                'id.required'  => 'Material is Required',
            ]
        );
        if ($validator->passes()) {
            $master = Material::ByCompany()->where('material_id', $request->id)->first();
            if(!empty($master)){
                return response()->json([
                    'status' => 'success',
                    'price' => (isset($master->price) && $master->price > 0 ) ? $master->price : 0
                ]);
            }else{
                return response()->json([
                    'status' => 'validation'
                ]);
            }
        }else{
            return response()->json([
                'status' => 'validation'
            ]);
        }
    }

}
