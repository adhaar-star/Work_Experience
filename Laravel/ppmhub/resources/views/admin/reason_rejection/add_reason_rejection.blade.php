@extends('layout.adminlayout')

<?php if (isset($reason) && $reason->id) { ?>
    @section('title','Settings | Edit Reason For Rejection')
<?php } else { ?>
    @section('title','Settings | Create Reason For Rejection')
<?php } ?>

@section('body')

{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/sales_organization.js') !!}

<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @include('include.admin_sidebar')

                @if(!isset($reason->id))
                {!! Form::open(array('url' => 'admin/reasonRejection','method'=>'post','id' => 'reasonform')) !!} 
                @else
                {!! Form::open(array('route'=>array('reasonRejection.update',$reason->id),'method' => 'put','id' => 'reasonform')) !!}
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
                                <a href="{{url('admin/reasonRejection')}}">Reason For Rejection</a>
                            </li>
                            <li>
                                <span>
                                    @if(isset($reason) && $reason->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Reason For Rejection</span>
                            </li>
                        </ul>
                    </div>

                    <div class="card card-info-custom margin-bottom-0">
                        <div class="card-header">
                            <h4 class="margin-0">
                                @if(isset($reason) && $reason->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Reason For Rejection
                            </h4>
                            <!-- Vertical Form -->
                        </div>

                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label text-right">Reason For Rejection* :</label>

                                        <div class="col-xs-12 col-sm-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('reason_rejection',isset($reason->reason_rejection) ? $reason->reason_rejection : '',['class'=>'form-control border-radius-0','placeholder'=>'Please enter reason for rejection'])!!}
                                                @if($errors->has('reason_rejection')) 
                                                <div class="text-danger">
                                                    {{ $errors->first('reason_rejection') }}
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
                                                @if(!isset($reason->status))
                                                <a class="active-bttn btn btn-primary active">
                                                    {!! Form::radio('status','active','active')!!}Active
                                                </a>
                                                <a class="inactive-btn btn btn-default">
                                                    {!! Form::radio('status','inactive') !!}Inactive
                                                </a>
                                                @else
                                                @if($reason->status == 'active')
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
                            @if(!isset($reason->id))
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            @else
                            {!!Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn'))!!}
                            @endif
                            <a href="{{url('admin/reasonRejection')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>                      
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div>
    </div> 
</section>
@endsection
