<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class view extends Model
{
    protected $table = 'view';
    public $timestamps = true;
    protected $fillable = [
        'view_name',
        'company_id',
        'created_at',
        'updated_at',
    ];
}
