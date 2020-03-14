<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title">Send Notification</h3>

      </div>
      <div class="panel-body">

          <form action="<?= Helper::adminUrl('marketing/notifications') ?>" method="post" class="form-horizontal">
              {{csrf_field()}}

            
              <div class="col-sm-12">
                <p class="error">All fields marked in asterisk (*) are mandatory to be filled.</p>

                <?= Helper::alert() ?>
                                      
                   <div class="form-group  {{ $errors->has('message') ? 'has-error' : '' }}">

                        <label class="col-sm-12">Notification Title <i class="error">*</i></label>
                           <div class="col-sm-12">
                               <input type="text" name="title" class="form-control" value="{{old('title')}}" required>
                            <div class="help-block">{{ $errors->first('title') }}</div>
                      </div>


                       <label class="col-sm-12">Message <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <textarea name="message" class="form-control" required>{{old('message')}}</textarea>
                        <div class="help-block">{{ $errors->first('message') }}</div>
                      </div>
                  </div>

                          
            

          <div class="form-group">
            <div class="col-sm-12">
              <button class="btn btn-default"><i class="fa fa-plus"></i> Send</button>
          </div>
      </div>

  </div>
</form>
</div>
</div>
</div>
</div>
@stop
