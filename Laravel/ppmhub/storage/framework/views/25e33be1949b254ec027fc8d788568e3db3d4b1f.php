<?php $__env->startSection('title','Project | Project Task'); ?>
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
                            <a class="dropdown-item" href="<?php echo e(url('admin/projectresourceplan')); ?>">Project Resource Plan</a>
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
                            <span>Project Task Dashboard</span>
                        </li>
                    </ul>

                </div>
                <h4>Project Task</h4>
                <div class="dashboard-buttons">
                    <?php if(RoleAuthHelper::hasAccess('task.create')!=true): ?>  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        <?php else: ?>
                        <a href="<?php echo e(url('admin/projecttask/create')); ?>" class="btn btn-primary">
                            <?php endif; ?>
                            <i class="fa fa-send margin-right-5"></i>
                            Create Task
                        </a>
                </div>

                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Task Id</th>
                                    <th>Task Name</th>
                                    <th>ProjectId</th>
                                    <th>Task Type</th>
                                    <th>Sub Task Id</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Task Id</th>
                                    <th>Task Name</th>
                                    <th>ProjectId</th>
                                    <th>Task Type</th>
                                    <th>Sub Task </th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $__currentLoopData = $projecttask; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><a data-toggle="modal" data-target="#table-view-popup_<?php echo e($proj->id); ?>"><?php echo e($proj->task_Id); ?></a></td>


                                    <td><?php echo e($proj->task_name); ?></td>
                                    <td><?php echo e($proj->project_id); ?></td>
                                    <td><?php echo e($proj->task_type); ?></td>
                                    <td><?php echo e($proj->sub_task_id); ?></td>
                                    <td>
                                        <?php if($proj->status=='Created'): ?>
                                        <img src="<?php echo e(asset('vendors/common/img/green.png')); ?>" alt="">
                                        <?php elseif($proj->status=='In Progress'): ?>
                                        <img src="<?php echo e(asset('vendors/common/img/red.png')); ?>" alt="">
                                        <?php else: ?>
                                        <?php
                                        $status = 'Complete';
                                        echo $status;
                                        ?>
                                        <?php endif; ?>

                                    </td>

                                    <td class="action-btn">
                                        <?php if(RoleAuthHelper::hasAccess('task.view')!=true): ?>  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            <?php else: ?><a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_<?php echo e($proj->id); ?>"><?php endif; ?><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>

                                        <?php if(RoleAuthHelper::hasAccess('task.update')!=true): ?>  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            <?php else: ?>
                                            <a href="<?php echo e(url('admin/projecttask/'.$proj->id.'/edit')); ?>" class="btn btn-info btn-xs margin-right-1"><?php endif; ?><i class="fa fa-pencil"></i> </a>

                                            <?php echo Form::open(array('route' => array('task.delete',$proj->id), 'method' => 'DELETE','id'=>'delform'.$proj->id)); ?>

                                            <?php if(RoleAuthHelper::hasAccess('task.delete')!=true): ?>  
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                <?php else: ?>
                                                <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this project phase');
                                                          if (res) {
                                                  document.getElementById('delform<?php echo e($proj->id); ?>').submit()
                                                            }" class="btn btn-danger btn-xs"><?php endif; ?><i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                <?php echo Form::close(); ?>

                                                <div class="modal fade table-view-popup" id="table-view-popup_<?php echo e($proj->id); ?>" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                                    <div class="modal-dialog" role="document" style="text-align:left;">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span>
                                                                </button>
                                                                <div class="margin-bottom-10">
                                                                    <ul class="list-unstyled breadcrumb">
                                                                        <li>
                                                                            <a href="<?php echo e(url('admin/dashboard')); ?>">Project Managemnt</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="<?php echo e(url('admin/projecttask')); ?>">Project Task/Subtask</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:void(0);">Display Project Task</a>
                                                                        </li>
                                                                        <li>
                                                                            <span><?php echo e($proj->task_Id); ?></span>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form class="static-form">
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Task ID</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static"><?php echo e($proj->task_Id); ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Task Name</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static"><?php echo e($proj->task_name); ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Task Type</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static"><?php echo e($proj->task_type); ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Subtask ID</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static"><?php echo e($proj->sub_task_id); ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Project ID</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static"><?php echo e($proj->project_id); ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Phase ID</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static"><?php echo e($proj->phase_id); ?></p>
                                                                        </div>
                                                                    </div>

                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Start Date</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <?php
                                                                            $strtdate = strtotime($proj->start_date);
                                                                            $start_date = date('d/M/Y', $strtdate);
                                                                            ?>
                                                                            <p class="form-control-static"><?php echo e($start_date); ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">End Date</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <?php
                                                                            $endate = strtotime($proj->end_date);
                                                                            $end_date = date('d/M/Y', $endate);
                                                                            ?>
                                                                            <p class="form-control-static"><?php echo e($end_date); ?></p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Created On</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <?php
                                                                            $createdate = strtotime($proj->created_date);
                                                                            $created_date = date('d/M/Y', $createdate);
                                                                            ?>
                                                                            <p class="form-control-static">
                                                                                <?php echo e($created_date); ?>

                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group popup-brd-btm">
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">Created By</p>
                                                                        </div>
                                                                        <div class="col-sm-5">
                                                                            <p class="form-control-static">
                                                                                <?php echo e($user_name); ?>

                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <span class="edit-btn"><a href="<?php echo e(url('admin/projecttask/'.$proj->id.'/edit')); ?>" class="btn btn-primary">Edit</a></span>
                                                                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                </td>
                                                </tr>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                </tbody>
                                                </table>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </div>
                                                </section>
                                                <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>