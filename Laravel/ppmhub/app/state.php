<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class state extends Model {

  protected $table = 'state';
  protected $fillable = [
      'state_name',
      'country_id'
  ];

  /**
   * Relationship with `countries` table.
   *
   * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
   */
  public function country() {
    return $this->belongsTo(Country::class);
  }

  public function public_holiday() {
    return $this->hasMany(public_holidays::class);
  }

}
