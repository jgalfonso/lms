<div id="left-sidebar" class="sidebar">
    <div class="navbar-brand">
        <a href="index.html"><img src="assets/images/icon-color.svg" alt="Oculux Logo" class="img-fluid logo"><span style="margin-left: 5px;">a<b>LMS</b> DHVSU V2.0.1</span></a>
        <button type="button" class="btn-toggle-offcanvas btn btn-sm float-right"><i class="lnr lnr-menu icon-close"></i></button>
    </div>

    <div class="sidebar-scroll">
        <div class="user-account" style="text-align: center; margin: 20px 10px 0 10px;">
            <div class="user_div">
                <img src="assets/images/avatar.jpg" class="user-photo" alt="Avatar" >
            </div>
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>Administrator</strong></a>
                <ul class="dropdown-menu dropdown-menu-right account vivify flipInY">
                    <li><a href="page-profile.html"><i class="icon-user"></i>My Profile</a></li>
                    <li><a href="app-inbox.html"><i class="icon-envelope-open"></i>Messages</a></li>
                    <li><a href="javascript:void(0);"><i class="icon-settings"></i>Settings</a></li>
                    <li class="divider"></li>
                    <li><a href="page-login.html"><i class="icon-power"></i>Logout</a></li>
                </ul>
            </div>
        </div>

        @include('admin.includes.sidebar_nav')
    </div>
</div>