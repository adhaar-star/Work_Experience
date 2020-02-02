<?php

/*
  |--------------------------------------------------------------------------
  | Web Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register web routes for your application. These
  | routes are loaded by the RouteServiceProvider within - group which
  | contains the "web" middleware group. Now create something great!
  |
 */

/* Route::get('/', function () {
  return view('welcome');
  }); */
Route::get('/params/{name}', [
    'middleware' => 'role-auth',
    function () {
      return view('welcome');
    }])->name('welcome');

Route::model('cost_centre', 'App\Cost_centres');

Route::get('routes', function() {
  $routeCollection = Route::getRoutes();

  echo "<table style='width:100%'>";
  echo "<tr>";
  //echo "<td width='10%'><h4>HTTP Method</h4></td>";
  //  echo "<td width='10%'><h4>Route</h4></td>";
  echo "<td width='10%'><h4>Name</h4></td>";
  echo "<td width='70%'><h4>Corresponding Action</h4></td>";
  echo "</tr>";
  foreach ($routeCollection as $value) {
    //print '<pre>';
    // print_r($value);
    //exit;
    echo "<tr>";
    // echo "<td>" . $value->getMethods()[0] . "</td>";
    // echo "<td>" . $value->getPath() . "</td>";
    echo "<td>" . $value->getName() . "</td>";
    echo "<td>" . $value->getActionName() . "</td>";
    echo "</tr>";
  }
  echo "</table>";
});


