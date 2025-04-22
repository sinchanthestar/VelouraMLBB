<?php
$page_type = "Register";
require '../mainconfig.php';
if (isset($_SESSION['login'])) {
	exit(header("Location: ".$config['web']['base_url']));
}
if ($_POST) {
	$data = array('full_name', 'username', 'password', 'code', 'accept_terms');
	if (check_input($_POST, $data) == false) {
		$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak sesuai.');
	} else {
		$validation = array(
			'full_name' => save_input($_POST['full_name']),
			'username' => save_input($_POST['username']),
			'password' => protect_input($_POST['password']),
			'code' => $_POST['code'],
			'accept_terms' => $_POST['accept_terms']
		);
		if (check_empty($validation) == true) {
			$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak boleh kosong.');
		} else {
			$check_ip = $model->db_query($db, "ip_address", "register_logs", "ip_address = '".get_client_ip()."'");
			$check_inv = $model->db_query($db, "*", "invite", "code = '".$_POST['code']."' AND isUse ='0'");
			if ($check_ip['count'] > 0) {
				$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Anda sudah mendaftarkan akun sebelumnya.');
			} else if (strlen($validation['username']) < 5 OR strlen($validation['password']) < 5) {
				$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username/Password minimal 5 karakter.');
			} else if (strlen($validation['username']) > 12 OR strlen($validation['password']) > 12) {
				$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username/Password maksimal 12 karakter.');
			} else if ($validation['accept_terms'] !== "1") {
				$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Silahkan setujui syarat dan ketentuan kami sebelum mendaftar.');
			} else if ($check_inv['count'] < 1){
			    	$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'INVITE CODE INVALID ATAU CODE TELAH DIGUNAKAN ');
			}else{
			    $saldo = $check_inv['rows']['saldo'];
				$input_post = array(
					'level' => 'Member',
					'username' => strtolower(save_input($_POST['username'])),
					'password' => password_hash($validation['password'], PASSWORD_DEFAULT),
					'full_name' => save_input($_POST['full_name']),					
					'balance' => $saldo,
					'api_key' => str_rand(30),
					'created_at' => date('Y-m-d H:i:s')
				);
				if ($model->db_query($db, "username", "users", "username = '".mysqli_real_escape_string($db, $input_post['username'])."'")['count'] > 0) {
					$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username sudah terdaftar.');
				} else if ($model->db_query($db, "full_name", "users", "full_name = '".mysqli_real_escape_string($db, $input_post['full_name'])."'")['count'] > 0) {
					$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Nama Sudah Terdaftar.');
				} else {
					$insert = $model->db_insert($db, "users", $input_post);
					if ($insert == true) {
						$model->db_insert($db, "register_logs", array('user_id' => $insert, 'ip_address' => get_client_ip(), 'user_agent' => $_SERVER['HTTP_USER_AGENT'], 'created_at' => date('Y-m-d H:i:s')));
						$model->db_update($db, "invite", array('isUse' => 1), "code = '".$_POST['code']."'");
						$result_msg = array('alert' => 'success', 'title' => 'Registrasi berhasil!', 'msg' => 'Login akun anda.');
					} else {
						$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Member gagal didaftarkan.');
					       
				        }
			        }
		        }  //
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
            <h4 class="header-title">Daftar</h4>
            <hr />
            <form method="POST">
               <input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>" />
               <div class="form-group">
                  <label>Nama Lengkap <font color="red">*</font></label>
                  <input type="text" class="form-control" name="full_name" placeholder="nama lengkap" autocomplete="off" required/>
               </div>
               <div class="form-group">
                  <label>Username <font color="red">*</font></label>
                  <input type="text" name="username" class="form-control" placeholder="username" autocomplete="off" required/>
               </div>
               <div class="form-group">
                  <label>Password <font color="red">*</font></label>
                  <div class="input-group input-group-merge">
                     <input type="password" name="password" id="password" class="form-control" placeholder="password" autocomplete="off" required/>
                     <div class="input-group-append" data-password="false">
                        <div class="input-group-text">
                           <span class="password-eye"> </span>
                        </div>
                     </div>
                  </div>
                  <br />
                  <div class="form-group">                     
                     <div class="input-group input-group-merge">
                        <input type="text" name="code" id="code" class="form-control" placeholder="Masukan invite code" autocomplete="off" required/>
                        <div class="input-group-append" data-password="false">
                           <div class="input-group-text">
                              <span class="password-eye"> </span>
                           </div>
                        </div>
                     </div>
                     <br />
                     <div class="form-group">
                        <div class="custom-control custom-checkbox checkbox-primary">
                           <input type="checkbox" class="custom-control-input" id="customCheck1" name="accept_terms" value="1" required />
                           <label class="custom-control-label" for="customCheck1">
                              I accept
                              <a href="javascript:void(0);"> Terms and Conditions </a>
                           </label>
                        </div>
                     </div>
                     <hr />
                     <div class="text-center">
                        <button type="submit" class="btn btn-block btn-primary">Register</button>
                     </div>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
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