<?php
if (isset($_SESSION['login']) and $config['web']['maintenance'] == 1)
{
    exit("<center>
            <h3><i><b><u>WEB MAINTENANCE</u></b></i></h3>
            Halaman sedang tidak dapat diakses, harap coba lagi nanti!
        </center>");
}
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
                                <a href="<?php echo $config['web']['base_url'] ?>member/user" class="dropdown-item">Kelola Pengguna </a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $config['web']['base_url'] ?>member/ticket">
                                <i data-feather="message-square" class="icons-xs icon-dual-primary mr-1"></i> Tickets
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="credit-card" class="icons-xs icon-dual-primary mr-1"></i> Deposit
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                <a href="<?php echo $config['web']['base_url'] ?>member/deposit_method" class="dropdown-item">Metode deposit</a>
                                <a href="<?php echo $config['web']['base_url'] ?>member/voucher" class="dropdown-item">Voucher </a> 
                                <a href="<?php echo $config['web']['base_url'] ?>member/deposit" class="dropdown-item">Deposit </a>
                                <a href="<?php echo $config['web']['base_url'] ?>member/deposit/report.php" class="dropdown-item">Laporan </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="shopping-cart" class="icons-xs icon-dual-primary mr-1"></i> Pesanan
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                <a href="<?php echo $config['web']['base_url'] ?>member/order" class="dropdown-item">Pesanan </a>
                                <a href="<?php echo $config['web']['base_url'] ?>member/order/report.php" class="dropdown-item">Laporan </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="server" class="icons-xs icon-dual-primary mr-1"></i> Layanan
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                <a href="<?php echo $config['web']['base_url'] ?>member/provider" class="dropdown-item">Provider </a>
                                <a href="<?php echo $config['web']['base_url'] ?>member/category" class="dropdown-item">Kategori </a>
                                <a href="<?php echo $config['web']['base_url'] ?>member/service" class="dropdown-item">Layanan </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="settings" class="icons-xs icon-dual-primary mr-1"></i> Lainnya
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">                                
                                <a href="<?php echo $config['web']['base_url'] ?>member/news" class="dropdown-item">Informasi </a>
                                <a href="<?php echo $config['web']['base_url'] ?>member/news/restAPI.php" class="dropdown-item">API Setting </a>
                                <a href="<?php echo $config['web']['base_url'] ?>member/news/downloads.php" class="dropdown-item">Downloads </a>
                                <a href="<?php echo $config['web']['base_url'] ?>member/news/p_card.php" class="dropdown-item">Profile page </a>
                                <a href="<?php echo $config['web']['base_url'] ?>member/page" class="dropdown-item">Halaman </a>
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
             <!-- /.modal -->

<?php
require 'partials/body-result.php';
?>