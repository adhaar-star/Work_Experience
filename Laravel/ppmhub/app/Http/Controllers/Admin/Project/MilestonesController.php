<?php

namespace App\Http\Controllers\Admin\Project;

use App\Http\Controllers\Controller;
use App\Models\Projects\ProjectMilestone;
use App\Project;
use App\Projectphase;
use App\TasksSubtask;
use Illuminate\Http\Request;

use Session;
use Mail;
use Auth;
use DB;
use Validator;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class MilestonesController extends Controller {

    protected $route ='milestone';

    public function index(){

        return view('admin.projects.milestone.index');
    }


    public function create() {
        $company_id = Auth::user()->company_id;
        $max_number = ProjectMilestone::max('milestone_no');

        return view('admin.projects.milestone.create_update', [ 'route' => $this->route,
            'projects' => Project::ByCompany($company_id)->get()->pluck( 'full_info', 'id'),
            'milestone_no' => $this->getRangeNumber($max_number, 'milestone', $company_id),
        ]);
    }
    public function store(Request $request) {
        $validator = Validator::make($request->input(),
            [
                'milestone_name' => 'required',
                'milestone_type' => 'required',
                'project_id' => 'required',
                'phase_id' => 'required',
            ],
            [
                'milestone_name.required'  => 'Name is Required',
                'milestone_type.required'  => 'Type is Required',
                'project_id.required'  => 'Project is Required',
                'phase_id.required'  => 'Phase is Required',

            ]
        );
        if ($validator->passes()) {


            $user = Auth::user();
            try {

                if($request->milestone_type == 'billing' && empty($request->billing_plan) ){
                    throw new Exception('Billing Plan Is Required', 400);
                }

                if($request->milestone_type == 'progress' && empty($request->progress) ){
                    throw new Exception('Progress Is Required', 400);
                }

                DB::beginTransaction();



                $max_number = ProjectMilestone::max('milestone_no');
                $inputDate = $request->except('_token');
                $inputDate['company_id'] = $user->company_id;
                $inputDate['milestone_no'] = $this->getRangeNumber($max_number, 'milestone', $user->company_id);
                $data = ProjectMilestone::create($inputDate);
                if ($data)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Milestone Successfully Created.',
                        'url' => route( $this->route .'.index')
                    ]);
                }else{
                    throw new Exception('Invalid Information!', 400);
                }
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

    public function edit(ProjectMilestone $projectMilestone) {
        $user = Auth::user();
        $project = Project::ByCompany()->find($projectMilestone->project_id);
        if(!empty($project)){
            $tasks = TasksSubtask::where('project_id', $project->project_Id)->pluck('task_name', 'id');
            $phase = Projectphase::where('project_id', $project->id)->pluck('phase_name', 'id');

        }
        return view('admin.projects.milestone.create_update', [
            'data' => $projectMilestone,
            'route' => $this->route,
            'projects' => Project::ByCompany($user->company_id)->get()->pluck( 'full_info', 'id'),

            'updateTasks' => $tasks,
            'updatePhases' => $phase
        ]);
    }

    public function update(ProjectMilestone $projectMilestone, Request $request) {
        $validator = Validator::make($request->input(),
            [
                'milestone_name' => 'required',
                'milestone_type' => 'required',
                'project_id' => 'required',
                'phase_id' => 'required',
            ],
            [
                'milestone_name.required'  => 'Name is Required',
                'milestone_type.required'  => 'Type is Required',
                'project_id.required'  => 'Project is Required',
                'phase_id.required'  => 'Phase is Required',

            ]
        );
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $data = $projectMilestone->update($request->except('_token'));
                if ($data)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Milestone Successfully Updated.',
                        'url' =>0
                    ]);
                }else{
                    throw new Exception('Invalid Information!', 400);
                }

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

    public function data_table(){
        $dataTable = ProjectMilestone::all();
        return DataTables::of($dataTable)
            ->addColumn('project', function ($data) {
              return  $data->project->project_Id;
            })
            ->addColumn('full_info', function ($data) {
              return  preg_replace('/\s+/', ' ',$data->milestone_no.' '.$data->milestone_name);
            })
            ->addColumn('action', function ($data) {
                return '<a  href="'. route($this->route .'.edit',   $data->project_milestone_id) .'"  title="Edit"><i class="fa fa-edit"></i> Edit</a>';
            })

            ->make(true);
    }

}
