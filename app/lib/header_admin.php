<?php
require 'is_login.php';
require 'csrf_token.php';
?>
<!DOCTYPE html>
<html>
    <head>
<?php
require 'partials/title-meta.php';
require 'partials/head-css.php';
?>
    </head>
    
    <body class="loading" data-layout-mode="horizontal" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": true}'>


<!-- Begin page -->
<div id="wrapper">

<?php
require 'partials/topbar.php';
?>

    <div class="topnav shadow-lg">
        <div class="container-fluid">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">                   
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="airplay" class="icons-xs icon-dual-primary mr-1"></i> Dashboard
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                <a href="<?php echo $config['web']['base_url'] ?>admin" class="dropdown-item">Dashboard Admin</a>
                                <a href="<?php echo $config['web']['base_url'] ?>" class="dropdown-item">Dashboard Users </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="users" class="icons-xs icon-dual-primary mr-1"></i> Users
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                <a href="<?php echo $config['web']['base_url'] ?>admin/user" class="dropdown-item">Manage Users </a>
                                <a href="<?php echo $config['web']['base_url'] ?>admin/news/invite.php" class="dropdown-item">Registrtion </a>
                                <a href="<?php echo $config['web']['base_url'] ?>admin/log/login.php" class="dropdown-item">Login logs </a>
                                <a href="<?php echo $config['web']['base_url'] ?>admin/log/balance-usage.php" class="dropdown-item">Balance mutation </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $config['web']['base_url'] ?>admin/ticket">
                                <i data-feather="message-square" class="icons-xs icon-dual-primary mr-1"></i> Tickets
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="credit-card" class="icons-xs icon-dual-primary mr-1"></i> Deposit
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                <a href="<?php echo $config['web']['base_url'] ?>admin/deposit_method" class="dropdown-item">Deposit Methode</a>
                                <a href="<?php echo $config['web']['base_url'] ?>admin/voucher" class="dropdown-item">Voucher </a> 
                                <a href="<?php echo $config['web']['base_url'] ?>admin/deposit" class="dropdown-item">Deposit </a>
                                <a href="<?php echo $config['web']['base_url'] ?>admin/deposit/report.php" class="dropdown-item">Reports </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="shopping-cart" class="icons-xs icon-dual-primary mr-1"></i> Orders
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                <a href="<?php echo $config['web']['base_url'] ?>admin/order" class="dropdown-item">Orders </a>
                                <a href="<?php echo $config['web']['base_url'] ?>admin/order/report.php" class="dropdown-item">Report </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="server" class="icons-xs icon-dual-primary mr-1"></i> Service
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                <a href="<?php echo $config['web']['base_url'] ?>admin/provider" class="dropdown-item">Provider </a>
                                <a href="<?php echo $config['web']['base_url'] ?>admin/category" class="dropdown-item">Categories </a>
                                <a href="<?php echo $config['web']['base_url'] ?>admin/service" class="dropdown-item">Service </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="settings" class="icons-xs icon-dual-primary mr-1"></i> Software Settings
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">                                
                                <a href="<?php echo $config['web']['base_url'] ?>admin/news" class="dropdown-item">Information </a>
                                <a href="<?php echo $config['web']['base_url'] ?>admin/news/restAPI.php" class="dropdown-item">API Setting </a>
                                <a href="<?php echo $config['web']['base_url'] ?>admin/news/downloads.php" class="dropdown-item">Downloads </a>
                                <a href="<?php echo $config['web']['base_url'] ?>admin/news/p_card.php" class="dropdown-item">Profile page </a>
                                <a href="<?php echo $config['web']['base_url'] ?>admin/news/manage.php" class="dropdown-item">Server Setting </a>
                                <a href="<?php echo $config['web']['base_url'] ?>admin/page" class="dropdown-item">Pages </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>

<!-- end topnav-->
<!-- ============================================================== -->
<!-- Start Page Content here -->
<!-- ============================================================== -->
 <div class="content">
     <div class="content-page">

         <!-- Start Content-->
         <div class="container-fluid">

             <!-- start page title -->
             <div class="row">
                 <div class="col-12">
                     <div class="page-title-box">
                         <div class="page-title-right">
                             <ol class="breadcrumb m-0">
                                 <li class="breadcrumb-item"><a href="javascript: void(0);"><?php echo $config['web']['title'] ?></a></li>
                                 <li class="breadcrumb-item active">Dashboard</li>
                             </ol>
                         </div>
                         <h5 class="page-title">Dashboard</h5>
                     </div>
                 </div>
             </div>
             <!-- end page title -->

             <!-- modal -->
             <div class="wrapper">
                 <div class="container-fluid">
                     <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="topModalLabel" aria-hidden="true" style="display: none;">
                         <div class="modal-dialog modal-dialog-top">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h4 class="modal-title" id="modal-title"></h4>
                                     <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                 </div>
                                 <div class="modal-body" id="modal-body"></div>
                                 <div class="modal-footer"></div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>
             <!-- /.mo1dal -->

<?php
require 'partials/body-result.php';
?>