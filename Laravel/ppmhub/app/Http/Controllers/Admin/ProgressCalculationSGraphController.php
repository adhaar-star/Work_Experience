<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Project;
use App\country;
use App\state;
use App\public_holidays;
use App\Helpers\ProjectHelpers;
use App\Projecttask;
use App\progress_calculation_physical;
use App\progress_calculation_cost_proportional;

class ProgressCalculationSGraphController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::where('company_id', Auth::user()->company_id)
                ->select('id', DB::raw('concat(project_Id," ( ",project_desc," )") as name'))
                ->pluck('name', 'id');
        return view('admin.project_progress.progress_calculation_graph', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $project_id = $request->input('project_id');
        $method = $request->input('calculation_method');
        $curency = Project::where('project.id', $project_id)
                ->select('currencies.short_code')
                ->leftJoin('currencies', 'currencies.id', '=', 'project.currency')
                ->first();


        if ($method == 0) {
            $data = progress_calculation_physical::where('project_id', $project_id)
                    ->select(DB::raw('CONCAT(YEAR(created_at), "/", WEEK(created_at)) as time'), DB::raw('sum(BCWS) as PV'), DB::raw('sum(actual_cost) as AC'), DB::raw('sum(BCWP) as EV'))
                    ->groupBy('time')
                    ->get();
            if (count($data) > 0)
                $data = $data->toArray();
        }
        else if ($method == 1) {
            $data = progress_calculation_cost_proportional::where('project_id', $project_id)
                    ->select(DB::raw('CONCAT(YEAR(created_at), "/", WEEK(created_at)) as time'), DB::raw('sum(BCWS) as PV'), DB::raw('sum(actual_cost) as AC'), DB::raw('sum(BCWP) as EV'))
                    ->groupBy('time')
                    ->get();
            if (count($data) > 0)
                $data = $data->toArray();
        }

        return response()->json(['status' => 'ok', 'data' => $data, 'currency' => $curency->short_code]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

}
