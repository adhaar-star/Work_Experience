@extends('layout.adminlayout')
@section('title','Settings | Quantitative Risk Score')
@section('body')
<div class="alert alert-danger message" style="display: none">
    <span class="glyphicon glyphicon-ok"></span>
    <em id="msg"></em>
</div>
<div class="alert alert-danger message1" style="display: none">
    <span class="glyphicon glyphicon-ok"></span>
    <em id="msg1"></em>
</div>
@if(Session::has('flash_message'))
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> {!! session('flash_message') !!}</em>
</div>
@endif
{!! Html::script('/js/jquery.validate.min.js') !!}
{!! Html::script('/js/quantitaive.js') !!}
<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                @include('include.admin_sidebar')
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here :</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="{{url('admin/dashboard')}}">Settings</a>
                        </li>
                        <li>
                            <span>Quantitative Risk Score</span>
                        </li>
                    </ul>
                </div>
                <h4>Quantitative Risk Score</h4>
                <div class="row">
                    <div class="col-md-12">
                        <div class="margin-bottom-50 margin-top-25">
                            <table class="tableizer-table table table-bordered text-center" border="1" style="width: 60%;">
                                <thead>
                                    <tr>
                                        <th rowspan="2" class="text-center vertical-top">Risk Score</th>
                                        <th colspan="2" class="text-center">Expected Loss</th>
                                        <th rowspan="2" class="text-center vertical-top">Risk Score Status</th>
                                        <th rowspan="2" class="text-center vertical-top">Action</th>
                                    </tr>
                                    <tr>
                                        <th class="text-center">Start Range</th>
                                        <th class="text-center">End Range</th>
                                    </tr>

                                </thead>
                                <tbody> 
                                    @foreach($quantitative_riskscoredata as $data)
                                    <tr id="{{$data->id}}">
                                        <td class="riskvalue">{{$data->risk_value}}</td>                                        
                                        <td class="startrange">{{$data->start_range}}</td>
                                        <td class="endrange">{{$data->end_range}}</td>
                                        <td class="riskstatus">{{$data->risk_status}}</td>
                                        <td>
                                            @if (RoleAuthHelper::hasAccess('quantitativeScore.update')!=true) 
                                            <button class="btn btn-default margin-right-1" style="cursor:no-drop; color:#97A7A7;" >
                                            @else
                                            <button class="btn btn-info editRiskScore" id="editRiskScore_{{$data->id}}" data-id="{{$data->id}}" >
                                                @endif
                                                Edit
                                            </button>
                                        </td>
                                    </tr>
                                    {!! Form::open(array('url'=>array('admin/update_QuantitativeriskScore',$data->id),'method' => 'put','id'=>'riskscore')) !!}
                                    <tr id="editRisk_{{$data->id}}" style="display: none" class="range">
                                        <td class="riskvalue width-80">
                                            {!!Form::select('risk_value',['1'=>'1','2'=>'2','3'=>'3','4'=>'4','5'=>'5'],isset($data->risk_value) ? $data->risk_value : '',array('class'=>'form-control border-radius-0'))!!}     
                                        </td>
                                        <td class="startrange">
                                            {!!Form::text('start_range',isset($data->start_range) ? $data->start_range : '',array('class'=>'form-control border-radius-0 startrange','id'=>'startrange'))!!}
                                        </td>
                                        <td class="endrange">
                                            {!!Form::text('end_range',isset($data->end_range) ? $data->end_range : '',array('class'=>'form-control border-radius-0 endrange','id'=>'endrange'))!!}
                                        </td>
                                        <td class="riskstatus width-150">
                                            {!!Form::select('risk_status',['Insignificant'=>'Insignificant','Minor'=>'Minor','Moderate'=>'Moderate','Serious'=>'Serious','Very serious'=>'Very serious'],isset($data->risk_status) ? $data->risk_status : '',array('class'=>'form-control border-radius-0'))!!}     
                                        </td>
                                        <td> 
                                            {!! Form::submit('Save Changes',array('class'=>'btn btn-primary card-btn save')) !!}  
                                        </td>
                                    </tr>
                                    {!!Form::close()!!}
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<script>
  $(document).ready(function () {
      $(".editRiskScore").click(function () {
          var id = $(this).attr('data-id');
          $('#editRisk_' + id).show();
          $(this).closest('tr').hide();
      });
      $('[name=start_range],[name=end_range]').on('change', function () {
          if (!isNaN($(this).val()))
          {
              if (parseInt($(this).val()) < 0)
              {
                  $(this).val(-parseInt($(this).val()));
              }
          }
      });

      $('.save').click(function (e) {
          var start_range = $(this).parents('.range').find('input.startrange').val();
          var end_range = $(this).parents('.range').find('input.endrange').val();
          if (start_range === '')
          {
              $('.message').show();
              $('#msg').html("Please enter start range");
              $('#riskscore').valid();
              e.preventDefault();
          }
          if (end_range == '')
          {
              $('.message1').show();
              $('#msg1').html("Please enter end range");
              $('#riskscore').valid();
              e.preventDefault();
          }

      });
  });
</script>
@endsection
