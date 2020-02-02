<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class purchase_item extends Model
{
    protected $table = 'purchase_item';
    
    public $timestamps = false;
            
        protected $fillable = [
            'status',
            'requisition_number',
            'item_no',
            'item_category',
            'material', 
            'material_description',
            'item_quantity',
            'quantity_unit',
            'item_cost',
            'currency',
            'delivery_date',
            'material_group',
            'vendor' ,
            'requestor',
            'contract_number',
            'contract_item_number',
            'purchase_order_number',
            'project_id',
            'phase_id',
            'task_id',
            'g_l_account',
            'cost_center',
            'created_by',
            'created_on',
            'changed_by',
            'processing_status',
            'title',
            'name',
            'add1',
            'add2',
            'postal_code',
            'country',
            'company_id'

  
        ];
        
    

}
