<?php
require '../mainconfig.php';
require '../lib/check_session_member.php';
date_default_timezone_set('Asia/Jakarta');
if ($_POST) {
    require '../lib/is_login.php';
    $role;
    if($_POST['category'] == 1){
        $role = "Client";
    }
	$input_name = array('category', 'username', 'pass', 'saldo');
	if (check_input($_POST, $input_name) == false) {
		$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak sesuai.');
	} else {
		$validation = array(
			'level' => $_POST['category'],
			'username' => trim($_POST['username']),
			'password' => trim($_POST['pass']),
			'full_name' => $_POST['username'],
		);
		if (check_empty($validation) == true) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak boleh kosong.');
		} elseif (strlen($validation['username']) < 5) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username minimal 5 karakter.');
		} elseif (strlen($validation['password']) < 5) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Password minimal 5 karakter.');
		} elseif (in_array($validation['level'], array('Member','Client','Admin')) == false) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Hak akses tidak sesuai.');
		} else {
			$input_post = array(
				'level' => $_POST['category'],
				'username' => strtolower(trim($_POST['username'])),
				'password' => password_hash(trim($_POST['pass']), PASSWORD_DEFAULT),
				'full_name' => $_POST['username'],
				'balance' => $_POST['saldo'],
				'api_key' => str_rand(30),
				'created_at' => date('Y-m-d H:i:s')
			);
			if ($model->db_query($db, "username", "users", "username = '".$input_post['username']."'")['count'] > 0) {
				$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Username sudah terdaftar.');
			} else {
				if($model->db_query($db, "*", "users", "id = '".$_SESSION['login']."'")['rows']['balance'] > $_POST['saldo'] + 10000){
				    if ($model->db_insert($db, "users", $input_post) == true) {
				        if($model->db_update($db, "users", array('balance' => $model->db_query($db, "*", "users", "id = '".$_SESSION['login']."'")['rows']['balance'] - ($_POST['saldo'] + 10000)), "id = '".$_SESSION['login']."'")){
				            $_SESSION['result'] = array('alert' => 'success', 'title' => 'Pesanan berhasil dibuat.', 'msg' => '<br />Username: '.$_POST['username'].'<br />Password: '.$_POST['pass'].'<br />saldo: Rp.'.$_POST['saldo'].'<br />');
				        }else{
				            $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'error saat input data.');
				        }
				    }else{
				        die(mysqli_error($db));
				        $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Gagal Mendaftarkan.');
				    }
				} else {
					$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Saldo anda kurang.');
				}
			}
		}
	}
}
require '../lib/header.php';
?>
<div class="row">
    <div class="col-lg-8">
        <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title"><i class="fa fa-shopping-cart"></i> Pesan Baru</h4>
            <form class="form-horizontal" method="post" id="ajax-result">
                <input type="hidden" name="csrf_token" value="<?php echo $config['csrf_token'] ?>">
                <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control" name="category" id="category">
                        <option value="0">Pilih...</option>
                        <option value="Client">Reseller</option>
                    </select>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>Username</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" name="username" placeholder="User" id="username"></input>
                        </div>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="pass">Password <font color="red">*</font></label>
                        <div class="input-group input-group-merge">
                            <input type="password" class="form-control" name="pass" placeholder="pass" autocomplete="off" required>
                            <div class="input-group-append" data-password="false">
                                <div class="input-group-text">
                                    <span class="password-eye"> </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Saldo</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">Rp</span>
                        </div>
                        <input type="number" class="form-control" name="saldo" placeholder="1000" id="saldo"></input>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-danger" type="reset"><i class="fa fa-undo"></i> Reset</button>
                    <button class="btn btn-success" type="submit"><i class="fa fa-check"></i> Submit</button>
                </div>
            </form>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title"><i class="fa fa-info-circle fa-fw"></i> Informasi</h4>
            <p>
                <div class="card-body">
                    <b>Menambahkan Resseller baru:</b>
                    <ul>
                        <li>Menambahkan Reseller Dikinakan biaya Rp.10.000</li>
                        <li>Kalkulasi Tagihan Saldo + biaya = total tagihan</li>
                        <li>bila terjadi error atau bug silahkan hubungi admin.</li>
                        <li>pastikan memasukan data dengan benar.</li>
                        <li>pastikan jaringan internet anda stabil.</li>
                    </ul>
                </div>			
			</p>
		</div>
	</div>
</div>
<?php
require '../lib/footer.php';
?>