<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">

  <div class="row">
    <div class="col-sm-12">
        {!!Helper::alert()!!}

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><?= $page_title ?> 
          <span class="pull-right hidden-xs">

          @if ($vendor->store)
          <a href="<?= Helper::adminUrl('store/edit/' . $vendor->store->storeId) ?>" class="btn btn-default"><i class="fa fa-plus"></i> Store</a>
          @endif
          <a href="<?= Helper::adminUrl('user/vendors') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back to listing</a>
           </span></h3>

      </div>
      <div class="panel-body">

     
          <form action="<?= Helper::adminUrl('user/save-vendor') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              {{csrf_field()}}

              @if (!empty($vendor->id)) 
                <input type="hidden" name="id" value="{{$vendor->id}}">
              @endif
              <div class="col-sm-12">
                <p class="error">All fields marked in asterisk (*) are mandatory to be filled.</p>

                <?= Helper::alert() ?>
                                      
                   <div class="form-group  {{ $errors->has('username') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Vedor Name <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="username" value="{{Input::old('username', $vendor->username)}}" class="form-control" required>
                        <div class="help-block">{{ $errors->first('username') }}</div>
                      </div>
                  </div>

                   <div class="form-group  {{ $errors->has('password') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Password <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="password" value="{{Input::old('password')}}" class="form-control" {{ !empty($vendor->id) ? '' : 'required' }}>
                        <div class="help-block">{{ $errors->first('password') }}</div>
                      </div>
                  </div>

                  <div class="form-group  {{ $errors->has('email') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Email <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="email" value="{{Input::old('email', $vendor->email)}}" class="form-control" required>
                        <div class="help-block">{{ $errors->first('email') }}</div>
                      </div>
                  </div>

                   <div class="form-group  {{ $errors->has('status') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Status</label>
                       <div class="col-sm-12">
                       <select name="status"  class="form-control">

                          @foreach(\App\Models\User::statusList() as $key => $status)
                          <option value="{{$key}}" {{ (Input::old('status', $vendor->status) == $key ) ? 'selected' : '' }}>{{$status}}</option>
                                                                                            
                          @endforeach 

                        </select>
                        <div class="help-block">{{ $errors->first('status') }}</div>
                      </div>
                  </div>

                            

          <div class="form-group">
            <div class="col-sm-12">
              <button class="btn btn-default"><i class="fa fa-plus"></i> Save</button>
          </div>
      </div>

  </div>
</form>
</div>
</div>
</div>
</div>
@stop