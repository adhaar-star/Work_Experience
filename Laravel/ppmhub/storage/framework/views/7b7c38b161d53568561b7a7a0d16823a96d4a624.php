<?php $__env->startSection('title','Project | Project'); ?>
<link href=
"<?php echo e(URL::to('/')); ?>/vendor/swatkins/laravel-gantt/src/assets/css/gantt.css" rel="stylesheet" type="text/css">\
<?php $__env->startSection('body'); ?>
<?php echo $gantt; ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>