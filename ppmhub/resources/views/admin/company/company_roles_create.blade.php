@extends('layout.adminlayout')
@section('title','Role Management | Company Roles')
@section('body')
<script src="http://code.gijgo.com/1.5.1/js/gijgo.js" type="text/javascript"></script>
<link href="http://code.gijgo.com/1.5.1/css/gijgo.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style>
    /*    .row {
            margin: 10px;
        }*/


    .breadcrumb {
        -webkit-border-radius: 0px;
        border-radius: 0px;
        background: none;
        padding: .75rem;
        margin-bottom: 0rem;
        list-style: none;
        /*background-color: #eceeef;*/
        border-radius: .25rem;
    }

</style>
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif
@if(Session::has('error_message'))
<div class="alert alert-danger">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('error_message') !!}</em>
</div>
@endif
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/edit_company_validation.js') !!}
<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="margin-bottom-50">
                <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                <ul class="list-unstyled breadcrumb breadcrumb-custom">
                    <li>
                         <a href="{{url('admin/dashboard')}}">Role Management</a>
                    </li>
                    <li>
                        <a href="{{url('admin/CompanyRoles/')}}">Company Roles</a>
                    </li>
                    <li>
                        <span> 
                            @if (isset($companyRoles) && $companyRoles->id) 
                            Edit
                            @else
                            Create
                            @endif
                            Company Roles
                        </span>
                    </li>
                </ul>


            </div>
            <form id="roleform" method="POST" action="<?php
            if (isset($companyRoles) && $companyRoles->id) {
                echo url('admin/CompanyRoles/' . $companyRoles->id);
            } else {
                echo url('admin/CompanyRoles/');
            }
            ?>" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                {{ csrf_field() }}
                @if(isset($companyRoles) && $companyRoles->id)
                {{ method_field('PUT') }}
                @endif 
                <div class="margin-bottom-50">

                    <div class="card card-info-custom margin-bottom-0">
                        <div class="card-header bg-lightcyan">
                            <h4 class="margin-0">
                                @if(isset($companyRoles) && $companyRoles->id)
                                Edit :
                                @else
                                Create 
                                @endif : 
                                Company Role
                            </h4>
                            <!-- Vertical Form -->
                        </div>



                        <div class="card-block">
                            <div class="row">
                                <div class="col-xs-12 col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for='l33'>Role Name*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon" >
                                                {!!Form::text('role_name',isset($companyRoles->role_name) ? $companyRoles->role_name : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please Enter Role Name'))!!}
                                                @if($errors->has('role_name')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('role_name') }}
                                                </div> 
                                                @endif
                                                 <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7 error-message" style='display:none;'> </div> 
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="col-xs-12 col-sm-6">

                                    <div class="form-group row">
                                        <div id="accordion" role="tablist" aria-multiselectable="true">
                                            <div class="card">
                                                <div class="card-header" role="tab" id="headingOne">
                                                    <h5 class="mb-0">
                                                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                                            Permissions and Policies
                                                        </a>
                                                    </h5>
                                                </div>

                                                <div id="collapseOne" class="collapse in" role="tabpanel" aria-labelledby="headingOne">
                                                    <div class="card-block">
                                                        <div class="container-fluid">
                                                            <div class="row">
                                                                <div id="companyadmin"></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
        </div>
          
    </div>
  
    <div class="card-footer card-footer-box text-right">

        <button id="btn_save" type="button" class="btn btn-primary card-btn">
            @if(isset($companyRoles) && $companyRoles->id)
            Save Changes
            @else
            Submit
            @endif 
        </button>
        <a href="{{url('admin/CompanyRoles')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
    </div>                 
</form>           
</div>
</div>
</section> 

<script>
$(document).ready(function () {
    tree = $('#companyadmin').tree({
        primaryKey: 'id',
        uiLibrary: 'bootstrap',
        dataSource: "{{url('/admin/route-paths/Get')}}{{(isset($id)?'/'.$id:'')}}",
        checkboxes: true
    });

});


$('#btn_save').click(function (evt) {
    $('#mask').show();
    $data = {};
    $formData = $('form').serializeArray();
    for (x in $formData)
    {
        console.log(x, $formData[x]);
        $data[$formData[x].name] = $formData[x].value;
    }

    var checkedIds = tree.getCheckedNodes();
    $data['checkedIds'] = checkedIds;

    var token = $('input[name^=_token]').val();
    $.ajax({
        url: "{{url('/admin/CompanyRoles')}}{{(isset($id)?'/'.$id:'')}}",
        type: "{{isset($id)?'PUT':'POST'}}",
        data: $data,
        dataType: "JSON"
    }).fail(function (data, textStatus, xhr) {
        //This shows status code eg. 403
        if (data.status == 403)
        {
            $('#mask').hide();
            alert(xhr + ':You do not have sufficent permission to perform this action.');
        }

    }).done(function (msg) {
        if ('redirect_url' in msg)
        {
            window.location.href = location.origin + '/' + msg['redirect_url'];
            $('#mask').hide();
            $('.error-message').hide();
        }
        if ('error' in msg)
        {
            $('#mask').hide();
            for (x in msg['error'])
                $('.error-message').append('<p style="color:red;">' + msg['error'][x] + '</p>');
            $('.error-message').show();
        }

    });
});
</script>
@endsection