@extends('layout.adminlayout')
@section('title','Settings | View | Edit View')
@section('body')
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        {{ $error }}
        @endforeach
    </ul>
</div>
@endif
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
<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @include('include.admin_sidebar')
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here :</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Settings</a>
                        </li>
                        <li>
                            <span>View</span>
                        </li>
                        <li>
                            <span>Edit View</span>
                        </li>
                    </ul>
                </div>
                <h4>Edit View</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="margin-bottom-50 margin-top-25">
                            <table class="tableizer-table table table-bordered text-center" border="1" style="width: 40%;">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center">View Name</th>
                                        <th rowspan="2" class="text-center vertical-top">Action</th>
                                    </tr>
                                </thead>
                                <tbody> 
                                    {!! Form::open(array('route'=>array('view.update',$view_edit->id),'method' => 'put','id'=>'view')) !!}
                                    <tr id="editInquiry_{{$view_edit->id}}" class="range">
                                        <td class="startrange">
                                            {!!Form::text('view_name',$view_edit->view_name,array('class'=>'form-control border-radius-0 view_name','id'=>'view_name'))!!}
                                        </td>
                                        <td> 
                                            {!! Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn save')) !!}  
                                        </td>
                                    </tr>
                                    {!!Form::close()!!}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection