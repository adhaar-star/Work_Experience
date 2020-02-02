<?php
namespace App\Models\Sales;

use App\customer_master;
use App\Models\Master\Customer;
use App\sales_organization;
use Illuminate\Database\Eloquent\Model;
use Auth;

class SalesInquiry extends Model
{

    protected $table = 'sales_inquiries';
    protected $primaryKey = 'sales_inquiry_id';

    protected $fillable = [

        'company_id',
        'sales_inquiry_no',
        'sales_quotation_id',
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
        return $this->hasMany(SalesInquiryItem::class, 'sales_inquiry_id');
    }

    public function quotation()
    {
        return $this->belongsTO(SalesQuotation::class, 'sales_quotation_id');
    }

    public function scopeSearchBy($query, $request)
    {
        if ($request->get('sales_inquiry_no')) {
            $query->where('sales_inquiry_no', $request->get('sales_inquiry_no'));
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