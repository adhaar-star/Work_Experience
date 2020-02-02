<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Company;
use App\roles_master;
use App\permission_master;
use App\common_route_master;

class CompanyRolesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = roles_master::select('roles_masters.id', 'roles_masters.created_at', 'roles_masters.role_name', DB::raw('CONCAT(users.name," ",users.lname)as created_by'))
                ->where('roles_masters.company_id', Auth::user()->company_id)
                ->leftJoin('users', 'users.id', '=', 'roles_masters.created_by')
                ->get();
        return view('admin.company.company_roles', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.company_roles_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $checked_policies = $request->checkedIds;
        $role_name = $request->role_name;
        $validator = Validator::make($request->input(), [
                    'role_name' => 'required',
                        ], [
                    'role_name.required' => 'Role Name is Required'
                        ]
        );
        if ($validator->fails()) {
            $msgs = $validator->messages();
            return response()->json(array('error' => $msgs));
        }
        //validation agains update on company admin role
        if ($role_name == 'Company Admin') {
            return response()->json(null, 403);
        }

        $role_id = roles_master::create(['role_name' => $role_name, 'company_id' => Auth::user()->company_id, 'created_by' => Auth::user()->id]);

        $role = roles_master::where(['company_id' => Auth::user()->company_id, 'id' => $role_id->id])->first();

        $role->routes()->sync($checked_policies); // attach new rows & delete old non required rows

        session()->flash('flash_message', 'Company Role created successfully...');
        return response()->json(array('redirect_url' => 'admin/CompanyRoles'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companyRoles = roles_master::where('id', $id)->first();
        return view('admin.company.company_roles_create', compact('id', 'companyRoles'));
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
        $role_name = isset($request->role_name) ? $request->role_name : null;
        $checked_policies = $request->checkedIds;

        $role = roles_master::where(['company_id' => Auth::user()->company_id, 'id' => $id])->first();

        //validation agains update on company admin role
        if ($role->role_name == 'Company Admin') {
            return response()->json(null, 403);
        }
        roles_master::where('id', $id)->update(['role_name' => $role_name, 'changed_by' => Auth::user()->id]);

        $checked_policies = isset($request->checkedIds) ? $request->checkedIds : [];
        $id = $request->role_id;


        $role->routes()->sync($checked_policies); // attach new rows & delete old non required rows

        session()->flash('flash_message', 'Company Role updated successfully...');
        return response()->json(array('redirect_url' => 'admin/CompanyRoles'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = roles_master::where(['company_id' => Auth::user()->company_id, 'id' => $id])->first();

        //validation agains update on company admin role
        if ($role->role_name == 'Company Admin') {
            return response()->json(null, 403);
        }

        permission_master::where(['role_id' => $id])
                ->delete();

        roles_master::where('id', $id)->delete();
        session()->flash('flash_message', 'Company Role deleted successfully...');
        return redirect('admin/CompanyRoles');
    }

}
