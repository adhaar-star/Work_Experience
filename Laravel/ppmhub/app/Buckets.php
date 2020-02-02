<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laraveldaily\Quickadmin\Observers\UserActionsObserver;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use App\Helpers\ProjectHelpers;
use DateTime;
use App\Employee_records;

class Buckets extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'buckets';
    protected $fillable = [
        'name',
        'bucket_id',
        'portfolio_id',
        'parent_bucket',
        'costcentretype',
        'department',
        'currency',
        'description',
        'created_by',
        'created_at',
        'updated_by',
        'updated_at',
        'company_id',
        'status',
        'is_delete'
    ];

    /* public function main_category()
      {
      return $this->belongsTo('App\Buckets', 'parent_bucket');
      }

      public function children()
      {
      return $this->hasMany('App\Buckets', 'parent_bucket');
      } */

    public function currency()
    {
        return $this->hasOne('App\Currency', 'short_code', 'currency');
    }

    public function type()
    {
        return $this->hasOne('App\Portfoliotype', 'id', 'type');
    }

    public function buckets()
    {
        return $this->hasOne('App\Buckets', 'id', 'buckets');
    }

    public function department_name()
    {
        return $this->belongsTo('App\Departmenttype', 'department');
    }

    public function costcentre_name()
    {
        return $this->belongsTo('App\Costcentretype', 'costcentretype');
    }

    public function portfolio()
    {
        return $this->belongsTo('App\Portfolio', 'portfolio_id');
    }

    public function project()
    {
        return $this->hasMany('App\Project', 'bucket_id');
    }

    public function parent()
    {
        return $this->belongsTo('App\Buckets', 'parent_bucket');
    }
    
    public function parent_rec()
    {
        return $this->belongsTo('App\Buckets', 'parent_bucket')->with('parent_rec');
    }

public function children()
{
    return $this->hasMany('App\Buckets', 'parent_bucket');
}

public function children_rec()
{
    return $this->children()->where('company_id', Auth::user()->company_id)->with('children')->with('project')->with('portfolio')->with('department_name')->with('costcentre_name')->with('currencyname')->with('children_rec');
}

public function children_new_rec()
{
    return $this->children()->where('company_id', Auth::user()->company_id)->with('children_new_rec');
}

public function currencyname()
{
    return $this->hasOne('App\Currency', 'id', 'currency');
}

public function creator()
{
    return $this->hasOne('App\User', 'id', 'created_by');
}

public function updator()
{
    return $this->hasOne('App\User', 'id', 'updated_by');
}

public static function bucketDemand($buckets)
{
    $roleFunArray = array();
    $bucketDemandArray = array();
    //Iterate each bucket for total demand calculations
    foreach ($buckets as $key => $value) {
        $bucketDemandArray[$key]['bucketName'] = $value['name'];
        $bucketDemandArray[$key]['bucketId'] = $value['id'];
        $bucket_id = $value['id'];
        //find project added in buckets
        $projects = Project::projectByBucket($bucket_id);
        //Iterate each project for task and person assignment
        foreach ($projects as $pKey => $proj) {
//                $totalDemand = Project::totalDemandByProject($proj->project_Id, Auth::user()->company_id);
            $personAssign = Project::personAssignmentByProject($proj->id);

            $roleArr = array();
            foreach ($personAssign as $paKey => $person) {
                $role = Createrole::Where('id', $person->role)->first();
                $task = TasksSubtask::Where('id', $person->task)->first();
                $demand = isset($task) ? $task->total_demand : 0;
                if (isset($role)) {
                    $role = $role->toArray();
                    if (array_key_exists('role_fun', $role) && count($role) > 0) {
                        if (!in_array($role['role_fun'], $roleFunArray)) {
                            array_push($roleFunArray, $role['role_fun']);
                            $bucketDemandArray[$key]['project'][$pKey][$role['role_fun']] = array();
                            $bucketDemandArray[$key]['project'][$pKey][$role['role_fun']][$role['role_name']] = $demand;
                        } else {
                            $bucketDemandArray[$key]['project'][$pKey][$role['role_fun']][$role['role_name']] = $demand;
                        }
                    }
                }
            }
        }
    }
    $bucketDemandArray = self::formatBucketDemand($bucketDemandArray);
    return $bucketDemandArray;
}

