<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Projecttask extends Model {

  /**
   * The attributes that should be mutated to dates.
   *
   * @var array
   */
  protected $table = 'tasks_subtask';
  public $timestamps = false;
  protected $fillable = [
      'task_Id',
      'task_name',
      'task_type',
      'project_id',
      'phase_id',
      'sub_task_id',
      'start_date',
      'end_date',
      'a_start_date',
      'l_start_date',
      'l_end_date',
      'e_start_date',
      'e_end_date',
      'a_end_date',
      'r_start_date',
      'r_end_date',
      'resource_name',
      'duration',
      'total_demand',
      'persion_responsible',
      'phase_approval',
      'ref_template',
      'ref_task',
      'created_date',
      'modified_date',
      'created_by',
      'modified_by',
      'status',
      'is_deleted',
      'parent_id',
      'company_id',
      'planned_cost',
      'actual_cost',
      'weighting_factor',
      'completion',
      'confirmed_work',
      'remaining_work',
      'successor_task_id',
      'pre_task_id'
  ];

  /*
   * public function customer()
   * {
   * return $this->hasOne('App\Customer', 'id', 'customer_id');
   * }
   *
   *
   * public function user()
   * {
   * return $this->hasOne('App\User', 'id', 'user_id');
   * }
   *
   *
   * public function status()
   * {
   * return $this->hasOne('App\Status', 'id', 'status_id');
   * }
   * public function plan()
   * {
   * return $this->hasOne('App\Plans', 'id', 'plan_id');
   * }
   */

   public function taskproject() {
    return $this->belongsTo(Project::class, 'project_id', 'project_Id');
  }
  public function project() {
    return $this->belongsTo(Project::class, 'project_id', 'project_Id');
  }

  public function parent()
  {
  return $this->belongsTo('App\Projectphase', 'phase_id');

    }
 public function parent2()
  {
  return $this->belongsTo('App\Projectphase', 'phase_id')->select(array('phase_name'));

    }
public function children() {
  return $this->hasMany('App\Projecttask', 'parent_id');
}

public function children_rec() {
  return $this->children()->with('children_rec');
}

}
