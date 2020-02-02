<?php $__env->startSection('body'); ?>

    <meta http-equiv="Content-type" content="text/html; charset=utf-8">
    <script src="<?php echo e(URL::to('/')); ?>/public/dhtmlx/dhtmlx.js"></script>
    <link href="<?php echo e(URL::to('/')); ?>/public/dhtmlx/dhtmlx.css" rel="stylesheet">



    <div id="gantt_here" style='width:100%; height:250px;'></div>
    
    <script type="text/javascript">
    gantt.config.xml_date = "%Y-%m-%d %H:%i:%s";
 
gantt.init("gantt_here");
 
gantt.load("<?php echo e(URL::to('/')); ?>/admin/gantt_data");

    </script>
</body>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>