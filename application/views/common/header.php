<body>
    <!-- Navigation Bar-->
    <header id="topnav">
        <div class="topbar-main">
            <div class="container-fluid">
                <!-- Logo container-->
                <div class="logo">
                    <!-- Text Logo -->
                    <!--<a href="index.html" class="logo">-->
                    <!--UBold-->
                    <!--</a>-->
                    <!-- Image Logo -->
                    <a href="index.html" class="logo">
                        <img src="<?php echo getImage('logo_new.png'); ?>" alt=""  class="logo-lg">
                        <img src="<?php echo getImage('logo_new.png'); ?>" alt=""  class="logo-sm">
                    </a>

                </div>
                <!-- End Logo container-->


                <div class="menu-extras topbar-custom">

                    <ul class="list-inline float-right mb-0">

                        <li class="menu-item list-inline-item">
                            <!-- Mobile menu toggle-->
                            <a class="navbar-toggle nav-link">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                            <!-- End mobile menu toggle-->
                        </li>
                        <li class="list-inline-item dropdown notification-list">
                            <a class="nav-link dropdown-toggle waves-effect waves-light nav-user" data-toggle="dropdown" href="#" role="button"
                               aria-haspopup="false" aria-expanded="false">
                                <img src="<?php echo getImage('avatar-1.jpg'); ?>" alt="user" class="rounded-circle">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right profile-dropdown " aria-labelledby="Preview">
                                <a href="<?php echo site_url('logout'); ?>" class="dropdown-item notify-item">
                                    <i class="zmdi zmdi-power"></i> <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="clearfix"></div>
            </div> <!-- end container -->
        </div>
        <!-- end topbar-main -->

        <div class="navbar-custom">
            <div class="container-fluid">
                <div id="navigation">
                    <!-- Navigation Menu-->
                    <ul class="navigation-menu">
                        <li <?php echo (getController(TRUE) == 'Dashboard')?('class="active"'):(''); ?>>
                            <a href="<?php echo site_url('dashboard'); ?>"><i class="md md-dashboard"></i>Dashboard</a>
                        </li>
                        <li <?php echo (getController(TRUE) == 'Users')?('class="active"'):(''); ?>>
                            <a href="<?php echo site_url('users'); ?>"><i class="fa fa-users"></i>Users</a>
                        </li>
                        <li <?php echo (getController(TRUE) == 'Customers')?('class="active"'):(''); ?>>
                            <a href="<?php echo site_url('customers'); ?>"><i class="fa fa-users"></i>Customers</a>
                        </li>
                    </ul>
                    <!-- End navigation menu -->
                </div> <!-- end #navigation -->
            </div> <!-- end container -->
        </div> <!-- end navbar-custom -->
    </header>
    <!-- End Navigation Bar-->