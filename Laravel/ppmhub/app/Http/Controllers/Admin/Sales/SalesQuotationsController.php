<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Models\Master\Customer;
use App\Models\Master\Material;

use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesOrderComment;
use App\Models\Sales\SalesOrderItem;
use App\Models\Sales\SalesQuotation;
use App\Models\Sales\SalesQuotationItem;
use App\Project;

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

use Exception;
use Illuminate\Support\Facades\App;

class SalesQuotationsController extends Controller {

    public function index(Request $request) {

        $quotation_count = SalesQuotation::ByCompany()->searchBy($request);
        $quotations = SalesQuotation::ByCompany()
            ->searchBy($request)
            ->orderBy('sales_quotation_id', 'desc')
            ->paginate(20);
        
        return view('admin.sales.quotations.index',
        [
            'quotations' =>  $quotations,
            'gross_price' =>  $quotation_count->sum('gross_price'),
            'discount_amount' =>  $quotation_count->sum('discount_amount'),
            'profit_margin_amount' =>  $quotation_count->sum('profit_margin_amount'),
            'tax_amount' =>  $quotation_count->sum('tax_amount'),
            'freight_charges' =>  $quotation_count->sum('freight_charges'),
            'total_price' =>  $quotation_count->sum('total_price')
        ]);
    }

