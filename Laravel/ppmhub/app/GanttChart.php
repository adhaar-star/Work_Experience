<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Helpers\ProjectHelpers;
use App\OriginalBudget;
use App\Project;
use Carbon\Carbon;

class GanttChart extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     *
       * The attributes that should be mutated to dates.
     *
     * @var array
     */
   public static function projectschart()
    {
$select = 'project_name AS label, DATE_FORMAT(start_date, \'%Y-%m-%d\') as start, DATE_FORMAT(end_date, \'%Y-%m-%d\') as end';
$projects = \App\Project::select(\Illuminate\Support\Facades\DB::raw($select))
                ->orderBy('start', 'asc')
                ->orderBy('end', 'asc')
                ->get();
    
/**
 *  You'll pass data as an array in this format:
 *  [
 *    [ 
 *      'label' => 'The item title',
 *      'start' => '2016-10-08',
 *      'end'   => '2016-10-14'
 *    ]
 *  ]
 */
 return $projects;
}
  
  
}
