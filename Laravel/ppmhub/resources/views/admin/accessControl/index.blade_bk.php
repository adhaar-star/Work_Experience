@extends('layout.adminlayout')
@section('title','Access Control | Settings')
@section('body')
<meta name="csrf-token" content="{{ csrf_token() }}">
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
<script src="http://code.gijgo.com/1.5.1/js/gijgo.js" type="text/javascript"></script>
<link href="http://code.gijgo.com/1.5.1/css/gijgo.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<style>
    .breadcrumb {
        -webkit-border-radius: 0px;
        border-radius: 0px;
        background: none;
        padding: .75rem;
        margin-bottom: 0rem;
        list-style: none;
        border-radius: .25rem;
    }
    .tab-block-fix {
        height: calc(100vh - 150px);
        overflow: hidden;
        overflow-y: auto;
    }
</style>
<section class="panel">
    <div class="panel-body">
        <div class="row">
           
            <div class="margin-bottom-20">
                <span style="margin-right: 10px;position: relative;top: -20px;">You are here :</span>
                <ul class="list-unstyled breadcrumb breadcrumb-custom">
                    <li>
                        <span>Settings</span>
                    </li>
                    <li>
                        <span> Roles and Permissions</span>
                    </li>
                </ul>
            </div>
                <!--<h4>Roles and Permissions</h4>-->
                <form method="POST" action="/">
                    {{ csrf_field() }}

                </form>
                <div class="row">
                    <div class="col-md-12">
                        <div class="margin-bottom-50">
                            <!-- Role Access -->
                            <div class="row">
                                <div class="col-md-3 col-sm-3 col-xs-3">
                                    <ul class="nav nav-tabs tabs-left">
                                        @foreach($roles as $key=>$role)
                                        <li class="nav-item">
                                            <a href="#tab_6_{{$key}}" class="tab {{$loop->first?'active in':''}}" data-toggle="tab" aria-expanded="true"> {{$role->role_name}} </a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="col-md-9 col-sm-9 col-xs-9">
                                    <div class="tab-content tab-block-fix">
                                        @foreach($roles as $key=>$role)
                                        <div class="tab-pane {{$loop->first?'active in':''}}" id="tab_6_{{$key}}">
                                            
                                           
                                            <div class="row">
                                                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                                                    <h3 class="margin-top-0">{{$role->role_name}}</h3>
                                                    @if($role->role_name != 'Company Admin')
                                                    <button id="btnSave{{$key}}" class="btn btn-success pull-right">Save Permissions</button>
                                                    @endif
                                                </div>
                                            </div>
                                           
                                            <div class="row">
                                                <div id="{{$role->id}}"></div>
                                            </div>
                                        </div>
                                        @endforeach
                                       
                                    </div>
                                </div>
                            </div>

                            <!-- /Role Access -->
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<script type="text/javascript">

        $(document).ready(function () {
_token = $('_token').val();
        @foreach($roles as $key=>$role)

        tree{{$key}} = $('#{{$role->id}}').tree({
primaryKey: 'id',
        uiLibrary: 'bootstrap',
        dataSource: '/admin/route-paths/Get/{{$role->id}}',
        checkboxes: true
        });
        $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
        $('#btnSave{{$key}}').on('click', function () {
$('#mask').show();
        var checkedIds = tree{{$key}}.getCheckedNodes();
        $.ajax({url: '/admin/route-paths/Store', data: {'_token':_token, 'checkedIds': checkedIds, 'role_id':{{$role->id}}}, 'method': 'POST'})
        .fail(function (data, textStatus, xhr) {
        //This shows status code eg. 403
        if (data.status == 403)
        {
        $('#mask').hide();
                alert(xhr + ':You do not have sufficent permission to perform this action!');
        }

        }).done(function (msg) {
if ('redirect_url' in msg)
        {
        window.location.href = location.origin + '/' + msg['redirect_url'];
                $('#mask').hide();
                $('.error-message').hide();
                }
});
        });
        @if ($role->role_name == 'Company Admin')
        setTimeout(function(){
        console.log('fired');
                console.log({{$role->id}});
                $('#{{$role->id}} input[type="checkbox"]').attr('disabled', 'disabled');
        }, 1500);
        @endif
        @endforeach
        });
</script>
@endsection