Route::group(['prefix' => 'admin'], function () {
  Route::get('/', 'Admin\HomeController@index');
  Route::post('login', 'Admin\HomeController@login');
  Route::group(['middleware' => ['check-auth', 'role-auth']], function () {
    Route::get('logout', 'Admin\HomeController@logout');
    //for change password
    Route::resource('changepassword', 'Auth\ChangePasswordController');

    Route::resource('company', 'Admin\CompanyController', ['names' => [
            'index' => 'companyDetails.dashboard',
            'create' => 'companyDetails.create',
            'edit' => 'companyDetails.update',
            'store' => 'companyDetails.create',
            'update' => 'companyDetails.update',
            'destroy' => 'companyDetails.delete',
    ]]);
    Route::resource('CompanyRoles', 'Admin\CompanyRolesController', ['names' => [
            'index' => 'company.roles.dashboard',
            'create' => 'company.roles.create',
            'edit' => 'company.roles.update',
            'store' => 'company.roles.create',
            'update' => 'company.roles.update',
            'destroy' => 'company.roles.delete',
    ]]);
     Route::get('ganttchart/{id}', function () {
    return view('admin.project.gantt2');
});

Route::match(['get', 'post'], '/gantt_data', 'Admin\GanttChartController@data');
    Route::resource('AccessControl', 'Admin\AccessControlController', ['names' => [
            'index' => 'roles.permission.dashboard',
            'show' => 'roles.permission.view',
    ]]);
    Route::get('route-paths/Get', 'Admin\AccessControlController@show')->name('roles.permission.view');
    Route::get('route-paths/Get/{id}', 'Admin\AccessControlController@show')->name('roles.permission.view');
    Route::POST('route-paths/Store', 'Admin\AccessControlController@Store')->name('roles.permission.update');

    Route::get('dashboard', 'Admin\DashboardController@index')->name('Dashboard');
    Route::get('project_dashboard', 'Admin\ProjectDashboardController@dashboard')->name('project-dashboard');
    Route::get('getproject-dashboard-chart-data/{projectId}', 'Admin\ProjectDashboardController@dashboardChartData');
    Route::get('portfolio_dashboard', 'Admin\PortfolioDashboardController@dashboard')->name('portfolio-dashboard');
    Route::get('getportfolio-dashboard-chart-data/{portfolioId}', 'Admin\PortfolioDashboardController@dashboardChartData');
    Route::get('export', 'Admin\PortfolioController@export_cs')->name('portfolio.export_csv');

    Route::resource('portfoliotypes', 'Admin\PortfolioTypesController', ['names' => [
            'index' => 'portfolioType.dashboard',
            'create' => 'portfolioType.create',
            'edit' => 'portfolioType.update',
            'store' => 'portfolioType.create',
            'update' => 'portfolioType.update',
            'destroy' => 'portfolioType.delete',
    ]]);

    //  Portfolio Group added 
//    Route::group(['as' => 'pm.'], function () {    
//    Route::group(['as' => 'portfolio.', 'name' => 'Portfolio Management'], function () {
    Route::resource('portfolio', 'Admin\PortfolioController', ['names' => [
            'index' => 'portfolio.dashboard',
            'create' => 'portfolio.create',
            'edit' => 'portfolio.update',
            'store' => 'portfolio.create',
            'update' => 'portfolio.update',
            'destroy' => 'portfolio.delete',
    ]]);

    Route::get('portfolio.datatable', 'Admin\PortfolioController@data_table')->name('portfolio.datatable');
    Route::get('portfolio/view/{id}', 'Admin\PortfolioController@getPortfolioData')->name('portfolio.view');

    //  });
    //   });

    /*  Route::group(['as' => 'pm.'], function () {    
      Route::group(['as' => 'portfolio.', 'name' => 'Portfolio Management'], function () {
      Route::resource('portfolio', 'Admin\PortfolioController', ['names' => [
      'index' => 'dashboard',
      'create' => 'create',
      'edit' => 'update',
      'store' => 'create',
      'update' => 'update',
      'destroy' => 'portfolio.delete',
      ]]);
      });
      }); */

    Route::get('portfoliocapacity-data-table', 'Admin\PortfolioCapacityPlanningController@data_table')->name('portfolioCapacity-data-table');

    Route::get('costbudget/', 'Admin\CostBudgetReportController@costbudget')->name('report.costbudget.dashboard');
    Route::get('costBudget-data/', 'Admin\CostBudgetReportController@costBudgetReportDataTable')->name('report.costbudget.datatable.ajax');


    Route::get('export_costbudget_cs/{reportProject_to?}/{reportProject_from?}/{reportStart_date?}/{reportEnd_date?}', 'Admin\ReportController@export_costbudget_cs', function ($reportProject_to = null, $reportProject_from = null, $reportStart_date = null, $reportEnd_date = null) {
      
    });

    Route::get('export_checklist_cs/{reportProject_to?}/{reportProject_from?}/{reportName?}/{reportChecklist_id?}', 'Admin\ReportController@export_checklist_cs', function ($reportProject_to = null, $Project_form = null, $reportName = null, $reportChecklist_id = null) {
      
	  });

    Route::get('export_milestonereport_cs/{Project_to?}/{Project_form?}/{phase_ID?}/{task_ID?}/{milestone_Id?}', 'Admin\ReportController@export_milestonereport_cs', function ($Project_to = null, $Project_form = null, $phase_ID = null, $task_ID = null, $milestone_Id = null) {
      
    })->name('report.milestone.export.html');

    Route::get('export_riskanalysis_cs/{Project_to?}/{Project_form?}/{status?}/{risk_status?}', 'Admin\ReportController@export_riskanalysis_cs', function ($Project_to = null, $Project_form = null, $status = null, $risk_status = null) {
      
    })->name('report.projectRiskAnalysis.export.html');

    Route::get('export_projectdefinitiondetail_cs/{Project_to?}/{Project_form?}/{reportStart_date?}/{reportEnd_date?}', 'Admin\ReportController@export_projectdefinitiondetail_cs', function ($Project_to = null, $Project_form = null, $reportStart_date = null, $reportEnd_date = null) {
      
    })->name('report.projectDefinition.export.all');

    Route::get('export_phasedetail_cs/{reportProject_to?}/{reportProject_from?}/{phase_id?}/{portfolio_id?}/{bucket_id?}', 'Admin\ReportController@export_phasedetail_cs', function ($reportProject_to = null, $reportProject_from = null, $phase_id = null, $portfolio_id = null, $bucket_id = null) {
      
    })->name('report.phaseDetail.export.html');

    Route::get('export_sales_cs', 'Admin\ReportController@export_sales_cs');

    Route::get('export_timesheet_cs/{reportProject_to?}/{reportProject_from?}', 'Admin\ReportController@export_timesheet_cs', function ($reportProject_to = null, $reportProject_from = null) {
      
    })->name('report.projectTimesheet.export.csv');

    Route::get('export_taskdetail_cs/{reportProject_to?}/{reportProject_from?}', 'Admin\ReportController@export_taskdetail_cs', function ($reportProject_to = null, $reportProject_from = null) {
      
    })->name('report.taskDetail.export.csv');

    Route::get('export_projectportfolio_cs/{reportProject_to?}/{reportProject_from?}/{reportbucket_id?}/{reportportfolio_id?}', 'Admin\ReportController@export_projectportfolio_cs', function ($reportProject_to = null, $reportProject_from = null, $reportbucket_id = null, $reportportfolio_id = null) {
      
    })->name('report.portfolio.export.csv');

    Route::get('export_purchaserequisition_cs/{reportProject_to?}/{reportProject_from?}', 'Admin\ReportController@export_purchaserequisition_cs', function ($reportProject_to = null, $reportProject_from = null) {
      
    })->name('report.requisition.export.csv');
    ;

    Route::get('export_purchaseorder_cs/{reportProject_to?}/{reportProject_from?}', 'Admin\ReportController@export_purchaseorder_cs', function ($reportProject_to = null, $reportProject_from = null) {
      
    })->name('report.purchaseOrder.export.csv');

    // Route::get('export_purchaseorder_cs', 'Admin\ReportController@export_purchaseorder_cs');

    Route::post('projectData/ajaxrequest', 'Admin\ReportController@getProjectData');
    Route::get('checklistreport/', 'Admin\CheckListReportController@checklistreport')->name('report.checklist.dashboard');
    Route::get('checklist-data/', 'Admin\CheckListReportController@checklistreportDataTable')->name('report.checklist.datatable');
	Route::get('checklist-graphdata/', 'Admin\CheckListReportController@checklistreportgraphDataTable')->name('report.checklist.datatable');
	
    Route::get('milestonereport/', 'Admin\ReportMilestoneController@milestonereport')->name('report.milestone.dashboard');
    Route::get('milestone-data/', 'Admin\ReportMilestoneController@mileStoneReportDatatable')->name('milestone-report');

    Route::get('riskanalysis/', 'Admin\ReportRiskAnalysisController@riskanalysis')->name('report.projectRiskAnalysis.dashboard');
    Route::get('riskanalysis-data', 'Admin\ReportRiskAnalysisController@riskreportAnalysisDatatable')->name('report.projectRiskAnalysis.datatable');

    Route::get('riskanalysisgraph-data', 'Admin\ReportRiskAnalysisController@riskreportAnalysisGraphDatatable')->name('report.projectRiskAnalysis.datatable');

    Route::get('projectdefinitiondetail/', 'Admin\ReportProjectDefinitionController@projectdefinitiondetail')->name('report.projectDefinition.dashboard');
    Route::get('project-data', 'Admin\ReportProjectDefinitionController@projectReportDatatable')->name('report.projectDefinition.datatable');

    Route::get('projectdefinationgraph-data', 'Admin\ReportProjectDefinitionController@projectdefinationgraphDataTable')->name('report.projectDefinition.datatable');

    Route::get('phasedetail/', 'Admin\ReportPhaseDetailsController@phasedetail')->name('report.phaseDetail.dashboard');
    Route::get('phaseDetail-data', 'Admin\ReportPhaseDetailsController@phasedetailDataTable')->name('report.phaseDetail.datatable');

    Route::get('timesheet/', 'Admin\ProjectTimeSheetReportController@timesheetreport')->name('report.projectTimesheet.dashboard');
    Route::get('timesheetreport-data', 'Admin\ProjectTimeSheetReportController@timesheetreportDataTable')->name('report.projectTimesheet.dashboard');
    Route::get('timesheetgraph-data', 'Admin\ProjectTimeSheetReportController@timesheetgraphDataTable')->name('report.projectTimesheet.dashboard');
    Route::get('purchaseordergraph-data/', 'Admin\PurchaseOrderReportController@purchaseOrderGraphDataTable')->name('report.purchaseOrder.datatable');

    Route::get('salesreport/', 'Admin\ProjectSalesReportController@salesreport')->name('report.sales.dashboard');
    Route::get('salesOrder-data/', 'Admin\ProjectSalesReportController@salesreportDataTable')->name('report.sales.datatable');

    Route::get('taskdetail/', 'Admin\ReportTaskDetailsController@taskdetailreport')->name('report.taskDetail.dashboard');
    Route::get('taskdetail-data', 'Admin\ReportTaskDetailsController@taskdetailDataTable')->name('report.taskDetail.datatable');

    Route::get('projectportfolio/', 'Admin\ReportPortfolioController@projectportfolio')->name('report.portfolio.dashboard');
    Route::get('portfolioReport-data/', 'Admin\ReportPortfolioController@projectportfolioDataTable')->name('report.portfolio.datatable');

    Route::get('purchaserequisition/', 'Admin\ReportPurchaseRequisitionController@purchaserequisition')->name('report.requisition.dashboard');
    Route::get('purchaserequisition-data', 'Admin\ReportPurchaseRequisitionController@purchaserequisitionDataTable')->name('report.requisition.datatable');

    Route::get('purchaserequisitiongraph-data', 'Admin\ReportPurchaseRequisitionController@purchaserequisitionGraphDataTable')->name('report.requisition.datatable');

    Route::get('purchaseorder/', 'Admin\PurchaseOrderReportController@purchaseorder')->name('report.purchaseOrder.dashboard');
    Route::get('purchaseOrder-data/', 'Admin\PurchaseOrderReportController@purchaseOrderDataTable')->name('report.purchaseOrder.datatable');

    Route::get('goodsreceiptreport/', 'Admin\GoodsReceiptReportController@goodsreceipt')->name('report.goodsReceipt.dashboard');
    Route::get('goodsReceiptReport-data', 'Admin\GoodsReceiptReportController@goodsreceiptDataTable')->name('report.goodsReceipt.datatable');

    Route::get('invoiceverificationreport/', 'Admin\InvoiceVerificationReportController@invoiceverification')->name('report.invoiceVerification.dashboard');
    Route::get('invoiceverification-data', 'Admin\InvoiceVerificationReportController@invoiceverificationDataTable')->name('report.invoiceVerification.datatable');

    Route::get('projectprocurement', 'Admin\ReportController@projectprocurement');

    /* export pdf */
    Route::get('salespdf', array('as' => 'salespdf', 'uses' => 'Admin\ReportController@salespdf'));


    Route::get('phasedetailpdf/{reportProject_to?}/{reportProject_from?}/{phase_id?}/{portfolio_id?}/{bucket_id?}', 'Admin\ReportController@phasedetailpdf', function ($reportProject_to = null, $reportProject_from = null, $phase_id = null, $portfolio_id = null, $bucket_id = null) {
      
    });

    Route::get('costbudgetpdf/{reportProject_to?}/{reportProject_from?}/{reportStart_date?}/{reportEnd_date?}', 'Admin\ReportController@costbudgetpdf', function ($reportProject_to = null, $reportProject_from = null, $reportStart_date = null, $reportEnd_date = null) {
      
    });

    Route::get('checklistpdf/{reportProject_to?}/{reportProject_from?}/{reportName?}/{reportChecklist_id?}', 'Admin\ReportController@checklistpdf', function ($reportProject_to = null, $Project_form = null, $reportName = null, $reportChecklist_id = null) {
      
    });

    Route::get('milestonepdf/{Project_to?}/{Project_form?}/{phase_ID?}/{task_ID?}/{milestone_Id?}', 'Admin\ReportController@milestonepdf', function ($Project_to = null, $Project_form = null, $phase_ID = null, $task_ID = null, $milestone_Id = null) {
      
    });

    Route::get('riskanalysispdf/{Project_to?}/{Project_form?}/{status?}/{risk_status?}', 'Admin\ReportController@riskanalysispdf', function ($Project_to = null, $Project_form = null, $status = null, $risk_status = null) {
      
    });

    Route::get('projectdefinitiondetailpdf/{Project_to?}/{Project_form?}/{reportStart_date?}/{reportEnd_date?}', 'Admin\ReportController@projectdefinitiondetailpdf', function ($Project_to = null, $Project_form = null, $reportStart_date = null, $reportEnd_date = null) {
      
    });

    Route::get('timesheetpdf/{reportProject_to?}/{reportProject_from?}', 'Admin\ReportController@timesheetpdf', function ($reportProject_to = null, $reportProject_from = null) {
      
    })->name('report.projectTimesheet.export.pdf');

    Route::get('taskdetailpdf/{reportProject_to?}/{reportProject_from?}', 'Admin\ReportController@taskdetailpdf', function ($reportProject_to = null, $reportProject_from = null) {
      
    })->name('report.taskDetail.export.pdf');

    Route::get('projectportfoliopdf/{reportProject_to?}/{reportProject_from?}/{reportbucket_id?}/{reportportfolio_id?}', 'Admin\ReportController@projectportfoliopdf', function ($reportProject_to = null, $reportProject_from = null, $reportbucket_id = null, $reportportfolio_id = null) {
      
    })->name('report.portfolio.export.pdf');

    Route::get('purchaserequisitionpdf/{reportProject_to?}/{reportProject_from?}', 'Admin\ReportController@purchaserequisitionpdf', function ($reportProject_to = null, $reportProject_from = null) {
      
    })->name('report.requisition.export.pdf');

    Route::get('purchaseorderpdf/{reportProject_to?}/{reportProject_from?}', 'Admin\ReportController@purchaseorderpdf', function ($reportProject_to = null, $reportProject_from = null) {
      
    })->name('report.purchaseOrder.export.pdf');

    // Route::get('purchaseorderpdf', array('as' => 'purchaseorderpdf', 'uses' => 'Admin\ReportController@purchaseorderpdf'));


    /* export Html */

    Route::get('costbudgetht/{reportProject_from?}/{reportProject_to?}/{reportStart_date?}/{reportEnd_date?}', 'Admin\CostBudgetReportController@export_costbudget_html', function ($reportProject_from = null, $reportProject_to = null, $reportStart_date = null, $reportEnd_date = null) {
      
    });

    Route::get('checklistht/{reportProject_from?}/{reportProject_to?}/{managerName?}/{checklist_id?}', 'Admin\CheckListReportController@export_checklist_html', function ($reportProject_from = null, $reportProject_to = null, $managerName = null, $reportChecklist_id = null) {
      
    });

    Route::get('milestoneht/{Project_form?}/{Project_to?}/{phase_ID?}/{task_ID?}/{milestone_Id?}', 'Admin\ReportMilestoneController@export_milestone_html', function ($Project_form = null, $Project_to = null, $project_phase_id = null, $project_task_id = null, $project_milestone_Id = null) {
      
    });

    Route::get('riskanalysisht/{Project_from?}/{Project_to?}/{risktype?}/{status?}', 'Admin\ReportRiskAnalysisController@export_riskanalysis_html', function ($Project_from = null, $Project_to = null, $riskType = null, $status = null) {
      
    });

    Route::get('projectdefinitiondetailht/{Project_to?}/{Project_form?}/{reportStart_date?}/{reportEnd_date?}', 'Admin\ReportController@export_projectdefinitiondetail_html', function ($Project_to = null, $Project_form = null, $reportStart_date = null, $reportEnd_date = null) {
      
    });

    Route::get('phasedetailht/{reportProject_to?}/{reportProject_from?}/{phase_id?}/{portfolio_id?}/{bucket_id?}', 'Admin\ReportController@export_phasedetail_html', function ($reportProject_to = null, $reportProject_from = null, $phase_id = null, $portfolio_id = null, $bucket_id = null) {
      
    });

    Route::get('timesheetht/{reportProject_to?}/{reportProject_from?}', 'Admin\ReportController@export_timesheet_html', function ($reportProject_to = null, $reportProject_from = null) {
      
    })->name('report.projectTimesheet.export.html');
    Route::get('taskdetailht/{reportProject_to?}/{reportProject_from?}', 'Admin\ReportController@export_taskdetail_html', function ($reportProject_to = null, $reportProject_from = null) {
      
    })->name('report.taskDetail.export.html');
    Route::get('projectportfolioht/{reportProject_to?}/{reportProject_from?}/{reportbucket_id?}/{reportportfolio_id?}', 'Admin\ReportPortfolioController@export_projectportfolio_html', function ($reportProject_to = null, $reportProject_from = null, $reportbucket_id = null, $reportportfolio_id = null) {
      
    })->name('report.portfolio.export.html');

    Route::get('purchaserequisitionht/{reportProject_to?}/{reportProject_from?}', 'Admin\ReportController@export_purchaserequisition_html', function ($reportProject_to = null, $reportProject_from = null) {
      
    })->name('report.requisition.export.html');

    Route::get('purchaseorderht/{reportProject_to?}/{reportProject_from?}', 'Admin\ReportController@export_purchaseorder_html', function ($reportProject_to = null, $reportProject_from = null) {
      
    })->name('report.purchaseOrder.export.html');

    Route::get('salesorderht/{sales_order_no_from?}/{sales_order_no_to?}', 'Admin\ProjectSalesReportController@export_salesorder_html', function ($sales_order_no_from = null, $sales_order_no_to = null) {
      
    })->name('report.sales.export.html');

    // Route::get('purchaseorderht', 'Admin\ReportController@export_purchaseorder_html');
    //project progress menu
    Route::resource('project_progress/working_days/', 'Admin\Working_days_controller', ['names' => [
            'index' => 'projectprogress.workingdays.dashboard',
            'store' => 'projectprogress.workingdays.dashboard',
    ]]);
    Route::get('project_progress/calculation/store/', 'Admin\Project_Progress_Calculation_Controller@show')->name('projectprogress.calculations.create');
    Route::get('project_progress/calculation/', 'Admin\Project_Progress_Calculation_Controller@index')->name('projectprogress.calculations.dashboard');
    Route::POST('project_progress/calculation/', 'Admin\Project_Progress_Calculation_Controller@store')->name('projectprogress.calculations.create');

    Route::GET('project_progress/scurves/', 'Admin\ProgressCalculationSGraphController@index')->name("projectprogress.scurves.dashboard");
    Route::GET('project_progress/scurves/{id}', 'Admin\ProgressCalculationSGraphController@show')->name("projectprogress.scurves.dashboard");



    Route::get('buckets/{bucketId}', 'Admin\BucketsController@index')->where('bucketId', '[0-9]+')->name('buckets.dashboard');
    Route::resource('buckets', 'Admin\BucketsController', ['names' => [
            'index' => 'buckets.dashboard',
            'create' => 'buckets.create',
            'edit' => 'buckets.update',
            'store' => 'buckets.create',
            'update' => 'buckets.update',
            'destroy' => 'buckets.delete',
    ]]);
    Route::get('getportfolioname', 'Admin\BucketsController@getportfolioname')->name('bucket.dashboard');
    Route::get('portfolio-buckets/{id}', 'Admin\BucketsController@bucketByPortfolio')->name('bucket.dashboard');

    Route::resource('bucketfp', 'Admin\BucketfpController', ['names' => [
            'index' => 'portfolio-fp.dashboard',
            'create' => 'portfolio-fp.create',
            'edit' => 'portfolio-fp.update',
            'store' => 'portfolio-fp.create',
            'update' => 'portfolio-fp.update',
            'destroy' => 'portfolio-fp.delete',
    ]]);
    Route::get('project/{projectId}', 'Admin\ProjectController@index')->where('projectId', '[0-9]+')->name('project.dashboard');
    Route::get('getportname', 'Admin\ProjectController@getportname')->name('project.dashboard');
    Route::get('getbucket', 'Admin\ProjectController@getbucketname')->name('project.dashboard');
    Route::get('getpdesc', 'Admin\ProjectController@getpdesc')->name('project.dashboard');
    Route::resource('project', 'Admin\ProjectController', ['names' => [
            'index' => 'project.dashboard',
            'create' => 'project.create',
            'edit' => 'project.update',
            'store' => 'project.create',
            'update' => 'project.update',
            'destroy' => 'project.delete',
    ]]);
    Route::resource('projectscheduling', 'Admin\ProjectschedulingController', ['names' => [
            'index' => 'scheduling.dashboard',
            'create' => 'scheduling.create',
            'edit' => 'scheduling.update',
            'store' => 'scheduling.create',
            'update' => 'scheduling.update',
            'destroy' => 'scheduling.delete',
    ]]);
    Route::resource('projectphase', 'Admin\ProjectphaseController', ['names' => [
            'index' => 'phase.dashboard',
            'create' => 'phase.create',
            'edit' => 'phase.update',
            'store' => 'phase.create',
            'update' => 'phase.update',
            'destroy' => 'phase.delete',
    ]]);
    Route::get('projectStructure/{projectId}', 'Admin\ProjectStructureController@index')->where('projectId', '[0-9]+')->name('projectStructure.dashboard');
    Route::resource('projectStructure', 'Admin\ProjectStructureController', ['names' => [
            'index' => 'projectStructure.dashboard']]);

    Route::get('getproject-structure/{projectId}', 'Admin\ProjectStructureController@projectGraphics')->name('projectStructure.dashboard');
    Route::get('projectphase/getprojectname/{id}', 'Admin\ProjectphaseController@getprojectname')->name('phase.dashboard');
    Route::resource('projecttask', 'Admin\ProjecttaskController', ['names' => [
            'index' => 'task.dashboard',
            'create' => 'task.create',
            'edit' => 'task.update',
            'store' => 'task.create',
            'update' => 'task.update',
            'destroy' => 'task.delete',
    ]]);
    Route::get('getpname', 'Admin\ProjecttaskController@getprojectname')->name('task->dashboard');
    Route::get('getphname', 'Admin\ProjecttaskController@getphasename')->name('task->dashboard');
    Route::get('gettname', 'Admin\ProjecttaskController@gettaskname')->name('task->dashboard');
    Route::resource('projectchecklist', 'Admin\ProjectchecklistController', ['names' => [
            'index' => 'checklist.dashboard',
            'create' => 'checklist.create',
            'edit' => 'checklist.update',
            'store' => 'checklist.create',
            'update' => 'checklist.update',
            'destroy' => 'checklist.delete',
    ]]);
    Route::get('getprojectname', 'Admin\ProjectchecklistController@getprojectname')->name('checklist.dashboard');
    Route::get('getphasename', 'Admin\ProjectchecklistController@getphasename')->name('checklistdashboard');
    Route::get('gettaskname', 'Admin\ProjectchecklistController@gettaskname')->name('checklist.dashboard');
    Route::get('gettaskname', 'Admin\ProjectchecklistController@gettaskname')->name('checklist.dashboard');
    Route::get('getportfolio/{id}', 'Admin\BucketsController@getportfolio')->name('checklist.dashboard');
    Route::get('getportfolioType/{portId}', 'Admin\ProjectController@getportfolioType')->name('project.dashboard');

    /* Start Label */
    Route::resource('projectlabels', 'Admin\ProjectlabelsController', ['names' => [
            'index' => 'project.labels.dashboard',
            'create' => 'project.labels.create',
            'edit' => 'project.labels.update',
            'store' => 'project.labels.create',
            'update' => 'project.labels.update',
            'destroy' => 'project.labels.delete',
    ]]);
    Route::get('projectlabels/create', 'Admin\ProjectlabelsController@add')->name('project.labels.create');
    Route::post('projectlabels/create', 'Admin\ProjectlabelsController@create')->name('project.labels.create');
    Route::get('projectlabels/edit/{id}', 'Admin\ProjectlabelsController@edit')->name('project.labels.update');
    Route::post('projectlabels/edit/{id}', 'Admin\ProjectlabelsController@update')->name('project.labels.update');
    Route::post('projectlabels/delete/{id}', 'Admin\ProjectlabelsController@destroy')->name('project.labels.delete');



    /* End Label */
    /* Start Sprint */
    Route::resource('sprint', 'Admin\ProjectsprintController', ['names' => [
            'index' => 'sprint.dashboard',
            'create' => 'sprint.create',
            'edit' => 'sprint.update',
            'store' => 'sprint.create',
            'update' => 'sprint.update',
            'destroy' => 'sprint.delete',
    ]]);
    Route::get('sprint/create', 'Admin\ProjectsprintController@add')->name('sprint.create');
    Route::post('sprint/create', 'Admin\ProjectsprintController@create')->name('sprint.create');
    Route::get('sprint/edit/{id}', 'Admin\ProjectsprintController@edit')->name('sprint.update');
    Route::post('sprint/edit/{id}', 'Admin\ProjectsprintController@update')->name('sprint.update');
    Route::post('sprint/delete/{id}', 'Admin\ProjectsprintController@destroy')->name('sprint.delete');
    /* End Sprint */
    /* Start Sprint */
    Route::resource('component', 'Admin\ProjectcomponentController', ['names' => [
            'index' => 'component.dashboard',
            'create' => 'component.create',
            'edit' => 'component.update',
            'store' => 'component.create',
            'update' => 'component.update',
            'destroy' => 'component.delete',
    ]]);
    Route::get('component/create', 'Admin\ProjectcomponentController@add')->name('component.create');
    Route::post('component/create', 'Admin\ProjectcomponentController@create')->name('component.create');
    Route::get('component/edit/{id}', 'Admin\ProjectcomponentController@edit')->name('component.update');
    Route::post('component/edit/{id}', 'Admin\ProjectcomponentController@update')->name('component.update');
    Route::post('component/delete/{id}', 'Admin\ProjectcomponentController@destroy')->name('component.delete');
    /* End Sprint */
    /* Start Backlog */
    Route::resource('backlog', 'Admin\Backlog', ['names' => [
            'index' => 'backlog.dashboard',
            'create' => 'backlog.create',
            'edit' => 'backlog.update',
            'store' => 'backlog.create',
            'update' => 'backlog.update',
            'destroy' => 'backlog.delete',
    ]]);
    Route::get('backlog/create', 'Admin\Backlog@add')->name('backlog.create');
    Route::post('backlog/create', 'Admin\Backlog@create')->name('backlog.create');
    Route::get('backlog/edit/{id}', 'Admin\Backlog@edit')->name('backlog.update');
    Route::post('backlog/edit/{id}', 'Admin\Backlog@update')->name('backlog.update');
    Route::post('backlog/delete/{id}', 'Admin\Backlog@destroy')->name('backlog.delete');
    /* End Backlog */
    /* Start Boards */

    Route::resource('boards', 'Admin\BoardsController', ['names' => [
            'index' => 'boards.dashboard',
            'create' => 'boards.create',
            'edit' => 'boards.update',
            'store' => 'boards.create',
            'update' => 'boards.update',
            'destroy' => 'boards.delete',
    ]]);
    Route::get('boards/create', 'Admin\BoardsController@add')->name('backlog.create');
    Route::post('boards/create', 'Admin\BoardsController@create')->name('backlog.create');
    Route::get('boards/edit/{id}', 'Admin\BoardsController@edit')->name('backlog.update');
    Route::post('boards/edit/{id}', 'Admin\BoardsController@update')->name('backlog.update');
    Route::post('boards/delete/{id}', 'Admin\BoardsController@destroy')->name('backlog.delete');
    /* End Boards */

    /* Issue Start */
    Route::resource('projectissues', 'Admin\ProjectissuesController', ['names' => [
            'index' => 'project.issues.dashboard',
            'create' => 'project.issues.create',
            'edit' => 'project.issues.update',
            'store' => 'project.issues.create',
            'update' => 'project.issues.update',
            'destroy' => 'project.issues.delete',
    ]]);
    Route::get('addIssue', 'Admin\ProjectissuesController@create')->name('project.issues.create');
    Route::post('getProjectname', 'Admin\ProjectissuesController@getProjectname')->name('project.issues.dashnoard');
    Route::post('getProjectPhase', 'Admin\ProjectissuesController@getProjectPhase')->name('project.issues.dashboard');
    Route::post('getProjectTask', 'Admin\ProjectissuesController@getProjectTask')->name('project.issues.dashboard');
    Route::post('insertIssue', 'Admin\ProjectissuesController@store')->name('project.issues.create');
    Route::get('viewIssue/{id}', 'Admin\ProjectissuesController@view')->name('project.issues.view');
    Route::get('editIssue/{id}', 'Admin\ProjectissuesController@show')->name('project.issues.update');
    Route::post('editIssue/{id}', 'Admin\ProjectissuesController@update')->name('project.issues.update');
    Route::post('issueComment', 'Admin\ProjectissuesController@issueComment')->name('project.issues.view');
    Route::post('addLikeIssus', 'Admin\ProjectissuesController@addLikeIssus')->name('project.issues.view');
    Route::post('viewIssue/{id}', 'Admin\ProjectissuesController@closeIssueRequest')->name('project.issues.view');
    Route::post('issueSearch', 'Admin\ProjectissuesController@issueSearch')->name('project.issues.view');


    Route::get('issueSearch', 'Admin\ProjectissuesController@issueSearchget');


    /* Issue End */
    /* Start Configuration */
    Route::resource('configuration', 'Admin\ConfigurationController', ['names' => [
            'index' => 'configuration.dashboard',
            'create' => 'configuration.create',
            'edit' => 'configuration.update',
            'store' => 'configuration.create',
            'update' => 'configuration.update',
            'destroy' => 'configuration.delete',
    ]]);
    Route::get('configuration/edit/{id}', 'Admin\ConfigurationController@edit')->name('configuration.update');
    Route::post('configuration/edit/{id}', 'Admin\ConfigurationController@update')->name('configuration.update');
    /* End Configuration */
    Route::resource('currencies', 'Admin\CurrencyController', ['names' => [
            'index' => 'currencies.dashboard',
            'create' => 'currencies.create',
            'edit' => 'currencies.update',
            'store' => 'currencies.create',
            'update' => 'currencies.update',
            'destroy' => 'currencies.delete',
    ]]);
    Route::resource('capacityunits', 'Admin\CapacityunitsController', ['names' => [
            'index' => 'capacityUnits.dashboard',
            'create' => 'capacityUnits.create',
            'edit' => 'capacityUnits.update',
            'store' => 'capacityUnits.create',
            'update' => 'capacityUnits.update',
            'destroy' => 'capacityUnits.delete',
    ]]);
    Route::resource('periodtype', 'Admin\PeriodtypeController', ['names' => [
            'index' => 'periodType.dashboard',
            'create' => 'periodType.create',
            'edit' => 'periodType.update',
            'store' => 'periodType.create',
            'update' => 'periodType.update',
            'destroy' => 'periodType.delete',
    ]]);
    Route::resource('projecttype', 'Admin\ProjecttypesController', ['names' => [
            'index' => 'projectType.dashboard',
            'create' => 'projectType.create',
            'edit' => 'projectType.update',
            'store' => 'projectType.create',
            'update' => 'projectType.update',
            'destroy' => 'projectType.delete',
    ]]);
    Route::resource('phasetype', 'Admin\PhasetypesController', ['names' => [
            'index' => 'phaseType.dashboard',
            'create' => 'phaseType.create',
            'edit' => 'phaseType.update',
            'store' => 'phaseType.create',
            'update' => 'phaseType.update',
            'destroy' => 'phaseType.delete',
    ]]);

    Route::resource('checklisttype', 'Admin\ChecklistTypeController', ['names' => [
            'index' => 'checklistType.dashboard',
            'create' => 'checklistType.create',
            'edit' => 'checklistType.update',
            'store' => 'checklistType.create',
            'update' => 'checklistType.update',
            'destroy' => 'checklistType.delete',
    ]]);

    // portfolio structure
    Route::get('portfolioStructure/{projectId}/{portfolioId}', 'Admin\PortfoliostructureController@index')->name('portfolioStructure.dashboard');
    Route::resource('portfolioStructure', 'Admin\PortfoliostructureController', ['names' => [
            'index' => 'portfolioStructure.dashboard',
            'edit' => 'portfolioStructure.update'
    ]]);

    //route for Manual capacity planning
    Route::get('portfoliocapacity/manual-capacity', 'Admin\ManualCapacityController@dashboard')->name('portfolioCapacity-manual-data-table');
    Route::resource('manualCapacity', 'Admin\ManualCapacityController', ['names' =>
        ['index' => 'manualCapacity.dashboard',
            'create' => 'manualCapacity.create',
            'edit' => 'manualCapacity.update',
            'update' => 'manualCapacity.update',
            'store' => 'manualCapacity.create',
            'destroy' => 'manualCapacity.delete']]);
    Route::get('getBucket/{portfolioId}', 'Admin\ManualCapacityController@getBucket');
    Route::get('getCategoryGroup/{bucketId}', 'Admin\ManualCapacityController@getCategoryGroup');

    Route::resource('capacity-planning', 'Admin\CapacityPlanningController', ['names' => [
            'index' => 'portfolio-cp.dashboard',
            'show' => 'portfolio-cp.dashboard'
    ]]);
//    Route::get('capacity-planning/portfolio-planning/{portfolioId}', 'Admin\CapacityPlanningController@portfolioPlanning')->name('portfolio-cp.dashboard');
    //route for Manual financial planning
    Route::resource('manual-financial', 'Admin\ManualFinancialPlanningController');

    //route for risk management
    Route::resource('riskregister', 'Admin\RiskAnalysisController', ['names' => [
            'index' => 'risk.analysis.dashboard',
            'store' => 'qualitative_risk.create'
    ]]);
    Route::get('risk-managment-datatable', 'Admin\RiskAnalysisController@data_table')->name('risk-managment-datatable');
    Route::get('quantitative_risk/{id}', 'Admin\RiskAnalysisController@getQuantitativeData')->name('quantitative_risk.view');
    Route::get('qualitative_risk/{id}', 'Admin\RiskAnalysisController@getQualitativeData')->name('qualitative_risk.view');

    Route::get('quantitativeriskContext/{id}/edit', 'Admin\RiskAnalysisController@editQuantitativeContext')->name('quantitativerisk.update');
    Route::put('quantitativeriskContext/{id}', 'Admin\RiskAnalysisController@updateQuntitativeContext')->name('quantitativeRisk.update');

    Route::get('qualitativeriskContext/{id}/edit', 'Admin\RiskAnalysisController@editQualitativeContext')->name('qualitativerisk.update');
    Route::put('qualitativeriskContext/{id}', 'Admin\RiskAnalysisController@updateQualitativeContext')->name('qualitativeRisk.update');


    Route::get('mailtemplate', 'Admin\RiskAnalysisController@mailtemplate');


    Route::get('qualitative_risk', 'Admin\RiskAnalysisController@createQualitative')->name('qualitative_risk.create');
    Route::get('qualitative_risk/{id}/edit', 'Admin\RiskAnalysisController@edit')->name('qualitative_risk.update');
    Route::put('qualitative_risk/{id}', 'Admin\RiskAnalysisController@update')->name('qualitative_risk.update');
    Route::delete('qualitative_risk/{id}', 'Admin\RiskAnalysisController@deleteQualitative')->name('qualitative_risk.delete');
    Route::get('quantitative_risk', 'Admin\RiskAnalysisController@createQuantitative')->name('quantitative_risk.create');
    Route::post('quantitative_risk/store', 'Admin\RiskAnalysisController@storeQuantitative')->name('quantitative_risk.create');
    Route::get('quantitative_risk/{id}/edit', 'Admin\RiskAnalysisController@editQuantitative')->name('quantitative_risk.update');
    Route::put('quantitative_risk/{id}', 'Admin\RiskAnalysisController@updateQuantitative')->name('quantitative_risk.update');
    Route::delete('quantitative_risk/{id}', 'Admin\RiskAnalysisController@deleteQuantitative')->name('quantitative_risk.delete');
    Route::get('getprojectDescription/{projectId}', 'Admin\RiskAnalysisController@getProjectDesc')->name('risk.analysis.dashboard');
    Route::get('addMatrix', 'Admin\RiskAnalysisController@addMatrix')->name('matrixScore.dashboard');
    Route::get('getRiskScore/{impact}/{probability}', 'Admin\RiskAnalysisController@getRiskScore')->name('risk.analysis.dashboard');
    Route::get('getQuantitativeRiskScore/{expectedloss}', 'Admin\RiskAnalysisController@getQuantitativeRiskScore')->name('risk.analysis.dashboard');
    Route::get('QuantitativeRiskScore', 'Admin\RiskAnalysisController@QuantitativeRiskScore')->name('quantitativeScore.dashboard');
    Route::put('update_QuantitativeriskScore/{id}', 'Admin\RiskAnalysisController@updateQuantitaiveRiskScore')->name('quantitativeScore.update');
    Route::put('update_QualitativeriskScore/{id}', 'Admin\RiskAnalysisController@updateQualitativeRiskScore')->name('qualitative_risk.riskscore.update');

    Route::resource('planningunit', 'Admin\PlanningunitController', ['names' => [
            'index' => 'planningUnit.dashboard',
            'create' => 'planningUnit.create',
            'edit' => 'planningUnit.update',
            'store' => 'planningUnit.create',
            'update' => 'planningUnit.update',
            'destroy' => 'planningUnit.delete',
    ]]);
    Route::resource('planningtype', 'Admin\PlanningtypeController', ['names' => [
            'index' => 'planningType.dashboard',
            'create' => 'planningType.create',
            'edit' => 'planningType.update',
            'store' => 'planningType.create',
            'update' => 'planningType.update',
            'destroy' => 'planningType.delete',
    ]]);
    Route::resource('costingtype', 'Admin\CostingtypeController', ['names' => [
            'index' => 'costingType.dashboard',
            'create' => 'costingType.create',
            'edit' => 'costingType.update',
            'store' => 'costingType.create',
            'update' => 'costingType.update',
            'destroy' => 'costingType.delete',
    ]]);
    Route::resource('collectiontype', 'Admin\CollectiontypeController', ['names' => [
            'index' => 'collectionType.dashboard',
            'create' => 'collectionType.create',
            'edit' => 'collectionType.update',
            'store' => 'collectionType.create',
            'update' => 'collectionType.update',
            'destroy' => 'collectionType.delete',
    ]]);
    Route::resource('viewtype', 'Admin\ViewtypeController', ['names' => [
            'index' => 'viewType.dashboard',
            'create' => 'viewType.create',
            'edit' => 'viewType.update',
            'store' => 'viewType.create',
            'update' => 'viewType.update',
            'destroy' => 'viewType.delete',
    ]]);
    Route::resource('personresponsible', 'Admin\PersonresponsibleController', ['names' => [
            'index' => 'personResponsible.dashboard',
            'create' => 'personResponsible.create',
            'edit' => 'personResponsible.update',
            'store' => 'personResponsible.create',
            'update' => 'personResponsible.update',
            'destroy' => 'personResponsible.delete',
    ]]);
    Route::resource('departmenttype', 'Admin\DepartmenttypeController', ['names' => [
            'index' => 'departmentType.dashboard',
            'create' => 'departmentType.create',
            'edit' => 'departmentType.update',
            'store' => 'departmentType.create',
            'update' => 'departmentType.update',
            'destroy' => 'departmentType.delete',
    ]]);
    Route::resource('costcentretype', 'Admin\CostcentretypeController');
    Route::resource('factorycalendar', 'Admin\FactorycalendarController', ['names' => [
            'index' => 'factoryCalendar.dashboard',
            'create' => 'factoryCalendar.create',
            'edit' => 'factoryCalendar.update',
            'store' => 'factoryCalendar.create',
            'update' => 'factoryCalendar.update',
            'destroy' => 'factoryCalendar.delete',
    ]]);
    Route::resource('location', 'Admin\LocationController', ['names' => [
            'index' => 'location.dashboard',
            'create' => 'location.create',
            'edit' => 'location.update',
            'store' => 'location.create',
            'update' => 'location.update',
            'destroy' => 'location.delete',
    ]]);
    Route::resource('projectmilestone', 'Admin\ProjectmilestoneController', ['names' => [
            'index' => 'projectmilestone.dashboard',
            'create' => 'projectmilestone.create',
            'edit' => 'projectmilestone.update',
            'store' => 'projectmilestone.create',
            'update' => 'projectmilestone.update',
            'destroy' => 'projectmilestone.delete',
    ]]);

    Route::post('projectcostplan/{module}/store', 'Admin\ProjectcostplanController@store')->name('costplan.module.create');
    Route::post('projectcostplan/{module}/edit/{id}', 'Admin\ProjectcostplanController@update')->name('costplan.module.update');
    Route::post('projectcostplan/{module}/delete/{id}', 'Admin\ProjectcostplanController@destroy')->name('costplan.module.delete');
    Route::get('projectcostplan/{id}', 'Admin\ProjectcostplanController@index')->name('costplan.dashboard');
    Route::post('projectcostplan/project/{id}', 'Admin\ProjectcostplanController@show')->name('costplan.dashboard.ajax');
    Route::get('projectcostplan/{module}/{id}', 'Admin\ProjectcostplanController@getModule')->name('costplan.module.dashboard');
    Route::post('projectcostplan/materialdata/{id}', 'Admin\ProjectcostplanController@get_material_details')->name('costplan.module.dashboard');
    Route::post('projectcostplan/purchaseorderdata/{id}', 'Admin\ProjectcostplanController@get_po_details')->name('costplan.module.dashboard');
    Route::post('projectcostplan/activity/{dummy}', 'Admin\ProjectcostplanController@get_activity_rate')->name('costplan.module.dashboard');
    Route::post('projectcostplan/requisition/{dummy}', 'Admin\ProjectcostplanController@get_unit_rate')->name('costplan.module.dashboard');
    Route::post('projectcostplan/taskassignement/{dummy}', 'Admin\ProjectcostplanController@get_task_asignee')->name('costplan.module.dashboard');
    Route::post('projectcostplan/getresource/{dummy}', 'Admin\ProjectcostplanController@get_resource_name')->name('costplan.module.dashboard');

  
    Route::resource('projectcostplan', 'Admin\ProjectcostplanController', ['names' => [
            'index' => 'costplan.dashboard',
    ]]);
    Route::resource('resourceloading', 'Admin\ResourceLoadingController', ['names' => [
            'index' => 'resource.loading.dashboard',
            'show' => 'resource.loading.dashboard',
    ]]);
    Route::resource('resourceavailability', 'Admin\ResourceAvailabilityController', ['names' => [
            'index' => 'resource.availability.dashboard',
            'show' => 'resource.availability.dashboard',
    ]]);
    Route::resource('resourcedemandvsasssigned', 'Admin\ResourceDemandvsSupplyController', ['names' => [
            'index' => 'resource.demandvsasssigned.dashboard',
            'show' => 'resource.demandvsasssigned.dashboard',
    ]]);
    Route::get('resourceoverview/{id}', 'Admin\ResourceOverviewController@index')->name('resource.overview.dashboard');
    Route::post('resourceoverview/project/{id}', 'Admin\ResourceOverviewController@getProjectDetails')->name('resource.overview.dashboard');
    Route::post('resourceoverview/resource/{id}', 'Admin\ResourceOverviewController@getResourceDetails')->name('resource.overview.dashboard');
    Route::resource('resourceoverview', 'Admin\ResourceOverviewController', ['names' => [
            'index' => 'resource.overview.dashboard',
    ]]);
    Route::resource('assignroletoperson', 'Admin\AssignRoleController', ['names' => [
            'index' => 'assign.roleTo.person.dashboard',
            'create' => 'assign.roleTo.person.create',
            'edit' => 'assign.roleTo.person.update',
            'store' => 'assign.roleTo.person.create',
            'update' => 'assign.roleTo.person.update',
            'destroy' => 'assign.roleTo.person.delete',
    ]]);
    Route::get('getrole', 'Admin\AssignRoleController@getrole');
    Route::get('getroletype', 'Admin\AssignRoleController@getroletype');
    Route::resource('createrole', 'Admin\CreateRoleController', ['names' => [
            'index' => 'createrole.dashboard',
            'create' => 'createrole.create',
            'edit' => 'createrole.update',
            'store' => 'createrole.create',
            'update' => 'createrole.update',
            'destroy' => 'createrole.delete',
    ]]);
    Route::resource('taskassign', 'Admin\TaskAssignementController', ['names' => [
            'index' => 'taskassign.dashboard',
            'create' => 'taskassign.create',
            'edit' => 'taskassign.update',
            'store' => 'taskassign.create',
            'update' => 'taskassign.update',
            'destroy' => 'taskassign.delete',
    ]]);
    Route::resource('personassignmenttotask', 'Admin\PersonAssignmentController', ['names' => [
            'index' => 'person.assignment.toTask.dashboard',
            'create' => 'person.assignment.toTask.create',
            'edit' => 'person.assignment.toTask.update',
            'store' => 'person.assignment.toTask.create',
            'update' => 'person.assignment.toTask.update',
            'destroy' => 'person.assignment.toTask.delete',
    ]]);
    Route::get('getname', 'Admin\PersonAssignmentController@gettaskname')->name('personassignmenttotask.ajax');
    Route::get('getresname', 'Admin\PersonAssignmentController@getRes')->name('personassignmenttotask.ajax');
    Route::get('getPRole', 'Admin\PersonAssignmentController@getRole')->name('personassignmenttotask.ajax');
    Route::get('getPtask', 'Admin\PersonAssignmentController@getTask')->name('personassignmenttotask.ajax');
    Route::get('getRoledesc', 'Admin\PersonAssignmentController@getRoledesc')->name('personassignmenttotask.ajax');
    Route::resource('projectresourceplanning', 'Admin\ProjectresourceplanController', ['names' => [
            'index' => 'resourceplanning.dashboard',
    ]]);

    Route::get('portfolioGraphics/{projectId}/{portId}', 'Admin\PortfolioGraphicsController@index')->name('portfolio-cp.graphics.dashboard');
    Route::get('portfolioGraphics/{portId}', 'Admin\PortfolioGraphicsController@getCapacityPlanningGraphics')->name('portfoliographic.ajax');
    Route::get('portfolioGraphics/', 'Admin\PortfolioGraphicsController@index')->name('portfolio-cp.graphics.dashboard');
    Route::resource('portfoliocapacityplanning', 'Admin\PortfolioCapacityPlanningController', ['names' => [
            'index' => 'portfolio-cp.common.dashboard',
            'create' => 'portfolio-cp.create',
            'edit' => 'portfolio-cp.update',
            'store' => 'portfolio-cp.create',
            'update' => 'portfolio-cp.update',
            'destroy' => 'portfolio-cp.delete',
    ]]);

    Route::get('getlowerbuckets/{portfolioId}', 'Admin\ProjectController@getlowerbuckets')->name('project.getlowerbuckets.ajax');

    Route::resource('portfolioresourceplanning', 'Admin\PortfolioresourceplanningController');
    Route::post('getProjectRoles/{id}', 'Admin\TaskAssignementController@show');
    Route::post('getRolesDesc/{id}', 'Admin\TaskAssignementController@getRoleDesc');

    //add, update, delete
    Route::get('projectbudget/{module}', 'Admin\ProjectBudgetController@create')->name('budget.create');
    Route::post('projectbudget/{module}/store', 'Admin\ProjectBudgetController@store')->name('budget.create');
    Route::get('projectbudget/{module}/edit/{id}', 'Admin\ProjectBudgetController@edit')->name('budget.update');
    Route::post('projectbudget/{module}/update/{id}', 'Admin\ProjectBudgetController@update')->name('budget.update');
    Route::post('projectbudget/{module}/delete/{id}', 'Admin\ProjectBudgetController@destroy')->name('budget.delete');
    Route::get('projectbudget/{module}/delete/{id}', 'Admin\ProjectBudgetController@destroy')->name('budget.delete');
    Route::get('getcurrentbudget/{project_id}', 'Admin\ProjectBudgetController@getcurrentbudget')->name('budget.current.dashboard');
    Route::get('getproject/{project_id}', 'Admin\ProjectBudgetController@getproject')->name('budget.dashboard');
    //index
    Route::resource('originalbudget', 'Admin\ProjectBudgetController', ['names' => [
            'index' => 'budget.overview.dashboard']]);
    Route::get('supplementbudget', 'Admin\ProjectBudgetController@supplementBudget')->name('budget.supplement.dashboard');
    Route::get('returnbudget', 'Admin\ProjectBudgetController@returnBudget')->name('budget.return.dashboard');
    Route::get('currentbudget', 'Admin\ProjectBudgetController@currentBudget')->name('budget.current.dashboard');

    //Route::post('getpackages','Admin\PortfoliostructureController@getpackages');
    //Route::get('portfolioStructure/getpackages/{val}', 'Admin\PortfoliostructureController@getpackages');
    //route for Customer Master
    Route::resource('customer_master', 'Admin\CustomerMasterController', ['names' => [
            'index' => 'customer_master.dashboard',
            'create' => 'customer_master.create',
            'edit' => 'customer_master.update',
            'store' => 'customer_master.create',
            'update' => 'customer_master.update',
            'destroy' => 'customer_master.delete',
    ]]);

    Route::resource("customer_number_range", 'Admin\CustomerNumberRangeController', ['names' => [
            'index' => 'customerNumber.dashboard',
            'create' => 'customerNumber.create',
            'edit' => 'customerNumber.update',
            'store' => 'customerNumber.create',
            'update' => 'customerNumber.update',
            'destroy' => 'customerNumber.delete',
    ]]);

    Route::resource("project_number_range", 'Admin\ProjectNumberRangeController', ['names' => [
            'index' => 'projectNumber.dashboard',
            'create' => 'projectNumber.create',
            'edit' => 'projectNumber.update',
            'store' => 'projectNumber.create',
            'update' => 'projectNumber.update',
            'destroy' => 'projectNumber.delete',
    ]]);

    Route::get('customer_master_exportcsv', 'Admin\CustomerMasterController@export_cs')->name("customer_master.export.csv");
    Route::get('customer_master_importcsv', 'Admin\CustomerMasterController@importExport')->name("customer_master.import");

    Route::post('customer_master_importExcel', 'Admin\CustomerMasterController@importExcel')->name("customermaster.import.csv");

    //route for Customer Inquiry
    Route::resource('customer_inquiry', 'Admin\CustomerInquiryController', ['names' => [
            'index' => 'customer_inquiry.dashboard',
            'create' => 'customer_inquiry.create',
            'edit' => 'customer_inquiry.update',
            'show' => 'customer_inquiry.dashboard',
            'store' => 'customer_inquiry.create',
            'update' => 'customer_inquiry.update',
            'destroy' => 'customer_inquiry.delete',
    ]]);
    Route::post('customer_inquiry/store', 'Admin\CustomerInquiryController@store')->name('customer_inquiry.create');
    Route::post('customer_inquiry/update/{id}', 'Admin\CustomerInquiryController@update')->name('customer_inquiry.update');
    Route::resource('inquiry_type', 'Admin\InquiryTypeController', ['names' => [
            'index' => 'inquiry_type.dashboard',
            'create' => 'inquiry_type.create',
            'edit' => 'inquiry_type.create',
            'store' => 'inquiry_type.create',
            'update' => 'inquiry_type.update',
            'destroy' => 'inquiry_type.delete',
    ]]);
    Route::resource('salesregion', 'Admin\SalesRegionController', ['names' => [
            'index' => 'salesRegion.dashboard',
            'create' => 'salesRegion.create',
            'edit' => 'salesRegion.create',
            'store' => 'salesRegion.create',
            'update' => 'salesRegion.update',
            'destroy' => 'salesRegion.delete',
    ]]);
    Route::resource('salesorganization', 'Admin\Sales_Organization', ['names' => [
            'index' => 'salesOrganization.dashboard',
            'create' => 'salesOrganization.create',
            'edit' => 'salesOrganization.create',
            'store' => 'salesOrganization.create',
            'update' => 'salesOrganization.update',
            'destroy' => 'salesOrganization.delete',
    ]]);
    Route::delete('customer_item/delete_item/{id}', 'Admin\CustomerInquiryController@deleteItem');
    Route::get('customer_inquiry_exportcsv', 'Admin\CustomerInquiryController@export_cs')->name('customer_inquiry.export.csv');
    Route::resource("inquirynumber_range", 'Admin\InquiryNumberRange', ['names' => [
            'index' => 'inquiryNumber.dashboard',
            'create' => 'inquiryNumber.create',
            'edit' => 'inquiryNumber.update',
            'store' => 'inquiryNumber.create',
            'update' => 'inquiryNumber.update',
            'destroy' => 'inquiryNumber.delete',
    ]]);
    Route::get('getMaterialDesc/{id}', 'Admin\CustomerInquiryController@getMaterialDescription');
    Route::get('getCustomerName/{id}', 'Admin\CustomerInquiryController@getCustomerName');
    Route::resource('reasonRejection', 'Admin\RejectionController', ['names' => [
            'index' => 'reasonRejection.dashboard',
            'create' => 'reasonRejection.create',
            'edit' => 'reasonRejection.create',
            'store' => 'reasonRejection.create',
            'update' => 'reasonRejection.update',
            'destroy' => 'reasonRejection.delete',
    ]]);
    //route for PDF for customer inquiry
    Route::get('pdfview', array('as' => 'customer_inquiry.export.pdf', 'uses' => 'Admin\CustomerInquiryController@pdfview'));


    //route for quotation
    Route::resource('quotation', 'Admin\QuotationController', ['names' => [
            'index' => 'quotation.dashboard',
            'create' => 'quotation.create',
            'edit' => 'quotation.create',
            'show' => 'quotation.dashboard',
            'store' => 'quotation.create',
            'update' => 'quotation.update',
            'destroy' => 'quotation.delete',
    ]]);
    Route::post('quotation/store', 'Admin\QuotationController@store')->name("quotation.create");
    Route::post('quotation/update/{id}', 'Admin\QuotationController@update')->name("quotation.update");
    Route::delete('quotation_item/delete_item/{id}', 'Admin\QuotationController@deleteItem')->name("quotation.delete");
    Route::resource("quotationNumber_range", 'Admin\QuotationNumberRangeController', ['names' => [
            'index' => 'quotationNumber.dashboard',
            'create' => 'quotationNumber.create',
            'edit' => 'quotationNumber.update',
            'store' => 'quotationNumber.create',
            'update' => 'quotationNumber.update',
            'destroy' => 'quotationNumber.delete',
    ]]);
    Route::get('refinquiry', 'Admin\QuotationController@create_ref_inquiry')->name("quotation.create");
    Route::post('insertRefinquiry', 'Admin\QuotationController@insert_inquiry_to_quotation')->name("quotation.create");

    //route for PDF for quotation
    Route::get('viewQuotation/{id}', 'Admin\QuotationController@viewpdf')->name("quotation.pdf.view");
    Route::get('quotationpdfview/{id}', array('as' => 'quotation.export.pdf', 'uses' => 'Admin\QuotationController@pdfview'));

    //route for sales_order
    Route::resource('sales_order', 'Admin\SalesOrderController', ['names' => [
            'index' => 'salesorder.dashboard',
            'create' => 'salesorder.create',
            'edit' => 'salesorder.update',
            'store' => 'salesorder.create',
            'update' => 'salesorder.update',
            'destroy' => 'salesorder.delete',
    ]]);
    Route::resource('billing_type', 'Admin\BillingTypeController', ['names' => [
            'index' => 'billingType.dashboard',
            'create' => 'billingType.create',
            'edit' => 'billingType.update',
            'store' => 'billingType.create',
            'update' => 'billingType.update',
            'destroy' => 'billingType.delete',
    ]]);
    Route::post('sales_order/update', 'Admin\SalesOrderController@update')->name("salesorder.update");
    Route::post('sales_order/store', 'Admin\SalesOrderController@store')->name("salesorder.create");
    Route::delete('sales_item/delete_item/{id}', 'Admin\SalesOrderController@deleteItem')->name("salesorder.delete");
    Route::get('sales_order/{sales_order}/send', 'Admin\SalesOrderController@send')->name("salesorder.mail.send");
    Route::resource("salesorderNumber_range", 'Admin\SalesOrderNumberRangeController', ['names' => [
            'index' => 'salesorderNumber.dashboard',
            'create' => 'salesorderNumber.create',
            'edit' => 'salesorderNumber.update',
            'store' => 'salesorderNumber.create',
            'update' => 'salesorderNumber.update',
            'destroy' => 'salesorderNumber.delete',
    ]]);
    Route::get('sales_order/{id}/approval/{token}', 'Admin\SalesOrderController@show')->name("salesorder.approval.dashboard"); //approval page
    Route::get('sales_order/{id}/show', 'Admin\SalesOrderController@show')->name("salesorder.approval.update"); //approval edit page
    Route::post('sales_order/approval/{id}', 'Admin\SalesOrderController@approval')->name("salesorder.approval.mailcycle.view"); //start mail cycle
    Route::post('sales_order/approval/{id}/{token}', 'Admin\SalesOrderController@approval')->name("salesorder.approval.approve"); //approve
    Route::get('sales_order/reject/{id}', 'Admin\SalesOrderController@reject')->name("salesorder.approval.reject"); //reject

    Route::get('refquotation', 'Admin\SalesOrderController@create_ref_quotation')->name("salesorder.create");

    Route::post('insertRefquotation', 'Admin\SalesOrderController@insert_quotation_to_salesorder')->name("salesorder.create");
    //Route::resource('sales_item', 'Admin\salesItemControler');//not being used
    //for purchase 
    Route::resource('purchase_requisition', 'Admin\PurchaseRequisitionController', ['names' => [
            'index' => 'purchase_requisition.dashboard',
            'create' => 'purchase_requisition.create',
            'edit' => 'purchase_requisition.update',
            'show' => 'purchase_requisition.dashboard',
            'store' => 'purchase_requisition.create',
            'update' => 'purchase_requisition.update',
            'destroy' => 'purchase_requisition.delete',
    ]]);
    Route::post('purchase_requisition/store', 'Admin\PurchaseRequisitionController@store')->name('purchase_requisition.create');
    Route::post('purchase_requisition/approval/{id}', 'Admin\PurchaseRequisitionController@approval')->name("purchase_requisition.approval.mailcycle.dashboard"); //start mail cycle
    Route::post('purchase_requisition/approval/{id}/{token}', 'Admin\PurchaseRequisitionController@approval')->name("purchase_requisition.approval.approve"); //approve
    Route::get('purchase_requisition/{id}/approval/{token}', 'Admin\PurchaseRequisitionController@show')->name("purchase_requisition.approval.view"); //approval page
    Route::get('purchase_requisition/{id}/show', 'Admin\PurchaseRequisitionController@show')->name("purchase_requisition.approval.update"); //approval edit page
    Route::get('purchase_requisition/reject/{id}', 'Admin\PurchaseRequisitionController@reject')->name("purchase_requisition.approval.reject"); //reject
    Route::post('purchase_requisition/update', 'Admin\PurchaseRequisitionController@update')->name("purchase_requisition.update");
    Route::resource('purchase_item', 'Admin\PurchaseItemController', ['names' => [
            'destroy' => 'purchase_requisition.item.delete',
    ]]);
    Route::post('getApprovername', 'Admin\PurchaseRequisitionController@getApproverName')->name("purchase_requisition.dashboard");

    //Route for purchase order
    Route::resource('purchase_order', 'Admin\PurchaseOrderController', ['names' => [
            'index' => 'purchase_order.dashboard',
            'create' => 'purchase_order.create',
            'edit' => 'purchase_order.update',
            'show' => 'purchase_order.dasboard',
            'store' => 'purchase_order.create',
            'update' => 'purchase_order.update',
            'destroy' => 'purchase_order.delete',
    ]]);
    Route::get('purchase_order/{id}/approval/{token}', 'Admin\PurchaseOrderController@show')->name('purchase_order.dashboard');
    Route::get('purchase_order/{id}/show', 'Admin\PurchaseOrderController@show')->name('purchase_order.dashboard');
    Route::get('purchase_order/reject/{id}', 'Admin\PurchaseOrderController@reject')->name('purchase_order.approval.reject');
    Route::post('purchase_order/update', 'Admin\PurchaseOrderController@update')->name('purchase_order.update');
    Route::post('purchase_order/store', 'Admin\PurchaseOrderController@store')->name('purchase_order.create');
    Route::post('purchase_order/approval/{id}', 'Admin\PurchaseOrderController@approval')->name('purchase_order.approval.approve');
    Route::post('purchase_order/approval/{id}/{token}', 'Admin\PurchaseOrderController@approval')->name('purchase_order.approval.approve');
    Route::delete('purchaseorder_item/delete_item/{id}', 'Admin\PurchaseOrderController@deleteItem')->name('purchase_order.item.delete');
    Route::post('getApprovername', 'Admin\PurchaseRequisitionController@getApproverName')->name('purchase_order.dashboard');

    // Route for Category
    Route::resource('category', 'Admin\CategoryController', ['names' => [
            'index' => 'category.dashboard',
            'create' => 'category.create',
            'edit' => 'category.update',
            'store' => 'category.create',
            'update' => 'category.update',
            'destroy' => 'category.delete',
    ]]);

    // Route for Group
    Route::resource('group', 'Admin\GroupController', ['names' => [
            'index' => 'group.dashboard',
            'create' => 'group.create',
            'edit' => 'group.update',
            'store' => 'group.create',
            'update' => 'group.update',
            'destroy' => 'group.delete',
    ]]);

    // Route for View
    Route::resource('view', 'Admin\ViewController', ['names' => [
            'index' => 'view.dashboard',
            'create' => 'view.create',
            'edit' => 'view.update',
            'store' => 'view.create',
            'update' => 'view.update',
            'destroy' => 'view.delete',
    ]]);

    //Route for create contract 
    Route::resource('contract', 'Admin\CreateContractController', ['names' => [
            'index' => 'contract.dashboard',
            'create' => 'contract.create',
            'edit' => 'contract.update',
            'show' => 'contract.dashboard',
            'store' => 'contract.create',
            'update' => 'contract.update',
            'destroy' => 'contract.delete',
    ]]);
    Route::post('contract/store', 'Admin\CreateContractController@store')->name("contract.create");
    Route::post('contract/update', 'Admin\CreateContractController@update')->name("contract.update");
    Route::resource('contract_item', 'Admin\CreateContractController');
    Route::post('insertRefPurchaseOrder', 'Admin\CreateContractController@insert_Purchase_Order_to_contract')->name("contract.create");
    Route::get('refpurchaseorder', 'Admin\CreateContractController@create_ref_purchase_order')->name("contract.create");
    Route::delete('contract_item/delete_item/{id}', 'Admin\ContractItemController@deleteItem')->name("contract.item.delete");

    //route for vendor
    Route::resource('vendor', 'Admin\VendorController', ['names' => [
            'index' => 'vendor.dashboard',
            'create' => 'vendor.create',
            'edit' => 'vendor.update',
            'store' => 'vendor.create',
            'update' => 'vendor.update',
            'destroy' => 'vendor.delete',
    ]]);
    Route::get('vendor_exportcsv', 'Admin\VendorController@export_cs')->name("vendor.export.csv");

    Route::get('vendor_importcsv', 'Admin\VendorController@importExport')->name("vendor.import.dashboard");

    Route::post('importExcel', 'Admin\VendorController@importExcel')->name("vendor.import.excel");

    Route::resource('addBank', 'Admin\BankController', ['names' => [
            'index' => 'bank.dashboard',
            'create' => 'bank.create',
            'edit' => 'bank.update',
            'store' => 'bank.create',
            'update' => 'bank.update',
            'destroy' => 'bank.delete',
    ]]);

    //route for matrial master
    Route::resource('material_master', 'Admin\MaterialMasterController', ['names' => [
            'index' => 'material_master.dashboard',
            'create' => 'material_master.create',
            'edit' => 'material_master.update',
            'store' => 'material_master.create',
            'update' => 'material_master.update',
            'destroy' => 'material_master.delete',
    ]]);

    //route for verification
    Route::resource('invoice_verification', 'Admin\InvoiceVerificationController', ['names' => [
            'index' => 'invoice_verification.dashboard',
            'create' => 'invoice_verification.create',
            'store' => 'invoice_verification.create',
            'destroy' => 'invoice_verification.reversal',
    ]]);
    Route::get('invoice_verification_type/{ttype}/{id}', 'Admin\InvoiceVerificationController@getData')->name('invoice_verification.dashboard');
    Route::get('invoice_verification_type/{ttype}/{id}/{item}', 'Admin\InvoiceVerificationController@getItemData')->name('invoice_verification.dashboard');
    Route::get('api/invPurchaseitems/{purchase_order}', 'Admin\InvoiceVerificationController@getPurchaseitemList')->name('invoice_verification.dashboard');
    Route::post('api/invPurchaseitem/{purchase_order}/{item}', 'Admin\InvoiceVerificationController@getPurchaseitem')->name('invoice_verification.dashboard');
    Route::get('invoiceverificaton-data-table', 'Admin\InvoiceVerificationController@data_table')->name('invoice_verification.dashboard');
    Route::post('invoiceData/ajaxrequest', 'Admin\InvoiceVerificationController@pop_upData');
    // route for Issue #268 Revenue forecast module
    Route::resource('revenueforcasting', 'Admin\RevenueforecastController', ['names' => [
            'index' => 'revenueforcasting.dashboard',
            'create' => 'revenueforcasting.create',
            'edit' => 'revenueforcasting.update',
            'store' => 'revenueforcasting.create',
            'destroy' => 'revenueforcasting.delete',
    ]]);
    Route::post('revenueforcast/project/{id}', 'Admin\RevenueforecastController@show')->name("revenueforcasting.dashboard");
    Route::post('revenueforcast/project/{id}/adjust', 'Admin\RevenueforecastController@adjust')->name("revenueforcasting.dashboard");
    Route::post('revenueforcast/store/{id}', 'Admin\RevenueforecastController@store')->name("revenueforcasting.update");


    //route for cost forecasting 
    Route::resource('costforcasting', 'Admin\CostForecastingController', ['names' => [
            'index' => 'costforcasting.dashboard',
            'create' => 'costforcasting.create',
            'edit' => 'costforcasting.update',
            'store' => 'costforcasting.create',
            'destroy' => 'costforcasting.delete',
    ]]);
    Route::get('projectdata/{id}', 'Admin\CostForecastingController@projectData')->name('costforcasting.dashboard');
    Route::post('costforcast/project/{id}', 'Admin\CostForecastingController@show')->name('costforcasting.dashboard');
    Route::post('costforcast/project/{id}/adjust', 'Admin\CostForecastingController@adjust')->name('costforcasting.dashboard');
    Route::post('costforcast/store/{id}', 'Admin\CostForecastingController@store')->name('costforcasting.create.update');
    Route::get('costforecast-data-table', 'Admin\CostForecastingController@data_table')->name('costforecast-data-table');
    Route::post('costData/pop_upData', 'Admin\CostForecastingController@pop_upData')->name('costData/ajaxrequest');
    //route for Demand Forecast
    Route::resource('demandforecasting', 'Admin\DemandForecastController', ['names' => [
            'index' => 'demandforecasting.dashboard',
            'create' => 'demandforecasting.create',
            'edit' => 'demandforecasting.update',
            'store' => 'demandforecasting.create',
            'destroy' => 'demandforecasting.destroy',
    ]]);
    Route::get('demandforecast/projectdata/{id}', 'Admin\DemandForecastController@projectData')->name('demandforecasting.dashboard');
    Route::post('demandforecast/project/{id}', 'Admin\DemandForecastController@show')->name('demandforecasting.dashboard');
    Route::post('demandforecast/project/{id}/adjust', 'Admin\DemandForecastController@adjust')->name('demandforecasting.dashboard');
    Route::post('demandforecast/store/{id}', 'Admin\DemandForecastController@store')->name('demandforecasting.create.update');
    Route::get('demandforecast-data-table', 'Admin\DemandForecastController@data_table')->name('demandforecast-data-table');
    Route::post('demandData/ajaxrequest', 'Admin\DemandForecastController@pop_upData')->name('demandforecast-data-table');
    //route for goods receipt 
    Route::resource('goods_receipt', 'Admin\GoodsReceiptController', ['names' => [
            'index' => 'goods_receipt.dashboard',
            'create' => 'goods_receipt.create',
            'store' => 'goods_receipt.create',
            'destroy' => 'goods_receipt.reversal',
    ]]);
    Route::resource('gl-accounts', 'Admin\GlAccountsController', ['names' => [
            'index' => 'glAccounts.dashboard',
            'create' => 'glAccounts.create',
            'edit' => 'glAccounts.update',
            'store' => 'glAccounts.create',
            'update' => 'glAccounts.update',
            'destroy' => 'glAccounts.delete',
    ]]);
    Route::resource('GlAccount', 'Admin\GlController');
    Route::resource('GlAccountTax', 'Admin\GlAccountTaxController');
    Route::resource('GlAccountFreight', 'Admin\GlAccountFreightController');
    Route::resource('GlAccountDownPayment', 'Admin\GlAccountPaymentController');

    Route::get('gl-accounts-data-table', 'Admin\GlAccountsController@data_table')->name('gl-accounts-data-table');

    Route::post('gl-account-flag-type-save', 'Admin\GlAccountsController@get_gl_account_type_save')->name('gl-account-flag-type-save');


    //route for get purchaseitem
    Route::get('api/purchaseitems/{purchase_order}', 'Admin\GoodsReceiptController@getPurchaseitemList')->name('goods_receipt.dashboard');
    Route::post('api/purchaseitem/{purchase_order}/{item}', 'Admin\GoodsReceiptController@getPurchaseitem')->name('goods_receipt.dashboard');

    Route::resource('addCategory', 'Admin\MaterialCategoryController', ['names' => [
            'index' => 'materialCategory.dashboard',
            'create' => 'materialCategory.create',
            'edit' => 'materialCategory.update',
            'store' => 'materialCategory.create',
            'update' => 'materialCategory.update',
            'destroy' => 'materialCategory.delete',
    ]]);
    Route::resource('addGroup', 'Admin\MaterialGroupController', ['names' => [
            'index' => 'materialGroup.dashboard',
            'create' => 'materialGroup.create',
            'edit' => 'materialGroup.update',
            'store' => 'materialGroup.create',
            'update' => 'materialGroup.update',
            'destroy' => 'materialGroup.delete',
    ]]);
    Route::resource('addUnitOfMeasure', 'Admin\UnitOfMeasureController', ['names' => [
            'index' => 'unitMeasure.dashboard',
            'create' => 'unitMeasure.create',
            'edit' => 'unitMeasure.update',
            'store' => 'unitMeasure.create',
            'update' => 'unitMeasure.update',
            'destroy' => 'unitMeasure.delete',
    ]]);
    Route::resource('addOrderingUnit', 'Admin\OrderingUnitController', ['names' => [
            'index' => 'orderUnit.dashboard',
            'create' => 'orderUnit.create',
            'edit' => 'orderUnit.update',
            'store' => 'orderUnit.create',
            'update' => 'orderUnit.update',
            'destroy' => 'orderUnit.delete',
    ]]);
    Route::resource('addMilestone', 'Admin\MilestoneTypeController', ['names' => [
            'index' => 'milestoneType.dashboard',
            'create' => 'milestoneType.create',
            'edit' => 'milestoneType.update',
            'store' => 'milestoneType.create',
            'update' => 'milestoneType.update',
            'destroy' => 'milestoneType.delete',
    ]]);

    //route for get state
    Route::get('api/state/{countryId}', 'Admin\VendorController@getStateList');
    Route::get('api/city/{stateId}', 'Admin\VendorController@getCityList');
    Route::get('api/postal/{cityId}', 'Admin\VendorController@getPostalCodeList');

    // route for cost centre
    Route::get('costcentres', 'Admin\AdminController@costcentre_list')->name('costcentres.dashboard');

    Route::get('addcostcentre', 'Admin\AdminController@costcentre_form')->name('costcentres.create');
    Route::post('costcentre_save', 'Admin\AdminController@costcentre_save')->name('costcentres.create');
    Route::get('editcostcentre/{cost_centre}', 'Admin\AdminController@costcentre_edit_form')->name('costcentres.update');
    Route::post('costcentre_edit_save/{cost_centre}', 'Admin\AdminController@costcentre_edit_save')->name('costcentres.update');
    Route::get('costcentre_delete/{cost_centre}', 'Admin\AdminController@costcentre_delete')->name('costcentres.delete');

    // route for activity types management
    Route::get('activitytypes', 'Admin\AdminController@activity_list')->name('activitytypes.dashboard');
    Route::get('addactivitytypes', 'Admin\AdminController@activity_type_form')->name('activitytypes.create');
    Route::post('activitytype_save', 'Admin\AdminController@activitytype_save')->name('activitytypes.create');
    Route::get('editactivitytype/{activity_type}', 'Admin\AdminController@activity_type_edit_form')->name('activitytypes.update');
    Route::post('activitytype_edit_save/{activity_type}', 'Admin\AdminController@activitytype_edit_save')->name('activitytypes.update');
    Route::get('activitytype_delete/{activity_type}', 'Admin\AdminController@activitytype_delete')->name('activitytypes.delete');

    // route for employeess
    Route::get('employees', 'Admin\EmployeeRecordsController@index')->name('employee.dashboard');
    Route::get('employees_export', 'Admin\EmployeeRecordsController@employee_export_cs')->name('employee.export.csv');
    Route::get('addemployee', 'Admin\EmployeeRecordsController@employee_form')->name('employee.create');
    Route::post('employee_save', 'Admin\EmployeeRecordsController@employee_save')->name('employee.create');
    Route::get('editemployee/{employee_data}', 'Admin\EmployeeRecordsController@employee_edit_form')->name('employee.update');
    Route::post('employee_edit_save/{employee_data}', 'Admin\EmployeeRecordsController@employee_edit_save')->name('employee.update');
    Route::delete('employee_delete/{employee_data}', 'Admin\EmployeeRecordsController@employee_delete')->name('employee.delete');

    //route for timesheet profiles management
    Route::get('timesheetprofiles', 'Admin\TimesheetProfilesController@index')->name('timesheet.profile.dashboard');
    Route::get('addtimesheetprofiles', 'Admin\TimesheetProfilesController@timesheet_profile_form')->name('timesheet.profile.create');
    Route::post('timesheetprofile_save', 'Admin\TimesheetProfilesController@timesheetprofile_save')->name('timesheet.profile.create');
    Route::get('edittimesheetprofile/{timesheet_profile}', 'Admin\TimesheetProfilesController@timesheet_profile_edit_form')->name('timesheet.profile.update');
    Route::post('timesheetprofile_edit_save/{timesheet_profile}', 'Admin\TimesheetProfilesController@timesheetprofile_edit_save')->name('timesheet.profile.update');
    Route::delete('timesheetprofile_delete/{timesheet_profile}', 'Admin\TimesheetProfilesController@timesheetprofile_delete')->name('timesheet.profile.delete');

    //route for activity rates
    Route::get('activityrates', 'Admin\ActivityRatesController@index')->name('activityRates.dashboard');
    Route::get('addactivityrates', 'Admin\ActivityRatesController@activity_rate_form')->name('activityRates.create');
    Route::post('activityrate_save', 'Admin\ActivityRatesController@activityrate_save')->name('activityRates.create');
    Route::get('editactivityrate/{activity_rate}', 'Admin\ActivityRatesController@activity_rate_edit_form')->name('activityRates.update');
    Route::post('activityrate_edit_save/{activity_rate}', 'Admin\ActivityRatesController@activityrate_edit_save')->name('activityRates.update');
    Route::get('activityrate_delete/{activity_rate}', 'Admin\ActivityRatesController@activityrate_delete')->name('activityRates.delete');

    //route for time sheet approvers
    Route::get('timesheetapprovals', 'Admin\TimesheetapproverController@index')->name('timesheet.approvals.dashboard');
    Route::get('addtimesheetapprover', 'Admin\TimesheetapproverController@timesheet_approver_form')->name('timesheet.approvals.create');
    Route::post('timesheetapprover_save', 'Admin\TimesheetapproverController@timesheetapprover_save')->name('timesheet.approvals.create');
    Route::get('edittimesheetapprover/{timesheet_approver}', 'Admin\TimesheetapproverController@timesheet_approver_edit_form')->name('timesheet.approvals.update');
    Route::post('timesheetapprover_edit_save/{timesheet_approver}', 'Admin\TimesheetapproverController@timesheetapprover_edit_save')->name('timesheet.approvals.update');
    Route::get('timesheetapprover_delete/{timesheet_approver}', 'Admin\TimesheetapproverController@timesheetapprover_delete')->name('timesheet.approvals.delete');

    //route for service master
    Route::resource('service_master', 'Admin\ServiceController', ['names' => [
            'index' => 'service_master.dashboard',
            'create' => 'service_master.create',
            'edit' => 'service_master.update',
            'store' => 'service_master.create',
            'update' => 'service_master.update',
            'destroy' => 'service_master.delete',
    ]]);

    //route for get vendorlist
    Route::get('api/vendor', 'Admin\ServiceController@getVendorList')->name('service_master.dashboard');

    //route for public holidays
    Route::resource('public_holidays', 'Admin\HolidaysController', ['names' => [
            'index' => 'publicHolidays.dashboard',
            'create' => 'publicHolidays.create',
            'edit' => 'publicHolidays.update',
            'store' => 'publicHolidays.create',
            'update' => 'publicHolidays.update',
            'destroy' => 'publicHolidays.delete',
    ]]);
    Route::get('api/getstate/{countryId}', 'Admin\HolidaysController@getStateList');

    Route::post('timesheetdata', 'Admin\TimesheetWorkController@showdata');

    Route::post('timesheetentry_projecttask_ajax', 'Admin\TimesheetWorkController@ajax_check');
    Route::post('timesheetentry_projecttaskdescription_ajax', 'Admin\TimesheetWorkController@task_description');


    Route::get('getportfolio-structure/{id}', 'Admin\PortfoliostructureController@getPortfolioStructure')->name('portfolio-structure.tree');

    //route for usermanagement
    Route::resource('user-managment', 'Admin\UserManagement\UserManagmentController', ['names' => [
            'index' => 'user-management.dashboard',
            'create' => 'user-management.create',
            'edit' => 'user-management.update',
            'store' => 'user-management.create',
            'update' => 'user-management.update',
            'destroy' => 'user-management.delete',
    ]]);
    Route::get('user-managment-datatable', 'Admin\UserManagement\UserManagmentController@data_table')->name('user-managment-datatable');

    //Revenue Planning
    Route::post('projectrevenueplan/{module}/store', 'Admin\ProjectrevenueplanController@store')->name('revenue_plan.module.create');
    Route::post('projectrevenueplan/{module}/edit/{id}', 'Admin\ProjectrevenueplanController@update')->name('revenue_plan.module.update');
    Route::post('projectrevenueplan/{module}/delete/{id}', 'Admin\ProjectrevenueplanController@destroy')->name('revenue_plan.module.delete');
    Route::get('projectrevenueplan/{id}', 'Admin\ProjectrevenueplanController@index')->name('revenue_plan.dashboard');
    Route::post('projectrevenueplan/project/{id}', 'Admin\ProjectrevenueplanController@show')->name('revenue_plan.dashboard');
    Route::get('projectrevenueplan/{module}/{id}', 'Admin\ProjectrevenueplanController@getModule')->name('revenue_plan.module.dashboard');
    Route::post('projectrevenueplan/materialdata/{id}', 'Admin\ProjectrevenueplanController@get_material_details')->name('revenue_plan.module.dashboard');
    Route::post('projectrevenueplan/purchaseorderdata/{id}', 'Admin\ProjectrevenueplanController@get_po_details')->name('revenue_plan.module.dasboard');
    Route::post('projectrevenueplan/activity/{dummy}', 'Admin\ProjectrevenueplanController@get_activity_rate')->name('revenue_plan.module.dashboard');
    Route::post('projectrevenueplan/requisition/{dummy}', 'Admin\ProjectrevenueplanController@get_unit_rate')->name('revenue_plan.module.dashboard');
    Route::post('projectrevenueplan/taskassignement/{dummy}', 'Admin\ProjectrevenueplanController@get_task_asignee')->name('revenue_plan.module.dashboard');
    Route::post('projectrevenueplan/getresource/{dummy}', 'Admin\ProjectrevenueplanController@get_resource_name')->name('revenue_plan.module.dashboard');
    Route::resource('projectrevenueplan', 'Admin\ProjectrevenueplanController', ['names' => [
            'index' => 'revenue_plan.dashboard',
            'create' => 'revenue_plan.create',
            'edit' => 'revenue_plan.update',
            'store' => 'revenue_plan.create',
            'update' => 'revenue_plan.update',
            'destroy' => 'revenue_plan.delete',
    ]]);
    Route::get('subscriptions/updateSubscription', 'Admin\Payment\UserSubscriptionController@updateSubscription')->name('subscriptions.updatesubscription');
    Route::post('subscriptions/update', 'Admin\Payment\UserSubscriptionController@update')->name('subscriptions.updatesubscription.update');
    Route::resource('subscriptions', 'Admin\Payment\UserSubscriptionController', ['names' => [
            'index' => 'subscriptions.dashboard',
            'show' => 'subscriptions.list',
            'destroy' => 'subscriptions.cancel',
    ]]);
  });
});


