<?php
use \App\Models\Helper;
?>
@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-12">

      <div class="panel panel-default">
        <div class="panel-heading">
          <h3 class="panel-title"><?= $page_title ?> <span class="pull-right hidden-xs"><a href="javascript:;" class="btn btn-default save-btn" data-form="#category-form"><i class="fa fa-plus"></i> Save</a> <a href="<?= Helper::adminUrl('category/tree-view') ?>" class="btn btn-warning"><i class="fa fa-arrow-left"></i> Back to listing</a></span></h3>
        </div>
      <div class="panel-body">

          <form id="category-form" action="<?= Helper::adminUrl('category/save') ?>" method="post" enctype="multipart/form-data" class="form-horizontal">
              {{csrf_field()}}

              @if (!empty($category->categoryId)) 
                <input type="hidden" name="categoryId" value="{{$category->categoryId}}">
              @endif
              <div class="col-sm-12">
                <p class="error">All fields marked in asterisk (*) are mandatory to be filled.</p>

                <?= Helper::alert() ?>
                                      
                   <div class="form-group  {{ $errors->has('categoryName') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Category Name <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="categoryName" value="{{Input::old('categoryName', $category->categoryName)}}" class="form-control" required>
                        <div class="help-block">{{ $errors->first('categoryName') }}</div>
                      </div>
                  </div>

                   <div class="form-group  {{ $errors->has('categoryParentId') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Parent Category</label>
                       <div class="col-sm-12">
                       <select id="categoryParentId" name="categoryParentId"  class="form-control">
                       <option value="0"> - Choose parent category - </option>
                        @if(!empty($categories))
                          @foreach($categories as $item)
                          <option value="{{$item->categoryId}}" {{ (Input::old('categoryParentId', $category->categoryParentId) == $item->categoryId) ? 'selected' : '' }}>{{$item->categoryName}}</option>
                          <?php $children = \App\Models\Category::getChildren($item, Input::old('categoryParentId', $category->categoryParentId)); ?>
                          
                            @if(!empty($children))
                              <optgroup label="{{$item->categoryName}}">
                              
                                {!! $children !!}
                              
                              </optgroup>
                                                    
                            @endif
                          @endforeach 
                        @endif
                        </select>
                        <div class="help-block">{{ $errors->first('categoryParentId') }}</div>
                      </div>
                  </div>

                   <div id="categoryImageContainer" class="form-group  {{ $errors->has('categoryImage') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Category Image <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="file" name="categoryImage" id="categoryImage" class="form-control">
                      <div class="help-block field-info">Image resolution should be 1:1 (Minimum resolution: 1000x1000)</div>
                      <div class="help-block">{{ $errors->first('categoryImage') }}</div>
                      </div>
                      <div class="col-sm-12">
                      @if(!empty($category->categoryImage))
                      <img src="{{ $category->categoryImage }}" width="100" alt="{{ $category->categoryName }}">
                      @endif
                      </div>
                  </div>

                   <div class="form-group  {{ $errors->has('categoryPercentage') ? 'has-error' : '' }}">
                       <label class="col-sm-12">Category Percentage <i class="error">*</i></label>
                       <div class="col-sm-12">
                       <input type="text" name="categoryPercentage" value="{{Input::old('categoryPercentage', $category->categoryPercentage)}}" class="form-control">
                        <div class="help-block">{{ $errors->first('categoryName') }}</div>
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

function isParentCatSelected() {
  return $("#categoryParentId").val() > 0;
}

function toggleImageOption() {

  if (isParentCatSelected()) {
    $("#categoryImageContainer").hide();
  } else {
    $("#categoryImageContainer").show();
  }

}

$(function () {
  toggleImageOption();

  $("#categoryParentId").on('change', function () {
    toggleImageOption();

  });

});

</script>

@stop