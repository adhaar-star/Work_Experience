@extends('layout.adminlayout')

<?php if (isset($buckets) && $buckets->id) { ?>
  @section('title','Edit Bucket')
<?php } else { ?>
  @section('title','Create Bucket')
<?php } ?>

@section('body')

<!-- Buckets-->
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/bucket.js') !!}
<!-- Buckets-->
<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="togle-btn pull-right">
                    <div class="dropdown inner-drpdwn">
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <span class="hidden-lg-down">Portfolio Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="{{url('admin/portfolio')}}">Portfolio</a>
                            <a class="dropdown-item" href="{{url('admin/buckets')}}">Buckets</a>
                            <a class="dropdown-item" href="{{url('admin/portfolioStructure')}}">Portfolio Structure</a>
                            <a class="dropdown-item" href="{{url('admin/bucketfp')}}">Portfolio Financial Plaining</a>
                            <a class="dropdown-item" href="{{url('admin/portfolioresourceplanning')}}">Portfolio Resource Planning</a>
                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="javascript:void(0)"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                        </ul>
                    </div> 
                </div>	
                <?php if (isset($buckets) && $buckets->id) {
                  ?>
                  {!! Form::model($buckets, array('class' => '', 'id' => 'bucketstypeform', 'method' => 'PATCH', 'route' => array('buckets.update', $buckets->id))) !!}
                <?php } else { ?>
                  {!! Form::open(array('route' => 'buckets.create', 'method' => 'POST','id' => 'bucketstypeform', 'class' => '')) !!} 
                <?php }
                ?>

                <div class="margin-bottom-50">
                    <div class="margin-bottom-50">
                        <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                <a href="{{url('admin/dashboard')}}">Portfolio Management</a>
                            </li>
                            <li>
                                <a href="{{url('admin/buckets')}}">Bucket</a>
                            </li>
                            <li>
                                <span>
                                    @if(isset($buckets) && $buckets->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Bucket
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            <h4 class="margin-0">
                                @if(isset($buckets) && $buckets->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Bucket
                                <div class="col-md-6 pull-right">
                                    <label class="pull-right"><span class="text-danger">*</span>Mandatory fields</label>
                                </div>
                            </h4>
                            <!-- Vertical Form -->
                        </div>

                        {{ csrf_field() }}
                        @if(isset($buckets) && $buckets->id)
                        {{ method_field('PUT') }}
                        @endif 

                        <div class="card-block">

                            <?php if (empty($buckets)) { ?>

                              <div class="row">
                                  <div class="col-md-6">
                                      <div class="form-group form-radio-btm">
                                          <div class="col-xs-12">
                                              <div class="row">
                                                  <div class="col-xs-12 col-sm-6">
                                                      <label><input type="radio" name="colorRadio" value="sub_bucket" id="subBucket"> Create Bucket under bucket</label>
                                                  </div>
                                                  <div class="col-xs-12 col-sm-6">
                                                      <label><input type="radio" name="colorRadio" value="par_bucket" checked="checked" id="parentBucket"> Create Parent Bucket</label>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>
                              </div>

                          </div>						
                        <?php } ?>

                        <div class="row" style="margin: 0;">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Portfolio ID<span class="text-danger">*</span><img src="/new_images/common/info.svg" class="info-tooltip" /><span class="tooltip-text">Unique Portfolio number under which the bucket will be created.</span></span> :</label>

                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <?php if (isset($buckets)) { ?>
                                          {!! Form::select('portfolio_id',$portfolio, old('portfolio_id', $buckets->portfolio_id), array('class'=>'select2 selectRequired','id'=>'portfolio_id','placeholder'=>'Please select portfolio')) !!}
                                        <?php } else { ?>
                                          {!! Form::select('portfolio_id',$portfolio, old('portfolio_id'), array('class'=>'select2 selectRequired','id'=>'portfolio_id','placeholder'=>'Please select portfolio')) !!}	
                                        <?php } ?>
                                        @if($errors->has('portfolio_id')) 
                                        <div style='color:red'>
                                            {{ $errors->first('portfolio_id') }}
                                        </div> 
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Bucket Name<span class="text-danger">*</span><img src="/new_images/common/info.svg" class="info-tooltip" /><span class="tooltip-text">The bucket name is a free text and can hold upto 24 characters.</span></span> : <span class="required"></span></label>

                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <div class="form-input-icon">
                                            <input type="text" class="form-control border-radius-0 inputRequired" placeholder="Bucket Name" id="name" name="name" value="<?php
                                            if (isset($buckets)) {
                                              echo $buckets->name;
                                            }
                                            ?>">
                                            @if($errors->has('name')) 
                                            <div style='color:red'>
                                                {{ $errors->first('name') }}
                                            </div> 
                                            @endif 
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin: 0;">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Bucket ID<img src="/new_images/common/info.svg" class="info-tooltip" /><span class="tooltip-text">The bucket ID is an internally generated number, the number range maintained in settings.</span></span> : <span class="required"></span></label>

                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <div class="form-input-icon">
                                            <?php if (isset($buckets)) { ?>
                                              <input type="text" class="form-control border-radius-0 defaultgreen" placeholder="Bucket ID" id="bucket_id" name="bucket_id" value="<?php
                                              if (isset($buckets)) {
                                                echo $buckets->bucket_id;
                                              }
                                              ?>" readonly >
                                                   <?php } else { ?>
                                              <input type="text" class="form-control border-radius-0 defaultgreen" placeholder="Bucket ID" id="bucket_id" name="bucket_id" value="<?php echo $rand = substr(md5(microtime()), rand(0, 26), 6); ?>" readonly>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Portfolio Name :</label>

                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <div class="form-input-icon">
                                            <?php if (isset($buckets)) { ?>
                                              <input type="text" class="form-control border-radius-0 defaultgreen" id="portfolio_name" placeholder="Portfolio Name"  value="" readonly >
                                            <?php } else { ?>
                                              <input type="text" class="form-control border-radius-0 defaultgreen" id="portfolio_name" placeholder="Portfolio Name"  value="" readonly >
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin: 0;">
                            <div class="sub_bucket box" style="margin: 0;">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Select Parent Bucket<span class="text-danger">*</span> :</label>

                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">	
                                            <select name="parent_bucket" id="buckets" class="select2 selectRequired">
                                                <option value="0" selected="selected">Please Select Parent Bucket</option> 
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Cost Center<span class="text-danger">*</span><img src="/new_images/common/info.svg" class="info-tooltip" /><span class="tooltip-text">The bucket will belong to the Cost centre  you enter here.</span></span> :</label>

                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <?php if (isset($buckets)) { ?>
                                          {!! Form::select('costcentretype',$costcentretype, old('costcentretype', $buckets->costcentretype), array('class'=>'select2 border-radius-0 selectRequired', 'id'=>'costcentretype','placeholder'=>'Please select cost center')) !!}
                                        <?php } else { ?>
                                          {!! Form::select('costcentretype',$costcentretype, old('costcentretype'), array('class'=>'select2 border-radius-0 selectRequired', 'id'=>'costcentretype','placeholder'=>'Please select cost center')) !!}	
                                        <?php } ?>

                                        @if($errors->has('costcentretype')) 
                                        <div style='color:red'>
                                            {{ $errors->first('costcentretype') }}
                                        </div> 
                                        @endif 
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Department<span class="text-danger">*</span><img src="/new_images/common/info.svg" class="info-tooltip" /><span class="tooltip-text">The bucket will belong to the department you enter here.</span></span> :</label>

                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <?php if (isset($buckets)) { ?>
                                          {!! Form::select('department',$department, old('department', $buckets->department), array('class'=>'select2 border-radius-0 selectRequired','id'=>'department','placeholder'=>'Please select department')) !!}
                                        <?php } else { ?>
                                          {!! Form::select('department',$department, old('department'), array('class'=>'select2 border-radius-0 selectRequired','id'=>'department','placeholder'=>'Please select department')) !!}	
                                        <?php } ?>

                                        @if($errors->has('department')) 
                                        <div style='color:red'>
                                            {{ $errors->first('department') }}
                                        </div> 
                                        @endif 
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin: 0;">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Currency<span class="text-danger">*</span><img src="/new_images/common/info.svg" class="info-tooltip" /><span class="tooltip-text"> The currency selection will be used in Portfolio financial planning</span></span> :</label>

                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <?php if (isset($buckets)) { ?>
                                          {!! Form::select('currency', $currency, old('currency',$buckets->currency), array('class'=>'select2 selectRequired','id'=>'currency','placeholder'=>'Please select currency')) !!}
                                        <?php } else { ?>
                                          {!! Form::select('currency', $currency, old('currency'), array('class'=>'select2 selectRequired','id'=>'currency','placeholder'=>'Please select currency')) !!}	
                                        <?php } ?>
                                        @if($errors->has('currency')) 
                                        <div style='color:red'>
                                            {{ $errors->first('currency') }}
                                        </div> 
                                        @endif 
                                    </div>

                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Status:</label>
                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <div class="btn-group" data-toggle="buttons">
                                            @if(!isset($buckets->status))
                                            <a class="active-bttn btn btn-primary active">
                                                {!! Form::radio('status','active','active')!!}Active
                                            </a>
                                            <a class="inactive-btn btn btn-danger">
                                                {!! Form::radio('status','inactive') !!}Inactive
                                            </a>
                                            @else
                                            @if($buckets->status == 'active')
                                            <a class="active-bttn btn btn-primary active">
                                                {!! Form::radio('status','active')!!}Active
                                            </a>
                                            <a class="inactive-btn btn btn-danger">  {!! Form::radio('status','inactive')!!}Inactive</a>
                                            @else
                                            <a class="active-bttn btn btn-primary"> {!! Form::radio('status','active')!!}Active</a>
                                            <a class="inactive-btn btn btn-danger active">
                                                {!! Form::radio('status','inactive') !!}Inactive
                                            </a>
                                            @endif
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin: 0;">
                            <div class="col-sm-6">
                                <div class="form-group row">
                                    <label class="col-xs-12 col-sm-6 col-md-4 col-form-label" for="l33">Description<span class="text-danger">*</span> :</label>

                                    <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                        <div class="form-input-icon">
                                            <textarea id="description" name="description" class="form-control border-radius-0 inputRequired"><?php
                                                if (isset($buckets)) {
                                                  echo $buckets->description;
                                                }
                                                ?></textarea>
                                            @if($errors->has('description')) 
                                            <div style='color:red'>
                                                {{ $errors->first('description') }}
                                            </div> 
                                            @endif 
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer card-footer-box text-right">
                        <button type="submit" class="btn btn-primary card-btn" id="submit">
                            @if(isset($buckets) && $buckets->id)
                            Save Changes
                            @else
                            Submit
                            @endif 

                        </button>
                        <a href="{{url('admin/buckets')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                    </div>

                    <!-- End Vertical Form -->
                </div>
                </form>
            </div>
        </div>
    </div>
</section>
<!-- End Dashboard -->

<script>
  $(document).ready(function () {
      $('#portfolio_id').change(function (e) {
          var data = $(this).val();
          $.ajax
                  ({
                      url: "{{ url('admin/getportfolioname') }}",
                      dataType: 'json',
                      data: {'porfolio_id': data},
                      success: function (data)
                      {
                          $('#portfolio_name').val(data.name);
                      }
                  });

      });
  });
<?php if (isset($buckets)) { ?>
    $(document).ready(function () {

        $('#portfolio_id').ready(function (e) {
            var data = "<?php
  if (isset($buckets)) {
    echo $buckets->portfolio_id;
  }
  ?>";

            $.ajax
                    ({
                        url: "{{ url('admin/getportfolioname') }}/",
                        type: 'GET',
                        dataType: 'json',
                        data: {'porfolio_id': data},
                        success: function (data)
                        {
                            $('#portfolio_name').val(data.name);

                        }
                    });

        });


    });
<?php } ?>

</script>  
<script type="text/javascript">

  $(document).ready(function () {

      $('#portfolio_id').select2({
      }).on('change', function () {
          $(this).valid();
      });
      $('#costcentretype').select2({
      }).on('change', function () {
          $(this).valid();
      });

      $('#department').select2({
      }).on('change', function () {
          $(this).valid();
      });

      $('#currency').select2({
      }).on('change', function () {
          $(this).valid();
      });

      $('#buckets').select2({
      }).on('change', function () {
          $(this).valid();
      });

      $('#portfolio_id').change(function () {
          var $portfolioId = $(this).val();
          if ($portfolioId != "" && $("#subBucket").is(":checked")) {
              $.ajax({
                  method: 'GET',
                  url: "{{url('admin/portfolio-buckets')}}" + '/' + $portfolioId,
                  success: function (response) {
                      console.log('response', response);
                      var content = '<option value="" selected="selected" disabled>Please Select Parent Bucket</option>';
                      $.each(response.buckets, function (key, bucket) {
                          if (bucket.children.length > 0) {
                              content += "<option value=" + bucket.id + ">" + bucket.name + "</option> ";
                              $.each(bucket.children, function (key1, subBucket) {
                                  content += "<option value=" + subBucket.id + ">&nbsp;|_" + subBucket.name + "</option>";
                              })
                          } else {
                              content += "<option value=" + bucket.id + ">" + bucket.name + "</option>"
                          }
                      });
                      $('#buckets').html("");
                      $('#buckets').append(content);
                  }
              });
          }
      });
      $('input[type="radio"]').click(function () {
          var inputValue = $(this).attr("value");
          var targetBox = $("." + inputValue);
          $(".box").not(targetBox).hide();
          $(targetBox).show();
          $('#buckets').html('<option value="" selected="selected" disabled>Please Select Parent Bucket</option>');
          if ($(this).val() == 'sub_bucket') {
              $('#buckets').rules("add", {
                  required: true, messages: {required: "Please select parent bucket"}
              });
          } else {
              $('#buckets').rules("remove", "required");
          }
      });
  });


</script>
@endsection
