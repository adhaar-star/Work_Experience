<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Braintree_Plan;
use App\Models\Payment\Plan;

class subscriptionController extends Controller {

   /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
   public function index() {
      $plans = Plan::orderBy('cost')->get();
      return view('front.princing.index', compact('plans'));
   }

   /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
   public function store(Request $request) {
      // get the plan after submitting the form
      $plan = Plan::findOrFail($request->plan);

      // subscribe the user
      $request->user()->newSubscription('main', $plan->braintree_plan)->create($request->payment_method_nonce,['email' => $user->email]);

      // redirect to home after a successful subscription
      return redirect('home');
   }

   /**
    * Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
   public function show(Plan $plan) {
      return view('front.princing.index')->with(['plan' => $plan]);
   }
}
