<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class accounts_payable extends Model
{

    protected $table = 'accounts_payable';
    protected $fillable = [
        'account_id',
        'account_name',
        'Reference',
        'type',
        'amount',
        'dr_cr_indicator',
        'value',
        'company_id',
    ];

}
