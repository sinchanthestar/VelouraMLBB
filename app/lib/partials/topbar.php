    <!-- Topbar Start -->
    <div class="navbar-custom">
        <div class="container-fluid">
            <ul class="list-unstyled topnav-menu float-right mb-0">
                <?php
            if (isset($_SESSION['login']))
            { ?>
                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user mr-0 waves-effect waves-light" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="<?php echo $config['web']['base_url'] ?>assets/images/users/man.svg" alt="user-image" class="rounded-circle" />
                        <span class="pro-user-name ml-1">
                            <?php echo $login['username'] ?>
                            <i class="mdi mdi-chevron-down"> </i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right profile-dropdown">
                        <!-- item-->
                        <div class="dropdown-header noti-title">
                            <h6 class="text-overflow m-0">Welcome !</h6>
                        </div>
                        <!-- item-->
                        <a href="<?php echo $config['web']['base_url'] ?>user/settings.php" class="dropdown-item notify-item">
                            <i data-feather="user" class="icons-xs icon-dual-primary mr-1"></i>
                            <span> Pengaturan Akun </span>
                        </a>
                        <!-- item-->
                        <a href="<?php echo $config['web']['base_url'] ?>user/log_balance_usage.php" class="dropdown-item notify-item">
                            <i data-feather="repeat" class="icons-xs icon-dual-primary mr-1"></i>
                            <span> Mutasi Saldo </span>
                        </a>
                        <?php
                        if ($login['level'] == 'Admin') {
                        ?>
                        <a href="<?php echo $config['web']['base_url'] ?>order/durasi.php" class="dropdown-item notify-item">
                            <i data-feather="refresh-cw" class="icons-xs icon-dual-primary mr-1"></i>
                            <span> Key List </span>
                        </a>
                        <?php
                        }else{
                        ?>
                        <a href="<?php echo $config['web']['base_url'] ?>order/key.php" class="dropdown-item notify-item">
                            <i data-feather="refresh-cw" class="icons-xs icon-dual-primary mr-1"></i>
                            <span> Key List </span>
                        </a>
                        <?php
                        }
                        ?>
                        <!-- item-->
                        <a href="<?php echo $config['web']['base_url'] ?>user/log_login.php" class="dropdown-item notify-item">
                            <i data-feather="refresh-cw" class="icons-xs icon-dual-primary mr-1"></i>
                            <span> Riwayat Login </span>
                        </a>
                        <div class="dropdown-divider"></div>
                        <!-- item-->
                        <a href="<?php echo $config['web']['base_url'] ?>logout.php" class="dropdown-item notify-item">
                            <i data-feather="log-out" class="icons-xs icon-dual-primary mr-1"></i>
                            <span> Logout </span>
                        </a>
                    </div>
                </li>
                <?php
            }
            ?>
            </ul>
            <!-- end Topbar -->
            <div class="logo-box">
                <a href="javascript:void(0);" class="logo logo-dark text-center">
                    <span class="logo-sm">
                        <!--logo 1-->
                        <img src="<?php echo $config['web']['base_url'] ?>assets/images/favicon.ico" alt="icon-web" height="30" />
                    </span>
                    <a href="javascript:void(0);" class="logo logo-dark text-center">
                        <span class="logo-lg">
                            <img src="<?php echo $config['web']['base_url'] ?>assets/images/favicon.ico" alt="icon-web" height="30" />
                            <span class="logo-lg-text-dark"><?php echo $config['web']['title']; ?></span>
                        </span>
                    </a>
            </div>
            <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
                <li>
                    <button class="button-menu-mobile waves-effect waves-light">
                        <i class="fe-menu"> </i>
                    </button>
                </li>
                <li>
                    <!-- Mobile menu toggle (Horizontal Layout)-->
                    <a class="navbar-toggle nav-link" data-toggle="collapse" data-target="#topnav-menu-content">
                        <div class="lines">
                            <span> </span>
                            <span> </span>
                            <span> </span>
                        </div>
                    </a>
                    <!-- End mobile menu toggle-->
                </li>
            </ul>
            <div class="clearfix"></div>
        </div>
    </div>
    <!-- end Topbar -->
    