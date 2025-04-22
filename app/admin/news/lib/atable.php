<?php

if (isset($_GET['search'])) {
	if (!empty($_GET['search'])) {
		$query_list = "SELECT * FROM invite WHERE code LIKE '%".$_GET['search']."%' ORDER BY id DESC";
	} else {
		$query_list = "SELECT * FROM invite ORDER BY id DESC";
	}
} else {
	$query_list = "SELECT * FROM invite ORDER BY id DESC";
}

$records_per_page = 30;
$starting_position = 0;
if(isset($_GET["page"])) {
	$starting_position = ($_GET["page"]-1) * $records_per_page;
}
$new_query = $query_list." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query);
if (isset($_POST['add'])) {
	$input_name = array('saldo','uid','sisa');
	function randomPassword() {
	    $alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789";
	    $paw = "VN";
	    $pass = array();
	    $alphaLength = strlen($alphabet) - 1;
	    for ($i = 0; $i < 8; $i++) {
	        $n = rand(0, $alphaLength);
	        $pass[] = $alphabet[$n];
	        
	    }
	    return implode($pass);
	}
	$str2 = randomPassword();
	$str1 = "D5";
	if (check_input($_POST, $input_name) == false) {
		$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak sesuai.');
	} else {
		$validation = array(
			'code' => 'D5-INVITE-CHEAT',
			'saldo' => $_POST['saldo']
		);
		if (check_empty($validation) == true) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak boleh kosong.');
		} else {
			$input_post = array(
				'code' => $str1.'-INVITE-'.strtoupper($str2),
				'saldo' => $_POST['saldo']
			);
			if ($model->db_insert($db, "invite", $input_post) == true) {
			    $model->db_update($db, "users", array('balance' => $_POST['sisa'] - ($_POST['saldo']+10000)), "id = '".$_POST['uid']."'");
				$_SESSION['result'] = array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Berhasil membuat invite code </br>'.'Harga :'.$_POST['saldo']+10000);
			} else {
				$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Tambah data gagal.');
			}
		}
	}
} else if (isset($_POST['edit'])) {
	$input_name = array('saldo');
	if (check_input($_POST, $input_name) == false) {
		$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak sesuai.');
	} else {
		$input_post = array(
			'saldo' => $_POST['saldo']
		);
		if (check_empty($input_post) == true) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak boleh kosong.');
		} else {
			if ($model->db_update($db, "mod_data", $input_post, "id = '".$_POST['id']."'") == true) {
				$_SESSION['result'] = array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Ubah data berhasil.');
			} else {
				$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Ubah data gagal.');
			}
		}
	}
} else if (isset($_POST['delete'])) {
	$check_data = $model->db_query($db, "*", "invite", "id = '".$_POST['id']."'");
	if ($check_data['count'] == 0) {
		$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.');
	} else {
		if ($model->db_delete($db, "invite", "id = '".$_POST['id']."'") == true) {
			$_SESSION['result'] = array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Hapus data berhasil.');
		} else {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Hapus data gagal.');
		}
	}
}