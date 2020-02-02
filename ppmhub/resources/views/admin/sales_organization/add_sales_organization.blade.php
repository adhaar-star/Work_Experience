@extends('layout.adminlayout')

<?php if (isset($salesorg) && $salesorg->id) { ?>
    @section('title','Settings | Edit Sales Organization')
<?php } else { ?>
    @section('title','Settings | Create Sales Organization')
<?php } ?>

@section('body')

{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/sales_organization.js') !!}

<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @include('include.admin_sidebar')

                @if(!isset($salesorg->id))
                {!! Form::open(array('url' => 'admin/salesorganization','method'=>'post','id' => 'salesorgform')) !!} 
                @else
                {!! Form::open(array('route'=>array('salesorganization.update',$salesorg->id),'method' => 'put','id' => 'salesorgform')) !!}
                @endif
                {{ csrf_field() }}


                <div class="margin-bottom-50">
                    <div class="margin-bottom-50">
                        <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                <a href="{{url('admin/dashboard')}}">Settings</a>
                            </li>
                            <li>
                                <a href="{{url('admin/salesorganization')}}">Add Sales Organization</a>
                            </li>
                            <li>
                                <span>
                                    @if(isset($salesorg) && $salesorg->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Sales Organization</span>
                            </li>
                        </ul>
                    </div>

                    <div class="card card-info-custom margin-bottom-0">
                        <div class="card-header">
                            <h4 class="margin-0">
                                @if(isset($salesorg) && $salesorg->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Sales Organization
                            </h4>
                            <!-- Vertical Form -->
                        </div>

                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label text-right">Sales organization name* :</label>

                                        <div class="col-xs-12 col-sm-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('sales_organization',isset($salesorg->sales_organization) ? $salesorg->sales_organization : '',['class'=>'form-control border-radius-0','placeholder'=>'Please enter sales organization'])!!}
                                                @if($errors->has('sales_organization')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('sales_organization') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>	
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label text-right">Status :</label>

                                        <div class="col-sm-10">
                                            <div class="btn-group" data-toggle="buttons">
                                                @if(!isset($salesorg->status))
                                                <a class="active-bttn btn btn-primary active">
                                                    {!! Form::radio('status','active','active')!!}Active
                                                </a>
                                                <a class="inactive-btn btn btn-default">
                                                    {!! Form::radio('status','inactive') !!}Inactive
                                                </a>
                                                @else
                                                @if($salesorg->status == 'active')
                                                <a class="active-bttn btn btn-primary active">
                                                    {!! Form::radio('status','active')!!}Active
                                                </a>
                                                <a class="inactive-btn btn btn-default">  
                                                    {!! Form::radio('status','inactive')!!}Inactive
                                                </a>
                                                @else
                                                <a class="active-bttn btn btn-primary"> 
                                                    {!! Form::radio('status','active')!!}Active
                                                </a>
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
                        <div class="card-footer card-footer-box">
                            @if(!isset($salesorg->id))
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            @else
                            {!!Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn'))!!}
                            @endif
                            <a href="{{url('admin/salesorganization')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>                      
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>
@endsection
