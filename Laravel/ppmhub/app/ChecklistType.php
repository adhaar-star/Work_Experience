<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChecklistType extends Model
{
    protected $table = 'checklist_type';
    
    protected $fillable = [
        'name',
        'status',
        'company_id'
    ];
}
