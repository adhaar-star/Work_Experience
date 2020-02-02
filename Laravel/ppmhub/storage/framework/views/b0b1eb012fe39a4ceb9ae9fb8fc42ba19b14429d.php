<!DOCTYPE html>
<html lang="<?php echo e(config('app.locale')); ?>">
    <head>
        <meta charset="utf-8">      
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Online Project Planning Software | <?php echo $__env->yieldContent('title'); ?></title>
        <!-- Favicon | Icon Script -->
        <link rel="icon" type="image/png" href="<?php echo e(asset('new_images/common/icon.png')); ?>" />
        <link rel="stylesheet" media="screen" href="<?php echo e(asset('css/openSans.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('materialize/css/materialize.min.css')); ?>">
        <link rel="stylesheet" type="text/css" href="<?php echo e(asset('vendors/font-awesome/css/font-awesome.min.css')); ?>">
        <link href="<?php echo e(asset('new_css/common.css')); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?php echo e(asset('new_css/frontweb.css')); ?>" rel="stylesheet" type="text/css"/>

        <script src="<?php echo e(asset('vendors/jquery/dist/jquery.min.js')); ?>" type="text/javascript"></script>
        <script src="<?php echo e(asset('materialize/js/materialize.min.js')); ?>" type="text/javascript"></script>
        <script type="text/javascript" src="http://www.ppmhub.com.au/public/jarvis/widget"></script>
        <?php echo $__env->yieldContent('braintree'); ?>
    </head>
    <body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">
        <?php echo $__env->make('include.navbar', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>


        <?php $__env->startSection('body'); ?>
        <?php echo $__env->yieldSection(); ?>

      
        <?php echo $__env->make('include.footer', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   

    </body>
</html>
