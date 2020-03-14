<?php
use \App\Models\Helper;
?>
@section('content')
<style>
	#map_canvas

	  {
        height: 400px;
        width: 600px;
        margin-top: 0.6em;
      }

</style>
<div class="container-fluid">
 <?= Helper::alert() ?>
  <div class="row">
       <div class="col-md-6">
        <form action="{{ Helper::adminUrl('setting/change-password') }}" method="POST">
          {{ csrf_field() }}

            <input type="hidden" name="user_id" value="{{ $user->id }}" />
          <div class="form-group">
            <label for="new_password">New Password</label>
            <!-- <div class="col-sm-12"> -->
              <input type="text" name="password" class="form-control" >
            <!-- </div> -->
          </div>

           <div class="form-group">
            <label for="new_password">Confirm Password</label>
            <!-- <div class="col-sm-12"> -->
              <input type="text" name="password_confirmation" class="form-control" >
            <!-- </div> -->
          </div>

          <input type="submit" value="submit" class="btn btn-primary" style="margin-top:20px">
        </form>
        
          
       
       </div>

  </div>  
</div>



@stop


