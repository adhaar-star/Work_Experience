<?php $__env->startSection('title','Home Page'); ?>
<?php echo Html::style('css/pricing/style.css'); ?>

<?php $__env->startSection('body'); ?>
<style>
    .logo {padding: 15px 0;}
</style>
<section id="service" class="pricing">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="price_outer">
                    <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="price_main">
                        <div class="price_heading define_float">
                            <h2><?php echo e($plan->name); ?></h2>
                        </div>
                        <div class="price_monthly define_float">
                            <span class="price_currency">$</span>
                            <span class="price_number"><?php echo e(number_format($plan->cost, 2)); ?></span>
                            <span class="price_duration">/ Monthly</span>
                        </div>
                        <div class="price_features define_float">
                            <ul>
                                <?php if($plan->description): ?>
                                <?php echo $plan->description; ?>

                                <?php endif; ?>
                            </ul>
                        </div>
                        <div class="price_cart_button define_float">
                            <a href="<?php echo e(url('/register?plan='.$plan->slug)); ?>">Add to cart</a>
                        </div>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>