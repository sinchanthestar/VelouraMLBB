<?php

require '../mainconfig.php';
date_default_timezone_set('Asia/Jakarta');
session_start();
function getkey() {
    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
    $pass = array();
    $alphaLength = strlen($alphabet) - 1;
    for ($i = 0; $i < 8; $i++) {
        $n = rand(0, $alphaLength);
        $pass[] = $alphabet[$n];
    }
    return implode($pass);
}

function getIP(){
    if(!empty($_SERVER['HTTP_CLIENT_IP'])) {
        return $_SERVER['HTTP_CLIENT_IP'];
    }else{
        if(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        }else{
            return $_SERVER['REMOTE_ADDR'];
        }
    }
}

if ($config['web']['maintenance'] == 1) {
	$result = array('status' => false, 'data' => array('msg' => 'Maintenance'));
	exit(json_encode($result, JSON_PRETTY_PRINT));
}

if ($_POST['server'] == 1) {
    if($_POST['game'] == 0) {
        $_SESSION['result_msg'] = array('alert' => 'danger', 'title' => 'GAGAL!', 'msg' => "Silahkan Pilih Game", 'show' => true);
    }else{
        $s_key = strtoupper(getkey());
        $pgen = $model->db_query($db, "*", "categories", "name = '".$_POST['game']."'");
        $lock = base64_encode(getIP()."::".$s_key);
        $_SESSION['generate'] = array('data' => getIP(), 'key' => $s_key, 'game' => $_POST['game'], 'lock' => $lock, 'time' => $pgen['rows']['time']);
        die(header("Location: https://semawur.com/st/?api=a797dae9d63400494ac9aec5bf0fc9d7055ef0f2&url=https://d5studio.my.id/gen-key/free/"."?lock=".$lock));
    }
} else {

?>
<?php
require '../lib/partials/head-css.php';
require '../lib/partials/title-meta.php';
$data = $model->db_query($db, "*", "pgen", "id = '1'");
$query_list = "SELECT * FROM categories WHERE status = '1' ORDER BY id DESC";
$records_per_page = 40;
$starting_position = 0;
$new_query = $query_list." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query);
?>
<?php $profile = $model->db_query($db, "*", "profile" ,"token_key='D5-ADMIN-KJZW3'"); ?>
<div class="account-page">
    <div class="content">
        <!-- Start Content-->
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">D5studio</a></li>
                                <li class="breadcrumb-item"><a href="javascript: void(0);">Extras</a></li>
                                <li class="breadcrumb-item active">Gallery</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div><!-- end page title --> 
            <!-- Filter -->
            <div class="row">
                <div class="col-12">
                    <div class="text-center filter-menu">
                        <a href="javascript: void(0);" class="filter-menu-item active" data-rel="all">All</a>
                        <a href="javascript: void(0);" class="filter-menu-item" data-rel="PointBlank">Point Blank</a>
                        <a href="javascript: void(0);" class="filter-menu-item" data-rel="MobileLegends">Mobile Legends</a>
                    </div>
                </div>
            </div><!-- end row-->
            <div class="row filterable-content">
                <div class="col-sm-3 col-xl-6 filter-item all MobileLegends PointBlank">
                    <div class="gal-box">
                        <a href="<?php echo $config['web']['base_url'] ?>assets/images/small/img-1.jpg" class="image-popup" title="Screenshot-1">
                            <img src="<?php echo $config['web']['base_url'] ?>assets/images/small/img-1.jpg" class="img-fluid" alt="work-thumbnail">
                        </a>
                        <div class="gall-info">
                            <h4 class="font-16 mt-0">Man wearing black jacket</h4>
                            <a href="javascript: void(0);">
                                <img src="<?php echo $config['web']['base_url'] ?>assets/images/users/user-3.jpg" alt="user-img" class="rounded-circle" height="24" />
                                <span class="text-muted ml-1">Justin Coke</span>
                            </a>
                            <a href="javascript: void(0);" class="gal-like-btn"><i class="mdi mdi-heart-outline text-danger"></i></a>
                        </div> <!-- gallery info -->
                    </div> <!-- end gal-box -->
                </div> <!-- end col -->
            </div><!-- end row -->
        </div> <!-- container -->
    </div> <!-- content -->
<?php
require '../lib/footer.php';
}
?>