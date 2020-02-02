<?php $__env->startSection('title','Portfolio | Buckets'); ?>
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
                            <span class="hidden-lg-down">Portfolio Management</span>
                            <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="" role="menu">
                            <a class="dropdown-item" href="<?php echo e(url('admin/portfolio')); ?>">Portfolio</a>
                            <a class="dropdown-item" href="<?php echo e(url('admin/buckets')); ?>">Buckets</a>
                            <a class="dropdown-item" href="<?php echo e(url('admin/portfolioStructure')); ?>">Portfolio Structure</a>
                            <a class="dropdown-item" href="<?php echo e(url('admin/bucketfp')); ?>">Portfolio Financial Plaining</a>
                            <a class="dropdown-item" href="<?php echo e(url('admin/portfolioresourceplanning')); ?>">Portfolio Resource Plaining</a>
                            <!--div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="#"><i class="dropdown-icon icmn-cog"></i> Settings</a-->
                        </ul>
                    </div>
                </div>
                <div class="margin-bottom-50">
                    <span style="margin-right: 10px;position: relative;top: -20px;">You are here:</span>
                    <ul class="list-unstyled breadcrumb breadcrumb-custom">
                        <li>
                            <a href="<?php echo e(url('admin/dashboard')); ?>">Portfolio Management</a>
                        </li>
                        <li>
                            <span>Bucket Dashboard</span>
                        </li>
                    </ul>
                </div>
                <h4>Buckets</h4>
                <div class="dashboard-buttons">
                    <a href="<?php echo e(url('admin/buckets/create')); ?>" class="btn btn-primary">
                        <i class="fa fa-send margin-right-5"></i>
                        Create Bucket
                    </a>
                </div>
                <!--p>Modifier: <code>.table-inverse</code>, <code>.thead-default</code>, <code>.thead-inverse</code>, <code>.table-striped</code>, <code>.table-hovered</code></p-->
                <br />
                <div class="col-md-12">
                    <div class="margin-bottom-50">
                        <table class="table table-inverse" id="example3" width="100%">
                            <thead>
                                <tr>
                                    <th>Parent Name</th>
                                    <th>Portfolio ID</th>
                                    <th>Bucket ID</th>
                                    <th>Bucket Name</th>
                                    <th>Status</th>
                                    <th>Created on</th>
                                    <th>Currency</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Parent Name</th>
                                    <th>Portfolio ID</th>
                                    <th>Bucket ID</th>
                                    <th>Bucket Name</th>
                                    <th>Status</th>
                                    <th>Created on</th>
                                    <th>Currency</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>                       
                                <?php $__currentLoopData = $buckets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $buck): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php //echo "<pre>";print_r($buck);die;?>
                                <?php if($buck->children->count() >= 0): ?>
                                <tr>
                                    <td>
                                        <?php
                                        if ($buck->parent_bucket == '') {
                                            echo "N/A";
                                        } else {
                                            echo $buck->name;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo e($buck['portfolio']['port_id']); ?></td>
                                    <td><?php echo e($buck->bucket_id); ?></td>
                                    <td><?php echo e($buck->name); ?></td>
                                    <td>
                                        <?php if($buck->status=='active'): ?>
                                        <img src="<?php echo e(asset('vendors/common/img/green.png')); ?>" alt="">

                                        <?php else: ?>
                                        <img src="<?php echo e(asset('vendors/common/img/red.png')); ?>" alt="">

                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <?php
                                        $createdate = strtotime($buck->created_at);
                                        $created_at = date('d/M/Y', $createdate);
                                        ?>
                                        <?php echo e($created_at); ?>

                                    </td>
                                    <td><?php echo e($buck['currencyname']['short_code']); ?></td>
                                    <td class="action-btn">

                                        <a href="#" class="btn btn-info btn-xs margin-right-1" data-toggle="modal" data-target="#table-view-popup_<?php echo e($buck->id); ?>"><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>

                                        <a href="<?php echo e(url('admin/buckets/'.$buck->id.'/edit')); ?>" class="btn btn-info btn-xs margin-right-1"><i class="fa fa-pencil"></i> <!--Edit--> </a>

                                        <?php echo Form::open(array('route' => array('buckets.delete',$buck->id), 'method' => 'DELETE','id'=>'delform'.$buck->id)); ?>

                                        <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this buckets');
                                                    if (res) {
                                            document.getElementById('delform<?php echo e($buck->id); ?>').submit()
                                                        }" class="btn btn-danger btn-xs margin-0"><i class="fa fa-trash-o"></i> <!--Delete--> </a>

                                        <?php echo Form::close(); ?>


                                        <div class="modal fade table-view-popup" id="table-view-popup_<?php echo e($buck->id); ?>" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="text-align:left;">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <div class="margin-bottom-10">
                                                            <ul class="list-unstyled breadcrumb">
                                                                <li>
                                                                    <a href="<?php echo e(url('admin/dashboard')); ?>">Portfolio Management</a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?php echo e(url('admin/buckets')); ?>">Bucket</a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?php echo e(url('admin/buckets/create')); ?>">Display Bucket</a>
                                                                </li>
                                                                <li>
                                                                    <span><?php echo e($buck->name); ?></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="static-form">
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Bucket Name</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static"><?php echo e($buck->name); ?></p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Bucket ID</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static"><?php echo e($buck->bucket_id); ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Portfolio Name</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static"><?php echo e($buck['portfolio']['name']); ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Portfolio ID</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static"><?php echo e($buck['portfolio']['port_id']); ?></p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Description</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">
                                                                        <?php if($buck->description !=''): ?> <?php echo e($buck->description); ?> <?php else: ?>  No Description Found   <?php endif; ?> 

                                                                    </p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Cost Center</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static"><?php if($buck['costcentre_name']['name']!=''): ?> <?php echo e($buck['costcentre_name']['name']); ?> <?php else: ?>  Not Updated   <?php endif; ?> </p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Department</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">
                                                                        <?php if($buck['department_name']['name']!=''): ?> <?php echo e($buck['department_name']['name']); ?> <?php else: ?>  Not Updated   <?php endif; ?>
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
                                                                        $createdate = strtotime($buck->created_at);
                                                                        $created_at = date('d/M/Y', $createdate);
                                                                        ?>
                                                                        <?php echo e($created_at); ?>

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
                                                                        $updatedate = strtotime($buck->updated_at);
                                                                        $updated_at = date('d/M/Y', $updatedate);
                                                                        ?>
                                                                        <?php echo e($updated_at); ?>

                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Created By</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static"><?php echo e($buck['creator']['name']); ?></p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Changed By</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static"><?php echo e((isset($buck['updator'])) ? $buck['updator']['name'] : ""); ?></p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Status</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">
                                                                        <?php if($buck->status=='active'): ?>
                                                                        <img src="<?php echo e(asset('vendors/common/img/green.png')); ?>" alt="">
                                                                        <?php else: ?>
                                                                        <img src="<?php echo e(asset('vendors/common/img/red.png')); ?>" alt="">
                                                                        <?php endif; ?> 
                                                                    </p>
                                                                </div>
                                                            </div>

                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <span class="edit-btn"><a href="<?php echo e(url('admin/buckets/'.$buck->id.'/edit')); ?>" class="btn btn-primary">Edit</a></span>
                                                        <!--<?php echo e(url('admin/portfolioStructure/'.$portId)); ?>-->
                                                        <?php if($bucketId != 0 || $bucketId != null): ?>
                                                            <span class="edit-btn"><a onclick="redirectToBack(<?php echo e($buck->id); ?>,<?php echo e($portId); ?>)"  id=backButton class="btn btn-primary">Back</a></span>
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
                                <?php $__currentLoopData = $buck->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $submenu): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>   

                                    <td>
                                        <?php
                                        if ($submenu->parent_bucket == '') {
                                            echo "N/A";
                                        } else {
                                            echo $buck->name;
                                        }
                                        ?>
                                    </td>
                                    <td><?php echo e($submenu['portfolio']['port_id']); ?></td>
                                    <td><?php echo e($submenu->bucket_id); ?></td>   
                                    <td>&nbsp; |_ <?php echo e($submenu->name); ?></td>
                                    <td>
                                        <?php if($submenu->status=='active'): ?>
                                        <img src="<?php echo e(asset('vendors/common/img/green.png')); ?>" alt="">

                                        <?php else: ?>
                                        <img src="<?php echo e(asset('vendors/common/img/red.png')); ?>" alt="">

                                        <?php endif; ?>
                                    </td>

                                    <td>
                                        <?php
                                        $createDate = strtotime($submenu->created_at);
                                        $created_at = date('d/M/Y', $createDate);
                                        ?>
                                        <?php echo e($created_at); ?>

                                    </td>

                                    <td><?php echo e($submenu['currencyname']['short_code']); ?></td>
                                    <td class="action-btn">
                                        <a href="#" class="btn btn-info btn-xs" data-toggle="modal" data-target="#bucket-view-popup"><i class="fa fa-eye" aria-hidden="true"></i> <!--view--> </a>
                                        <a href="<?php echo e(url('admin/buckets/'.$submenu->id.'/edit')); ?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> <!--Edit--> </a>
                                        <form action="<?php echo e(url('admin/buckets/'.$submenu->id)); ?>" method="post" id="delform">
                                            <?php echo e(method_field('DELETE')); ?>

                                            <?php echo e(csrf_field()); ?>

                                            <a href="javascript:void(0)" onclick="var res = confirm('Are you sure you want to delete this Bucket');
                                                                if (res) {
                                                        document.getElementById('delform').submit()
                                                        }" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> <!--Delete--> </a>
                                        </form>

                                        <div class="modal fade table-view-popup" id="bucket-view-popup" tabindex="-1" role="dialog" aria-labelledby="" aria-hidden="true">
                                            <div class="modal-dialog" role="document" style="text-align:left;">
                                                <div class="modal-content">

                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                        <div class="margin-bottom-10">
                                                            <ul class="list-unstyled breadcrumb">
                                                                <li>
                                                                    <a href="<?php echo e(url('admin/dashboard')); ?>">Portfolio Management</a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?php echo e(url('admin/buckets')); ?>">Bucket</a>
                                                                </li>
                                                                <li>
                                                                    <a href="<?php echo e(url('admin/buckets/create')); ?>">Display Bucket</a>
                                                                </li>
                                                                <li>
                                                                    <span><?php echo e($submenu->name); ?></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form class="static-form">
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Bucket Name</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static"><?php echo e($submenu->name); ?></p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Bucket ID</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static"><?php echo e($submenu->bucket_id); ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Portfolio Name</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static"><?php echo e($submenu['portfolio']['name']); ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Portfolio ID</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static"><?php echo e($submenu['portfolio']['port_id']); ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Description</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static"><?php echo e($submenu->description); ?></p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Cost Center</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static"><?php echo e($submenu['costcentre_name']['name']); ?></p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Department</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static"><?php echo e($submenu['department_name']['name']); ?></p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Created On</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">
                                                                        <?php
                                                                        $createdate = strtotime($submenu->created_at);
                                                                        $created_at = date('d/M/Y', $createdate);
                                                                        ?>
                                                                        <?php echo e($created_at); ?>

                                                                    </p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Created By</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static"><?php echo e($submenu['creator']['name']); ?></p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Changed By</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static"><?php echo e((isset($buck['updator'])) ? $buck['updator']['name'] : ""); ?></p>
                                                                </div>
                                                            </div>

                                                            <div class="form-group popup-brd-btm">
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">Status</p>
                                                                </div>
                                                                <div class="col-sm-5">
                                                                    <p class="form-control-static">
                                                                        <?php if($submenu->status=='active'): ?>
                                                                        <img src="<?php echo e(asset('vendors/common/img/green.png')); ?>" alt="">

                                                                        <?php else: ?>
                                                                        <img src="<?php echo e(asset('vendors/common/img/red.png')); ?>" alt="">

                                                                        <?php endif; ?>
                                                                    </p>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <span class="edit-btn"><a href="<?php echo e(url('admin/buckets/'.$submenu->id.'/edit')); ?>" class="btn btn-primary">Edit</a></span>
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                        <!-- End  -->

                                    </td>
                                </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
 <?php if($bucketId != 0 || $bucketId != null): ?>
<script>
    $('#table-view-popup_<?php echo e($bucketId); ?>').modal('show');
    function redirectToBack(bucketId,portfolioId){
        $('#table-view-popup_<?php echo e($bucketId); ?>').modal('hide');
        window.location.href = '/admin/portfolioStructure/'+bucketId+'/'+portfolioId
    }
</script>
 <?php endif; ?>
<!-- End  -->


<?php $__env->stopSection(); ?>
<?php echo $__env->make('layout.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>