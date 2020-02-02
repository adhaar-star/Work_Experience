<?php $__env->startSection('title','Project | Project Milestone'); ?>
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
                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
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
                            <span>Project Milestone Dashboard</span>
                        </li>
                    </ul>
                </div>
                <h4>Project Milestone</h4>
                <div class="dashboard-buttons">
                    <?php if(RoleAuthHelper::hasAccess('projectmilestone.create')!=true): ?>  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        <?php else: ?>
                        <a href="<?php echo e(url('admin/projectmilestone/create')); ?>" class="btn btn-primary">
                            <?php endif; ?>
                            <i class="fa fa-send margin-right-5"></i>
                            Create Project Milestone
                        </a>
                </div>
        <!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Milestone ID</th>
                                    <th>Milestone Name</th>
                                    <th>Milestone Type</th>
                                    <th>Project ID</th>
                                    <th>Project Description</th>
                                    <th>Task ID</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Milestone ID</th>
                                    <th>Milestone Name</th>
                                    <th>Milestone Type</th>
                                    <th>Project ID</th>
                                    <th>Project Description</th>
                                    <th>Task ID</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $__currentLoopData = $projectmilestone; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $projmilestone): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($projmilestone->milestone_Id); ?></td>
                                    <td><?php echo e($projmilestone->milestone_name); ?></td>
                                    <td><?php echo e($projmilestone->milestone_type); ?></td>
                                    <td><?php echo e($projmilestone->project_id); ?></td>
                                    <td><?php echo e($projmilestone->project_desc); ?></td>
                                    <td><?php echo e($projmilestone->task_id); ?></td>
                                    <td><?php echo e(Carbon\Carbon::parse($projmilestone->start_date)->format('Y-m-d')); ?></td>
                                    <td><?php echo e(Carbon\Carbon::parse($projmilestone->finish_date)->format('Y-m-d')); ?></td>
                                    <td>
                                        <?php if($projmilestone->status== 'active' ): ?>                                            
                                        <img src="<?php echo e(asset('vendors/common/img/green.png')); ?>" alt="">
                                        <?php else: ?>                                        
                                        <img src="<?php echo e(asset('vendors/common/img/red.png')); ?>" alt="">
                                        <?php endif; ?>
                                    </td>
                                    <td class="action-btn">
                                        <?php if(RoleAuthHelper::hasAccess('projectmilestone.view')!=true): ?>  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            <?php else: ?>
                                            <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_<?php echo e($projmilestone->id); ?>"><?php endif; ?><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>

                                            <?php if(RoleAuthHelper::hasAccess('projectmilestone.update')!=true): ?>  
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                <?php else: ?>
                                                <a href="<?php echo e(url('admin/projectmilestone/'.$projmilestone->id.'/edit')); ?>" class="btn btn-info btn-xs margin-right-1"><?php endif; ?><i class="fa fa-pencil"></i>  </a>



                                                <?php echo Form::open(array('route' => array('projectmilestone.delete',$projmilestone->id), 'method' => 'DELETE','id'=>'delform'.$projmilestone->id)); ?>

                                                <?php if(RoleAuthHelper::hasAccess('projectmilestone.delete')!=true): ?>  
                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                    <?php else: ?>
                                                    <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this projectmilestone');
                                                              if (res) {
                                                      document.getElementById('delform<?php echo e($projmilestone->id); ?>').submit()
                                                                }" class="btn btn-danger btn-xs margin-right-1"><?php endif; ?><i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                                    <?php echo Form::close(); ?>


                                                    <div class="modal fade table-view-popup" id="table-view-popup_<?php echo e($projmilestone->id); ?>" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
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
                                                                                <a href="<?php echo e(url('admin/projectmilestone')); ?>">Project Milestone</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="<?php echo e(url('admin/projectmilestone/create')); ?>">Create Display Milestone</a>
                                                                            </li>
                                                                            <li>
                                                                                <span><?php echo e($projmilestone->milestone_name); ?></span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="col-xs-12">
                                                                        <form class="static-form">
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Milestone ID</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static"><?php echo e($projmilestone->milestone_Id); ?></p>
                                                                                    </div>
                                                                                </div>   
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Milestone Name</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static"><?php echo e($projmilestone->milestone_name); ?></p>
                                                                                    </div>
                                                                                </div>   
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Milestone Type</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static"><?php echo e($projmilestone->milestone_type); ?></p>
                                                                                    </div>
                                                                                </div>   
                                                                            </div>

                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Project ID</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static"><?php echo e($projmilestone->project_id); ?></p>
                                                                                    </div>
                                                                                </div>   
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Phase ID</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static"><?php echo e($projmilestone->phase_id); ?></p>
                                                                                    </div>
                                                                                </div>   
                                                                            </div>

                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Task ID</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static"><?php echo e($projmilestone->task_id); ?></p>
                                                                                    </div>
                                                                                </div>   
                                                                            </div>

                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Start Date</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->start_date);
                                                                                        $start_date = date('d/M/Y', $update);
                                                                                        ?>
                                                                                        <p class="form-control-static"><?php echo e($start_date); ?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Finish Date</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->finish_date);
                                                                                        $end_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static"><?php echo e($end_date); ?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Fixed Date</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->fixed_date);
                                                                                        $end_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static"><?php echo e($end_date); ?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Actual Date</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->actual_date);
                                                                                        $end_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static"><?php echo e($end_date); ?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Scheduled Date</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->schedule_date);
                                                                                        $end_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static"><?php echo e($end_date); ?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Billing Plan %</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->billingplan_date);
                                                                                        $end_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static"><?php echo e($end_date); ?></p>
                                                                                    </div>
                                                                                </div>     
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Progress %</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->progress_date);
                                                                                        $end_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static"><?php echo e($end_date); ?></p>
                                                                                    </div>
                                                                                </div>     
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Event Reminder Date</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->event_date);
                                                                                        $end_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static"><?php echo e($end_date); ?></p>
                                                                                    </div>

                                                                                    <!--                                                                            <div class="col-sm-5">
                                                                                    <?php
                                                                                    $update = strtotime($projmilestone->updated_at);
                                                                                    $updated_at = date('d/M/Y', $update);
                                                                                    ?>
                                                                                    
                                                                                                                                                                    <p class="form-control-static"><?php echo e($projmilestone->reference_phase); ?></p>-->
                                                                                </div>
                                                                            </div>     

                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Created On</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->created_date);
                                                                                        $created_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static"><?php echo e($created_date); ?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Created By</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static"><?php echo e($projmilestone->created_by); ?></p>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Changed On</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <?php
                                                                                        $update = strtotime($projmilestone->created_date);
                                                                                        $created_date = date('d/M/Y', $update);
                                                                                        ?>

                                                                                        <p class="form-control-static"><?php echo e($created_date); ?></p>
                                                                                    </div>
                                                                                </div>     
                                                                            </div>
                                                                            <div class="form-group popup-brd-btm">
                                                                                <div class="col-sm-12">
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static">Changed By</p>
                                                                                    </div>
                                                                                    <div class="col-sm-5">
                                                                                        <p class="form-control-static"><?php echo e($projmilestone->created_by); ?></p>
                                                                                    </div>
                                                                                </div>     
                                                                            </div>
                                                                    </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <span class="edit-btn"><a href="<?php echo e(url('admin/projectmilestone/'.$projmilestone->id.'/edit')); ?>" class="btn btn-primary">Edit</a></span>
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
                                                    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>