@extends('layout.adminlayout')
@section('title','Create Supplement Budget')
@section('body')

{!! Html::script('/js/generate_textbox.js') !!}
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/budget_supplement.js') !!}
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
        <div class="row">
            <div class="col-lg-12">
                <div class="togle-btn pull-right">
                    <div class="dropdown inner-drpdwn">
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <span class="hidden-lg-down">Budget Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">              
                            <a class="dropdown-item" href="{{url('admin/projectbudget/original')}}">Create Original Budget</a>
                            <a class="dropdown-item" href="{{url('admin/projectbudget/supplement')}}">Create Supplement Budget</a>
                            <a class="dropdown-item" href="{{url('admin/projectbudget/returns')}}">Create Return Budget</a>
                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                        </ul>
                    </div> 
                </div>        

                <form id="supplementform" method="post" action="<?php
                if (isset($getsupplementBudget) && $getsupplementBudget->id) {
                    echo url('admin/projectbudget/supplement/update/' . $getsupplementBudget->id);
                } else {
                    echo url('admin/projectbudget/supplement/store');
                }
                ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    {{ csrf_field() }}
                    <div class="margin-bottom-50">
                        <!--div class="dashboard-buttons">
                            <a href="{{url('admin/portfolio')}}" class="btn btn-primary width-200 margin-top-10">
                                <i class="fa fa-long-arrow-left margin-right-5"></i>
                                Back
                            </a>
                        </div-->
                        <div class="margin-bottom-50">
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li>
                                    <a href="{{url('admin/originalbudget')}}">Budget Management</a>
                                </li>
                                <li>                                       
                                    <span>                    
                                        Create                      
                                        Supplement Budget                                            
                                    </span>
                                </li>
                            </ul>
                        </div>

                        <div class="card">
                            <div class="card-header card-header-box bg-lightcyan">
                                <h4 class="margin-0"> 
                                    <?php
                                    if (isset($getsupplementBudget) && $getsupplementBudget->id) {
                                        echo 'Edit';
                                    } else {
                                        echo 'Create';
                                    }
                                    ?>                 
                                    Supplement Budget</h4>
                                <!-- Vertical Form -->
                            </div>

                            <div class="card-block">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Project Id<span class="required">*</span></label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <!--  <label>Test</label> -->
                                                {!!Form::select('project_id',$project_id,isset($getsupplementBudget->project_id) ? $getsupplementBudget->project_id : '',array('placeholder'=>'Select Project id','class'=>'form-control select2 ','id'=>'ProjectListGet'))!!}  
                                                @if($errors->has('project_id')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('project_id') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Period From<span class="required">*</span></label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <div class="form-input-icon">
                                                    <?php if (isset($getsupplementBudget)) { ?>
                                                        <select name="period_from" class="form-control select2" id="period_from">
                                                            <option disabled selected="selected" value="">Select Period From</option>
                                                            @for($i = $year - 5; $i <= $year + 5; $i++)
                                                            <option value="{{$i}}"<?php if ($i == $getsupplementBudget->period_from) echo ' selected="selected"'; ?>>{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                    <?php } else { ?>
                                                        <select name="period_from" class="form-control select2" id="period_from">
                                                            <option disabled selected="selected" value="">Select Period From</option>
                                                            @for($i = $year - 5; $i <= $year + 5; $i++)
                                                            <option value="{{$i}}">{{$i}}</option>
                                                            @endfor
                                                        </select>
                                                    <?php } ?>                            
                                        <!--<input type="text" class="form-control border-radius-0" data-validation="[NOTEMPTY]" placeholder="Period From" id="period_from" name="period_from">-->
                                                    @if($errors->has('period_from')) 
                                                    <div style='color:red'>
                                                        {{ $errors->first('period_from') }}
                                                    </div> 
                                                    @endif
                                                    <p class="ori-budget-error" id="period"></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Period To<span class="required">*</span></label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                                <?php if (isset($getsupplementBudget)) { ?>
                                                    <select name="period_to" class="form-control select2" id="period_to">
                                                        <option disabled selected="selected" value="">Select Period To</option>
                                                        @for($i = $year - 5; $i <= $year + 5; $i++)
                                                        <option value="{{$i}}"<?php if ($i == $getsupplementBudget->period_to) echo ' selected="selected"'; ?>>{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                <?php } else { ?>
                                                    <select name="period_to" class="form-control select2" id="period_to">
                                                        <option disabled selected="selected" value="">Select Period To</option>
                                                        @for($i = $year - 5; $i <= $year + 5; $i++)
                                                        <option value="{{$i}}">{{$i}}</option>
                                                        @endfor
                                                    </select>
                                                <?php } ?>                                
                                      <!--<input type="text" class="form-control border-radius-0 datepicker-init" data-validation="[NOTEMPTY]" placeholder="Period To" id="period_to" name="period_to">-->
                                                @if($errors->has('period_to')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('period_to') }}
                                                </div> 
                                                @endif
                                                <p class="ori-budget-error" id="yearerror"></p>
                                                <p class="ori-budget-error" id="fiveplus"></p>
                                            </div>                                            
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Overall<span class="required">*</span></label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7 message">
                                                <?php if (isset($getsupplementBudget)) { ?>
                                                    <input type="text" class="form-control border-radius-0" value="{{$getsupplementBudget->overall}}" data-validation="[NOTEMPTY]" placeholder="Overall" id="overall" name="overall">
                                                <?php } else { ?>
                                                    <input type="text" class="form-control border-radius-0" data-validation="[NOTEMPTY]" placeholder="Overall" id="overall" name="overall">
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
                                            <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Current Budget</label>
                                            <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">                          
                                                <?php if (isset($current)) { ?>
                                                    <input type="text" id="current_budget" name="current_budget" value="{{$current}}"  class="form-control border-radius-0" data-validation="[NOTEMPTY]" placeholder="Current Budget" readonly="readonly">                         
                                                <?php } else { ?>
                                                    <input type="text" id="current_budget" name="current_budget"  class="form-control border-radius-0" data-validation="[NOTEMPTY]" placeholder="Current Budget" readonly="readonly">                         
                                                <?php } ?>  
                                                @if($errors->has('current_budget')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('current_budget') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>

                                    </div>
                                    <div class="col-xs-12 col-sm-6">
                                        <!--GENERATE TEXTBOX AT EDIT TIME-->
                                        <div class="form-group row" id="dynamic_tb"> 

                                            <!--GENERATE TEXTBOX AT EDIT TIME-->
                                            <?php if (isset($getsupplementBudget->year1)) { ?>  
                                                <div class="form-group row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Year : {{$years}}</label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">                                                    
                                                        <input type="text" id="year1" name="year1" value="{{$getsupplementBudget->year1}}"  class="dynmctb form-control border-radius-0" data-validation="[NOTEMPTY]">                                                                             
                                                    </div>
                                                </div>
                                            <?php } ?>  
                                            <?php if (isset($getsupplementBudget->year2)) { ?>  
                                                <div class="form-group row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Year : {{$years+1}}</label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">                                                    
                                                        <input type="text" id="year1" name="year2" value="{{$getsupplementBudget->year2}}"  class="dynmctb form-control border-radius-0" data-validation="[NOTEMPTY]">                                                                             
                                                    </div>
                                                </div>
                                            <?php } ?>  
                                            <?php if (isset($getsupplementBudget->year3)) { ?>  
                                                <div class="form-group row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Year : {{$years+2}}</label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">                                                    
                                                        <input type="text" id="year1" name="year3" value="{{$getsupplementBudget->year3}}"  class="dynmctb form-control border-radius-0" data-validation="[NOTEMPTY]">                                                                             
                                                    </div>
                                                </div>
                                            <?php } ?>  
                                            <?php if (isset($getsupplementBudget->year4)) { ?>  
                                                <div class="form-group row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Year : {{$years+3}}</label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">                                                    
                                                        <input type="text" id="year1" name="year4" value="{{$getsupplementBudget->year4}}"  class="dynmctb form-control border-radius-0" data-validation="[NOTEMPTY]">                                                                             
                                                    </div>
                                                </div>
                                            <?php } ?>  
                                            <?php if (isset($getsupplementBudget->year5)) { ?>  
                                                <div class="form-group row">
                                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Year : {{$years+4}}</label>
                                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">                                                    
                                                        <input type="text" id="year1" name="year5" value="{{$getsupplementBudget->year5}}"  class="dynmctb form-control border-radius-0" data-validation="[NOTEMPTY]">                                                                             
                                                    </div>
                                                </div>
                                            <?php } ?>  

                                        </div>  

                                        <!--DIV FOR DYNAMIC TEXTBOX APPEND-->                   
                                        <div class="form-group row" id="dynamic_tb">                      
                                        </div> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-footer-box text-right">
                            <button type="button" class="btn btn-danger" id="check" name="check">Check</button>
                            <button type="submit" class="btn btn-primary card-btn" id="submit">
                                Submit
                            </button>
                            <a href="{{url('admin/supplementbudget')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>
                        <!-- End Vertical Form -->
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End Dashboard -->

<!-- Page Scripts -->
<script>
    $('#Portfoliotypeform').validate({
        submit: {
            settings: {
                inputContainer: '.form-group',
                errorListClass: 'form-control-error-list',
                errorClass: 'text-danger'
            }
        }
    });
</script>

@endsection
