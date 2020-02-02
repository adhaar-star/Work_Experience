<?php
namespace App\Models\Sales;

use App\customer_master;
use App\materialmaster;
use App\Models\Master\Material;
use App\Project;
use Illuminate\Database\Eloquent\Model;
use Auth;

class SalesOrderItem extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'sales_order_items';
    protected $primaryKey = 'sales_order_item_id';

    protected $fillable = [
        
        'company_id',
        'sales_order_id',
        'sales_order_item_no',

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
        'delivery_info',
        'description',
        'sales_order_type',
        'sales_order_status',
    ];


    function scopeByCompany($query, $company_id=null)
    {
        $company_id = ($company_id == null) ? Auth::user()->company_id : $company_id;
        return $query->where('company_id', $company_id);
    }

    function scopeIsDelivered($query)
    {
        return $query->where('sales_order_status', 'delivery');
    }

    public function salesProject()
    {
        return $this->belongsTO(Project::class, 'project_id', 'id');
    }

    public function order()
    {
        return $this->belongsTO(SalesOrder::class, 'sales_order_id');
    }

    public function salesMaterial()
    {
        return $this->belongsTO(Material::class, 'material', 'material_id');
    }


}