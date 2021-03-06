@extends('layout.adminlayout')
@section('title','Department')

@section('body')



<section id="create_form" class="panel">
    <div class="panel-body bg-lightcyan">
        <div class="row">
            <div class="col-lg-12">
                <div class="togle-btn pull-right">
                    <div class="dropdown inner-drpdwn">
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <span class="hidden-lg-down">Settings</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/portfoliotypes')}}">Portfolio Type</a>
                            <a class="dropdown-item" href="{{url('admin/projecttype')}}">Project Type</a>
                            <a class="dropdown-item" href="{{url('admin/phasetype')}}">Phase Type</a>
                            <a class="dropdown-item" href="{{url('admin/currencies')}}">Currency</a>
                            <a class="dropdown-item" href="{{url('admin/capacityunits')}}">Capacity Units</a>
                            <a class="dropdown-item" href="{{url('admin/periodtype')}}">Period Types</a>
                            <a class="dropdown-item" href="{{url('admin/planningunit')}}">Planning Unit</a>
                            <a class="dropdown-item" href="{{url('admin/planningtype')}}">Planning Type</a>
                            <a class="dropdown-item" href="{{url('admin/costingtype')}}">Costing Type</a>
                            <a class="dropdown-item" href="{{url('admin/collectiontype')}}">Collection Type</a>
                            <a class="dropdown-item" href="{{url('admin/departmenttype')}}">View Type</a>
                            <a class="dropdown-item" href="{{url('admin/projectlocation')}}">Project Location</a>
                            <a class="dropdown-item" href="{{url('admin/costcentretype')}}">Cost Center</a>
                            <a class="dropdown-item" href="{{url('admin/departmenttype')}}">Department</a>
                            <a class="dropdown-item" href="{{url('admin/personresponsible')}}">Person Responsible</a>
                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                        </ul>  
                    </div> 
                </div>
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif

                <form id="departmenttype" method="post" action="<?php
                if (isset($departmenttype) && $departmenttype->id) {
                    echo url('admin/departmenttype/' . $departmenttype->id);
                } else {
                    echo url('admin/departmenttype');
                }
                ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    {{ csrf_field() }}
                    @if(isset($departmenttype) && $departmenttype->id)
                    {{ method_field('PUT') }}
                    @endif 

                    <div class="margin-bottom-50">
                        <div class="margin-bottom-50">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li>
                                    <a href="{{url('admin/dashboard')}}">Settings</a>
                                </li>
                                <li>
                                    <a href="{{url('admin/departmenttype')}}">Department</a>
                                </li>
                                <li>
                                    <span>
                                        @if(isset($departmenttype) && $departmenttype->id)
                                        Edit
                                        @else
                                        Create
                                        @endif 
                                        Department 
                                    </span>
                                </li>
                            </ul>
                        </div>

                        <div class="card">
                            <div class="card-header card-header-box">
                                <h4 class="margin-0">
                                    @if(isset($departmenttype) && $departmenttype->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Department
                                </h4>
                                <!-- Vertical Form -->
                            </div>

                            <div class="card-block bg-lightcyan">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">Name* :</label>

                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    <input type="text" placeholder="Please enter Name" id="name" name="name" value="<?php
                                                    if (isset($departmenttype)) {
                                                        echo $departmenttype->name;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--div class="col-xs-12">
                                            <div class="form-group form-margin-btm">
                                                    <div class="col-xs-12 col-sm-3">
                                                            <label>Description</label>
                                                    </div>
                                                    <div class="col-xs-12 col-sm-3">
                                                            <div class="form-input-icon">
                                                                    <textarea class="form-control" id="description" name="description"><?php //if(isset($departmenttype)){ echo $departmenttype->description; }    ?></textarea>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div-->

                                    <?php
                                    if (isset($departmenttype->created_at) && (!empty($departmenttype->created_at))) {
                                        ?>   <input type="hidden" id="updated_at" name="updated_at" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                                    <?php } else { ?>
                                        <input type="hidden" id="created_at" name="created_at" value="<?php echo date('Y-m-d H:i:s'); ?>" required="required" class="form-control col-md-7 col-xs-12">
                                    <?php } ?>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">Status* :</label>

                                            <div class="col-xs-12 col-sm-3">
                                                <div class="btn-group" data-toggle="buttons">
                                                    <a class="active-bttn btn btn-default active">
                                                        <input type="radio" name="status" value="active" <?php
                                                        if (isset($departmenttype) && $departmenttype->status == 'active') {
                                                            echo "checked";
                                                        }
                                                        ?>>
                                                        Active
                                                    </a>
                                                    <a class="inactive-btn btn btn-default">
                                                        <input type="radio" name="status" value="inactive" <?php
                                                        if (isset($departmenttype) && $departmenttype->status == 'inactive') {
                                                            echo "checked";
                                                        }
                                                        ?>>
                                                        Inactive
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="form-group">
                              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">-->
                            <div class="card-footer card-footer-box">
                                <button type="submit" class="btn btn-primary card-btn">Submit</button>
                                <a href="{{url('admin/departmenttype')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                            </div>                       
                            <!--<button type="submit" class="btn btn-success">Submit</button>
                          </div>
                        </div>-->

                            </form>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</section>
@endsection
