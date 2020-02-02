@extends('layout.adminlayout')
@section('title','Edit Issue Label')
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
                            <a class="dropdown-item" href="#">Components</a>
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
                            <a href="{{url('admin/dashboard')}}">Project Management</a>
                        </li>
                        <li>
                            <span>Edit Project Labels</span>
                        </li>
                    </ul>
                </div>
          
           
                <!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                <br />
                <div class="col-md-12">
                    
                    
                
  
    <form id="Projectphaseform" method="post" action="{{url('admin/projectlabels/edit').'/'.$Labels->id}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                  {{ csrf_field() }}
                    <input  name="label_id" value="{{$Labels->id}}" type="hidden">	
                                        <div class="margin-bottom-50">


                        <div class="card">
                            <div class="card-header card-header-box bg-lightcyan">
                                <h4 class="margin-0">
                                                                        Edit
                                     
                                    Label
                                </h4>
                                <!-- Vertical Form -->
                            </div>

                            <div class="card-block">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Name*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                       <input placeholder="Name" id="label_name" name="label_name" value="{{$Labels->label_name}}" class="form-control border-radius-0" type="text">							
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Color*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <div id="colorSelector"><div style="background-color: {{$Labels->label_color}}"></div></div>
                                                    <input placeholder="#000" id="label_color" name="label_color" value="{{$Labels->label_color}}" required="required" class="form-control border-radius-0" type="hidden">
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
                                <a href="{{url('admin/projectlabels')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                            </div>
                        </div>

                    </div>
            </form>
                    
                    
                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript" src="{{asset('js/colorpicker.js')}}"></script>
<!-- End  -->
@endsection

