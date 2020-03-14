<?php
use \App\Models\Helper;
?>
@section('content')

<div class="container-fluid">
  <div class="row">
      <div class="col-md-4 col-md-offset-4 col-sm-8 col-sm-offset-2 col-xs-12">
        <div class="login-container">
        <div class="panel panel-default">
            <div class="panel-heading">
              <h3 class="panel-title"><i class="fa fa-unlock"></i> Please provide login details</h3>
            </div>
            <div class="panel-body">
            <form action="{{ Helper::adminUrl('login') }}" method="post">
              {!!\App\Models\Helper::alert()!!}
                {{csrf_field()}}
                <div class="form-group {{$errors->has('username') ? 'has-error' : ''}}">
                   <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    <input name="username" type="text" class="form-control">
                  </div>
                  <div class="help-block">{{$errors->first('username')}}</div>
                </div>
                 <div class="form-group {{$errors->has('password') ? 'has-error' : ''}}">
                   <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-lock"></i></div>
                    <input name="password" type="password" class="form-control">
                  </div>
                  <div class="help-block">{{$errors->first('password')}}</div>
                </div>
               
                <div class="text-right">
                  <a class="pull-left" href="{{ Helper::adminUrl('forgot-password') }}">Forgot password?</a>
                  <button class="btn btn-primary" type="submit"><i class="fa fa-key"></i> Login</button>
                </div>
                 
            </form>
          </div>
        </div>
      </div>
      </div>
  </div>
</div>
@stop