<?php
require '../mainconfig.php';

if($_POST['dataserial']){
    if($_POST['dataserial'] != "Not Login Yet"){
        if($model->db_update($db, "token", array('serial' => 0), "id = '".$_SESSION['key']."'") == true){
            $_SESSION['result_msg'] = array('alert' => 'info', 'title' => 'Success!', 'msg' => "Serial Successful Reset", 'show' => true);
        }else{
            $_SESSION['result_msg'] = array('alert' => 'danger', 'title' => 'Error!', 'msg' => "Please Try Again!", 'show' => true);
        }
    }else{
        $_SESSION['result_msg'] = array('alert' => 'danger', 'title' => 'Failed!', 'msg' => "Please login first!!!", 'show' => true);
    }
}

if (!isset($_SESSION['key'])) {
    exit(header("Location: ".$config['web']['base_url']."auth/"));
    
} else {
    $cek = $model->db_query($db, "*", "token", "id = '" .$_SESSION['key']."'");
    $dw = $model->db_query($db, "*", "app");
    $d_sell = $model->db_query($db, "*", "users", "id = '" .$cek['rows']['uid']."'");
    $penjual = $d_sell['rows']['username'];
    $time1 = new DateTime(date("Y-m-d H:i:s"));
    $time2 = new DateTime($cek['rows']['cheat_exp']);
    $interval = $time1->diff($time2)->format("%r%a");
    $jam = $time1->diff($time2)->format("%r%h");
    $sisa = "$interval Days $jam Hour";
    $isVip = '';
    $durasi = '';
    $serial = '';
    if ($cek['rows']['vip'] == 1){
        $isVip = 'VIP Client';
        $downloads = $dw['rows']['url'];
    } else {
        $isVip = 'FREE Client';
        $downloads = $dw['rows']['purl'];
    }
    if($cek['rows']['active'] == 0){
        $serial = 'Not Login Yet';
    }else{
        $serial = $cek['rows']['serial'];
    }
    if($cek['rows']['active'] == 0){
        $durasi = 'Not Login Yet';
    }else{
        $durasi = $sisa;
    }
    require '../lib/partials/head-css.php';
    require '../lib/partials/title-meta.php';
?>

<div class="account-pages mt-5 mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-xl-4 justify-content-center">
          <div class="card-box text-center bg-pattern" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            <img src="../../img/profile1.png" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
            <h4 class="mb-0"><strong>Veloura MLBB</strong></h4>
            <p class="text-muted">Provider Cheat</p>
            <div class="text-left mt-3">
              <h4 class="font-13 text-uppercase">Price List :</h4>
              <p class="text-muted font-13 mb-3">
                💰1 Days  : Rp.10.000 / $1</br>
                💰3 Days  : Rp.20.000 / $2</br>
                💰7 Days  : Rp.35.000 / $3.5</br>
                💰30 Days : Rp.50.000 / $5</br>
                💰60 Days : Rp.90.000 / $9</br>
                💰90 Days : Rp.120.000 / $12</br>
                💰120 Days : Rp.160.000 / $16</br>
              </p>
             </div>
             <button class="btn btn-primary btn-block" onclick="document.location.href='https://t.me/VelouraMLBB'"> Renew Token </button>
          </div> <!-- end card-box -->
        </div> <!-- end col-->
        
        <div class="col-lg-8 col-xl-8">
            <div class="card-box bg-pattern" style="height:430px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered table-hover" id="datatable">
                            <tbody>
                                <tr>
                                    <td>Member Name</td>
                                    <td><?php echo $cek['rows']['data'] ?></td>
                                </tr>
                                <tr>
                                    <td>Seller Name</td>
                                    <td><?php echo $model->db_query($db,"username", "users", "id ='".$cek['rows']['uid']."'")['rows']['username'] ?></td>
                                </tr>
                                <tr>
                                    <td>Remaining Time</td>
                                    <td><?php echo $durasi ?></td>
                                </tr>
                            </tbody>	
                        </table>
                        <div class="card-box text-center bg-pattern" style="margin:10px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <h4 class="mb-0"><strong>Reset Your Serial</strong></h4>
                            <p class="text-muted"></p>
                            <form method="POST">
                                <div class="form-group mb-3">
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                        </div>
                                        <input type="text" class="form-control" name="dataserial" value="<?php echo $serial ?>" readonly </input>
                                    </div>
                                </div>
                                <div class="form-group mb-0 text-center">
                                    <button class="btn btn-primary btn-block" type="submit"> Reset </button>
                                </div>
                            </form>
                        </div> <!-- end card-box -->
                    </div>
                </div>
            </div>
        </div> <!-- end col-box-->
        <div class="col-lg-12 col-xl-12">
            <div class="card-box text-center" style="box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                <div class="row">
                    <div class="col-lg-4 col-xl-4">
                        <div class="card-box text-center bg-pattern" style="height:150px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <img src="../../img/profile1.png" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
                            <p class="text-muted">Provider Cheat</p>
                        </div> <!-- end card-box -->
                    </div> <!-- end col-->
                    <div class="col-lg-8">
                        <div class="card-box bg-pattern" style="height:150px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                            <button class="btn btn-primary btn-block" onclick="document.location.href='../../file/jotunheim.apk'" style="margin:10px;"> Internal </button>
                            <button class="btn btn-primary btn-block" onclick="document.location.href='../../file/alfheim.apk'" style="margin:10px;"> External </button>
                        </div>
                    <div>
                </div>
            </div>
        </div>
      </div>
    </div>
  </div>
<?php
require '../lib/footer.php';
}
?>