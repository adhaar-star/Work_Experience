<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Projectlabel;
use DB;

class ProjectlabelsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $labels = Projectlabel::get();        
        return view('admin.projectlabels.index',compact('labels'));
    }
    
      public function add()
    {

        return view('admin.projectlabels.create');
    }
    
     public function create(Request $request)
    {
         $project_label=$request->all();
         
              $project_label['created_on'] = date("Y-m-d");
        $project_label['created_by'] = Auth::User()->id;
        
           $validationmessages = [
            'label_name.required' => 'Please select Label Name',
            'label_color.required' => 'Please select Label Color',
          
        ];

        $validator = Validator::make($project_label, [
                    'label_name' => 'required',
                    'label_color' => 'required',
                 
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/projectlabels/create')->withErrors($validator)->withInput($request->all());
        }
        
        
        
         Projectlabel::create($project_label);
           session()->flash('flash_message', 'Issue Label created successfully...');
            return redirect('admin/projectlabels');
           
      
 
 
    }
 
       public function edit($id) {
        $Labels = Projectlabel::find($id);
        
       if($Labels){
        return view('admin.projectlabels.edit', compact('Labels'));
       }else{
              return redirect('admin/projectlabels');
       }
    }
    
    
     public function update(Request $request, $id) {
         
        
         
        $project_label_find = Projectlabel::find($id);
        $project_label = $request->all();
        

        $project_label['changed_on'] = date("Y-m-d");
        $project_label['changed_by'] = Auth::User()->id;
        
           $validationmessages = [
            'label_name.required' => 'Please select Label Name',
            'label_color.required' => 'Please select Label Color',
          
        ];

        $validator = Validator::make($project_label, [
                    'label_name' => 'required',
                    'label_color' => 'required',
                 
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/projectlabels/edit'.'/'.$id)->withErrors($validator)->withInput($request->all());
        }

        $project_label_find->update($project_label);
        session()->flash('flash_message', 'Issue Label updated successfully...');
        return redirect('admin/projectlabels');
    }
    
     

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $projectlabel = Projectlabel::find($id);
        $projectlabel->delete();
        session()->flash('flash_message', 'Issue Label deleted successfully...');
        return redirect('admin/projectlabels');
    }

   
}
