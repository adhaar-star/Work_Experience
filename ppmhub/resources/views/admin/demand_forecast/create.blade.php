@extends('layout.adminlayout')
@section('title','Create Demand Forecast')
@section('body')
{!! Html::script('/js/jquery.validate.min.js') !!}
<style>
    .err {
        background-color: #da4f49;
        color: #ffffff;
    } 
    .ok {
        background-color: #00d6b2;
        color: #ffffff;
    } 
    #grid_cost {
        overflow: hidden;
        overflow-x: auto;
        display: block;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
        width: 100%;
    }
    .testgrid tbody{
        font-weight: bold;
    }
    .testgrid th.editablegrid-total {
        padding: 5px 50px 5px 5px;
    }
    .testgrid td.editablegrid-total{
        text-align: right;
    }
</style>
<script>
    var projectId = {{$projectId}};
            $(window).load(function () {
    if (projectId != 0) {
//      setTimeout(function(){
    $('#projectId').val(projectId);
            $('#projectId').trigger('change');
            $('#projectId').prop("disabled", true);
            $('#project_description').attr("disabled", "disabled");
            $('#project_start_date').attr("readonly", 'true');
            $('#project_end_date').attr("readonly", 'true');
//      },1000);
    }
    });</script>
<section id="create_form" class="panel">
    <!--div class="panel-heading">
        <h3>Basic Form Elements</h3>
    </div-->
    <!--- Bootstrap Model --->
    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p>No errors found.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Model -->
    <div class="panel-body">
        <div class="row PageTitleGlobal">
            <div class="col-md-6">
                <h1></h1>
            </div>
            <div class="col-md-6 text-right">
                <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                <ul class="list-unstyled breadcrumb breadcrumb-custom">
                    <li>
                        <a href="{{url('admin/dashboard')}}">Project Management</a>
                    </li>
                    <li>                                       
                        <span>                    
                            @if($projectId != 0)
                            Edit
                            @else
                            Create
                            @endif
                            Demand Forecast
                        </span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <form id="returnbudget" method="post" action="<?php
                echo url('admin/demandforecasting');
                ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    {{ csrf_field() }}
                    <div class="margin-bottom-50">
                        <div class="card">
                            <div id="message" class="col-lg-11 col-md-11 col-xs-10"></div>
                            <div class="card-header card-header-box bg-lightcyan">
                                <h4 class="margin-0"> 
                                    @if($projectId != 0)
                                    Edit
                                    @else
                                    Create
                                    @endif               
                                    Demand Forecast</h4>
                                <!-- Vertical Form -->
                            </div>

                            <div class="card-block">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Project Id<span class="required">*</span></label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                {!!Form::select('project_id',$project_id,isset($getReturnBudget->project_id) ? $getReturnBudget->project_id : '',array('class'=>'form-control select2 ','placeholder'=>'Select Project id','id'=>'projectId'))!!}  
                                                @if($errors->has('project_id')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('project_id') }}
                                                </div>
                                                @endif
                                             <div id="prjerror"></div>
                                            </div>
                                            <label class="col-sm-1 " for="l33" id="project_nameDesc" ></label>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Project Description<span class="required"></span></label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7 message">
                                                <?php if (isset($getReturnBudget)) { ?>
                                                    <input type="text" class="form-control border-radius-0" value="{{$getReturnBudget->overall}}" data-validation="[NOTEMPTY]" placeholder="" id="project_description" name="project_description">
                                                <?php } else { ?>
                                                    <input type="text" class="form-control border-radius-0" data-validation="[NOTEMPTY]" placeholder="" id="project_description" name="project_description">
                                                <?php } ?>                        
                                                <p style="color:red" id="message"></p>
                                                @if($errors->has('overall')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('overall') }}
                                                </div> 
                                                @endif
                                                <p class="ori-budget-error" id="overerror"></p>
                                            </div>
                                        </div>                                       
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Project Start Date<span class="required"></span></label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7 message">                                              
                                                <input type="text" class="form-control border-radius-0 datepicker-only-init" data-validation="[NOTEMPTY]" placeholder="" id="project_start_date" name="project_start_date">                                                                                                
                                            </div>
                                        </div>                                       
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Project End Date<span class="required"></span></label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7 message">                                              
                                                <input type="text" class="form-control border-radius-0 datepicker-only-init" data-validation="[NOTEMPTY]" id="project_end_date" name="project_end_date">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label"><span class="required"></span></label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7 message">                                              
                                                <button type="button" id="adjustforecast" class="btn btn-primary">Adjust Forecast Now</button>                                                    
                                            </div>                                            
                                        </div>                                        
                                    </div>
                                    <div class="col-lg-12 col-md-12">
                                        <div class="alert alert-success" id ="success_msg" style="display: none">
                                            <span class="glyphicon glyphicon-ok"></span>
                                            <em id="msg"></em>
                                        </div>
                                        <div class="form-group row">
                                            <div id="message" class="col-lg-11 col-md-11 col-xs-10"></div>
                                            <div class="col-lg-12 col-md-12 col-xs-12" id="grid_cost"></div>
                                        </div>
                                    </div>         
                                </div>
                            </div>
                        </div>                        
                        <div class="card-footer card-footer-box text-right">                                                        
                            <a href="javascript:void(0);"><button type="button" class="btn btn-primary" id="saveForeCast">Save</button></a>
                            <a href="{{url('admin/demandforecasting')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                        <!-- End Vertical Form -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</section>
<!-- End Dashboard -->

<script>
            token = '{{ csrf_token()}}';</script>

{!! Html::script('/js/demand_forecast.js') !!}

<script>

            //page validations
            $("textarea[maxlength]").on("propertychange input", function () {
    if (this.value.length > this.maxlength) {
    this.value = this.value.substring(0, this.maxlength);
    }
    });
            $.ajaxSetup({async: false});
            token = '{{ csrf_token() }}';
            function update_demandforcast(obj)
            {
            $.ajax({
            url: "{{url('/admin/demandforecast/store/')}}/" + $('#projectId').val(),
                    method: "POST",
                    data: {'_token': token, data: obj, 'startDate': $('#project_start_date').val(), endDate: $('#project_end_date').val()},
                    dataType: "JSON "
            }).done(function (msg) {
            if ('status' in msg)
            {
            if (msg.status != true)
            {
            $('#msg').innerHTML = "<p class='err'>" + msg.error + "</p>";
            } else
            {
            $('#success_msg').show(0).delay(2000).hide(1000);
            $('#msg').html(msg.msg);
            $('#projectId').trigger('change');
            }
            } else {
            window.location.href = window.location.href;
            }
            });
            }

</script>

@endsection
