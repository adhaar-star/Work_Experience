<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class public_holidays extends Model {

  protected $table = 'public_holidays';
  public $timestamps = false;
  protected $fillable = [
      'date',
      'name_holidays',
      'weekend',
      'company_id',
      'created_by',
      'updated_by',
      'created_at',
      'updated_at',
      'country',
      'state'
  ];
    public function country() {
        return $this->belongsTo(Country::class);
    }
      public function state() {
        return $this->belongsTo(state::class);
    }

}
