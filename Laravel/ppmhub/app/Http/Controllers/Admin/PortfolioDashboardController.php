<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Portfolio;
use App\Project;
use App\TasksSubtask;
use App\Helpers\ProjectHelpers;
use App\OriginalBudget;
use Carbon\Carbon;
use App\ProjectIssue;
use Illuminate\Support\Facades\DB;
use App\riskanalysis;

class PortfolioDashboardController extends Controller
{
    /**
     * Portfolio dashboard
     * @return type
     */
    public function dashboard() {
	
        $portfolio = Portfolio::Where('company_id', Auth::User()->company_id)->pluck('name', 'id');
        
		return view('admin.portfolio.dashboard', compact('portfolio'));
    
	}
    
    public function dashboardChartData($portfolioId){
        //Get number of project in portfolio
        $projects = Project::Where('portfolio_id', $portfolioId)->get();
        
        $plannedCost = $budget = $totalPlannedDays = $totalActualCalendarDays = $onTimeProjects = $totalActualWorkingDays = $physicalProgress = $costPropPregress = 0;
        $ragRisk = $ragIssueData = $ragScope = $ragQuality = $ragSchedule = $ragCostData = array('red' => 0, 'green' => 0, 'yellow' => 0);
        
        $today = new Carbon('today');
        $ragProjectData = array();
        foreach($projects as $key => $proj){
            //Get each project planned cost and do aggregate
            $plannedCost += ProjectHelpers::get_project_planned_cost($proj->project_Id);
            
            //Get original budget of each project and get aggregate for all
            $budgetOrignal = OriginalBudget::Where('project_id', $proj->id)->first();
            if(isset($budgetOrignal))
                $budget += $budgetOrignal->overall;
            
            //Convert planned start date and end date to object
            $totalPlannedDays += Portfolio::daysCount($proj->p_start_date, $proj->p_end_date); //add each projects planned days to total
            $totalActualCalendarDays += Portfolio::daysCount($proj->start_date, $proj->a_end_date);
            $projectWD = ProjectHelpers::get_planned_progress($proj->start_date, $proj->a_end_date, Auth::User()->company_id);
            $totalActualWorkingDays += $projectWD['project_duration'];
            // RAG Table
            $ragIssue = ProjectIssue::RAGIssues($proj->id);
            $ragIssueData['green'] += $ragIssue['normal'];
            $ragIssueData['yellow'] += $ragIssue['medium'];
            $ragIssueData['yellow'] += $ragIssue['urgent'];
            $ragIssueData['red'] += $ragIssue['veryUrgent'];
            $ragIssueData['red'] += $ragIssue['critical'];
            
            $ragCost = Project::ProjectCostBudget($proj->id, $proj->project_Id);
//            RAG Conditions
            $costLight = 'white';
            if ($ragCost['projectCost'] < $ragCost['budget']) {
                $ragCostData['green'] ++;
                $costLight = 'green';
            } else if ($ragCost['projectCost'] > (($ragCost['budget'] * 75) / 100)) {
                $ragCostData['yellow'] ++;
                $costLight = 'yellow';
            } else if ($ragCost['projectCost'] > $ragCost['budget']) {
                $ragCostData['red'] ++;
                $costLight = 'red';
            }
            
            $projectEndDate = new Carbon($proj->end_date);
            $projectActualEndDate = new Carbon($proj->a_end_date);
            $diff = date_diff($today, $projectEndDate);
            $scheduleLight = 'white';
            if ($diff->m > 0 && $diff->invert == 1) { //Project finish date is greater than 1 month then mark as green
                $ragSchedule['green']++;
                $scheduleLight = 'green';
            } else if ($diff->d >= 7 && $diff->invert == 1 && $diff->m == 0) { //Project finish date is before one week then mark as yellow
                $ragSchedule['yellow']++;
                $scheduleLight = 'yellow';
            } else if ($today > $projectEndDate) { //Project end date is completed then mark as red
                $ragSchedule['red']++;
                $scheduleLight = 'red';
            }
            
            $ragScope = Project::RAGScopeQuality($ragScope, $proj->scope);
            $ragQuality = Project::RAGScopeQuality($ragQuality, $proj->quality);
            
            $ragRisk = riskanalysis::RAGRisk($ragRisk, $proj->project_Id);
            
            $scopeLight = Project::scopeQualityLight($proj->scope);
            $qualityLight = Project::scopeQualityLight($proj->quality);
            $issueLight = ProjectIssue::issueLight($proj->id);
            $riskLight = riskanalysis::riskLight($ragRisk);
            
            //No. of projects completed within time
            if($projectEndDate >= $projectActualEndDate)
                $onTimeProjects++;
            //Project progress
            $physicalProgress += $proj->physical_progress;
            $costPropPregress += $proj->cost_progress;
            
            //Project traffic light detail info
            $ragProjectData[$key]['projectName'] = $proj->project_name;
            $ragProjectData[$key]['schedule'] = $scheduleLight;
            $ragProjectData[$key]['scope'] = $scopeLight;
            $ragProjectData[$key]['quality'] = $qualityLight;
            $ragProjectData[$key]['issue'] = $issueLight;
            $ragProjectData[$key]['risk'] = $riskLight;
            $ragProjectData[$key]['cost'] = $costLight;
            
        }
        $actualCost = TasksSubtask::actualCost($portfolioId);
        //Get estimated cost of all project by portfolio
        $estimatedCost = Project::Where('portfolio_id', $portfolioId)->sum('estimated_cost');
        
        $projectStatus = Project::projectsStatusChart($portfolioId);
        
        $budget = $budget != 0 ? $budget : 1;
        $percentBudget = ($actualCost->actualCost / $budget) * 100;
        
        //average planned days
        $pCount = $projects->count() > 0 ? $projects->count() : 1;
        $avgPlannedDays = round($totalPlannedDays / $pCount);
        $avgActCalDays = round($totalActualCalendarDays / $pCount);
        $avgActWorkDays = round($totalActualWorkingDays / $pCount);
        $avgPhyProgress = round($physicalProgress / $pCount);
        $avgCostPropProgress = round($costPropPregress / $pCount);
        
        $projPercentCompleteChartData = Project::projectsPercentCompleteChart($portfolioId);
        $projectByPlannedCostChartData = Project::projectsPlannedCostChart($portfolioId);
        
        return response()->json(array('status'=> true, 'data' => array('projectCount' => $projects->count(), 'estimatedCost' => $estimatedCost, 'plannedCost' => $plannedCost, 'actualCost' => $actualCost->actualCost, 
            'projectStatusChart' => $projectStatus,
            'percentBudget' => number_format($percentBudget, 2),
            'avgPhyProgress' => $avgPhyProgress,
            'avgCostProgress' => $avgCostPropProgress,
            'plannedDays' => $avgPlannedDays,
            'actualCalDays' => $avgActCalDays,
            'actualWorkingDays' => $avgActWorkDays,
            'projectPercentChart' => $projPercentCompleteChartData,
            'projectPlannedCostChart' => $projectByPlannedCostChartData,
            'redTrafficLight' => $onTimeProjects,
            'projectTrafficLight' => $ragProjectData,
            'rag' => array('issue' => $ragIssueData, 'cost' => $ragCostData, 'risk' => $ragRisk,
                'scope' => $ragScope, 'schedule' => $ragSchedule, 'quality' => $ragQuality)
            )
        ));
    }
}
