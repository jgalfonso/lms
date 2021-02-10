<!doctype html>
<html lang="en">
<?php echo $__env->make('admin.includes.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

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

    <!-- Theme Setting -->
    <div class="themesetting">
        <a href="javascript:void(0);" class="theme_btn"><i class="icon-magic-wand"></i></a>
        <div class="card setting_switch">
            <div class="header">
                <h2>Settings</h2>
            </div>
            <ul class="list-group">
                <li class="list-group-item">
                    Light Version
                    <div class="float-right">
                        <label class="switch">
                            <input type="checkbox" class="lv-btn" checked>
                            <span class="slider round"></span>
                        </label>
                    </div>
                </li>
                <li class="list-group-item">
                    RTL Version
                    <div class="float-right">
                        <label class="switch">
                            <input type="checkbox" class="rtl-btn">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </li>
                <li class="list-group-item">
                    Horizontal Henu
                    <div class="float-right">
                        <label class="switch">
                            <input type="checkbox" class="hmenu-btn" >
                            <span class="slider round"></span>
                        </label>
                    </div>
                </li>
                <li class="list-group-item">
                    Mini Sidebar
                    <div class="float-right">
                        <label class="switch">
                            <input type="checkbox" class="mini-sidebar-btn">
                            <span class="slider round"></span>
                        </label>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <!-- Overlay For Sidebars -->
    <div class="overlay"></div>

    <div id="wrapper">

        <nav class="navbar top-navbar">
            <div class="container-fluid">
                <?php echo $__env->make('admin.includes.top_nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <div class="progress-container"><div class="progress-bar" id="myBar"></div></div>
        </nav>

        <?php echo $__env->make('admin.includes.msc', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <?php echo $__env->make('admin.includes.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

        <div id="main-content" style="padding-bottom: 30px;">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row clearfix">
                        <?php echo $__env->yieldContent('breadcrumb'); ?>
                    </div>
                </div>
                <!-- CONTENT -->
                <?php echo $__env->yieldContent('content'); ?>
            </div>
        </div>
    </div>

    <?php echo $__env->make('admin.includes.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH /Users/alfonsojg/Sites/lms/resources/views/admin/template.blade.php ENDPATH**/ ?>