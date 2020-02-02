@extends('layout.adminlayout')

<?php if (isset($user_data) && $user_data->id) { ?>
  @section('title','Company Management | Edit User')
<?php } else { ?>
  @section('title','Company Management | Create User')
<?php } ?>

@section('body')

{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/user_register.js') !!}

<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @include('include.admin_sidebar')

                @if(!isset($user_data->id))
                {!! Form::open(array('url' => 'admin/user-managment','method'=>'post','id' => 'Userform')) !!} 
                @else
                {!! Form::open(array('route'=>array('user-management.update',$user_data->id),'method' => 'put','id' => 'Userform')) !!}
                @endif
                {{ csrf_field() }}


                <div class="margin-bottom-50">
                    <div class="margin-bottom-50">
                        <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                <a href="{{url('admin/dashboard')}}">Company Management</a>
                            </li>
                            <li>
                                <a href="{{url('admin/user-managment')}}">User Management</a>
                            </li>
                            <li>
                                <span>
                                    @if(isset($user_data) && $user_data->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    User</span>
                            </li>
                        </ul>
                    </div>

                    <div class="card card-info-custom margin-bottom-0">
                        <div class="card-header card-header-box">
                            <h4 class="margin-0">
                                @if(isset($user_data) && $user_data->id)
                                Edit
                                @else
                                Create
                                @endif 
                                User
                            </h4>
                            <!-- Vertical Form -->
                        </div>

                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-right">First Name*:</label>
                                        <div class="col-sm-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('name',isset($user_data->name) ? $user_data->name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter name'))!!}
                                                @if($errors->has('name')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('name') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Email Id*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('email',isset($user_data->email) ? $user_data->email : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter email'))!!}
                                                @if($errors->has('email')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('email') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Phone No*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('phone',isset($user_data->phone) ? $user_data->phone : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter phone','maxlength'=>'9','minlength'=>'9'))!!}
                                                @if($errors->has('phone')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('phone') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-right">Last Name*:</label>
                                        <div class="col-sm-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('lname',isset($user_data->lname) ? $user_data->lname : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter last name'))!!}
                                                @if($errors->has('lname')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('lname') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-right">Role*:</label>
                                        <div class="col-sm-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('role_id',$roles,isset($user_data->role_id) ? $user_data->role_id : '',array('class'=>'form-control border-radius-0 select2','placeholder'=>'Please select role','id'=>'role_id'))!!}
                                                @if($errors->has('role_id')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('role_id') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-footer-box">
                            @if(!PlanFeatureAccessHelper::canCreateUser())
                            <button type="button" class="btn btn-primary card-btn" data-toggle="modal" data-target="#upgradePlanModal">
                                Save & Send Invitation
                            </button>
                            @else
                            @if(!isset($user_data->id))
                            {!!Form::submit('Save & Send Invitation',array('class'=>'btn btn-primary card-btn'))!!}
                            @else
                            {!!Form::submit('Save Changes & Resend Invitation',array('class'=>'btn btn-primary card-btn'))!!}
                            @endif
                            @endif
                            <a href="{{url('admin/user-managment')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>                      
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div> 
    </div>
    <!--- Bootstrap Model --->
    <div id="upgradePlanModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <div class="col-sm-6"><h5>Update subscription</h5></div>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    @php $userPlan = PlanFeatureAccessHelper::getCurrentPlan() @endphp
                    @if($userPlan !== NULL)
                    <p>Your current subscription is <b>{{ $userPlan->braintree_subscription_plan }}</b>. 
                    <p>You have reached the user limit for this plan.</p>
                    <p>Only {{$userPlan->user}} users are allowed.</p>
                    @else
                    <p>Please subscribe one of the plan to create user.</p>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">No Thanks</button>
                    <a class="btn btn-success" href="{{route('subscriptions.updatesubscription')}}">Go to Update</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap Model -->
</section>
@endsection
