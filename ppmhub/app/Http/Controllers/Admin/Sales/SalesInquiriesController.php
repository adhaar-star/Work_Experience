<?php

namespace App\Http\Controllers\Admin\Sales;

use App\Models\Master\Customer;
use App\Models\Master\Material;
use App\Models\Sales\SalesInquiry;
use App\Models\Sales\SalesInquiryItem;
use App\Models\Sales\SalesQuotation;
use App\Models\Sales\SalesQuotationItem;
use App\Project;

use App\sales_organization;
use App\TasksSubtask;

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

class SalesInquiriesController extends Controller {

    public function index(Request $request) {

        $inquiry_count = SalesInquiry::ByCompany()->searchBy($request);
        $inquiries = SalesInquiry::ByCompany()
            ->searchBy($request)
            ->orderBy('sales_inquiry_id', 'desc')
            ->paginate(20);
        
        return view('admin.sales.inquiries.index',
        [
            'inquiries' =>  $inquiries,
            'gross_price' =>  $inquiry_count->sum('gross_price'),
            'discount_amount' =>  $inquiry_count->sum('discount_amount'),
            'profit_margin_amount' =>  $inquiry_count->sum('profit_margin_amount'),
            'tax_amount' =>  $inquiry_count->sum('tax_amount'),
            'freight_charges' =>  $inquiry_count->sum('freight_charges'),
            'total_price' =>  $inquiry_count->sum('total_price')
        ]);

    }

