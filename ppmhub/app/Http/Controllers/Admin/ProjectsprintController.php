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
use DB;

class ProjectsprintController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $sprint = Sprint::with('user')->with('user_changed_by')->get();  
     
     
     return view('admin.sprint.index',compact('sprint'));
    }
    
      public function add()
    {
          $sprint_count_number = Sprint::select('sprint_number')->where('created_by',Auth::User()->id)->orderby('id', 'desc')->first(); 
       
          
          if(isset($sprint_count_number) and $sprint_count_number->count() > 0){        
         $sprint_count_number=$sprint_count_number['sprint_number']+1;      
          }else{
              $sprint_count_number=1;
          }
   
             $project = project::select('id', 'project_Id', 'project_desc')->get();
          
        return view('admin.sprint.create',compact('project','sprint_count_number'));
    }
    
     public function create(Request $request)
    {
         $sprintData=$request->all();
         
              $sprintData['created_on'] = date("Y-m-d");
        $sprintData['created_by'] = Auth::User()->id;
        
               
           $validationmessages = [
            'project_id.required' => 'Please select Project Id',
                'sprint_period.required' => 'Please select Sprint Period',               
            'sprint_number.required' => 'Please select Sprint Number',
            'start_date.required' => 'Please select Sprint Start Date',
            'end_date.required' => 'Please select Sprint End Date',
            'status.required' => 'Please select Status',
          
        ];

        $validator = Validator::make($sprintData, [
                    'project_id' => 'required',
            'sprint_period' => 'required',
                    'sprint_number' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
                 
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/sprint/create')->withErrors($validator)->withInput($request->all());
        }
        
        
        
         Sprint::create($sprintData);
           session()->flash('flash_message', 'Sprint created successfully...');
            return redirect('admin/sprint');
           
      
 
 
    }
 
       public function edit($id) {
        $sprint = Sprint::with('user')->find($id);    
         $project = project::select('id', 'project_Id', 'project_desc')->get();
       if($sprint){
        return view('admin.sprint.edit', compact('sprint','project'));
       }else{
              return redirect('admin/sprint');
       }
    }
    
    
     public function update(Request $request, $id) {
         
        
         
        $Sprint_find = Sprint::find($id);
        $Sprint = $request->all();
        

        $Sprint['changed_on'] = date("Y-m-d");
        $Sprint['changed_by'] = Auth::User()->id;
        
           $validationmessages = [
            'project_id.required' => 'Please select Project Id',
                'sprint_period.required' => 'Please select Sprint Period',               
            'sprint_number.required' => 'Please select Sprint Number',
            'start_date.required' => 'Please select Sprint Start Date',
            'end_date.required' => 'Please select Sprint End Date',
            'status.required' => 'Please select Status',
          
        ];

        $validator = Validator::make($Sprint, [
                  'project_id' => 'required',
            'sprint_period' => 'required',
                    'sprint_number' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'status' => 'required',
                 
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/sprint/edit'.'/'.$id)->withErrors($validator)->withInput($request->all());
        }

        $Sprint_find->update($Sprint);
        session()->flash('flash_message', 'Sprint updated successfully...');
        return redirect('admin/sprint');
    }
    
     

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $Sprint = Sprint::find($id);
        $Sprint->delete();
        session()->flash('flash_message', 'Sprint deleted successfully...');
        return redirect('admin/sprint');
    }

   
}
