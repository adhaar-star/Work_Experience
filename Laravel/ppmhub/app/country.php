<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class country extends Model {

  protected $table = 'country';
  public $timestamps = true;
  protected $fillable = [
      'country_name',
      'code'
  ];

  /**
   * Relationship with `states` table.
   *
   * @return \Illuminate\Database\Eloquent\Relations\HasMany
   */
  public function state() {
    return $this->hasMany(State::class);
  }

  public function public_holiday() {
    return $this->hasMany(public_holidays::class);
  }

}
