<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Model;

class user_subscription extends Model
{
   protected $table = 'user_subscription';
   protected $primaryKey = 'subscription_Id';
   
   protected $fillable = ['company_id',
       'braintree_subscription_id',
       'braintree_subscription_plan',
       'braintree_subscription_price',
       'next_billing_date','ends_at'];
}