public static function formatBucketDemand($bucketDemandArray)
{
    $bucketArray = array();
    foreach ($bucketDemandArray as $bKey => $bucket) {
        $bucketArray[$bucket['bucketId']]['id'] = $bucket['bucketId'];
        $bucketArray[$bucket['bucketId']]['bucket'] = $bucket['bucketName'];
        if (array_key_exists('project', $bucket)) {
            $categoryArr = array();
            $bucketArray[$bucket['bucketId']]['children'] = array();
            foreach ($bucket['project'] as $pKey => $project) {
                if (is_array($project) && isset($project)) {

                    foreach ($project as $cKey => $role) {
                        if (!array_key_exists($cKey, $bucketArray[$bucket['bucketId']]['children'])) {
                            $bucketArray[$bucket['bucketId']]['children'][$cKey] = $role;
                        } else {
                            $bucketArray[$bucket['bucketId']]['children'][$cKey] = array_merge($bucketArray[$bucket['bucketId']]['children'][$cKey], $role);
                        }
                    }
                }
            }
        } else {
            $bucketArray[$bucket['bucketId']]['children'] = array();
        }
    }
    return $bucketArray;
}

public static function capacityPlanning($bucketsList)
{
    $capacityBucketArray = array();
    foreach ($bucketsList as $key => $bucket) {
        $capacityBucketArray[$key]['name'] = $bucket['name'];
        $projects = Project::projectByBucket($bucket['id']);
        $capacityBucketArray[$key]['projectCount'] = $projects->count();
        $assignedCost = 0;
        if($projects->count() > 0){
            foreach ($projects as $pKey => $proj) {

                $capacityBucketArray[$key]['projects'][$pKey]['projectName'] = $proj->project_name;
                $plannedCost = ProjectHelpers::get_project_planned_cost($proj->project_Id);

                $personAssign = Project::personAssignmentByProject($proj->id);
                $assignedTask = taskAssignment::taskAssignedByProject($proj->id);

                $demandAssignTask = self::assignedTaskDemand($assignedTask);
                $personAssignResouces = self::personAssignmentResouces($personAssign, $assignedCost);
                
                $demandRolesCategory = $actualRoleCategory = Createrole::Select('role_fun as category')->Where('project_id', $proj->id)->distinct()->pluck("category")->toArray();
                $demandRolesGroup = $actualRolesGroup = Createrole::Select('role_name as group')->Where('project_id', $proj->id)->distinct()->pluck("group")->toArray();

                //Demand
                $actualProject = ProjectHelpers::getActualCostingData($proj->id);
                $capacityBucketArray[$key]['projects'][$pKey]['demand']['hours'] = $demandAssignTask;
                $capacityBucketArray[$key]['projects'][$pKey]['demand']['cost'] = $plannedCost;
                $capacityBucketArray[$key]['projects'][$pKey]['demand']['category'] = $demandRolesCategory;
                $capacityBucketArray[$key]['projects'][$pKey]['demand']['group'] = $demandRolesGroup;
                
                //Assigned
                $capacityBucketArray[$key]['projects'][$pKey]['assigned']['hours'] = $personAssignResouces['assignTaskHours'];
                $capacityBucketArray[$key]['projects'][$pKey]['assigned']['cost'] = $personAssignResouces['assignedCost'];
                $capacityBucketArray[$key]['projects'][$pKey]['assigned']['category'] = $personAssignResouces['assignedRoleCategory'];
                $capacityBucketArray[$key]['projects'][$pKey]['assigned']['group'] = $personAssignResouces['assignedRoleGroup'];
                
                //Actual
                $capacityBucketArray[$key]['projects'][$pKey]['actual']['hours'] = $actualProject['hours'];
                $capacityBucketArray[$key]['projects'][$pKey]['actual']['cost'] = $actualProject['cost'];
                $capacityBucketArray[$key]['projects'][$pKey]['actual']['category'] = $actualRoleCategory;
                $capacityBucketArray[$key]['projects'][$pKey]['actual']['group'] = $actualRolesGroup;
            }
        }else{
            $capacityBucketArray[$key]['projects'][0]['projectName'] = 'N/A';
            
            $capacityBucketArray[$key]['projects'][0]['demand']['hours'] = $capacityBucketArray[$key]['projects'][0]['demand']['cost'] = 0;
            $capacityBucketArray[$key]['projects'][0]['demand']['category'] = $capacityBucketArray[$key]['projects'][0]['demand']['group'] = array();
            
            $capacityBucketArray[$key]['projects'][0]['assigned']['hours'] = $capacityBucketArray[$key]['projects'][0]['assigned']['cost'] = 0;
            $capacityBucketArray[$key]['projects'][0]['assigned']['category'] = $capacityBucketArray[$key]['projects'][0]['assigned']['group'] = array();
            
            $capacityBucketArray[$key]['projects'][0]['actual']['hours'] = $capacityBucketArray[$key]['projects'][0]['actual']['cost'] = 0;
            $capacityBucketArray[$key]['projects'][0]['actual']['category'] = $capacityBucketArray[$key]['projects'][0]['actual']['group'] = array();
            
            $capacityBucketArray[$key]['projects'][0]['forecast']['hours'] = $capacityBucketArray[$key]['projects'][0]['forecast']['cost'] = 0;
            $capacityBucketArray[$key]['projects'][0]['forecast']['category'] = $capacityBucketArray[$key]['projects'][0]['forecast']['group'] = array();
            
            if (array_key_exists('children_rec', $bucket) && array_key_exists('parent_bucket', $bucket) && count($bucket['children_rec'] > 0)) {
                $assignedCost = 0;
                $capacityBucketArray = self::bucketRecursive($capacityBucketArray, $key, $bucket['children_rec'], $assignedCost);
            }
        }
    }
    return $capacityBucketArray;
}

