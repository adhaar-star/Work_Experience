<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\Models\Master\MaterialCategory;
use Illuminate\Http\Request;

use Session;
use Mail;
use Auth;
use DB;
use Validator;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class MaterialCategoriesController extends Controller {

    protected $route ='material-category';

    public function index(){
        return view('admin.master.material_category.index');
    }


    public function create() {
        return view('admin.master.material_category.create_update',[ 'route' => $this->route]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->input(),
            [
                'name' => 'required'
            ],
            [
                'name.required'  => 'Name is Required'
            ]
        );
        if ($validator->passes()) {
            $user = Auth::user();
            try {
                DB::beginTransaction();
                $data = MaterialCategory::create([
                    'company_id'    => $user->company_id,
                    'name'          => $request->name,
                    'status'         => $request->status
                ]);
                if ($data)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Category Successfully Created.',
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

    public function edit(MaterialCategory $materialCategory) {
        return view('admin.master.material_category.create_update', [
            'materialCategory' => $materialCategory,
            'route' => $this->route,
        ]);
    }

    public function update(MaterialCategory $materialCategory, Request $request) {
        $validator = Validator::make($request->input(),
            [
                'name' => 'required'
            ],
            [
                'name.required'  => 'Name is Required'
            ]
        );
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $data = $materialCategory->update([
                    'name'          => $request->name,
                    'status'         => $request->status
                ]);
                if ($data)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Category Successfully Updated.',
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
        $dataTable = MaterialCategory::all();
        return DataTables::of($dataTable)
            ->addColumn('action', function ($data) {
                return '<a  href="'. route($this->route .'.edit',   $data->material_category_id) .'"  title="Edit"><i class="fa fa-edit"></i> Edit</a>';
            })->make(true);
    }

}
