<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class ProjectIssue extends Model
{

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $table = 'issues_list';
    //protected $appends = array('label_id');
    protected $fillable = [
        'title',
        'issueTypeId',
        'description',
        'projectId',
        'phaseId',
        'taskId',
        'assignee',
        'created_date',
        'close_date',
        'due_date',
        'priority',
        'estimated_duration',
        'parentID',
        'status',
        'duration_unit',
        'projectManager',
        'attachment',
        'created_by',
        'created_on',
        'changed_by',
        'changed_on',
        'updated_at',
        'created_at',
        'sprint_id',
        'component_id',
        'backlog_type',
        'company_id',
        'label_id'
    ];

	public function projectId() {
      return $this->belongsTo('App\Project', 'projectId');
    }

    public static function getIssueChartData($projectId){
        $issues = self::select('priority', DB::raw("count(*) as count"))->Where('projectId', $projectId)->groupBy('priority')->get()->toArray();
        $issueChartData = array();
        foreach($issues as $key => $val){
            if($val['priority'] == 'Normal')
                $color = "#b0bcde";
            else if($val['priority'] == 'Medium')
                $color = "#00bfff";
            else if($val['priority'] == 'Urgent')
                $color = "#7990ce";
            else if($val['priority'] == 'Very Urgent')
                $color = "#0080ff";
            else if($val['priority'] == 'Critical')
                $color = "#0040ff";
            
            $issueChartData[$key]['y'] = intval($val['count']);
            $issueChartData[$key]['indexLabel'] = $val['priority'];
            $issueChartData[$key]['legendText'] = $val['priority'];
            $issueChartData[$key]['color'] = $color;
        }
        return $issueChartData;
    }
    
    public static function priorityCount($projectId, $type){
        $issues = self::Where('projectId', $projectId)->Where('priority', $type)->get()->count();
        return $issues;
    }

    public static function RAGIssues($projectId){
        $normalPriority = self::priorityCount($projectId, 'Normal');
        $mediumPriority =  self::priorityCount($projectId, 'Medium');
        $urgentPriority =  self::priorityCount($projectId, 'Urgent');
        $veryUrgentPriority =  self::priorityCount($projectId, 'Very Urgent');
        $criticalPriority =  self::priorityCount($projectId, 'Critical');
        return ['normal' => $normalPriority,
                'medium' => $mediumPriority,
                'urgent' => $urgentPriority,
                'veryUrgent' => $veryUrgentPriority,
                'critical' => $criticalPriority
            ];
    }
    
        
    /**
     * Return the traffic light valie
     */
    public static function issueLight($projectId){
       $issuePriority = self::RAGIssues($projectId);
       $issueLight = 'white';
       if ($issuePriority['critical'] >= $issuePriority['veryUrgent'] && $issuePriority['critical'] >= $issuePriority['urgent'] && $issuePriority['critical'] >= $issuePriority['normal'] && $issuePriority['critical'] >= $issuePriority['medium']) {
            $issueLight = 'red';
        } else if ($issuePriority['veryUrgent'] >= $issuePriority['critical'] && $issuePriority['veryUrgent'] >= $issuePriority['urgent'] && $issuePriority['veryUrgent'] >= $issuePriority['normal'] && $issuePriority['veryUrgent'] >= $issuePriority['medium']) {
            $issueLight = 'red';
        } else if ($issuePriority['urgent'] >= $issuePriority['critical'] && $issuePriority['urgent'] >= $issuePriority['veryUrgent'] && $issuePriority['urgent'] >= $issuePriority['normal'] && $issuePriority['urgent'] >= $issuePriority['medium']) {
            $issueLight = 'yellow';
        } else if ($issuePriority['medium'] >= $issuePriority['critical'] && $issuePriority['medium'] >= $issuePriority['veryUrgent'] && $issuePriority['medium'] >= $issuePriority['normal'] && $issuePriority['medium'] >= $issuePriority['urgent']) {
            $issueLight = 'yellow';
        } else {
            $issueLight = 'green';
        }
        
        return $issueLight;
    }

    /*
      public function customer()
      {
      return $this->hasOne('App\Customer', 'id', 'customer_id');
      }


      public function user()
      {
      return $this->hasOne('App\User', 'id', 'user_id');
      }


      public function status()
      {
      return $this->hasOne('App\Status', 'id', 'status_id');
      }
      public function plan()
      {
      return $this->hasOne('App\Plans', 'id', 'plan_id');
      } */
    public function component()
      {
      return $this->hasOne('App\Component', 'id', 'component_id');
      } 
 
      public function getLabelIdAttribute()
    {
           $projectLabels=array();
          if(isset($this->attributes['label_id'])){
          $label_array=$this->attributes['label_id'];
  
      
       $get_data=explode(',',$label_array);
      
       
        if(count($get_data) > 0)
        {
            foreach($get_data as $convertkeys){
                
            $project = Projectlabel::select('id', 'label_name', 'label_color')
                ->Where(['id' => $convertkeys])
                ->take(1)
                ->get();
            if(count($project) > 0){  
          $projectLabels[]=  array('id' => $project[0]->id, 'label_name' =>$project[0]->label_name, 'label_color' =>$project[0]->label_color );
            }
           
            }
        }        
    }
    
        return $projectLabels;  
         
    }
   
  
}
