<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Auth;

class MaterialCategory extends Model
{

    protected $table = 'master_material_categories';
    protected $primaryKey = 'material_category_id';

    protected $fillable = [
        'company_id',
        'name',
        'status'
    ];

    function scopeByCompany($query, $company_id=null)
    {
        $company_id = ($company_id == null) ? Auth::user()->company_id : $company_id;
        return $query->where('company_id', $company_id);
    }

    function scopeActive($query)
    {
        return $query->where('status', 1);
    }

}