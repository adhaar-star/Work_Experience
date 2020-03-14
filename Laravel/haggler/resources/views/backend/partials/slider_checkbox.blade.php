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