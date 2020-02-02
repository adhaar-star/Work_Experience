<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class servicemaster extends Model
{
   protected $table = 'service_master';
    protected $fillable = [
        'service_name',
        'service_description',
        'short_text',
        'service_category',
        'service_group',
        'supplier',
        'unit_of_measure',
        'ordering_unit',
        'contractor_name',
        'tax_classification',
        'validity_start',
        'validity_end',
        'standard_rate',
        'currency',
        'status',
       
    ];
    

}
