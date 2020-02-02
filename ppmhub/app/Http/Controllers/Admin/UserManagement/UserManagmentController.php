<?php

namespace App\Http\Controllers\Admin\UserManagement;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\Mail\UserVerification;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\register;
use App\Helpers\RoleAuthHelper;

class UserManagmentController extends Controller {

  protected function sendUserVerifyMail($userDetails) {
    Mail::to($userDetails->email)->send(new UserVerification($userDetails));

    if (count(Mail::failures()) > 0) {

      echo "There was one or more failures. They were: <br />";

      foreach (Mail::failures as $email_address) {
        echo " - $email_address <br />";
      }
    } else {
      echo "No errors, all sent successfully!";
    }
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {

    return view('admin.user_management.view');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    $roles = DB::table("roles_masters")->where('company_id', Auth::user()->company_id)
      ->select('id', 'role_name')
      ->pluck('role_name', 'id');
    return view('admin.user_management.create', compact('roles'));
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {
    $data = Input::all();

    $validationmessages = [
        'name.required' => 'Please enter first name',
        'name.regex' => 'Please enter only letters',
        'lname.required' => 'Please enter last name',
        'lname.regex' => 'Please enter only letters',
        'email.required' => 'Please enter email',
        'email.unique' => 'This email already used, please enter another',
        'phone.required' => 'Please enter phone',
        'role_id.required' => 'Please select role',
    ];

    $validator = Validator::make($data, [
          'name' => 'required|regex:/^[a-zA-Z]+$/i',
          'lname' => 'required|regex:/^[a-zA-Z]+$/i',
          'email' => 'required|email|unique:users',
          'phone' => 'required',
          'role_id' => 'required'
        ], $validationmessages);

    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('admin/user-managment/create')->withErrors($validator)->withInput(Input::all());
    }
    $data['password'] = crypt('123', '');
    $data['status'] = 'pending';
    $data['verify_code'] = '123';
    $data['remember_token'] = md5(uniqid($data['email'], true));
    $data['company_id'] = Auth::user()->company_id;
    $userDetails = register::create($data);

    // send mail to new user 
    // $dump = Mail::to()->send(new UserVerification($userDetails));
    $this->sendUserVerifyMail($userDetails);

    session()->flash('flash_message', 'User created successfully and Invitation link sent!');
    return redirect('admin/user-managment');
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
    $user_data = register::find($id);
    $roles = DB::table("roles_masters")->where('company_id', Auth::user()->company_id)
      ->select('id', 'role_name')
      ->pluck('role_name', 'id');
    return view('admin.user_management.create', compact('user_data', 'roles'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, $id) {
    $data = register::find($id);
    $dataInputs = Input::all();
    $validationmessages = [
        'name.required' => 'Please enter first name',
        'name.regex' => 'Please enter only letters',
        'lname.required' => 'Please enter last name',
        'lname.regex' => 'Please enter only letters',
        'email.required' => 'Please enter email',
        'phone.required' => 'Please enter phone',
        'role_id.required' => 'Please select role',
    ];
    $validator = Validator::make($dataInputs, [
          'name' => 'required|regex:/^[a-zA-Z]+$/i',
          'lname' => 'required|regex:/^[a-zA-Z]+$/i',
          'email' => 'required|email',
          'phone' => 'required',
          'role_id' => 'required'
        ], $validationmessages);
    if ($validator->fails()) {
      $msgs = $validator->messages();
      return redirect('admin/user-management/' . $id . '/edit')->withErrors($validator)->withInput(Input::all());
    }
    $data->update($dataInputs);
    session()->flash('flash_message', 'User updated successfully...');
    return redirect('admin/user-managment');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id) {
    $user_id = register::find($id);
    $user_id->delete($id);
    session()->flash('flash_message', 'User deleted successfully...');
    return redirect('admin/user-managment');
  }

  public function data_table() {
    $dataTable = register::where('company_id', Auth::user()->company_id)->with('roles_master')->get();
    return DataTables::of($dataTable)
        ->addColumn('action', function ($data) {
          $actionButton = (RoleAuthHelper::hasAccess('user-management.update') != true) ? '<a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;"><i class="fa fa-edit"></i> ' : '<a  href="' . route('user-management.update', $data->id . '/edit') . '"  title="Edit" class="btn btn-info btn-xs margin-right-1"><i class="fa fa-edit"></i> </a>';
          $actionButton .= (RoleAuthHelper::hasAccess('user-management.update') != true) ? '<a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;"><i class="fa fa-trash"></i> ' : '<a  href="javascript:void(0)" class="btn btn-danger btn-xs margin-right-1" title="Delete" onclick="var res = confirm(`Are you sure you want to delete this gl account`);if (res) { $(`#delform`).attr(`action`,`' . route('user-management.delete', $data->id) . '`);document.getElementById(`delform`).submit()}'
            . '"><i class="fa fa-trash"></i> </a>';
          return $actionButton;
        })->make(true);
  }

}
