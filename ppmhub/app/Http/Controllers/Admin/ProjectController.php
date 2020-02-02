<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Portfolio;
use App\Project;
use App\Portfoliotype;
use App\Buckets;
use App\Projecttype;
use App\location;
use App\Currency;
use App\Personresponsible;
use App\Factorycalendar;
use App\Costcentretype;
use App\Departmenttype;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Projecttask;
use App\User;
use App\Roleauth;
use App\Projectphase;
use App\project_material_cost;
use App\project_miscellanous_cost;
use App\project_hardware_cost;
use App\project_software_cost;
use App\project_travel_cost;
use App\project_contingency_cost;
use App\project_facilities_cost;
use App\project_service_cost;
use App\project_internal_cost;
use App\project_external_cost;
use App\Employee_records;
use App\public_holidays;
use App\ProjectNumberRange;
use App\Cost_centres;
use App\Helpers\ProjectHelpers;
use App\Helpers\PlanFeatureAccessHelper;

class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($projectId = null)
    {
        $project = Project::where('company_id', Auth::user()->company_id)->with('projectType')->with('portfolioId')->with('portfolioType')->with('bucketId')->with('locationId')->with('costCentre')->with('departmentType')->with('user')->get();
        $portId = null;
        if ($projectId != null) {
            $proj = Project::where('company_id', Auth::user()->company_id)->find($projectId);
            if ($proj)
                $portId = $proj->portfolio_id;
        }
        return view('admin.project.index', compact('project', 'projectId', 'portId'));
    }

    public function dashboard()
    {
        return view('admin.project.dashboard');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $portfolio = DB::table('portfolio')
                        ->where('company_id', Auth::user()->company_id)->get();

        //Find the max project id
        $projectPrefixId = Project::Max('project_Id')->OrderBy('project_id', 'DESC')->limit(1)->first();

        //If found generate next id
        $dbId = 0;
        if ($projectPrefixId) {
            $dbId = substr($projectPrefixId->project_Id, 1);
            if ($projectPrefixId->project_Id[0] != 'P' && strlen($projectPrefixId->project_Id)) {
                $prjId = 'P00001';
                $dbId = 0;
            } else {
                $prjId = 'P' . str_pad( ++$dbId, 5, '0', STR_PAD_LEFT);
            }
        } else {//Create first id
            $prjId = 'P00001';
        }

        $ptype = array();
        foreach ($portfolio as $project) {
            $ptype[$project->id] = $project->port_id . ' ( ' . $project->description . ' )';
        }

        $projectType = Projecttype::where('company_id', Auth::user()->company_id)->pluck("name", "id")->prepend('Please select project type', '');
        $location = Location::where('company_id', Auth::user()->company_id)->pluck("subrub", "id")->prepend('Please select', '');
        $currency = Currency::where('company_id', Auth::user()->company_id)->pluck("fullname", "short_code")->prepend('Please select', '');
        $personresponsible = Employee_records::select('employee_id', DB::raw('CONCAT(employee_id, " ( ",employee_first_name, " ", employee_middle_name, " ",employee_last_name, " )") AS emp_full_name'))
                ->where('company_id', Auth::user()->company_id)
                ->orderBy('employee_id')
                ->pluck('emp_full_name', 'employee_id');
        $factorycalendar = Factorycalendar::where('company_id', Auth::user()->company_id)->pluck("name", "id")->prepend('Please select', '');
        $cost_centre = Costcentretype::where('company_id', Auth::user()->company_id)->pluck("name", "id")->prepend('Please select', '');
        $department = Departmenttype::where('company_id', Auth::user()->company_id)->pluck("name", "id")->prepend('Please select', '');
        $category = \App\category::where('company_id', Auth::user()->company_id)->pluck("category_name", "id");

        $port = array();
        $temp = Portfoliotype::where('company_id', Auth::user()->company_id)->pluck('name', 'id');
        foreach ($temp as $key => $value) {
            $port[$key] = $value;
        }
        //Check whether project number range is over or not. if exceed show error message
        $projectNumberRange = ProjectNumberRange::first();

        if ($dbId > $projectNumberRange->end_range) {
            session()->flash('limit_exceed', 'Project number range limit is exceed, please increase it.');
        }
        return view('admin.project.create', compact('category', 'prjId', 'port', 'ptype', 'buckets', 'projectType', 'location', 'currency', 'personresponsible', 'factorycalendar', 'cost_centre', 'department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         if(!PlanFeatureAccessHelper::canCreateProject()){
           $request->session()->flash('limit_exceed', 'Your project creation limit is over as per current plan please ugrade the plan to create more projects. <a href="/admin/subscriptions/updateSubscription">Go to Update</a>');
           return redirect('admin/project/create')->withInput(Input::all());
         } 
        $projectNumberRange = ProjectNumberRange::first();
        $projectPrefixId = Project::Max('project_Id')->OrderBy('project_id', 'DESC')->limit(1)->first();
        $dbId = 0;
        if ($projectPrefixId)
            $dbId = substr($projectPrefixId->project_Id, 1);

        if ($dbId > $projectNumberRange->end_range) {
            session()->flash('limit_exceed', 'Project number range limit is exceed, please increase it.');
            return redirect('admin/project/create')->withInput(Input::all());
        }

        Roleauth::check('project.create');

        $data_get = $request->all();

        $validationmessages = [
            'project_id.required' => 'please select project id',
            'project_type.required' => 'Please select project type',
            'project_desc.required' => 'Please enter description less than 191 character',
            'bucket_id.required' => 'Please select bucket id',
            'start_date.required' => 'Please select start date',
            'portfolio_id.required' => 'Please select portfolio',
            'project_name.required' => 'Please enter project name'
        ];

        $validator = Validator::make($data_get, [
                    'project_Id' => 'required',
                    'project_type' => 'required',
                    'project_desc' => 'required | max:191',
                    'bucket_id' => 'required',
                    'start_date' => 'required',
                    'portfolio_id' => 'required',
                    'project_name' => 'required'
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/project/create')->withErrors($validator)->withInput(Input::all());
        }

        Project::create([
            'project_Id' => $request->input('project_Id'),
            'project_name' => $request->input('project_name'),
            'project_type' => $request->input('project_type'),
            'project_desc' => $request->input('project_desc'),
            'portfolio_id' => $request->input('portfolio_id'),
            'portfolio_type' => $request->input('portfolio_type'),
            'bucket_id' => $request->input('bucket_id'),
            'start_date' => $request->input('start_date'),
            'created_by' => Auth::id(),
            'status' => $request->input('status'),
            'company_id' => Auth::user()->company_id
        ]);

        session()->flash('flash_message', 'Project created successfully...');
        return redirect('admin/project');
    }

    public function getportname(Request $request)
    {

        $portname = DB::table('portfolio')->select('name')->where('id', $request->port_id)->where('company_id', Auth::user()->company_id)->first();


        return response()->json($portname);
    }

    public function getbucketname(Request $request)
    {

        $name = DB::table('buckets')->select('name')->where('id', $request->bucket_id)->where('company_id', Auth::user()->company_id)->first();


        return response()->json($name);
    }

    public function getpdesc(Request $request)
    {
        $desc = DB::table('portfolio')->select('description')->where('id', $request->port_id)->where('company_id', Auth::user()->company_id)->first();

        return response()->json($desc);
    }

    public function getbdesc(Request $request)
    {
        $desc = DB::table('buckets')->select('description')->where('id', $request->bucket_id)->where('company_id', Auth::user()->company_id)->first();
        return response()->json($desc);
    }

    public function getportfolioType($portId)
    {
        $portfolio_type = DB::table('portfolio')->select('portfolio_type.name')
                ->leftJoin('portfolio_type', 'portfolio.type', '=', 'portfolio_type.id')
                ->where('portfolio.id', $portId)
                ->where('portfolio.company_id', Auth::user()->company_id)
                ->first();
        return response()->json($portfolio_type);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function get_planned_progress($project_id)
    {

        $project = Project::where('company_id', Auth::user()->company_id)->find($project_id);
        if (!isset($project)) {
            return redirect('admin/project');
        }

        $now = strtotime($project->start_date);
        $end_date = strtotime($project->end_date);

        //validation
        if ($now == null || $end_date == null) {
            return ['progress' => 0, 'elapsed_days' => 0, 'elapsed_working_days' => 0, 'elapsed_weekends' => 0, 'project_duration' => 0, 'weekends' => 0, 'total' => 0];
        }

        // public holidays between project duration
        $public_holiday = public_holidays::whereDate('date', '>=', date('Y-m-d', $now))
                ->whereDate('date', '<=', date('Y-m-d', $end_date))
                ->where('weekend', 0)
                ->where('company_id', Auth::user()->company_id)
                ->count();

        // public holidays between elapsed date range 
        $EPH = public_holidays::whereDate('date', '>=', date('Y-m-d', $now))
                ->whereDate('date', '<=', date('Y-m-d'))
                ->where('weekend', 0)
                ->where('company_id', Auth::user()->company_id)
                ->count();

        $WE = 0; // weekends 
        $WD = 0; // working days 
        $total = 0; //total days working + off days 
        $ED = 0; //elapsed  days
        $EWE = 0; //elapsed weekends
        $EWD = 0; //elapsed working Days

        while ($now <= $end_date) {
            $total++;
            $day_index = date("w", $now);

            //elapsed days & elapesed working days & elapsed weekends
            if (date("Y-m-d", $now) <= date("Y-m-d", strtotime('now'))) {
                $ED++;

                if ($day_index == 0 || $day_index == 6) {
                    $EWE++;
                } else {
                    $EWD++;
                }
            }

            //can't be added to above condition as this condition will run for whole iteration
            if ($day_index == 0 || $day_index == 6) {
                $WE++;
            } else {
                $WD++;
            }

            $now = strtotime(date("Y-m-d", $now) . "+1 day");
        }

        //avoid division by zero 
        $WD = ($WD > 0) ? $WD : 1;
        return ['progress' => abs(floatval((($EWD - $EPH)) / $WD * 100)), 'elapsed_public_holidays' => $EPH, 'elapsed_days' => $ED, 'elapsed_working_days' => $EWD, 'elapsed_weekends' => $EWE, 'project_duration' => $WD, 'weekends' => $WE, 'public_holidays' => $public_holiday, 'total' => $total];
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $project = Project::where('company_id', Auth::user()->company_id)->find($id);
        if (!isset($project)) {
            return redirect('admin/project');
        }
        /**
         * Get project planned cost from cost planing modules
         */
        $projectid = $project->project_Id;
        $portfolioId = $project->portfolio_id;

        //get lower most buckets
        $buckets = Buckets::where('company_id', Auth::user()->company_id)->with('children_rec')->where('portfolio_id', $portfolioId)->where('parent_bucket', 0)->get()->toArray();
        $loweMostBucketsArray = array();
        $lower_bucket = array();
        $loweMostBucketsArray = Buckets::recursiveBucket($loweMostBucketsArray, $buckets);
        foreach ($loweMostBucketsArray as $key => $value) {
            $lower_bucket[$value['id']] = $value['name'];
        }

        $Net_Total = ProjectHelpers::get_project_planned_cost($projectid);
        $planned_cost = $Net_Total;
        /* End of Planned cost */

        /* Actual progress 
         * Actual progress %: (Actual costs/Planned costs) *100
         * get actual cost 
         */

        $actual_cost = ProjectHelpers::get_actual_cost_project($id);
        if ($planned_cost != 0)
            $actual_progress = ($actual_cost / $planned_cost) * 100;
        else
            $actual_progress = 'NA';
        /* End of Actual progress */


        /** progress calculation manual 
         *  formula => sum((weight% * completion%)/100 ) 
         */
        $phy_progress = 0;
        $tasks = Projecttask::where('project_id', $projectid)->where('company_id', Auth::user()->company_id)->get()->toArray();

        $count = 0;
        foreach ($tasks as $key => $task) {
            $phy_progress += ((($task['weighting_factor']) * ($task['completion'])) / 100);
            $count++;
        }

        if ($count > 0) {
            $phy_progress = $phy_progress / $count;
        }

        /* progress calculation cost proportional
         * formula => sum(( Task actual cost / task planned cost ) *100 )  */
        $cost_prop_progress = 0;
        foreach ($tasks as $key => $task) {
            if ($task['planned_cost'] != 0) {
                $cost_prop_progress += ((($task['actual_cost']) / ($task['planned_cost'])) * 100);
            }
        }
        if ($count > 0) {
            $cost_prop_progress = $cost_prop_progress / $count;
        }

        $createdby = $project->created_by != '' ? User::where('company_id', Auth::user()->company_id)->where('id', $project->created_by)->first()['original']['name'] : '';
        $modifiedby = $project->modified_by != '' ? User::where('company_id', Auth::user()->company_id)->where('id', $project->modified_by)->first()['original']['name'] : '';

        $currency = Currency::where('company_id', Auth::user()->company_id)->pluck("short_code", "id")->prepend('Please select', '');

        $projectType = Projecttype::where('company_id', Auth::user()->company_id)->pluck("name", "id")->prepend('Please select', '');
        $location = Location::where('company_id', Auth::user()->company_id)->pluck("subrub", "id")->prepend('Please select', '');
        $personresponsible = Employee_records::select('employee_id', DB::raw('CONCAT(employee_id, " ( ",employee_first_name, " ", employee_middle_name, " ",employee_last_name, " )") AS emp_full_name'))
                ->where('company_id', Auth::user()->company_id)
                ->orderBy('employee_id')
                ->pluck('emp_full_name', 'employee_id');
        $factorycalendar = Factorycalendar::where('company_id', Auth::user()->company_id)->pluck("name", "id")->prepend('Please select', '');
        $cost_centre = Cost_centres::where('company_id', Auth::user()->company_id)->pluck("cost_centre", "cost_id")->prepend('Please select', '');
        $department = Departmenttype::where('company_id', Auth::user()->company_id)->pluck("name", "id")->prepend('Please select', '');
        $category = \App\category::pluck("category_name", "id");

        $portfolio = DB::table('portfolio')
                        ->where('company_id', Auth::user()->company_id)->get();

        $ptype = array();
        foreach ($portfolio as $port) {
            $ptype[$port->id] = $port->port_id . ' ( ' . $port->description . ' )';
        }

        $port = array();
        $temp = Portfoliotype::where('company_id', Auth::user()->company_id)->pluck('name', 'id');
        foreach ($temp as $key => $value) {
            $port[$key] = $value;
        }
        $planned_progress = ProjectHelpers::get_planned_progress($project->start_date, $project->end_date);
        $planned_progress['progress'] = number_format((float) $planned_progress['progress'], 2, '.', '');

        return view('admin.project.create', compact('lower_bucket', 'category', 'actual_progress', 'planned_progress', 'cost_prop_progress', 'phy_progress', 'Net_Total', 'modifiedby', 'createdby', 'port', 'project', 'ptype', 'buckets', 'projectType', 'currency', 'location', 'personresponsible', 'factorycalendar', 'cost_centre', 'department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::where('company_id', Auth::user()->company_id)->find($id);
        if (!isset($project)) {
            return redirect('admin/project');
        }

        $data_get = $request->only($project->getEditable());

        $start_date = strtotime($data_get['start_date']);
        $end_date = strtotime($data_get['end_date']);
        if ($start_date > $end_date) {
            $msgs = ['start_date' => 'Start Date can`t be greater than End Date'];
            return redirect('admin/project/' . $id . '/edit')->withErrors($msgs)->withInput(Input::all());
        }

        $validationmessages = [
            'project_id.required' => 'please select project id',
            'project_type.required' => 'Please select project type',
            'project_desc.required' => 'Please enter description less than 191 character',
            'bucket_id.required' => 'Please select bucket id',
            'start_date.required' => 'Please select start date',
            'end_date' => 'Please select end date',
            'a_start_date' => 'Please select actual start date',
            'a_end_date' => 'Please select actual end date',
            'f_start_date' => 'Please select forecast start date',
            'f_end_date' => 'Please select forecast end date',
            'p_start_date' => 'Please select planned start date',
            'p_end_date' => 'Please select planned finish date',
            'sch_date' => 'Please select schedule date',
            'project_type' => 'Please select project type',
            'bucket_id' => 'Please select bucket id',
            'estimated_cost' => 'Please enter estimated cost',
            'location_id' => 'Please select project location',
            'cost_centre' => 'Please select cost centre',
            'department' => 'Please select department'
        ];

        $validator = Validator::make($data_get, [
                    'project_Id' => 'required',
                    'project_type' => 'required',
                    'project_desc' => 'required | max:191',
                    'bucket_id' => 'required',
                    'start_date' => 'required',
                    'end_date' => 'required',
                    'a_start_date' => 'required',
                    'a_end_date' => 'required',
                    'f_start_date' => 'required',
                    'f_end_date' => 'required',
                    'p_start_date' => 'required',
                    'p_end_date' => 'required',
                    'sch_date' => 'required',
                    'project_type' => 'required',
                    'bucket_id' => 'required',
                    'estimated_cost' => 'required',
                    'location_id' => 'required',
                    'cost_centre' => 'required',
                    'department' => 'required',
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/project/' . $id . '/edit')->withErrors($validator)->withInput(Input::all());
        }

        $project->update([
            'project_name' => $request->input('project_name'),
            'project_type' => $request->input('project_type'),
            'project_desc' => $request->input('project_desc'),
            'portfolio_id' => $request->input('portfolio_id'),
            'portfolio_type' => $request->input('portfolio_type'),
            'bucket_id' => $request->input('bucket_id'),
            'location_id' => $request->input('location_id'),
            'cost_centre' => $request->input('cost_centre'),
            'department' => $request->input('department'),
            'start_date' => $request->input('start_date'),
            'end_date' => $request->input('end_date'),
            'a_start_date' => $request->input('a_start_date'),
            'a_end_date' => $request->input('a_end_date'),
            'f_start_date' => $request->input('f_start_date'),
            'f_end_date' => $request->input('f_end_date'),
            'sch_date' => $request->input('sch_date'),
            'p_start_date' => $request->input('p_start_date'),
            'p_end_date' => $request->input('p_end_date'),
            'person_responsible' => $request->input('person_responsible'),
            'factory_calendar' => $request->input('factory_calendar'),
            'estimated_cost' => $request->input('estimated_cost'),
            'physical_progress' => $request->input('physical_progress'),
            'cost_progress' => $request->input('cost_progress'),
            'currency' => $request->input('currency'),
            'modified_by' => Auth::id(),
            'status' => $request->input('status'),
            'project_commentary' => $request->input('project_commentary'),
            'category' => $request->input('category'),
            'scope' => $request->input('scope'),
            'quality' => $request->input('quality'),
        ]);
        session()->flash('flash_message', 'Project updated successfully...');
        return redirect('admin/project');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::where('company_id', Auth::user()->company_id)->find($id);
        if (!isset($project)) {
            return redirect('admin/project');
        }

        $phase = Projectphase::select('id')->where('project_id', $id)->pluck('id', 'id')->toArray();
        if (count($phase) > 0) {
            session()->flash('flash_message', "Phase exits for project can't deleted...");
            return redirect('admin/project');
        } else {
            $project->delete();
            session()->flash('flash_message', 'Project deleted successfully...');
            return redirect('admin/project');
        }
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

    //get lower most bucket
    public function getlowerbuckets($portfolioId)
    {
        $buckets = Buckets::where('company_id', Auth::user()->company_id)->with('children_rec')->where('portfolio_id', $portfolioId)->where('parent_bucket', 0)->get()->toArray();
        $loweMostBucketsArray = array();
        $loweMostBucketsArray = Buckets::recursiveBucket($loweMostBucketsArray, $buckets);
        return response()->json(['status' => true, 'data' => $loweMostBucketsArray]);
    }

}
