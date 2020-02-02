@extends('layout.adminlayout')
@section('title','Edit Configuration | Agile Methodology')
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
                            <a class="dropdown-item" href="{{url('admin/backlog')}}">Backlogs</a>
                            <a class="dropdown-item" href="#">Kanban Board</a>
                            <a class="dropdown-item" href="{{url('admin/sprint')}}">Sprint</a>
                            <a class="dropdown-item" href="{{url('admin/component')}}">Components</a>
                             <a class="dropdown-item" href="{{url('admin/projectlabels')}}">Labels</a>
                              <a class="dropdown-item" href="{{url('admin/configuration')}}">Configuration</a>
                            
                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                        </ul>
                    </div>  
                </div>
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/configuration')}}"> Agile Methodology</a>
                        </li>
                        <li>
                            <span>Edit Configuration</span>
                        </li>
                    </ul>
                </div>
          
           
                <!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                <br />
                <div class="col-md-12">
                    
                    
             
               
                    
                    <form id="Projectphaseform" method="post" action="{{url('admin/configuration/edit').'/'.$config['id']}}" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                  {{ csrf_field() }}
                                        <div class="margin-bottom-50">


                        <div class="card">
                            <div class="card-header card-header-box bg-lightcyan">
                                <h4 class="margin-0">
                                                                        Edit
                                     
                                    Configuration
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
              
                                                    
                                                    <input type="text" class="form-control col-md-7 col-xs-12" name="name" value="<?php echo $config['name']; ?>">
                                                    
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                          <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status*:</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    
                                              
                                                <div class="btn-group" data-toggle="buttons">
                                                   
                                                    <a class="active-bttn btn btn-primary <?php echo $config['status']=='show' ? 'active' : '' ?>">
                                                        <input type="radio" id="status" name="status" value="show" <?php echo $config['status']=='show' ? 'checked' : '' ?> >
                                                        Show
                                                    </a>
                                                    <a class="inactive-btn btn btn-danger <?php echo $config['status']=='hide' ? 'active' : '' ?>">
                                                        <input type="radio" id="status" name="status" value="hide" <?php echo $config['status']=='hide' ? 'checked' : '' ?> >
                                                        Hide
                                                    </a>
                                                </div>
                                         
                                                    
                                                   
                                                </div>
                                            </div>
                                        </div>
                                       
                                    
                                         
                                    </div>
                                     
                                </div>
                                
                            </div>

                            <div class="card-footer card-footer-box text-right">
                                <button type="submit" class="btn btn-primary card-btn">
                                   Update </button>
                                <a href="{{url('admin/configuration')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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

