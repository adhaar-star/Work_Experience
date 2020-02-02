<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Portfoliocapacityplanning extends Model {

    protected $table = 'portfolio_capacity_planning';
    public $timestamps = false;
    protected $fillable = [
        'portfolio_id',
        'total_period',
        'distribute',
        'planning_start',
        'planning_end',
        'created_by',
        'created_date',
        'edited_by',
        'edited_date',
        'status',
        'planning_type',
        'view_type',
        'costing_type',
        'collection_type',
        'bucket',
        'currency',
        'company_id'
    ];

    public function portfolio() {
        return $this->belongsTo(Portfolio, 'portfolio_id');
    }

}
