<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Roleauth;
use App\Portfolio;
use App\Project;
use App\Buckets;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Yajra\DataTables\Facades\DataTables;

class ReportPortfolioController extends Controller
{

    public function projectportfolio(Request $request)
    {

        Roleauth::check('project.create');
        $projectlist = array();
        $project_data = Project::all();

        $projectlist = Project::where('company_id', Auth::user()->company_id)
                ->select('id', DB::raw('concat(project_Id," ( ",project_name," )") as project_name'))
                ->pluck('project_name', 'id');

        $portfoliolist = Portfolio::where('company_id', Auth::user()->company_id)
                ->select('id', DB::raw('concat(id," ( ",name," )") as name'))
                ->pluck('name', 'id');


        $bucketlist = Buckets::where('company_id', Auth::user()->company_id)
                ->select('bucket_id', 'id')
                ->pluck('bucket_id', 'id');

        return view('admin.report.projectportfolio', compact('bucketlist', 'portfoliolist', 'projectlist', 'graph', 'report', 'reportbucket_id', 'reportProject_from', 'reportProject_to', 'reportportfolio_id', 'request_p'));
    }

    public function export_projectportfolio_html($reportProject_to = null, $reportProject_from = null, $reportbucket_id = null, $reportportfolio_id = null)
    {

        $query = Project::query();
        $query->select('project.project_Id', 'project.project_desc', 'project.bucket_id',DB::raw('portfolio.port_id as portfolio_id'), 'buckets.name as bucket_name', 'portfolio.name as portfolio_name');
        $query->join('buckets', 'buckets.id', '=', 'project.bucket_id');
        $query->join('portfolio', 'portfolio.id', '=', 'project.portfolio_id');

        if (isset($reportbucket_id) && $reportbucket_id != "-") {
            $query->where('buckets.id', '=', $reportbucket_id);
            $bucket_id = "bucket_id=$reportbucket_id";
        } else {
            $bucket_id = '';
        }

        if (isset($reportportfolio_id) && $reportportfolio_id != "-") {
            $query->where('project.portfolio_id', '=', $reportportfolio_id);
            $portfolio_id = "portfolio_id=$reportportfolio_id";
        } else {
            $portfolio_id = '';
        }

        if (isset($reportProject_from) && $reportProject_from != "-") {
            $query->where('project.id', '>=', $reportProject_from);
            $from = "reportProject_from=$reportProject_from";
        } else {
            $from = '';
        }

        if (isset($reportProject_to) && $reportProject_to != "-") {
            $query->where('project.id', '<=', $reportProject_to);
            $to = "reportProject_to=$reportProject_to";
        } else {
            $to = '';
        }

        $query->where('project.company_id', '=', Auth::user()->company_id);
        $request = $query->get();



        if (count($request) == 0) {

            return Redirect::to('admin/projectportfolio?' . $from . '&' . $to . '&' . $bucket_id . '&' . $portfolio_id . '&e=*h-');
        }




        $file = "ProjectPortfolio.html";
        header("Content-type: application/ProjectPortfolio.html");
        header("Content-Disposition: attachment; filename=$file");
        echo '
		<div style="width:100%;float:left"><h2>Project Report: Task Detail Report</h2></div>
		<table width="100%">
		<tr style="border:1px solid #ccc";>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Project ID</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Project Description</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Bucket ID</b></th>
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Bucket Name</b></th>		
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Portfolio ID</b></th>		
		<th style="background:#eee;padding:15px;text-align: center;border:1px solid #ccc"><b>Portfolio Name</b></th>		
		</tr>
		';
        foreach ($request as $data) {
            echo '
				<tr style="border:1px solid #ccc";>
					<td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->project_Id . '</b></td>
					<td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->project_desc . '</b></td>
					<td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->bucket_id . '</b></td>
					<td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->bucket_name . '</b></td>
					<td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->portfolio_id . '</b></td>
					<td style="text-align:center;border:1px solid #ccc;padding:15px"><b>' . $data->portfolio_name . '</b></td>
					
				</tr>';
        }
        echo '</table>';
    }
    
    public function projectportfolioDataTable(Request $request) {
        
        $reportbucket_id = isset($request->bucket_id) ? $request->bucket_id : null;
        $reportportfolio_id = isset($request->portfolio_id) ? $request->portfolio_id : null;
        $reportProject_to = isset($request->reportProject_to) ? $request->reportProject_to : null;
        $reportProject_from = isset($request->reportProject_from) ? $request->reportProject_from : null;
        $request_p = $request->e;
        
        $report = Portfolio::portfolio_report_query($reportbucket_id, $reportportfolio_id, $reportProject_to, $reportProject_from);
        $report = $report['report'];
        return DataTables::of($report)->make();
        
    }

}
