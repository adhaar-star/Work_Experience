<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\view;

class ViewController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $viewData = DB::table('view')->get();
        return view('admin.View.view', compact('viewData'));
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
        $view_edit = view::find($id);
        return view('admin.View.viewName', compact('view_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = view::where('company_id', Auth::user()->company_id)->find($id);
        $dataInputs = Input::all();

        $validationmessages = [
            'view_name.required' => 'Please enter view name.',
        ];

        $validator = Validator::make($dataInputs, [
                    'view_name' => 'required',
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/view/' . $id . '/edit')->withErrors($validator)->withInput(Input::all());
        }
        $data->update($dataInputs);
        session()->flash('flash_message', 'ViewName Updated Successfully...');
        return redirect('admin/view');
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
