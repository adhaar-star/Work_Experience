<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\RangeNumber;
use App\Models\Master\Vendor;
use App\state;
use App\country;
use Illuminate\Http\Request;

use Session;
use Mail;
use Auth;
use DB;
use Validator;
use Exception;
use Yajra\DataTables\Facades\DataTables;


class RangesController extends Controller {
    
    protected $route = 'range-numbers';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.master.ranges.index');
    }


    public function edit(RangeNumber $rangeNumber) {

        return view('admin.master.ranges.create_update', [
            'rangeNumber' => $rangeNumber,
            'route' => $this->route
        ]);
    }

    public function update(RangeNumber $rangeNumber, Request $request) {
        $validator = Validator::make($request->input(),
            [
                'start' => 'required',
                'end' => 'required',
            ],
            [
                'start.required'  => 'Start is Required',
                'end.required'    => 'End is Required',
            ]
        );
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $data = $rangeNumber->update([
                    'start'          => $request->start,
                    'end'         => $request->end
                ]);
                if ($data)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Range Successfully Updated.',
                        'url' => route($this->route. '.index')
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
        $dataTable = RangeNumber::all();
        return DataTables::of($dataTable)

            ->addColumn('model', function ($data) {
                 $range = RangeNumber::rangeModels;
                 $range = array_flip($range);
                if(!empty($range) &&  isset($range[$data->model])){
                    return $range[$data->model];
                }else {
                    return $data->model;
                }

            })
             ->addColumn('action', function ($data) {
                return '<a  href="'. route( $this->route .'.edit',   $data->master_range_number_id) .'"  title="Edit"><i class="fa fa-edit"></i> Edit</a>';
            })->make(true);

    }

}
