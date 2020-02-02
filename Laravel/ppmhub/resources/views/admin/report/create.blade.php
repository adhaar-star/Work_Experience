@extends('layout.adminlayout')

<?php if (isset($portfolio) && $portfolio->id) { ?>
    @section('title','Edit Portfolio')
<?php } else { ?>
    @section('title','Create Portfolio')
<?php } ?>

@section('body')

<!-- Portfolio -->
<section id="create_form" class="panel">
    <!--div class="panel-heading">
        <h3>Basic Form Elements</h3>
    </div-->
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
                            <span class="hidden-lg-down">Portfolio Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/portfolio')}}">Portfolio</a>
                            <a class="dropdown-item" href="{{url('admin/buckets')}}">Buckets</a>
                            <a class="dropdown-item" href="{{url('admin/portfolioStructure')}}">Portfolio Structure</a>
                            <a class="dropdown-item" href="{{url('admin/bucketfp')}}">Portfolio Financial Plaining</a>
                            <a class="dropdown-item" href="{{url('admin/portfolioresourceplanning')}}">Portfolio Resource Plaining</a>
                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                        </ul>
                    </div> 
                </div>

                <?php if (isset($portfolio) && $portfolio->id) {
                    ?>
                    {!! Form::model($portfolio, array('class' => '', 'id' => 'Portfoliotypeform', 'method' => 'PATCH', 'route' => array('portfolio.update', $portfolio->id))) !!}
                <?php } else { ?>
                    {!! Form::open(array('route' => 'portfolio.store', 'id' => 'Portfoliotypeform', 'class' => '')) !!} 
                <?php }
                ?>


                {{ csrf_field() }}
                @if(isset($portfolio) && $portfolio->id)
                {{ method_field('PUT') }}
                @endif 
                <div class="margin-bottom-50">
                    <!--div class="dashboard-buttons">
                        <a href="{{url('admin/portfolio')}}" class="btn btn-primary width-200 margin-top-10">
                            <i class="fa fa-long-arrow-left margin-right-5"></i>
                            Back
                        </a>
                    </div-->
                    <div class="margin-bottom-50">
                        <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                <a href="{{url('admin/dashboard')}}">Portfolio Management</a>
                            </li>
                            <li>
                                <a href="{{url('admin/portfolio')}}">Portfolio</a>
                            </li>
                            <li>
                                <span>
                                    @if(isset($portfolio) && $portfolio->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Portfolio
                                </span>
                            </li>
                        </ul>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            <h4 class="margin-0">
                                @if(isset($portfolio) && $portfolio->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Portfolio</h4>
                            <!-- Vertical Form -->
                        </div>

                        <div class="card-block">
                            <div class="row" style="margin: 0;">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Portfolio Name<span class="required">*</span></label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <input type="text" class="form-control border-radius-0" data-validation="[NOTEMPTY]" placeholder="Portfolio Name" id="name" name="name" value="<?php
                                                if (isset($portfolio)) {
                                                    echo $portfolio->name;
                                                }
                                                ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Portfolio ID<span class="required">*</span></label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                <?php if (isset($portfolio)) { ?>
                                                    <input type="text" class="form-control border-radius-0" data-validation="[NOTEMPTY]" placeholder="Portfolio ID" id="port_id" name="port_id" value="<?php
                                                    if (isset($portfolio)) {
                                                        echo $portfolio->port_id;
                                                    }
                                                    ?>" readonly >
                                                       <?php } else { ?>
                                                    <input type="text" class="form-control border-radius-0" data-validation="[NOTEMPTY]" placeholder="Portfolio ID" id="port_id" name="port_id" value="<?php echo $rand = substr(md5(microtime()), rand(0, 26), 6); ?>"  maxlength="6">                  
                                                <?php } ?> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                            <div class="row" style="margin: 0;">

                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Portfolio Type<span class="required">*</span></label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <?php if (isset($portfolio)) { ?>
                                                {!! Form::select('type',$ptype, old('type', $portfolio->type), array('class'=>'select2')) !!}
                                            <?php } else { ?>
                                                {!! Form::select('type',$ptype, old('type'), array('class'=>'select2')) !!}	
                                            <?php } ?>
                                        </div>                                            
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Currency</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <?php if (isset($portfolio)) { ?>
                                                {!! Form::select('currency', $currency, old('currency',$portfolio->currency), array('class'=>'select2')) !!}
                                            <?php } else { ?>
                                                {!! Form::select('currency', $currency, old('currency'), array('class'=>'select2')) !!}	
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                            </div>


                            <?php
                            if (isset($portfolio)) {
                            ?>

                            <div class="row" style="margin: 0;">

                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Financial Planning Period</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <?php if (isset($portfolio)) { ?>
                                                {!! Form::select('planning_unit', $planning_unit, old('planning_unit',$portfolio->planning_unit), array('class'=>'select2')) !!}
                                            <?php } else { ?>
                                                {!! Form::select('planning_unit', $planning_unit, old('planning_unit'), array('class'=>'select2')) !!}	
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Capacity Unit</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <?php if (isset($portfolio)) { ?>
                                                {!! Form::select('capacity_unit', $capacity_unit, old('capacity_unit',$portfolio->capacity_unit), array('class'=>'select2')) !!}
                                            <?php } else { ?>
                                                {!! Form::select('capacity_unit', $capacity_unit, old('capacity_unit'), array('class'=>'select2')) !!}	
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                                <?php
                            }
                            ?>

                            <div class="row" style="margin: 0;">

                                <div class="col-sm-6">
                                    <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Description</label>
                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <div class="form-input-icon">
                                            <textarea id="description" name="description"  class="form-control border-radius-0"><?php
                                                if (isset($portfolio)) {
                                                    echo $portfolio->description;
                                                }
                                                ?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            </div>
                            <div class="row" style="margin: 0;">
                            
                            <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status</label>
                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <div class="btn-group" data-toggle="buttons">
                                            @if(!isset($portfolio->status))
                                            <a class="active-bttn btn btn-default active">
                                                {!! Form::radio('status','active')!!}Active
                                            </a>
                                            <a class="inactive-btn btn btn-default">
                                                {!! Form::radio('status','inactive') !!}Inactive
                                            </a>
                                            @else
                                            @if($portfolio->status == 'active')
                                            <a class="active-bttn btn btn-default active">
                                                {!! Form::radio('status','active')!!}Active
                                            </a>
                                            <a class="inactive-btn btn btn-default">  {!! Form::radio('status','inactive')!!}Inactive</a>
                                            @else
                                            <a class="active-bttn btn btn-default"> {!! Form::radio('status','active')!!}Active</a>
                                            <a class="inactive-btn btn btn-default active">
                                                {!! Form::radio('status','inactive') !!}Inactive
                                            </a>
                                            @endif
                                            @endif    
                                        </div>
                                    </div>
                                </div>

                            </div>
                            
                            </div>
                        </div>
                    </div>
                    <div class="card-footer card-footer-box text-right">
                        <button type="submit" class="btn btn-primary card-btn">
                            @if(isset($portfolio) && $portfolio->id)
                            Save Changes
                            @else
                            Submit
                            @endif 

                        </button>
                        <a href="{{url('admin/portfolio')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </div>

                    <!-- End Vertical Form -->
                </div>
                {!! Form::close() !!}
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
