<?php

namespace App\Http\Controllers\Admin\Setting;
use App\Activity_rates;
use App\Activity_types;
use App\Cost_centres;
use App\Employee_records;
use App\Http\Controllers\Controller;
use App\Models\Master\MaterialGroup;
use App\Models\Setting\ActivityRate;
use Illuminate\Http\Request;
use Session;
use Mail;
use Auth;
use DB;
use Validator;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class ActivityRatesController extends Controller {

    protected $route ='activity-rates';

    public function index(){
        return view('admin.setting.activity_rate.index');
    }


    public function create() {

        $company_id = Auth::user()->company_id;

        return view('admin.setting.activity_rate.create_update' ,
            [
                'route' => $this->route,
                'cost_centre'   => Cost_centres::byCompany($company_id)->pluck('cost_centre', 'cost_id'),
		        'activity_type' => Activity_types::byCompany($company_id)->pluck('activity_type', 'activity_id'),
        		'employee_data' => Employee_records::byCompany($company_id)->get()->pluck('full_name', 'employee_id')

            ]);
    }

    public function store(Request $request) {

        $validator = Validator::make($request->input(),
            [

                'activity_actual_rate' => 'required',
                'activity_plan_rate' => 'required',

                'activity_validity_start' => 'required',
                'activity_validity_end' => 'required',

            ],[

                'activity_actual_rate.required'  => 'Actual Rate is Required',
                'activity_plan_rate.required'    => 'Plan Rate Start is Required',

                'activity_validity_start.required'    => 'Validity Start is Required',
                'activity_validity_end.required'    => 'Validity End is Required',

            ]);

        if ($validator->passes()) {
            $user = Auth::user();
            try {

                DB::beginTransaction();
                $data = ActivityRate::create([
                    'company_id'    => $user->company_id,
                    'activity_type_id'   => $request->activity_type_id,
                    'cost_centre_id'   => $request->cost_centre_id,
                    'employee_id'   => $request->employee_id,

                    'activity_rate_description'   => $request->activity_rate_description,

                    'activity_actual_rate'   => $request->activity_actual_rate,
                    'activity_plan_rate'   => $request->activity_plan_rate,
                    'billing_rate'   => $request->billing_rate,


                    'activity_validity_start'   => $request->activity_validity_start,
                    'activity_validity_end'   => $request->activity_validity_end,
                    'status'   => $request->status,
                ]);
                if ($data)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Activity Rate Created.',
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

    public function edit(ActivityRate $activityRate) {
        $company_id = Auth::user()->company_id;
        return view('admin.setting.activity_rate.create_update', [
            'data' => $activityRate,
            'route' => $this->route,

            'cost_centre'   => Cost_centres::byCompany($company_id)->pluck('cost_centre', 'cost_id'),
            'activity_type' => Activity_types::byCompany($company_id)->pluck('activity_type', 'activity_id'),
            'employee_data' => Employee_records::byCompany($company_id)->get()->pluck('full_name', 'employee_id')

        ]);
    }

    public function update(ActivityRate $activityRate, Request $request) {
        $validator = Validator::make($request->input(),
            [

                'activity_actual_rate' => 'required',
                'activity_plan_rate' => 'required',

                'activity_validity_start' => 'required',
                'activity_validity_end' => 'required',

            ],[

                'activity_actual_rate.required'  => 'Actual Rate is Required',
                'activity_plan_rate.required'    => 'Plan Rate Start is Required',

                'activity_validity_start.required'    => 'Validity Start is Required',
                'activity_validity_end.required'    => 'Validity End is Required',

            ]);

        if ($validator->passes()) {
            try {
                DB::beginTransaction();

                $data = $activityRate->update([
                    'activity_type_id'   => $request->activity_type_id,
                    'cost_centre_id'   => $request->cost_centre_id,
                    'employee_id'   => $request->employee_id,

                    'activity_rate_description'   => $request->activity_rate_description,

                    'activity_actual_rate'   => $request->activity_actual_rate,
                    'activity_plan_rate'   => $request->activity_plan_rate,
                    'billing_rate'   => $request->billing_rate,

                    'activity_validity_start'   => $request->activity_validity_start,
                    'activity_validity_end'   => $request->activity_validity_end,
                    'status'   => $request->status,
                ]);

                if ($data)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Activity Rate Successfully Updated.',
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
        $dataTable = ActivityRate::all();
        return DataTables::of($dataTable)
            ->addColumn('action', function ($data) {
                return '<a  href="'. route($this->route .'.edit',   $data->activity_rate_id) .'"  title="Edit"><i class="fa fa-edit"></i> Edit</a>';
            })->make(true);
    }

}
