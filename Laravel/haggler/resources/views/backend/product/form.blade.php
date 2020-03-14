<?php
use \App\Models\Helper;
$cats = [];
?>


@section('header')
<link href="{{url('assets/jquery-ui/jquery-ui.min.css')}}" type="text/css" rel="stylesheet">
@stop

@section('content')
@if(!empty($product->categories))
   @foreach($product->categories->all() as $c )
     <?php  array_push($cats,$c->categoryId);   ?>
   @endforeach

@endif




<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><?= $page_title ?> <span class="pull-right hidden-xs"><a href="javascript:;" class="btn btn-default save-btn" data-form="#product-form"><i class="fa fa-plus"></i> Save</a> <a href="<?= Helper::adminUrl('product') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back to listing</a></span></h3>

      </div>
      <div class="panel-body">
   

          <form id="product-form" action="<?= Helper::adminUrl('product/save') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              {{csrf_field()}}

              @if (!empty($product->productId)) 
                <input type="hidden" name="productId" value="{{$product->productId}}">
              @endif
              <div class="col-sm-12">
                <p class="error">All fields marked in asterisk (*) are mandatory to be filled.</p>

                <?= Helper::alert() ?>
                                      
                   <div class="form-group  {{ $errors->has('productName') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Product Name <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="productName" value="{{Input::old('productName', $product->productName)}}" class="form-control" required>
                        <div class="help-block">{{ $errors->first('productName') }}</div>
                      </div>
                  </div>

                   @if (\Auth::user()->role === 'admin') 
                   <div class="form-group  {{ $errors->has('offerVendorId') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Choose Vendor <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <select name="productVendorId"  class="form-control">
                       <option> - Choose vendor - </option>
                       @if(!empty($adminVendor->all()))
                          @foreach($adminVendor as $item)
                            @if ($item->store)
                              <option value="{{$item->id}}" {{ (Input::old('productVendorId', $product->offerVendorId) == $item->id) ? 'selected' : '' }}>{{$item->store->storeName}} (Admin's Store)</option>
                            @endif
                          @endforeach 
                        @endif
                        @if(!empty($vendors->all()))
                          @foreach($vendors as $item)
                            @if ($item->store)
                              <option value="{{$item->id}}" {{ (Input::old('productVendorId', $product->productVendorId) == $item->id) ? 'selected' : '' }}>{{$item->store->storeName}}</option>
                            @endif
                          @endforeach 
                        @endif
                        </select>
                        <div class="help-block">{{ $errors->first('productVendorId') }}</div>
                      </div>
                  </div>
                  @else
                  <input type="hidden" name="productVendorId" value="{{ Auth::id() }}">
                  @endif





                    <label>Select Categories</label>
                  <div class="row" style="margin-bottom:20px">

                    <div class="col-md-4">
                      <select class="form-control" name="p_cat" id="p_cat" size="13" onchange="getSecondLevel(this.value)">
                      @if(!empty($categories->all()))
                        @foreach($categories->all() as $cat)
                           <option value="{{ $cat->categoryId }}"  {{ (in_array($cat->categoryId,$cats) ? 'selected' : '') }} >{{ $cat->categoryName }}</option>
                        @endforeach
                      @endif
                        
                      </select>
                    </div>

                    <div class="col-md-4">
                      <select class="form-control" size="13" name="s_cat" onchange="getThirdLevel(this.value)" id='sec_level' style="display:none">
                      </select>
                    </div>

                    <div class="col-md-4">
                      <select class="form-control" size="13"  name="t_cat" id='third_level' style="display:none">
                      </select>
                    </div>
                  </div>
                   

                  <div class="form-group  {{ $errors->has('productPrice') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Product Price <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="productPrice" value="{{Input::old('productPrice', $product->productPrice)}}" class="form-control" required>
                        <div class="help-block">{{ $errors->first('productPrice') }}</div>
                      </div>
                  </div>

  <div class="form-group  {{ $errors->has('productQuantity') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Product Quantity <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="productQuantity" value="{{Input::old('productQuantity', $product->productQuantity)}}" class="form-control" required>
                        <div class="help-block">{{ $errors->first('productQuantity') }}</div>
                      </div>
                  </div>
				  
				  
                   <div class="form-group  {{ $errors->has('hasOffer') ? 'has-error' : '' }}">
                    <div class="col-sm-12 checkbox">
                       <label>
                        <input type="checkbox" name="hasOffer" data-offer='yes' value="yes" {{ Input::old('hasOffer', $product->hasOffer) === 'yes' ? 'checked' : '' }}>
                        <strong>Product has offer?</strong> 
                        </label>
                        <div class="help-block field-info">Check if product has some offer.</div>
                      </div>
        
                       
                  </div>

                  <div class="form-group offer {{ $errors->has('offerName') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Offer Name <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="offerName" value="{{Input::old('offerName', $product->offerName)}}" class="form-control">
                        <div class="help-block">{{ $errors->first('offerName') }}</div>
                      </div>
                  </div>

                   <div class="form-group offer {{ $errors->has('offerPrice') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Offer Price <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="offerPrice" value="{{Input::old('offerPrice', $product->offerPrice)}}" class="form-control">
                        <div class="help-block">{{ $errors->first('offerPrice') }}</div>
                      </div>
                  </div>

                  <div class="form-group offer {{ $errors->has('offerStartDate') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Offer Start Date <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="offerStartDate" value="{{Input::old('offerStartDate', $product->offerStartDate)}}" class="form-control datepicker">
                        <div class="help-block">{{ $errors->first('offerStartDate') }}</div>
                      </div>
                  </div>

                    <div class="form-group offer {{ $errors->has('offerEndDate') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Offer End Date <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="offerEndDate" value="{{Input::old('offerEndDate', $product->offerEndDate)}}" class="form-control datepicker">
                        <div class="help-block">{{ $errors->first('offerEndDate') }}</div>
                      </div>
                  </div>

                  <div class="form-group {{ $errors->has('productThumbnail') ? 'has-error' : '' }}">
                    <label class="col-sm-12">Product Thumbnail<i class="error">*</i></label>
                       <div class="col-sm-12">
                         <input type="file" name="productThumbnail" class="form-control" {{ empty($product->productId) ? 'required' : ''}}>
                         <div class="help-block field-info">Image resolution should be 1:1 (Minimum resolution: 200x200)</div>
                         <div class="help-block">{{ $errors->first('productThumbnail') }}</div>  
                      </div>
                      <div class="col-sm-12">
                      @if(!empty($product->productThumbnail))
                      <img src="{{ $product->thumbnail }}" width="100" alt="{{ $product->productName }}">
                      @endif
                      </div>
                  </div>

                   <div class="form-group  {{ $errors->has('productImage1') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Product Image Gallery<i class="error">*</i></label>
                       <div class="col-sm-4">
                         <input type="file" name="productImage1" class="form-control" {{ empty($product->productId) ? 'required' : ''}}>
                         <div class="help-block field-info">Image resolution should be 1:1 (Minimum resolution: 1000x1000)</div>
                         <div class="help-block">{{ $errors->first('productImage1') }}</div>  
                      </div>
                      <div class="col-sm-4">
                         <input type="file" name="productImage2" class="form-control">
                         <div class="help-block field-info">Image resolution should be 1:1 (Minimum resolution: 1000x1000)</div>
                         <div class="help-block">{{ $errors->first('productImage2') }}</div>  
                      </div>
                      <div class="col-sm-4">
                         <input type="file" name="productImage3" class="form-control">
                         <div class="help-block field-info">Image resolution should be 1:1 (Minimum resolution: 1000x1000)</div>
                         <div class="help-block">{{ $errors->first('productImage3') }}</div>  
                      </div>
                      <div class="col-sm-4">
                         <input type="file" name="productImage4" class="form-control">
                         <div class="help-block field-info">Image resolution should be 1:1 (Minimum resolution: 1000x1000)</div>
                         <div class="help-block">{{ $errors->first('productImage4') }}</div>  
                      </div>
                      <div class="col-sm-4">
                         <input type="file" name="productImage5" class="form-control">
                         <div class="help-block field-info">Image resolution should be 1:1 (Minimum resolution: 1000x1000)</div>
                         <div class="help-block">{{ $errors->first('productImage5') }}</div>  
                      </div>
                      <div class="col-sm-12">
                      @if(!empty($product->images->productImage1))
                      <img src="{{ $product->images->productImage1 }}" width="100" alt="{{ $product->productName }}">
                      @endif
                       @if(!empty($product->images->productImage2))
                      <img src="{{ $product->images->productImage2 }}" width="100" alt="{{ $product->productName }}">
                      @endif
                       @if(!empty($product->images->productImage3))
                      <img src="{{ $product->images->productImage3 }}" width="100" alt="{{ $product->productName }}">
                      @endif  
                       @if(!empty($product->images->productImage4))
                      <img src="{{ $product->images->productImage4 }}" width="100" alt="{{ $product->productName }}">
                      @endif
                       @if(!empty($product->images->productImage5))
                      <img 5rc="{{ $product->images->productImage5 }}" width="100" alt="{{ $product->productName }}">
                      @endif
                      </div>
                  </div>

                   <div class="form-group  {{ $errors->has('productDescription') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Product Description <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <textarea name="productDescription" class="form-control" required style="min-height: 200px">{{Input::old('productDescription', $product->productDescription)}}</textarea>
                        <div class="help-block">{{ $errors->first('productDescription') }}</div>
                      </div>
                  </div>

                  <div class="form-group  {{ $errors->has('productTags') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Product Tags</label>
                       <div class="col-sm-12">
                       <input type="text" name="productTags" value="{{Input::old('productTags', $product->productTags)}}" class="form-control">
                        <div class="help-block field-info">Product Tags should be comma(,) seperated (For exmple: men,pents,latest).</div>
                        <div class="help-block">{{ $errors->first('productTags') }}</div>
                      </div>
                  </div>

                  <h5><strong>Product Attributes</strong></h5>
                  <hr>
                  <div class="help-block field-info">Attributes should be comma(,) seperated (For example: red,green,white).</div>
                  
                  <br>
                  <div class="clearfix"></div>
                  <div class="form-group">
                    <label class="col-sm-1 col-xs-4">Color</label>
                    <div class="col-sm-11 col-xs-8">
                     <input type="text" name="color" value="{{ Input::old('color', \App\Models\Product::getAttributeValues($product, 'color'))}}" class="form-control">
                    </div>
                  </div>

                  <div class="form-group">
                    <label class="col-sm-1 col-xs-4">Size</label>
                    <div class="col-sm-11 col-xs-8">
                     <input type="text" name="size" value="{{ Input::old('size', \App\Models\Product::getAttributeValues($product, 'size'))}}" class="form-control">
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

<script src="{{url('assets/jquery-ui/jquery-ui.min.js')}}"></script>

<script>

function toggleOfferOptions(obj) {
      if($(obj).is(':checked')) {
        $('.offer').show('fade');
        $('.offer input').attr('required', 'required');
      } else {
        $('.offer').hide('fade');
        $('.offer input').removeAttr('required');
      }
}

function getSecondLevel(p_id){
  jQuery("#third_level").html('');
  jQuery("#third_level").hide();

    jQuery.ajax({
       type: 'GET',
       url: "{{ URL::to('admin/product/second-level-cat') }}",
       data: { p_id : p_id  },
       success: function(data){
           console.log(data);

           if(data.length > 0){
             jQuery("#sec_level").html(' ');
             jQuery.each(data, function(key, value) {
                jQuery("#sec_level").append("<option value='"+value.categoryId+"'>"+value.categoryName+"</option>");
                jQuery("#sec_level").show();
              });

             @if(!empty($cats) && isset($cats[1]))
                jQuery('#sec_level').val({{ $cats[1] }});
                //alert({{ $cats[1] }});
                if(jQuery('#sec_level').val() != null){
                     getThirdLevel(jQuery('#sec_level').val());

                }
             @endif
          }else{

              jQuery("#sec_level").html('');
              jQuery("#sec_level").hide();
          }
      }

    });
}

function getThirdLevel(s_id){

   jQuery.ajax({
       type: 'GET',
       url: "{{ URL::to('admin/product/third-level-cat') }}",
       data: { s_id : s_id  },
       success: function(data){
           
          console.log(data);
           if(data.length > 0){
             jQuery("#third_level").html(' ');
             jQuery.each(data, function(key, value) {
                jQuery("#third_level").append("<option value='"+value.categoryId+"'>"+value.categoryName+"</option>");
                jQuery("#third_level").show();
              });

              @if(!empty($cats) && isset($cats[2]))
                 jQuery("#third_level").val({{ $cats[2] }});
              @endif
          }else{

              jQuery("#third_level").html('');
              jQuery("#third_level").hide();
          } 
       }

    });

}


  $(function() {
    
    $('[data-offer]').click(function () {
       toggleOfferOptions(this);
    });

    toggleOfferOptions($('[data-offer]'));


     function log( message ) {
      $( "<div>" ).text( message ).prependTo( "#log" );
      $( "#log" ).scrollTop( 0 );
    }
 
    $( "#category-search" ).autocomplete({
      source: "<?= Helper::adminUrl('category/search') ?>",
      minLength: 2,
      select: function( event, ui ) {

        if (ui.item) {
          var input = '<input type="hidden" name="categoryIds[]" value="' + ui.item.id + '" id="catInput' + ui.item.id + '">';
          $("#selected-categories").prepend(input);
          $( "<li id='cat"+ui.item.id+"'>" ).html( '<i class="glyphicon glyphicon-minus" onclick="removeThisCat('+ ui.item.id +')"></i>' + ui.item.label  ).prependTo( "#selected-categories > ul" );
          $("#category-search").val('');
       }

       /* log( ui.item ?
          "Selected: " + ui.item.value + " aka " + ui.item.id :
          "Nothing selected, input was " + this.value );*/
      }
    });


    //if(jQuery('#p_cat').val())
    if(jQuery('#p_cat').val() != null){
        getSecondLevel(jQuery('#p_cat').val());
        


    }
    if(jQuery('#sec_level').val() != null){
        getThirdLevel(jQuery('#sec_level').val());

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

  function removeThisCat(id) {
    $("input#catInput" + id + ", li#cat" + + id ).remove();
  }

</script>



@stop