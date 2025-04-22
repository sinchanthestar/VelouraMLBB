<?php

require '../mainconfig.php';
session_start();
if (isset($_SESSION['key'])) {
    exit(header("Location: ".$config['web']['base_url']."client/"));
    
}
$mod = $model->db_query($db, "*", "mod_data", "id = '1' AND status = '1'");
date_default_timezone_set('Asia/Jakarta');
if ($_POST['key']){
    $cek = $model->db_query($db, "*", "token", "access_key = '" .$_POST['key']."'");
    if ($cek['count'] == 0){
        $msg = 'Key not found!!';
        $result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => $msg);
    } else {
        if ($cek['rows']['active'] != 0){
            if (date('Y-m-d H:i:s') > $cek['rows']['cheat_exp']){
                $msg = 'Key Anda Sudah Kadaluarsa, Silahkan Perbarui Key';
                $result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => $msg);
            } else {
                $_SESSION['key'] = $cek['rows']['id'];
                header("Location: ".$config['web']['base_url']."client/");
            }
        }else{
            $_SESSION['key'] = $cek['rows']['id'];
            header("Location: ".$config['web']['base_url']."client/");
        }
    }
}

require '../lib/partials/head-css.php';
require '../lib/partials/title-meta.php';
?>
<body class="authentication-bg authentication-bg-pattern">
  <div class="account-pages mt-5 mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-pattern">

            <div class="card-body p-4">
              <div class="text-center w-75 m-auto">
                <img src="../../img/profile1.png" height="88" alt="user-image" class="rounded-circle shadow">
                <h4 class="text-dark-50 text-center mt-3">Welcome To User Area </h4>
                <p class="text-muted mb-4">Enter your key to access the User Area.</p>
              </div>


              <form method="POST">
                <div class="form-group mb-3">
                  <label for="password">Key</label>
                  <input class="form-control" type="text" required="" name="key" id="key" placeholder="Enter your Key">
                </div>
                <div class="form-group mb-0 text-center">
                  <button class="btn btn-primary btn-block" type="submit"> Log In </button>
                </div>
              </form>
            </div> <!-- end card-body -->
          </div><!-- end card -->

          <div class="row mt-3">
            <div class="col-12 text-center">
            </div> <!-- end col -->
          </div><!-- end row -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
       <div class="rightbar-overlay"></div>
<!-- App js -->
<script src="<?php echo $config['web']['base_url'] ?>assets/js/app.min.js"></script>

<script src="<?php echo $config['web']['base_url'] ?>assets/js/clipboard.js"></script>

<script src="<?php echo $config['web']['base_url'] ?>assets/libs/select2/js/select2.min.js"></script>

<!-- Init js -->
<script src="<?php echo $config['web']['base_url'] ?>assets/js/pages/form-advanced.init.js"></script>
<!-- Sweet Alerts js -->
<script src="<?php echo $config['web']['base_url'] ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
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
      type: 'success',
      title: '<?php echo $result_msg['msg'] ?>'
    })
  </script>
  <?php
    }
  }
  ?>
    </body>
</html>