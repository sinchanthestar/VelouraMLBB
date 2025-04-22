<?php
$page_type = "Login";
require '../mainconfig.php';
if (isset($_SESSION['login'])) {
	exit(header("Location: ".$config['web']['base_url']));
}
if ($_POST) {
	$data = array('username', 'password');
	if (check_input($_POST, $data) == false) {
		$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak sesuai.');
	} else {
		$input_post = array(
			'username' => save_input($_POST['username']),
			'password' => protect_input($_POST['password'])
		);
		if (check_empty($input_post) == true) {
			$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak boleh kosong.');
		} else {
			$check_user = $model->db_query($db, "*", "users", "BINARY username = '".$input_post['username']."'");
			if ($check_user['count'] == 1) {
				if (password_verify($input_post['password'], $check_user['rows']['password']) == true) {
					$model->db_insert($db, "login_logs", array('user_id' => $check_user['rows']['id'], 'ip_address' => get_client_ip(), 'user_agent' => $_SERVER['HTTP_USER_AGENT'], 'created_at' => date('Y-m-d H:i:s')));
					$_SESSION['login'] = $check_user['rows']['id'];
					$result_msg = array('alert' => 'success', 'title' => 'Berhasil masuk!', 'msg' => 'Selamat datang '.$check_user['rows']['username'].'!');
					exit(header("Location: ".$config['web']['base_url']));
				} else {
					$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username atau password salah.');
				}
			} else {
				$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username atau password salah.');
			}
		}
	}
}
require '../lib/partials/head-css.php';
require '../lib/partials/title-meta.php';
require '../lib/is_login.php';
require '../lib/csrf_token.php';

?>
<body class="authentication-bg authentication-bg-pattern">
  <div class="account-pages mt-5 mb-5">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
          <div class="card bg-pattern">

            <div class="card-body">
              <h4 class="header-title">Login</h4>
              <hr />
              <form method="POST">
               <input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>" />               
               <div class="form-group">
                  <label>Username <font color="red">*</font></label>
                  <input type="text" class="form-control" name="username" placeholder="username" autocomplete="off" required>
               </div>
               <div class="form-group">
                  <label for="password">Password <font color="red">*</font></label>
                  <div class="input-group input-group-merge">
                     <input type="password" class="form-control" name="password" placeholder="password" autocomplete="off" required>
                     <div class="input-group-append" data-password="false">
                        <div class="input-group-text">
                           <span class="password-eye"> </span>
                        </div>
                     </div>
                  </div>
               </div>
               <hr />
               <div class="form-group">
                  <button type="submit" class="btn btn-block btn-primary">Login</button>
               </div>
            </form>
         </div>
                        </div>
                        <!-- end card -->
                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->
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
<?php
//require '../lib/footer.php';
?>
