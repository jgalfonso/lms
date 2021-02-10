<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('css'); ?>
    
<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <div class="col-md-6 col-sm-12">
        <h1>Dashboard</h1>

        <?php echo $__env->make('admin.includes.breadcrumb', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
	<div class="row clearfix">
       
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
	
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.template', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /Users/alfonsojg/Sites/lms/resources/views/admin/main/dashboard/index.blade.php ENDPATH**/ ?>