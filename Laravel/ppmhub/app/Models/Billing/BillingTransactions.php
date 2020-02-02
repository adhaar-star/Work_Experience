<?php
namespace App\Models\Billing;

use App\Models\Master\Customer;
use Illuminate\Database\Eloquent\Model;
use Auth;

class BillingTransactions extends Model
{

    protected $table = 'billing_transactions';
    protected $primaryKey = 'billing_transaction_is';

    protected $fillable = [
        'company_id',
        'billing_no',
        'billing_id',
        'sales_order_no',
        'sales_order_id',
        'customer_id',

        'gross_price',
        'gross_price_indicator',
        'gross_price_flag',
        'gross_price_gl_account_id',

        'inventory',
        'inventory_indicator',
        'inventory_flag',
        'inventory_flag_gl_account_id',

        'revenue',
        'revenue_indicator',
        'revenue_flag',
        'revenue_flag_gl_account_id',

        'gst',
        'gst_indicator',
        'gst_flag',
        'gst_flag_gl_account_id',

        'freight',
        'freight_indicator',
        'freight_flag',
        'freight_flag_gl_account_id',

        'accounts_receivable',
        'accounts_receivable_indicator',
        'accounts_flag',
        'accounts_flag_gl_account_id',

    ];


    function scopeByCompany($query, $company_id=null)
    {
        $company_id = ($company_id == null) ? Auth::user()->company_id : $company_id;
        return $query->where('company_id', $company_id);
    }

    public function customer()
    {
        return $this->belongsTO(Customer::class, 'customer_id');
    }


    public function scopeSearchBy($query, $request)
    {
        if ($request->get('billing_no')) {
            $query->where('billing_no', $request->get('billing_no'));
        } else {
            if ($request->get('end_date')) {
                $query->whereDate('created_at', '<=', $request->get('end_date'));
            }
            if ($request->get('start_date')) {
                $query->whereDate('created_at', '>=', $request->get('start_date'));
            }
            if ($request->get('billing_type') &&  $request->get('billing_type') != 'all') {
                $query->where('billing_type', $request->get('billing_type'));
            }
        }
        return $query;
    }

}