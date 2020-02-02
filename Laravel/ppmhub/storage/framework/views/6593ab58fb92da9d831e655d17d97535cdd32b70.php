<?php $__env->startSection('title','Project | Project Phase'); ?>

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
                            <span>Project Phase Dashboard</span>
                        </li>
                    </ul>
                </div>
                <h4>Project Phase</h4>
                <div class="dashboard-buttons">
                    <?php if(RoleAuthHelper::hasAccess('phase.create')!=true): ?>  
                    <a href="javascript:void(0)" class="btn btn-default" style="cursor:no-drop; color:#97A7A7;">
                        <?php else: ?>
                        <a href="<?php echo e(url('admin/projectphase/create')); ?>" class="btn btn-primary">
                            <?php endif; ?>
                            <i class="fa fa-send margin-right-5"></i>
                            Create Project Phase
                        </a>
                </div>

                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Phase ID</th>
                                    <th>Phase Name</th>
                                    <th>Phase Type</th>
                                    <th>Project ID</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Phase ID</th>
                                    <th>Phase Name</th>
                                    <th>Phase Type</th>
                                    <th>Project ID</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $__currentLoopData = $projectphase; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <td><a data-toggle="modal" data-target="#table-view-popup_<?php echo e($proj->id); ?>"><?php echo e($proj->phase_Id); ?></a></td>
                            <td><?php echo e($proj->phase_name); ?></td>
                            <td><?php echo e($proj['phaseType']['name']); ?></td>
                            <td><?php echo e($proj['projectId']['project_Id']); ?></td>
                            <td>
                                <?php if($proj->status=='active'): ?>
                                <img src="<?php echo e(asset('vendors/common/img/green.png')); ?>" alt="">
                                <!--button type="button" class="btn btn-success btn-xs">Active</button-->
                                <?php else: ?>
                                <img src="<?php echo e(asset('vendors/common/img/red.png')); ?>" alt="">

                                <!--button type="button" class="btn btn-danger btn-xs">Inactive</button-->
                                <?php endif; ?>
                            </td>
                            <td class="action-btn">
                                <?php if(RoleAuthHelper::hasAccess('phase.view')!=true): ?>  
                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                    <?php else: ?>
                                    <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_<?php echo e($proj->id); ?>"><?php endif; ?><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>

                                    <?php if(RoleAuthHelper::hasAccess('phase.update')!=true): ?>  
                                    <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                        <?php else: ?>
                                        <a href="<?php echo e(url('admin/projectphase/'.$proj->id.'/edit')); ?>" class="btn btn-info btn-xs margin-right-1"><?php endif; ?><i class="fa fa-pencil"></i> <!--Edit--> </a>

                                        <?php echo Form::open(array('route' => array('phase.delete',$proj->id), 'method' => 'DELETE','id'=>'delform'.$proj->id)); ?>

                                        <?php if(RoleAuthHelper::hasAccess('phase.delete')!=true): ?>  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            <?php else: ?><a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this project phase');
                                                      if (res) {
                                              document.getElementById('delform<?php echo e($proj->id); ?>').submit()
                                                        }" class="btn btn-danger btn-xs margin-0"><?php endif; ?><i class="fa fa-trash-o"></i> <!--Delete--> </a>

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
                                                                        <a href="<?php echo e(url('admin/projectphase')); ?>">Project Phase</a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="<?php echo e(url('admin/projectphase/create')); ?>">Display Project Phase</a>
                                                                    </li>
                                                                    <li>
                                                                        <span><?php echo e($proj->phase_name); ?></span>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form class="static-form">
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Phase ID</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php echo e($proj->phase_Id); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Phase Name</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php echo e($proj->phase_name); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Phase Type</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php echo e($proj['phaseType']['name']); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Project ID</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php echo e($proj['projectId']['project_Id']); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Project Name</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php echo e($proj['projectId']['project_name']); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Start Date</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php
                                                                            $phpdate = strtotime($proj->start_date);
                                                                            $start_date = date('d/M/Y', $phpdate);
                                                                            ?>
                                                                            <?php echo e($start_date); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">End Date</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php
                                                                            $end_date = strtotime($proj->end_date);
                                                                            $end_date = date('d/M/Y', $end_date);
                                                                            ?>	
                                                                            <?php echo e($end_date); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Quality gate approval</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php echo e($proj->quality_approval); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Predecessor Phase ID</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php echo e($proj->prephase_id); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Predecessor Phase Name</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php echo e($proj->prephase_name); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Actual Start Date</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php
                                                                            $a_start_date = strtotime($proj->a_start_date);
                                                                            $a_start_date = date('d/M/Y', $a_start_date);
                                                                            ?>
                                                                            <?php echo e($a_start_date); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Actual End Date</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php
                                                                            $a_end_date = strtotime($proj->a_end_date);
                                                                            $a_end_date = date('d/M/Y', $a_end_date);
                                                                            ?>
                                                                            <?php echo e($a_end_date); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Earliest Start Date</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php
                                                                            $e_start_date = strtotime($proj->e_start_date);
                                                                            $e_start_date = date('d/M/Y', $e_start_date);
                                                                            ?>
                                                                            <?php echo e($e_start_date); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Earliest End Date</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php
                                                                            $e_end_date = strtotime($proj->e_end_date);
                                                                            $e_end_date = date('d/M/Y', $e_end_date);
                                                                            ?>
                                                                            <?php echo e($e_end_date); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Latest Start Date</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php
                                                                            $l_start_date = strtotime($proj->l_start_date);
                                                                            $l_start_date = date('d/M/Y', $l_start_date);
                                                                            ?>
                                                                            <?php echo e($l_start_date); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Latest End Date</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php
                                                                            $l_end_date = strtotime($proj->l_end_date);
                                                                            $l_end_date = date('d/M/Y', $l_end_date);
                                                                            ?>
                                                                            <?php echo e($l_end_date); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Duration</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php echo e($proj->duration); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Person Responsible</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php echo e($proj['personResponsible']['name']); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Phase Approval</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php echo e($proj->phase_approval); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Created On</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php
                                                                            $created_date = strtotime($proj->created_date);
                                                                            $created_date = date('d/M/Y', $created_date);
                                                                            ?>
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
                                                                            <?php echo e($proj->created_by); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Changed On</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php
                                                                            $created_date = strtotime($proj->created_date);
                                                                            $created_date = date('d/M/Y', $created_date);
                                                                            ?>
                                                                            <?php echo e($created_date); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Changed By</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">
                                                                            <?php echo e($proj->created_by); ?>

                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group popup-brd-btm">
                                                                    <div class="col-sm-5">
                                                                        <p class="form-control-static">Status</p>
                                                                    </div>
                                                                    <div class="col-sm-5">
                                                                        <?php if($proj->status=='active'): ?>
                                                                        <img src="<?php echo e(asset('vendors/common/img/green.png')); ?>" alt="">
                                                                        <?php else: ?>
                                                                        <img src="<?php echo e(asset('vendors/common/img/red.png')); ?>" alt="">
                                                                        <?php endif; ?>    
                                                                    </div> 
                                                                </div>
                                                            </form>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <span class="edit-btn"><a href="<?php echo e(url('admin/projectphase/'.$proj->id.'/edit')); ?>" class="btn btn-primary">Edit</a></span>
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