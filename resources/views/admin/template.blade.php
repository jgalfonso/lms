<!doctype html>
<html lang="en">
@include('admin.includes.header')

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
                @include('admin.includes.top_nav')
            </div>
            <div class="progress-container"><div class="progress-bar" id="myBar"></div></div>
        </nav>

        @include('admin.includes.msc')

        @include('admin.includes.sidebar')

        <div id="main-content" style="padding-bottom: 30px;">
            <div class="container-fluid">
                <div class="block-header">
                    <div class="row clearfix">
                        @yield('breadcrumb')
                    </div>
                </div>
                <!-- CONTENT -->
                @yield('content')
            </div>
        </div>
    </div>

    @include('admin.includes.footer')
</body>
</html>
