@extends('layout.adminlayout')
@section('title','Edit Sprint | Agile Methodology')
@section('body')
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif
<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                
                 @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                
                <div class="togle-btn pull-right">
                       <div class="dropdown inner-drpdwn">
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <span class="hidden-lg-down"> Agile Methodology</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/projectissues')}}">Issue List</a>
                            <a class="dropdown-item" href="#">Backlogs</a>
                            <a class="dropdown-item" href="#">Kanban Board</a>
                            <a class="dropdown-item" href="{{url('admin/sprint')}}">Sprint</a>
                            <a class="dropdown-item" href="{{url('admin/component')}}">Components</a>
                             <a class="dropdown-item" href="{{url('admin/projectlabels')}}">Labels</a>
                              <a class="dropdown-item" href="#">Configuration</a>
                            
                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                        </ul>
                    </div>   
                </div>
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/sprint')}}"> Agile Methodology</a>
                        </li>
                        <li>
                            <span>Edit Sprint</span>
                        </li>
                    </ul>
                </div>
          
           
                <!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                <br />
                <div class="col-md-12">
                    
                    
             
               
                    
                    <form id="Projectphaseform" method="post" action="{{url('admin/sprint/edit').'/'.$sprint->id}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                  {{ csrf_field() }}
                                        <div class="margin-bottom-50">


                        <div class="card">
                            <div class="card-header card-header-box bg-lightcyan">
                                <h4 class="margin-0">
                                                                        Edit
                                     
                                    Sprint
                                </h4>
                                <!-- Vertical Form -->
                            </div>

                            <div class="card-block">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Project ID*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
 
                      <select id="project_id" name="project_id"  class="form-control col-md-7 col-xs-12 select2">
                          
                          @if($project->count() > 0)
                          
                          @foreach($project as $project_list)
                          
                          
                            <option @if($sprint->project_id==$project_list->project_Id) selected="selected" @endif value="{{$project_list->project_Id}}">{{$project_list->project_Id}} ({{$project_list->project_desc}})</option>
                          @endforeach
                          
                          @endif
                            </select>						
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sprint Number*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    
                                                     {!!Form::text('sprint_number',$sprint->sprint_number ,array('class'=>'sprint_number form-control border-radius-0','readonly'))!!}
                                                </div>
                                            </div>
                                        </div>
                                        
                                      
                                        
                                           <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sprint Duration*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    
                                     {!!Form::text('sprint_period',$sprint->sprint_period ,array('class'=>'sprint_number form-control border-radius-0','id' => 'duration_select'))!!} <span style="float: right; position: absolute; right: -50px; margin-top: -24px;">Weeks</span>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                         <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sprint Start date:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <label class="input-group datepicker-only-init">
                                                        <input type="text" placeholder="Sprint Start date" id="a_start_date" name="start_date" value="{{$sprint->start_date}}" required="required" class="form-control border-radius-0 datepicker-only-init a_start">
                                                        <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                    </label>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                          <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Sprint End date:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <label class="input-group datepicker-only-init">
 
                                                        <input type="text" placeholder="Sprint End date" id="a_end_date" name="end_date" value="{{$sprint->end_date}}" required="required" class="form-control border-radius-0 datepicker-only-init a_start">
                                                         <span class="input-group-addon border-radius-0"> <i class="icmn-calendar"></i> </span>
                                                    </label>
                                                  
                                                </div>
                                            </div>
                                        </div>
                                        
                              
                                        
                                          <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Created on:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    
                                                    <?php
$date = $sprint->created_on;
$date = strtotime($date);
//$date = strtotime("+7 day", $date);
$created_on_convert= date('Y-m-d', $date); 
?>
                                                    
                                                     {!!Form::text('',$created_on_convert ,array('class'=>'form-control border-radius-0','readonly'))!!}
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Created by:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    
                                                     {!!Form::text('',$sprint['user']->name,array('class'=>'form-control border-radius-0','readonly'))!!}
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                          <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    
                                     
                                                      {!!Form::select('status',['Created'=>'Created','In Progress'=>'In Progress','Completed'=>'Completed'],$sprint->status,array('class'=>'form-control border-radius-0 select2'))!!}
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                        
                                         
                                         
                                    </div>
                                     
                                </div>
                                
                            </div>

                            <div class="card-footer card-footer-box text-right">
                                <button type="submit" class="btn btn-primary card-btn">
                                                                        Update
                                     
                                </button>
                                <a href="{{url('admin/sprint')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                            </div>
                        </div>

                    </div>
            </form>
                    
               
                </div>
            </div>
        </div>
    </div>
</section>
 <script>
$( "#duration_select" ).on('keyup',function () {
   var startdate=$('#a_start_date').val();
    var get_duration_id=$( this ).val();
 var weeks_calculation = get_duration_id * 7;
 
var dString = startdate.split('-');       
          
           var future = new Date(dString[0],dString[1]-1,dString[2]);           
         future.setDate(future.getDate() + weeks_calculation);
         
var finalDate = future.getFullYear() + "-" +("0" + (future.getMonth() + 1)).slice(-2) + "-" + ("0" + future.getDate()).slice(-2) ;
  
  $('#a_end_date').val(finalDate);
  })
  .change();
  
        $('#duration_select').keypress(function(event){
            console.log(event.which);
        if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
            event.preventDefault();
        }});
        
  
 
$("#a_start_date").on("dp.change",function (e) {

 var get_duration_id = $('#duration_select').val();

   var startdate=$('#a_start_date').val();
    var weeks_calculation = get_duration_id * 7;       

var dString = startdate.split('-');   
          
           var future = new Date(dString[0],dString[1]-1,dString[2]);           
         future.setDate(future.getDate() + weeks_calculation);
         
var finalDate = future.getFullYear() + "-" +("0" + (future.getMonth() + 1)).slice(-2) + "-" + ("0" + future.getDate()).slice(-2) ;
  
  $('#a_end_date').val(finalDate);                      

});  
</script>

<!-- End  -->
@endsection

