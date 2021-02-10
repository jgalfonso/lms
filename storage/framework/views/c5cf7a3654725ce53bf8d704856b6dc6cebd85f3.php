<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<title>aLMS - DHVSU</title>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
<meta name="description" content="aLMS - DHVSU Student Portal">
<meta name="author" content="Datadynamix, design by: j alfonso">
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

<link rel="icon" href="<?php echo e(URL::asset('favicon.ico')); ?>" type="image/x-icon">
<!-- VENDOR CSS -->

<link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendor/bootstrap/css/bootstrap.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendor/font-awesome/css/font-awesome.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendor/animate-css/vivify.min.css')); ?>">

<link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendor/c3/c3.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendor/chartist/css/chartist.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendor/chartist-plugin-tooltip/chartist-plugin-tooltip.css')); ?>">
<link rel="stylesheet" href="<?php echo e(URL::asset('assets/vendor/jvectormap/jquery-jvectormap-2.0.3.CSS')); ?>">

<!-- MAIN CSS -->
<link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/site.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(URL::asset('assets/css/custom.css')); ?>">

<body class="theme-cyan font-montserrat light_version">

<!-- Page Loader -->
<div class="page-loader-wrapper">
    <div class="loader">
        <div class="bar1"></div>
        <div class="bar2"></div>
        <div class="bar3"></div>
        <div class="bar4"></div>
        <div class="bar5"></div>
    </div>
</div>



<div class="overlay"></div>

<div id="wrapper">
	<div id="root"></div>
</div>

<script src="<?php echo e(asset('js/app.js')); ?>"></script>

<script src="<?php echo e(URL::asset('assets/bundles/libscripts.bundle.js')); ?>"></script>   
<script src="<?php echo e(URL::asset('assets/bundles/vendorscripts.bundle.js')); ?>"></script> 

<script src="<?php echo e(URL::asset('assets/bundles/c3.bundle.js')); ?>"></script> 
<script src="<?php echo e(URL::asset('assets/bundles/flotscripts.bundle.js')); ?>"></script> 
<script src="<?php echo e(URL::asset('assets/bundles/jvectormap.bundle.js')); ?>"></script> 
<script src="<?php echo e(URL::asset('assets/vendor/jvectormap/jquery-jvectormap-us-aea-en.js')); ?>"></script> 

<script src="<?php echo e(URL::asset('assets/bundles/mainscripts.bundle.js')); ?>"></script> 

<script src="<?php echo e(URL::asset('assets/js/hrdashboard.js')); ?>"></script> 

</body>
</html><?php /**PATH /Users/alfonsojg/Sites/lms/resources/views/index.blade.php ENDPATH**/ ?>