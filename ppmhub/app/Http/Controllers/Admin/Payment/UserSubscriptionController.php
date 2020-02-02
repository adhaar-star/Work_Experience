<?php

namespace App\Http\Controllers\Admin\Payment;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Payment\user_subscription;
use Yajra\DataTables\Facades\DataTables;
use DB;
use Braintree_Subscription;
use Braintree_Exception_NotFound;
use Illuminate\Support\Facades\Auth;
use App\Models\Payment\Plan;

class UserSubscriptionController extends Controller {

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index() {
      $subscription = user_subscription::where('company_id', Auth::user()->company_id)->first();
      $subscriptionId = ($subscription) ? $subscriptionId = $subscription->braintree_subscription_id : '';
      return view('admin.payment.index', compact('subscriptionId'));
   }

   /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function create() {
      //
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request) {
      //
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show($id) {
      $userSubscriptions = DB::table('user_subscription')
                      ->leftJoin('company', 'user_subscription.company_id', '=', 'company.id')
                      ->leftJoin('plans', 'plans.braintree_plan', '=', 'user_subscription.braintree_subscription_plan')
                      ->select('company.company_name as company_name', 'plans.name as plan_name', DB::raw("CONCAT(user_subscription.braintree_subscription_price,' $') AS braintree_subscription_price"), DB::raw("DATE_FORMAT(user_subscription.created_at,'%d-%m-%Y') as subscribed_on"), DB::raw("DATE_FORMAT(user_subscription.next_billing_date,'%d-%m-%Y') as next_billing_date")
                      )->where('company.id', $id)->get();

      return DataTables::of($userSubscriptions)->addIndexColumn()->make();
   }

   /**
    * Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function edit($id) {
      //
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function update(Request $request) {
      $input = $request->all();

      $plan = Plan::where('braintree_plan', $input['new-subscription'])->first();
      if (!$plan) {
         session()->flash('alert-danger', 'Plan Not found');
      } else {
         try {
            $updatePlan = Braintree_Subscription::update($input['subscriptionId'], [
                        'id' => $input['subscriptionId'],
                        'planId' => $plan->braintree_plan,
                        'price' => $plan->cost
            ]);

            if (!$updatePlan) {
               session()->flash('alert-danger', 'Somthing went wrong while updating plan');
            } else {
               $subscription = user_subscription::create(['company_id' => Auth::user()->company_id,
                           'braintree_subscription_id' => $updatePlan->subscription->id,
                           'braintree_subscription_plan' => $updatePlan->subscription->planId,
                           'braintree_subscription_price' => $updatePlan->subscription->price,
                           'next_billing_date' => $updatePlan->subscription->nextBillingDate,
               ]);
               session()->flash('alert-success', 'Your subscription plan has been updated successfully');
            }
         } catch (Braintree_Exception_NotFound $e) {
            session()->flash('alert-danger', 'Subscription not found');
            return redirect('admin/subscriptions');
         }
      }
      return redirect('admin/subscriptions');
   }

   /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function updateSubscription(Request $request) {
      $plans = Plan::orderBy('cost')->get();
      $subscription = user_subscription::where('company_id', Auth::user()->company_id)->orderBy('subscription_Id', 'desc')->first();
      $subscriptionPlan = ($subscription) ? $subscription->braintree_subscription_plan : '';
      return view('admin.payment.updateplan', compact('plans', 'subscription'));
   }

   /**
    * Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function destroy($id) {
      try {
         $subscription = Braintree_Subscription::find($id);
         if ($subscription)
            $result = Braintree_Subscription::cancel($id);

         if ($result) {
            session()->flash('alert-success', 'Plan Subscription is canceled successfully');
            return redirect('admin/subscriptions');
         }
      } catch (Braintree_Exception_NotFound $e) {
         session()->flash('alert-danger', $e->getMessage());
         return redirect('admin/subscriptions');
      }
   }

}
