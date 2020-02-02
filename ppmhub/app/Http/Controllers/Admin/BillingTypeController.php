<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\billing_type;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class BillingTypeController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $billingData = billing_type::all();
    return view('admin.billing_type.index', compact('billingData'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    return view('admin.billing_type.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $data = Input::all();
    $data['company_id'] = Auth::user()->company_id;
    $data['created_at'] = date("Y-m-d");
    $validationmessages = [
        'name.required' => 'Please enter billing name',
    ];
    $validator = Validator::make($data, [
          'name' => 'required',
        ], $validationmessages);

    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('admin/billing_type/create')->withErrors($validator)->withInput(Input::all());
    }
    billing_type::create($data);
    session()->flash('flash_message', 'Billing type created successfully...');
    return redirect('admin/billing_type');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $billing = billing_type::find($id);
    return view('admin.billing_type.create', compact('billing'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    $data = billing_type::find($id);
    $dataInputs = Input::all();
    $validationmessages = [
        'name.required' => 'Please enter billing name',
    ];
    $validator = Validator::make($dataInputs, [
          'name' => 'required',
        ], $validationmessages);
    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('admin/billing_type/' . $id . '/edit')->withErrors($validator)->withInput(Input::all());
    }
    $dataInputs['updated_at'] = date("Y-m-d");
    $data->update($dataInputs);
    session()->flash('flash_message', 'Billing type updated successfully...');
    return redirect('admin/billing_type');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    $billing_id = billing_type::find($id);
    $billing_id->delete($id);
    session()->flash('flash_message', 'Billing type deleted successfully...');
    return redirect('admin/billing_type');
  }

}
