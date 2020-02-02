@extends('layout.admin')
@section('title', 'Gl Account')
@section('body')
@include('layout.admin_layout_include.alert_messages')
<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @if(!empty($glAccount))
                    {!! Form::open([ 'route' => ['glAccounts.update', $glAccount->gl_account_id],  'method' => 'put', 'class' => 'form-horizontal GlobalFormValidation' ]) !!}
                @else
                    {!! Form::open([ 'route' => ['glAccounts.create'], 'method' =>'post', 'class'=> 'form-horizontal GlobalFormValidation' ]) !!}
                @endif
                <div class="margin-bottom-50">
                    <div class="row PageTitleGlobal">
                        <div class="col-md-6">
                            <h1>GL Accounts</h1>
                        </div>
                        <div class="col-md-6 text-right">
                            <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                            <ul class="list-unstyled breadcrumb breadcrumb-custom">
                                <li>
                                    <a href="{{url('admin/dashboard')}}">Dashboard</a>
                                </li>
                                <li>
                                    <a href="{{route('glAccounts.dashboard')}}">GL Accounts</a>
                                </li>
                                <li><span>Create GL Account</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                                @if(empty($glAccount) )
                                    <h4 class="margin-0">Create GL Account</h4>
                                @else
                                    <h4 class="margin-0">Update GL Account</h4>
                                @endif
                        </div>
                        <div class="card-block">
                             <div class="row" style="margin: 0;">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="  col-md-4 col-form-label text-right">Gl Account No.:</label>
                                        <div class="col-xs-12   col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('number', !empty($glAccount) ? $glAccount->number : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Gl Account No.',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Gl Account No. Is Required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="  col-md-4 col-form-label text-right">Gl Account Description:</label>
                                        <div class="col-xs-12   col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('description', !empty($glAccount) ? $glAccount->description : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Gl Account Description',
                                                'maxlength' => 18,
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Gl Account Description Is Required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="  col-md-4 col-form-label text-right">Gl Account Type:</label>
                                        <div class="col-xs-12   col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('gl_account_type', !empty($glAccount) ? $glAccount->gl_account_type : null, [
                                                'class'=>'form-control border-radius-0',
                                                'placeholder'=>'Gl Account Type',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'Gl Account Type Is Required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="  col-md-4 col-form-label text-right">Cost Element Type:</label>
                                        <div class="col-xs-12   col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('gl_account_element_type', !empty($glAccount) ? $glAccount->gl_account_element_type : null, [
                                                    'class'=>'form-control border-radius-0',
                                                    'placeholder'=>'Gl Element Type',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Gl Element Type Is Required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="  col-md-4 col-form-label text-right">Gl Account Tax Type:</label>
                                        <div class="col-xs-12   col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('gl_account_tax', !empty($glAccount) ? $glAccount->gl_account_tax : null,  [
                                                    'class'=>'form-control border-radius-0',
                                                    'placeholder'=>'Gl Account  Tax Type',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Gl  Tax Type Is Required',
                                                ]) !!}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-md-4 col-form-label text-right">Flag Type:</label>
                                        <div class="col-xs-12 col-md-8">
                                            <div class="form-input-icon col-md-7" style="padding-left: 0;">
                                                {!! Form::select('type_flag', $GlAccountFlagType->pluck('flag_type', 'flag_type'),
                                                    !empty($glAccount) ? $glAccount->type_flag : null,
                                                  [
                                                    'class'=>'form-control border-radius-0 GlFlagTypes',
                                                    'placeholder'=>'Gl Account  Flag Type',
                                                    'data-fv-notempty' => true,
                                                    'data-fv-blank' => true,
                                                    'data-rule-required' => true,
                                                    'data-fv-notempty-message' => 'Gl  Flag Type Is Required',
                                                ]) !!}

                                            </div>
                                            <button  data-toggle="modal" data-target="#manageFlagType" class="btn-success  btn" type="button">Manage Flag Type</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 col-lg-offset-1" style="margin-top: 10px;">
                                    @include('layout.admin_layout_include.alert_process')
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-footer-box text-right">
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            <a href="{{route('glAccounts.dashboard')}}">
                                <button type="button" class="btn btn-danger">Cancel</button>
                            </a>
                        </div>
                    </div>
                </div>
                {!!Form::close()!!}
            </div>
        </div>
        @if(empty($glAccount) )
        <div class="row">
            <div class="col-lg-12">
                    {!! Form::open([ 'route' => ['glAccounts.create'], 'method' =>'post',  'enctype' =>'multipart/form-data', 'class'=> 'form-horizontal' ]) !!}
                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                             <h4 class="margin-0">Create GL Account Form CSV</h4>
                        </div>
                        <div class="card-block">
                             <div class="row" style="margin: 0;">
                                <div class="col-md-10 col-lg-offset-1">

                                    <div class="form-group row">
                                        <label class="  col-md-4 col-form-label text-right">Upload CSV File:</label>
                                        <div class="col-xs-12   col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::file('gl_account_csv', [
                                                'class'=>'form-control border-radius-0',
                                                'accept' => '.csv',
                                                'data-fv-notempty' => true,
                                                'data-fv-blank' => true,
                                                'data-rule-required' => true,
                                                'data-fv-notempty-message' => 'CSV Is Required',
                                                ]) !!}

                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-10 col-lg-offset-1" style="margin-top: 10px;">
                                    @include('layout.admin_layout_include.alert_process')
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-footer-box text-right">
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            <a href="{{route('glAccounts.dashboard')}}">
                                <button type="button" class="btn btn-danger">Cancel</button>
                            </a>
                        </div>
                    </div>

                {!!Form::close()!!}
            </div>
        </div>
        @endif
        <div class="modal fade table-view-popup" id="manageFlagType" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
            <div class="modal-dialog" role="document" style="text-align:left;">
                <div class="modal-content" style="border-radius: 0;">
                    <div class="modal-header bg-success" >
                        <div class="col-sm-12">
                            <h3 class="model-list-striped-title text-white">Manage GL Account Flag Type</h3>
                            <button type="button" class="btn btn-danger pull-right" data-dismiss="modal" aria-label="Close"><i class="fa fa-close"></i></button>
                        </div>
                    </div>
                    <div class="modal-body fTUrl " data-url="{{ route('gl-account-flag-type-save') }}"  style="    max-height: 480px;    overflow-y: scroll;    overflow-x: hidden;">
                        <div class="pleaseWait hidden">
                            <i class="fa fa-spinner"></i><br> Please wait...
                        </div>
                        <div class="row">
                            <div class="col-md-12 flagType">
                                <div class="col-md-9">
                                    {!!Form::text('flag', null, ['class'=>'form-control border-radius-0', 'data-flagID' => 0, 'placeholder'=>'Enter Flag Type','maxlength' => 30 ] )!!}
                                </div>
                                <div class="col-md-3">
                                    <button class="btn btn-warning manageFlag" type="button"><i class="fa fa-plus"></i></button>
                                </div>
                            </div>
                        </div>
                        <div class="row newFT">
                            @if($GlAccountFlagType->count())
                                @forelse($GlAccountFlagType->get() as $item)
                                 <div class="col-md-12 flagType margin-top-5">
                                    <div class="col-md-9">
                                        {!!Form::text('flag', $item->flag_type, ['class'=>'form-control border-radius-0 ',  'data-flagID' => $item->gl_account_flag_type_id, 'placeholder'=>'Enter Flag Type','maxlength' => 30 ] )!!}
                                    </div>
                                    <div class="col-md-3">
                                        <button class="btn btn-primary manageFlag" type="button"><i class="fa fa-edit"></i></button>
                                    </div>
                                </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>
