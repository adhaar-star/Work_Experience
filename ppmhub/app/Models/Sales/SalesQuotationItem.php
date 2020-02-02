<?php
namespace App\Models\Sales;

use App\Models\Master\Material;
use App\Project;
use Illuminate\Database\Eloquent\Model;
use Auth;

class SalesQuotationItem extends Model
{

    protected $table = 'sales_quotation_items';
    protected $primaryKey = 'sales_quotation_item_id';
    protected $fillable = [
        'company_id',
        'sales_quotation_id',
        'sales_quotation_item_no',

        'project_id',
        'task_id',
        'phase_id',
        'cost_center_id',

        'material',
        'material_no',
        'material_quantity',
        'unit_price',

        'gross_price',
        'discount',
        'discount_amount',
        'tax',
        'tax_amount',
        'profit_margin',
        'profit_margin_amount',
        'freight_charges',
        'total_price',

        'company_name',
        'company_contact_person',
        'company_contact_phone',

        'delivery_date',
        'description',
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



}