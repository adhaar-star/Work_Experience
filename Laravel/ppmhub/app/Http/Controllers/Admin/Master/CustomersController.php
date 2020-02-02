<?php

namespace App\Http\Controllers\Admin\Master;

use App\Http\Controllers\Controller;
use App\state;
use Illuminate\Http\Request;

use App\country;
use App\Models\Master\Customer;

use Session;
use Mail;
use Auth;
use DB;
use Validator;
use Exception;
use Yajra\DataTables\Facades\DataTables;


class CustomersController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('admin.master.customers.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        $max_number = Customer::max('customer_no');
        return view('admin.master.customers.create_update', [
            'countries' => country::pluck('country_name', 'id'),
            'CustomerID' => $this->getRangeNumber($max_number, 'vendor', Auth::user()->company_id),
        ]);
    }


    public function store(Request $request) {
        $validator = Validator::make($request->input(),
            [
                'customer_no' => 'required',
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
                'customer_no.required'  => 'Customer No. is Required',
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
                $max_number = Customer::max('customer_no');
                $no = $this->getRangeNumber($max_number, 'customer', $user->company_id);
                if(!$no){
                    throw new Exception('Invalid Information!', 400);
                }

                DB::beginTransaction();
                $data = Customer::create([
                    'company_id'    => $user->company_id,
                    'customer_no'   => $no,
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'office_phone'  => $request->office_phone,
                    'fax'  => $request->fax,
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
                        'message' => 'Customer Successfully Created.',
                        'url' => route('customer.index')
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

    public function edit(Customer $customer) {
        if(!empty($customer)){
            $state = state::where("country_id", $customer->country)->pluck('state_name', 'state_name');
        }
        return view('admin.master.customers.create_update', [
            'countries' => country::pluck('country_name', 'id'),
            'customer' => $customer,
            'state' => !empty( $state) ?  $state : []
        ]);
    }

    public function update(Customer $customer, Request $request) {
        $validator = Validator::make($request->input(),
            [
                'name' => 'required',
                'email' => 'required',
                'office_phone' => 'required',
                'postal_code' => 'required',
                'street' => 'required',
                'city' => 'required',
                'country' => 'required',
                'state' => 'required'
            ],
            [
                'name.required'  => 'Customer Name is Required',
                'email.required'  => 'Email is Required',
                'office_phone.required'  => 'Office Phone is Required',
                'postal_code.required'  => 'Postal Code is Required',
                'street.required'  => 'Street Address is Required',
                'country.required'  => 'Country is Required',
                'state.required'  => 'State is Required'
            ]
        );
        if ($validator->passes()) {
            try {
                DB::beginTransaction();
                $data = $customer->update([
                    'name'          => $request->name,
                    'email'         => $request->email,
                    'office_phone'  => $request->office_phone,

                    'fax'  => $request->fax,
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
                        'message' => 'Customer Successfully Updated.',
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
        $dataTable = Customer::all();
        return DataTables::of($dataTable)
            ->addColumn('action', function ($data) {
                return '<a  href="'. route('customer.edit',   $data->customer_id) .'"  title="Edit"><i class="fa fa-edit"></i> Edit</a>';
            })->make(true);
    }

}
