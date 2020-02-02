<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Projectlabel;
use App\Project;
use App\Sprint;
use App\Component;
use App\Backlogs;
use DB;
use App\ProjectIssue;
use App\Configuration;

class BoardsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $backlogList = Backlogs::with('user')->with('issue')->get();
    
        $projectIssue_todo = ProjectIssue::select('id', 'title', 'description','label_id')->where('status', 2)->get();  
        
        $projectIssue_doing = ProjectIssue::select('id', 'title', 'description','label_id')->where('status', 3)->get();
        
        $projectIssue_closed = ProjectIssue::select('id', 'title', 'description','label_id')->where('status', 5)->get();
        $ConfigurationList_1 = Configuration::where(['user_id'=>Auth::user()->id,'kanban_id'=>1])->first();//Backlogs
        $ConfigurationList_2 = Configuration::where(['user_id'=>Auth::user()->id,'kanban_id'=>2])->first();//To do
        $ConfigurationList_3 = Configuration::where(['user_id'=>Auth::user()->id,'kanban_id'=>3])->first();//Doing
        $ConfigurationList_4 = Configuration::where(['user_id'=>Auth::user()->id,'kanban_id'=>4])->first();//Review
        $ConfigurationList_5 = Configuration::where(['user_id'=>Auth::user()->id,'kanban_id'=>5])->first();//Closed
        $config_count=0;
        $config_check=array();
        
        if(isset($ConfigurationList_1)){ $config_check[]=array('id' =>$ConfigurationList_1->kanban_id,'name'=>$ConfigurationList_1->name,'status'=>$ConfigurationList_1->status);}else{$config_check[]=array('id' =>1,'name'=>'Backlogs','status'=>'show');}
        if(isset($ConfigurationList_2)){ $config_check[]=array('id' =>$ConfigurationList_2->kanban_id,'name'=>$ConfigurationList_2->name,'status'=>$ConfigurationList_2->status);}else{$config_check[]=array('id' =>2,'name'=>'To do','status'=>'show');}
        if(isset($ConfigurationList_3)){ $config_check[]=array('id' =>$ConfigurationList_3->kanban_id,'name'=>$ConfigurationList_3->name,'status'=>$ConfigurationList_3->status);}else{$config_check[]=array('id' =>3,'name'=>'Doing','status'=>'show');}
        if(isset($ConfigurationList_4)){ $config_check[]=array('id' =>$ConfigurationList_4->kanban_id,'name'=>$ConfigurationList_4->name,'status'=>$ConfigurationList_4->status);}else{$config_check[]=array('id' =>4,'name'=>'Review','status'=>'show');}
        if(isset($ConfigurationList_5)){ $config_check[]=array('id' =>$ConfigurationList_5->kanban_id,'name'=>$ConfigurationList_5->name,'status'=>$ConfigurationList_5->status);}else{$config_check[]=array('id' =>5,'name'=>'Closed','status'=>'show');}
        
      // $labels = Projectlabel::select('labels.id', 'labels.label_name','labels.label_color')          ->with('issues_list_array')               ->where('labels.created_by',Auth::User()->id)->get();
      $labels=array();
       /* $labels = Projectlabel::where([
                'labels.created_by' => Auth::User()->id              
            ])->Join('issues_list', 'issues_list.label_id', '=', 'labels.id')
                ->select('labels.id', 'labels.label_name','labels.label_color','issues_list.*')
                ->get()
                ->toArray();*/


        return view('admin.boards.index', compact('backlogList', 'projectIssue_todo', 'projectIssue_doing', 'projectIssue_closed','labels','config_check'));
    }

    public function add() {

        $backlogList = Backlogs::with('user')->with('issue')->get();
        $projectIssue_todo = ProjectIssue::select('id', 'title', 'description')->where('status', 2)->get();
        $projectIssue_doing = ProjectIssue::select('id', 'title', 'description')->where('status', 3)->get();
        $projectIssue_closed = ProjectIssue::select('id', 'title', 'description')->where('status', 5)->get();

        return view('admin.boards.index', compact('backlogList', 'projectIssue_todo', 'projectIssue_doing', 'projectIssue_closed'));
    }

    public function create(Request $request) {
        $backlogData = $request->all();
        $backlogData = isset($backlogData['response'])?$backlogData['response']:[];

        $total_Array = count($backlogData);
        /* echo '<pre>';
          print_r($backlogData);
          die(); */

 foreach ($backlogData as $statusId => $x) {
     
     
     if($statusId=='backlogs'){
         
         $statusId=1;
     }elseif($statusId=='todo'){
          $statusId=2;
     }elseif($statusId=='doing'){
          $statusId=3;
     }elseif($statusId=='closed'){
          $statusId=5;
     }else{         
          $statusId=$statusId;
     }
     
     
          
   
            if ($statusId == 1) {
   foreach ($x as $y) {

                    $getBacklogsList = Backlogs::select('id')->get();

                    foreach ($getBacklogsList as $getBacklogsListData) {

                        if ($getBacklogsListData->id !== $y) {



                            $backlog = Backlogs::where('id', $y)->delete();
                        }
                    }
                }
                $getissueProject = ProjectIssue::select('component_id', 'id', 'sprint_id', 'status')->where(['id' => $y])->first();

                if ($getissueProject) {
                    $issue_update_backlog = array('backlog_type' => 1);
                    $getD = ProjectIssue::where(['id' => $getissueProject->id])->update($issue_update_backlog);
                    $backlogData = array('sprint_no' => $getissueProject->sprint_id,
                        'issue_no' => $getissueProject->id,
                        'component_no' => $getissueProject->component_id,
                        'status' => 'Created'
                    );
                    $backlogData['created_on'] = date("Y-m-d");
                    $backlogData['created_by'] = Auth::User()->id;

                    Backlogs::create($backlogData);
                }
            }else if ($statusId == 2 or $statusId == 3 or $statusId == 5 ){
                foreach ($x as $y) {

                    $issue_update_backlog = array('status' => $statusId,'label_id' => 0);
                    ProjectIssue::where(['id' => $y])->update($issue_update_backlog);
                }
            }else{
                
               foreach ($backlogData as $statusIds => $xa) {
                   
             
                   
                    foreach ($xa as $y) {
              
                    
                 $issue_update_Labels = array('label_id' => $statusIds );
                ProjectIssue::where(['id' => $y])->update($issue_update_Labels);
                
                    }
               }
                   /*
                  foreach ($x as $y) {
 $issue_update_Labels = array('label_id' => $statusId ,'id' => $y);
              
                    
                
                ProjectIssue::where(['id' => $y])->update($issue_update_Labels);
                }*/
                
                
            }
        }
    }
 

}
