<?php

namespace App\Http\Controllers\Admin\Sales;


use App\Models\Master\Customer;
use App\Models\Master\Material;
use App\Models\Projects\ProjectCost;
use App\Models\Sales\SalesDocument;
use App\Models\Sales\SalesDocumentItem;
use App\Models\Sales\SalesOrder;

use App\Models\Sales\SalesOrderItem;
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
use App\Models\Projects\ProjectMilestone;

use Exception;

class SalesDocumentsController extends Controller {



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        $document_count = SalesDocument::ByCompany()->searchBy($request);
        $documents = SalesDocument::ByCompany()->searchBy($request)->orderBy('sales_document_id', 'desc')->paginate(20);

        return view('admin.sales.documents.index',
        [
            'documents' =>  $documents,
            'gross_price' =>  $document_count->sum('gross_price'),
            'discount_amount' =>  $document_count->sum('discount_amount'),
            'profit_margin_amount' =>  $document_count->sum('profit_margin_amount'),
            'tax_amount' =>  $document_count->sum('tax_amount'),
            'freight_charges' =>  $document_count->sum('freight_charges'),
            'total_price' =>  $document_count->sum('total_price')
        ]);

    }

    public function create_inquiry() {

        $user = Auth::user();
        $max_number =  SalesDocument::max('sales_document_no');
        return view('admin.sales.documents.create',
        [
            'sales_document_no' =>  $this->getRangeNumber($max_number, 'document', $user->company_id),
            'regions' => salesregion::pluck('sales_region', 'id'),
            'organizations' =>  sales_organization::ByCompany($user->company_id)->pluck('sales_organization', 'id'),
            'employees' =>  Employee_records::ByCompany($user->company_id)->get()->pluck( 'full_name', 'employee_id'),
            'customers' =>  Customer::ByCompany($user->company_id)->get()->pluck('full_info', 'customer_id'),
            'sales_document_type' => 'inquiry'
        ]);
    }

    public function create_quotation() {

        $user = Auth::user();
        $max_number =  SalesDocument::max('sales_document_no');
        return view('admin.sales.documents.create',
        [
            'sales_document_no' =>  $this->getRangeNumber($max_number, 'document', $user->company_id),
            'regions' => salesregion::pluck('sales_region', 'id'),
            'organizations' =>  sales_organization::ByCompany($user->company_id)->pluck('sales_organization', 'id'),
            'employees' =>  Employee_records::ByCompany($user->company_id)->get()->pluck( 'full_name', 'employee_id'),
            'customers' =>  Customer::ByCompany($user->company_id)->get()->pluck('full_info', 'customer_id'),
            'sales_document_type' => 'quotation'
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

                $max_number =  SalesDocument::max('sales_document_no');
                $no = $this->getRangeNumber($max_number, 'document', $user->company_id);
                if(!$no){
                    throw new Exception('Invalid Information!', 400);
                }

                DB::beginTransaction();
                $salesOrder = SalesDocument::create([
                    'company_id'        => $user->company_id,
                    'sales_document_no' => $no,

                    'customer'          => $request->customer,
                    'sales_order_type'  => $request->sales_order_type,
                    'sales_document_type'  => $request->sales_document_type,
                    'sales_document_status'=> 'created',
                    'description'       => $request->description,

                    'down_payment'      => ($request->down_payment > 0 ) ? $request->down_payment : 0,
                    'region'            => $request->region,
                    'organization'      => $request->organization,
                    'requested_by'      => $request->requested_by,

                ]);

                if ($salesOrder)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Sales Document Successfully Created.',
                        'url' => route('sales-order-document-items', $salesOrder->sales_document_id),
                    ]);
                }else{
                    throw new Exception('Invalid Document Information!', 400);
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
                'message' => ($message != null) ? $message :'Invalid Document Information!'
            ]);
        }
    }

    public function edit(SalesDocument $document) {

        $user = Auth::user();
        if(empty($document) || $document->company_id != $user->company_id){
           return redirect()->back();
        }
        if($document->sales_document_status == 'success'){
            return redirect()->back();
        }
        return view('admin.sales.documents.create',
            [
                'regions' => salesregion::pluck('sales_region', 'id'),
                'organizations' =>  sales_organization::ByCompany($user->company_id)->pluck('sales_organization', 'id'),
                'employees' =>  Employee_records::ByCompany($user->company_id)->get()->pluck( 'full_name', 'employee_id'),
                'customers' =>  Customer::ByCompany($user->company_id)->get()->pluck('full_info', 'customer_id'),
                'sales_document_type' => $document->sales_document_type,
                'document' => $document
            ]);
    }



    public function update(SalesDocument $document, Request $request) {
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

                if(empty($document) || $document->company_id != Auth::user()->company_id){
                    throw new Exception('Invalid  Information!', 400);
                }

                if($document->sales_document_status == 'success'){
                    throw new Exception('Invalid Information!', 400);
                }

                DB::beginTransaction();

                $document->customer =  $request->customer;
                $document->description =  $request->description;
                $document->region =  $request->region;
                $document->requested_by =  $request->requested_by;
                $document->organization =  $request->organization;
                $document->down_payment =  $request->down_payment;

                $document->save();

                if ($document)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Sales Document Successfully Updated.',
                        'url' => route('sales-order-document-items', $document->sales_document_id),
                    ]);
                }else{
                    throw new Exception('Invalid Document Information!', 400);
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
                'message' => ($message != null) ? $message :'Invalid Document Information!'
            ]);
        }
    }




    // ------------  Document Items --------------

    public function document_items(SalesDocument $document, Request $request ) {
        $updateItem = [];
        $updateTasks = [];
        $updatePhases = [];
        if(!empty($request->update_item)){
            $updateItem = SalesDocumentItem::ByCompany()->find($request->update_item);
            $project = Project::ByCompany()->find($updateItem->project_id);
            $updateTasks = TasksSubtask::where('project_id', $project->project_Id)->pluck('task_name', 'id');
            $updatePhases = Projectphase::where('project_id', $project->id)->pluck('phase_name', 'id');
        }

        $user = Auth::user();
        return view('admin.sales.documents.entry_items',
        [
          'order' => $document,
          'orderItems' =>  $document->items,

          'updateItem' => $updateItem,
          'updateTasks' => $updateTasks,
          'updatePhases' => $updatePhases,

          'costs_type' => Cost_centres::ByCompany($user->company_id)->pluck( 'cost_centre', 'cost_id'),
          'projects' => Project::ByCompany($user->company_id)->get()->pluck( 'full_info', 'id'),
          'materials' => Material::ByCompany($user->company_id)->Active($user->company_id)->get()->pluck( 'full_info', 'material_id' )
        ]);
    }


    public function save_items(SalesDocument $document, Request $request) {
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
                if(empty($document) || $document->company_id != $user->company_id ){
                    throw new Exception('Invalid Document Information!', 400);
                }
                if($document->sales_document_status != 'created'){
                    throw new Exception('Invalid Information!', 400);
                }
                    DB::beginTransaction();
                    $material = [];
                    if($document->sales_order_type == 'goods'){
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

                        if(!empty($request->sales_document_item_id)){

                            $salesOrderItem = SalesDocumentItem::find($request->sales_document_item_id);
                                if(!empty($salesOrderItem)){

                                    $document->gross_price      -= $salesOrderItem->gross_price;
                                    $document->discount_amount  -= $salesOrderItem->discount_amount;
                                    $document->tax_amount       -= $salesOrderItem->tax_amount;
                                    $document->profit_margin_amount  -= $salesOrderItem->profit_margin_amount;
                                    $document->freight_charges  -= $salesOrderItem->freight_charges;
                                    $document->total_price      -= $salesOrderItem->total_price;

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
                                        $document->gross_price  += $gross_price;
                                        $document->discount_amount  += $discount_amount;
                                        $document->tax_amount  += $tax_amount;
                                        $document->profit_margin_amount  += $profit_margin_amount;
                                        $document->freight_charges  += $freight_charges;
                                        $document->total_price  += $totalAmount;
                                        $document->save();

                                        return response()->json([
                                            'status' => 'success',
                                            'message' => 'Item Successfully Update.',
                                            'url' => route( 'sales-order-document-items', $document->sales_document_id )
                                        ]);
                                    }else{
                                        throw new Exception('Invalid Document Item Information!', 400);
                                    }
                                }

                    }else{

                        $max_number = SalesDocumentItem::max('sales_document_item_no');
                        $no = $this->getRangeNumber($max_number, 'documentItem', $user->company_id);
                        if(!$no){
                            throw new Exception('Invalid No Information!', 400);
                        }

                        $salesOrderItem = SalesDocumentItem::create([

                            'company_id' => $user->company_id,
                            'sales_document_id' => $document->sales_document_id,
                            'sales_document_item_no' => $no,

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
                            'sales_document_type' => $document->sales_document_type
                        ]);

                        if ($salesOrderItem)
                        {

                            $document->gross_price  += $gross_price;
                            $document->discount_amount  += $discount_amount;
                            $document->tax_amount  += $tax_amount;
                            $document->profit_margin_amount  += $profit_margin_amount;
                            $document->freight_charges  += $freight_charges;
                            $document->total_price  += $totalAmount;
                            $document->save();

                            DB::commit();
                            return response()->json([
                                'status' => 'success',
                                'message' => 'Item Successfully Added.',
                                'url' => route( 'sales-order-document-items' , $document->sales_document_id )
                            ]);
                        }else{
                            throw new Exception('Invalid Document Item Information!', 400);
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


    public function order_items_delete(SalesDocumentItem $documentItem) {
        $user = Auth::user();
        try {
            if( empty($documentItem) || $documentItem->company_id != $user->company_id ){
                throw new Exception('Invalid Document Information!', 400);
            }

            $order = SalesDocument::ByCompany($user->company_id)->find($documentItem->sales_document_id);
            if($order->sales_document_status == 'success'){
                throw new Exception('Invalid Document Information!', 400);
            }

            if(!empty($order)){
                $order->gross_price      -= $documentItem->gross_price;
                $order->discount_amount  -= $documentItem->discount_amount;
                $order->tax_amount       -= $documentItem->tax_amount;
                $order->profit_margin_amount  -= $documentItem->profit_margin_amount;
                $order->freight_charges  -= $documentItem->freight_charges;
                $order->total_price      -= $documentItem->total_price;
                $order->save();
            }
            $documentItem->delete();
            DB::commit();
            return response()->json([
                'status' => 'success',
                'message' => 'Item Successfully Deleted.',
                'url' => route( 'sales-order-document-items', $documentItem->sales_document_id )
            ]);
        }catch (Exception $ex) {
            DB::rollBack();
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ]);
        }
    }

}
