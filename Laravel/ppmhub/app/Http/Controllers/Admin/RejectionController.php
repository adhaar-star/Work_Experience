<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class RejectionController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $rejectionData = \App\reasonRejection::all();
        return view('admin.reason_rejection.view_reason_rejection', compact('rejectionData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.reason_rejection.add_reason_rejection');
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
            'reason_rejection.required' => 'Please enter reason for rejection',
        ];
        $validator = Validator::make($data, [
                    'reason_rejection' => 'required',
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/reasonRejection/create')->withErrors($validator)->withInput(Input::all());
        }
        \App\reasonRejection::create($data);
        session()->flash('flash_message', 'Reason for rejection created successfully...');
        return redirect('admin/reasonRejection');
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
        $reason = \App\reasonRejection::find($id);
        return view('admin.reason_rejection.add_reason_rejection', compact('reason'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = \App\reasonRejection::find($id);
        $dataInputs = Input::all();
        $validationmessages = [
            'reason_rejection.required' => 'Please enter reason for rejection',
        ];
        $validator = Validator::make($dataInputs, [
                    'reason_rejection' => 'required',
                        ], $validationmessages);
        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/reasonRejection/' . $id . '/edit')->withErrors($validator)->withInput(Input::all());
        }
        $dataInputs['updated_at'] = date("Y-m-d");
        $data->update($dataInputs);
        session()->flash('flash_message', 'Reason for rejection updated successfully...');
        return redirect('admin/reasonRejection');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $reason_id = \App\reasonRejection::find($id);
        $reason_id->delete($id);
        session()->flash('flash_message', 'Reason for rejection deleted successfully...');
        return redirect('admin/reasonRejection');
    }

}
