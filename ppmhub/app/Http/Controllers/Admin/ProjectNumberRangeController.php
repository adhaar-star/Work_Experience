<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\ProjectNumberRange;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ProjectNumberRangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $number_range = ProjectNumberRange::all();
        return view('admin.project.project_number_range', compact('number_range'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $number_range = ProjectNumberRange::find($id)->first();

        return view('admin.project.edit_project_number', compact('number_range'));
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
        $projectRange = ProjectNumberRange::where('company_id', Auth::user()->company_id)->find($id);
        $post = Input::all();
        
        $validator = ProjectNumberRange::validateRange($post);

        if ($validator->fails()) {
            return redirect('admin/project_number_range/' . $id . '/edit')->withErrors($validator)->withInput(Input::all());
        }
        
        if (intval($post['start_range']) > intval($post['end_range']))
        {
            return redirect('admin/project_number_range/' . $id . '/edit')->withErrors(['start_range'=>'Start range can not be greater than End range'])->withInput(Input::all());
        }
        
        $projectRange->update($post);
        session()->flash('flash_message', 'Project Number Range Updated Successfully...');
        return redirect('admin/project_number_range');
    }
}
