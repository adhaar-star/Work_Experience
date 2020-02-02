@extends('layout.admin')
@section('title', 'Company Management | Plan Details')
@section('body')
@include('layout.admin_layout_include.alert_messages')
@section('PageCss')
<meta name="csrf-token" content="{{ csrf_token() }}" /> 
{!! Html::style('css/pricing/adminstyle.css') !!}
@endsection
@if(Session::has('flash_message'))
<div class="alert alert-success myalert">
   <span class="glyphicon glyphicon-ok"></span>
   <em> {!! session('flash_message') !!}</em>
</div>
@endif

<section class="panel">
   <div class="panel-body">
      <div class="row">
         <div class="price_outer">
            @foreach ($plans as $plan)
            @php $selected = false; @endphp
            @if(isset($subscription->braintree_subscription_plan) && ($plan->braintree_plan == $subscription->braintree_subscription_plan))
               @php $selected = true; @endphp
            @endif
            <div class="price_main @if($selected) selected @endif" >
               <div class="price_heading define_float">
                  <h2>{{ $plan->name }}</h2>
               </div>
               <div class="price_monthly define_float">
                  <span class="price_currency">$</span>
                  <span class="price_number">{{ number_format($plan->cost, 2) }}</span>
                  <span class="price_duration">/ Monthly</span>
               </div>
               <div class="price_features define_float">
                  <ul>
                     @if ($plan->description)
                     {!!  $plan->description !!}
                     @endif
                  </ul>
               </div>
               <div class="price_cart_button define_float">
                  @if($selected)
                  <a href="javascript:void(0)">Renew on {{Carbon\Carbon::parse($subscription->next_billing_date)->format('d-m-Y')}}</a>
                  @else
                  <a href="javascript:void(0)" class="update-plan" 
                     date-new-sub="{{$plan->braintree_plan}}" 
                     data-subId="{{isset($subscription->braintree_subscription_id)?$subscription->braintree_subscription_id:'0'}}"
                     data-new-sub-name="{{$plan->name}}"
                     >Update plan</a>
                  @endif
               </div>
            </div>
            @endforeach
         </div>         
      </div>
      <!--- Bootstrap Model --->
      <div id="UpdateModal" class="modal fade" role="dialog">
         <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
               <div class="modal-header">
                  <div class="col-sm-6"><h6>Update subscription</h6></div>
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
               </div>
               {!! Form::open(array('route' => array('subscriptions.updatesubscription.update'), 'method' => 'POST','id'=>'cancelform')) !!}
               <div class="modal-body">
                  <p>Do you want to Update your subscription to <b class="new-subscription"></b> plan?</p>
                  <input type="hidden">
                  <p><input type="hidden" name="new-subscription"></p>
                  <p><input type="hidden" name="subscriptionId"></p>
               </div>
               <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-success delete">OK</button>
               </div>
               {!! Form::close() !!}
            </div>
         </div>
      </div>
      <!-- Bootstrap Model -->
   </div>
</section>
@endsection

@section('PageJquery')
{!! Html::script('vendors/jqueryDataTable/jquery.dataTables.min.js') !!}
{!! Html::script('js/payment/updateplan.js') !!}
@endsection