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
use Dhtmlx\Connector\GanttConnector;


class GanttChartController extends Controller
{
    public function data() {
       
      //  $tasks = new Projecttask();
        $links = new Projectphase();
        $projecttasks = DB::table('tasks_subtask')
            ->select('tasks_subtask.task_Id','tasks_subtask.task_name as text','tasks_subtask.start_date','tasks_subtask.duration',
            'tasks_subtask.completion'
    );
        return response()->json([
            "data" => $projecttasks->get(),
            "links" => $links->all()
        ]);
    
        }
}
?>
