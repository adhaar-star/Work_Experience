<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class ProjectNumberRange extends Model
{
    protected $table = 'project_number_range';
    public $timestamps = false;
    protected $fillable = [
        'start_range',
        'end_range',
        'company_id'
    ];
    
    public static function validateRange($post){
        $validationMsg = [
            'start_range.numeric' => 'The start range must be a number.',
            'start_range.required' => 'Please enter start range.',
            'end_range.required' => 'Please enter end range.',
            'end_range.numeric' => 'The end range must be a number.',
        ];

        $validator = Validator::make($post, [
            'start_range' => 'required|numeric',
            'end_range' => 'required|numeric',
                ], $validationMsg);
        return $validator;
    }
}
