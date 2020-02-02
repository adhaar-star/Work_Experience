<?php $__env->startSection('title','Project | Project Resource Planning'); ?>
<?php $__env->startSection('body'); ?>
<?php if(Session::has('flash_message')): ?>
<div class="alert alert-success">
    <span class="glyphicon glyphicon-ok"></span>
    <em> <?php echo session('flash_message'); ?></em>
</div>
<?php endif; ?>
<section class="panel">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <div class="togle-btn pull-right">
                    <div class="dropdown inner-drpdwn">
                        <a href="javascript: void(0);" class="dropdown-toggle dropdown-inline-button" data-toggle="dropdown" aria-expanded="false">
                            <span class="hidden-lg-down">Project Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="<?php echo e(url('admin/project')); ?>">Project</a>
                            <a class="dropdown-item" href="<?php echo e(url('admin/projectphase')); ?>">Phase</a>
                            <a class="dropdown-item" href="<?php echo e(url('admin/projecttask')); ?>">Task/Subtask</a>
                            <a class="dropdown-item" href="<?php echo e(url('admin/projectchecklist')); ?>">Checklist</a>
                            <a class="dropdown-item" href="<?php echo e(url('admin/projectmilestone')); ?>">Milestone</a>
                            <a class="dropdown-item" href="<?php echo e(url('admin/projectcostplan')); ?>">Project Cost Plan</a>
                            <a class="dropdown-item" href="<?php echo e(url('admin/projectresourceplanning')); ?>">Project Resource Planning</a>
                        </ul>
                    </div> 
                </div>
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="<?php echo e(url('admin/dashboard')); ?>">Project Management</a>
                        </li>
                        <li>
                            <span> Resource Planning Dashboard</span>
                        </li>
                    </ul>
                </div>
                <div class="card card-info-custom">
                    <div class="card-header">
                        <h4 class="margin-bottom-0">Resource Planning</h4>
                    </div>
                    <div class="card-block">
                        <div>
                            <?php if(RoleAuthHelper::hasAccess('createrole.create')!=true): ?>  
                            <a href="javascript:void(0)" class="btn btn-default margin-bottom-10" style="cursor:no-drop; color:#97A7A7;">
                                <?php else: ?>
                                <a href="<?php echo e(url('admin/createrole')); ?>" class="btn btn-primary margin-bottom-10">                       
                                    <?php endif; ?>
                                    Create Role
                                </a>
                                <?php if(RoleAuthHelper::hasAccess('assign.roleTo.person.create')!=true): ?>  
                                <a href="javascript:void(0)" class="btn btn-default margin-bottom-10" style="cursor:no-drop; color:#97A7A7;">
                                    <?php else: ?>
                                    <a href="<?php echo e(url('admin/assignroletoperson')); ?>" class="btn btn-primary margin-bottom-10">                        
                                        <?php endif; ?>
                                        Assign Role To Person
                                    </a>
                                    <?php if(RoleAuthHelper::hasAccess('taskassign.create')!=true): ?>  
                                    <a href="javascript:void(0)" class="btn btn-default margin-bottom-10" style="cursor:no-drop; color:#97A7A7;">
                                        <?php else: ?>
                                        <a href="<?php echo e(url('admin/taskassign')); ?>" class="btn btn-primary margin-bottom-10">                        
                                            <?php endif; ?>
                                            Assign Task To Role
                                        </a>
                                        <?php if(RoleAuthHelper::hasAccess('person.assignment.toTask.create')!=true): ?>  
                                        <a href="javascript:void(0)" class="btn btn-default margin-bottom-10" style="cursor:no-drop; color:#97A7A7;">
                                            <?php else: ?>
                                            <a href="<?php echo e(url('admin/personassignmenttotask')); ?>" class="btn btn-primary margin-bottom-10">                        
                                                <?php endif; ?>
                                                Person Assignment To Task 
                                            </a>
                                            <?php if(RoleAuthHelper::hasAccess('resource.overview.dashboard')!=true): ?>  
                                            <a href="javascript:void(0)" class="btn btn-default margin-bottom-10" style="cursor:no-drop; color:#97A7A7;">
                                                <?php else: ?>
                                                <a href="<?php echo e(url('admin/resourceoverview')); ?>" class="btn btn-primary margin-bottom-10">                        
                                                    <?php endif; ?>
                                                    Resource Overview
                                                </a>
                                                <?php if(RoleAuthHelper::hasAccess('resource.loading.dashboard')!=true): ?>  
                                                <a href="javascript:void(0)" class="btn btn-default margin-bottom-10" style="cursor:no-drop; color:#97A7A7;">
                                                    <?php else: ?>
                                                    <a href="<?php echo e(url('admin/resourceloading')); ?>" class="btn btn-primary margin-bottom-10">                        
                                                        <?php endif; ?>
                                                        Resource Loading
                                                    </a>
                                                    <?php if(RoleAuthHelper::hasAccess('resource.availability.dashboard')!=true): ?>  
                                                    <a href="javascript:void(0)" class="btn btn-default margin-bottom-10" style="cursor:no-drop; color:#97A7A7;">
                                                        <?php else: ?>
                                                        <a href="<?php echo e(url('admin/resourceavailability')); ?>" class="btn btn-primary margin-bottom-10">                        
                                                            <?php endif; ?>
                                                            Resource Availability
                                                        </a>
                                                        <?php if(RoleAuthHelper::hasAccess('resource.demandvsasssigned.dashboard')!=true): ?>  
                                                        <a href="javascript:void(0)" class="btn btn-default margin-bottom-10" style="cursor:no-drop; color:#97A7A7;">
                                                            <?php else: ?>
                                                            <a href="<?php echo e(url('admin/resourcedemandvsasssigned')); ?>" class="btn btn-primary margin-bottom-10">                        
                                                                <?php endif; ?>
                                                                Demand Vs Assigned
                                                            </a>
                                                            </div>
                                                            <hr>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <table class="table table-inverse" id="example3" width="100%">
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Project ID</th>
                                                                                <th>Project Description</th>
                                                                                <th>Role Name</th>
                                                                                <th>Resource</th>
                                                                                <th>Task ID</th>
                                                                                <th>Task Description</th>
                                                                            </tr>
                                                                        </thead> 
                                                                        <tfoot>
                                                                            <tr>
                                                                                <th>Project ID</th>
                                                                                <th>Project Description</th>
                                                                                <th>Role Name</th>
                                                                                <th>Resource</th>
                                                                                <th>Task ID</th>
                                                                                <th>Task Description</th>
                                                                            </tr>
                                                                        </tfoot>
                                                                        <tbody>
                                                                            <?php $__currentLoopData = $resourceData; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projresourceplan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                            <tr>
                                                                                <td><?php echo e($projresourceplan->project_id); ?></td>
                                                                                <td><?php echo e($projresourceplan->project_desc); ?></td>
                                                                                <td><?php echo e($projresourceplan->role_name); ?></td>
                                                                                <td><?php echo e($projresourceplan->resource_name); ?></td>
                                                                                <td><?php echo e($projresourceplan->task_id); ?></td>                                  
                                                                                <td><?php echo e($projresourceplan->task_name); ?></td>                                 

                                                                            </tr>
                                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            </div>
                                                            </section>
                                                            <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>