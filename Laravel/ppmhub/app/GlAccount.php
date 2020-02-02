<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class GlAccount extends Model
{

    protected $table = 'gl_accounts';
    protected $primaryKey = 'gl_account_id';

    protected $fillable = [
        'company_id',
        'sales_order_no',
        'number',
        'gl_account_element_type',
        'gl_account_type',
        'gl_account_tax',
        'description',
        'type_flag',

    ];


    function scopeByCompany($query, $company_id=null)
    {
        $company_id = ($company_id == null) ? Auth::user()->company_id : $company_id;
        return $query->where('company_id', $company_id);
    }

}