<?php
namespace App\Models\Sales;

use App\customer_master;
use App\Employee_records;
use App\Models\Billing\Billing;
use App\Models\Master\Customer;
use App\sales_organization;
use Illuminate\Database\Eloquent\Model;
use Auth;

class SalesOrder extends Model
{

    protected $table = 'sales_orders';
    protected $primaryKey = 'sales_order_id';

    protected $fillable = [
        'company_id',
        'sales_order_no',
        'customer',

        'region',
        'inquiry',
        'quotation',
        'organization',

        'gross_price',
        'discount_amount',
        'tex_amount',
        'profit_margin_amount',
        'freight_charges',
        'total_price',
        'down_payment',

        'description',
        'sales_order_type',
        'sales_order_status',
        'requested_by',

        'approver_1',
        'approver_2',
        'approver_3',
        'approver_4',

        'total_recurring_period',
        'recurring_period',
        'auto_billing',
        'auto_billing_date',
    ];


    function scopeByCompany($query, $company_id=null)
    {
        $company_id = ($company_id == null) ? Auth::user()->company_id : $company_id;
        return $query->where('company_id', $company_id);
    }

    function scopeIsApproved($query)
    {
        return $query->where('sales_order_status', 'approved');
    }
    

    public function customerMaster()
    {
        return $this->belongsTO(Customer::class, 'customer', 'customer_id');
    }

    public function SalesOrganization()
    {
        return $this->belongsTO(sales_organization::class, 'organization');
    }

    public function SalesApprover1()
    {
        return $this->belongsTO(Employee_records::class, 'approver_1');
    }

    public function SalesApprover2()
    {
        return $this->belongsTO(Employee_records::class, 'approver_2');
    }
    public function SalesApprover3()
    {
        return $this->belongsTO(Employee_records::class, 'approver_3');
    }
    public function SalesApprover4()
    {
        return $this->belongsTO(Employee_records::class, 'approver_4');
    }

    public function items()
    {
        return $this->hasMany(SalesOrderItem::class, 'sales_order_id');
    }

    public function billing()
    {
        return $this->hasOne(Billing::class, 'sales_order_id', 'sales_order_id');
    }


    public function scopeSearchBy($query, $request)
    {
        if ($request->get('sales_order_no')) {
            $query->where('sales_order_no', $request->get('sales_order_no'));
        } else {
            if ($request->get('end_date')) {
                $query->whereDate('created_at', '<=', $request->get('end_date'));
            }
            if ($request->get('start_date')) {
                $query->whereDate('created_at', '>=', $request->get('start_date'));
            }
            if ($request->get('sales_order_status') &&  $request->get('sales_order_status') != 'all') {
                $query->where('sales_order_status', $request->get('sales_order_status'));
            }
        }
        return $query;
    }



}