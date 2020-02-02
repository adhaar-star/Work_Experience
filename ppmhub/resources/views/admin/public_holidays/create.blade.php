@extends('layout.adminlayout')
<?php if (isset($holidaysData) && $holidaysData->id) { ?>
  @section('title','Settings | Edit Public Holidays')
<?php } else { ?>
  @section('title','Settings | Create Public Holidays')
<?php } ?>
@section('body')
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/public_holiday.js') !!}
<section id="create_form" class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @include('include.admin_sidebar')

                @if(!isset($holidaysData->id))
                {!! Form::open(array('url' => 'admin/public_holidays','method'=>'post','id' => 'publicHolidaysform')) !!} 
                @else
                {!! Form::open(array('route'=>array('public_holidays.update',$holidaysData->id),'method' => 'put','id' => 'publicHolidaysform')) !!}
                @endif
                {{ csrf_field() }}
                <div class="margin-bottom-50">
                    <div class="margin-bottom-50">
                        <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                <a href="{{url('admin/dashboard')}}">Settings</a>
                            </li>
                            <li>
                                <a href="{{url('admin/public_holidays')}}">Add Public holidays</a>
                            </li>
                            <li>
                                <span>
                                    @if(isset($holidaysData) && $holidaysData->id)
                                    Edit
                                    @else
                                    Create
                                    @endif 
                                    Public Holidays</span>
                            </li>
                        </ul>
                    </div>
                    <div class="card">
                        <div class="card-header card-header-box bg-lightcyan">
                            <h4 class="margin-0">
                                @if(isset($holidaysData) && $holidaysData->id)
                                Edit
                                @else
                                Create
                                @endif 
                                Public Holidays
                            </h4>
                            <!-- Vertical Form -->
                        </div>
                        <div class="card-block">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label  class="col-sm-4 col-form-label text-right">Select Date* :</label>
                                        <div class="col-xs-12 col-sm-7">
                                            <div class="form-input-icon">
                                                <label class="input-group datepicker-only-init">
                                                    {!!Form::text('date',isset($holidaysData->date) ? $holidaysData->date : '',array('class'=>'form-control border-radius-0 datepicker-only-init date','placeholder'=>'Please select date'))!!}
                                                    <span class="input-group-addon"> <i class="icmn-calendar"></i> </span>
                                                </label>
                                                <p id="date"></p>
                                                @if($errors->has('date')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('date') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>	
                                    </div>
                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">False in Weekend*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('weekend',['1'=>'True','0'=>'False'],isset($holidaysData->weekend) ? $holidaysData->weekend : '',array('class'=>'form-control border-radius-0 select2 weekend','placeholder'=>'Please select weekend','id'=>'weekend'))!!}
                                                @if($errors->has('weekend')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('weekend') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">State*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('state',isset($state_list)?$state_list:[],isset($holidaysData->state) ? $holidaysData->state : '',array('class'=>'form-control border-radius-0 select2 state','placeholder'=>'Please select state','id'=>'state'))!!}
                                                @if($errors->has('state')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('state') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label text-right">Name of Holiday*:</label>
                                        <div class="col-sm-7">
                                            <div class="form-input-icon">
                                                {!!Form::text('name_holidays',isset($holidaysData->name_holidays) ? $holidaysData->name_holidays : '',array('class'=>'form-control border-radius-0','placeholder'=>'Please enter name of holiday'))!!}
                                                @if($errors->has('name_holidays')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('name_holidays') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label class="col-xs-12 col-sm-6 col-md-4 col-form-label">Country*:</label>
                                        <div class="col-xs-12 col-sm-6 col-md-8 col-lg-7">
                                            <div class="form-input-icon">
                                                {!!Form::select('country',$country_data,isset($holidaysData->country) ? $holidaysData->country : '',array('class'=>'form-control border-radius-0 select2 country','placeholder'=>'Please select country','id'=>'country'))!!}
                                                @if($errors->has('country')) 
                                                <div style='color:red'>
                                                    {{ $errors->first('country') }}
                                                </div> 
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer card-footer-box">
                            @if(!isset($holidaysData->id))
                            {!!Form::submit('Submit',array('class'=>'btn btn-primary card-btn'))!!}
                            @else
                            {!!Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn'))!!}
                            @endif
                            <a href="{{url('admin/public_holidays')}}"><button type="button" class="btn btn-danger">Cancel</button></a>
                        </div>                      
                        {!!Form::close()!!}
                    </div>
                </div>
            </div>
        </div> 
    </div>
</section>
<script>
  $(document).ready(function () {
      $(".weekend").select2({
      }).on('change', function () {
          $(this).valid();
      });
       $(".country").select2({
      }).on('change', function () {
          $(this).valid();
      });
       $(".state").select2({
      }).on('change', function () {
          $(this).valid();
      });
  });
  $('#country').on('change',function () {
      var countryID = $(this).val();
      if (countryID) {
          getStateList(countryID);
      }
  });

  function getStateList(countryId) {
      $.ajax({
          type: "GET",
          url: "/admin/api/getstate/" + countryId,
          success: function (response) {
              $("#state").html('');
              var stateOptions = '<option value="">Please select state</option>';
              if (response.status) {
                  for(x in response.results) {
                      stateOptions += '<option value="' + x + '">' + response.results[x] + '</option>';
                  }
              }

              $('#state').html(stateOptions);
          }
      });
  }

</script>
@endsection
