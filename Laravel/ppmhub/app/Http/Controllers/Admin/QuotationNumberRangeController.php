<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\quotationNumber;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class QuotationNumberRangeController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $quotationNumber_range = quotationNumber::all();
        return view('admin.quotation.createQuotationNumber', compact('quotationNumber_range'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
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
        $quotationNumber_range = quotationNumber::find($id);
        return view('admin.quotation.quotation_number', compact('quotationNumber_range'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = quotationNumber::where('company_id', Auth::user()->company_id)->find($id);
        $dataInputs = Input::all();
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
            return redirect('admin/quotationNumber_range/' . $id . '/edit')->withErrors($validator)->withInput(Input::all());
        }
        $data->update($dataInputs);
        session()->flash('flash_message', 'Quotation Number Range Updated Successfully...');
        return redirect('admin/quotationNumber_range');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

}
