<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><?= $page_title ?> <span class="pull-right hidden-xs"><a href="javascript:;" class="btn btn-default"><i class="fa fa-plus"></i> Save</a> <a href="<?= Helper::adminUrl('page') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back to listing</a></span></h3>

      </div>
      <div class="panel-body">

          <form action="<?= Helper::adminUrl('page/save') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              {{csrf_field()}}

              @if (!empty($page->id)) 
                <input type="hidden" name="id" value="{{$page->id}}">
              @endif
              <div class="col-sm-12">
                <p class="error">All fields marked in asterisk (*) are mandatory to be filled.</p>

                <?= Helper::alert() ?>
          
                 <div class="form-group  {{ $errors->has('title') ? 'has-error' : '' }}">
                     <label class="col-sm-12">Title <i class="error">*</i></label>
                     <div class="col-sm-12">
                     <input type="text" name="title" value="{{Input::old('title', $page->title)}}" class="form-control" required>
                      <div class="help-block">{{ $errors->first('title') }}</div>
                    </div>
                </div>

                <div class="form-group  {{ $errors->has('slug') ? 'has-error' : '' }}">
                     <label class="col-sm-12">Slug <i class="error">*</i></label>
                     <div class="col-sm-12">
                     <input type="text" name="slug" value="{{Input::old('slug', $page->slug)}}" class="form-control" required>
                      <div class="help-block">{{ $errors->first('slug') }}</div>
                    </div>
                </div>

                <div class="form-group  {{ $errors->has('label') ? 'has-error' : '' }}">
                     <label class="col-sm-12">Label</label>
                     <div class="col-sm-12">
                     <input type="text" name="label" value="{{Input::old('label', $page->label)}}" class="form-control">
                      <div class="help-block">{{ $errors->first('label') }}</div>
                    </div>
                </div>

                <div class="form-group  {{ $errors->has('content') ? 'has-error' : '' }}">
                     <label class="col-sm-12">Content <i class="error">*</i></label>
                     <div class="col-sm-12">
                     <textarea  name="content" class="form-control" required>{{Input::old('content', $page->content)}}</textarea>
                      <div class="help-block">{{ $errors->first('content') }}</div>
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