    public function create() {
        $user = Auth::user();
        $max_number =  SalesInquiry::max('sales_inquiry_no');
        return view('admin.sales.inquiries.create',
        [
            'no' =>  $this->getRangeNumber($max_number, 'inquiry', $user->company_id),
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

                $max_number =  SalesInquiry::max('sales_inquiry_no');
                $no = $this->getRangeNumber($max_number, 'inquiry', $user->company_id);
                if(!$no){
                    throw new Exception('Invalid No!', 400);
                }

                DB::beginTransaction();
                $inquiry = SalesInquiry::create([
                    'company_id'        => $user->company_id,
                    'sales_inquiry_no' => $no,

                    'customer'          => $request->customer,
                    'description'       => $request->description,

                    'sales_order_type'  => $request->sales_order_type,
                    'status'=> 'created',

                    'down_payment'      => ($request->down_payment > 0 ) ? $request->down_payment : 0,
                    'region'            => $request->region,
                    'organization'      => $request->organization,
                    'requested_by'      => $request->requested_by,

                ]);

                if ($inquiry)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Sales Inquiry Successfully Created.',
                        'url' => route('sales-order-inquiry-items', $inquiry->sales_inquiry_id),
                    ]);
                }else{
                    throw new Exception('Invalid Inquiry Information!', 400);
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


    public function edit(SalesInquiry $inquiry) {

        $user = Auth::user();
        if(empty($inquiry) || $inquiry->company_id != $user->company_id){
           return redirect()->back();
        }
        if($inquiry->status == 'success'){
            return redirect()->back();
        }
        return view('admin.sales.inquiries.create',
            [
                'regions' => salesregion::pluck('sales_region', 'id'),
                'organizations' =>  sales_organization::ByCompany($user->company_id)->pluck('sales_organization', 'id'),
                'employees' =>  Employee_records::ByCompany($user->company_id)->get()->pluck( 'full_name', 'employee_id'),
                'customers' =>  Customer::ByCompany($user->company_id)->get()->pluck('full_info', 'customer_id'),
                'sales_inquiry_type' => $inquiry->sales_inquiry_type,
                'inquiry' => $inquiry
            ]);
    }



    public function update(SalesInquiry $inquiry, Request $request) {
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


                if(empty($inquiry) || empty($inquiry->sales_inquiry_no) || $inquiry->company_id != Auth::user()->company_id){
                    throw new Exception('Invalid  Information!', 400);
                }

                if($inquiry->status == 'success'){
                    throw new Exception('Invalid Information!', 400);
                }

                DB::beginTransaction();

                $inquiry->customer =  $request->customer;
                $inquiry->description =  $request->description;
                $inquiry->region =  $request->region;
                $inquiry->requested_by =  $request->requested_by;
                $inquiry->organization =  $request->organization;
                $inquiry->down_payment =  $request->down_payment;

                $inquiry->save();

                if ($inquiry)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Sales Inquiry Successfully Updated.',
                        'url' => route('sales-order-inquiry-items', $inquiry->sales_inquiry_id),
                    ]);
                }else{
                    throw new Exception('Invalid Inquiry Information!', 400);
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
                'message' => ($message != null) ? $message :'Invalid Inquiry Information!'
            ]);
        }
    }

    public function create_quotation_form_inquiry(SalesInquiry $inquiry, Request $request) {

        $validator = Validator::make($request->input(),
            [
                'approver_1' => 'required',
            ],
            [
                'approver_1.required' => 'Approver 1 is Required',
            ]
        );
        if ($validator->passes()) {

            $user = Auth::user();
            try {

                if (empty($inquiry) && empty($inquiry->sales_inquiry_no)) {
                    throw new Exception('Invalid Inquiry!', 400);
                }

                $max_number = SalesQuotation::max('sales_quotation_no');
                $no = $this->getRangeNumber($max_number, 'quotation', $user->company_id);
                if (!$no) {
                    throw new Exception('Invalid No!', 400);
                }

                $max_number = SalesQuotationItem::max('sales_quotation_item_no');
                $no_item = $this->getRangeNumber($max_number, 'inquiryItem', $user->company_id);
                if (!$no_item) {
                    throw new Exception('Invalid Item No!', 400);
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


                $quotation = SalesQuotation::create([
                    'company_id' => $user->company_id,
                    'sales_quotation_no' => $no,
                    'sales_inquiry_id' => $inquiry->sales_inquiry_id,

                    'sales_order_type' => $inquiry->sales_order_type,
                    'status' => 'created',

                    'customer' => $inquiry->customer,
                    'description' => $inquiry->description,
                    'down_payment' => $inquiry->down_payment,
                    'region' => $inquiry->region,
                    'organization' => $inquiry->organization,
                    'requested_by' => $inquiry->requested_by,

                    'gross_price' => $inquiry->gross_price,
                    'discount_amount' => $inquiry->discount_amount,
                    'tax_amount' => $inquiry->tax_amount,
                    'profit_margin_amount' => $inquiry->profit_margin_amount,
                    'freight_charges' => $inquiry->freight_charges,
                    'total_price' => $inquiry->total_price,

                    'approver_1' => $request->approver_1,
                    'approver_2' => $request->approver_2,
                    'approver_3' => $request->approver_3,
                    'approver_4' => $request->approver_4,
                ]);

                if ($quotation) {

                    $inquiry->status = 'success';
                    $inquiry->sales_quotation_id = $quotation->sales_quotation_id;
                    $inquiry->save();


                    foreach ($inquiry->items as $salesItem) {
                        SalesQuotationItem::create([
                            'company_id' => $user->company_id,
                            'sales_quotation_id' => $quotation->sales_quotation_id,
                            'sales_quotation_item_no' => $no_item,

                            'project_id' => $salesItem->project_id,
                            'task_id' => $salesItem->task_id,
                            'phase_id' => $salesItem->phase_id,
                            'cost_center_id' => $salesItem->cost_center_id,

                            'material' => $salesItem->material_id,
                            'material_no' => $salesItem->material_no,

                            'material_quantity' => $salesItem->material_quantity,
                            'unit_price' => $salesItem->unit_price,

                            'gross_price' => $salesItem->gross_price,

                            'discount' => $salesItem->gross_price,
                            'discount_amount' => $salesItem->discount_amount,

                            'profit_margin' => $salesItem->profit_margin,
                            'profit_margin_amount' => $salesItem->profit_margin_amount,

                            'tax' => $salesItem->tax,
                            'tax_amount' => $salesItem->tax_amount,

                            'freight_charges' => $salesItem->freight_charges,
                            'total_price' => $salesItem->total_price,

                            'company_name' => $salesItem->company_name,
                            'company_contact_phone' => $salesItem->company_contact_phone,
                            'company_contact_person' => $salesItem->company_contact_person,
                            'delivery_date' => $salesItem->delivery_date,
                            'description' => $salesItem->description,
                        ]);
                        $no_item++;
                    }
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Sales Quotation Successfully Created.',
                        'url' => route('sales-order-quotation-items', $quotation->sales_quotation_id),
                    ]);
                } else {
                    throw new Exception('Invalid Inquiry Information!', 400);
                }

            } catch (Exception $ex) {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => $ex->getMessage()
                ]);
            }
        } else {
            $errors = array_values($validator->errors()->getMessages());
            $message = null;
            foreach ($errors as $error) {
                if (!empty($error)) {
                    foreach ($error as $errorItem) {
                        $message .= $errorItem . ' ';
                    }
                }
            }
            return response()->json([
                'status' => 'validation',
                'message' => ($message != null) ? $message : 'Invalid Information!'
            ]);
        }
    }



    // ------------  Inquiry Items --------------

    public function inquiry_items(SalesInquiry $inquiry, Request $request ) {
        $updateItem = [];
        $updateTasks = [];
        $updatePhases = [];
        if(!empty($request->update_item)){
            $updateItem = SalesInquiryItem::ByCompany()->find($request->update_item);
            $project = Project::ByCompany()->find($updateItem->project_id);
            $updateTasks = TasksSubtask::where('project_id', $project->project_Id)->pluck('task_name', 'id');
            $updatePhases = Projectphase::where('project_id', $project->id)->pluck('phase_name', 'id');
        }

        $user = Auth::user();
        return view('admin.sales.inquiries.entry_items',
        [
          'order' => $inquiry,
          'orderItems' =>  $inquiry->items,

          'updateItem' => $updateItem,
          'updateTasks' => $updateTasks,
          'updatePhases' => $updatePhases,

          'costs_type' => Cost_centres::ByCompany($user->company_id)->pluck( 'cost_centre', 'cost_id'),
          'projects' => Project::ByCompany($user->company_id)->get()->pluck( 'full_info', 'id'),
          'materials' => Material::ByCompany($user->company_id)->Active($user->company_id)->get()->pluck( 'full_info', 'material_id' ),
          'employees' =>  Employee_records::ByCompany($user->company_id)->get()->pluck( 'full_name', 'employee_id'),
        ]);
    }


    public function save_items(SalesInquiry $inquiry, Request $request) {
        $validator = Validator::make($request->input(),
            [
                'tax' => 'required',
                'project_id'    => 'required',

            ],
            [
                'tax.required'  => 'Tax  is Required',
                'project_id.required'  => 'Project  is Required',
            ]
        );
        if ($validator->passes()) {
            $user = Auth::user();
            try {
                if(empty($inquiry) || $inquiry->company_id != $user->company_id ){
                    throw new Exception('Invalid Inquiry Information!', 400);
                }
                if($inquiry->status == 'success'){
                    throw new Exception('Invalid Information!', 400);
                }
                    DB::beginTransaction();
                    $material = [];
                    if($inquiry->sales_order_type == 'goods'){
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

                        if(!empty($request->sales_inquiry_item_id)){

                            $salesOrderItem = SalesInquiryItem::find($request->sales_inquiry_item_id);
                                if(!empty($salesOrderItem)){

                                    $inquiry->gross_price      -= $salesOrderItem->gross_price;
                                    $inquiry->discount_amount  -= $salesOrderItem->discount_amount;
                                    $inquiry->tax_amount       -= $salesOrderItem->tax_amount;
                                    $inquiry->profit_margin_amount  -= $salesOrderItem->profit_margin_amount;
                                    $inquiry->freight_charges  -= $salesOrderItem->freight_charges;
                                    $inquiry->total_price      -= $salesOrderItem->total_price;

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
                                        $inquiry->gross_price  += $gross_price;
                                        $inquiry->discount_amount  += $discount_amount;
                                        $inquiry->tax_amount  += $tax_amount;
                                        $inquiry->profit_margin_amount  += $profit_margin_amount;
                                        $inquiry->freight_charges  += $freight_charges;
                                        $inquiry->total_price  += $totalAmount;
                                        $inquiry->save();

                                        return response()->json([
                                            'status' => 'success',
                                            'message' => 'Item Successfully Update.',
                                            'url' => route( 'sales-order-inquiry-items', $inquiry->sales_inquiry_id )
                                        ]);
                                    }else{
                                        throw new Exception('Invalid Inquiry Item Information!', 400);
                                    }
                                }

                    }else{

                        $max_number = SalesInquiryItem::max('sales_inquiry_item_no');
                        $no = $this->getRangeNumber($max_number, 'inquiryItem', $user->company_id);
                        if(!$no){
                            throw new Exception('Invalid No Information!', 400);
                        }

                        $salesOrderItem = SalesInquiryItem::create([

                            'company_id' => $user->company_id,
                            'sales_inquiry_id' => $inquiry->sales_inquiry_id,
                            'sales_inquiry_item_no' => $no,

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

                            $inquiry->gross_price  += $gross_price;
                            $inquiry->discount_amount  += $discount_amount;
                            $inquiry->tax_amount  += $tax_amount;
                            $inquiry->profit_margin_amount  += $profit_margin_amount;
                            $inquiry->freight_charges  += $freight_charges;
                            $inquiry->total_price  += $totalAmount;
                            $inquiry->save();

                            DB::commit();
                            return response()->json([
                                'status' => 'success',
                                'message' => 'Item Successfully Added.',
                                'url' => route( 'sales-order-inquiry-items' , $inquiry->sales_inquiry_id )
                            ]);
                        }else{
                            throw new Exception('Invalid Inquiry Item Information!', 400);
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


    public function order_items_delete(SalesInquiryItem $inquiryItem) {
        $user = Auth::user();
        try {

            if( empty($inquiryItem) || $inquiryItem->company_id != $user->company_id ){
                throw new Exception('Invalid Inquiry Information!', 400);
            }

            $order = SalesInquiry::ByCompany($user->company_id)->find($inquiryItem->sales_inquiry_id);
            if($order->status == 'success'){
                throw new Exception('Invalid Inquiry Information!', 400);
            }

            if(!empty($order)){
                $order->gross_price      -= $inquiryItem->gross_price;
                $order->discount_amount  -= $inquiryItem->discount_amount;
                $order->tax_amount       -= $inquiryItem->tax_amount;
                $order->profit_margin_amount  -= $inquiryItem->profit_margin_amount;
                $order->freight_charges  -= $inquiryItem->freight_charges;
                $order->total_price      -= $inquiryItem->total_price;
                $order->save();
            }
            $inquiryItem->delete();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Item Successfully Deleted.',
                'url' => route( 'sales-order-inquiry-items', $inquiryItem->sales_inquiry_id )
            ]);
        }catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }

    public function view_pdf(SalesInquiry $inquiry) {
        if( empty($inquiry) || $inquiry->company_id != Auth::user()->company_id ){
            return redirect()->back();
        }
        if( empty($inquiry->sales_inquiry_no) ){
            return redirect()->back();
        }
        $inquiry->sales_inquiry_status = 'pending';
        $inquiry->save();

        $pdf =  App::make('dompdf.wrapper');
        return $pdf->loadView(
            'admin.sales.inquiries.pdf',
            [
                'Inquiry' => $inquiry,
                'customer' => ($inquiry->customer) ? $inquiry->customerMaster : [],
                'InquiryItems' => ($inquiry->items) ?  $inquiry->items : [],
            ])->save('invoice.pdf')->stream($inquiry->sales_inquiry_no .'_quotation.pdf');
    }


}
