<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class customer_inquiry_item extends Model
{
    protected $table = 'customer_inquiry_item';
    
    public $timestamps = false;
            
        protected $fillable = [
            'inquiry_number',
            'status',           
            'project_id',
            'cost_center',
            'tota_amt',
            'item_no',
            'material',
            'customer_material_no',
            'material_description',
            'cost_unit',
            'order_qty',
            'task',
            'material_group',
            'reason',
            'phaseid',
            'company_name',
            'contact_person_name',
            'phone_no',
            'short_description',
            'weight',
            'unit',
            'invoice_number',
            'processing_status',
            'company_id',
            'gross_price',
            'discount',
            'discount_amt',
            'discount_gross_price',
            'sales_tax',
            'sales_taxamt',
            'net_price',
            'freight_charges',
            'total_price',
            'created_on',
            'changed_on',
            'changed_by',
            'created_by'
            
        ];
        
    

}