public static function bucketRecursive($capacityBucketArray, $bKey, $buckets, $assignedCost){
    foreach ($buckets as $key => $subBucket) {
        $projects = Project::projectByBucket($subBucket['id']);
        if($projects->count() > 0){
            foreach ($projects as $pKey => $proj) {

                
                $capacityBucketArray[$key]['projects'][0]['projectName'] = 'N/A';
                $plannedCost = ProjectHelpers::get_project_planned_cost($proj->project_Id);

                $personAssign = Project::personAssignmentByProject($proj->id);
                $assignedTask = taskAssignment::taskAssignedByProject($proj->id);

                $demandAssignTask = self::assignedTaskDemand($assignedTask);
                $personAssignResouces = self::personAssignmentResouces($personAssign, $assignedCost);
                
                $demandRolesCategory = $actualRoleCategory = Createrole::Select('role_fun as category')->Where('project_id', $proj->id)->distinct()->pluck("category")->toArray();
                $demandRolesGroup = $actualRolesGroup = Createrole::Select('role_name as group')->Where('project_id', $proj->id)->distinct()->pluck("group")->toArray();

                //Demand
                $actualProject = ProjectHelpers::getActualCostingData($proj->id);
                
                $capacityBucketArray[$bKey]['projects'][0]['demand']['hours'] += $demandAssignTask;
                $capacityBucketArray[$bKey]['projects'][0]['demand']['cost'] += $plannedCost;
                $capacityBucketArray[$bKey]['projects'][0]['demand']['category'] = self::pushToArray($capacityBucketArray[$bKey]['projects'][0]['demand']['category'], $demandRolesCategory);
                $capacityBucketArray[$bKey]['projects'][0]['demand']['group'] = self::pushToArray($capacityBucketArray[$bKey]['projects'][0]['demand']['group'], $demandRolesGroup);
                
                //Assigned
                $capacityBucketArray[$bKey]['projects'][0]['assigned']['hours'] += $personAssignResouces['assignTaskHours'];
                $capacityBucketArray[$bKey]['projects'][0]['assigned']['cost'] += $personAssignResouces['assignedCost'];
                $capacityBucketArray[$bKey]['projects'][0]['assigned']['category'] = self::pushToArray($capacityBucketArray[$bKey]['projects'][0]['assigned']['category'], $personAssignResouces['assignedRoleCategory']);
                $capacityBucketArray[$bKey]['projects'][0]['assigned']['group'] = self::pushToArray($capacityBucketArray[$bKey]['projects'][0]['assigned']['group'], $personAssignResouces['assignedRoleGroup']);
              
                //Actual
                $capacityBucketArray[$bKey]['projects'][0]['actual']['hours'] += $actualProject['hours'];
                $capacityBucketArray[$bKey]['projects'][0]['actual']['cost'] += $actualProject['cost'];
                $capacityBucketArray[$bKey]['projects'][0]['actual']['category'] = self::pushToArray($capacityBucketArray[$bKey]['projects'][0]['actual']['category'], $actualRoleCategory);
                $capacityBucketArray[$bKey]['projects'][0]['actual']['group'] = self::pushToArray($capacityBucketArray[$bKey]['projects'][0]['actual']['group'], $actualRolesGroup);
                
            }
        }else{
            if (array_key_exists('children_rec', $subBucket) && array_key_exists('parent_bucket', $subBucket) && count($subBucket['children_rec'] > 0)) {
                $capacityBucketArray = self::bucketRecursive($capacityBucketArray,$bKey, $subBucket['children_rec'], $assignedCost);
            }
        }
         
    }
    return $capacityBucketArray;
}

