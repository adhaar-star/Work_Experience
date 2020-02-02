<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class billing_type extends Model {

  protected $table = 'billing_type';
  public $timestamps  = false;
  protected $fillable = [
      'name',
      'status',
      'company_id',
      'created_at',
      'updated_at'
  ];

}
