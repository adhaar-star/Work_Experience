@extends('layout.adminlayout')
@section('title','Company Management | Company Details')
@section('body')

<div class="alert alert-danger message" style="display: none">
    <span class="glyphicon glyphicon-ok"></span>
    <em id="msg"></em>
</div>
<div class="alert alert-danger message1" style="display: none">
    <span class="glyphicon glyphicon-ok"></span>
    <em id="msg1"></em>
</div>
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/edit_company_validation.js') !!}
<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @include('include.admin_sidebar')
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here :</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Company Management</a>
                        </li>
                        <li>
                            <span>Company Details</span>
                        </li>
                    </ul>
                </div>
                <h4>Company</h4>                
                    {!! Form::open(array('route'=>array('companyDetails.update','id'=>$company['id']),'method'=>'PUT','id' => 'companyform','files' => true)) !!}                
                <div class="row">
                    <div class="col-md-12">
                        <div class="margin-bottom-50 margin-top-25">
                            <table class="tableizer-table table table-bordered" border="1" style="width: 100%;">
                                <thead>                                                                        
                                    <tr>
                                        <th rowspan="2" class="text-center" width='15%'>Company Name</th>
                                        <th rowspan="2" class="text-center vertical-top" width='15%'>Logo</th>
                                        <th rowspan="2" class="text-center vertical-top" width='15%'>Address</th>
                                        <th rowspan="2" class="text-center vertical-top" width='15%'>Country</th>
                                        <th rowspan="2" class="text-center vertical-top" width='25%'>State</th>
                                        <th rowspan="2" class="text-center vertical-top">Action</th>
                                    </tr>
                                </thead>
                                <tbody>                                     
                                    <tr>
                                        <td class="startrange">                                            
                                            {!! Form::text('company_name',isset($company->company_name)? $company->company_name : '',array('class'=>'form-control')) !!}
                                            @if($errors->first('company_name'))
                                                <div style="color:red">
                                                    {{$errors->first('company_name')}}
                                                </div>
                                            @endif
                                        </td>                                        
                                        <td class="startrange text-center">
                                            @if(isset($company->logo))
                                                <img src="/companylogos/{{$company->logo}}" height="60" width="60" />
                                            @endif
                                            {!! Form::file('logo') !!}                                            
                                            @if($errors->first('logo'))
                                                <div style="color:red">
                                                    {{$errors->first('logo')}}
                                                </div>
                                            @endif
                                        </td>                                        
                                        <td class="startrange">
                                            {!! Form::textarea('address',isset($company->address)? $company->address : '',array('class'=>'form-control', 'rows'=> '5')) !!}
                                            @if($errors->first('address'))
                                                <div style="color:red">
                                                    {{$errors->first('address')}}
                                                </div>
                                            @endif
                                        </td>                                                                                                                                                                                                       
                                        <td class="startrange">
                                            {!! Form::select('country',$country,isset($company->country)?$company->country : '',array('class'=>'form-control select2', 'id'=>'country')) !!}
                                            @if($errors->first('country'))
                                                <div style="color:red">
                                                    {{$errors->first('country')}}
                                                </div>
                                            @endif
                                        </td>                                                                                                                                                                                                       
                                        <td class="startrange">
                                            {!! Form::select('state',isset($state_list)?$state_list:[],isset($company->state) ? $company->state : '',array('class'=>'form-control select2' ,'id'=>'state')) !!}
                                            @if($errors->first('state'))
                                                <div style="color:red">
                                                    {{$errors->first('state')}}
                                                </div>
                                            @endif
                                        </td>                                                                                                                                                                                                       
                                        <td>{!! Form::submit('Save Changes',array('class'=>'btn btn-info editInquiryrange')) !!}</td>
                                    </tr>                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection