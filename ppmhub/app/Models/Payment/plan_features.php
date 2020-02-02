<?php

namespace App\Models\Payment;

use Illuminate\Database\Eloquent\Model;

class plan_features extends Model {

   protected $fillable = ['plan_id', 'admin', 'user', 'project'];

}
