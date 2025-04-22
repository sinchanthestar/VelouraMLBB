<?php

require 'app/mainconfig.php';
$result_msg = array('alert' => 'info', 'title' => 'Hallo', 'msg' => 'Welcome To Veloura MLBB' );

date_default_timezone_set('Asia/Jakarta');
$profile = $model->db_query($db,"*", "profile", "token_key='KGUi-ADMIN-KJZW3'");
if ($_POST) {
    if (check_input($_POST, array('user_key', 'serial', 'game')) == false) {
		$result = array('status' => false, 'data' => array('msg' => 'Inappropriate request'));
	} else {
    $cek1 = $model->db_query($db, "*", "categories", "name = '".$_POST['game']."'");
    if($cek1['count'] > 0){
      if($cek1['rows']['status'] != 1) {
        $result = array('status' => false, 'msg' => 'Service Under Maintenance');
      }else{
        $cek2 = $model->db_query($db, "*", "token", "access_key='".$_POST['user_key']."'");
        $slot = $cek2['rows']['cheat_slot'];
        $vip = false;
        if ($cek2['rows']['vip'] == 1) {
          $vip = true;
        }
        $enc = md5($_POST['game']."-".$_POST['user_key']."-".$_POST['serial']."-".$cek1['rows']['static']);
        $stime =  time();
        $serial = "";
        $time1 = new DateTime(date("Y-m-d H:i:s"));
        $time2 = new DateTime($cek2['rows']['cheat_exp']);
        $interval = $time1->diff($time2)->format("%r%a");
        $jam = $time1->diff($time2)->format("%r%h");
        $sisa = "$interval Hari $jam Jam";
        $min = intval($cek2['rows']['cheat_slot']) - 1;
        $besok = date('Y-m-d H:i:s', strtotime("+".$cek2['rows']['durasi']." day", strtotime(date("Y-m-d H:i:s"))));
        $myArray = array(
          'token'=> $enc,
          'MOD_NAME' => $cek1['rows']['brand'],
          'MOD_EXP' => $cek2['rows']['cheat_exp'],
          'MOD_SLOT' => $cek2['rows']['slot'],
          'MOD_STATUS' => 'safe',
          'isVip' => $vip,
          'DURASI'=> $sisa,
          'rng'=> $stime,
          'client'=> $cek2['rows']['data'],
          'serial' => $_POST['serial']
        );
        if ($cek2['count'] == 0) { //if key not found
          $result = array('status' => false, 'msg' => 'Key Invalid');
        } else {
          if ($cek2['rows']['active'] == 0) {
            if($model->db_update($db, "token", array('serial' => 1, 'active' => 1, 'slot' => ($cek2['rows']['slot'] - 1), 'cheat_exp' => date('Y-m-d H:i:s', strtotime("+".$cek2['rows']['durasi']." day", strtotime(date("Y-m-d H:i:s"))))), "access_key = '".$_POST['user_key']."'") == true){
                if($model->db_insert($db, "serial", array('device' => $_POST['serial'], 'user_key' => $_POST['user_key'])) == true){
                    $result = array('status' => true, 'data' => $myArray);
                }else{
                   $result = array('status' => false, 'msg' => 'Try Again (301)'); 
                }
            }else{
              $result = array('status' => false, 'msg' => 'Try Again');
            }
          } else {
              $cekserial = $model->db_query($db, "device", "serial", "device='".$_POST['serial']."'");
              if($cekserial['count'] != 0){// jika serial di temuan
                  if(date("Y-m-d H:i:s") < $cek2['rows']['cheat_exp']){
                      $result = array('status' => true, 'count' => $cekserial['count'], 'data' => $myArray);
                  }else{
                      if ($model->db_delete($db, "token", "access_key = '".$_POST['user_key']."'") == true) {
                          $model->db_delete($db, "serial", "user_key = '".$_POST['user_key']."'");
                          $result = array('status' => false, 'msg' => 'Expired Key');
                      }
                  }
              }else{
                  if($cek2['rows']['slot'] != 0){
                      if($model->db_insert($db, "serial", array('device' => $_POST['serial'], 'user_key' => $_POST['user_key'])) == true){
                          if(date("Y-m-d H:i:s") < $cek2['rows']['cheat_exp']){
                              $calc = $cek2['rows']['slot'] - 1;
                              if($model->db_update($db, "token", array('slot' => $calc), "access_key = '".$_POST['user_key']."'") == true){
                                  $result = array('status' => true, 'calc' => $calc, 'data' => $myArray);
                              }else{
                                  $result = array('status' => false, 'msg' => 'Error 500');
                              }
                          }else{
                              if ($model->db_delete($db, "token", "access_key = '".$_POST['user_key']."'") == true) {
                                  $model->db_delete($db, "serial", "user_key = '".$_POST['user_key']."'");
                                  $result = array('status' => false, 'msg' => 'Expired Key');
                              }
                          }
                      }
                  }else{
                      $result = array('status' => false, 'msg' => 'Maximum Device'); 
                  }
              }
          }
        }
      }
    } else {
      $result = array('status' => false, 'msg' => 'Service Invalid');
    }
  }
	print(json_encode($result, JSON_PRETTY_PRINT));
} else{
  require 'app/lib/partials/head-css.php';
  require 'app/lib/partials/title-meta.php';
?>
<body class="authentication-bg authentication-bg-pattern">
  <div class="account-pages mt-5 mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-4 col-xl-4 justify-content-center">
          <div class="card-box text-center bg-pattern">
            <img src="../../img/profile1.png" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
            <h4 class="mb-0"><strong>Veloura MLBB</strong></h4>
            <p class="text-muted">Premium</p>
            <button type="button" class="btn btn-success btn-xs waves-effect mb-2 waves-light" onClick="location.href='app/auth/'">MEMBER</button>
            <button type="button" class="btn btn-danger btn-xs waves-effect mb-2 waves-light" onClick="location.href='app/auth/login.php'">RESELLER</button>
            <div class="text-left mt-3">
              <h4 class="font-13 text-uppercase">About Me :</h4>
              <p class="text-muted font-13 mb-3">
                Hi,Welcome To Veloura MLBB, Veloura Mod Is a Cheat Mobile / Mod Provider with Strong Bypass And Totaly Safe from Temporary Ban or Permanent Ban .
                <br>
                we starting from IDR 10,000 / USD 1
              </p>
             </div>
          </div> <!-- end card-box -->
        </div> <!-- end col-->
        <div class="col-lg-12 col-xl-12">
            <div class="card-box text-center bg-pattern">
            <h4 class="mb-0"><strong>Veloura MLBB</strong></h4>
            <p class="text-muted"> Join Channel Telegram </p>
            
             <div class="form-group mb-0 text-center">
                 <button class="btn btn-primary btn-block" onclick="document.location.href='https://t.me/VelouraMLBB'"> Telegram </button>
             </div>
          </div> <!-- end card-box -->
        </div>
      </div>
    </div>
  </div>
  <div class="rightbar-overlay"></div>
  <!-- App js -->
  <script src="<?php echo $config['web']['base_url'] ?>assets/js/app.min.js"></script>
  <script src="<?php echo $config['web']['base_url'] ?>assets/js/clipboard.js"></script>
  <script src="<?php echo $config['web']['base_url'] ?>assets/libs/select2/js/select2.min.js"></script>
  
  <!-- Sweet Alerts js -->
  <script src="<?php echo $config['web']['base_url'] ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>
  
  <!-- Init js -->
  <script src="<?php echo $config['web']['base_url'] ?>assets/js/pages/form-advanced.init.js"></script>
  <script src="<?php echo $config['web']['base_url'] ?>assets/js/pages/sweet-alerts.init.js"></script>
<?php
  if (isset($result_msg)) {
    if ($result_msg['alert'] == "danger") {
?>
      <script>
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
      Toast.fire({
        type: 'error',
        title: '<?php echo $result_msg['msg'] ?>'
        })
        </script>
?>
<?php
      } else {
?>
      <script>
        const Toast = Swal.mixin({
          toast: true,
          position: 'top-end',
          showConfirmButton: false,
          timer: 3000,
          timerProgressBar: true,
          didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
              toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });
      Toast.fire({
        type: 'info',
        title: '<?php echo $result_msg['msg'] ?>'
      })
        </script>
<?php
      }
  }
?>
</body>
</html>

<?php
}
?>
