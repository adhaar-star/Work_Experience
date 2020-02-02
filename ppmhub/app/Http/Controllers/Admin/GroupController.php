<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\group;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $groupData = DB::table('group')->get();
       return view('admin.Group.group', compact('groupData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $group_edit = group::find($id);
        return view('admin.Group.groupName', compact('group_edit'));
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
        $data = group::where('company_id', Auth::user()->company_id)->find($id);
        $dataInputs = Input::all();

        $validationmessages = [
            'group_name.required' => 'Please enter group name.',
        ];

        $validator = Validator::make($dataInputs, [
                    'group_name' => 'required',
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/group/' . $id . '/edit')->withErrors($validator)->withInput(Input::all());
        }
        $data->update($dataInputs);
        session()->flash('flash_message', 'GroupName Updated Successfully...');
        return redirect('admin/group');
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
