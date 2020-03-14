<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><?= $page_title ?> <span class="pull-right hidden-xs"><a href="javascript:;" class="btn btn-default save-btn" data-form="#event-form"><i class="fa fa-plus"></i> Save</a> <a href="<?= Helper::adminUrl('event') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back to listing</a></span></h3>

      </div>
      <div class="panel-body">

          <form id="event-form" action="<?= Helper::adminUrl('event/save') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              {{csrf_field()}}

              @if (!empty($event->eventId)) 
                <input type="hidden" name="eventId" value="{{$event->eventId}}">
              @endif
              <div class="col-sm-12">
                <p class="error">All fields marked in asterisk (*) are mandatory to be filled.</p>

                <?= Helper::alert() ?>
          
                   <div class="form-group  {{ $errors->has('eventTitle') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Event Title <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="eventTitle" value="{{Input::old('eventTitle', $event->eventTitle)}}" class="form-control" required>
                        <div class="help-block">{{ $errors->first('eventTitle') }}</div>
                      </div>
                  </div>

                                
                  @if (\Auth::user()->role === 'admin') 
                   <div class="form-group  {{ $errors->has('eventVendorId') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Choose Vendor <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <select name="eventVendorId"  class="form-control">
                       <option> - Choose vendor - </option>
                        @if(!empty($adminVendor->all()))
                          @foreach($adminVendor as $item)
                            @if ($item->store)
                              <option value="{{$item->id}}" {{ (Input::old('eventVendorId', $event->eventVendorId) == $item->id) ? 'selected' : '' }}>{{$item->store->storeName}} (Admin's Store)</option>
                            @endif
                          @endforeach 
                        @endif
                        @if(!empty($vendors->all()))
                          @foreach($vendors as $item)
                            @if ($item->store)
                              <option value="{{$item->id}}" {{ (Input::old('eventVendorId', $event->eventVendorId) == $item->id) ? 'selected' : '' }}>{{$item->store->storeName}}</option>
                            @endif
                          @endforeach 
                        @endif
                        </select>
                        <div class="help-block">{{ $errors->first('eventVendorId') }}</div>
                      </div>
                  </div>
                  @else
                  <input type="hidden" name="eventVendorId" value="{{ Input::old('eventVendorId', $event->eventVendorId) }}">
                  @endif

                  
                   <div class="form-group  {{ $errors->has('eventImage') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Event Image <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="file" name="eventImage" class="form-control">
                      <div class="help-block field-info">Image resolution should be 1:1 (Minimum resolution: 1000x1000)</div>
                      <div class="help-block">{{ $errors->first('eventImage') }}</div>
                      </div>
                      <div class="col-sm-12">
                      @if(!empty($event->eventImage))
                      <img src="{{ $event->eventImage }}" width="100" alt="{{ $event->eventTitle }}">
                      @endif
                      </div>
                  </div>

             
              
               <div class="form-group  {{ $errors->has('eventStartDate') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Event Start Date <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="eventStartDate" value="{{Input::old('eventStartDate', $event->eventStartDate)}}" class="form-control datepicker" required>
                        <div class="help-block">{{ $errors->first('eventStartDate') }}</div>
                      </div>
                  </div>

                   <div class="form-group  {{ $errors->has('eventEndDate') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Event End Date <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="eventEndDate" value="{{Input::old('eventEndDate', $event->eventEndDate)}}" class="form-control datepicker" required>
                        <div class="help-block">{{ $errors->first('eventEndDate') }}</div>
                      </div>
                  </div>

                     <div class="form-group  {{ $errors->has('eventDescription') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Event Description <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <textarea  name="eventDescription" class="form-control">{{Input::old('eventDescription', $event->eventDescription)}}</textarea>
                        <div class="help-block">{{ $errors->first('eventDescription') }}</div>
                      </div>
                  </div>

                   <div class="form-group  {{ $errors->has('eventAddress') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Event Venue/Address <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <textarea  name="eventAddress" class="form-control">{{Input::old('eventAddress', $event->eventAddress)}}</textarea>
                        <div class="help-block">{{ $errors->first('eventAddress') }}</div>
                      </div>
                  </div>

                    @if (Auth::user()->role === 'admin')

                    <div class="form-group  {{ $errors->has('eventStatus') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Status <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <select name="eventStatus"  class="form-control">

                          @foreach(['active' => 'Active', 'inactive' => 'Inactive'] as $status => $label)
                          <option value="{{$status}}" {{ (Input::old('eventStatus', $event->eventStatus) == $status) ? 'selected' : '' }}>{{$label}}</option>
                          @endforeach 

                        </select>
                        <div class="help-block">{{ $errors->first('eventStatus') }}</div>
                      </div>
                  </div>

                  @endif

                  <div class="form-group">
                    <div class="col-xs-6">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" id="slider_on" name="slider_on" {{ (!empty($sliderImage->slider_image) ? 'checked' : '') }} /> Display on home slider
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group" id="slider-group" style="display:none">
                <label class="col-sm-2" for='slider_image'>Slider Image</label>
                <div class="col-sm-10">
                   <input type="file" name="slider_image" class="form-control">
                   @if(!empty($sliderImage))
                     <img src="{{$sliderImage->slider_image }}" width="180" height="180">
                     <a href="{{ Helper::adminUrl('slider-image/delete/'.$sliderImage->id) }}">Remove</a>
                   @endif

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

@section('after_footer')

<script>
  jQuery(function(){

     if(jQuery("input[name='slider_on']:checked").length > 0){
          jQuery("#slider-group").slideDown();
      }else{
         jQuery("#slider-group").slideUp();
      }


   jQuery('#slider_on').click(function(){
      if(jQuery("input[name='slider_on']:checked").length > 0){
          jQuery("#slider-group").slideDown();
      }else{
         jQuery("#slider-group").slideUp();
      }
   });

  });

</script>
@stop