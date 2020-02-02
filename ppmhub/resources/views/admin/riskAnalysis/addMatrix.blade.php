@extends('layout.adminlayout')
@section('title','Settings | Qualitative Risk Matrix')
@section('body')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-simulate/1.0.1/jquery.simulate.js"></script>
<div class="alert alert-success message" style="display: none">
    <span class="glyphicon glyphicon-ok"></span>
    <em id="msg"></em>
</div>
<style type="text/css">
    table.tableizer-table {
        font-size: 12px;
        /*border: 1px solid #CCC;*/ 
        font-family: Arial, Helvetica, sans-serif;
    } 
    .tableizer-table td {
        padding: 4px;
        margin: 3px;
        border: 1px solid #CCC;
        position: relative;
        text-align: center;
        font-size: 16px;
    }
    .fw-600 {
        font-weight: 600;
    }
    .green {
        background-color: #9bbb59 !important;
        color: #fff !important;
    }
    .yellow {
        background-color: #ffc000 !important;
        color: #fff !important;
    }
    .red {
        background-color: #ff0000 !important;
        color: #fff !important;
    }
</style>
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
                            <span>Qualitative Risk Matrix</span>
                        </li>
                    </ul>
                </div>
                <h4>Qualitative Risk Matrix</h4>

                <div class="col-md-12">
                    <div class="margin-bottom-50">

                        <table class="tableizer-table" width="60%">
                            <tbody>
                                <tr class="tableizer-firstrow">
                                    <td colspan="2" rowspan="2" style="border: 0"></td>
                                    <td colspan="5" class="fw-600" style="text-align: center;">Likelihood</td>
                                </tr>
                                <tr>
                                    <td class="fw-600" style="width: 14.8%;"> 1 Rare</td>
                                    <td class="fw-600" style="width: 14.8%;"> 2 Unlikely</td>
                                    <td class="fw-600" style="width: 14.8%;"> 3 Possible</td>
                                    <td class="fw-600" style="width: 14.8%;"> 4 Likely</td>
                                    <td class="fw-600" style="width: 14.8%;"> 5 Almost Certain</td>
                                </tr>
                                <tr>
                                    <td rowspan="5" style="width: 40px;"><span style="transform: rotate(-90deg);display: block;font-weight: 600;padding: 0;margin-top: 30px;width: 30px;position: absolute;top: 50%;">Consequence</span></td>
                                    <td class="fw-600 text-left">5  Catastrophic</td>
                                    <td colspan="5" rowspan="5" style="padding: 0;vertical-align: top;" >
                                        <table style="width: 100%;" class="change_font">
                                            <tbody>
                                                <tr>
                                                    @foreach($qualitativeriskscore_data as $data)
                                                    @if($loop->index%5==0)
                                                </tr>
                                                <tr>
                                                    @endif
                                                    <td  id="{{$data->id}}" style="width: 14.8%;">
                                                        @if($data->risk_score=='Medium')
                                                        <label class=" form-control border-radius-0 riskLabel yellow" data-value="{{intval($data->risk_value)}}">{{intval($data->risk_value)}}</label>
                                                        @endif
                                                        @if($data->risk_score=='Low')
                                                        <label class=" form-control border-radius-0 riskLabel green" data-value="{{intval($data->risk_value)}}">{{intval($data->risk_value)}}</label>
                                                        @endif
                                                        @if($data->risk_score=='High')
                                                        <label class=" form-control border-radius-0 riskLabel red" data-value="{{intval($data->risk_value)}}">{{intval($data->risk_value)}}</label>
                                                        @endif
                                                    </td>
                                                    @endforeach
                                                </tr>                                                
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="fw-600 text-left">4  Major</td>
                                </tr>
                                <tr>
                                    <td class="fw-600 text-left">3  Moderate</td>                                   
                                </tr>
                                <tr>
                                    <td class="fw-600 text-left">2  Minor</td>
                                </tr>
                                <tr>
                                    <td class="fw-600 text-left">1  Negligible</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
