<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Portfolio;
use App\Project;
use App\Portfoliotype;
use App\Buckets;
use App\projecttype;
use App\location;
use App\Currency;
use App\Personresponsible;
use App\Factorycalendar;
use App\Costcentretype;
use App\Departmenttype;

class ProjectController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = Project::all();
        
        return view('admin.project.index', compact('project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ptype = Portfolio::pluck("name", "id")->prepend('Please select', '');
        $buckets = Buckets::pluck("name", "id")->prepend('Please select', '');
        $projectType = Projecttype::pluck("name", "id")->prepend('Please select', '');
        $location = Location::pluck("subrub", "id")->prepend('Please select', '');
        $currency = Currency::pluck("fullname", "short_code")->prepend('Please select', '');
        $personresponsible = Personresponsible::pluck("name", "id")->prepend('Please select', '');
        $factorycalendar = Factorycalendar::pluck("name", "id")->prepend('Please select', '');
        $cost_centre = Costcentretype::pluck("name", "id")->prepend('Please select', '');
        $department = Departmenttype::pluck("name", "id")->prepend('Please select', '');
        
		
        return view('admin.project.create', compact('ptype','buckets','projectType','location','currency','personresponsible','factorycalendar','cost_centre','department'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'project_Id' => 'required',
            'project_type' => 'required',
            'portfolio_id' => 'required',
            'bucket_id' => 'required',
            'start_date' => 'required',
            
        ]);
        Project::create($request->all());
        
        session()->flash('flash_message', 'Project created successfully...');
        return redirect('admin/project');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    { 
        $project = Project::find($id);
        $currency = Currency::pluck("fullname", "short_code")->prepend('Please select', '');
		$ptype = Portfolio::pluck("name", "id")->prepend('Please select', '');
        $buckets = Buckets::pluck("name", "id")->prepend('Please select', '');
        $projectType = projecttype::pluck("name", "id")->prepend('Please select', '');
        $location = Location::pluck("subrub", "id")->prepend('Please select', '');
        $personresponsible = Personresponsible::pluck("name", "id")->prepend('Please select', '');
        $factorycalendar = Factorycalendar::pluck("name", "id")->prepend('Please select', '');
        $cost_centre = Costcentretype::pluck("name", "id")->prepend('Please select', '');
        $department = Departmenttype::pluck("name", "id")->prepend('Please select', '');
        
        return view('admin.project.create', compact('project','ptype','buckets','projectType','currency','location','personresponsible','factorycalendar','cost_centre','department'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request            
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $project = Project::find($id);
        $this->validate($request, [
            'project_Id' => 'required',
            'project_type' => 'required',
            'portfolio_id' => 'required',
            'bucket_id' => 'required',
            'start_date' => 'required',
        
        ]);
        $project->update($request->all());
        session()->flash('flash_message', 'Project updated successfully...');
        return redirect('admin/project');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id            
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::find($id);
        $project->delete();
        session()->flash('flash_message', 'Project deleted successfully...');
        return redirect('admin/project');
    }
}
