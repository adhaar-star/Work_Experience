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

class Project_Progress_Calculation_Controller extends Controller
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
        return view('admin.project_progress.progress_calculation', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $project_id = $request->input('project_id');
        $method = $request->input('calculation_method');

        $validationmsgitem = [
            'project_id.required' => 'Please Select Project Id',
            'calculation_method.required' => 'Please Select calculation Method',
        ];

        $validator = Validator::make(['project_id' => $project_id, 'calculation_method' => $method], ['project_id' => "required|numeric",
                    'calculation_method' => "required|numeric",
                        ], $validationmsgitem);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/project_progress/calculation')->withErrors($validator)->withInput(Input::all());
        }
        $data = Project::where('company_id', Auth::user()->company_id)
                ->where('id', $project_id)
                ->first();

        $start_date = date('Y-m-d', strtotime($data->start_date));
        $end_date = ($data->end_date != null ) ? date('Y-m-d', strtotime($data->end_date)) : '';
        $actual_progress = 0;


        /**
         * get actual cost for project 
         * pass incremental id as arrgument
         * */
        $actual_cost = ProjectHelpers::get_actual_cost_project($project_id);



        /**
         * Get project planned cost from cost planing modules
         */
        $projectid = $data->project_Id;

        $planned_cost = ProjectHelpers::get_project_planned_cost($projectid);

        /* End of Planned cost */



        /** progress calculation manual 
         *  formula => sum((weight% * completion%)/100 ) 
         */
        $tasks = Projecttask::where('project_id', $data->project_Id)
                ->where('company_id', Auth::user()->company_id)
                ->get()
                ->toArray();
       // if (count($tasks) == 0)
            //session()->flash('error_message', "No tasks found for this project...");

        if ($method == 0) {

            $phy_progress = 0;
            $count = 0;
            foreach ($tasks as $key => $task) {
                $phy_progress += ((($task['weighting_factor']) * ($task['completion'])) / 100);
                $count++;
            }

            if ($count > 0) {
                $phy_progress = $phy_progress / $count;
            }
            $actual_progress = round($phy_progress, 2);
        }


        /* progress calculation cost proportional
         * formula => sum(( Task actual cost / task planned cost ) *100 )  */
        if ($method == 1) {
            $cost_prop_progress = 0;
            $count = 0;
            if ($planned_cost != 0) {
                $cost_prop_progress = ($actual_cost / $planned_cost) * 100;
            }
            foreach ($tasks as $key => $task) {
                $count++;
            }
            if ($count > 0) {
                $cost_prop_progress = $cost_prop_progress / $count;
            }
            $actual_progress = round($cost_prop_progress, 2);
        }




        /*
         * get_planned_progress
         */
        $planned_progress = ProjectHelpers::get_planned_progress($start_date, $end_date);
        $planned_progress = $planned_progress['progress'];


        /*
         * BCWS (PV): Planned Progress % * Total Planned costs
         */
        $BCWS = ($planned_progress / 100) * $planned_cost;


        /*
         * BCWP (EV): Actual progress %* Total planned costs
         */
        $BCWP = ($actual_progress / 100) * $planned_cost;


        /*
         * ACWP: Actual progress %* Total actual costs
         */

        $ACWP = ($actual_progress / 100) * $actual_cost;

        /**
         * Cost variance: BCWP- ACWP
         */
        $cost_variance = $BCWP - $ACWP;

        /**
         * Schedule Variance: BCWP- BCWS
         */
        $schedule_variance = $BCWP - $BCWS;

        /**
         * Value Index: BCWP/ACWP
         */
        $ACWP = ($ACWP != 0) ? $ACWP : 1;
        $value_index = $BCWP / $ACWP;

        //drop down array
        $projects = Project::where('company_id', Auth::user()->company_id)
                ->select('id', DB::raw('concat(project_Id," ( ",project_desc," )") as name'))
                ->pluck('name', 'id');

        return view('admin.project_progress.progress_calculation', compact('BCWS', 'BCWP', 'ACWP', 'cost_variance', 'schedule_variance', 'value_index', 'planned_progress', 'planned_cost', 'actual_cost', 'projects', 'start_date', 'end_date', 'actual_progress'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {

        $project_id = $request->input('project_id');
        $method = $request->input('calculation_method');
        $data = Project::where('company_id', Auth::user()->company_id)
                ->where('id', $project_id)
                ->first();

        $validationmsgitem = [
            'project_id.required' => 'Please Select Project Id',
            'calculation_method.required' => 'Please Select calculation Method',
        ];

        $validator = Validator::make(['project_id' => $project_id, 'calculation_method' => $method], ['project_id' => "required|numeric",
                    'calculation_method' => "required|numeric",
                        ], $validationmsgitem);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return Response::json(['status' => 'error']);
        }

        $start_date = date('Y-m-d', strtotime($data->start_date));
        $end_date = ($data->end_date != null ) ? date('Y-m-d', strtotime($data->end_date)) : '';
        $actual_progress = 0;


        /**
         * get actual cost for project 
         * pass incremental id as arrgument
         * */
        $actual_cost = ProjectHelpers::get_actual_cost_project($project_id);


        /** progress calculation manual 
         *  formula => sum((weight% * completion%)/100 ) 
         */
        $tasks = Projecttask::where('project_id', $data->project_Id)
                ->where('company_id', Auth::user()->company_id)
                ->get()
                ->toArray();

       // if (count($tasks) == 0)
            //session()->flash('error_message', "No tasks foound for this project...");

        if ($method == 0) {

            $phy_progress = 0;
            $count = 0;
            foreach ($tasks as $key => $task) {
                $phy_progress += ((($task['weighting_factor']) * ($task['completion'])) / 100);
                $count++;
            }

            if ($count > 0) {
                $phy_progress = $phy_progress / $count;
            }
            $actual_progress = round($phy_progress, 2);
        }
        /* progress calculation cost proportional
         * formula => sum(( Task actual cost / task planned cost ) *100 )  */
        if ($method == 1) {
            $cost_prop_progress = 0;
            $count = 0;
            if ($planned_cost != 0) {
                $cost_prop_progress = ($actual_cost / $planned_cost) * 100;
            }
            foreach ($tasks as $key => $task) {
                $count++;
            }
            if ($count > 0) {
                $cost_prop_progress = $cost_prop_progress / $count;
            }
            $actual_progress = round($cost_prop_progress, 2);
        }

        /**
         * Get project planned cost from cost planing modules
         */
        $projectid = $data->project_Id;

        $planned_cost = ProjectHelpers::get_project_planned_cost($projectid);

        /* End of Planned cost */



        /*
         * get_planned_progress
         */
        $planned_progress = ProjectHelpers::get_planned_progress($start_date, $end_date);
        $planned_progress = $planned_progress['progress'];


        /*
         * BCWS (PV): Planned Progress % * Total Planned costs
         */
        $BCWS = ($planned_progress / 100) * $planned_cost;


        /*
         * BCWP (EV): Actual progress %* Total planned costs
         */
        $BCWP = ($actual_progress / 100) * $planned_cost;


        /*
         * ACWP: Actual progress %* Total actual costs
         */

        $ACWP = ($actual_progress / 100) * $actual_cost;

        /**
         * Cost variance: BCWP- ACWP
         */
        $cost_variance = $BCWP - $ACWP;

        /**
         * Schedule Variance: BCWP- BCWS
         */
        $schedule_variance = $BCWP - $BCWS;

        /**
         * Value Index: BCWP/ACWP
         */
        $ACWP = ($ACWP != 0) ? $ACWP : 1;
        $value_index = $BCWP / $ACWP;


        /**
         * validaion
         * * */
        /**
         * store to DB
         */
        $data = ['project_id' => $project_id,
            'method' => $method,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'planned_progress' => $planned_progress,
            'actual_progress' => $actual_progress,
            'planned_cost' => $planned_cost,
            'actual_cost' => $actual_cost,
            'BCWS' => $BCWS,
            'BCWP' => $BCWP,
            'ACWP' => $ACWP,
            'cost_variance' => $cost_variance,
            'schedule_variance' => $schedule_variance,
            'value_index' => $value_index,
            'company_id' => Auth::user()->company_id,
            'created_by' => Auth::user()->id];


        if ($method == 0) {
            if (progress_calculation_physical::create($data)) {
                session()->flash('flash_message', 'Progress Calculation Saved for Physical Method.');
                return Response::json(['status' => 'ok']);
            } else {
                return Response::json(['status' => 'error']);
            }
        } elseif ($method == 1) {
            if (progress_calculation_cost_proportional::create($data)) {
                session()->flash('flash_message', 'Progress Calculation Saved for Cost Proportional Method.');
                return Response::json(['status' => 'ok']);
            } else {
                return Response::json(['status' => 'error']);
            }
        }
        $ACWP = ($actual_progress / 100) * $actual_cost;

        /**
         * Cost variance: BCWP- ACWP
         */
        $cost_variance = $BCWP - $ACWP;

        /**
         * Schedule Variance: BCWP- BCWS
         */
        $schedule_variance = $BCWP - $BCWS;

        /**
         * Value Index: BCWP/ACWP
         */
        $ACWP = ($ACWP != 0) ? $ACWP : 1;
        $value_index = $BCWP / $ACWP;


        /**
         * validaion
         * * */
        /**
         * store to DB
         */
        $data = ['project_id' => $project_id,
            'method' => $method,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'planned_progress' => $planned_progress,
            'actual_progress' => $actual_progress,
            'planned_cost' => $planned_cost,
            'actual_cost' => $actual_cost,
            'BCWS' => $BCWS,
            'BCWP' => $BCWP,
            'ACWP' => $ACWP,
            'cost_variance' => $cost_variance,
            'schedule_variance' => $schedule_variance,
            'value_index' => $value_index,
            'company_id' => Auth::user()->company_id,
            'created_by' => Auth::user()->id];


        if ($method == 0) {
            if (progress_calculation_physical::create($data)) {
                session()->flash('flash_message', 'Progress Calculation Saved for Physical Method.');
                return Response::json(['status' => 'ok']);
            } else {
                return Response::json(['status' => 'error']);
            }
        } elseif ($method == 1) {
            if (progress_calculation_cost_proportional::create($data)) {
                session()->flash('flash_message', 'Progress Calculation Saved for Cost Proportional Method.');
                return Response::json(['status' => 'ok']);
            } else {
                return Response::json(['status' => 'error']);
            }
        }
        $ACWP = ($actual_progress / 100) * $actual_cost;

        /**
         * Cost variance: BCWP- ACWP
         */
        $cost_variance = $BCWP - $ACWP;

        /**
         * Schedule Variance: BCWP- BCWS
         */
        $schedule_variance = $BCWP - $BCWS;

        /**
         * Value Index: BCWP/ACWP
         */
        $ACWP = ($ACWP != 0) ? $ACWP : 1;
        $value_index = $BCWP / $ACWP;


        /**
         * validaion
         * * */
        /**
         * store to DB
         */
        $data = ['project_id' => $project_id,
            'method' => $method,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'planned_progress' => $planned_progress,
            'actual_progress' => $actual_progress,
            'planned_cost' => $planned_cost,
            'actual_cost' => $actual_cost,
            'BCWS' => $BCWS,
            'BCWP' => $BCWP,
            'ACWP' => $ACWP,
            'cost_variance' => $cost_variance,
            'schedule_variance' => $schedule_variance,
            'value_index' => $value_index,
            'company_id' => Auth::user()->company_id,
            'created_by' => Auth::user()->id];


        if ($method == 0) {
            if (progress_calculation_physical::create($data)) {
                session()->flash('flash_message', 'Progress Calculation Saved for Physical Method.');
                return Response::json(['status' => 'ok']);
            } else {
                return Response::json(['status' => 'error']);
            }
        } elseif ($method == 1) {
            if (progress_calculation_cost_proportional::create($data)) {
                session()->flash('flash_message', 'Progress Calculation Saved for Cost Proportional Method.');
                return Response::json(['status' => 'ok']);
            } else {
                return Response::json(['status' => 'error']);
            }
        }

        /**
         * Cost variance: BCWP- ACWP
         */
        $cost_variance = $BCWP - $ACWP;

        /**
         * Schedule Variance: BCWP- BCWS
         */
        $schedule_variance = $BCWP - $BCWS;

        /**
         * Value Index: BCWP/ACWP
         */
        $ACWP = ($ACWP != 0) ? $ACWP : 1;
        $value_index = $BCWP / $ACWP;


        /**
         * validaion
         * * */
        /**
         * store to DB
         */
        $data = ['project_id' => $project_id,
            'method' => $method,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'planned_progress' => $planned_progress,
            'actual_progress' => $actual_progress,
            'planned_cost' => $planned_cost,
            'actual_cost' => $actual_cost,
            'BCWS' => $BCWS,
            'BCWP' => $BCWP,
            'ACWP' => $ACWP,
            'cost_variance' => $cost_variance,
            'schedule_variance' => $schedule_variance,
            'value_index' => $value_index,
            'company_id' => Auth::user()->company_id,
            'created_by' => Auth::user()->id];


        if ($method == 0) {
            if (progress_calculation_physical::create($data)) {
                session()->flash('flash_message', 'Progress Calculation Saved for Physical Method.');
                return Response::json(['status' => 'ok']);
            } else {
                return Response::json(['status' => 'error']);
            }
        } elseif ($method == 1) {
            if (progress_calculation_cost_proportional::create($data)) {
                session()->flash('flash_message', 'Progress Calculation Saved for Cost Proportional Method.');
                return Response::json(['status' => 'ok']);
            } else {
                return Response::json(['status' => 'error']);
            }
        }

        /**
         * Cost variance: BCWP- ACWP
         */
        $cost_variance = $BCWP - $ACWP;

        /**
         * Schedule Variance: BCWP- BCWS
         */
        $schedule_variance = $BCWP - $BCWS;

        /**
         * Value Index: BCWP/ACWP
         */
        $ACWP = ($ACWP != 0) ? $ACWP : 1;
        $value_index = $BCWP / $ACWP;


        /**
         * validaion
         * * */
        /**
         * store to DB
         */
        $data = ['project_id' => $project_id,
            'method' => $method,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'planned_progress' => $planned_progress,
            'actual_progress' => $actual_progress,
            'planned_cost' => $planned_cost,
            'actual_cost' => $actual_cost,
            'BCWS' => $BCWS,
            'BCWP' => $BCWP,
            'ACWP' => $ACWP,
            'cost_variance' => $cost_variance,
            'schedule_variance' => $schedule_variance,
            'value_index' => $value_index,
            'company_id' => Auth::user()->company_id,
            'created_by' => Auth::user()->id];


        if ($method == 0) {
            if (progress_calculation_physical::create($data)) {
                session()->flash('flash_message', 'Progress Calculation Saved for Physical Method.');
                return Response::json(['status' => 'ok']);
            } else {
                return Response::json(['status' => 'error']);
            }
        } elseif ($method == 1) {
            if (progress_calculation_cost_proportional::create($data)) {
                session()->flash('flash_message', 'Progress Calculation Saved for Cost Proportional Method.');
                return Response::json(['status' => 'ok']);
            } else {
                return Response::json(['status' => 'error']);
            }
        }

        /**
         * Cost variance: BCWP- ACWP
         */
        $cost_variance = $BCWP - $ACWP;

        /**
         * Schedule Variance: BCWP- BCWS
         */
        $schedule_variance = $BCWP - $BCWS;

        /**
         * Value Index: BCWP/ACWP
         */
        $ACWP = ($ACWP != 0) ? $ACWP : 1;
        $value_index = $BCWP / $ACWP;


        /**
         * validaion
         * * */
        /**
         * store to DB
         */
        $data = ['project_id' => $project_id,
            'method' => $method,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'planned_progress' => $planned_progress,
            'actual_progress' => $actual_progress,
            'planned_cost' => $planned_cost,
            'actual_cost' => $actual_cost,
            'BCWS' => $BCWS,
            'BCWP' => $BCWP,
            'ACWP' => $ACWP,
            'cost_variance' => $cost_variance,
            'schedule_variance' => $schedule_variance,
            'value_index' => $value_index,
            'company_id' => Auth::user()->company_id,
            'created_by' => Auth::user()->id];


        if ($method == 0) {
            if (progress_calculation_physical::create($data)) {
                session()->flash('flash_message', 'Progress Calculation Saved for Physical Method.');
                return Response::json(['status' => 'ok']);
            } else {
                return Response::json(['status' => 'error']);
            }
        } elseif ($method == 1) {
            if (progress_calculation_cost_proportional::create($data)) {
                session()->flash('flash_message', 'Progress Calculation Saved for Cost Proportional Method.');
                return Response::json(['status' => 'ok']);
            } else {
                return Response::json(['status' => 'error']);
            }
        }

        /**
         * Cost variance: BCWP- ACWP
         */
        $cost_variance = $BCWP - $ACWP;

        /**
         * Schedule Variance: BCWP- BCWS
         */
        $schedule_variance = $BCWP - $BCWS;

        /**
         * Value Index: BCWP/ACWP
         */
        $ACWP = ($ACWP != 0) ? $ACWP : 1;
        $value_index = $BCWP / $ACWP;


        /**
         * validaion
         * * */
        /**
         * store to DB
         */
        $data = ['project_id' => $project_id,
            'method' => $method,
            'start_date' => $start_date,
            'end_date' => $end_date,
            'planned_progress' => $planned_progress,
            'actual_progress' => $actual_progress,
            'planned_cost' => $planned_cost,
            'actual_cost' => $actual_cost,
            'BCWS' => $BCWS,
            'BCWP' => $BCWP,
            'ACWP' => $ACWP,
            'cost_variance' => $cost_variance,
            'schedule_variance' => $schedule_variance,
            'value_index' => $value_index,
            'company_id' => Auth::user()->company_id,
            'created_by' => Auth::user()->id];


        if ($method == 0) {
            if (progress_calculation_physical::create($data)) {
                session()->flash('flash_message', 'Progress Calculation Saved for Physical Method.');
                return Response::json(['status' => 'ok']);
            } else {
                return Response::json(['status' => 'error']);
            }
        } elseif ($method == 1) {
            if (progress_calculation_cost_proportional::create($data)) {
                session()->flash('flash_message', 'Progress Calculation Saved for Cost Proportional Method.');
                return Response::json(['status' => 'ok']);
            } else {
                return Response::json(['status' => 'error']);
            }
        }
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