public static function pushToArray($parentArray, $childArray){
    foreach ($childArray as $dRoleCat) {
        if (!in_array($dRoleCat, $parentArray))
            array_push($parentArray, $dRoleCat);
    }
    return $parentArray;
}

public static function projectCapacityResource($projectId){
    $projectResourceCapacity = array();
    $personAssign = Project::personAssignmentByProject($projectId);
    $assignedTask = taskAssignment::taskAssignedByProject($projectId);
    
    $demandTaskHours = $assignTaskHours = 0;
    foreach ($assignedTask as $aKey => $aTask) {
        $task = TasksSubtask::Where('id', $aTask->task)->first();
        $demandTaskHours += isset($task) ? $task->total_demand : 0;
    }

    foreach ($personAssign as $paKey => $person) {
        //get assign hours of project
        $daysDiff = date_diff(new DateTime($person->start_date), new DateTime($person->end_date));
        $daysWorked = $daysDiff->d + 1;
        for ($day = 1; $day <= $daysWorked; $day++) {
            $assignTaskHours += $person->{'day' . $day};
        }
    }
    $actualProject = ProjectHelpers::getActualCostingData($projectId);

    return array('demand' => $demandTaskHours, 'assigned' => $assignTaskHours, 'actual' => $actualProject['hours'], 'forecast' => 0);
}
public static function projectsResouces($projects)
{
    $roleUpData = array('demand' => 0, 'assigned' => 0, 'actual' => 0, 'forecast' => 0);
    foreach ($projects as $pKey => $proj) {
        $projectCap = self::projectCapacityResource($proj['id']);
        
        $roleUpData['demand'] += $projectCap['demand'];
        $roleUpData['assigned'] += $projectCap['assigned'];
        $roleUpData['actual'] += $projectCap['actual'];
        $roleUpData['forecast'] += $projectCap['forecast'];
    }

    return $roleUpData;
}
public static function findBucketCapacity($bucketResourceCapacity, $bucket, $filter){

    $projects = Project::projectsByCategory($filter, $bucket['id']);
    
    $manualResourceCapacity = Manual_capacity::Where('bucket', $bucket['id'])->get(); 
    foreach($manualResourceCapacity as $manCap){
        if($manCap->view == 'Demand')
            $bucketResourceCapacity['manDemand'] += $manCap->hours_day;
        else if($manCap->view == 'Assigned')
            $bucketResourceCapacity['manAssigned'] += $manCap->hours_day;
        else if($manCap->view == 'Actual')
            $bucketResourceCapacity['manActual'] += $manCap->hours_day;
        else if($manCap->view == 'Forecast')
            $bucketResourceCapacity['manForecast'] += $manCap->hours_day;
    }
    $projectResourcesCap = Buckets::projectsResouces($projects);
    
    $bucketResourceCapacity['demand'] += $projectResourcesCap['demand'];
    $bucketResourceCapacity['assigned'] += $projectResourcesCap['assigned'];
    $bucketResourceCapacity['actual'] += $projectResourcesCap['actual'];
    $bucketResourceCapacity['forecast'] += $projectResourcesCap['forecast'];
    
    if(array_key_exists('children_rec', $bucket) && array_key_exists('parent_bucket', $bucket) && count($bucket['children_rec'] > 0)){
        foreach ($bucket['children_rec'] as $key => $subBucket) {
            $bucketResourceCapacity = self::findBucketCapacity($bucketResourceCapacity, $subBucket, $filter);
        }
    }
    
    return $bucketResourceCapacity;
}

