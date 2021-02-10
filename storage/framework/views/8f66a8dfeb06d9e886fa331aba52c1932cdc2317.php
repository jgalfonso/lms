<?php
    $name = Request::segments()[0];
    $prefix = Request::segments()[1];
    $action = (isset(Request::segments()[2])) ? Request::segments()[2] : '';
?>

<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="<?php echo e(url('/admin/dashboard')); ?>">Home</a></li>
        <li class="breadcrumb-item"><a style="cursor: not-allowed;"><?php echo e(ucfirst($name)); ?></a></li>

        <?php if($action): ?>
            <li class="breadcrumb-item"><a href="<?php echo e(url($name .'/'. $prefix)); ?>"><?php echo e(ucwords(str_replace('_', ' ', $prefix))); ?></a></li>

            <?php if($action == 'view'): ?>
                <li class="breadcrumb-item active" aria-current="page"><b>ID: <?php echo e($id); ?> - <mark class="text-uppercase text-info"><?php echo e(${$prefix}->internal_status_description); ?></mark></b></li>
            <?php else: ?>
                <li class="breadcrumb-item active" aria-current="page"><?php echo e(ucfirst($action)); ?></li>
            <?php endif; ?>
        <?php else: ?>
            <li class="breadcrumb-item active" aria-current="page"><?php echo e(str_replace('Of', 'of', ucwords(str_replace('_', ' ', $prefix)))); ?></li>
        <?php endif; ?>
    </ol>
</nav>
<?php /**PATH /Users/alfonsojg/Sites/lms/resources/views/admin/includes/breadcrumb.blade.php ENDPATH**/ ?>