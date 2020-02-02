<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Portfolio;
use Illuminate\Support\Facades\Auth;
use App\Buckets;
use Illuminate\Support\Facades\Input;
use App\Project;
use App\Createrole;

class CapacityPlanningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $portfolios = Portfolio::where('company_id', Auth::user()->company_id)->where('status', 'active')->pluck('name', 'id');
        $views = array();
        $groupsAndCategories = array('groups' => array(), 'categories' => array());
        $viewId = $groupId = $categoryId = null;
        return view('admin.portfoliocapacityplanning.capacityPlanning.index', compact('portfolios', 'views', 'groupsAndCategories', 'viewId', 'groupId', 'categoryId'));
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
        $portfolios = Portfolio::where('company_id', Auth::user()->company_id)->where('status', 'active')->pluck('name', 'id');
        $capacitys = $this->portfolioPlanning($id);
        $bucketsProjects = $capacitys->getData()->data;
        $views = array(1 => 'Demand', 2 => 'Assigned', 3 => 'Forecast', 4 => 'Actual');
        
        $viewId = Input::get('view');
        $groupId = Input::get('group');
        $categoryId = Input::get('category');
        
        $groupsAndCategories = $this->groupsAndCategories($id);
        
        return view('admin.portfoliocapacityplanning.capacityPlanning.index', compact('portfolios','bucketsProjects','id', 'views', 'groupsAndCategories', 'viewId','groupId', 'categoryId'));
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
    
    public function portfolioPlanning($portfolioId){
        try{
            $buckets = Buckets::where('company_id', Auth::user()->company_id)->where('is_delete', 'N')->where('portfolio_id', $portfolioId)->with('children_rec')->get()->toArray();
            $bucketArr = Buckets::capacityPlanning($buckets);

            return response()->json(['status' => true, 'data' => $bucketArr]);
        } catch (Exception $ex) {
            return response()->json('Something went wrong' . $ex->getMessage());
        }
    }
    
    /**
     * Get All groups and categories for portfolio
     * @param type $portfolioId
     */
    public function groupsAndCategories($portfolioId){
        $allGroups = $allCategories = array();
        $projects = Project::projectsByPortfolio($portfolioId);
        foreach ($projects as $pKey => $proj) {
            //Actual and Demand Groups
            $groups = Createrole::Select('role_name as group')->Where('project_id', $proj['id'])->distinct()->pluck('group', 'group')->toArray();
            $categories = Createrole::Select('role_fun as category')->Where('project_id', $proj['id'])->distinct()->pluck('category', 'category')->toArray();
            $allGroups = array_merge($allGroups, $groups);
            $allCategories = array_unique(array_merge($allCategories,$categories), SORT_REGULAR);
            
            $personAssign = Project::personAssignmentByProject($proj['id']);
            //Assigned Groups
            foreach ($personAssign as $paKey => $person) {
                $role = Createrole::Where('id', $person->role)->first();
                if ($role) {
                    $role = $role->toArray();
                    if (array_key_exists('role_fun', $role) && !in_array($role['role_fun'], $allCategories))
                        array_push($allCategories, $role['role_fun']);
                    
                    if (array_key_exists('role_name', $role) && !in_array($role['role_name'], $allGroups))
                        array_push($allGroups, $role['role_name']);
                }
            }
            
        }
        return array('groups' => $allGroups, 'categories' => $allCategories);
    }
    
}
