<?php
namespace App\Models\Billing;

use App\Models\Master\Customer;
use App\Models\Sales\SalesOrderItem;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Billing extends Model
{

    protected $table = 'billings';
    protected $primaryKey = 'billing_id';

    protected $fillable = [
        'company_id',
        'billing_no',
        'sales_order_no',
        'sales_order_id',
        'customer_id',

        'gross_price',
        'discount_amount',
        'tax_amount',
        'freight_charges',
        'down_payment',
        'total_payable',

        'due_payment_date',
        'billing_type',
        'billing_status',
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


    public function billingItems()
    {
        return $this->belongsToMany(SalesOrderItem::class, 'billing_items', 'billing_id', 'sales_order_item_id');
    }

    public function items()
    {
        return $this->hasMany(BillingItem::class,  'billing_id');
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