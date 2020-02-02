<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Portfolio;
use App\Currency;
use App\Portfoliotype;
use App\Buckets;
use App\Project;
use App\Capacityunits;
use App\Planningunit;
use App\Roleauth;
use Illuminate\Support\Facades\Input;
use Yajra\DataTables\Facades\DataTables;


class PortfolioController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    Roleauth::check('portfolio.index');

    $portfolio = Portfolio::where('company_id', Auth::user()->company_id)->with('portfolio_type')->with('capacity_units')->with('planning_units')->with('portfolio_buckets')->get();

    return view('admin.portfolio.index', compact('portfolio'));
  }

  public function export_cs() {
    Roleauth::check('portfolio.export');

    $portfolio = Portfolio::where('company_id', Auth::user()->company_id)->get();

    $header = "ID" . "\t";
    $header .= "Name" . "\t";
    $header .= "Type" . "\t";
    $header .= "Bucket" . "\t";
    $header .= "Items" . "\t";
    $header .= "Projects" . "\t";
    $header .= "Curreny" . "\t";
    $header .= "Description" . "\t";
    $header .= "Created By" . "\t";
    $header .= "Created At" . "\t";
    $header .= "Updated By" . "\t";
    $header .= "Updated At" . "\t";

    foreach ($portfolio as $port_data) {

      $row1 = array();
      $row1[] = $port_data->id;
      $row1[] = $port_data->name;
      $row1[] = $port_data->type;
      $row1[] = $port_data->buckets;
      $row1[] = $port_data->items;
      $row1[] = $port_data->projects;
      $row1[] = $port_data->currency;
      $row1[] = $port_data->description;
      $row1[] = $port_data->created_by;
      $row1[] = $port_data->created_at;
      $row1[] = $port_data->updated_by;
      $row1[] = $port_data->updated_at;

      $data = join("\t", $row1) . "\n";
    }

    header("Content-type: application/vnd.ms-excel");
    header("Content-Disposition: attachment; filename=Portfolio.csv");
    header("Pragma: no-cache");
    header("Expires: 0");
    print "$header\n$data";
    exit();
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    Roleauth::check('portfolio.create');

    $temp = Currency::where('company_id', Auth::user()->company_id)->get();
    $currency = array();
    foreach ($temp as $key => $value) {
      $currency[$value->id] = $value->short_code;
    }

    $ptype = Portfoliotype::where('company_id', Auth::user()->company_id)->pluck("name", "id")->prepend('Please select', '');
    $buck = Buckets::where('company_id', Auth::user()->company_id)->pluck("name", "id")->prepend('Please select', '');
    $project = Project::where('company_id', Auth::user()->company_id)->pluck("project_Id", "Id")->prepend('Please select', '');

    return view('admin.portfolio.create', compact('currency', 'ptype', 'buck', 'project'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param \Illuminate\Http\Request $request            
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    Roleauth::check('portfolio.create');

    $validator = Portfolio::validatePortfolio(Input::all());
    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('admin/portfolio/create')->withErrors($validator)->withInput(Input::all());
    }
    Portfolio::create([
        'name' => $request->input('name'),
        'port_id' => $request->input('port_id'),
        'type' => $request->input('type'),
        'currency' => $request->input('currency'),
        'description' => $request->input('description'),
        'created_by' => Auth::id(),
        'updated_by' => Auth::id(),
        'company_id' => Auth::user()->company_id
    ]);

    session()->flash('flash_message', 'Portfolio created successfully...');
    return redirect('admin/portfolio');
  }

  /**
    'buckets' => 'required',
    'items' => 'required',
    'projects' => 'required',

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
    Roleauth::check('portfolio.edit');
    $portfolio = Portfolio::where('company_id', Auth::user()->company_id)->find($id);
    if (!isset($portfolio)) {
      return redirect('admin/portfolio');
    }

    $temp = Currency::where('company_id', Auth::user()->company_id)->get();
    foreach ($temp as $key => $value) {
      $currency[$value->id] = $value->short_code;
    }


    $ptype = Portfoliotype::where('company_id', Auth::user()->company_id)->pluck("name", "id")->prepend('Please select', '');
    $buck = Buckets::where('company_id', Auth::user()->company_id)->pluck("name", "id")->prepend('Please select', '');
    $capacity_unit = Capacityunits::where('company_id', Auth::user()->company_id)->pluck("name", "id")->prepend('Please select', '');
    $project = Project::where('company_id', Auth::user()->company_id)->pluck("project_Id", "Id")->prepend('Please select', '');
    $planning_unit = Planningunit::where('company_id', Auth::user()->company_id)->pluck("name", "id")->prepend('Please select', '');

    return view('admin.portfolio.create', compact('portfolio', 'currency', 'ptype', 'buck', 'project', 'capacity_unit', 'planning_unit'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param \Illuminate\Http\Request $request            
   * @param int $id            
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    Roleauth::check('portfolio.edit');
    $portfolio = Portfolio::where('company_id', Auth::user()->company_id)->find($id);
    if (!isset($portfolio)) {
      return redirect('admin/portfolio');
    }

    $validator = Portfolio::validatePortfolio(Input::all());
    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('admin/portfolio/'.$id.'/edit')->withErrors($validator)->withInput(Input::all());
    }

    $portfolio->update([
        'name' => $request->input('name'),
        'type' => $request->input('type'),
        'currency' => $request->input('currency'),
        'description' => $request->input('description'),
        'planning_unit' => $request->input('planning_unit'),
        'capacity_unit' => $request->input('capacity_unit'),
        'status' => $request->input('status'),
        'updated_by' => Auth::id()
    ]);
    session()->flash('flash_message', 'Portfolio updated successfully...');
    return redirect('admin/portfolio');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param int $id            
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {

    Roleauth::check('portfolio.delete');
    $portfolio = Portfolio::where('company_id', Auth::user()->company_id)->find($id);
    if (!isset($portfolio)) {
             return response()->json(['status' => 'msg1', 'data' => 'Portfolio cannot delete...']);
//      return redirect('admin/portfolio');
    }
    $portfolio_id = Portfolio::select('id')->where('id', $id)->pluck('id', 'id')->toArray();
    $bucket_id = Buckets::select('portfolio_id')->where('portfolio_id', $portfolio_id)->pluck('portfolio_id', 'id')->toArray();
    if (count($bucket_id) > 0) {
      session()->flash('flash_message', 'Bucket exits for Portfolio cannot delete...');
      return response()->json(['status' => 'msg1', 'data' => 'Bucket exits for Portfolio cannot delete...']);
//      return redirect('admin/portfolio');
    } else {
      $portfolio->delete();
      session()->flash('flash_message', 'Portfolio deleted successfully...');
       return response()->json(['status' => 'msg', 'data' => 'Portfolio deleted successfully...']);
//      return redirect('admin/portfolio');
    }
  }

  public function dashboard() {

    return view('admin.portfolio.dashboard');
  }

  public function data_table() {
    $portfolio = Portfolio::where('company_id', Auth::user()->company_id)->with('portfolio_type')->with('capacity_units')->with('portfolio_buckets')->with('planning_units')->with('updator')->get()->toArray();

    return DataTables::of($portfolio)
                    ->editColumn('portfolio_type', function ($portfolio) {
                      return $portfolio['portfolio_type']['name'];
                    })
                    ->editColumn('change_by', function ($portfolio) {
                    return ($portfolio['updated_by'] !='')?$portfolio['updator']['name']:"Not Changed ";
                    })
                    ->editColumn('buckets', function ($portfolio) {
                    return count($portfolio['portfolio_buckets']);
                    })
                    ->editColumn('status', function ($portfolio) {
                       if($portfolio['status']=='active')
                         return '<label class="label label-success" style="text-align:center;width:80px;" title="Active" >Active</label>';
                       else
                         return '<label class="label label-danger" style="text-align:center;width:80px;" title="Inactive" >Inactive</label>';
                    })
                    ->editColumn('name', function ($portfolio) {
                          return '<a title="View" href="javascript:void(0)" data-type="qualitative_risk" data-id=' . $portfolio['id'] . ' class="viewportfolio">'.$portfolio['name'].'</a>';
                    })
                    ->addColumn('action', function ($portfolio) {
                        return '<a title="View" href="javascript:void(0)" data-id=' . $portfolio['id'] . ' class="viewportfolio btn btn-info btn-xs  margin-right-1"><i class="fa fa-eye "></i> </a>&nbsp;&nbsp;<a  href="' . route('portfolio.update',[$portfolio['id'].'/edit']).'"  title="Edit" class="btn btn-primary btn-xs  margin-right-1 "><i class="fa fa-edit"></i> </a>&nbsp;&nbsp;<a title="Delete" href="javascript:void(0)" data-type="qualitative_risk" data-id=' . $portfolio['id'] . ' class="deleteportfolio btn btn-danger btn-xs margin-right-1"><i class="fa fa-trash"></i></a>'; })
                    ->rawColumns(['portfolio_type','change_by','buckets','status','action','name'])
                    ->make();
  }
  public function getPortfolioData($id){
    $portfolio = Portfolio::where('company_id', Auth::user()->company_id)
            ->where('portfolio.id', "=", $id)
            ->with('portfolio_type')->with('capacity_units')->with('portfolio_buckets')->with('planning_units')->with('updator')->with('creator')->first();
    $portfolio['createdAt']= date("d/m/Y", strtotime($portfolio['created_at']));
    $portfolio['updatedAt']= date("d/m/Y", strtotime($portfolio['updated_at']));
    return response()->json(['data' => $portfolio]);
  }
}
