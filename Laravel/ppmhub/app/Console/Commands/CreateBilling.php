<?php

namespace App\Console\Commands;


use App\Models\Billing\Billing;
use App\Models\Billing\BillingItem;
use App\Models\Billing\BillingTransactions;
use App\Models\Master\RangeNumber;
use App\Models\Sales\SalesOrder;
use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;

class CreateBilling extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'CreateBilling';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Billing ';


    public function __construct()
    {
        parent::__construct();
    }

    protected function getRangeNumber($max_number, $model, $company_id){
        $customer_number = null;
        $range = RangeNumber::where('company_id', $company_id)->ByModel($model)->first();
        if(!empty($range)){
            if ($max_number == null || $max_number == 0 || $max_number <  $range->start) {
                $customer_number =  $range->start;
            }else{
                $customer_number = $max_number + 1;
                if ($customer_number > $range->end) {
                    $customer_number = null;
                    $this->info('Please change end range of  number range in settings');
                }
            }
            return $customer_number;
        }else{
            $this->info('Please Update range in settings');
            return $customer_number;
        }
    }

    public function handle()
    {

        $orders = SalesOrder::isApproved()
            ->where('auto_billing', 1)
            ->where('auto_billing_date', Carbon::now()->format('Y-m-d') )
            ->take(20)
            ->get();

        if($orders->count() > 0){

            foreach ($orders as $order){

                $max_number = Billing::max('billing_no');
                $no = $this->getRangeNumber($max_number, 'billing', $order->company_id);
                if($no){

                    DB::beginTransaction();

                    $gross_price = 0;
                    $discount_amount = 0;
                    $tax_amount =0;
                    $freight_charges =0;
                    $total_price = 0;
                    $billingItem =[];

                    foreach ($order->items as $salesOrderItem):
                        if($salesOrderItem->sales_order_status == 'delivery'){
                            if($salesOrderItem->sales_order_type == 'goods' || $salesOrderItem->sales_order_type == 'service' ){

                                $gross_price += $salesOrderItem->gross_price + $salesOrderItem->profit_margin_amount;
                                $discount_amount += $salesOrderItem->discount_amount;
                                $tax_amount += $salesOrderItem->tax_amount;
                                $freight_charges += $salesOrderItem->freight_charges;
                                $total_price += $salesOrderItem->total_price;

                                array_push($billingItem, [
                                    'sales_order_item_id' => $salesOrderItem->sales_order_item_id,
                                    'sales_order_id' => $salesOrderItem->sales_order_id,
                                    'billing_type' => $order->sales_order_type,
                                ]);
                                $salesOrderItem->sales_order_status = 'billed';
                                $salesOrderItem->save();
                            }
                        }
                    endforeach;

                    if($total_price > 0){

                        $billing = Billing::create([
                            'company_id'        => $order->company_id,
                            'billing_no'        => $no,
                            'customer_id'        => $order->customer,

                            'sales_order_id'    => $order->sales_order_id,
                            'sales_order_no'    => $order->sales_order_id,

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

                        BillingTransactions::create([

                            'billing_id' => $billing->billing_id,
                            'billing_no' => $billing->billing_no,
                            'company_id' => $billing->company_id,
                            'customer_id' => $billing->customer_id,
                            'sales_order_id' => $billing->sales_order_id,
                            'sales_order_no' => $billing->sales_order_no,

                            'gross_price' => $billing->gross_price,
                            'gross_price_indicator' => 'debit',
                            'gross_price_flag' => 'COGS',

                            'inventory' => $billing->gross_price,
                            'inventory_indicator' => 'credit',
                            'inventory_flag' => 'IN01',

                            'revenue' => $billing->total_payable,
                            'revenue_indicator' => 'debit',
                            'revenue_flag' => 'I0001',

                            'gst' => $billing->tax_amount,
                            'gst_indicator' => 'credit',
                            'gst_flag' => 'GSTS',

                            'freight' => $billing->total_payable,
                            'freight_indicator' => 'debit',
                            'freight_flag' => 'FRAS',

                            'accounts_receivable' => $billing->total_payable,
                            'accounts_receivable_indicator' => 'debit',
                            'accounts_flag' => 'A002',

                        ]);


                        $billingCount = Billing::where('sales_order_id', $order->sales_order_id)->count();
                        if( $billingCount >= $order->total_recurring_period ){
                            $order->sales_order_status = 'billed';
                            $order->save();
                        }else{
                            $order->auto_billing_date = Carbon::now()->addDays($order->recurring_period);
                            $order->save();
                        }
                    }
                }

            }
        }else {
            $this->info('No Billing Found.');
        }


    }


}
