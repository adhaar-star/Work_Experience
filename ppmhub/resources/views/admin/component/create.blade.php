@extends('layout.adminlayout')
@section('title','Create Component | Agile Methodology')
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
                            <a href="{{url('admin/sprint')}}">Agile Methodology</a>
                        </li>
                        <li>
                            <span>Create Component</span>
                        </li>
                    </ul>
                </div>
          
           
                <!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                <br />
                <div class="col-md-12">
                    
                    
                     <?php  /*if (isset($label) && $label->id) {
                    ?>
                    {!! Form::model($portfolio, array('class' => '', 'id' => 'Portfoliotypeform', 'method' => 'PATCH', 'route' => array('portfolio.update', $portfolio->id))) !!}
                <?php } else { ?>
                    {!! Form::open(array('route' => 'portfolio.store', 'id' => 'Projectlabels', 'class' => '')) !!} 
                <?php } */ 
                ?>
                    
                    
                    <form id="Projectphaseform" method="post" action="{{url('admin/component/create')}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                  {{ csrf_field() }}
                                        <div class="margin-bottom-50">


                        <div class="card">
                            <div class="card-header card-header-box bg-lightcyan">
                                <h4 class="margin-0">
                                                                        Create
                                     
                                    Component
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
                          
                          
                            <option value="{{$project_list->project_Id}}">{{$project_list->project_Id}} ({{$project_list->project_desc}})</option>
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
                                                  
                                                    
                                                     <select id="sprint_no" name="sprint_no"  class="form-control col-md-7 col-xs-12 select2">
                          
                          @if($sprint_number->count() > 0)
                          
                          @foreach($sprint_number as $sprint_number_list)
                          
                          
                            <option value="{{$sprint_number_list->sprint_number}}">{{$sprint_number_list->sprint_number}}</option>
                          @endforeach
                          
                          @endif
                            </select>	
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        
                                      
                                        
                                           <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Component Name*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                  {!!Form::text('component_name','' ,array('class'=>'form-control border-radius-0','id' => ''))!!} 
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                           <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Component Number*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                  {!!Form::text('component_number',$component_count_number ,array('class'=>'form-control border-radius-0','id' => '','readonly'))!!} 
                                                </div>
                                            </div>
                                        </div>
                                        
                                    
                                        
                                          <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    
                                     
                                                      {!!Form::select('status',['Created'=>'Created','In Progress'=>'In Progress','Completed'=>'Completed'],'',array('class'=>'form-control border-radius-0 select2'))!!}
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                        
                                         
                                         
                                    </div>
                                     
                                </div>
                                
                            </div>

                            <div class="card-footer card-footer-box text-right">
                                <button type="submit" class="btn btn-primary card-btn">
                                                                        Submit
                                     
                                </button>
                                <a href="{{url('admin/component')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                            </div>
                        </div>

                    </div>
            </form>
                    
                    
                </div>
            </div>
        </div>
    </div>
</section>   
<!-- End  -->
@endsection

