<?php
use \App\Models\Helper;
?>

@section('header')
<link href="{{url('assets/jquery-ui/jquery-ui.min.css')}}" type="text/css" rel="stylesheet">
@stop
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><?= $page_title ?> <span class="pull-right hidden-xs"><a href="javascript:;" class="btn btn-default"><i class="fa fa-plus"></i> Save</a> <a href="<?= Helper::adminUrl('slider') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back to listing</a></span></h3>

      </div>
      <div class="panel-body">

          <form action="<?= Helper::adminUrl('slider/save') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              {{csrf_field()}}

              @if (!empty($slider->id)) 
                <input type="hidden" name="id" value="{{$slider->id}}">
              @endif
              <div class="col-sm-12">
                <p class="error">All fields marked in asterisk (*) are mandatory to be filled.</p>

                <?= Helper::alert() ?>
          
                   <div class="form-group  {{ $errors->has('title') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Slider Title <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="title" value="{{Input::old('title', $slider->title)}}" class="form-control" required>
                        <div class="help-block">{{ $errors->first('title') }}</div>
                      </div>
                  </div>

                  @for ($i=1; $i<=4; $i++)

                  <?php
                    $image = "image_$i";
                    $link = "link_$i";
                   ?>
                  <!-- slides -->
                  <div class="form-group">  
                    <!-- <div class="col-sm-12"> -->
                      <div class="col-sm-12">                              
                        <h4>Slide {{$i}}</h4>
                        <hr>
                        <br>
                      </div>
                      <div class="col-sm-12">
                        <div class="form-group  {{ $errors->has($image) ? 'has-error' : '' }}">
                          <label class="col-sm-12">Image @if ($i == 1 && empty($slider->getImage(1))) <i class="error">*</i> @endif</label>
                          <div class="col-sm-12">
                            <input type="file" name="image_{{$i}}" class="form-control" @if ($i == 1 && empty($slider->getImage(1))) required @endif>
                            <div class="help-block field-info">Image resolution should be 1:1 (Minimum resolution: 1000x563)</div>
                            <div class="help-block">{{ $errors->first($image) }}</div>
                          </div>
                          <div class="col-sm-12">
                            @if(!empty($slider->getImage($i)))
                            <img src="{{ $slider->getImage($i) }}" width="100" alt="{{ $slider->getImage($i) }}">
                            @endif
                          </div>
                        </div>
                        <div class="form-group  {{ $errors->has($link) ? 'has-error' : '' }}">
                          <label class="col-sm-12">Link @if ($i == 1) <i class="error">*</i> @endif</label>
                          <div class="col-sm-12">
                            <input type="hidden" name="type_{{$i}}" id="type_{{$i}}" value="{{Input::old('type_' . $i, $slider->getType($i))}}">
                            <input type="hidden" name="id_{{$i}}" value="{{Input::old('id_' . $i, $slider->getID($i))}}" id="id_{{$i}}">
                            <input type="text" name="link_{{$i}}" value="{{Input::old($link, $slider->getSource($i))}}" class="form-control" id="autocomplete_{{$i}}" @if ($i == 1) required @endif>
                            <div class="help-block field-info">Start typing slowly, List of product and deals,events will populate</div>
                            <div class="help-block">{{ $errors->first($link) }}</div>
                          </div>
                        </div>
                      </div>
                    <!-- </div> -->
                  </div>
                
                <!-- slides ends here -->
                @endfor
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



@section('after_footer')

<script src="{{url('assets/jquery-ui/jquery-ui.min.js')}}"></script>


<script>

$(function () {

  @for ($i=1; $i<=4; $i++)

      $( "#autocomplete_{{$i}}" ).autocomplete({
      source: "<?= Helper::adminUrl('dashboard/search-all') ?>",
      minLength: 1,
      select: function( event, ui ) {
        $('#id_{{$i}}').val(ui.item.id);
        $('#type_{{$i}}').val(ui.item.type);
      }
    });

  @endfor
      
  });


</script>

@stop