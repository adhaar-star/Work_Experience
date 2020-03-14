<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><?= $page_title ?> <span class="pull-right hidden-xs"><a href="javascript:;" class="btn btn-default save-btn" data-form="#deal-form"><i class="fa fa-plus"></i> Save</a> <a href="<?= Helper::adminUrl('deal') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back to listing</a></span></h3>
      </div>
      <div class="panel-body">
          <form id="deal-form" action="<?= Helper::adminUrl('deal/save') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              {{csrf_field()}}
              @if (!empty($deal->offerId)) 
                <input type="hidden" name="offerId" value="{{$deal->offerId}}">
              @endif
              <div class="col-sm-12">
                <p class="error">All fields marked in asterisk (*) are mandatory to be filled.</p>

                <?= Helper::alert() ?>
          
                   <div class="form-group  {{ $errors->has('offerName') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Offer Name <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="offerName" value="{{Input::old('offerName', $deal->offerName)}}" class="form-control" required>
                        <div class="help-block">{{ $errors->first('offerName') }}</div>
                      </div>
                  </div>
                  @if (\Auth::user()->role === 'admin') 
                   <div class="form-group  {{ $errors->has('offerVendorId') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Choose Vendor <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <select name="offerVendorId"  class="form-control">
                       <option> - Choose vendor - </option>
                       @if(!empty($adminVendor->all()))
                          @foreach($adminVendor as $item)
                            @if ($item->store)
                              <option value="{{$item->id}}" {{ (Input::old('offerVendorId', $deal->offerVendorId) == $item->id) ? 'selected' : '' }}>{{$item->store->storeName}} (Admin's Store)</option>
                            @endif
                          @endforeach 
                        @endif
                        @if(!empty($vendors->all()))
                          @foreach($vendors as $item)
                            @if ($item->store)
                              <option value="{{$item->id}}" {{ (Input::old('offerVendorId', $deal->offerVendorId) == $item->id) ? 'selected' : '' }}>{{$item->store->storeName}}</option>
                            @endif
                          @endforeach 
                        @endif
                        </select>
                        <div class="help-block">{{ $errors->first('offerVendorId') }}</div>
                      </div>
                  </div>
                  @else
                  <input type="hidden" name="offerVendorId" value="{{ Auth::id() }}">
                  @endif

                   <div class="form-group  {{ $errors->has('offerCategoryId') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Offer Category <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <select name="offerCategoryId"  class="form-control">
                       <option > - Choose offer category - </option>
                        @if(!empty($categories))
                          @foreach($categories as $item)
                          <option value="{{$item->categoryId}}" {{ (Input::old('offerCategoryId', $deal->offerCategoryId) == $item->categoryId) ? 'selected' : '' }}>{{$item->categoryName}}</option>
                         
                          @endforeach 
                        @endif
                        </select>
                        <div class="help-block">{{ $errors->first('offerCategoryId') }}</div>
                      </div>
                  </div>

                  <div id="offer-images">
                    <h4>Offer Images</h4>

                     <div class="col-sm-12 nopadding">

                    <div class="col-sm-3 nopadding-left">
                     <div class="form-group  {{ $errors->has('image_1') ? 'has-error' : '' }}">
                         <label class="col-sm-12">Image 1<i class="error">*</i></label>
                         <div class="col-sm-12">
                         <input type="file" name="image_1" class="form-control" {{ !empty($deal->offerId) ? '' : 'required' }}>
                          <div class="help-block">{{ $errors->first('image_1') }}</div>
                        </div>
                        <div class="col-sm-12">
                        @if(!empty($deal->images->image_1))
                          <img src="{{ $deal->images->getImageSrc($deal->images->image_1) }}" width="100" alt="{{ $deal->offerName }}">
                        @endif
                        </div>
                    </div>
                    </div>

                     <div class="col-sm-3">
                     <div class="form-group  {{ $errors->has('image_2') ? 'has-error' : '' }}">
                         <label class="col-sm-12">Image 2<i class="error">*</i></label>
                         <div class="col-sm-12">
                         <input type="file" name="image_2" class="form-control">
                          <div class="help-block">{{ $errors->first('image_2') }}</div>
                        </div>
                        <div class="col-sm-12">
                        @if(!empty($deal->images->image_2))
                          <img src="{{ $deal->images->getImageSrc($deal->images->image_2) }}" width="100" alt="{{ $deal->offerName }}">
                        @endif
                        </div>
                    </div>
                    </div>

                     <div class="col-sm-3">
                     <div class="form-group  {{ $errors->has('image_3') ? 'has-error' : '' }}">
                         <label class="col-sm-12">Image 3<i class="error">*</i></label>
                         <div class="col-sm-12">
                         <input type="file" name="image_3" class="form-control">
                          <div class="help-block">{{ $errors->first('image_3') }}</div>
                        </div>
                        <div class="col-sm-12">
                         @if(!empty($deal->images->image_3))
                          <img src="{{ $deal->images->getImageSrc($deal->images->image_3)}}" width="100" alt="{{ $deal->offerName }}">
                        @endif
                        </div>
                    </div>
                    </div>

                     <div class="col-sm-3 nopadding-right">
                     <div class="form-group  {{ $errors->has('image_4') ? 'has-error' : '' }}">
                         <label class="col-sm-12">Image 4<i class="error">*</i></label>
                         <div class="col-sm-12">
                         <input type="file" name="image_4" class="form-control">
                          <div class="help-block">{{ $errors->first('image_4') }}</div>
                        </div>
                        <div class="col-sm-12">
                         @if(!empty($deal->images->image_4))
                          <img src="{{ $deal->images->getImageSrc($deal->images->image_4) }}" width="100" alt="{{ $deal->offerName }}">
                        @endif
                        </div>
                    </div>
                    </div>
                    </div>

                    <div class="help-block field-info">Image resolution should be 1:1 (Minimum resolution: 1000x1000)</div>
                      

                  </div>

                  <div class="form-group  {{ $errors->has('originalPrice') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Original Product/Deal Price </label>
                       <div class="col-sm-12">
                       <input type="text" name="originalPrice" value="{{Input::old('originalPrice', $deal->originalPrice)}}" class="form-control">
                        <div class="help-block">{{ $errors->first('originalPrice') }}</div>
                      </div>
                  </div>

                  <div class="form-group  {{ $errors->has('productOfferPrice') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Discounted Product/Deal Price </label>
                       <div class="col-sm-12">
                       <input type="text" name="productOfferPrice" value="{{Input::old('productOfferPrice', $deal->productOfferPrice)}}" class="form-control" >
                        <div class="help-block">{{ $errors->first('productOfferPrice') }}</div>
                      </div>
                  </div>

                  <div class="form-group  {{ $errors->has('offerType') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Offer Type <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <select name="offerType"  class="form-control" id="offer_type">
                          @foreach(['free' => 'Free', 'exclusive' => 'Exclusive'] as $key => $name)
                          <option value="{{$key}}" {{ (Input::old('offerType', $deal->offerType) == $key) ? 'selected' : '' }}>{{$name}}</option>
                          @endforeach 
                        </select>
                        <div class="help-block">{{ $errors->first('offerType') }}</div>
                      </div>
                  </div>

                   <div class="form-group  {{ $errors->has('offerPrice') ? 'has-error' : '' }}" id="offer_price_form_group">
                       <label class="col-sm-12">Deal Buy Price </label>
                       <div class="col-sm-12">
                       <input type="text" name="offerPrice" id="offer_price" value="{{Input::old('offerPrice', $deal->offerPrice)}}" class="form-control">
                        <div class="help-block">{{ $errors->first('offerPrice') }}</div>
                      </div>
                  </div>

                  <div class="form-group  {{ $errors->has('offerHighlightedText') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Offer Highlighted Text <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="offerHighlightedText" value="{{Input::old('offerHighlightedText', $deal->offerHighlightedText)}}" class="form-control" required>
                        <div class="help-block">{{ $errors->first('offerHighlightedText') }}</div>
                      </div>
                  </div>

                   <!-- <div class="form-group  {{ $errors->has('offerDiscount') ? 'has-error' : '' }}" style="display:none;">
                       <label class="col-sm-12">Offer Discount <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="offerDiscount" value="{{Input::old('offerDiscount', $deal->offerDiscount)}}" class="form-control" required>
                        <div class="help-block">{{ $errors->first('offerDiscount') }}</div>
                      </div>
                  </div> -->



                   <div class="form-group  {{ $errors->has('offerDiscountType') ? 'has-error' : '' }}" style="display:none">
                       <label class="col-sm-12">Offer Type <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <select name="offerDiscountType"  class="form-control">
                          @foreach(['fixed' => 'Fixed', 'flexiable' => 'Flexiable'] as $key => $name)
                          <option value="{{$key}}" {{ (Input::old('offerDiscountType', $deal->offerDiscountType) == $key) ? 'selected' : '' }}>{{$name}}</option>
                          @endforeach 
                        </select>
                        <div class="help-block">{{ $errors->first('offerDiscountType') }}</div>
                      </div>
                  </div>


                  
                    <div class="form-group  {{ $errors->has('description') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Description</label>
                       <div class="col-sm-12">
                       <textarea name="description" class="form-control" style="min-height: 200px">{{Input::old('description', $deal->description)}}</textarea>
                        <div class="help-block">{{ $errors->first('description') }}</div>
                      </div>
                  </div>


                   <div class="form-group  {{ $errors->has('offerTags') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Offer tags</label>
                       <div class="col-sm-12">
                       <input type="text" name="offerTags" value="{{Input::old('offerTags', $deal->offerTags)}}" class="form-control">
                        <div class="help-block">{{ $errors->first('offerTags') }}</div>
                      </div>
                  </div>
              
               <div class="form-group  {{ $errors->has('offerStartDate') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Offer Start Date <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="offerStartDate" value="{{Input::old('offerStartDate', $deal->offerStartDate)}}" class="form-control datepicker" required>
                        <div class="help-block">{{ $errors->first('offerStartDate') }}</div>
                      </div>
                  </div>

                   <div class="form-group  {{ $errors->has('offerEndDate') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Offer End Date <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="offerEndDate" value="{{Input::old('offerEndDate', $deal->offerEndDate)}}" class="form-control datepicker" required>
                        <div class="help-block">{{ $errors->first('offerEndDate') }}</div>
                      </div>
                  </div>

                   <div class="form-group  {{ $errors->has('offerTerms') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Offer Terms <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <textarea  name="offerTerms" class="form-control">{{Input::old('offerTerms', $deal->offerTerms)}}</textarea>
                        <div class="help-block">{{ $errors->first('offerTerms') }}</div>
                      </div>
                  </div>

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
  jQuery(document).ready(function()
  {
     jQuery("#offer_type").on("change",function()
     {

        //alert($(this).val());
       
        if($(this).val() == 'free')
        {
           jQuery("#offer_price_form_group").slideUp();
           jQuery("#offer_price").val(0);
        }else{

          jQuery("#offer_price_form_group").slideDown();
        }

     });

     if(jQuery("#offer_type").val() == "free")
     {
           jQuery("#offer_price_form_group").hide();
           jQuery("#offer_price").val(0);
     }else
     {

         jQuery("#offer_price_form_group").show();

     }


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