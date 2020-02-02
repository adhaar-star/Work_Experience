<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
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


class VendorsController extends Controller {
    
    protected $route = 'vendor';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.master.vendors.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $max_number = Vendor::max('vendor_no');
        return view('admin.master.vendors.create_update', [
            'countries' => country::pluck('country_name', 'id'),
            'VendorID' =>  $this->getRangeNumber($max_number, 'vendor', Auth::user()->company_id),
            'route' => $this->route,
        ]);
    }


    public function store(Request $request) {
        $validator = Validator::make($request->input(),
            [
                'vendor_no' => 'required',
                'name' => 'required',
                'email' => 'required',
                'office_phone' => 'required',
                'postal_code' => 'required',
                'street' => 'required',
                'city' => 'required',
                'country' => 'required',
                'state' => 'required',

            ],
            [
                'vendor_no.required'  => 'Vendor No. is Required',
                'name.required'  => 'Customer Name is Required',
                'email.required'  => 'Email is Required',
                'office_phone.required'  => 'Office Phone is Required',
                'postal_code.required'  => 'Postal Code is Required',
                'street.required'  => 'Street Address is Required',
                'country.required'  => 'Country is Required',
                'state.required'  => 'State is Required',

            ]
        );
        if ($validator->passes()) {
            $user = Auth::user();
            try {
                $max_number = Vendor::max('vendor_no');
                $no = $this->getRangeNumber($max_number, 'vendor', $user->company_id);
                if(!$no){
                    throw new Exception('Invalid Information!', 400);
                }

                DB::beginTransaction();
                $data = Vendor::create([

                    'company_id'    => $user->company_id,
                    'vendor_no'     => $no,
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'office_phone'  => $request->office_phone,
                    'fax'           => $request->fax,
                    'website_address'  => $request->website_address,
                    'postal_code'   => $request->postal_code,
                    'city'          => $request->city,
                    'street'        => $request->street,
                    'country'       => $request->country,
                    'state'         => $request->state

                ]);
                if ($data)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Vendor Successfully Created.',
                        'url' => route( $this->route .'.index' )
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

    public function edit(Vendor $vendor) {
        if(!empty($vendor)){
            $state = state::where("country_id", $vendor->country)->pluck('state_name', 'state_name');
        }
        return view('admin.master.vendors.create_update', [
            'countries' => country::pluck('country_name', 'id'),
            'vendor' => $vendor,
            'state' => !empty( $state) ?  $state : [],
            'route' => $this->route
        ]);
    }

    public function update(Vendor $vendor, Request $request) {
        $validator = Validator::make($request->input(),
            [
                'vendor_no' => 'required',
                'name' => 'required',
                'email' => 'required',
                'office_phone' => 'required',
                'postal_code' => 'required',
                'street' => 'required',
                'city' => 'required',
                'country' => 'required',
                'state' => 'required',

            ],
            [
                'vendor_no.required'  => 'Vendor No. is Required',
                'name.required'  => 'Customer Name is Required',
                'email.required'  => 'Email is Required',
                'office_phone.required'  => 'Office Phone is Required',
                'postal_code.required'  => 'Postal Code is Required',
                'street.required'  => 'Street Address is Required',
                'country.required'  => 'Country is Required',
                'state.required'  => 'State is Required',

            ]
        );
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $data = $vendor->update([
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'office_phone'  => $request->office_phone,
                    'fax'           => $request->fax,
                    'website_address'  => $request->website_address,
                    'postal_code'   => $request->postal_code,
                    'city'          => $request->city,
                    'street'        => $request->street,
                    'country'       => $request->country,
                    'state'         => $request->state,
                ]);
                if ($data)
                {
                    DB::commit();
                    return response()->json([
                        'status' => 'success',
                        'message' => 'Vendor Successfully Updated.',
                        'url' => 0
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
        $dataTable = Vendor::all();
        return DataTables::of($dataTable)
            ->addColumn('action', function ($data) {
                return '<a  href="'. route( $this->route .'.edit',   $data->vendor_id) .'"  title="Edit"><i class="fa fa-edit"></i> Edit</a>';
            })->make(true);
    }

}