public static function recursiveBucket($loweMostBucketsArray, $buckets)
{
    foreach ($buckets as $key => $value) {
        $subBucketCount = Buckets::Where('parent_bucket', $value['id'])->count();
        if ($subBucketCount == 0)
            array_push($loweMostBucketsArray, array('id' => $value['id'], 'name' => $value['name']));

        if (array_key_exists('children_rec', $value)) {
            $loweMostBucketsArray = self::recursiveBucket($loweMostBucketsArray, $value['children_rec']);
        }
    }
    return $loweMostBucketsArray;
}

/**
 * Retrive total demand of assigned task
 * @param type $assignedTask
 * @return type
 */
public static function assignedTaskDemand($assignedTask){
    $demandAssignTask = 0;
    foreach ($assignedTask as $aKey => $aTask) {
        $task = TasksSubtask::Where('id', $aTask->task)->first();
        $demandAssignTask += isset($task) ? $task->total_demand : 0;
    }
    return $demandAssignTask;
}

/**
 * Retrive Category and Groups for Person Assignment 
 * @param type $personAssign
 * @return type
 */
public static function personAssignmentResouces($personAssign, $assignedCost){
    $assignRoleCategory = $assignRoleGroup = array();
    $assignTaskHours = 0;
    foreach ($personAssign as $paKey => $person) {
        $role = Createrole::Where('id', $person->role)->first();
        $task = TasksSubtask::Where('id', $person->task)->first();
        //get assign hours of project
        $daysDiff = date_diff(new DateTime($person->start_date), new DateTime($person->end_date));
        $daysWorked = $daysDiff->d + 1;
        for ($day = 1; $day <= $daysWorked; $day++) {
            $assignTaskHours += $person->{'day' . $day};
        }
        //get assign hours cost on project
        $employeeRecord = Employee_records::Where('employee_id', $person->resource_name)->first();
        $planRate = 0;
        if (isset($employeeRecord)) {
            $employeeRecord->employee_activity_type;
            $activityRate = Activity_rates::Where('activity_type_id', $employeeRecord->employee_activity_type)->first();
            if ($activityRate)
                $planRate = $activityRate->activity_plan_rate;
        }
        $assignedCost = $assignTaskHours * $planRate;
        if ($role) {
            $role = $role->toArray();
            if (array_key_exists('role_fun', $role) && !in_array($role['role_fun'], $assignRoleCategory))
                array_push($assignRoleCategory, $role['role_fun']);

            if (array_key_exists('role_name', $role) && !in_array($role['role_name'], $assignRoleGroup))
                array_push($assignRoleGroup, $role['role_name']);
        }
    }
    
    return array('assignedRoleGroup' => $assignRoleGroup, 'assignedRoleCategory' => $assignRoleCategory,
            'assignedCost' => $assignedCost, 'assignTaskHours' => $assignTaskHours);
}

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
}