    public function create() {
        $user = Auth::user();
        $max_number =  SalesQuotation::max('sales_quotation_no');
        return view('admin.sales.quotations.create',
        [
            'no' =>  $this->getRangeNumber($max_number, 'quotation', $user->company_id),
            'regions' => salesregion::pluck('sales_region', 'id'),
            'organizations' =>  sales_organization::ByCompany($user->company_id)->pluck('sales_organization', 'id'),
            'employees' =>  Employee_records::ByCompany($user->company_id)->get()->pluck( 'full_name', 'employee_id'),
            'customers' =>  Customer::ByCompany($user->company_id)->get()->pluck('full_info', 'customer_id'),
        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->input(),
            [                
                'customer' => 'required',
                'sales_order_type' => 'required',

            ],
            [
                'customer.required'  => 'Customer is Required',
                'sales_order_type.required'  => 'Order Type is Required',
            ]
        );
        if ($validator->passes()) {
            $user = Auth::user();
            try {

                $max_number =  SalesQuotation::max('sales_quotation_no');
                $no = $this->getRangeNumber($max_number, 'quotation', $user->company_id);
                if(!$no){
                    throw new Exception('Invalid No!', 400);
                }

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


                DB::beginTransaction();
                $quotation = SalesQuotation::create([
                    'company_id'        => $user->company_id,
                    'sales_quotation_no' => $no,

                    'customer'          => $request->customer,
                    'description'       => $request->description,

                    'sales_order_type'  => $request->sales_order_type,
                    'status'=> 'created',

                    'down_payment'      => ($request->down_payment > 0 ) ? $request->down_payment : 0,
                    'region'            => $request->region,
                    'organization'      => $request->organization,
                    'requested_by'      => $request->requested_by,

                    'approver_1' => $request->approver_1,
                    'approver_2' => $request->approver_2,
                    'approver_3' => $request->approver_3,
                    'approver_4' => $request->approver_4,
                ]);

                if ($quotation)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Sales Quotation Successfully Created.',
                        'url' => route('sales-order-quotation-items', $quotation->sales_quotation_id),
                    ]);
                }else{
                    throw new Exception('Invalid Quotation Information!', 400);
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
                'message' => ($message != null) ? $message :'Invalid  Information!'
            ]);
        }
    }


    public function edit(SalesQuotation $quotation) {

        $user = Auth::user();
        if(empty($quotation->sales_quotation_no) || $quotation->company_id != $user->company_id){
           return redirect()->back();
        }
        if($quotation->status == 'success'){
            return redirect()->back();
        }
        return view('admin.sales.quotations.create',
            [
                'regions' => salesregion::pluck('sales_region', 'id'),
                'organizations' =>  sales_organization::ByCompany($user->company_id)->pluck('sales_organization', 'id'),
                'employees' =>  Employee_records::ByCompany($user->company_id)->get()->pluck( 'full_name', 'employee_id'),
                'customers' =>  Customer::ByCompany($user->company_id)->get()->pluck('full_info', 'customer_id'),
                'quotation' => $quotation
            ]);
    }



    public function update(SalesQuotation $quotation, Request $request) {
        $validator = Validator::make($request->input(),
            [
                'customer' => 'required',
                'sales_order_type' => 'required',

            ],
            [
                'customer.required'  => 'Customer is Required',
                'sales_order_type.required'  => 'Order Type is Required',
            ]
        );
        if ($validator->passes()) {
            try {


                if(empty($quotation->sales_quotation_no) || empty($quotation->sales_quotation_no) || $quotation->company_id != Auth::user()->company_id){
                    throw new Exception('Invalid  Information!', 400);
                }

                if($quotation->status == 'success'){
                    throw new Exception('Invalid Information!', 400);
                }

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


                DB::beginTransaction();

                $quotation->customer =  $request->customer;
                $quotation->description =  $request->description;
                $quotation->region =  $request->region;
                $quotation->requested_by =  $request->requested_by;
                $quotation->organization =  $request->organization;
                $quotation->down_payment =  $request->down_payment;

                $quotation->approver_1 =  $request->approver_1;
                $quotation->approver_2 =  $request->approver_2;
                $quotation->approver_3 =  $request->approver_3;
                $quotation->approver_4 =  $request->approver_4;

                $quotation->save();

                if ($quotation)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Sales Quotation Successfully Updated.',
                        'url' => route('sales-order-quotation-items', $quotation->sales_quotation_id),
                    ]);
                }else{
                    throw new Exception('Invalid Quotation Information!', 400);
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
                'message' => ($message != null) ? $message :'Invalid Quotation Information!'
            ]);
        }
    }


    public function approve(SalesQuotation $quotation, Request $request) {
        $user = Auth::user();
        try {
            if(empty($quotation->sales_quotation_no) || $quotation->company_id != $user->company_id){
                throw new Exception('Invalid Information!', 400);
            }
            if($quotation->status != 'pending'){
                throw new Exception('Invalid Quotation Information!', 400);
            }

            $quotation->approve_status = $request->approve_status;

            $nextApproveNumber =  $request->approve_status + 1;
            $nextApproveNumber = "approver_{$nextApproveNumber}";
            $nextApproveNumber = $quotation->$nextApproveNumber;

            if($nextApproveNumber > 0){
                $quotation->save();
            }else{
                $quotation->status = 'submitted';
                $quotation->save();

                $pdf =  App::make('dompdf.wrapper');
                $pdf->loadView(
                    'admin.sales.quotations.pdf',
                    [
                        'quotation' => $quotation,
                        'customer' => ($quotation->customer) ? $quotation->customerMaster : [],
                        'quotationItems' => ($quotation->items) ?  $quotation->items : [],
                    ]);



                $messageData = "<h6>Quotation No. $quotation->sales_quotation_no </h6>";
                $messageData .= '<p>'. $quotation->message .'<p>';
                $subject = 'Quotation No. '.$quotation->sales_quotation_no .' | '. $quotation->subject;
                $to =$quotation->customerMaster->email;
                $name ='quotation_'. $quotation->sales_quotation_no. '.pdf';

                \Mail::send( 'email.st_works.email_template', [ 'messageData' => $messageData ], function ($message) use ($to, $subject, $pdf, $name )
                {
                    $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
                    $message->to($to);
                    $message->subject($subject);
                    $message->attachData($pdf->output(), $name);
                });
            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Quotation Successfully Approved.',
                'url' => route('sales-order-quotation-items', $quotation->sales_quotation_id)
            ]);

        }catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function approve_customer(SalesQuotation $quotation) {
        try {
            $quotation->status = 'approved';
            $quotation->save();

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Quotation Successfully Approved.',
                'url' => route('sales-order-quotation-items', $quotation->sales_quotation_id)
            ]);

        }catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function reject(SalesQuotation $quotation, Request $request) {
        $user = Auth::user();
        try {
            if( empty( $quotation->sales_quotation_no ) || $quotation->company_id != $user->company_id ){
                throw new Exception('Invalid Information!', 400);
            }
            if($quotation->status == 'success'){
                throw new Exception('Invalid Quotation Information!', 400);
            }

            if(isset($request->client) && $request->client > 0){
                $quotation->approve_status = 0;
            }
            $quotation->status = 'created';
            $quotation->save();

            SalesOrderComment::create([
                'company_id' => $user->company_id,
                'user_id' => $user->id,

                'sales_order_id' => $quotation->sales_quotation_id,
                'type' => 'quotation',
                'user_type' => 'approve',
                'description' => $request->comment,
            ]);

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Quotation Successfully Rejected.',
                'url' => route('sales-order-quotation-items', $quotation->sales_quotation_id)
            ]);

        }catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function create_sales_order(SalesQuotation $quotation, Request $request) {
        $user = Auth::user();
        try {
            if( empty( $quotation->sales_quotation_no ) || $quotation->company_id != $user->company_id ){
                throw new Exception('Invalid Information!', 400);
            }
            if($quotation->status != 'approved'){
                throw new Exception('Invalid Quotation Information!', 400);
            }

            $max_number = SalesOrder::max('sales_order_no');
            $no = $this->getRangeNumber($max_number, 'sales', $user->company_id);
            if(!$no){
                throw new Exception('Invalid No!', 400);
            }

            $salesOrder = SalesOrder::create([
                'company_id'        => $user->company_id,
                'sales_order_no'    => $no,
                'customer'          => $quotation->customer,
                'sales_order_type'  => $quotation->sales_order_type,
                'sales_order_status'      => 'created',

                'description'       => $quotation->description,

                'down_payment'      => $quotation->down_payment,
                'region'            => $quotation->region,
                'quotation'         => $quotation->sales_quotation_id,
                'organization'      => $quotation->organization,
                'requested_by'      => $quotation->requested_by,

                'gross_price'      => $quotation->gross_price,
                'discount_amount'      => $quotation->discount_amount,
                'tax_amount'      => $quotation->tax_amount,
                'profit_margin_amount'      => $quotation->profit_margin_amount,
                'freight_charges'      => $quotation->freight_charges,
                'total_price'      => $quotation->total_price,

                'approver_1'      => $quotation->approver_1,
                'approver_2'      => $quotation->approver_2,
                'approver_3'      => $quotation->approver_3,
                'approver_4'      => $quotation->approver_4,

                'total_recurring_period' => $request->total_recurring_period,
                'recurring_period'       => $request->recurring_period,
                'auto_billing'           => $request->auto_billing,
                'auto_billing_date'      => ( !empty($request->auto_billing_date) ) ? $request->auto_billing_date : Carbon::now()->format('Y-m-d') ,
            ]);

            $quotation->sales_order_id = $salesOrder->sales_order_id;
            $quotation->status = 'success';
            $quotation->save();

            $max_number = SalesOrderItem::max('sales_order_item_no');
            $noItem = $this->getRangeNumber($max_number, 'salesOrderItem', $user->company_id);
            if(!$noItem){
                throw new Exception('Invalid Information!', 400);
            }

            foreach ($quotation->items as $item ){
                $material = Material::find($item->material);
                SalesOrderItem::create([
                    'company_id' => $user->company_id,
                    'sales_order_id' => $salesOrder->sales_order_id,
                    'sales_order_item_no' => $noItem,

                    'project_id' => $item->project_id,
                    'task_id' => $item->task_id,
                    'phase_id' => $item->phase_id,
                    'cost_center_id' => $item->cost_center_id,

                    'material' => (!empty($material)) ?  $material->material_id : null,
                    'material_no' => (!empty($material)) ?  $material->material_no : null,

                    'material_quantity' => (!empty($material)) ?  $item->material_quantity : null,
                    'unit_price' => (!empty($material)) ? $item->unit_price : $item->gross_price ,

                    'gross_price' => $item->gross_price,

                    'discount' => $item->discount,
                    'discount_amount' => $item->discount_amount,

                    'profit_margin' => $item->profit_margin,
                    'profit_margin_amount' => $item->profit_margin_amount,

                    'tax' => $item->tax,
                    'tax_amount' => $item->tax_amount,

                    'freight_charges' =>  $item->freight_charges,
                    'total_price' =>  $item->total_price,

                    'company_name' => $item->company_name,
                    'company_contact_phone' => $item->company_contact_phone,
                    'company_contact_person' => $item->company_contact_person,
                    'delivery_date' => $item->delivery_date,
                    'description' => $item->description,
                    'sales_order_type' => $salesOrder->sales_order_type
                ]);
                $noItem++;

            }

            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Sales Order Successfully Created.',
                'url' => route('sales-order-items', $salesOrder->sales_order_id)
            ]);

        }catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }

    protected function sendStWorkMail($to, $subject, $messageData){

        \Mail::send( 'email.st_works.email_template', [ 'messageData' => $messageData ], function ($message) use ($to, $subject )
        {
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $message->to($to);
            $message->subject($subject);
        });
    }


    // ------------  Sales Quotation Items --------------

    public function inquiry_items(SalesQuotation $quotation, Request $request ) {

        $updateItem = [];
        $updateTasks = [];
        $updatePhases = [];
        if(!empty($request->update_item)){
            $updateItem = SalesQuotationItem::ByCompany()->find($request->update_item);
            $project = Project::ByCompany()->find($updateItem->project_id);
            $updateTasks = TasksSubtask::where('project_id', $project->project_Id)->pluck('task_name', 'id');
            $updatePhases = Projectphase::where('project_id', $project->id)->pluck('phase_name', 'id');
        }
        $user = Auth::user();
        return view('admin.sales.quotations.entry_items',
        [
          'order' => $quotation,
          'orderItems' =>  $quotation->items,

          'updateItem' => $updateItem,
          'updateTasks' => $updateTasks,
          'updatePhases' => $updatePhases,

          'costs_type' => Cost_centres::ByCompany($user->company_id)->pluck( 'cost_centre', 'cost_id'),
          'projects' => Project::ByCompany($user->company_id)->get()->pluck( 'full_info', 'id'),
          'materials' => Material::ByCompany($user->company_id)->Active($user->company_id)->get()->pluck( 'full_info', 'material_id' ),
          'employees' =>  Employee_records::ByCompany($user->company_id)->get()->pluck( 'full_name', 'employee_id'),
          'comments' => SalesOrderComment::ByCompany($user->company_id)->where('type', 'quotation')->where('sales_order_id', $quotation->sales_quotation_id)->orderBy('created_at', 'desc')->take(5)->get(),
        ]);
    }


    public function save_items(SalesQuotation $quotation, Request $request) {
        $validator = Validator::make($request->input(),
            [
                'tax' => 'required',
                'project_id' => 'required',
            ],
            [
                'tax.required'  => 'Tax is Required',
                'project_id.required'  => 'Project is Required',
            ]
        );
        if ($validator->passes()) {
            $user = Auth::user();
            try {
                if(empty($quotation->sales_quotation_no) || $quotation->company_id != $user->company_id ){
                    throw new Exception('Invalid Inquiry Information!', 400);
                }
                if($quotation->status == 'success'){
                    throw new Exception('Invalid Information!', 400);
                }
                    DB::beginTransaction();
                    $material = [];
                    if($quotation->sales_order_type == 'goods'){
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

                        if(!empty($request->sales_quotation_item_id)){

                            $salesOrderItem = SalesQuotationItem::find($request->sales_quotation_item_id);
                                if(!empty($salesOrderItem)){

                                    $quotation->gross_price      -= $salesOrderItem->gross_price;
                                    $quotation->discount_amount  -= $salesOrderItem->discount_amount;
                                    $quotation->tax_amount       -= $salesOrderItem->tax_amount;
                                    $quotation->profit_margin_amount  -= $salesOrderItem->profit_margin_amount;
                                    $quotation->freight_charges  -= $salesOrderItem->freight_charges;
                                    $quotation->total_price      -= $salesOrderItem->total_price;

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
                                        'company_contact_phone' => $request->company_contact_phone,
                                        'company_contact_person' => $request->company_contact_person,
                                        'delivery_date' => $request->delivery_date,
                                        'description' => $request->description,


                                    ]);
                                    if ($salesOrderItem)
                                    {
                                        DB::commit();
                                        $quotation->gross_price  += $gross_price;
                                        $quotation->discount_amount  += $discount_amount;
                                        $quotation->tax_amount  += $tax_amount;
                                        $quotation->profit_margin_amount  += $profit_margin_amount;
                                        $quotation->freight_charges  += $freight_charges;
                                        $quotation->total_price  += $totalAmount;
                                        $quotation->save();

                                        return response()->json([
                                            'status' => 'success',
                                            'message' => 'Item Successfully Update.',
                                            'url' => route( 'sales-order-quotation-items', $quotation->sales_quotation_id )
                                        ]);
                                    }else{
                                        throw new Exception('Invalid Inquiry Item Information!', 400);
                                    }
                                }

                    }else{

                        $max_number = SalesQuotationItem::max('sales_quotation_item_no');
                        $no = $this->getRangeNumber($max_number, 'quotationItem', $user->company_id);
                        if(!$no){
                            throw new Exception('Invalid No Information!', 400);
                        }

                        $salesOrderItem = SalesQuotationItem::create([

                            'company_id' => $user->company_id,
                            'sales_quotation_id' => $quotation->sales_quotation_id,
                            'sales_quotation_item_no' => $no,

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
                        ]);

                        if ($salesOrderItem)
                        {

                            $quotation->gross_price  += $gross_price;
                            $quotation->discount_amount  += $discount_amount;
                            $quotation->tax_amount  += $tax_amount;
                            $quotation->profit_margin_amount  += $profit_margin_amount;
                            $quotation->freight_charges  += $freight_charges;
                            $quotation->total_price  += $totalAmount;
                            $quotation->save();

                            DB::commit();
                            return response()->json([
                                'status' => 'success',
                                'message' => 'Item Successfully Added.',
                                'url' => route( 'sales-order-quotation-items' , $quotation->sales_quotation_id )
                            ]);
                        }else{
                            throw new Exception('Invalid Quotation Item Information!', 400);
                        }
                    }
                }else {
                   throw new Exception('Invalid Item Information!', 400);
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


    public function submit(SalesQuotation $quotation, Request $request) {
        $validator = Validator::make($request->input(),
            [
                'subject' => 'required',
                'message' => 'required',
            ],
            [
                'subject.required'  => 'Subject is Required',
                'message.required'  => 'Message is Required',
            ]
        );
        if ($validator->passes()) {
            $user = Auth::user();
            try {

                if( empty($quotation->sales_quotation_no) || $quotation->company_id != $user->company_id ){
                    throw new Exception('Invalid Quotation Information!', 400);
                }

                if($quotation->status == 'success'){
                    throw new Exception('Invalid Quotation Information!', 400);
                }

                $quotation->status  = 'pending';
                $quotation->message = $request->message;
                $quotation->subject = $request->subject;
                $quotation->save();

                DB::commit();
                return response()->json([
                    'status' => 'success',
                    'message' => 'Quotation Successfully submit.',
                    'url' => route( 'sales-order-quotation-items', $quotation->sales_quotation_id )
                ]);
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

    public function order_items_delete(SalesQuotationItem $quotationItem) {
        $user = Auth::user();
        try {

            if( empty($quotationItem->sales_quotation_item_no) || $quotationItem->company_id != $user->company_id ){
                throw new Exception('Invalid Quotation Information!', 400);
            }

            $quotation = SalesQuotation::ByCompany($user->company_id)->find($quotationItem->sales_quotation_id);
            if($quotation->status == 'success'){
                throw new Exception('Invalid Quotation Information!', 400);
            }

            if(!empty($quotation)){
                $quotation->gross_price      -= $quotationItem->gross_price;
                $quotation->discount_amount  -= $quotationItem->discount_amount;
                $quotation->tax_amount       -= $quotationItem->tax_amount;
                $quotation->profit_margin_amount  -= $quotationItem->profit_margin_amount;
                $quotation->freight_charges  -= $quotationItem->freight_charges;
                $quotation->total_price      -= $quotationItem->total_price;
                $quotation->save();
            }
            $quotationItem->delete();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Item Successfully Deleted.',
                'url' => route( 'sales-order-quotation-items', $quotationItem->sales_quotation_id )
            ]);
        }catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function view_pdf(Quotation $quotation) {
        if( empty($quotation) || $quotation->company_id != Auth::user()->company_id ){
            return redirect()->back();
        }
        if( empty($quotation->sales_quotation_no) ){
            return redirect()->back();
        }
        $quotation->sales_quotation_status = 'pending';
        $quotation->save();

        $pdf =  App::make('dompdf.wrapper');
        return $pdf->loadView(
            'admin.sales.quotations.pdf',
            [
                'Inquiry' => $quotation,
                'customer' => ($quotation->customer) ? $quotation->customerMaster : [],
                'InquiryItems' => ($quotation->items) ?  $quotation->items : [],
            ])->save('invoice.pdf')->stream($quotation->sales_quotation_no .'_quotation.pdf');
    }


}
