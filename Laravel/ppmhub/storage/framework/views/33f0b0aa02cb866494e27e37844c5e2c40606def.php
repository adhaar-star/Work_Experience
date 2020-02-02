<?php $__env->startSection('title','Project | Project'); ?>
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
                <div class="row PageTitleGlobal margin-bottom-40">
                    <div class="col-md-3">
                        <h1>Project Scheduling</h1>
                        <?php if(RoleAuthHelper::hasAccess('project.create')!=true): ?>  
                        <a href="javascript:void(0)" class="btn btn-default btn-sm" style="cursor:no-drop; color:#97A7A7;">
                            <?php else: ?>
                            <a href="<?php echo e(url('admin/projectscheduling/create')); ?>" class="btn btn-primary btn-sm"> 
                                <?php endif; ?>
                                <i class="fa fa-plus"></i> Add Project
                            </a>
                    </div>
                    <div class="col-md-9 text-right">
                        <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                        <ul class="list-unstyled breadcrumb breadcrumb-custom">
                            <li>
                                <a href="<?php echo e(url('admin/dashboard')); ?>">Project Management</a>
                            </li>
                            <li>
                                <span>Project Scheduling</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-12">
                    <div>
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Project ID </th>
                                    <th>Project Description</th>
                                    <th>Start Date</th>
                                    <th>Scheduled End Date</th>
                                    <th>Created on</th>
                                    <th>Created by</th>
                                    <th>Changed by</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Project ID </th>
                                    <th>Project Description</th>
                                    <th>Start Date</th>
                                    <th>Scheduled End Date</th>  
                                    <th>Created on</th>
                                    <th>Created by</th>
                                    <th>Changed by</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $__currentLoopData = $project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>    
                                    <td>
                                        <?php if(RoleAuthHelper::hasAccess('project.view')!=true): ?>  
                                        <?php echo e($proj->project_Id); ?>

                                        <?php else: ?>
                                        <a data-toggle="modal" data-target="#table-view-popup_<?php echo e($proj->id); ?>">
                                            <?php echo e($proj->project_Id); ?>

                                            <?php endif; ?>
                                        </a>
                                    </td>
                                    <td><?php echo e($proj->project_desc); ?></td>
                                    <?php
                                    $date = new DateTime($proj->created_at);

                                    $created_date = $date->format('d-m-Y');
                                    
                                    $startdate = new DateTime($proj->start_date);

                                    $started_date = $startdate->format('d-m-Y');
                                    
                                    $enddate = new DateTime($proj->end_date);

                                    $end_date = $enddate->format('d-m-Y')
                                    ?>
                                    <td><?php echo e($started_date); ?></td>
                                    <td><?php echo e($end_date); ?></td>
                                    <td><?php echo e($created_date); ?></td>
                                    <td><?php echo e($proj['user']['name']); ?></td>
                                    <td><?php echo e($proj['userchange']['name']); ?></td>
                                    <td>
                                        <?php if($proj->status=='active'): ?>
                                        <img src="<?php echo e(asset('vendors/common/img/green.png')); ?>" alt="">
                                        <?php else: ?>
                                        <img src="<?php echo e(asset('vendors/common/img/red.png')); ?>" alt="">
                                        <?php endif; ?>
                                    </td>
                                    <td class="action-btn">
                                        <?php if(RoleAuthHelper::hasAccess('projectscheduling.view')!=true): ?>  
                                        <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                            <?php else: ?>
                                            <a href="#" data-toggle="modal" data-target="#table-view-popup_<?php echo e($proj->id); ?>"><?php endif; ?><i class="fa fa-eye" aria-hidden="true"></i> view </a>
                                            <?php if(RoleAuthHelper::hasAccess('projectscheduling.update')!=true): ?>  
                                            <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                <?php else: ?>
                                                <a href="<?php echo e(url('admin/projectscheduling/'.$proj->id.'/edit')); ?>"><?php endif; ?><i class="fa fa-pencil"></i> Edit </a>
                                                <?php echo Form::open(array('route' => array('project.delete',$proj->id), 'method' => 'DELETE','id'=>'delform'.$proj->id)); ?>

                                                <?php if(RoleAuthHelper::hasAccess('project.delete')!=true): ?>  
                                                <a href="javascript:void(0)" class="btn btn-default btn-xs margin-right-1" style="cursor:no-drop; color:#97A7A7;">
                                                    <?php else: ?>
                                                    <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this Project');
                                                              if (res) {
                                                      document.getElementById('delform<?php echo e($proj->id); ?>').submit()
                                                                }"><?php endif; ?><i class="fa fa-trash-o"></i> Delete </a>
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
                                                                                <a href="<?php echo e(url('admin/dashboard')); ?>">Project Management</a>
                                                                            </li>
                                                                            <li>
                                                                                <a href="<?php echo e(url('admin/projectscheduling')); ?>">Project Dashboard</a>
                                                                            </li>
                                                                            <li>
                                                                                <span style="color: #827ca1;">Display Project</span>
                                                                            </li>
                                                                            <li>
                                                                                <span><?php echo e($proj->project_Id); ?></span>
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="static-form">
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Project ID</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static"><?php echo e($proj->project_Id); ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Project Name</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static"><?php echo e($proj->project_name); ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Project Type</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static"><?php echo e($proj['projecttype']['name']); ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Project Description</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static"><?php echo e($proj->project_desc); ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Portfolio Name</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static"><?php echo e($proj['portfolioId']['name']); ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Portfolio ID</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static"><?php echo e($proj['portfolioId']['port_id']); ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Portfolio Type</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static"><?php echo e($proj->portfolio_type); ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Bucket Name</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static"><?php echo e($proj['bucketId']['name']); ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Bucket ID</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static"><?php echo e($proj['bucketId']['bucket_id']); ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Project Location</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static"><?php echo e($proj['locationId']['subrub']); ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Cost Center</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static"><?php echo e($proj['costCentre']['name']); ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Department</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static"><?php echo e($proj['departmentType']['name']); ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Start Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php if(isset($proj->start_date)): ?>
                                                                                <?php
                                                                                $phpdate = strtotime($proj->start_date);
                                                                                $start_date = date('d/M/Y', $phpdate);
                                                                                echo '<p class="form-control-static">' . $start_date . '</p>';
                                                                                ?>
                                                                                <?php else: ?>
                                                                                <p class="form-control-static"></p>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">End Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php if(isset($proj->end_date)): ?>
                                                                                <?php
                                                                                $phpdate = strtotime($proj->end_date);
                                                                                $end_date = date('d/M/Y', $phpdate);
                                                                                echo '<p class="form-control-static">' . $end_date . '</p>';
                                                                                ?>
                                                                                <?php else: ?>
                                                                                <p class="form-control-static"></p>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Actual Start Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php if(isset($proj->a_start_date)): ?>
                                                                                <?php
                                                                                $phpdate = strtotime($proj->a_start_date);
                                                                                $a_start_date = date('d/M/Y', $phpdate);
                                                                                echo '<p class="form-control-static">' . $a_start_date . '</p>';
                                                                                ?>
                                                                                <?php else: ?>
                                                                                <p class="form-control-static"></p>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Actual End Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php if(isset($proj->a_end_date)): ?>
                                                                                <?php
                                                                                $phpdate = strtotime($proj->a_end_date);
                                                                                $a_end_date = date('d/M/Y', $phpdate);
                                                                                echo '<p class="form-control-static">' . $a_end_date . '</p>';
                                                                                ?>
                                                                                <?php else: ?>
                                                                                <p class="form-control-static"></p>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Forecast Start Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php if(isset($proj->f_start_date)): ?>
                                                                                <?php
                                                                                $phpdate = strtotime($proj->f_start_date);
                                                                                $f_start_date = date('d/M/Y', $phpdate);
                                                                                echo '<p class="form-control-static">' . $f_start_date . '</p>';
                                                                                ?>
                                                                                <?php else: ?>
                                                                                <p class="form-control-static"></p>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Forecast End Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php if(isset($proj->f_end_date)): ?>
                                                                                <?php
                                                                                $phpdate = strtotime($proj->f_end_date);
                                                                                $f_end_date = date('d/M/Y', $phpdate);
                                                                                echo '<p class="form-control-static">' . $f_end_date . '</p>';
                                                                                ?>
                                                                                <?php else: ?>
                                                                                <p class="form-control-static"></p>
                                                                                <?php endif; ?>

                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Scheduled Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php if(isset($proj->sch_date)): ?>
                                                                                <?php
                                                                                $phpdate = strtotime($proj->sch_date);
                                                                                $sch_date = date('d/M/Y', $phpdate);
                                                                                echo '<p class="form-control-static">' . $sch_date . '</p>';
                                                                                ?>
                                                                                <?php else: ?>
                                                                                <p class="form-control-static"></p>
                                                                                <?php endif; ?>

                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Planned Start Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php if(isset($proj->p_start_date)): ?>
                                                                                <?php
                                                                                $phpdate = strtotime($proj->p_start_date);
                                                                                $p_start_date = date('d/M/Y', $phpdate);
                                                                                echo '<p class="form-control-static">' . $p_start_date . '</p>';
                                                                                ?>
                                                                                <?php else: ?>
                                                                                <p class="form-control-static"></p>
                                                                                <?php endif; ?>

                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Planned End Date</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php if(isset($proj->p_end_date)): ?>
                                                                                <?php
                                                                                $phpdate = strtotime($proj->p_end_date);
                                                                                $p_end_date = date('d/M/Y', $phpdate);
                                                                                echo '<p class="form-control-static">' . $p_end_date . '</p>';
                                                                                ?>
                                                                                <?php else: ?>
                                                                                <p class="form-control-static"></p>
                                                                                <?php endif; ?>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Created On</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php
                                                                                $date = new DateTime($proj->created_at);

                                                                                $created_date = $date->format('d/M/Y');
                                                                                ?>
                                                                                <p class="form-control-static"><?php echo e($created_date); ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Created By</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static"><?php echo e($proj['user']['name']); ?></p>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group popup-brd-btm">
                                                                            <div class="col-sm-5">
                                                                                <p class="form-control-static">Status</p>
                                                                            </div>
                                                                            <div class="col-sm-5">
                                                                                <?php if($proj->status == 'active'): ?>
                                                                                <img src="<?php echo e(asset('vendors/common/img/green.png')); ?>" alt="">
                                                                                <?php else: ?>
                                                                                <img src="<?php echo e(asset('vendors/common/img/red.png')); ?>" alt="">
                                                                                <?php endif; ?>    
                                                                            </div> 
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <span class="edit-btn"><a href="<?php echo e(url('admin/project/'.$proj->id.'/edit')); ?>" class="btn btn-primary">Edit</a></span>

                                                                    <?php if($projectId != 0 || $projectId != null): ?>
                                                                    ss<span class="edit-btn"><a onclick="redirectToBack(<?php echo e($proj->id); ?>,<?php echo e($portId); ?>)"  id=backButton class="btn btn-primary">Back</a></span>
                                                                    <?php else: ?>
                                                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                                    <?php endif; ?>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- End  -->

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
                                                    <!-- End  -->


                                                    <?php if($projectId != 0 || $projectId != null): ?>
                                                    <script>
                                                              $('#table-view-popup_<?php echo e($projectId); ?>').modal('show');
                                                              $(document).ready(function(){
                                                      $('#portfolio_id').trigger('change');
                                                      });
                                                              function redirectToBack(projId, portfolioId){
                                                              $('#table-view-popup_<?php echo e($projectId); ?>').modal('hide');
                                                                      window.location.href = '/admin/portfolioStructure/' + projId + '/' + portfolioId;
                                                              }
                                                    </script>
                                                    <?php endif; ?>

                                                    <?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>