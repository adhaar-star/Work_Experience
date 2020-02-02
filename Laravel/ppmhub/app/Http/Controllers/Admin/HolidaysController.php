<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\public_holidays;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\country;
use App\state;
use Illuminate\Support\Facades\DB;

class HolidaysController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    $holidaysData = public_holidays::all();
    return view('admin.public_holidays.index', compact('holidaysData'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    //get country
    $country_alldata = country::all();
    foreach ($country_alldata as $country) {
      $country_data[$country->id] = $country->country_name;
    }
    return view('admin.public_holidays.create', compact('country_data'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $holiday_data = Input::all();
    $validationmessages = [
        'date.required' => 'Please select date',
        'name_holidays.required' => 'Please enter name of holiday',
        'weekend.required' => 'Please select weekend',
        'country.required' => 'Please select country',
        'state.required' => 'Please select state',
    ];
    $validator = Validator::make($holiday_data, [
          'date' => 'required',
          'name_holidays' => 'required',
          'weekend' => 'required',
          'country' => 'required',
          'state' => 'required',
        ], $validationmessages);
    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('admin/public_holidays/create')->withErrors($validator)->withInput(Input::all());
    }
    $holiday_data['company_id'] = Auth::user()->company_id;
    $holiday_data['created_at'] = date("Y-m-d");
    $holiday_data['created_by'] = Auth::User()->id;
    public_holidays::create($holiday_data);
    session()->flash('flash_message', 'Public holiday created successfully...');
    return redirect('admin/public_holidays');
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
    $holidaysData = public_holidays::find($id);
    //get country
    $country_alldata = country::all();
    foreach ($country_alldata as $country) {
      $country_data[$country->id] = $country->country_name;
    }
    $state_list = state::where('country_id',$holidaysData->country)
                        ->select('id','state_name')
                        ->pluck('state_name','id') ;
    
    return view('admin.public_holidays.create', compact('holidaysData','country_data','state_list'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    $holiday_data = public_holidays::find($id);
    $holidayInputs = Input::all();
    $validationmessages = [
        'date.required' => 'Please select date',
        'name_holidays.required' => 'Please enter name of holiday',
        'weekend.required' => 'Please select weekend',
        'country.required' => 'Please select country',
        'state.required' => 'Please select state',
    ];
    $validator = Validator::make($holidayInputs, [
          'date' => 'required',
          'name_holidays' => 'required',
          'weekend' => 'required',
          'country' => 'required',
          'state' => 'required',
        ], $validationmessages);
    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('admin/public_holidays/' . $id . '/edit')->withErrors($validator)->withInput(Input::all());
    }
    $holidayInputs['updated_at'] = date("Y-m-d");
    $holidayInputs['updated_by'] = Auth::User()->id;
    $holiday_data->update($holidayInputs);
    session()->flash('flash_message', 'Public holiday updated successfully...');
    return redirect('admin/public_holidays');
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

  public function getStateList(Request $request) {
    try {
      $countryCode = DB::table("country")
          ->where("id", $request->countryId)
          ->first()->id;

      $stateList = state::where("country_id", $countryCode)
        ->select('id', 'state_name')
        ->pluck('state_name', 'id');

      return response()->json(array('status' => true, 'results' => $stateList));
    } catch (\Exception $ex) {
      return response()->json(array('status' => false, 'message' => $ex->getMessage()));
    }
  }

}
