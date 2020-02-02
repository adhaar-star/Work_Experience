<?php

namespace App\Http\Controllers\Admin\TimeSheet;

use App\Activity_rates;
use App\Activity_types;
use App\Assignrole;
use App\Http\Requests\StWorkRequest;
use App\Models\Projects\ProjectCost;
use App\Models\timeSheetWorks\StWork;
use App\Models\timeSheetWorks\StWorkTime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Redirect;
use Mockery\CountValidator\Exception;
use Validator;
use App\Employee_records;
use App\Timesheet_approver;
use App\Project;
use App\Projecttask;

use Auth;
use DB;
use Yajra\DataTables\Facades\DataTables;

class TimeSheetWorkController extends Controller {

    protected $request;
    public function __construct(Request $request) {
        $this->request = $request;
    }

    protected function sendStWorkMail($to, $subject, $messageData){

        \Mail::send( 'email.st_works.email_template', [ 'messageData' => $messageData ], function ($message) use ($to, $subject )
        {
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $message->to($to);
            $message->subject($subject);
        });
    }

    protected function calculateTotalMinute($time){
        if(!empty($time)){
            list($hours, $minutes) = explode(':', $time);
            $minutes += $hours * 60;
            return $minutes;
        }else{
            return 0;
        }
    }


    protected function sumTime($times){
        $all_seconds = 0;
        foreach ($times as $time) {
            list($hour, $minute, $second) = explode(':', $time);
            $all_seconds += $hour * 3600;
            $all_seconds += $minute * 60;
            $all_seconds += $second;
        }
        $total_minutes = floor($all_seconds/60);
        $seconds = $all_seconds % 60;
        $hours = floor($total_minutes / 60);
        $minutes = $total_minutes % 60;
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $seconds);
    }

    public function index() {
        $employees_data = null;
        $per_week_dates = null;
        $all_weeks = [];
        $from_date = null;
        $last_date = null;
        $all_weeks_project_data =[];

        $user = Auth::user();

        if ($user->role_id != config('app.role.CompanyAdministrator')) {
           $login_employee_data = Employee_records::ByCompany($user->company_id)->where('employee_user_id', $user->id)->first();
        } else {
            $employees_data = Employee_records::ByCompany($user->company_id)->orderBy('employee_first_name', 'asc')->get()->pluck( 'full_name', 'employee_id');
            $employee_id = isset($this->request->employee_id) ? $this->request->get('employee_id') : null ;
            if(!empty($employee_id)){
                $login_employee_data = Employee_records::ByCompany($user->company_id)->where('employee_id',$employee_id)->first();
            }else {
                $login_employee_data = Employee_records::ByCompany($user->company_id)->orderBy('employee_first_name', 'asc')->first();
            }
        }

        $current_date = isset($this->request->period_start) ? Carbon::parse($this->request->get('period_start'))->format('Y-m-d') : Carbon::now()->format('Y-m-d') ;
        $employee_profile_weeksnumber = isset($login_employee_data->timesheet_profile_name->time_sheet_number_days) ? $login_employee_data->timesheet_profile_name->time_sheet_number_days : null;
        $employee_id = $login_employee_data->employee_id;
        $login_approvers_data = Timesheet_approver::wheretime_sheet_user_id($employee_id)->first();

        if (!(empty($employee_id)) && !empty($employee_profile_weeksnumber)) {

            //Getting Weeks Of the year
            for ($wd = 0; $wd < $employee_profile_weeksnumber; $wd++) {
                $interval = '+' . $wd . ' week';
                $per_week_dates[] = date('Y-m-d', strtotime($interval, strtotime($current_date)));
            }


            $from_to_dates = array();
            foreach ($per_week_dates as $dat) {
                $dt = Carbon::parse($dat);

                $year = $dt->year;
                $week_number = $dt->weekOfYear;
                $weeknum_padded = sprintf("%02d", $week_number);

                $dt->setISODate($year, $weeknum_padded);

                $start_date = date('Y-m-d', strtotime($dt->startOfWeek()));
                $end_date = date('Y-m-d', strtotime($dt->endOfWeek()));

                $current = strtotime($start_date);
                $last = strtotime($end_date);
                $step = '+1 day';
                $output_format = 'Y-m-d';
                $all_dates = array();
                while ($current <= $last) {
                    $from_to_dates[] = date($output_format, $current);
                    $all_dates[] =   date($output_format, $current);
                    $current = strtotime($step, $current);
                }

                $all_weeks[$weeknum_padded] = $all_dates;
            }
            //END  Getting Weeks Of the year

            $from_date = $from_to_dates[0];
            $last_date = $from_to_dates[count($from_to_dates) - 1];

             if(!empty($all_weeks)){
                 foreach ($all_weeks as $key => $week){
                     $StWorks = StWork::ByCompany($user->company_id)->where('employee_id', $employee_id)->where('st_work_date', '>=' ,$week[0] )->where('st_work_date', '<=', end($week) )->get();
                     
                     $all_weeks_project_data[$key]  =  null;
                     if($StWorks->count()){
//                             Week
                         $week_project_data =[];
                         foreach ($StWorks as $stWork ){

//                               Day
                             $dayTimes = [];
                             foreach ($stWork->StWorkTimes as $stWorkTime ){

                                 if(array_key_exists($stWorkTime->project_id, $dayTimes )){
                                     $dayTimes[$stWorkTime->project_id] = $this->sumTime([$dayTimes[$stWorkTime->project_id], $stWorkTime->total_time]);
                                 }else{
                                     $dayTimes[$stWorkTime->project_id] = $stWorkTime->total_time;
                                 }

                             }
                             if(!empty($dayTimes)){

                                 foreach ($dayTimes as $project_id => $dayTime){
                                     if(array_key_exists($project_id, $week_project_data )){
                                         $week_project_data[$project_id][$stWork->st_work_date] = $dayTime;
                                     }else{
                                         $project = Project::find($project_id);
                                         $week_project_data[$project_id] = [
                                             $stWork->st_work_date => $dayTime,
                                             'project_name' => $project->project_name
                                         ];
                                     }
                                 }
                                 if(!empty($week_project_data)){
                                     $all_weeks_project_data[$key] = $week_project_data;
                                 }
                                 
                             }
                         }
                     }
                 }
             }
         }


        $totalWorkTimes = [];
        if (!empty($all_weeks_project_data)) {
            foreach ($all_weeks_project_data as $weekNumber => $item) {
                if ($item != null) {
                    foreach ($item as $dayTime) {
                        foreach ($dayTime as $day => $time) {
                            if ($day != 'project_name' ) {
                                if (array_key_exists($day, $totalWorkTimes)) {
                                    $totalWorkTimes[$day] = $this->sumTime([ $totalWorkTimes[$day] , $time]);
                                }else {
                                    $totalWorkTimes[$day] = $time;
                                }
                                if (array_key_exists($weekNumber, $totalWorkTimes)) {
                                    $totalWorkTimes[$weekNumber] = $this->sumTime([ $totalWorkTimes[$weekNumber] , $time]);
                                }else {
                                    $totalWorkTimes[$weekNumber]  = $time;
                                }
                            }
                        }
                    }
                }
            }
        }

        return view( 'admin/timesheet_work/timesheet_view',
            [
                'employee_id' => $employee_id,
                'employee_data' => $employees_data,
                'login_employee' => $login_employee_data,
                'current_date' =>   $current_date,

                'totalWorkTimes' => $totalWorkTimes,
                'all_weeks_project_data' => $all_weeks_project_data,

                'week_dates' => $all_weeks,
                'login_approvers_data' => $login_approvers_data,
                'from_date' => $from_date,
                'to_date' => $last_date,

            ]);
    }


    public function entry_form() {

        $user = Auth::user();
        $entry_date = $this->request->input('st_work_day');

        if ($user->role_id != config('app.role.CompanyAdministrator')) {
            $login_employee_data = Employee_records::ByCompany($user->company_id)->where('employee_user_id', $user->id)->first();
            $employee_id = $login_employee_data->employee_id;
        } else {
            $employee_id = $this->request->input('employee_id');
            $login_employee_data = Employee_records::find($employee_id);
        }

        if(!empty($employee_id)){

            $st_works = StWork::ByCompany($user->company_id)
                ->where('employee_id', $employee_id)
                ->where('st_work_date', $entry_date)
                ->first();

            if(!empty($this->request->copy_date)){

                $st_worksAlready = StWork::ByCompany($user->company_id)->where('employee_id', $employee_id)->where('st_work_date', $this->request->copy_date)->first();
                if(empty($st_worksAlready)){
                    $entry_date = $this->request->copy_date;
                }else{
                    $this->request->session()->flash('alert-danger', 'you already have timesheet at :' . $this->request->copy_date);
                    return Redirect::back();
                }
            }

            if(empty($st_works)){

                $projectList = Assignrole::where('resource_name', $employee_id)
                    ->pluck('project_id');

                $project_data = Project::Active()
                        ->whereIn('id', $projectList)
                        ->orderBy('project_Id', 'asc');

                $project_tasks = Projecttask::where('status', '!=', 'Completed')
                        ->whereIn('project_id', $project_data->pluck('project_Id'))
                        ->orderBy('task_Id', 'asc');

                return view('admin/timesheet_work/timesheet_entry',
                    [
                        'entry_date' => $entry_date,
                        'login_employee' => $login_employee_data,

                        'project_data' =>  $project_data->pluck('project_name', 'id'),
                        'project_tasksPluck' => $project_tasks->pluck('task_name', 'id'),
                        'project_tasks' => $project_tasks->get(),
                    ]
                );

            }else{


                return view('admin/timesheet_work/timesheet_entry',
                    [
                        'entry_date' => $entry_date,
                        'login_employee' => $login_employee_data,
                        'st_works' => $st_works

                    ]
                );

            }
        }else{
            $this->request->session()->flash('alert-danger', 'No employee Found!');
            return Redirect::back();
        }

    }


    public function timesheet_work_save(StWorkRequest $request) {

        $validator = Validator::make($request->input(),
            [ 'st_work_date' => 'required'],
            [ 'st_work_date.required'  => 'ST Work Date is Required' ]
        );
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $user = Auth::user();
                if(empty($request->st_work_id)):

                    if ($user->role_id != config('app.role.CompanyAdministrator')) {
                        $login_employee_data = Employee_records::ByCompany($user->company_id)->where('employee_user_id', $user->id)->first();
                        $employee_id = $login_employee_data->employee_id;
                    } else {
                        $employee_id = $request->employee_id;
                    }


                    $totalTimeDay = 0;
                    foreach ($request->st_works as $st_work_time){
                        $totalTimeDay +=  $this->calculateTotalMinute($st_work_time['total_time']);
                    }

                    if($totalTimeDay == 0){
                        throw new Exception('Please Enter Time.', 400);
                    }

                    $StWork = StWork::create([
                        'st_work_status' => $request->st_work_status,
                        'company_id' => $user->company_id,
                        'employee_id' => $employee_id,
                        'st_work_date' => $request->st_work_date
                    ]);
                    if (!empty($StWork))
                    {
                        $times =[];
                        foreach ($request->st_works as $st_work_time){
                            if(!empty($st_work_time['project_id']) && !empty($st_work_time['task_id'])  &&  !empty($st_work_time['total_time'])  ){
                                array_push($times, [
                                    'company_id' => $user->company_id,
                                    'st_work_id' => $StWork->st_work_id,

                                    'project_id' => $st_work_time['project_id'],
                                    'task_id'    => $st_work_time['task_id'],

                                    'total_time' => $st_work_time['total_time'],
                                    'total_minutes' => $this->calculateTotalMinute($st_work_time['total_time'])

                                ]);
                            }
                        }
                        if(!empty($times)){
                            StWorkTime::insert($times);
                        }

                        $approver = Timesheet_approver::where('time_sheet_user_id',  $employee_id )->first();
                        if(!empty($approver)){
                            $StWork->approver_id = $approver->time_sheet_approver_id;
                            $StWork->save();

                            if(!empty($approver->approvers->email_id)){

                                $link = route('timesheet.work.approvals.list');
                                $subject = "New Time Added for ".  $request->st_work_date;
                                $message = "<h3>A New TimeSheet Added</h3>";
                                $message .= "<a href='{$link}'>Approve Now</a>";
                                $this->sendStWorkMail($approver->approvers->email_id, $subject, $message);
                            }
                        }

                        DB::commit();
                        return response()->json([
                            'status' => 'success',
                            'message' => 'Time Sheet entry was successfully added.',
                            'url' => route( 'timesheet.work.create',
                            [
                                'employee_id' => $employee_id ,
                                'st_work_day' => $request->st_work_date,
                            ])
                        ]);
                    }else{
                        throw new Exception('Invalid StWork Information!', 400);
                    }

                else:

                    $StWork = StWork::ByCompany($user->company_id)
                        ->whereIn('st_work_status', ['pending', 'rejected'])
                        ->where('st_work_id', $request->st_work_id)
                        ->first();

                    if(!empty($StWork)){

                        foreach ($request->st_works as $st_work_time){
                            if(!empty($st_work_time['st_work_time_id'])  ){
                                $StWorkTime = StWorkTime::find($st_work_time['st_work_time_id']);
                                if(!empty($StWorkTime)){

                                    $StWorkTime->total_time =  $st_work_time['total_time'];
                                    $StWorkTime->total_minutes = $this->calculateTotalMinute($st_work_time['total_time']);
                                    $StWorkTime->save();

                                }
                            }
                        }

                        $approver = Timesheet_approver::where('time_sheet_user_id', $request->employee_id)->first();
                        if(!empty($approver)){

                            $StWork->approver_id = $approver->time_sheet_approver_id;
                            $StWork->st_work_status = 'pending';
                            $StWork->save();

                            if(!empty($approver->approvers->email_id)){
                                $link = route('timesheet.work.approvals.list');
                                $subject = "New Time Update for ".  $request->st_work_date;
                                $message = "<h3>TimeSheet update </h3>";
                                $message .= "<a href='{$link}'>Approve Now</a>";
                                $this->sendStWorkMail($approver->approvers->email_id, $subject, $message);
                            }
                        }else {
                            $StWork->st_work_status = 'pending';
                            $StWork->save();
                        }

                        DB::commit();
                        return response()->json([
                            'status' => 'success',
                            'message' => 'Timesheet entry was updated successfully',
                            'url' => 0
                        ]);
                    }else{
                        throw new Exception('No TimeSheet Found!', 400);
                    }
                endif;
            }catch (Exception $ex) {
                DB::rollBack();
                return response()->json([
                    'status' => 'error',
                    'message' => $ex->getMessage()
                ]);
            }
        }else{
            $errors = array_values($validator->errors()->getMessages());
            $message = null;
            foreach ($errors as $error){
                if(!empty($error)){
                    foreach ($error as $errorItem){
                        $message .=  $errorItem .' ';
                    }
                }
            }
            return response()->json([
                'status' => 'validation',
                'message' => ($message != null) ? $message :'Invalid Information!'
            ]);
        }
    }


    // Approvals
    public function approvals_list(Request $request) {
        $company_id = Auth::user()->company_id;
        $pending_timesheet = StWork::searchBy($request)->ByCompany(Auth::user()->company_id)->where('st_work_status', 'pending');
        return view('admin/timesheet_work/approvals_list',[
            'st_works' => StWork::searchBy($request)->ByCompany($company_id)->where('st_work_status', 'pending')->paginate(20),
            'pending_timesheet' => $pending_timesheet->count(),
            'pending_timesheet_times' => StWorkTime::whereIn('st_work_id', $pending_timesheet->pluck('st_work_id'))->sum('total_minutes'),
        ]);
    }


    // for approval timesheet single
    public function view($id) {


        return view('admin/timesheet_work/view',[
            'st_work' => StWork::ByCompany(Auth::user()->company_id)->find($id)
        ]);
    }

    protected function calculateProject($all_minutes , $rate ){
        $rate = $rate * 100;
        if($all_minutes > 0 && $rate > 0){

            $rateMinute = $rate / 60;
            $totalRate = $all_minutes * $rateMinute;
            return $totalRate / 100;
        }else{
            return 0;
        }

    }
    public function make_approved($id) {

        $st_work = StWork::ByCompany(Auth::user()->company_id)->find($id);
        $st_work->st_work_status = 'approved';
        $st_work->save();

        $subject = "Approved Time Sheet ".  $st_work->st_work_date;
        $message = "<h3 style='color: green;'>Congratulations, Your Time Sheet has Approved  </h3>";
        $message .= "<h6>Date: ". Carbon::parse($st_work->st_work_date)->format('d/m/Y')." </h6>";

        $employee =$st_work->employee;
        $this->sendStWorkMail($employee->email_id, $subject, $message);

        $activity_type = Activity_types::find($employee->employee_activity_type);
        $activity_rate = Activity_rates::where('activity_type_id', $activity_type->activity_id )->first();

        foreach ($st_work->StWorkTimes as $stWorkTime){
            ProjectCost::create([
                'project_id'        => $stWorkTime->project_id,
                'task_id'           => $stWorkTime->task_id,
                'total_time'        => $stWorkTime->total_time,
                'total_minutes'        => $stWorkTime->total_minutes,
                'st_work_id'        => $stWorkTime->st_work_id,

                'employee_id'       => $employee->employee_id,
                'activity_type_id'  => $employee->employee_activity_type,
                'activity_rate_id'  => (!empty($activity_rate)) ? $activity_rate->activity_rate_id : 0,
                'activity_rate'     =>  (!empty($activity_rate)) ? $activity_rate->activity_actual_rate : 0,
                'total_cost'        => (!empty($activity_rate)) ? $this->calculateProject($stWorkTime->total_minutes , $activity_rate->activity_actual_rate) : 00
            ]);
        }
        return redirect( route('timesheet.work.approvals.list'));
    }

    public function make_rejected($id) {

        $st_work = StWork::ByCompany(Auth::user()->company_id)->find($id);
        $st_work->st_work_status = 'rejected';
        $st_work->save();

        $subject = "Rejected Time Sheet ".  $st_work->st_work_date;
        $message = "<h3 style='color: red;'>Your Time Sheet was rejected  </h3>";
        $message .= "<h5>Date: ". Carbon::parse($st_work->st_work_date)->format('d/m/Y')." </h5>";

        $employee =$st_work->employee;
        $this->sendStWorkMail($employee->email_id, $subject, $message);

        return redirect( route('timesheet.work.approvals.list'));
    }


    public function timesheet_work_copy_week(Request $request) {
        try {
            DB::beginTransaction();
            $validator = Validator::make($request->input(),
                [
                    'week_status' => 'required',
                    'week_to_id' => 'required',
                    'week_from_id' => 'required',
                    'current_date' => 'required',
                ],
                [
                    'week_status.required' => 'Status is Required.',
                    'week_to_id.required' => 'Week To is Required.',
                    'week_from_id.required' => 'Week From is Required.',
                    'current_date.required' => 'current date is Required.',
                ]
            );

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            }else{

                $user = Auth::user();
                if ($user->role_id != config('app.role.CompanyAdministrator')) {
                    $login_employee_data = Employee_records::ByCompany($user->company_id)->where('employee_user_id', $user->id)->first();
                    $employee_id = $login_employee_data->employee_id;
                } else {
                    $employee_id = $this->request->input('employee_id');
                    $login_employee_data = Employee_records::ByCompany($user->company_id)->where('employee_id',$employee_id)->first();
                }
                $employee_profile_weeksnumber = isset($login_employee_data->timesheet_profile_name->time_sheet_number_days) ? $login_employee_data->timesheet_profile_name->time_sheet_number_days : null;

                for ($wd = 0; $wd < $employee_profile_weeksnumber; $wd++) {
                    $interval = '+' . $wd . ' week';
                    $per_week_dates[] = date('Y-m-d', strtotime($interval, strtotime($request->current_date)));
                }

                $all_weeks = array();
                $from_to_dates = array();
                foreach ($per_week_dates as $dat) {
                    $dt = Carbon::parse($dat);

                    $year = $dt->year;
                    $week_number = $dt->weekOfYear;
                    $weeknum_padded = sprintf("%02d", $week_number);

                    $dt->setISODate($year, $weeknum_padded);

                    $start_date = date('Y-m-d', strtotime($dt->startOfWeek()));
                    $end_date = date('Y-m-d', strtotime($dt->endOfWeek()));

                    $current = strtotime($start_date);
                    $last = strtotime($end_date);
                    $step = '+1 day';
                    $output_format = 'Y-m-d';
                    $all_dates = array();
                    while ($current <= $last) {
                        $from_to_dates[] = date($output_format, $current);
                        $all_dates[] =   date($output_format, $current);
                        $current = strtotime($step, $current);
                    }
                    $all_weeks[$weeknum_padded] = $all_dates;
                }


                if(!empty($all_weeks)){

                    $weekFrom = isset($all_weeks[$request->week_from_id]) ? $all_weeks[$request->week_from_id] : null;
                    if(!empty($weekFrom)){
                        $StWorks = StWork::ByCompany($user->company_id)->where('employee_id', $employee_id)->where('st_work_date', '>=' ,$weekFrom[0] )->where('st_work_date', '<=', end($weekFrom) )->count();
                        if($StWorks){

                            $weekTo = isset($all_weeks[$request->week_to_id]) ? $all_weeks[$request->week_to_id] : null;
                            if(!empty($weekTo)){
                                $StWorksTo = StWork::ByCompany($user->company_id)->where('employee_id', $employee_id)->where('st_work_date', '>=' ,$weekTo[0] )->where('st_work_date', '<=', end($weekTo) )->count();
                                if($StWorksTo){
                                    throw new Exception("You can't set new timesheet in Selected Week!", 400);
                                }else{
                                    $days ='';
                                    foreach ($weekFrom as $dayNumberOfWeek => $weekFromDay):
                                        $StWorkForm = StWork::ByCompany($user->company_id)->where('employee_id', $employee_id)->where('st_work_date',$weekFromDay)->first();

                                        if( !empty($StWorkForm) && isset($weekTo[$dayNumberOfWeek]) ){
                                            $days .= "{$weekTo[$dayNumberOfWeek]} ";
                                            $StWork = StWork::create([
                                                'employee_id' => $employee_id,
                                                'company_id' => $user->company_id,
                                                'st_work_status' => $request->week_status,
                                                'approver_id' => $StWorkForm->approver_id,
                                                'st_work_date' => $weekTo[$dayNumberOfWeek]
                                            ]);

                                            if (!empty($StWork))
                                            {
                                                $times =[];
                                                foreach ($StWorkForm->StWorkTimes as $st_work_time){

                                                        array_push($times, [
                                                            'company_id' => $user->company_id,
                                                            'st_work_id' => $StWork->st_work_id,
                                                            'project_id' => $st_work_time->project_id,
                                                            'task_id'    => $st_work_time->task_id,
                                                            'billable'    => $st_work_time->billable,

                                                            'start_time' => $st_work_time->start_time,
                                                            'end_time'   => $st_work_time->end_time,
                                                            'total_time' => $st_work_time->total_time,
                                                            'lunch_time' => $st_work_time->lunch_time,

                                                        ]);
                                                }
                                                if(!empty($times)){
                                                    StWorkTime::insert($times);
                                                }
                                            }
                                        }
                                    endforeach;

                                    DB::commit();
                                    $this->request->session()->flash('alert-success', 'Time Sheet entry was successfully copy!');
                                    if($request->week_status != 'draft'){
                                        $approver = Timesheet_approver::where('time_sheet_user_id', $employee_id)->first();
                                        if(!empty($approver)){
                                            if(!empty($approver->approvers->email_id)){
                                                $link = route('timesheet.work.approvals.list');
                                                $subject = "New Timesheet are  Added for ";
                                                $message = "<h3>A New TimeSheet Added</h3>";
                                                $message .= "<p>Days: </p>";
                                                $message .= "<a href='{$link}'>Approve Now</a>";
                                                $this->sendStWorkMail($approver->approvers->email_id, $subject, $message);
                                            }
                                        }
                                    }
                                    return redirect()->route('timesheet.work.list.dashboard',[
                                        'employee_id' => $request->employee_id,
                                        'period_start' => $request->current_date
                                    ]);

                                }

                            }else{
                                throw new Exception('Week To not found!', 400);
                            }
                        }else{
                            throw new Exception('No TimeSheet Found in Selected Week!', 400);
                        }
                    }else {
                        throw new Exception('No TimeSheet Found in Selected Week!', 400);
                    }
                }else {
                    throw new Exception('No TimeSheet Found in Selected Week!', 400);
                }
            }

        }catch (Exception $ex) {
            DB::rollBack();
            $this->request->session()->flash('alert-danger', $ex->getMessage());
            return Redirect::back();
        }

    }


// Cost
    public function costs(Request $request) {
        $count = ProjectCost::searchBy($request);
        return view('admin/timesheet_work/costs',[
            'costs' =>  ProjectCost::searchBy($request)->orderBy('project_cost_id', 'desc')->paginate(20),
            'total_minutes' =>  $count->sum('total_minutes'),
            'total_cost' =>  $count->sum('total_cost'),
        ]);
    }

}
