<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class group extends Model
{
    protected $table = 'group';
    public $timestamps = true;
    protected $fillable = [
        'group_name',
        'company_id',
        'created_at',
        'updated_at',
    ];
}
