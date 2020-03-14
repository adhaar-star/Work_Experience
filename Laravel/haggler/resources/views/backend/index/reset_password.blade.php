<?php
use \App\Models\Helper;
?>
@section('content')

<?php
   // echo "<pre>";
   //   print_r($user);
   // echo "</pre>";
//var_dump($errors);


?>

  <div class="col-md-12">
     <form method="POST" action="{{ Helper::adminUrl('reset-password') }}" >
      {!!\App\Models\Helper::alert()!!}
      {{csrf_field()}}
      <input type="hidden" name="user_id" value="{{ $user->id }}">
       <div class="form-group">
       <label for="username">UserName</label>
          <input type="text" name="username" class="form-control" value="{{ $user->username }}">
          <div class="help-block"></div>
       </div>

       <div class="form-group {{ $errors->has('password') ? 'has-error' : '' }}">
          <label for="password">Password</label>
          <input type="password" name="password" class="form-control">
          <div class="help-block">{{ $errors->first('password') }}</div>
       </div>

       <div class="form-group {{ $errors->has('password_confirmation') ? 'has-error' : '' }}">
          <label for="password_confirmation">Confirmed Password</label>
          <input type="password" name="password_confirmation" class="form-control">
          <div class="help-block">{{ $errors->first('password_confirmation') }}</div>
       </div>

       <input type="submit" value="submit" class="btn btn-primary">

     </form>
  </div>

@stop