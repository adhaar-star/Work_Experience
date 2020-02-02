<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RevenueProductSales extends Model
{
    protected $table = 'revenue_product_sales_cost';
    public $timestamps = false;
    protected $fillable = [
        'project_number',
        'material_number',
        'description',
        'quantity',
        'revenue_type',
        'unit_price',
        'currency',
        'total_price',
        
    ];
}
