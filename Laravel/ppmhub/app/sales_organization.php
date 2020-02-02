<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class sales_organization extends Model {

    protected $table = 'salesorganization';
    public $timestamps = false;
    protected $fillable = [
        'sales_organization',
        'status',
        'company_id',
        'created_at',
        'updated_at'
    ];

    function scopeByCompany($query, $company_id)
    {
        return $query->where('company_id', $company_id);
    }
}
