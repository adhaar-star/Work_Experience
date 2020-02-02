<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Material extends Model
{

    protected $table = 'master_materials';
    protected $primaryKey = 'material_id';

    protected $fillable = [
        'company_id',
        'material_no',

        'material_category_id',
        'material_group_id',
        'order_unit_id',
        'unit_of_measure_id',
        'vendor_id',
        'currency_id',

        'name',
        'description',
        'price',

        'stock_item',
        'min_stock',
        'reorder_quantity',
        'ean_upc_no',
        'tax_classification',
        'gross_weight',
        'net_weight',
        'expiry_date',
        'status',
    ];
    function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    function scopeByCompany($query, $company_id=null)
    {
        $company_id = ($company_id == null) ? Auth::user()->company_id : $company_id;
        return $query->where('company_id', $company_id);
    }

    public function group(){
        return $this->belongsTO(MaterialGroup::class, 'material_group_id');
    }

    public function category(){
        return $this->belongsTO(MaterialCategory::class, 'material_category_id');
    }

    public function vendor(){
        return $this->belongsTO(Vendor::class, 'vendor_id');
    }

    public function getFullInfoAttribute()
    {
        return preg_replace('/\s+/', ' ',$this->material_no.' '.$this->name.'');
    }

}