<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Portfolio;
use App\Buckets;
use App\Manual_capacity;
use App\Project;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Createrole;

class ManualCapacityController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {      
      return view('admin.portfoliocapacityplanning.manualCapacity.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {

    $portfolio = Portfolio::where('company_id', Auth::user()->company_id)->pluck("name", "id");
    return view('admin.portfoliocapacityplanning.manualCapacity.create', compact('portfolio'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $manual_data = Input::all();
    $validator = Manual_capacity::validateManualCapacity($manual_data);
    if ($validator->fails()) {
      $msgs = $validator->messages();
      return back()->withErrors($validator)->withInput(Input::all());
    }
    $manual_data['company_id'] = \Auth::User()->company_id;
    $start_date = strtotime($manual_data['start_date']);
    $end_date = strtotime($manual_data['end_date']);
    if ($start_date > $end_date) {
      $msgs = ['start_date' => 'End Date can`t be less than Start Date.'];
      return redirect('admin/manualCapacity/create')->withErrors($msgs)->withInput(Input::all());
    }
    Manual_capacity::create($manual_data);
    session()->flash('flash_message', 'Manual capacity  planning created successfully...');
    return redirect()->route('manualCapacity.dashboard');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
        $portfolio = Portfolio::where('company_id', Auth::user()->company_id)->pluck("name", "id");
        $manualCapacity = Manual_capacity::where('company_id', Auth::user()->company_id)->find($id);
        if (!isset($manualCapacity)) {
            return redirect()->route('manualCapacity.dashboard');
        }
        $buckets = Buckets::Where('company_id', Auth::user()->company_id)->where('portfolio_id',$manualCapacity->portfolio)->pluck('name', 'id')->toArray();

        $projects = Project::Select('id')->where('bucket_id', $manualCapacity->bucket)->where('company_id', Auth::user()->company_id)->pluck('id')->toArray();
        $categories = Createrole::Select('role_fun')->whereIn('project_id', $projects)->where('company_id', Auth::user()->company_id)->distinct()->pluck('role_fun', 'role_fun')->toArray();
        $groups = Createrole::Select('role_name')->whereIn('project_id', $projects)->where('company_id', Auth::user()->company_id)->distinct()->pluck('role_name', 'role_name')->toArray();
        
        return view('admin.portfoliocapacityplanning.manualCapacity.create', compact('portfolio', 'manualCapacity', 'buckets', 'categories', 'groups'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    $manualCapacity = Manual_capacity::where('company_id', Auth::user()->company_id)->find($id);
    if($manualCapacity){
        $manual_data = Input::all();
        $validator = Manual_capacity::validateManualCapacity($manual_data);
        if ($validator->fails()) {
          $msgs = $validator->messages();
          return back()->withErrors($validator)->withInput(Input::all());
        }

        if (strtotime($manual_data['start_date']) > strtotime($manual_data['end_date'])) {
          $msgs = ['start_date' => 'End Date can`t be less than Start Date.'];
          return back()->withErrors($msgs)->withInput(Input::all());
        }
        $manualCapacity->update($manual_data);
        session()->flash('flash_message', 'Manual capacity  planning updated successfully...');
    }
    return redirect()->route('manualCapacity.dashboard');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    Manual_capacity::where('id', $id)->where('company_id', Auth::user()->company_id)->delete();
    return response()->json(['status' => true, 'data' => 'Manual Capacity Planning deleted successfully...']);
  }

  public function getBucket($portfolioId) {
    $buckets = Buckets::where('portfolio_id', $portfolioId)->where('company_id', Auth::user()->company_id)->get();
    //get buckets based on selection of portfolio
    $bucketList = array();
    foreach ($buckets as $key => $value) {
      $bucketArray = array(
          'bucket_name' => $value->name,
          'id' => $value->id,
      );
      array_push($bucketList, $bucketArray);
    }
    return response()->json(['status' => true, 'data' => $bucketList]);
  }

  public function getCategoryGroup($bucketId) {
    $projects = Project::Select('id')->where('bucket_id', $bucketId)->where('company_id', Auth::user()->company_id)->pluck('id')->toArray();
    $category = Createrole::Select('role_fun')->whereIn('project_id', $projects)->where('company_id', Auth::user()->company_id)->distinct()->get()->toArray();
    $group = Createrole::Select('role_name')->whereIn('project_id', $projects)->where('company_id', Auth::user()->company_id)->distinct()->get()->toArray();
    return response()->json(['status' => true, 'category' => $category, 'group' => $group]);
  }
  
  public function dashboard(){
    $manualCapacity = Manual_capacity::manualDashboadDatatable();
    return $manualCapacity;
  }

}