Route::group(['prefix' => '/'], function () {
  Route::get('/', 'Front\UserController@index');
  Route::get('register', 'Front\UserController@create');
  Route::get('verify/{id}/{token}', 'Front\UserController@userverification');
  Route::get('checkotp', 'Front\UserController@show');
  Route::any('sendmsg', 'Front\UserController@sendmsg');
});

Route::group(['prefix' => 'api/v1', 'middleware' => ['cors']], function () {
  Route::post('store', 'Front\UserController@store');
  Route::post('update/{id}', 'Front\UserController@modify');
  Route::post('checkotp/{id}', 'Front\UserController@checkotp');
  Route::post('checklogin', 'Front\UserController@checklogin');
  Route::post('logincheckotp/{id}', 'Front\UserController@logincheckotp');
});

Route::group(['prefix' => '/pricing'], function () {
  Route::get('/', 'Front\subscriptionController@index');
});
Route::get('/braintree/token', 'Front\BraintreeTokenController@token');
Route::post('/subscribe', 'Front\subscriptionController@store');



/*Route::post('/store', function()
	{
  // Get form inputs
  $number = Input::get('phone');
  
  // Create an authenticated client for the Twilio API
  $client = new Services_Twilio($_ENV['TWILIO_ACCOUNT_SID'], $_ENV['TWILIO_AUTH_TOKEN']);
 
  // Use the Twilio REST API client to send a text message
  $m = $client->account->messages->sendMessage(
    $_ENV['TWILIO_NUMBER'], // the text will be sent from your Twilio number
    $number, // the phone number the text will be sent to
    $message // the body of the text message
  );
  
  // Return the message object to the browser as JSON
  return $m;
});*/
