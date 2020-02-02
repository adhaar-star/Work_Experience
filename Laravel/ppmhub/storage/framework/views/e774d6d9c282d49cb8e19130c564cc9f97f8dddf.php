<?php $accessArray = Session::get('access_array'); ?>
<nav class="left-menu" left-menu>
   <div class="logo-container">
      <a href="/admin/dashboard" class="logo">
         <img src="<?php echo e(asset('vendors/common/img/ppm_logo.png')); ?>" alt="PPM HUB" />
         <img class="logo-inverse" src="<?php echo e(asset('vendors/common/img/ppm_logo.png')); ?>" alt="PPM HUB" />
      </a>
   </div>
   <div class="left-menu-inner scroll-pane">
      <ul class="left-menu-list left-menu-list-root list-unstyled">
         <!--   <li>
                      <a class="left-menu-link" href="<?php echo e(url('admin/portfolio')); ?>">
                          <i class="left-menu-link-icon icmn-books util-spin-delayed-pseudo"></i>
                          Portfolio
                      </a>
                  </li>
                  <li>
                      <a class="left-menu-link" href="<?php echo e(url('admin/buckets')); ?>">
                          <i class="left-menu-link-icon icmn-books util-spin-delayed-pseudo"></i>
                          Buckets
                      </a>
                  </li>
                <li class="left-menu-list-separator "> </li>-->
         <!--li class="left-menu-list">
                     <a class="left-menu-link" href="<?php echo e(url('admin/bucketfp')); ?>">
                         <i class="left-menu-link-icon icmn-home2 util-spin-delayed-pseudo"></i>
                         Bucket Financial Planning
                     </a>
                 </li-->
         <li class="left-menu-list-submenu">
            <a class="left-menu-link" href="">
               <i class="left-menu-link-icon fa fa-archive util-spin-delayed-pseudo"><!-- --></i>
               Portfolio Management
            </a>
            <ul class="left-menu-list list-unstyled">
               <li>
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('portfolio.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/portfolio')); ?>>
                     Portfolio
                  </a>
               </li>
               <li>
                  <a   class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('buckets.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/buckets')); ?>>
                     Buckets
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/portfolioStructure')); ?>" >-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('portfolioStructure.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/portfolioStructure')); ?>>
                     Portfolio Structure
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/bucketStructure')); ?>" >-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('bucketStructure.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/bucketStructure')); ?> >
                     Bucket Structure
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/bucketfp')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('portfolio-fp.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/bucketfp')); ?> >
                     Portfolio Financial Planning
                  </a>
               </li>
               <!--                            <li>
                                                       <a class="left-menu-link" href="<?php echo e(url('admin/portfolioresourceplanning')); ?>">
                                                           Portfolio Resource Planning
                                                       </a>
                                                   </li>-->
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/portfoliocapacityplanning')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('portfolio-cp.common.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/portfoliocapacityplanning')); ?> >
                     Portfolio Capacity Planning
                  </a>
               </li>
            </ul>
         </li>

         <li class="left-menu-list-separator"><!-- --></li>
         <li class="left-menu-list-submenu">
            <a class="left-menu-link" href="javascript: void(0);">
               <i class="left-menu-link-icon fa fa-clone util-spin-delayed-pseudo"><!-- --></i>
               Project Management
            </a>
            <ul class="left-menu-list list-unstyled">
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/project')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('project.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/project')); ?> >
                     Project
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/projectphase')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('phase.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/projectphase')); ?> >
                     Phase
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/projecttask')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('task.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/projecttask')); ?> >
                     Task/Subtask
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/projectchecklist')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('checklist.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/projectchecklist')); ?> >
                     Checklist
                  </a>
               </li>



               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/projectmilestone')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('projectmilestone.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/projectmilestone')); ?> >

                     Milestone
                  </a>
               </li>

               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/projectscheduling')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('scheduling.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/projectscheduling')); ?> >

                     Project Scheduling
                  </a>
               </li>

               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/projectcostplan')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('costplan.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/projectcostplan')); ?> >
                     Project Cost Plan
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/projectStructure')); ?>" >-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('projectStructure.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/projectStructure')); ?> >
                     Project Structure
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/projectresourceplanning')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('resourceplanning.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/projectresourceplanning')); ?> >
                     Project Resource Planning
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/costforcasting')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('costforcasting.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/costforcasting')); ?> >
                     Cost Forecasting
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/demandforecasting')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('demandforecasting.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/demandforecasting')); ?>>
                     Demand Forecasting
                  </a>
               </li>
            </ul>
         </li>


         <li class="left-menu-list-submenu">
            <a class="left-menu-link" href="javascript: void(0);">
               <i class="left-menu-link-icon fa fa-retweet util-spin-delayed-pseudo"></i>
               Agile Methodology
            </a>
            <ul class="left-menu-list list-unstyled">
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/projectissues')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('project.issues.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/projectissues')); ?> >
                     Issue List
                  </a>
               </li>

               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/backlog')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('backlog.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/backlog')); ?> >
                     <!--Budget Supplement-->
                     Backlogs
                  </a>
               </li>

               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/boards')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('boards.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/boards')); ?> >
                     <!--Budget Return-->
                     Kanban Board
                  </a>
               </li>

               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/sprint')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('sprint.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/sprint')); ?> >
                     Sprint
                  </a>
               </li>

               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/component')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('component.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/component')); ?> >
                     <!--Project Original Budget-->
                     Components
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/projectlabels')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('project.labels.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/projectlabels')); ?> >
                     Labels
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/configuration')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('configuration.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/configuration')); ?> >
                     Configuration
                  </a>
               </li>
               <li>
                        <a class="left-menu-link" href="#">
                            Reports
                        </a>
                    </li>






            </ul>
         </li>


         <li class="left-menu-list-submenu">
            <a class="left-menu-link" href="javascript: void(0);">
               <i class="left-menu-link-icon fa fa-money util-spin-delayed-pseudo"></i>
               Budget Management
            </a>
            <ul class="left-menu-list list-unstyled">
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/originalbudget')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('budget.overview.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/originalbudget')); ?> >
                     Budget Overview
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/projectbudget/original')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('budget.create')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/projectbudget/original')); ?> >
                     <!--Project Original Budget-->
                     Maintain Original Budget
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/projectbudget/supplement')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('budget.create')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/projectbudget/supplement')); ?> >
                     <!--Budget Supplement-->
                     Supplement Budget
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/projectbudget/returns')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('budget.create')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/projectbudget/returns')); ?> >
                     <!--Budget Return-->
                     Return Budget
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/currentbudget')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('budget.current.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/currentbudget')); ?> >
                     <!--Current Budget-->
                     Current Budget
                  </a>
               </li>
            </ul>
         </li>
         <li class="left-menu-list-submenu">
            <a class="left-menu-link" href="">
               <i class="left-menu-link-icon fa fa-clock-o  util-spin-delayed-pseudo"><!-- --></i>
               Time Management
            </a>
            <ul class="left-menu-list list-unstyled">

               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/employees')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('employee.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/employees')); ?> >
                     Employee Personnel Records
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/timesheetapprovals')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('timesheet.approvals.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/timesheetapprovals')); ?> >
                     Time Approval settings
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/timesheetprofiles')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('timesheet.profile.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/timesheetprofiles')); ?> >
                     Time Sheet Profiles
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(route('timesheet.cost.dashboard')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('timesheet.cost.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.route('timesheet.cost.dashboard')); ?> >
                     Time Sheet Cost</a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(route('timesheet.work.approvals.list')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('timesheet.work.approvals.list')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.route('timesheet.work.approvals.list')); ?> >
                     Time Sheet Approval</a></li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(route('timesheet.work.list.dashboard')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('timesheet.work.list.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.route('timesheet.work.list.dashboard')); ?> >
                     Time Sheet Management</a></li>

            </ul>
         </li>

         <li class="left-menu-list-submenu">
            <a class="left-menu-link" href="">
               <i class="left-menu-link-icon fa fa-rocket util-spin-delayed-pseudo"><!-- --></i>
               Risk Management
            </a>
            <ul class="left-menu-list list-unstyled">

               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/riskregister')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('risk.analysis.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/riskregister')); ?> >
                     Risk Register
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/quantitative_risk')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('quantitative_risk.create')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/quantitative_risk')); ?> >
                     Quantitative Risk
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/qualitative_risk')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('qualitative_risk.create')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/qualitative_risk')); ?> >
                     Qualitative Risk
                  </a>
               </li>
            </ul>
         </li>

         <!--New Procurement menu-->
         <li class="left-menu-list-submenu">
            <a class="left-menu-link" href="">
               <i class="left-menu-link-icon fa fa-shopping-basket util-spin-delayed-pseudo"><!-- --></i>
               Procurement
            </a>
            <ul class="left-menu-list list-unstyled">
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/vendor')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('vendor.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/vendor')); ?> >
                     Vendor Master
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/material_master')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('material_master.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/material_master')); ?> >
                     Material Master
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/service_master')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('service_master.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/service_master')); ?> >
                     Service Master
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/purchase_requisition')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('purchase_requisition.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/purchase_requisition')); ?> >
                     Purchase Requisition
                  </a>
               </li>

               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/purchase_order')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('purchase_order.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/purchase_order')); ?> >
                     Purchase Order
                  </a>
               </li>

               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/contract')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('contract.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/contract')); ?> >
                     Create Contract
                  </a>
               </li>

               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/goods_receipt')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('goods_receipt.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/goods_receipt')); ?> >
                     Goods Receipt                                </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/invoice_verification')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('invoice_verification.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/invoice_verification')); ?> >
                     Invoice Verification                                </a>
               </li>


            </ul>
         </li>
         <!--New Procurement menu-->

         <!--New Sales Order menu-->
         <li class="left-menu-list-submenu">
            <a class="left-menu-link" href="javascript: void(0);">
               <i class="left-menu-link-icon fa fa-check util-spin-delayed-pseudo"></i>
               Project Progress
            </a>
            <ul class="left-menu-list list-unstyled">
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/project_progress/working_days')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('projectprogress.workingdays.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/project_progress/working_days')); ?> >
                     Project Working Days
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/project_progress/scurves')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('projectprogress.scurves.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/project_progress/scurves')); ?> >
                     Project Progress S-Curves:
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/project_progress/calculation')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('projectprogress.calculations.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/project_progress/calculation')); ?> >
                     Project Progress Calculation
                  </a>
               </li>

            </ul>
         </li>
         <li class="left-menu-list-submenu">
            <a class="left-menu-link" href="">
               <i class="left-menu-link-icon fa fa-file-text util-spin-delayed-pseudo"><!-- --></i>
               Sales Order
            </a>
            <ul class="left-menu-list list-unstyled">
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/customer_master')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('customer_master.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/customer_master')); ?> >
                     Customer Master
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/customer_inquiry')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('customer_inquiry.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/customer_inquiry')); ?> >
                     Customer Inquiry
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/quotation')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('quotation.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/quotation')); ?> >
                     Quotation
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/sales_order')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('salesorder.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/sales_order')); ?> >
                     Sales Order</a></li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/projectrevenueplan')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('revenue_plan.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/projectrevenueplan')); ?> >
                     Manual Revenue Planning
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/revenueforcasting')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('revenueforcasting.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/revenueforcasting')); ?> >
                     Revenue Forecast
                  </a>
               </li>
            </ul>
         </li>
         <li class="left-menu-list-submenu">
            <a class="left-menu-link" href="">
               <i class="left-menu-link-icon fa fa-plus util-spin-delayed-pseudo"></i>
               New
            </a>
            <ul class="left-menu-list list-unstyled">
               <li>
                  <a class="left-menu-link" href="<?php echo e(route('range-numbers.index')); ?>">

                     Master Range</a></li>
               <li>
                  <a class="left-menu-link" href="<?php echo e(route('customer.index')); ?>">
                     Customer Master</a></li>
               <li>
                  <a class="left-menu-link" href="<?php echo e(route('material.index')); ?>" >
                     Material master</a></li>
               <li>
                  <a class="left-menu-link" href="<?php echo e(route('material-category.index')); ?>" >
                     Material Category</a></li>
               <li>
                  <a class="left-menu-link" href="<?php echo e(route('material-group.index')); ?>" >
                     Material Group</a></li>
               <li>
                  <a class="left-menu-link" href="<?php echo e(route('order-unit.index')); ?>" >
                     Order Unit</a></li>
               <li>
                  <a class="left-menu-link" href="<?php echo e(route('unit-of-measure.index')); ?>" >
                     Unit Of Measure</a></li>
               <li>
                  <a class="left-menu-link" href="<?php echo e(route('vendor.index')); ?>" >
                     Vendor Master</a></li>
               <li><a class="left-menu-link" href="">Sales Documents</a></li>
			   <!-- route('sales-order-document-index')-->
               <li>
                  <a class="left-menu-link" href="<?php echo e(route('sales-order-index')); ?>">
                     Sales Order</a></li>
               <li>
                  <a class="left-menu-link" href="<?php echo e(route('billing-list')); ?>">
                     Billing</a></li>
            </ul>
         </li>
         <li class="left-menu-list-submenu">
            <a class="left-menu-link" href="javascript:void(0)">
               <i class="left-menu-link-icon fa fa-building-o  util-spin-delayed-pseudo"><!-- --></i>
               Company Management
            </a>
            <ul class="left-menu-list list-unstyled">
               <li>
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('user-management.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.route('user-management.dashboard')); ?> >
                     Manage User</a></li>
               <li>
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('companyDetails.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.route('companyDetails.dashboard')); ?>>
                     Company Details</a></li>
               <li>
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('subscriptions.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.route('subscriptions.dashboard')); ?>>
                     Subscription History</a></li>
               <li>
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('subscriptions.updatesubscription')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.route('subscriptions.updatesubscription')); ?>>
                     Plans details</a></li>
            </ul>
         </li>
         <li class="left-menu-list-submenu">
            <a class="left-menu-link" href="">
               <i class="left-menu-link-icon fa fa-plus util-spin-delayed-pseudo"><!-- --></i>
               Role Management
            </a>
            <ul class="left-menu-list list-unstyled">
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/CompanyRoles')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('company.roles.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/CompanyRoles')); ?> >
                     Company Roles</a></li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/AccessControl')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('roles.permission.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/AccessControl')); ?> >
                     Access Control</a></li>

            </ul>
         </li>

         <li class="left-menu-list-submenu">
            <a class="left-menu-link" href="javascript: void(0);">
               <i class="left-menu-link-icon fa fa-bar-chart util-spin-delayed-pseudo"></i>
               Report Management
            </a>
            <ul class="left-menu-list list-unstyled">
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/costbudget')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('report.costbudget.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/costbudget')); ?> >
                     Cost Budget Report
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/checklistreport')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('report.checklist.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/checklistreport')); ?> >
                     Check List Report
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/milestonereport')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('report.milestone.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/milestonereport')); ?> >
                     Milestone Report
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/riskanalysis')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('report.projectRiskAnalysis.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/riskanalysis')); ?> >
                     Project Risk analysis Report
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/projectdefinitiondetail')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('report.projectDefinition.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/projectdefinitiondetail')); ?> >
                     Project Definition Detail Report
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/phasedetail')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('report.phaseDetail.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/phasedetail')); ?> >
                     Phase Detail Report
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/salesreport')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('report.sales.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/salesreport')); ?> >
                     Project Sales Report
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/timesheet')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('report.projectTimesheet.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/timesheet')); ?> >
                     Project Timesheet Report
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/taskdetail')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('report.taskDetail.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/taskdetail')); ?> >
                     Project Task Detail Report
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/projectportfolio')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('report.portfolio.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/projectportfolio')); ?> >
                     Projects In Portfolio Report
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/purchaserequisition')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('report.requisition.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/purchaserequisition')); ?> >
                     Purchase Requisitions For Project Report
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/purchaseorder')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('report.purchaseOrder.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/purchaseorder')); ?> >
                     Purchase Order For Project Report
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/goodsreceiptreport')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('report.goodsReceipt.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/goodsreceiptreport')); ?> >
                     Goods Receipt For Purchase order Report
                  </a>
               </li>
               <li>
                  <!--<a class="left-menu-link" href="<?php echo e(url('admin/invoiceverificationreport')); ?>">-->
                  <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('report.invoiceVerification.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/invoiceverificationreport')); ?> >
                     Invoice verification For Purchase order Report
                  </a>
               </li>

            </ul>
         </li>
         <!--New Sales Order menu-->

         <li class="left-menu-list-submenu mega-dropdown">
            <a class="left-menu-link" href="javascript: void(0);">
               <i class="left-menu-link-icon fa fa-cogs"><!-- --></i>
               Settings
            </a>
            <div class="mega-menu">
               <div class="col">
                  <ul class="left-menu-list list-unstyled">
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/portfoliotypes')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('portfolioType.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/portfoliotypes')); ?> >
                           Portfolio Type</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/projecttype')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('projectType.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/projecttype')); ?> >
                           Project Type</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/phasetype')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('phaseType.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/phasetype')); ?> >
                           Phase Type</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/checklisttype')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('checklistType.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/checklisttype')); ?> >
                           Checklist Type</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/currencies')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('currencies.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/currencies')); ?> >
                           Currency</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/inquirynumber_range')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('inquiryNumber.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/inquirynumber_range')); ?> >
                           Inquiry Number Range</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/inquiry_type')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('inquiry_type.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/inquiry_type')); ?> >
                           Inquiry Type</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/salesorganization')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('salesOrganization.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/salesorganization')); ?> >
                           Sales Organization</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/salesregion')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('salesRegion.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/salesregion')); ?> >
                           Sales Region</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/reasonRejection')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('reasonRejection.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/reasonRejection')); ?> >
                           Reason For Rejection</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/quotationNumber_range')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('quotationNumber.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/quotationNumber_range')); ?> >
                           Quotation Number Range</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/company')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('companyDetails.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/company')); ?> >
                           Company Details</a></li>
                  </ul>
               </div>
               <div class="col">
                  <ul class="left-menu-list list-unstyled">
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/salesorderNumber_range')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('companyDetails.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/salesorderNumber_range')); ?> >
                           Sales Order Number Range</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(route('glAccounts.dashboard')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('glAccounts.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.route('glAccounts.dashboard')); ?> >
                           Gl Accounts</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/capacityunits')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('capacityUnits.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/capacityunits')); ?> >
                           Capacity Units</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/periodtype')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('periodType.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/periodtype')); ?> >
                           Period Types</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/planningunit')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('planningUnit.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/planningunit')); ?> >
                           Planning Unit</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/planningtype')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('costingType.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/planningtype')); ?> >
                           Planning Type</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/costingtype')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('costingType.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/costingtype')); ?> >
                           Costing Type</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/customer_number_range')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('customerNumber.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/customer_number_range')); ?> >
                           Customer Number Range</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/project_number_range')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('projectNumber.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/project_number_range')); ?> >
                           Project Number Range</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/billing_type')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('billingType.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/billing_type')); ?> >
                           Billing Type</a></li>
                  </ul>
               </div>
               <div class="col">
                  <ul class="left-menu-list list-unstyled">
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/collectiontype')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('collectionType.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/collectiontype')); ?> >
                           Collection Type</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/viewtype')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('viewType.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/viewtype')); ?> >
                           View Type</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/personresponsible')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('personResponsible.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/personresponsible')); ?> >
                           Person Responsible</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/departmenttype')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('departmentType.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/departmenttype')); ?> >
                           Department</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/location')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('location.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/location')); ?> >
                           Project Location</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/factorycalendar')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('factoryCalendar.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/factorycalendar')); ?> >
                           Factory Calendar</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(route('activity-rates.index')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('activityRates.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.route('activityRates.dashboard')); ?> >
                           Activity Rates</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/costcentres')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('costcentres.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/costcentres')); ?> >
                           Cost Centres</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/activitytypes')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('activitytypes.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/activitytypes')); ?> >
                           Activity Types</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/addBank')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('bank.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/addBank')); ?> >
                           Bank name</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/public_holidays')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('publicHolidays.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/public_holidays')); ?> >
                           Public Holidays</a></li>
                     <li>
                        <a class="left-menu-link" href="<?php echo e(url('admin/user-managment')); ?>">
                           User Management</a></li>
                  </ul>
               </div>
               <div class="col">
                  <ul class="left-menu-list list-unstyled">
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/addCategory')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('materialCategory.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/addCategory')); ?> >
                           Material Category</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/addGroup')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('materialGroup.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/addGroup')); ?> >
                           Material Group</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/addUnitOfMeasure')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('unitMeasure.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/addUnitOfMeasure')); ?> >
                           Unit Of Measure</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/addOrderingUnit')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('orderUnit.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/addOrderingUnit')); ?> >
                           Ordering Unit</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/addMilestone')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('milestoneType.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/addMilestone')); ?> >
                           Milestone type</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/addMatrix')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('matrixScore.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/addMatrix')); ?> >
                           Qualitative Risk Matrix</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/QuantitativeRiskScore')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('quantitativeScore.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/QuantitativeRiskScore')); ?> >
                           Quantitative Risk Score</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/category')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('category.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/category')); ?> >
                           Category</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/group')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('group.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/group')); ?> >
                           Group</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/view')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('view.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/view')); ?> >
                           View</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/CompanyRoles')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('company.roles.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/CompanyRoles')); ?> >
                           Company Roles</a></li>
                     <li>
                        <!--<a class="left-menu-link" href="<?php echo e(url('admin/AccessControl')); ?>">-->
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('roles.permission.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/AccessControl')); ?> >
                           Access Control</a></li>
                     <li>
                        <a class="left-menu-link" <?php echo e((RoleAuthHelper::hasAccess('subscriptions.dashboard')!=true)?'style=cursor:no-drop;color:#97A7A7; href=javascript:void(0)':'href='.url('admin/subscriptions')); ?> >
                           My subscription</a></li>     
                  </ul>
               </div>
            </div>
         </li>
         <li class="left-menu-list-separator"><!-- --></li>
         <li class="menu-top-hidden no-colorful-menu">
            <div class="left-menu-item">
               Last Week Sales
            </div>
         </li>
         <li class="menu-top-hidden no-colorful-menu">
            <div class="example-left-menu-chart chartist-animated chartist-theme-dark"></div>
         </li>
         <li class="menu-top-hidden no-colorful-menu">
            <div class="left-menu-item">
               Solar System
            </div>
         </li>
         <li class="menu-top-hidden">
            <div class="left-menu-item">
               <span class="donut donut-success"></span> Jupiter
            </div>
         </li>
         <li class="menu-top-hidden">
            <div class="left-menu-item">
               <span class="donut donut-primary"></span> Earth
            </div>
         </li>
         <li class="menu-top-hidden">
            <div class="left-menu-item">
               <span class="donut donut-danger"></span> Mercury
            </div>
         </li>
      </ul>
   </div>
</nav>
<style>
   .head-brd{
      border: 0px;
   }
   .por-struc{
      padding: 15px 100px 30px;
   }
   .choose-port {
      font-size: 18px;
      font-weight: 700;
      margin-bottom: 25px;
   }
   .submit-btn {
      text-align: center;
   }
   .btn12{
      padding: 7px 30px;
   }
   .por-struc .form-group {
      text-align: center;
   }
</style>