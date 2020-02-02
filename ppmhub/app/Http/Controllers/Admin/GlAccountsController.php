<?php

namespace App\Http\Controllers\Admin;

use App\GlAccount;
use App\GlAccountFlagType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;
use Exception;
use Yajra\DataTables\Facades\DataTables;
use App\Helpers\RoleAuthHelper;

class GlAccountsController extends Controller {

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    return view('admin.gl_accounts.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create() {
    return view('admin.gl_accounts.create_update', [
        'GlAccountFlagType' => GlAccountFlagType::byCompany()
    ]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request) {

    if ($request->hasFile('gl_account_csv')) {
      $upload = $request->file('gl_account_csv');
      $filePath = $upload->getRealPath();
      $file = fopen($filePath, 'r');

      $allData = [];
      $company_id = Auth::user()->company_id;
      while ($columns = fgetcsv($file)) {
        if (!empty($columns[0]) && !empty($columns[1]) && !empty($columns[2]) && !empty($columns[3]) && !empty($columns[5])) {

          array_push($allData, [
              'company_id' => $company_id,
              'number' => (!empty($columns[0])) ? $columns[0] : 'NA',
              'gl_account_element_type' => (!empty($columns[1])) ? $columns[1] : 'NA',
              'gl_account_type' => (!empty($columns[2])) ? $columns[2] : 'NA',
              'gl_account_tax' => (!empty($columns[3])) ? $columns[3] : 'NA',
              'description' => (!empty($columns[4])) ? $columns[4] : 'NA',
              'type_flag' => (!empty($columns[5])) ? $columns[5] : 'NA',
          ]);
        }
      }
      if (!empty($allData)) {
        GlAccount::insert($allData);
        $request->session()->flash('alert-success', 'GL accounts was updated successfully!');
        return Redirect::back();
      } else {
        $request->session()->flash('alert-danger', 'Invalid CSV');
        return Redirect::back();
      }
    }
    $validator = Validator::make($request->input(), [
          'number' => 'required',
          'description' => 'required',
          'gl_account_type' => 'required',
          'gl_account_element_type' => 'required',
          'gl_account_tax' => 'required',
          'type_flag' => 'required',
        ], [
          'number.required' => 'gl account number is Required',
          'description.required' => 'gl account description is Required',
          'gl_account_type.required' => 'gl account description is Required',
          'gl_account_element_type.required' => 'cost element type is Required',
          'gl_account_tax.required' => 'gl account tax is Required',
          'type_flag.required' => 'type flag is Required',
        ]
    );
    if ($validator->passes()) {



      try {

        DB::beginTransaction();

        $request['company_id'] = Auth::user()->company_id;
        $glAccountAlready = GlAccount::byCompany($request['company_id'])->where('type_flag', $request['type_flag'])->count();
        if (empty($glAccountAlready)) {
          $glAccount = GlAccount::create($request->except('_token'));
          if ($glAccount) {
            DB::commit();
            return response()->json([
                  'status' => 'success',
                  'message' => 'GL Account Successfully Created.',
                  'url' => url('admin/gl-accounts')
            ]);
          } else {
            throw new Exception('Invalid Information!', 400);
          }
        } else {
          throw new Exception($request['type_flag'] . ' Flag Already Used!', 400);
        }
      } catch (Exception $ex) {
        DB::rollBack();
        return response()->json([
              'status' => 'error',
              'message' => $ex->getMessage()
        ]);
      }
    } else {
      $errors = array_values($validator->errors()->getMessages());
      $message = null;
      foreach ($errors as $error) {
        if (!empty($error)) {
          foreach ($error as $errorItem) {
            $message .= $errorItem . ' ';
          }
        }
      }
      return response()->json([
            'status' => 'validation',
            'message' => ($message != null) ? $message : 'Invalid Information!'
      ]);
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(GlAccount $GlAccount) {
    return view('admin.gl_accounts.create_update', [ 'glAccount' => $GlAccount, 'GlAccountFlagType' => GlAccountFlagType::byCompany()]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, GlAccount $GlAccount) {
    $validator = Validator::make($request->input(), [
          'number' => 'required',
          'description' => 'required',
          'gl_account_type' => 'required',
          'gl_account_element_type' => 'required',
          'gl_account_tax' => 'required',
          'type_flag' => 'required',
        ], [
          'number.required' => 'gl account number is Required',
          'description.required' => 'gl account description is Required',
          'gl_account_type.required' => 'gl account description is Required',
          'gl_account_element_type.required' => 'cost element type is Required',
          'gl_account_tax.required' => 'gl account tax is Required',
          'type_flag.required' => 'type flag is Required',
        ]
    );
    if ($validator->passes()) {
      try {

        DB::beginTransaction();
        $glAccount = $GlAccount->update($request->except('_token'));

        if ($glAccount) {
          DB::commit();
          return response()->json([
                'status' => 'success',
                'message' => 'GL Account Successfully Updated.',
                'url' => url('admin/gl-accounts')
          ]);
        } else {
          throw new Exception('Invalid Information!', 400);
        }
      } catch (Exception $ex) {
        DB::rollBack();
        return response()->json([
              'status' => 'error',
              'message' => $ex->getMessage()
        ]);
      }
    } else {
      $errors = array_values($validator->errors()->getMessages());
      $message = null;
      foreach ($errors as $error) {
        if (!empty($error)) {
          foreach ($error as $errorItem) {
            $message .= $errorItem . ' ';
          }
        }
      }
      return response()->json([
            'status' => 'validation',
            'message' => ($message != null) ? $message : 'Invalid Information!'
      ]);
    }
  }

  public function data_table() {
    $costs = GlAccount::all();
    return DataTables::of($costs)
        ->addColumn('action', function ($data) {
          $actionButton = (RoleAuthHelper::hasAccess('glAccounts.update') != true) ? ' <a href="javascript:void(0)" class="btn btn-default btn-xs" style="cursor:no-drop; color:#97A7A7;"><i class="fa fa-edit"></i>Edit' : '<a  href="/admin/gl-accounts/' . $data->gl_account_id . '/edit"  title="Edit"><i class="fa fa-edit"></i> Edit</a>';
          return $actionButton;
        })
        ->make(true);
  }

  public function get_gl_account_type_save(Request $request) {
    $validator = Validator::make($request->input(), [
          'flag_type' => 'required'
        ], [
          'flag_type.required' => 'gl account flag type is Required'
        ]
    );
    if ($validator->passes()) {
      try {
        DB::beginTransaction();

        if (!empty($request->input('gl_account_flag_type_id'))) {
          $flag = GlAccountFlagType::byCompany()->find($request->input('gl_account_flag_type_id'));
          $flag->flag_type = $request->flag_type;
          $flag->save();
        } else {
          $flag = GlAccountFlagType::create([
                'flag_type' => $request->flag_type,
                'company_id' => Auth::user()->company_id
          ]);
        }
        if ($flag) {
          DB::commit();

          return response()->json([
                'status' => 'success',
                'GlAccountFlagType' => GlAccountFlagType::byCompany()->pluck('flag_type'),
                'id' => $flag->gl_account_flag_type_id
          ]);
        } else {
          throw new Exception('Invalid Information!', 400);
        }
      } catch (Exception $ex) {
        DB::rollBack();
        return response()->json([
              'status' => 'error',
              'message' => $ex->getMessage()
        ]);
      }
    } else {
      $errors = array_values($validator->errors()->getMessages());
      $message = null;
      foreach ($errors as $error) {
        if (!empty($error)) {
          foreach ($error as $errorItem) {
            $message .= $errorItem . ' ';
          }
        }
      }
      return response()->json([
            'status' => 'validation',
            'message' => ($message != null) ? $message : 'Invalid Information!'
      ]);
    }
  }

}
