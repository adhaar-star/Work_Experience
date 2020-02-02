<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use App\Portfolio;
use App\Project;
use App\GanttChart;
use App\Portfoliotype;
use App\Buckets;
use App\Projecttype;
use App\location;
use App\Currency;
use App\Personresponsible;
use App\Factorycalendar;
use App\Costcentretype;
use App\Departmenttype;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Projecttask;
use App\User;
use App\Roleauth;
use App\Projectphase;
use App\project_material_cost;
use App\project_miscellanous_cost;
use App\project_hardware_cost;
use App\project_software_cost;
use App\project_travel_cost;
use App\project_contingency_cost;
use App\project_facilities_cost;
use App\project_service_cost;
use App\project_internal_cost;
use App\project_external_cost;
use App\Employee_records;
use App\public_holidays;
use App\ProjectNumberRange;
use App\Cost_centres;
use App\Helpers\ProjectHelpers;
use App\Helpers\PlanFeatureAccessHelper;

class GanttChartController extends Controller
{
	public function index($id = null){
	$projects = new Project();


	$projectschart = $projects->select(DB::raw('project_name as label') ,DB::raw('DATE_FORMAT(start_date, "%Y-%m-%d") as start'), DB::raw('DATE_FORMAT(end_date, "%Y-%m-%d") as end'))->orderBy('start_date','asc')->orderBy('end_date','asc')->get();

$gantt = new \Swatkins\LaravelGantt\Gantt($projectschart->toArray(), array(
    'title'      => 'Demo',
    'cellwidth'  => 25,
    'cellheight' => 35
));

return view('admin.project.gantt')->with([ 'gantt' => $gantt ]);
}
 public function show($id)
    {
		$projects = new Project();
		$projectdetails = $projects->select('project_id','project_name','project_desc')->where('id',$id)->get();
		$projectid=$projectdetails[0]->project_id;
$projecttask = new ProjectTask();
        $projectschart = $projecttask->select(DB::raw('task_name as label') ,DB::raw('DATE_FORMAT(start_date, "%Y-%m-%d") as start'), DB::raw('DATE_FORMAT(end_date, "%Y-%m-%d") as end'))->where('project_id',$projectid)->orderBy('start_date','asc')->orderBy('end_date','asc')->get();
 
 $data = array();
$count = 0;
foreach($projectschart as $projectchart){
	if($count==0){
		$data[] = array(
	'name' => 	$projectdetails[0]->project_name,
  'label' => $projectchart->label,
  'start' => $projectchart->start, 
  'end'   => $projectchart->end
);
		}
		else{
$data[] = array(
  'label' => $projectchart->label,
  'start' => $projectchart->start, 
  'end'   => $projectchart->end
);
}
$count++;
}

//print_r($data);die;
if(count($projectschart)>0){
$gantt = new \Swatkins\LaravelGantt\Gantt($data, array(
    'title'      => 'Demo',
    'cellwidth'  => 25,
    'cellheight' => 35
));
}
else{
return redirect('admin/ganttchart');
}
return view('admin.project.gantt')->with([ 'gantt' => $gantt ]);
    }
}
?>
