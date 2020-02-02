<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Manual_financial extends Model {

  protected $table = 'manual_financial';
  protected $fillable = [
      'portfolio',
      'bucket',
      'category',
      'group',
      'view',
      'planning_unit',
      'amount',
      'start_date',
      'end_date',
      'status',
      'company_id'
  ];
  public $timestamps = true;

  public static function validateManualFinancialCapacity($post) {
    $validationmessages = [
        'portfolio.required' => 'Please select portfolio',
        'bucket.required' => 'Please select bucket',
        'amount.required' => 'Please enter hours/day',
        'category.required' => 'Please select category',
        'group.required' => 'Please select group',
        'view.required' => 'Please select view',
        'start_date.required' => 'Please select start date',
        'end_date.required' => 'Please select end date',
        'planning_unit.required' => 'Please select planning unit',
    ];

    $validator = Validator::make($post, [
          'portfolio' => 'required',
          'bucket' => 'required',
          'amount' => 'required',
          'category' => 'required',
          'group' => 'required',
          'view' => 'required',
          'start_date' => 'required',
          'end_date' => 'required',
          'planning_unit' => 'required',
        ], $validationmessages);
    return $validator;
  }

}
