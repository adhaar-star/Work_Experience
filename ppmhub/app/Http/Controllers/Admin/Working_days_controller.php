<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Project;
use App\country;
use App\state;
use App\public_holidays;

class Working_days_controller extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $country = country::select('country_name', 'id')->pluck('country_name', 'id');
        $state = state::select('state_name', 'id')->pluck('state_name', 'id');

        return view('admin.project_progress.project_working_days', compact('state', 'country'));
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


        $taskassignment = [];
        $taskassignment['country'] = $request->input('country');
        $taskassignment['state'] = $request->input('state');
        $taskassignment['start_date'] = $request->input('start_date');
        $taskassignment['end_date'] = $request->input('end_date');
        $dt_start_year = date('Y', strtotime($taskassignment['start_date']));
        $dt_start_month = date('m', strtotime($taskassignment['start_date']));
        $dt_end_year = date('Y', strtotime($taskassignment['end_date']));
        $dt_end_month = date('m', strtotime($taskassignment['end_date']));
        $public_holidays = 0;


        $country = country::select('country_name', 'id')->pluck('country_name', 'id');
        $state = state::where('country_id', $taskassignment['country'])
                ->select('state_name', 'id')
                ->pluck('state_name', 'id');

        $start_date = $request->input('start_date');
        $end_date = $request->input('end_date');

        if ($start_date > $end_date) {
            $msgs = ['start_date' => 'Start Date can`t be greater than End Date'];
            return redirect('admin/project_progress/working_days')->withErrors($msgs)->withInput(Input::all());
        }


        //(optional code)
        /** Iterate through years then  through month to get the number of public 
         * * holidays from the API.   
         */
        for (; $dt_start_year <= $dt_end_year; $dt_start_year++) {
            for (; $dt_start_month <= $dt_end_month; $dt_start_month++) {
                $temp = $this->get_holidays_api('test', 'US', $dt_start_year, $dt_start_month);
                //add day iteration to check which day is a public holiday
//                for($i=1;$i<=31;$i++)
//                {
//                    if()
//                }
                $public_holidays += count($temp['holidays']);
            }
        }

        $public_holiday = public_holidays::whereDate('date', '>=', date('Y-m-d', strtotime($taskassignment['start_date'])))
                ->whereDate('date', '<=', date('Y-m-d', strtotime($taskassignment['end_date'])))
                ->where('weekend', 0)
                ->where('country', $taskassignment['country'])
                ->Where('state', $taskassignment['state'])
                ->where('company_id', Auth::user()->company_id)
                ->count();

                $data = $this->get_planned_progress($taskassignment['start_date'], $taskassignment['end_date']);
                if ($public_holiday > 0) {
                    //set db based holiday count 
                    $data['public_holiday'] = $public_holiday;
                } else {   // set api based holiday count
                    $data['public_holiday'] = 0; //$public_holidays;
                }
                return view('admin.project_progress.project_working_days', compact('state', 'country', 'taskassignment', 'data'));
               
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function get_planned_progress($start_date, $end_date)
    {

        $now = strtotime($start_date);
        $end_date = strtotime($end_date);

        //validation
        if ($now == null || $end_date == null) {
            return ['progress' => 0, 'elapsed_days' => 0, 'elapsed_working_days' => 0, 'elapsed_weekends' => 0, 'project_duration' => 0, 'weekends' => 0, 'total' => 0];
        }


        $WE = 0; // weekends 
        $WD = 0; // working days 
        $total = 0; //total days working + off days 
        $ED = 0; //elapsed  days
        $EWE = 0; //elapsed weekends
        $EWD = 0; //elapsed working Days

        while ($now <= $end_date) {
            $total++;
            $day_index = date("w", $now);

            // for elapsed time
            if (date("Y-m-d", $now) <= date("Y-m-d", strtotime('now'))) {
                $ED++;
                if ($day_index == 0 || $day_index == 6) {
                    $EWE++;
                } else {
                    $EWD++;
                }
            }

            if ($day_index == 0 || $day_index == 6) {
                $WE++;
            } else {
                $WD++;
            }
            $now = strtotime(date("Y-m-d", $now) . "+1 day");
        }

        return ['progress' => floatval(($EWD / $WD) * 100), 'elapsed_days' => $ED, 'elapsed_working_days' => $EWD, 'elapsed_weekends' => $EWE, 'project_duration' => $WD, 'weekends' => $WE, 'total' => $total];
    }

    public function get_holidays_api($flag, $country, $year, $month)
    {
        $live_token = '129ac3bc-9245-4414-8707-a0a5fbc1fe57';
        $test_token = 'bf5d834a-c233-4fab-8fad-55f3eec19183';
        if ($flag == 'live') {
            $json = json_decode(file_get_contents('https://holidayapi.com/v1/holidays?public&key=' . $live_token .
                            '&country=' . $country . '&year=' . $year . '&month=' . $month), true);
            return $json;
        } else if ($flag == 'test') {

            $json = json_decode(file_get_contents('https://holidayapi.com/v1/holidays?public&key=' . $test_token .
                            '&country=' . $country . '&year=' . $year . '&month=' . $month), true);
            return $json;
        }
    }

}
