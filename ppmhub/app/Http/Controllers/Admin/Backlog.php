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

class Backlog extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
     $backlogList = Backlogs::with('user')->with('issue')->get();   
     return view('admin.backlog.index',compact('backlogList'));
    }

    
      public function add()
    {
        
            $sprint_number = Sprint::select('id', 'sprint_number')->get();
            $component = Component::select('id', 'component_name')->get();
            $projectIssue = ProjectIssue::select('id', 'title', 'description')->get();
          
        return view('admin.backlog.create',compact('projectIssue','sprint_number','component'));
    }
    
     public function create(Request $request)
    {
         $backlogData=$request->all();
    
         
        $backlogData['created_on'] = date("Y-m-d");
        $backlogData['created_by'] = Auth::User()->id;
        
      
               
           $validationmessages = [
            'sprint_no.required' => 'Please select Sprint No',              
            'issue_no.required' => 'Please select Issue',
            'component_no.required' => 'Please select Component Number',
            'status.required' => 'Please select Status',
          
        ];

        $validator = Validator::make($backlogData, [
            'sprint_no' => 'required',
            'issue_no' => 'required',
            'component_no' => 'required',                    
            'status' => 'required',
                 
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/backlog/create')->withErrors($validator)->withInput($request->all());
        }
        
   
        
         $issue_update_backlog=array('backlog_type'=>1);
         $getD=ProjectIssue::where(['id'=>$request->issue_no])->update($issue_update_backlog); 
         
        
            Backlogs::create($backlogData);
            session()->flash('flash_message', 'Backlog created successfully...');
            return redirect('admin/backlog');
           
      
 
 
    }
 
       public function edit($id) {
        $backlog= Backlogs::with('user')->find($id);    
  
        
          $sprint_number = Sprint::select('id', 'sprint_number')->get();
            $component = Component::select('id', 'component_name')->get();
            $projectIssue = ProjectIssue::select('id', 'title', 'description')->get();
            
           
           
           
       if($backlog){
        return view('admin.backlog.edit', compact('projectIssue','sprint_number','component','backlog'));
       }else{
              return redirect('admin/backlog');
       }
    }
    
    
     public function update(Request $request, $id) {
         
        
         
        $backlog_find = Backlogs::find($id);
        $backlog = $request->all();
        

        $backlog['changed_on'] = date("Y-m-d");
        $backlog['changed_by'] = Auth::User()->id;
        
           $validationmessages = [
           'sprint_no.required' => 'Please select Sprint No',              
            'issue_no.required' => 'Please select Issue',
            'component_no.required' => 'Please select Component Number',
            'status.required' => 'Please select Status',
          
        ];

        $validator = Validator::make($backlog, [
            'sprint_no' => 'required',
            'issue_no' => 'required',
            'component_no' => 'required',                    
            'status' => 'required',
                 
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/backlog/edit'.'/'.$id)->withErrors($validator)->withInput($request->all());
        }
         $issue_update_backlog=array('backlog_type'=>1);
         ProjectIssue::where(['id'=>$request->issue_no])->update($issue_update_backlog); 
         

        $backlog_find->update($backlog);
        session()->flash('flash_message', 'Backlog updated successfully...');
        return redirect('admin/backlog');
    }
    
     

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $backlog = Backlogs::find($id);
        $backlog->delete();
        
         $issue_update_backlog=array('backlog_type'=>2);
         ProjectIssue::where(['id'=>$request->issue_no])->update($issue_update_backlog); 
         
        session()->flash('flash_message', 'Backlog deleted successfully...');
        return redirect('admin/backlog');
    }

   
}
