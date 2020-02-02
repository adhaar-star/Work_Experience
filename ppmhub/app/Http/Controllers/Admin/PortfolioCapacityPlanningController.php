<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Portfoliocapacityplanning;
use App\Portfolio;
use App\Buckets;
use App\Planningtype;
use App\Costingtype;
use App\Collectiontype;
use App\Viewtype;
use App\Planningunit;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Currency;
use Yajra\DataTables\Facades\DataTables;

class PortfolioCapacityPlanningController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $portfoliocapacityplanning = Portfoliocapacityplanning::join('portfolio', 'portfolio.id', '=', 'portfolio_capacity_planning.portfolio_id')->get();

    $buckets = Buckets::where('company_id', Auth::user()->company_id)->where('is_delete', 'N')->with('children')->with('portfolio')->with('department_name')->with('costcentre_name')->with('currencyname')->get();
    $bucketArray = Buckets::bucketDemand($buckets);
    return view('admin.portfoliocapacityplanning.index');
//    return view('admin.portfoliocapacityplanning.index', compact('portfoliocapacityplanning', 'bucketArray'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    $planning_type = Planningtype::pluck('name', 'id')->prepend('Please select', '');
    $costing_type = Costingtype::pluck('name', 'id')->prepend('Please select', '');
    $collection_type = Collectiontype::pluck('name', 'id')->prepend('Please select', '');
    $view_type = Viewtype::pluck('name', 'id')->prepend('Please select', '');
    $buckets = Buckets::pluck("name", "id")->prepend('Please select', '');
    $portfolio = Portfolio::pluck("name", "id")->prepend('Please select', '');
    $Planningunit = Planningunit::pluck("name", "id")->prepend('Please select', '');
    $Currencyunit = Currency::pluck("short_code", "id");

    return view('admin.portfoliocapacityplanning.create', compact('Currencyunit', 'portfolio', 'buckets', 'planning_type', 'costing_type', 'collection_type', 'view_type', 'Planningunit'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request            
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $portfolioCapacityPlanning = $request->all();

    $validationmessages = [
        'portfolio_id.required' => 'Please select portfolio',
        'bucket.required' => 'Please select bucket',
        'planning_type.required' => 'Please select planning type',
        'costing_type.required' => 'Please select costing type',
        'collection_type.required' => 'Please select collection type',
        'view_type.required' => 'Please select view type',
        'total_period.required' => 'Please enter total',
        'distribute.required' => 'Please enter distribute',
    ];

    $validator = Validator::make($portfolioCapacityPlanning, [
          'portfolio_id' => 'required',
          'bucket' => 'required',
          'planning_type' => 'required',
          'costing_type' => 'required',
          'collection_type' => 'required',
          'view_type' => 'required',
          'total_period' => 'required',
          'distribute' => 'required',
        ], $validationmessages);

    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('admin/portfoliocapacityplanning/create')->withErrors($validator)->withInput($request->all());
    }

    $portfolioCapacityPlanning['company_id'] = Auth::user()->company_id;
    $portfolioCapacityPlanning['created_date'] = date("Y-m-d");
    $portfolioCapacityPlanning['created_by'] = Auth::User()->id;

    Portfoliocapacityplanning::create($portfolioCapacityPlanning);

    session()->flash('flash_message', 'Portfolio capacity planning created successfully...');
    return redirect('admin/portfoliocapacityplanning');
  }

  /**
   * Display the specified resource.
   *
   * @param int $id            
   * @return \Illuminate\Http\Response
   */
  public function show($id) {
    //
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param int $id            
   * @return \Illuminate\Http\Response
   */
  public function edit($id) {
    $portfoliocapacityplanning = Portfoliocapacityplanning::find($id);

    $planning_type = Planningtype::pluck('name', 'id')->prepend('Please select', '');
    $costing_type = Costingtype::pluck('name', 'id')->prepend('Please select', '');
    $collection_type = Collectiontype::pluck('name', 'id')->prepend('Please select', '');
    $view_type = Viewtype::pluck('name', 'id')->prepend('Please select', '');
    $buckets = Buckets::pluck("name", "id")->prepend('Please select', '');
    $portfolio = Portfolio::pluck("name", "id")->prepend('Please select', '');
    $Planningunit = Planningunit::pluck("name", "id")->prepend('Please select', '');
    $Currencyunit = Currency::pluck("short_code", "id");

    return view('admin.portfoliocapacityplanning.create', compact('Currencyunit', 'portfoliocapacityplanning', 'buckets', 'portfolio', 'planning_type', 'costing_type', 'collection_type', 'view_type', 'Planningunit'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request            
   * @param int $id            
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    $get_portfoliocapacityplanning = Portfoliocapacityplanning::find($id);

    $portfolioCapacityPlanning = $request->all();

    $validationmessages = [
        'portfolio_id.required' => 'Please select portfolio',
        'bucket.required' => 'Please select bucket',
        'planning_type.required' => 'Please select planning type',
        'costing_type.required' => 'Please select costing type',
        'collection_type.required' => 'Please select collection type',
        'view_type.required' => 'Please select view type',
        'planning_start.required' => 'Please select start date',
        'planning_end.required' => 'Please select end date',
        'planning_end.after' => 'Please select end date greater then start date',
        'total_period.required' => 'Please enter total',
        'distribute.required' => 'Please enter distribute',
//            'planning_unit.required' => 'Please enter planning unit',
    ];

    $validator = Validator::make($portfolioCapacityPlanning, [
          'portfolio_id' => 'required',
          'bucket' => 'required',
          'planning_type' => 'required',
          'costing_type' => 'required',
          'collection_type' => 'required',
          'view_type' => 'required',
          'planning_start' => 'required|date',
          'planning_end' => 'required|date|after:planning_start',
          'total_period' => 'required',
          'distribute' => 'required',
//                    'planning_unit' => 'required',
        ], $validationmessages);

    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('admin/portfoliocapacityplanning/' . $id . '/edit')->withErrors($validator)->withInput($request->all());
    }

    $get_portfoliocapacityplanning->update($portfolioCapacityPlanning);
    session()->flash('flash_message', 'Portfolio capacity planning updated successfully...');
    return redirect('admin/portfoliocapacityplanning');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id            
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    $portfoliocapacityplanning = Portfoliocapacityplanning::find($id);
    $portfoliocapacityplanning->delete();
    session()->flash('flash_message', 'Portfolio capacity planning deleted successfully...');
    return redirect('admin/portfoliocapacityplanning');
  }

  public function data_table() {
    $dataTable = Portfolio::where('company_id', Auth::user()->company_id)->get();
    return DataTables::of($dataTable)
       ->editColumn('created_by', function ($data) {
                return isset($data->creator->name) ? $data->creator->name : 'N/A' ;
            })
           ->editColumn('created_at', function ($data) {
                return $data->created_at->format('d-m-Y');
            })    ->make(true);
  }

}
