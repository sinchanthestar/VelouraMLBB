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
    
    <body class="loading" data-layout-mode="horizontal" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fluid", "sidebar": { "color": "light", "size": "default", "showuser": true}, "topbar": {"color": "light"}, "showRightSidebarOnPageLoad": false}'>


<!-- Begin page -->
<div id="wrapper">
    
<?php
require 'partials/topbar.php';
?>

    <div class="topnav shadow-lg">
        <div class="container-fluid">
            <nav class="navbar navbar-dark navbar-expand-lg topnav-menu">
                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">
                        <?php
                        if (isset($_SESSION['login']))
                        {
                        ?>
                        <?php
                        if ($login['level'] == 'Admin') {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $config['web']['base_url'] ?>admin"> <i data-feather="airplay" class="icons-xs icon-dual-primary mr-1"></i> Owner </a>
                        </li>
                        <?php
                        }
                        ?>
                        <?php
                        if ($login['level'] == 'Member') {
                        ?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="user" class="icons-xs icon-dual-primary mr-1"></i> Admin
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                <a href="<?php echo $config['web']['base_url'] ?>order/reseller.php" class="dropdown-item">Invite Reseller </a>
                                <a href="<?php echo $config['web']['base_url'] ?>order/voucher/" class="dropdown-item">Voucher Saldo </a>
                                <a href="<?php echo $config['web']['base_url'] ?>user/list/" class="dropdown-item">List Reseller </a>
                            </div>
                        </li>
                        <?php
                        }
                        ?>
                        <li class="nav-item">
    <a class="nav-link" href="<?php echo $config['web']['base_url'] ?>">
        <i data-feather="airplay" class="icons-xs icon-dual-primary mr-1"></i> Dashboard
    </a>
</li>

                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $config['web']['base_url'] ?>page/hof.php"> <i data-feather="grid" class="icons-xs icon-dual-primary mr-1"></i> Top Pengguna </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="shopping-cart" class="icons-xs icon-dual-primary mr-1"></i> Pesanan
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                <a href="<?php echo $config['web']['base_url'] ?>order/new.php" class="dropdown-item">Pesanan Baru </a>
                                <a href="<?php echo $config['web']['base_url'] ?>order/history.php" class="dropdown-item">Riwayat Pesanan </a>
                                <a href="<?php echo $config['web']['base_url'] ?>order/graph.php" class="dropdown-item">Laporan Pesanan </a>
                                <a href="<?php echo $config['web']['base_url'] ?>page/services.php" class="dropdown-item">Daftar Layanan </a>
                                <a href="<?php echo $config['web']['base_url'] ?>api/documentation.php" class="dropdown-item">Dokumentasi API </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="credit-card" class="icons-xs icon-dual-primary mr-1"></i> Deposit
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                <a href="<?php echo $config['web']['base_url'] ?>deposit/new.php" class="dropdown-item">Deposit/Isi Saldo </a>
                                <a href="<?php echo $config['web']['base_url'] ?>deposit/history.php" class="dropdown-item">Riwayat Deposit </a>
                                <a href="<?php echo $config['web']['base_url'] ?>deposit/voucher.php" class="dropdown-item">Tukar Voucher</a> 
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="message-square" class="icons-xs icon-dual-primary mr-1"></i> Tiket
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">                                
                                <a href="<?php echo $config['web']['base_url'] ?>ticket/submit.php" class="dropdown-item">Buat tiket </a>
                                <a href="<?php echo $config['web']['base_url'] ?>ticket" class="dropdown-item">Data Tiket </a>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="more-horizontal" class="icons-xs icon-dual-primary mr-1"></i> Halaman
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                <a href="<?php echo $config['web']['base_url'] ?>page/contact.php" class="dropdown-item">Kontak </a>
                                <a href="<?php echo $config['web']['base_url'] ?>page/faq.php" class="dropdown-item">Pertanyaan Umum </a>
                                <a href="<?php echo $config['web']['base_url'] ?>page/tos.php" class="dropdown-item">Ketentuan Layanan</a> 
                            </div>
                        </li>
                        <?php
                        }
                        else
                        {
                        ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $config['web']['base_url'] ?>"> <i data-feather="home" class="icons-xs icon-dual-primary mr-1"></i> Dashboard </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $config['web']['base_url'] ?>auth/login.php"> <i data-feather="log-in" class="icons-xs icon-dual-primary mr-1"></i> Login </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $config['web']['base_url'] ?>auth/register.php"> <i data-feather="user-plus" class="icons-xs icon-dual-primary mr-1"></i> Register </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="<?php echo $config['web']['base_url'] ?>page/services.php"> <i data-feather="list" class="icons-xs icon-dual-primary mr-1"></i> Daftar Layanan </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="javascript:void(0);" id="topnav-dashboard" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i data-feather="more-horizontal" class="icons-xs icon-dual-primary mr-1"></i> Halaman
                                <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-dashboard">
                                <a href="<?php echo $config['web']['base_url'] ?>page/contact.php" class="dropdown-item">Kontak </a>
                                <a href="<?php echo $config['web']['base_url'] ?>page/faq.php" class="dropdown-item">Pertanyaan Umum </a>
                                <a href="<?php echo $config['web']['base_url'] ?>page/tos.php" class="dropdown-item">Ketentuan Layanan</a> 
                            </div>
                        </li>
                        <?php
                        }
                        ?>
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
         <div class="container-boxed">

             <!-- start page title -->
             <div class="row">
                 <div class="col-12">
                     <div class="page-title-box">
                         <div class="page-title-right">
                             <ol class="breadcrumb m-0">
                                 <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
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
                 <div class="container-boxed">
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
            