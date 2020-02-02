<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use App\User;
use App\Company;
use App\roles_master;
use App\permission_master;
use App\common_route_master;

class AccessControlController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = roles_master::where('company_id', Auth::user()->company_id)
                ->get();
        $userRole = Auth::user()->role_id;
        return view('admin.accessControl.index', compact('roles', 'userRole'));
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

        $checked_policies = isset($request->checkedIds) ? $request->checkedIds : [];
        $id = $request->role_id;


        $role = roles_master::where(['company_id' => Auth::user()->company_id, 'id' => $request->role_id])->with('routes')->first();
        
        //validation agains update on company admin role
        if ($role->role_name == 'Company Admin') {
            return response()->json(null, 403);
        }
        
        
        $role->routes()->sync($checked_policies); // attach new rows & delete old non required rows

        session()->flash('flash_message', 'Permisions updated successfully...');
        return response()->json(array('redirect_url' => 'admin/AccessControl'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        $validation = common_route_master::select('common_route_masters.id', DB::raw('CONCAT_WS(common_route_masters.route_path,".",permission_masters.method) as text'), 'common_route_masters.parent', DB::raw('IF(permission_masters.permission = 1, 1,0) as checked'))
                ->where('permission_masters.role_id', $id)
                ->join('permission_masters', 'permission_masters.route_id', '=', 'common_route_masters.id')
                ->count();

        $validation = roles_master::select('id')->where(['company_id' => Auth::user()->company_id, 'id' => $id])->with('routes')->first();
        $validation = isset($validation)?count($validation->toArray()['routes']):0;


        if ($id != null && $validation > 0) {

            /* get all the routes who are checked in an array 
             */

            $selected = roles_master::select('id')->where(['company_id' => Auth::user()->company_id, 'id' => $id])->with('routes')->first()->toArray();
            $pathlist = [];

            foreach ($selected['routes'] as $key => $path) {
                array_push($pathlist, $path['id']);
            }

            try {
                $paths = common_route_master::select('id', 'parent', 'route_path as text', DB::raw('"" as checked'))->where('parent', '==', 0)->with('children')->get()->toArray();
            } catch (\Exception $ex) {
                print_r($ex->getMessage());
            }


            foreach ($paths as $key => $path) {

                if (in_array($path['id'], $pathlist, true)) {
                    $paths[$key]['checked'] = 1;
                }
                if (count($path['children']) > 0)
                    foreach ($path['children'] as $index => $child) {
                        if (in_array($child['id'], $pathlist, true)) {
                            $paths[$key]['children'][$index]['checked'] = 1;
                        }
                        if (count($child['children']) > 0)
                            foreach ($child['children'] as $counter => $children) {
                                if (in_array($children['id'], $pathlist, true)) {
                                    $paths[$key]['children'][$index]['children'][$counter]['checked'] = 1;
                                }
                            }
                    }
            }
        } else {

            try {
                $paths = common_route_master::select('id', 'parent', 'route_path as text', DB::raw('"" as checked'))->where('parent', '==', 0)->with('children')->get()->toArray();
            } catch (\Exception $ex) {
                print_r($ex->getMessage());
            }
        }

        return response()->json($paths);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
