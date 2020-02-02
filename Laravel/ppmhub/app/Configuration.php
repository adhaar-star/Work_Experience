<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model {

    protected $table = 'configuration';
    public $timestamps = true;
    protected $fillable = [
        'id',
        'name',
        'user_id',
        'kanban_id',
        'status',
    ];

}
