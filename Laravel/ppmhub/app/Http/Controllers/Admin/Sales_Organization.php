<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class Sales_Organization extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $salesorg = \App\sales_organization::all();
        return view('admin.sales_organization.view_sales_organization', compact('salesorg'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.sales_organization.add_sales_organization');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = Input::all();
        $data['company_id'] = Auth::user()->company_id;
        $data['created_at'] = date("Y-m-d");
        $validationmessages = [
            'sales_organization.required' => 'Please enter sales organization',
        ];
        $validator = Validator::make($data, [
                    'sales_organization' => 'required',
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/salesorganization/create')->withErrors($validator)->withInput(Input::all());
        }
        \App\sales_organization::create($data);
        session()->flash('flash_message', 'Sales organization created successfully...');
        return redirect('admin/salesorganization');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $salesorg = \App\sales_organization::find($id);
        return view('admin.sales_organization.add_sales_organization', compact('salesorg'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = \App\sales_organization::find($id);
        $dataInputs = Input::all();
        $validationmessages = [
            'sales_organization.required' => 'Please enter sales organization',
        ];
        $validator = Validator::make($dataInputs, [
                    'sales_organization' => 'required',
                        ], $validationmessages);
        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/salesorganization/' . $id . '/edit')->withErrors($validator)->withInput(Input::all());
        }
        $data->update($dataInputs);
        session()->flash('flash_message', 'Sales organization updated successfully...');
        return redirect('admin/salesorganization');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $salesorg_id = \App\sales_organization::find($id);
        $salesorg_id->delete($id);
        session()->flash('flash_message', 'Sales organization deleted successfully...');
        return redirect('admin/salesorganization');
    }

}
