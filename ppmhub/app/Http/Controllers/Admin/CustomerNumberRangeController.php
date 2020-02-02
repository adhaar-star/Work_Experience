<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\customer_number_range;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class CustomerNumberRangeController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $number_range = customer_number_range::all();
        return view('admin.customermaster.create_customer_number', compact('number_range'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
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
        $number_range = customer_number_range::find($id)->first();

        return view('admin.customermaster.customer_number', compact('number_range'));
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
        $data = customer_number_range::where('company_id', Auth::user()->company_id)->find($id);
        $dataInputs = Input::all();
        
        
        if (intval($dataInputs['start_range']) > intval($dataInputs['end_range']))
        {
            return redirect('admin/customer_number_range/' . $id . '/edit')->withErrors(['start_range'=>'Start range can not be greater than End range'])->withInput(Input::all());
        }
            $validationmessages = [
                'start_range.numeric' => 'The start range must be a number.',
                'start_range.required' => 'Please enter start range.',
                'end_range.required' => 'Please enter end range.',
                'end_range.numeric' => 'The end range must be a number.',
            ];

        $validator = Validator::make($dataInputs, [
                    'start_range' => 'required|numeric',
                    'end_range' => 'required|numeric',
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/customer_number_range/' . $id . '/edit')->withErrors($validator)->withInput(Input::all());
        }
        $data->update($dataInputs);
        session()->flash('flash_message', 'Customer Number Range Updated Successfully...');
        return redirect('admin/customer_number_range');
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

}
