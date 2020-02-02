<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Project;
use App\Helpers\ProjectHelpers;
use App\projectchecklist;
use Illuminate\Support\Facades\DB;
use App\ProjectIssue;
use App\riskanalysis;
use App\TasksSubtask;
use App\progress_calculation_physical;

class ProjectDashboardController extends Controller
{

    /**
     * Project dashboard
     * @return type
     */
    public function dashboard()
    {
        //Get All projects
        $projects = Project::projectsWithId();

        return view('admin.project.dashboard', compact('projects'));
    }

    /*     * *
     * Get project dashboard data by project
     */

    public function dashboardChartData($projectId)
    {
        if (!empty($projectId)) {
            $project = Project::Where('project_Id', $projectId)->first();
            $commentary = $project->project_commentary;
            
            $projectOverallStatus = Project::projectOverallStatus($project);
            $dapChartData = projectchecklist::getDecisionActionPendingChartData($projectId); //retrieve decision action pending chart data
            $issueChartData = ProjectIssue::getIssueChartData($project->id); //retrieve issues chart data
            $riskChartData = riskanalysis::riskChart($projectId); //retrieve risks data
            $taskChartData = TasksSubtask::getTaskChartData($projectId); //retrive task/subtask data
            $taskSchedule = TasksSubtask::getTaskSchedule($projectId);//retrive task schedule data
            $budgetData = progress_calculation_physical::getBudgetData($project->id);
            
            return response()->json(
                            array(
                                'status' => true,
                                'data' => array(
                                    'dapChart' => $dapChartData,
                                    'issueChart' => $issueChartData,
                                    'riskChart' => $riskChartData,
                                    'taskChart' => $taskChartData,
                                    'budgetData' => $budgetData,
                                    'taskSchedule' => $taskSchedule
                                ),
                                'projCommentary' => $commentary,
                                'overallStatus' => $projectOverallStatus
            ));
        }else{
            return response()->json(array('status' => false));
        }
    }

}
