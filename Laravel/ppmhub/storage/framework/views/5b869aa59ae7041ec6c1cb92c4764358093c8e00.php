<?php $__env->startSection('title','Project Management | Project Structure'); ?>
<?php $__env->startSection('body'); ?>
<?php echo Html::style('/css/Treant.css'); ?>

<?php echo Html::style('/css/custom-colored.css'); ?>

<?php echo Html::script('/js/raphael.js'); ?>

<?php echo Html::script('/js/Treant.js'); ?>

<?php echo Html::script('/js/project_chart.js'); ?>

<?php if(Session::has('flash_message')): ?>
<div class="alert alert-success">
  <span class="glyphicon glyphicon-ok"></span>
  <em> <?php echo session('flash_message'); ?></em>
</div>
<?php endif; ?>

<style>
  .tree-struc {
    text-align: center;
  }
  .tree-struc .choose-port1 {
    float: none;
    margin-bottom: 25px;
    margin-right: 0;
    text-align: center;
    font-size:22px;
    margin-top:20px;
  }
  .tree-struc select {
    border-radius: 0;
    float: none;
    height: 46px;
    margin: 0 auto 20px;
    width: 40%;
  }
  .tree li a {
    background-color: #7a2100;
    border: 3px solid #fff;
    border-radius: 0;
    font-family: "Lato", sans;
    padding: 11px 20px;
    text-transform: uppercase;
  }

  .tree li a:hover, .tree li a:hover + ul li a {
    background: #ea6532 none repeat scroll 0 0;
    border: 3px solid #fff;
    color: #fff;
  }
</style>
<section id="client-information" class="client-information">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="tree-struc">
          
            <select class="form-control projectStructure" onchange="renderProjectStructure(this);"  name="projectId" id="projectId">
              <option selected="selected" value="">Choose your project</option>
              <?php $__currentLoopData = $project; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $proj): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <option value="<?php echo e($proj->id); ?>"  <?php echo e(($proj->id == $projectId) ? 'selected': ''); ?>><?php echo e($proj->project_name); ?></option>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
      </div>
    </div>
  </div>
</section>

<div id="tree-chart"></div>

<?php if($projectId != 0 || $projectId != null): ?>
<script>
   
   $(document).ready(function(){
        $('#projectId').trigger('change');
    }); 
      
</script>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.adminlayout', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>