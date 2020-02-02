<?php
namespace App\Models\Sales;

use Illuminate\Database\Eloquent\Model;
use Auth;

class SalesOrderComment extends Model
{

    protected $table = 'sales_order_comments';
    protected $primaryKey = 'sales_order_comment_id';

    protected $fillable = [
        'company_id',
        'sales_order_id',
        'user_id',
        'user_type',
        'description',
        'type',
    ];
    function scopeByCompany($query, $company_id=false)
    {
        return $query->where('company_id', ($company_id) ? $company_id : Auth::user()->company_id );
    }
}