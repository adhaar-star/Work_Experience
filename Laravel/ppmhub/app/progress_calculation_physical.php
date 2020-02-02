<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class progress_calculation_physical extends Model {

  protected $table = 'progress_calculation_physical';
  public $timestamps = true;
  protected $fillable = [
      'project_id',
      'method',
      'start_date',
      'end_date',
      'planned_progress',
      'actual_progress',
      'planned_cost',
      'actual_cost',
      'BCWS',
      'BCWP',
      'ACWP',
      'cost_variance',
      'schedule_variance',
      'value_index',
      'created_by',
      'changed_by',
      'company_id',
  ];
  protected $editable = [
      'project_id',
      'method',
      'start_date',
      'end_date',
      'planned_progress',
      'actual_progress',
      'planned_cost',
      'actual_cost',
      'BCWS',
      'BCWP',
      'ACWP',
      'cost_variance',
      'schedule_variance',
      'value_index',
      'changed_by',
  ];

  /**
   * Get Planned and Actual Cost
   * @param type $projectId
   * @return type
   */
  public static function getBudgetData($projectId) {
    $plannedcost = $actualcost = array(); 
    $query = progress_calculation_physical::query();
    $budgetData = $query->select('planned_cost', 'actual_cost', DB::raw('DATE_FORMAT(created_at , "%Y,%m,%d") as date '))
        ->where('project_id', $projectId)
        ->get()->toArray();
    
    foreach ($budgetData as $key => $value) {
        $plannedcost[$key]['cost'] = $value['planned_cost'];
        $plannedcost[$key]['date'] = $value['date'];
        $actualcost[$key]['cost'] = $value['actual_cost'];
        $actualcost[$key]['date'] = $value['date'];
    }
    return ['plannedCost'=>$plannedcost,'actualCost'=>$actualcost];

  }

}
