<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QualitativeMatrix extends Model {

    protected $table = 'qualitative_matrix';
    protected $fillable = [
        'qualitative_likelihood',
        'qualitative_consequence',
        'risk_value',
        'risk_score',
        'company_id'
    ];
    public $timestamps = true;

}
