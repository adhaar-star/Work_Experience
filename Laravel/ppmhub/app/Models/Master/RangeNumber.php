<?php
namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;
use Auth;

class RangeNumber extends Model
{
     const rangeModels = [

        'customer'          => 1,
        'vendor'            => 2,
        'material'          => 3,
        'sales'             => 4,
        'salesOrderItem'    => 5,

        'billing'           => 6,

        'project'           => 7,
        'task'              => 8,
        'phase'             => 9,
        'milestone'         => 10,

        'inquiry'          => 11,
        'inquiryItem'      => 12,
        'quotation'        => 13,
        'quotationItem'    => 14,
    ];

    protected $table = 'master_range_numbers';
    protected $primaryKey = 'master_range_number_id';

    protected $fillable = [
        'company_id',
        'start',
        'end',
        'model',
        'status'
    ];
    
    function scopeByCompany($query, $company_id=null)
    {
        $company_id = ($company_id == null) ? Auth::user()->company_id : $company_id;
        return $query->where('company_id', $company_id);
    }

    function scopeByModel($query, $model)
    {
        return $query->where('model', self::rangeModels[$model]);

    }

}