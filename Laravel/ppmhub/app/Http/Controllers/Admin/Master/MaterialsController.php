<?php

namespace App\Http\Controllers\Admin\Master;

use App\Currency;
use App\Http\Controllers\Controller;
use App\Models\Master\Material;
use App\Models\Master\MaterialCategory;
use App\Models\Master\MaterialGroup;
use App\Models\Master\OrderUnit;
use App\Models\Master\UnitOfMeasure;
use App\Models\Master\Vendor;
use Illuminate\Http\Request;

use Session;
use Mail;
use Auth;
use DB;
use Validator;
use Exception;
use Yajra\DataTables\Facades\DataTables;

class MaterialsController extends Controller {

    protected $route ='material';

    public function index(){
        return view('admin.master.material.index');
    }



    public function create() {

        $user = Auth::user();
        $max_number = Material::max('material_no');
        return view('admin.master.material.create_update',[
            'route' => $this->route,
            'material_no' => $this->getRangeNumber($max_number, 'material', $user->company_id),
            'material_categories' => MaterialCategory::ByCompany($user->company_id)->Active()->orderBy('name')->pluck('name', 'material_category_id'),
            'material_groups' => MaterialGroup::ByCompany($user->company_id)->Active()->orderBy('name')->pluck('name', 'material_group_id'),
            'ordering_unit' => OrderUnit::ByCompany($user->company_id)->Active()->orderBy('name')->pluck('name', 'order_unit_id'),
            'unit_of_measure' => UnitOfMeasure::ByCompany($user->company_id)->Active()->orderBy('name')->pluck('name', 'unit_of_measure_id'),
            'vendors' => Vendor::ByCompany($user->company_id)->Active()->orderBy('vendor_no')->get()->pluck('full_info', 'vendor_id'),
            'currencies' => Currency::pluck('short_code', 'id'),

        ]);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->input(),
            [
                'material_no'   => 'required',
                'name'          => 'required',
                'description'   => 'required',
                'price'         => 'required',

                'material_category_id' => 'required',
                'material_group_id' => 'required',
                'order_unit_id' => 'required',
                'unit_of_measure_id' => 'required',
                'vendor_id' => 'required',
                'currency_id' => 'required',
            ],
            [
                'material_no.required'  => 'Material No is Required',
                'name.required'  => 'Name is Required',
                'description.required'  => 'Description is Required',
                'price.required'  => 'Price is Required',

                'material_category_id.required'  => 'Material Category is Required',
                'material_group_id.required'  => 'Material Group is Required',
                'order_unit_id.required'  => 'Order Unit is Required',
                'unit_of_measure_id.required'  => 'Unit Of Measure is Required',
                'vendor_id.required'  => 'Vendor is Required',
                'currency_id.required'  => 'Currency is Required',
            ]
        );
        if ($validator->passes()) {
            $user = Auth::user();
            try {

                $max_number = Material::max('material_no');
                $no = $this->getRangeNumber($max_number, 'material', $user->company_id);
                if(!$no){
                    throw new Exception('Invalid Information!', 400);
                }

                DB::beginTransaction();
                $data = Material::create([
                    'company_id'    => $user->company_id,
                    'material_no'   => $no,
                    'name'          => $request->name,
                    'description'   => $request->description,
                    'price'   => $request->price,

                    'material_category_id'   => $request->material_category_id,
                    'material_group_id'   => $request->material_group_id,
                    'order_unit_id'   => $request->order_unit_id,
                    'unit_of_measure_id'   => $request->unit_of_measure_id,
                    'vendor_id'   => $request->vendor_id,
                    'currency_id'   => $request->currency_id,

                    'stock_item'   => $request->stock_item,
                    'min_stock'   => $request->min_stock,
                    'reorder_quantity'   => $request->reorder_quantity,
                    'ean_upc_no'   => $request->ean_upc_no,
                    'tax_classification'   => $request->tax_classification,
                    'gross_weight'   => $request->gross_weight,
                    'net_weight'   => $request->net_weight,
                    'expiry_date'   => $request->expiry_date,
                    'status'         => $request->status
                ]);

                if ($data)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Material Successfully Created.',
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

    public function edit(Material $material) {
        $user = Auth::user();
        return view('admin.master.material.create_update', [
            'material' => $material,
            'route' => $this->route,
            'material_categories' => MaterialCategory::ByCompany($user->company_id)->Active()->orderBy('name')->pluck('name', 'material_category_id'),
            'material_groups' => MaterialGroup::ByCompany($user->company_id)->Active()->orderBy('name')->pluck('name', 'material_group_id'),
            'ordering_unit' => OrderUnit::ByCompany($user->company_id)->Active()->orderBy('name')->pluck('name', 'order_unit_id'),
            'unit_of_measure' => UnitOfMeasure::ByCompany($user->company_id)->Active()->orderBy('name')->pluck('name', 'unit_of_measure_id'),
            'vendors' => Vendor::ByCompany($user->company_id)->Active()->orderBy('vendor_no')->get()->pluck('full_info', 'vendor_id'),
            'currencies' => Currency::pluck('short_code', 'id'),
        ]);
    }

    public function update(Material $material, Request $request) {
        
        
        
        $validator = Validator::make($request->input(),
            [
                'material_no'   => 'required',
                'name'          => 'required',
                'description'   => 'required',
                'price'         => 'required',

                'material_category_id' => 'required',
                'material_group_id' => 'required',
                'order_unit_id' => 'required',
                'unit_of_measure_id' => 'required',
                'vendor_id' => 'required',
                'currency_id' => 'required',
            ],
            [
                'material_no.required'  => 'Material No is Required',
                'name.required'  => 'Name is Required',
                'description.required'  => 'Description is Required',
                'price.required'  => 'Price is Required',

                'material_category_id.required'  => 'Material Category is Required',
                'material_group_id.required'  => 'Material Group is Required',
                'order_unit_id.required'  => 'Order Unit is Required',
                'unit_of_measure_id.required'  => 'Unit Of Measure is Required',
                'vendor_id.required'  => 'Vendor is Required',
                'currency_id.required'  => 'Currency is Required',
            ]
        );
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $data = $material->update([

                    'name'          => $request->name,
                    'description'   => $request->description,
                    'price'   => $request->price,

                    'material_category_id'   => $request->material_category_id,
                    'material_group_id'   => $request->material_group_id,
                    'order_unit_id'   => $request->order_unit_id,
                    'unit_of_measure_id'   => $request->unit_of_measure_id,
                    'vendor_id'   => $request->vendor_id,
                    'currency_id'   => $request->currency_id,

                    'stock_item'   => $request->stock_item,
                    'min_stock'   => $request->min_stock,
                    'reorder_quantity'   => $request->reorder_quantity,
                    'ean_upc_no'   => $request->ean_upc_no,
                    'tax_classification'   => $request->tax_classification,
                    'gross_weight'   => $request->gross_weight,
                    'net_weight'   => $request->net_weight,
                    'expiry_date'   => $request->expiry_date,
                    'status'         => $request->status


                ]);
                if ($data)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Material Successfully Updated.',
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
        $dataTable = Material::all();
        return DataTables::of($dataTable)

            ->editColumn('material_group_id', function ($data) {
                return $data->group->name;
            })

            ->editColumn('material_category_id', function ($data) {
                return $data->category->name;
            })

            ->editColumn('vendor_id', function ($data) {
                return $data->vendor->name;
            })

            ->addColumn('action', function ($data) {
                return '<a  href="'. route($this->route .'.edit',   $data->material_id) .'"  title="Edit"><i class="fa fa-edit"></i> Edit</a>';
            })->make(true);


    }

}
