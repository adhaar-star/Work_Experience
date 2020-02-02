@extends('layout.adminlayout')
@section('title','Project Location')

@section('body')

{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/location.js') !!}

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
                            <a class="dropdown-item" href="{{url('admin/location')}}">View Type</a>
                            <a class="dropdown-item" href="{{url('admin/projectlocation')}}">Project Location</a>
                            <a class="dropdown-item" href="{{url('admin/costcentretype')}}">Cost Center</a>
                            <a class="dropdown-item" href="{{url('admin/departmenttype')}}">Department Type</a>
                            <a class="dropdown-item" href="{{url('admin/personresponsible')}}">Person Responsible</a>
                            <a class="dropdown-item" href="{{url('admin/location')}}">Location</a>
                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                        </ul>  
                    </div> 
                </div>
                <form id="location" method="post" action="<?php
                if (isset($location) && $location->id) {
                    echo url('admin/location/' . $location->id);
                } else {
                    echo url('admin/location');
                }
                ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    {{ csrf_field() }}
                    @if(isset($location) && $location->id)
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
                                    <a href="{{url('admin/location')}}">Project Location</a>
                                </li>
                                <li>
                                    <span>
                                        @if(isset($location) && $location->id)
                                        Edit
                                        @else
                                        Create
                                        @endif 
                                        Project Location
                                    </span>
                                </li>
                            </ul>
                        </div>

                        <div class="card">
                            <div class="card-header card-header-box">
                                <h4 class="margin-0">
                                    @if(isset($location) && $location->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Project Location
                                </h4>
                                <!-- Vertical Form -->
                            </div>
                            <div class="card-block bg-lightcyan">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">City* :</label>

                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    <input type="text" placeholder="City" id="subrub" name="subrub" value="<?php
                                                    if (isset($location)) {
                                                        echo $location->subrub;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0">
                                                    @if($errors->has('subrub')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('subrub') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">State* :</label>

                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    <input type="text" placeholder="State" id="state" name="state" value="<?php
                                                    if (isset($location)) {
                                                        echo $location->state;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0">
                                                    @if($errors->has('state')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('state') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">Postcode* :</label>

                                            <div class="col-xs-12 col-sm-2">
                                                <div class="form-input-icon">
                                                    <input type="text" placeholder="Postcode" id="postcode" name="postcode" value="<?php
                                                    if (isset($location)) {
                                                        echo $location->postcode;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0">
                                                    @if($errors->has('postcode')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('postcode') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">Latitude* :</label>

                                            <div class="col-xs-12 col-sm-3">
                                                <div class="form-input-icon">
                                                    <input type="text" placeholder="Please enter latitude" id="latitude" name="latitude" value="<?php
                                                    if (isset($location)) {
                                                        echo $location->latitude;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0">
                                                    @if($errors->has('latitude')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('latitude') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <label class="col-sm-2 col-form-label text-right">Longitude* :</label>

                                            <div class="col-xs-12 col-sm-3">
                                                <div class="form-input-icon">
                                                    <input type="text" placeholder="Please enter longitude" id="longitude" name="longitude" value="<?php
                                                    if (isset($location)) {
                                                        echo $location->longitude;
                                                    }
                                                    ?>" required="required" class="form-control border-radius-0">

                                                    @if($errors->has('longitude')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('longitude') }}
                                                    </div> 
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>




                                    <!--								<div class="col-xs-12">
                                                                                                            <div class="form-group form-margin-btm">
                                                                                                                    <div class="col-xs-12 col-sm-3">
                                                                                                                            <label>Status</label>
                                                                                                                    </div>
                                                                                                                    <div class="col-xs-12 col-sm-3">
                                                                                                                            <div class="btn-group" data-toggle="buttons">
                                                                                                                                    <label class="active-btn btn btn-default active">
                                                                                                                                            <input type="radio" name="status" value="active" <?php
                                    if (isset($location) && $location->status == 'active') {
                                        echo "checked";
                                    }
                                    ?>>
                                                                                                                                            Active
                                                                                                                                    </label>
                                                                                                                                    <label class="inactive-btn btn btn-default">
                                                                                                                                            <input type="radio" name="status" value="inactive" <?php
                                    if (isset($location) && $location->status == 'inactive') {
                                        echo "checked";
                                    }
                                    ?>>
                                                                                                                                       Inactive
                                                                                                                                    </label>
                                                                                                                            </div>
                                                                                                                    </div>
                                                                                                            </div>
                                                                                                    </div>-->

                                </div>
                            </div>
                            <!--<div class="form-group">
                              <div class="col-md-6 col-sm-6 col-xs-12 col-md-offset-3">-->
                            <div class="card-footer card-footer-box">
                                <button type="submit" class="btn btn-primary card-btn">Submit</button>
                                <a href="{{url('admin/location')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
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
