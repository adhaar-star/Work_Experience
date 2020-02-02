<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Portfolio;
use App\Buckets;
use App\category;
use App\group;
use App\view;
use App\Manual_capacity;
use Illuminate\Support\Facades\Input;
use App\Manual_financial;

class ManualFinancialPlanningController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    //
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    $portfolio = Portfolio::pluck("name", "id");
    $buckets = Buckets::pluck("name", "id");
    $category = category::pluck("category_name", "id");
    $group = group::pluck("group_name", "id");
    $view = view::pluck("view_name", "id");

    return view('admin.bucketfp.manual-financial.create', compact('portfolio', 'buckets', 'category', 'group', 'view'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $manual_data = Input::all();
    $validator = Manual_financial::validateManualFinancialCapacity($manual_data);
    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('admin/manual-financial/create')->withErrors($validator)->withInput(Input::all());
    }
    $manual_data['company_id'] = \Auth::User()->company_id;
    $start_date = strtotime($manual_data['start_date']);
    $end_date = strtotime($manual_data['end_date']);
    if ($start_date > $end_date) {
      $msgs = ['start_date' => 'End Date can`t be less than Start Date.'];
      return redirect('admin/manual-financial/create')->withErrors($msgs)->withInput(Input::all());
    }
    Manual_financial::create($manual_data);
    session()->flash('flash_message', 'Manual financial planning created successfully...');
    return redirect('admin/bucketfp');
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
    //
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    //
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    //
  }

}
