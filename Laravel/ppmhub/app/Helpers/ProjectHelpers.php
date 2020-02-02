<?php

namespace App\Helpers;

use App\Project;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\project_gr_cost;
use App\Models\Projects\ProjectCost;
use App\project_material_cost;
use App\project_contingency_cost;
use App\project_external_cost;
use App\project_hardware_cost;
use App\project_internal_cost;
use App\project_miscellanous_cost;
use App\project_service_cost;
use App\project_software_cost;
use App\project_travel_cost;
use App\project_facilities_cost;
use App\RevenueProductSales;
use App\RevenueServiceOffer;
use App\public_holidays;
use App\Company;
use App\OriginalBudget;
use App\roles_master;
use App\common_route_master;
use App\permission_master;
use App\Projectchecklist;

class ProjectHelpers
{

    public static function hasAccess($routeName)
    {
//check if current user has permission 
        $routeId = common_route_master::select('id')->where('route_path', $routeName)->first();
        if (isset($routeId->id)) {
            $roleId = Auth::user()->role_id;
            $flag = permission_master::where(['route_id' => $routeId->id, 'role_id' => $roleId])->get();

            if ($flag->count() > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function get_project_planned_cost($projectid)
    {
        $materialCostData = project_material_cost::selectRaw('sum(unit_price * quantity) as total_price,currency')->groupBy('currency')->where('project_number', $projectid)->get()->toArray();
        $internalCostData = project_internal_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projectid)->get()->toArray();
        $externalCostData = project_external_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projectid)->get()->toArray();
        $serviceCostData = project_service_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projectid)->get()->toArray();
        $softwareCostData = project_software_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projectid)->get()->toArray();
        $hardwareCostData = project_hardware_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projectid)->get()->toArray();
        $facilitiesCostData = project_facilities_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projectid)->get()->toArray();
        $travelCostData = project_travel_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projectid)->get()->toArray();
        $miscellaenousCostData = project_miscellanous_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projectid)->get()->toArray();
        $contingencyCostData = project_contingency_cost::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projectid)->get()->toArray();

        $Net_Total = (float) (isset($materialCostData[0]['total_price']) ? $materialCostData[0]['total_price'] : 0);
        $Net_Total += (isset($internalCostData[0]['total_price']) ? $internalCostData[0]['total_price'] : 0); //internal
        $Net_Total += (isset($externalCostData[0]['total_price']) ? $externalCostData[0]['total_price'] : 0); //external
        $Net_Total += (isset($serviceCostData[0]['total_price']) ? $serviceCostData[0]['total_price'] : 0);
        $Net_Total += (isset($softwareCostData[0]['total_price']) ? $softwareCostData[0]['total_price'] : 0);
        $Net_Total += (isset($hardwareCostData[0]['total_price']) ? $hardwareCostData[0]['total_price'] : 0);
        $Net_Total += (isset($facilitiesCostData[0]['total_price']) ? $facilitiesCostData[0]['total_price'] : 0);
        $Net_Total += (isset($travelCostData[0]['total_price']) ? $travelCostData[0]['total_price'] : 0);
        $Net_Total += (isset($miscellaenousCostData[0]['total_price']) ? $miscellaenousCostData[0]['total_price'] : 0);
        $Net_Total += (isset($contingencyCostData[0]['total_price']) ? $contingencyCostData[0]['total_price'] : 0);


        return $Net_Total;
    }

    public static function get_actual_cost_project($pid)
    {

        $project_cost = project_gr_cost::project_gr_actualcost_project($pid);
        $time_sheet_cost = ProjectCost::timesheet_cost_project($pid);

        //merge the cost in to one 
        $actual_cost = $project_cost + $time_sheet_cost;

        return $actual_cost;
    }

    public static function get_actual_cost_task($tid)
    {

        $project_cost = project_gr_cost::project_gr_cost_task($tid);
        $time_sheet_cost = ProjectCost::timesheet_cost_task($tid);
        //merge the cost in to one 
        $actual_cost = $project_cost + $time_sheet_cost;

        return $actual_cost;
    }

    public static function getPlannedRevenue($projectid)
    {

        $revenueProductCostData = RevenueProductSales::selectRaw('sum(unit_price * quantity) as total_price,currency')->groupBy('currency')->where('project_number', $projectid)->get()->toArray();
        $revenueServiceOfferCostData = RevenueServiceOffer::selectRaw('sum(total_price) as total_price,currency')->groupBy('currency')->where('project_number', $projectid)->get()->toArray();

        $Net_Total = (float) (isset($revenueProductCostData[0]['total_price']) ? $revenueProductCostData[0]['total_price'] : 0);
        $Net_Total += (isset($revenueServiceOfferCostData[0]['total_price']) ? $revenueServiceOfferCostData[0]['total_price'] : 0); //internal

        return $Net_Total;
    }

    public static function get_planned_progress($start_date, $end_date, $company_id = null)
    {

        if (gettype($company_id) === 'NULL') {
            $company = Company::where('id', Auth::user()->company_id)->first();
        } else {
            $company = Company::where('id', $company_id)->first();
        }
        $public_holiday = public_holidays::whereDate('date', '>=', date('Y-m-d', strtotime($start_date)))
                ->whereDate('date', '<=', date('Y-m-d', strtotime($end_date)))
                ->where('weekend', 0)
                ->where('country', isset($company->country) ? $company->country : '')
                ->where('company_id', isset($company->id) ? $company->id : '')
                ->count();

        //elapsed public holidays
        $EPH = public_holidays::whereDate('date', '>=', date('Y-m-d', strtotime($start_date)))
                ->whereDate('date', '<=', date('Y-m-d'))
                ->where('weekend', 0)
                ->where('country', isset($company->country) ? $company->country : '')
                ->where('company_id', isset($company->id) ? $company->id : '')
                ->count();

        $now = strtotime($start_date);
        $end_date = strtotime($end_date);

        //validation
        if ($now == null || $end_date == null) {
            return ['progress' => 0, 'elapsed_days' => 0, 'elapsed_working_days' => 0, 'elapsed_weekends' => 0, 'project_duration' => 0, 'weekends' => 0, 'total' => 0];
        }


        $WE = 0; // weekends 
        $WD = 0; // working days 
        $total = 0; //total days working + off days 
        $ED = 0; //elapsed  days
        $EWE = 0; //elapsed weekends
        $EWD = 0; //elapsed working Days



        while ($now <= $end_date) {
            $total++;
            $day_index = date("w", $now);

            // for elapsed time
            if (date("Y-m-d", $now) <= date("Y-m-d", strtotime('now'))) {
                $ED++;
                if ($day_index == 0 || $day_index == 6) {
                    $EWE++;
                } else {
                    $EWD++;
                }
            }

            if ($day_index == 0 || $day_index == 6) {
                $WE++;
            } else {
                $WD++;
            }
            $now = strtotime(date("Y-m-d", $now) . "+1 day");
        }
        $WD = ($WD != 0) ? $WD : 1;

        return ['progress' => floatval(($EWD / $WD) * 100), 'elapsed_days' => $ED, 'elapsed_working_days' => $EWD, 'elapsed_weekends' => $EWE, 'project_duration' => $WD, 'weekends' => $WE, 'public_holiday' => $public_holiday, 'total' => $total];
    }

    public static function getProjectData($pid)
    {
        $query = Project::query()
                ->select('project.id as project_uid', 'project.project_Id', 'project.project_name', 'project.status as statusP', 'project.bucket_id', 'buckets.bucket_id as buck_id', 'project.cost_centre', 'project.project_desc', DB::raw('DATE_FORMAT(project.start_date , "%d-%m-%Y") as pr_start_date '), DB::raw('DATE_FORMAT(project.end_date , "%d-%m-%Y") as pr_end_date '), DB::raw('DATE_FORMAT(project.a_start_date , "%d-%m-%Y") as a_start_date '), DB::raw('DATE_FORMAT(project.a_end_date , "%d-%m-%Y") as a_end_date '), DB::raw('DATE_FORMAT(project.f_start_date , "%d-%m-%Y") as f_start_date '), DB::raw('DATE_FORMAT(project.f_end_date , "%d-%m-%Y") as f_end_date '), DB::raw('DATE_FORMAT(project.sch_date , "%d-%m-%Y") as sch_date '), 'project.created_at as created_at ', 'project.created_by', DB::raw('DATE_FORMAT(project.p_start_date , "%d-%m-%Y") as p_start_date '), DB::raw('DATE_FORMAT(project.p_end_date , "%d-%m-%Y") as p_end_date '), 'buckets.name as bucket_name', 'createrole.role_name as createt_by_role_name', 'portfolio.name as portfolio_name', 'portfolio.port_id as portfolio_id', 'portfolio_type.name as portfolio_type', 'portfolio.port_id as portfolio_id', 'project_type.name as project_type_name', 'project_phase.phase_Id as project_phase_id', 'state_subrub.subrub as location', 'cost_centres.cost_centre as cost_centre_name', 'department_type.name as department_name')
                ->leftJoin('project_type', 'project_type.id', '=', 'project.project_type')
                ->leftJoin('portfolio', 'portfolio.id', '=', 'project.portfolio_id')
                ->leftJoin('portfolio_type', 'portfolio_type.id', '=', 'portfolio.type')
                ->leftJoin('department_type', 'department_type.id', '=', 'project.department')
                ->leftJoin('buckets', 'buckets.id', '=', 'project.bucket_id')
                ->leftJoin('project_phase', 'project_phase.project_id', '=', 'project.id')
                ->leftJoin('createrole', 'createrole.id', '=', 'project.created_by')
                ->leftJoin('state_subrub', 'state_subrub.id', '=', 'project.location_id')
                ->leftJoin('cost_centres', 'cost_centres.cost_id', '=', 'project.cost_centre')
                ->where('project.id', '=', $pid);

        return $query->get()->toArray();
    }

    //  get overall budget for the project
    public static function get_project_overall_budget($pid)
    {
        $overall_budget = OriginalBudget::getProjectOverallBudget($pid);
        return $overall_budget;
    }

    //get actual costing data
    public static function getActualCostingData($pid)
    {
        $projectCost = ProjectCost::selectRaw('total_cost,total_time')->Where('project_id', $pid)->get();
        $totalCost = $totalHours = 0;
        foreach ($projectCost as $project) {
            $totalHours += strtotime($project->total_time);
            $totalCost += $project->total_cost;
        }
        $totalHours = date("H", $totalHours);
        $actualProjectData = ['cost' => $totalCost, 'hours' => round($totalHours)];
        return $actualProjectData;
    }
	
	
	public static function get_project_checklist_counts($projectid)
    {
        $openChecklist = Projectchecklist::selectRaw('count(*) as open_check_list')->where(['project_id'=>$projectid,'checklist_status'=>'Closed'])->get()->toArray();
        $closeChecklist = Projectchecklist::selectRaw('count(*) as close_check_list')->where(['project_id'=>$projectid,'checklist_status'=>'OK'])->get()->toArray();
		$openChecklist  = array_shift($openChecklist);
		$closeChecklist  = array_shift($closeChecklist);
		return $openChecklist['open_check_list']."|".$closeChecklist['close_check_list'];
    }
	
	

}
