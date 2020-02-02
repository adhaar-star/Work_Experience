<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;
class reasonRejection extends Model {

    protected $table = 'reason_rejection';
    public $timestamps = false;
    protected $fillable = [
        'reason_rejection',
        'status',
        'company_id',
        'created_at',
        'updated_at'
    ];

    function scopeByCompany($query, $company_id=false)
    {
        return $query->where('company_id', ($company_id) ? $company_id : Auth::user()->company_id );
    }

}
