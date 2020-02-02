<?php

namespace App\Http\Controllers\Admin;

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Personassignment;
use Illuminate\Support\Facades\DB;
use App\Employee_records;
use App\Assignrole;
use App\Projecttask;
use App\Createrole;
use App\Project;
use App\taskAssignment;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ResourceDemandvsSupplyController extends Controller
{

    public function index($id = null)
    {
        $project_ids = Project::where('company_id', Auth::user()->company_id)->select(DB::raw("CONCAT(project_Id,' ( ',project_name,' )') AS project_name"), 'id')->pluck('project_name', 'id');

        /**
         * Fetch graph data , DB query 
         * (total days - task assigned days) -> not assigned to person (days) 
         * person assigne to task -> task assigned (days)
         * assigne role to person -> role asssigned (days)
         * Total days -> 15|| diff between datepickers
         * @return array
         */
        $days = '';
        for ($i = 1; $i <= 90; $i++) {
            $days .= ',sum(personassignment.day' . $i . ') as day' . $i;
        }
        $magnum = DB::table('project')
                ->where('project.company_id', Auth::user()->company_id)
                ->select(DB::raw('tasks_subtask.start_date,tasks_subtask.end_date,'
                                . 'project.id,tasks_subtask.total_demand'))
                ->join('tasks_subtask', 'tasks_subtask.project_id', '=', 'project.project_Id')
                ->groupBy('project.id', 'tasks_subtask.start_date', 'tasks_subtask.end_date', 'tasks_subtask.total_demand')
                ->get()
                ->toArray();

        $magnum = json_decode(json_encode($magnum), true);
        $result1 = [];
        foreach ($magnum as $index => $data) {

            if (in_array($data['id'], array_column($result1, 'id'))) {
                $key = array_search($data['id'], array_column($result1, 'id'));
                //print('found at :' . $key);
                //echo "\r\n";

                $startdate = strtotime($data['start_date']);
                $enddate = strtotime($data['end_date']);
                $total_demand = $data['total_demand'];
                $diff = date_diff(date_create($data['end_date']), date_create($data['start_date']));

                if (intval($total_demand) > 0 && $diff->days > 0) {
                    $avg_hours = (float) intval($total_demand) / ($diff->days + 1);
                } else if ($diff->days == 0) {
                    $avg_hours = $total_demand;
                } else if (intval($total_demand) == 0) {
                    $avg_hours = 0;
                }

                $i = 1;
                while ($startdate <= $enddate) {


                    if (isset($result[$key][date("Y-m-d", $startdate)]))
                        $result1[$key][date("Y-m-d", $startdate)] += $avg_hours;
                    else
                        $result1[$key][date("Y-m-d", $startdate)] = (float) $avg_hours;

                    $startdate = strtotime("+1 day", $startdate);
                    $i++;
                }
            } else {
                $result1[] = ['id' => $data['id']];

                $startdate = strtotime($data['start_date']);
                $enddate = strtotime($data['end_date']);
                $total_demand = $data['total_demand'];
                $diff = date_diff(date_create($data['end_date']), date_create($data['start_date']));

                if (intval($total_demand) > 0 && $diff->days > 0) {
                    $avg_hours = (float) intval($total_demand) / ($diff->days + 1);
                } else if ($diff->days == 0) {
                    $avg_hours = $total_demand;
                } else if (intval($total_demand) == 0) {
                    $avg_hours = 0;
                }
                $i = 1;
                while ($startdate <= $enddate) {

                    if (isset($result[$index][date("Y-m-d", $startdate)]))
                        $result1[$index][date("Y-m-d", $startdate)] += $avg_hours;
                    else
                        $result1[$index][date("Y-m-d", $startdate)] = (float) $avg_hours;

                    $startdate = strtotime("+1 day", $startdate);
                    $i++;
                }
            }
        }


        $days = '';
        for ($i = 1; $i <= 90; $i++) {
            $days .= ',sum(personassignment.day' . $i . ') as day' . $i;
        }
        //print_r($days);
        $datum = DB::table('project')
                ->where('project.company_id', Auth::user()->company_id)
                ->select(DB::raw('personassignment.start_date,personassignment.end_date,'
                                . 'project.id'
                                . $days))
                ->join('personassignment', 'personassignment.project_id', '=', 'project.id')
                ->groupBy('project.id', 'personassignment.start_date', 'personassignment.end_date')
                ->get()
                ->toArray();
        $datum = json_decode(json_encode($datum), true);


        $result = [];
        foreach ($datum as $index => $data) {

            if (in_array($data['id'], array_column($result, 'id'))) {
                $key = array_search($data['id'], array_column($result, 'id'));
                //print('found at :' . $key);
                //echo "\r\n";

                $startdate = strtotime($data['start_date']);
                $enddate = strtotime($data['end_date']);
                $i = 1;
                while ($startdate <= $enddate) {


                    if (isset($result[$key][date("Y-m-d", $startdate)]))
                        $result[$key][date("Y-m-d", $startdate)] += $data['day' . $i];
                    else
                        $result[$key][date("Y-m-d", $startdate)] = (int) $data['day' . $i];

                    $startdate = strtotime("+1 day", $startdate);
                    $i++;
                }
            } else {
                $result[] = ['id' => $data['id']];

                $startdate = strtotime($data['start_date']);
                $enddate = strtotime($data['end_date']);
                $i = 1;
                while ($startdate <= $enddate) {

                    if (isset($result[$index][date("Y-m-d", $startdate)]))
                        $result[$index][date("Y-m-d", $startdate)] += $data['day' . $i];
                    else
                        $result[$index][date("Y-m-d", $startdate)] = (int) $data['day' . $i];

                    $startdate = strtotime("+1 day", $startdate);
                    $i++;
                }
            }
        }

        //test data from local data
        $result = isset($result[0]) ? $result[0] : [];
        $key = array_search($result['id'], array_column($result1, 'id'));
        if ($key == 0) {
            if ($result1[$key]['id'] == $result['id'])
                $result1 = isset($result1[$key]) ? $result1[$key] : [];
            else
                $result1 = [];
        }
        else if ($key > 0) {
            $result1 = isset($result1[$key]) ? $result1[$key] : [];
        } else {
            $result1 = [];
        }
        $project_name = isset($result['id']) ? $result['id'] : '';
        return view('admin.resource_demand_assignement.index', compact('project_ids', 'from_date', 'to_date', 'project_name', 'result', 'result1'));
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
        $project_to = ($request->only('project_id')['project_id'] != '') ? $request->only('project_id')['project_id'] : 1;
        $days = '';
        for ($i = 1; $i <= 90; $i++) {
            $days .= ',sum(personassignment.day' . $i . ') as day' . $i;
        }
        $magnum = DB::table('project')
                ->where('project.company_id', Auth::user()->company_id)
                ->where('project.id', $project_to)
                ->select(DB::raw('tasks_subtask.start_date,tasks_subtask.end_date,'
                                . 'project.id,tasks_subtask.total_demand'))
                ->join('tasks_subtask', 'tasks_subtask.project_id', '=', 'project.project_Id')
                ->groupBy('project.id', 'tasks_subtask.start_date', 'tasks_subtask.end_date', 'tasks_subtask.total_demand')
                ->get()
                ->toArray();

        $magnum = json_decode(json_encode($magnum), true);
        $result1 = [];
        foreach ($magnum as $index => $data) {

            if (in_array($data['id'], array_column($result1, 'id'))) {
                $key = array_search($data['id'], array_column($result1, 'id'));
                //print('found at :' . $key);
                //echo "\r\n";

                $startdate = strtotime($data['start_date']);
                $enddate = strtotime($data['end_date']);
                $total_demand = $data['total_demand'];
                $diff = date_diff(date_create($data['end_date']), date_create($data['start_date']));

                if (intval($total_demand) > 0 && $diff->days > 0) {
                    $avg_hours = (float) intval($total_demand) / ($diff->days + 1);
                } else if ($diff->days == 0) {
                    $avg_hours = $total_demand;
                } else if (intval($total_demand) == 0) {
                    $avg_hours = 0;
                }

                $i = 1;
                while ($startdate <= $enddate) {


                    if (isset($result[$key][date("Y-m-d", $startdate)]))
                        $result1[$key][date("Y-m-d", $startdate)] += $avg_hours;
                    else
                        $result1[$key][date("Y-m-d", $startdate)] = (float) $avg_hours;

                    $startdate = strtotime("+1 day", $startdate);
                    $i++;
                }
            } else {
                $result1[] = ['id' => $data['id']];

                $startdate = strtotime($data['start_date']);
                $enddate = strtotime($data['end_date']);
                $total_demand = $data['total_demand'];
                $diff = date_diff(date_create($data['end_date']), date_create($data['start_date']));

                if (intval($total_demand) > 0 && $diff->days > 0) {
                    $avg_hours = (float) intval($total_demand) / ($diff->days + 1);
                } else if ($diff->days == 0) {
                    $avg_hours = $total_demand;
                } else if (intval($total_demand) == 0) {
                    $avg_hours = 0;
                }
                $i = 1;
                while ($startdate <= $enddate) {

                    if (isset($result[$index][date("Y-m-d", $startdate)]))
                        $result1[$index][date("Y-m-d", $startdate)] += $avg_hours;
                    else
                        $result1[$index][date("Y-m-d", $startdate)] = (float) $avg_hours;

                    $startdate = strtotime("+1 day", $startdate);
                    $i++;
                }
            }
        }



        //print_r($days);
        $datum = DB::table('project')
                ->where('project.company_id', Auth::user()->company_id)
                ->where('project.id', $project_to)
                ->select(DB::raw('personassignment.start_date,personassignment.end_date,'
                                . 'project.id'
                                . $days))
                ->join('personassignment', 'personassignment.project_id', '=', 'project.id')
                ->groupBy('project.id', 'personassignment.start_date', 'personassignment.end_date')
                ->get()
                ->toArray();


        //print_r($datum);
        $datum = json_decode(json_encode($datum), true);


        $result = [];
        foreach ($datum as $index => $data) {

            if (in_array($data['id'], array_column($result, 'id'))) {
                $key = array_search($data['id'], array_column($result, 'id'));
                //print('found at :' . $key);
                //echo "\r\n";

                $startdate = strtotime($data['start_date']);
                $enddate = strtotime($data['end_date']);
                $i = 1;
                while ($startdate <= $enddate) {


                    if (isset($result[$key][date("Y-m-d", $startdate)]))
                        $result[$key][date("Y-m-d", $startdate)] += $data['day' . $i];
                    else
                        $result[$key][date("Y-m-d", $startdate)] = (int) $data['day' . $i];

                    $startdate = strtotime("+1 day", $startdate);
                    $i++;
                }
            } else {
                $result[] = ['id' => $data['id']];

                $startdate = strtotime($data['start_date']);
                $enddate = strtotime($data['end_date']);
                $i = 1;
                while ($startdate <= $enddate) {

                    if (isset($result[$index][date("Y-m-d", $startdate)]))
                        $result[$index][date("Y-m-d", $startdate)] += $data['day' . $i];
                    else
                        $result[$index][date("Y-m-d", $startdate)] = (int) $data['day' . $i];

                    $startdate = strtotime("+1 day", $startdate);
                    $i++;
                }
            }
        }

        //test data from local data
        $result = isset($result[0]) ? $result[0] : [];
        $result1 = isset($result1[0]) ? $result1[0] : [];

        //$resource_name = isset($result['resource_name']) ? $result['resource_name'] : '';
        //$result = $result[2];
        //print_r(isset($result[0])?$result[0]:[]);die();
        return response()->json(['status' => 'ok', 'data' => $result, 'data1' => $result1]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return response()->json(['status' => 'ok', 'data' => $data]);
    }

}
