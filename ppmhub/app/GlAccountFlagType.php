<?php
namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class GlAccountFlagType extends Model
{

    protected $table = 'gl_account_flag_types';
    protected $primaryKey = 'gl_account_flag_type_id';

    protected $fillable = [
        'company_id',
        'flag_type'
    ];


    function scopeByCompany($query, $company_id=null)
    {
        $company_id = ($company_id == null) ? Auth::user()->company_id : $company_id;
        return $query->where('company_id', $company_id);
    }

}