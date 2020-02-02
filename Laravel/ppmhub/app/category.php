<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class category extends Model {

    protected $table = 'category';
    public $timestamps = true;
    protected $fillable = [
        'category_name',
        'company_id',
        'created_at',
        'updated_at',
    ];

}
