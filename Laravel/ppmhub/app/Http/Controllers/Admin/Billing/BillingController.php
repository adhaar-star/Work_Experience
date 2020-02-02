<?php

namespace App\Http\Controllers\Admin\Billing;
use App\GlAccount;
use App\Http\Controllers\Controller;
use App\Models\Billing\Billing;
use App\Models\Billing\BillingItem;
use App\Models\Billing\BillingTransactions;
use App\Models\Projects\ProjectCost;
use App\Models\Projects\ProjectMilestone;
use App\Models\Sales\SalesOrder;
use App\Models\Sales\SalesOrderItem;
use Carbon\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;


use Auth;
use Validator;
use DB;
use Exception;

class BillingController extends Controller {

    public function index(Request $request) {

        $billing_count = Billing::ByCompany()->searchBy($request);
        $billings = Billing::ByCompany()->searchBy($request)->orderBy('sales_order_id', 'desc')->paginate(20);
        return view('admin.billing.index',[
            'billings' =>  $billings,
            'gross_price' =>  $billing_count->sum('gross_price'),
            'discount_amount' =>  $billing_count->sum('discount_amount'),
            'tax_amount' =>  $billing_count->sum('tax_amount'),
            'freight_charges' =>  $billing_count->sum('freight_charges'),
            'total_price' =>  $billing_count->sum('total_payable'),
        ]);
    }

    public function create() {
        $max_number = Billing::max('billing_no');
        $salesOrders = SalesOrder::ByCompany()->isApproved()->pluck('sales_order_no', 'sales_order_id');

        if(empty($salesOrders->count())){
            Session::flash('alert-warning', 'No Sales Order Found!');
        }

        return view('admin/billing/create',
            [
                'sales_order_no' => $salesOrders,
                'billing_no' => $this->getRangeNumber($max_number, 'billing', Auth::user()->company_id)
            ]
        );
    }