@endsection

@section('PageJquery')
    {!! Html::script('vendors/formValidation/js/formValidation.min.js') !!}
    {!! Html::script('vendors/formValidation/js/framework/bootstrap.min.js') !!}
    {!! Html::script('js/globalValidationCustom.js') !!}

    <script type="text/javascript">
        $(document).ready(function() {


            $('#manageFlagType').on("click", '.manageFlag', function () {
                var container = $(this).closest('.flagType');
                var flagType = container.find('input').val();
                var flagTypeID = container.find('input').attr('data-flagID');
                var URL = $('.fTUrl').attr('data-url');
                if(URL != '' &&  flagType != ''){
                    container.find('input').val('');
                    $('.pleaseWait').removeClass('hidden');

                    $.ajax({
                        type: "POST",
                        cache: false,
                        url: URL,
                        data: { flag_type : flagType, gl_account_flag_type_id : flagTypeID,  "_token": "{{ csrf_token() }}" },
                        success: function(json){
                            $('.pleaseWait').addClass('hidden');
                            if(json.status == 'success'){

                                $('.GlFlagTypes').html('<option selected="selected" disabled="disabled" hidden="hidden" value="">Select Flag Type</option>')
                                $.each( json.GlAccountFlagType, function( key, value ) {
                                    $('.GlFlagTypes').append('<option value="'+value+'">'+ value+'</option>')
                                });
                                if(flagTypeID == 0){
                                    var html ='<div class="col-md-12 flagType margin-top-5">';
                                    html += '<div class="col-md-9"><input class="form-control border-radius-0" data-flagID="' + json.id + '" value="' + flagType + '"  placeholder="Enter Flag Type" maxlength="30"></div>';
                                    html += '<div class="col-md-3"><button class="btn btn-primary manageFlag" type="button"><i class="fa fa-edit"></i></button></div></div>';
                                    $('.newFT').prepend(html);
                                }else{
                                    container.find('input').val(flagType);
                                }
                            } else if(json.status == 'false') {

                            } else if(json.status == 'validation'){

                            }
                        },
                        error : function(json){

                        },
                        dataType: "json"
                    });
                }

            });
        });
    </script>

@endsection