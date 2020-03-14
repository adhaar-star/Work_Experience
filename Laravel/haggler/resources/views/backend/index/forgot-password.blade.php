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
              <h3 class="panel-title"><i class="fa fa-unlock"></i> Please enter you registered email</h3>
            </div>
            <div class="panel-body">
            <form action="{{ Helper::adminUrl('forgot-password') }}" method="post">
              {!!\App\Models\Helper::alert()!!}
                {{csrf_field()}}
                <div class="form-group {{$errors->has('email') ? 'has-error' : ''}}">
                   <div class="input-group">
                    <div class="input-group-addon"><i class="fa fa-user"></i></div>
                    <input name="email" type="text" class="form-control" placeholder="someone@gmail.com ">
                  </div>
                  <div class="help-block">{{$errors->first('email')}}</div>
                </div>
                
               
                <div class="text-right">
                  <a href="{{ Helper::adminUrl('/') }}" class="pull-left">Back to login?</a>
                  <button class="btn btn-primary" type="submit"><i class="fa fa-key"></i> Reset</button>
                </div>
                 
            </form>
          </div>
        </div>
      </div>
      </div>
  </div>
</div>
@stop