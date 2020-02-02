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
use DB;

class ProjectcomponentController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $componentList = Component::with('user')->get();  
     
    
     
     
     return view('admin.component.index',compact('componentList'));
    }
    
      public function add()
    {
          $component_count_number = Component::select('component_number')->where('created_by',Auth::User()->id)->orderby('id', 'desc')->first(); 
       
          
          if(isset($component_count_number) and $component_count_number->count() > 0){        
         $component_count_number=$component_count_number['component_number']+1;      
          }else{
              $component_count_number=1;
          }
            $sprint_number = Sprint::select('id', 'sprint_number')->get();
             $project = project::select('id', 'project_Id', 'project_desc')->get();
          
        return view('admin.component.create',compact('project','component_count_number','sprint_number'));
    }
    
     public function create(Request $request)
    {
         $componentData=$request->all();
         
        $componentData['created_on'] = date("Y-m-d");
        $componentData['created_by'] = Auth::User()->id;
        
      
               
           $validationmessages = [
            'project_id.required' => 'Please select Project Id',              
            'sprint_no.required' => 'Please select Sprint Number',
            'component_name.required' => 'Please select Component Name',
            'component_number.required' => 'Please select Component Number',
            'status.required' => 'Please select Status',
          
        ];

        $validator = Validator::make($componentData, [
            'project_id' => 'required',
            'sprint_no' => 'required',
            'component_name' => 'required',
            'component_number' => 'required',           
            'status' => 'required',
                 
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/component/create')->withErrors($validator)->withInput($request->all());
        }
        
        
        
            Component::create($componentData);
            session()->flash('flash_message', 'Component created successfully...');
            return redirect('admin/component');
           
      
 
 
    }
 
       public function edit($id) {
        $component = Component::with('user')->find($id);    
         $project = project::select('id', 'project_Id', 'project_desc')->get();
           $sprint_number = Sprint::select('id', 'sprint_number')->get();
           
           
           
           
       if($component){
        return view('admin.component.edit', compact('component','project','sprint_number'));
       }else{
              return redirect('admin/component');
       }
    }
    
    
     public function update(Request $request, $id) {
         
        
         
        $component_find = Component::find($id);
        $component = $request->all();
        

        $Sprint['changed_on'] = date("Y-m-d");
        $Sprint['changed_by'] = Auth::User()->id;
        
           $validationmessages = [
           'project_id.required' => 'Please select Project Id',              
            'sprint_no.required' => 'Please select Sprint Number',
            'component_name.required' => 'Please select Component Name',        
            'status.required' => 'Please select Status',
          
        ];

        $validator = Validator::make($component, [
                'project_id' => 'required',
            'sprint_no' => 'required',
            'component_name' => 'required',              
            'status' => 'required',
                 
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/component/edit'.'/'.$id)->withErrors($validator)->withInput($request->all());
        }

        $component_find->update($component);
        session()->flash('flash_message', 'Component updated successfully...');
        return redirect('admin/component');
    }
    
     

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $component = Component::find($id);
        $component->delete();
        session()->flash('flash_message', 'Component deleted successfully...');
        return redirect('admin/component');
    }

   
}
