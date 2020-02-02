<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Configuration;
use DB;



class ConfigurationController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
 
   $lists_convert=array();
    
   $ConfigurationList_1 = Configuration::where(['user_id'=>Auth::user()->id,'kanban_id'=>1])->first();
   $ConfigurationList_2 = Configuration::where(['user_id'=>Auth::user()->id,'kanban_id'=>2])->first();
   $ConfigurationList_3 = Configuration::where(['user_id'=>Auth::user()->id,'kanban_id'=>3])->first();
   $ConfigurationList_4 = Configuration::where(['user_id'=>Auth::user()->id,'kanban_id'=>4])->first();
   $ConfigurationList_5 = Configuration::where(['user_id'=>Auth::user()->id,'kanban_id'=>5])->first();
   
   if(count($ConfigurationList_1) == 1){  $lists_convert[]=array('id'=>$ConfigurationList_1->kanban_id,'name'=>$ConfigurationList_1->name,'status'=>$ConfigurationList_1->status);  }
   else{  $lists_convert[]=  array('id'=>'1', 'name' => 'Backlogs','status'=>'show') ;  }
   
   if(count($ConfigurationList_2) == 1){  $lists_convert[]=array('id'=>$ConfigurationList_2->kanban_id,'name'=>$ConfigurationList_2->name,'status'=>$ConfigurationList_2->status);  }
   else{  $lists_convert[]=  array('id'=>'2', 'name' => 'To do','status'=>'show') ;  }
   
   if(count($ConfigurationList_3) == 1){  $lists_convert[]=array('id'=>$ConfigurationList_3->kanban_id,'name'=>$ConfigurationList_3->name,'status'=>$ConfigurationList_3->status);  }
   else{  $lists_convert[]=  array('id'=>'3', 'name' => 'Doing','status'=>'show') ;  }
   
   if(count($ConfigurationList_4) == 1){  $lists_convert[]=array('id'=>$ConfigurationList_4->kanban_id,'name'=>$ConfigurationList_4->name,'status'=>$ConfigurationList_4->status);  }
   else{  $lists_convert[]=  array('id'=>'4', 'name' => 'Review','status'=>'show') ;  }
   
   
   if(count($ConfigurationList_5) == 1){  $lists_convert[]=array('id'=>$ConfigurationList_5->kanban_id,'name'=>$ConfigurationList_5->name,'status'=>$ConfigurationList_5->status);  }
   else{  $lists_convert[]=  array('id'=>'5', 'name' => 'Closed','status'=>'show') ;  }
   
 
   
     return view('admin.configuration.index',compact('lists_convert'));
    }

    public function edit($id) {
        
        if($id <= 5 ){
            $configuration = Configuration::where(['user_id'=>Auth::user()->id,'kanban_id'=>$id])->get();
           
            $config=array();
            
            if(count($configuration) > 0){
            $config=array( 'id'=>$configuration[0]->kanban_id,
             'name' => $configuration[0]->name, 
                 'status' => $configuration[0]->status ? $configuration[0]->status : 'show', 
                
                );
            }else{
                if($id==1){ $set_name='Backlogs'; }
                if($id==2){ $set_name='To do'; }
                if($id==3){ $set_name='Doing'; }
                if($id==4){ $set_name='Review'; }
                if($id==5){ $set_name='Closed'; }
                $config=array(
             'id'=>$id,
             'name' => $set_name,
               'status' =>'show'     
                    
                );
            }
          
                return view('admin.configuration.edit',compact('config'));
        }else{
            
             return redirect('admin/configuration');
        }
      
        
    }
    
    
    public function update(Request $request,$id) {
        
       
        $request['user_id']=Auth::user()->id;
        $request['kanban_id']=$id;
        
        $data= Configuration::where(['kanban_id'=>$id,'user_id'=>Auth::user()->id])->get();
        if(count($data) > 0){            
       Configuration::where(['kanban_id'=>$id,'user_id'=>Auth::user()->id])->update(array('name' => $request->name,'status' => $request->status));
      }else{          
          Configuration::create($request->all());        
       }
          session()->flash('flash_message', '#' . $id . ' Configuration updated successfully...');
        return redirect('admin/configuration/edit/' . $id . '');
       
        
        
     
    }
    
   
}
