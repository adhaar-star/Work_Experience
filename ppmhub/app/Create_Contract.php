<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Create_Contract extends Model
{
    protected $table = 'contract';
    public $timestamps = false;
    protected $fillable = [
    'agreement_number',
    'agreement_type',
    'target_value',
    'value_unit',
    'vendor',
    'agreement_date',
    'validity_start',
    'validity_end',
    'quotation_date',
    'quotation_no',
    'sales_contact',
    'description',
    'created_by',
    'created_on',
    'requested_by',
    'status'];
}
