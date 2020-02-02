<?php
namespace App\Models\Sales;

use App\Employee_records;
use App\Models\Master\Customer;
use App\Models\Master\Material;
use App\sales_organization;
use Illuminate\Database\Eloquent\Model;
use Auth;

class SalesQuotation extends Model
{

    protected $table = 'sales_quotations';
    protected $primaryKey = 'sales_quotation_id';
    protected $fillable = [
        'company_id',
        'sales_quotation_no',
        'sales_inquiry_id',
        'sales_order_id',
        'customer',

        'region',
        'organization',

        'gross_price',
        'discount_amount',
        'tex_amount',
        'profit_margin_amount',
        'freight_charges',
        'total_price',
        'down_payment',

        'description',
        'requested_by',
        'sales_order_type',
        'status',

        'subject',
        'message',

        'approver_1',
        'approver_2',
        'approver_3',
        'approver_4',
        'approve_status',
    ];

    function scopeByCompany($query, $company_id=null)
    {
        $company_id = ($company_id == null) ? Auth::user()->company_id : $company_id;
        return $query->where('company_id', $company_id);
    }

    public function salesProject()
    {
        return $this->belongsTO(Project::class, 'project_id', 'id');
    }

    public function salesMaterial()
    {
        return $this->belongsTO(Material::class, 'material', 'material_id');
    }

    public function customerMaster()
    {
        return $this->belongsTO(Customer::class, 'customer', 'customer_id');
    }

    public function SalesOrganization()
    {
        return $this->belongsTO(sales_organization::class, 'organization');
    }

    public function items()
    {
        return $this->hasMany(SalesQuotationItem::class, 'sales_quotation_id');
    }

    public function salesOrder()
    {
        return $this->belongsTO(SalesOrder::class, 'sales_quotation_id');
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


    public function scopeSearchBy($query, $request)
    {
        if ($request->get('sales_quotation_no')) {
            $query->where('sales_quotation_no', $request->get('sales_quotation_no'));
        } else {
            if ($request->get('end_date')) {
                $query->whereDate('created_at', '<=', $request->get('end_date'));
            }
            if ($request->get('start_date')) {
                $query->whereDate('created_at', '>=', $request->get('start_date'));
            }
            if ($request->get('status') &&  $request->get('status') != 'all') {
                $query->where('status', $request->get('status'));
            }
        }
        return $query;
    }
}