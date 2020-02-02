<?php
namespace App\Models\Sales;

use App\customer_master;
use App\Employee_records;
use App\sales_organization;
use Illuminate\Database\Eloquent\Model;
use Auth;

class SalesDocument extends Model
{

    protected $table = 'sales_documents';
    protected $primaryKey = 'sales_document_id';

    protected $fillable = [
        'company_id',
        'sales_document_no',
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
        'sales_document_type',
        'sales_document_status',

    ];


    function scopeByCompany($query, $company_id=null)
    {
        $company_id = ($company_id == null) ? Auth::user()->company_id : $company_id;
        return $query->where('company_id', $company_id);
    }


    public function customerMaster()
    {
        return $this->belongsTO(customer_master::class, 'customer', 'id');
    }

    public function SalesOrganization()
    {
        return $this->belongsTO(sales_organization::class, 'organization');
    }


    public function items()
    {
        return $this->hasMany(SalesDocumentItem::class, 'sales_document_id');
    }


    public function scopeSearchBy($query, $request)
    {
        if ($request->get('sales_document_no')) {
            $query->where('sales_document_no', $request->get('sales_document_no'));
        } else {
            if ($request->get('end_date')) {
                $query->whereDate('created_at', '<=', $request->get('end_date'));
            }
            if ($request->get('start_date')) {
                $query->whereDate('created_at', '>=', $request->get('start_date'));
            }
            if ($request->get('sales_document_status') &&  $request->get('sales_document_status') != 'all') {
                $query->where('sales_document_status', $request->get('sales_document_status'));
            }
        }
        return $query;
    }



}