    public function store(Request $request) {
        $validator = Validator::make($request->input(),
            [
                'sales_order_id' => 'required'
            ],
            [
                'sales_order_id.required'  => 'Order No. is Required'
            ]
        );
        if ($validator->passes()) {
            $user = Auth::user();
            try {

                if(empty($request->input('sales_order_item'))){
                    throw new Exception('Please Select a Item. ', 400);
                }

                $max_number = Billing::max('billing_no');
                $no = $this->getRangeNumber($max_number, 'billing', $user->company_id);
                if(!$no){
                    throw new Exception('Invalid Information!', 400);
                }
                DB::beginTransaction();

                $order = SalesOrder::ByCompany()->where('sales_order_status', 'approved' )->find($request->sales_order_id);

                $orderItem = $request->input('sales_order_item');

                $gross_price = 0;
                $discount_amount = 0;
                $tax_amount =0;
                $freight_charges =0;
                $total_price = 0;
                $billingItem =[];

                foreach ($orderItem as $sales_order_id){

                    $salesOrderItem = SalesOrderItem::find($sales_order_id);

                    if(!empty($salesOrderItem)){

                        if($salesOrderItem->sales_order_type == 'milestone'){

                            $milestones = ProjectMilestone::isActive()->isBillable()
                                ->where('project_id', $salesOrderItem->project_id )
                                ->where('billing_status', 0 )
                                ->where('billing_plan', '>', 0 )
                                ->get();

                            $milestones_percent =0;
                            $milestones_info ='';

                            foreach ($milestones as $milestone){
                                if($milestone->billing_plan > 0){
                                    $milestones_percent += $milestone->billing_plan;
                                    $milestones_info .= ''. $milestone->milestone_name .' - '. $milestone->milestone_Id .' ( '. $milestone->billing_plan .' %)  </><br> ';
                                    $milestone->billing_status = 1;
                                    $milestone->save();
                                }
                            }

                            if($milestones_percent > 0 && $milestones_percent <= 100){

                                $gross_price_item =  $salesOrderItem->gross_price * $milestones_percent / 100;
                                $profit_margin_item =  $salesOrderItem->profit_margin_amount * $milestones_percent / 100;
                                $gross_price_item += $profit_margin_item;

                                $gross_price += $gross_price_item;

                                $discount_amount_item =  $salesOrderItem->discount_amount * $milestones_percent / 100;
                                $discount_amount += $discount_amount_item;

                                $tax_amount_item =  $salesOrderItem->tax_amount * $milestones_percent / 100;
                                $tax_amount += $tax_amount_item;

                                $total_price_item =  $salesOrderItem->total_price * $milestones_percent / 100;
                                $total_price += $total_price_item;


                                $description = 'Project No. '. $salesOrderItem->salesProject->project_Id . '<br>';
                                $description .= $milestones_info;


                                array_push($billingItem, [
                                    'sales_order_item_id' => $salesOrderItem->sales_order_item_id,
                                    'sales_order_id' => $salesOrderItem->sales_order_id,
                                    'billing_type' => $order->sales_order_type,

                                    'milestone' => $milestones_percent,
                                    'gross_price' => $gross_price_item,
                                    'discount_amount' => $discount_amount_item,
                                    'tax_amount' => $tax_amount_item,
                                    'total_price' => $total_price_item,
                                    'description' => $description,
                                ]);

                                if($milestones_percent >= 100){
                                    $salesOrderItem->sales_order_status = 'billed';
                                    $salesOrderItem->save();
                                }else{
                                    $milestones_percent = ProjectMilestone::isActive()->isBillable()
                                        ->where('project_id', $salesOrderItem->project_id )
                                        ->where('billing_status', 1 )
                                        ->sum('billing_plan');
                                    if($milestones_percent >= 100){
                                        $salesOrderItem->sales_order_status = 'billed';
                                        $salesOrderItem->save();
                                    }
                                }
                            }else{
                                throw new Exception('No Milestone Found!', 400);
                            }
                        }

                        if($salesOrderItem->sales_order_type == 'timesheet'){

                            $projectsCost = ProjectCost::where( 'project_id', $salesOrderItem->project_id )
                                ->where( 'task_id', $salesOrderItem->task_id )
                                ->where( 'billing_status', 0 )
                                ->get();
                            $description =  'Project No. '. $salesOrderItem->salesProject->project_Id.'  <br>  ';
                            $total_cost =0;
                            $info = '';
                            foreach ($projectsCost as $cost){
                                if($cost->total_cost > 0){
                                    $total_cost += $cost->total_cost;
                                    $info .= 'Activity Type: '. $cost->activityType->activity_type . ' <br>  ';
                                    $info .= 'Cost Element: '. $cost->activityType->cost_element . ' <br>  ';

                                    $cost->billing_status = 1;
                                    $cost->save();
                                }
                            }
                            $description .= ($info == '') ? 'No Timesheet cost Found!' : $info;
                            if( $total_cost > 0 ){

                                $total_cost += $salesOrderItem->profit_margin * $total_cost / 100;
                                $gross_price += $total_cost;

                                $discount_amount_item =  $salesOrderItem->discount * $total_cost / 100;
                                $discount_amount += $discount_amount_item;

                                $tax_amount_item =  $salesOrderItem->tax * $total_cost / 100;
                                $tax_amount += $tax_amount_item;

                                $total =  $total_cost + $tax_amount_item - $discount_amount_item;
                                $total_price += $total;

                                array_push($billingItem, [
                                    'sales_order_item_id' => $salesOrderItem->sales_order_item_id,
                                    'sales_order_id' => $salesOrderItem->sales_order_id,
                                    'billing_type' => $order->sales_order_type,

                                    'milestone' => 100,
                                    'gross_price' => $total_cost,
                                    'discount_amount' => $discount_amount_item,
                                    'tax_amount' => $tax_amount_item,
                                    'total_price' => $total,
                                    'description' => $description,
                                ]);



                            }else {
                                throw new Exception('No Timesheet cost Found!', 400);
                            }
                        }


                        if($salesOrderItem->sales_order_type == 'goods' || $salesOrderItem->sales_order_type == 'service' ){

                            $gross_price += $salesOrderItem->gross_price + $salesOrderItem->profit_margin_amount;
                            $discount_amount += $salesOrderItem->discount_amount;
                            $tax_amount += $salesOrderItem->tax_amount;
                            $freight_charges += $salesOrderItem->freight_charges;
                            $total_price += $salesOrderItem->total_price;;

                            array_push($billingItem, [
                                'sales_order_item_id' => $salesOrderItem->sales_order_item_id,
                                'sales_order_id' => $salesOrderItem->sales_order_id,
                                'billing_type' => $order->sales_order_type,
                            ]);

                            $salesOrderItem->sales_order_status = 'billed';
                            $salesOrderItem->save();

                        }

                    }
                }
                
                
                $billing = Billing::create([
                    'company_id'        => $user->company_id,
                    'billing_no'        => $no,
                    'customer_id'        => $order->customer,

                    'sales_order_id'    => $request->sales_order_id,
                    'sales_order_no'    => $order->sales_order_no,

                    'due_payment_date'  => Carbon::now()->addDays(30),
                    'billing_type'      => $order->sales_order_type,
                    'billing_status'    => 'created',

                    'gross_price'       => $gross_price,
                    'discount_amount'   => $discount_amount,
                    'tax_amount'        => $tax_amount,
                    'freight_charges'   => $freight_charges,
                    'down_payment'      => ($order->down_payment > 0) ? $order->down_payment : 0,
                    'total_payable'     => ($order->down_payment > 0) ? $total_price - $order->down_payment : $total_price

                ]);

                foreach ($billingItem as $key => $item){
                    $item['billing_id']  = $billing->billing_id;
                    BillingItem::create($item);
                }


                $cogs = GlAccount::byCompany($billing->company_id)->where('type_flag', 'COGS')->first();
                $in01 = GlAccount::byCompany($billing->company_id)->where('type_flag', 'IN01')->first();
                $i0001 = GlAccount::byCompany($billing->company_id)->where('type_flag', 'I0001')->first();
                $gsts = GlAccount::byCompany($billing->company_id)->where('type_flag', 'GSTS')->first();
                $fras = GlAccount::byCompany($billing->company_id)->where('type_flag', 'FRAS')->first();
                $a002 = GlAccount::byCompany($billing->company_id)->where('type_flag', 'A002')->first();

                BillingTransactions::create([

                    'billing_id' => $billing->billing_id,
                    'billing_no' => $billing->billing_no,
                    'company_id' => $billing->company_id,
                    'customer_id' => $billing->customer_id,
                    'sales_order_id' => $billing->sales_order_id,
                    'sales_order_no' => $billing->sales_order_no,

                    'gross_price' => $billing->gross_price,
                    'gross_price_indicator' => 'debit',
                    'gross_price_flag' => !empty($cogs) ? $cogs->type_flag : null,
                    'gross_price_gl_account_id' => !empty($cogs) ? $cogs->gl_account_id : null,

                    'inventory' => $billing->gross_price,
                    'inventory_indicator' => 'credit',
                    'inventory_flag' => !empty($in01) ? $in01->type_flag : null,
                    'inventory_flag_gl_account_id' => !empty($in01) ? $in01->gl_account_id : null,

                    'revenue' => $billing->total_payable,
                    'revenue_indicator' => 'debit',
                    'revenue_flag' => !empty($i0001) ? $i0001->type_flag : null,
                    'revenue_flag_gl_account_id' => !empty($i0001) ? $i0001->gl_account_id : null,

                    'gst' => $billing->tax_amount,
                    'gst_indicator' => 'credit',
                    'gst_flag' =>  !empty($gsts) ? $gsts->type_flag : null,
                    'gst_flag_gl_account_id' =>  !empty($gsts) ? $gsts->gl_account_id : null,

                    'freight' => $billing->total_payable,
                    'freight_indicator' => 'debit',
                    'freight_flag' => !empty($fras) ? $fras->type_flag : null,
                    'freight_flag_gl_account_id' => !empty($fras) ? $fras->gl_account_id : null,

                    'accounts_receivable' => $billing->total_payable,
                    'accounts_receivable_indicator' => 'debit',
                    'accounts_flag' => !empty($a002) ? $a002->type_flag : null,
                    'accounts_flag_gl_account_id' =>  !empty($a002) ? $a002->gl_account_id : null,

                ]);
                

                $ifAnyMoreSalesItem = SalesOrderItem::where('sales_order_id', $request->sales_order_id)
                    ->where( 'sales_order_status', '!=', 'billed' )->get();

                if(empty($ifAnyMoreSalesItem->count())){
                    $order->sales_order_status = 'billed';
                    $order->save();
                }

                if ($billing)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Billing Successfully Created.',
                        'url' => route('billing-single-view', $billing->billing_id)
                    ]);
                }else{
                    throw new Exception('Invalid Information!', 400);
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

    public function view(Billing $billing) {
        if( empty($billing) || $billing->company_id != Auth::user()->company_id ){
            return redirect()->back();
        }

        return view('admin.billing.view', [
            'billing' => $billing,
            'customer' => ($billing->customer_id) ? $billing->customer : [],
            'billingItems' => ($billing->billingItems) ?  $billing->billingItems : [],
            'items' => ($billing->items) ?  $billing->items : [],
        ]);
    }

    public function view_pdf(Billing $billing) {
        if( empty($billing) || $billing->company_id != Auth::user()->company_id ){
            return redirect()->back();
        }

//        return view('admin.billing.pdf', [
//            'billing' => $billing,
//            'customer' => ($billing->customer_id) ? $billing->customer : [],
//            'billingItems' => ($billing->billingItems) ?  $billing->billingItems : [],
//        ]);
        $pdf =  App::make('dompdf.wrapper');
        return $pdf->loadView(
            'admin.billing.pdf',
        [
            'billing' => $billing,
            'customer' => ($billing->customer_id) ? $billing->customer : [],
            'billingItems' => ($billing->billingItems) ?  $billing->billingItems : [],
            'items' => ($billing->items) ?  $billing->items : [],
        ])->save('invoice.pdf')->stream($billing->billing_no .'_billing.pdf');
    }


}
