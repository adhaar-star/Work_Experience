<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\category;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $categoryData = DB::table('category')->get();
        return view('admin.Category.category', compact('categoryData'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('admin.Category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $dataInputs = Input::all();

        $validationmessages = [
            'category_name.required' => 'Please enter category name.',
        ];

        $validator = Validator::make($dataInputs, [
                    'category_name' => 'required',
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/category/create')->withErrors($validator)->withInput(Input::all());
        }
        $dataInputs['company_id'] = 0;
        category::create($dataInputs);
        session()->flash('flash_message', 'Category Created Successfully...');
        return redirect('admin/category');
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
        $category_edit = category::find($id);
        return view('admin.Category.categoryName', compact('category_edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $data = category::where('company_id', Auth::user()->company_id)->find($id);
        $dataInputs = Input::all();

        $validationmessages = [
            'category_name.required' => 'Please enter category name.',
        ];

        $validator = Validator::make($dataInputs, [
                    'category_name' => 'required',
                        ], $validationmessages);

        if ($validator->fails()) {
            $msgs = $validator->messages();
            return redirect('admin/category/' . $id . '/edit')->withErrors($validator)->withInput(Input::all());
        }
        $data->update($dataInputs);
        session()->flash('flash_message', 'Category Updated Successfully...');
        return redirect('admin/category');
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
