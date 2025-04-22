<?php
if (isset($_POST['edit'])) {
	$check_data = $model->db_query($db, "*", "token", "id = '".$_POST['id']."'");
	if ($check_data['count'] == 0) {
		$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.');
	} else {
		if($model->db_update($db, "token", array('device' => 0, 'serial' => 0), $where) == true){
		    $_SESSION['result'] = array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'reset data berhasil.');
		}else{
		    $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'reset data gagal [500].');
		}
	}
}

if (isset($_POST['delete'])) {
	$check_data = $model->db_query($db, "*", "token", "id = '".$_POST['id']."'");
	if ($check_data['count'] == 0) {
		$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.');
	} else {
		if ($model->db_delete($db, "token", "access_key ='".$cek_data['rows']['access_key']."'") == true) {
		    $_SESSION['result'] = array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'hapus data berhasil.');
		}else{
		    $_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'hspus data gagal [500].');
		}
	} 
}