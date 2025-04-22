<?php

if (isset($_GET['search'])) {
	if (!empty($_GET['search'])) {
		$query_list = "SELECT * FROM profile WHERE name LIKE '%".protect_input($_GET['search'])."%' ORDER BY id DESC";
	} else {
		$query_list = "SELECT * FROM profile ORDER BY id DESC";
	}
} else {
	$query_list = "SELECT * FROM profile ORDER BY id DESC";
}

$records_per_page = 30;
$starting_position = 0;
if(isset($_GET["page"])) {
	$starting_position = ($_GET["page"]-1) * $records_per_page;
}
$new_query = $query_list." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query);
if (isset($_POST['edit'])) {
	$input_name = array('nama', 'yt', 'tele', 'ig', 'game1', 'game2', 'game3');
	if (check_input($_POST, $input_name) == false) {
		$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak sesuai.');
	} else {
		$input_post = array(
		    'name' => $_POST['nama'],
			'url_yt' => $_POST['yt'],
			'url_tele' => $_POST['tele'],
			'url_ig' => $_POST['ig'],
			'dana' => $_POST['dana'],
			'gopay' => $_POST['gopay'],
			'ovo' => $_POST['ovo'],
			'game1' => $_POST['game1'],
			'game2' => $_POST['game2'],
			'game3' => $_POST['game3']
		);
		if (check_empty($input_post) == true) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak boleh kosong.');
		} else {
			if ($model->db_update($db, "profile", $input_post, "id = '".$_POST['id']."'") == true) {
				$_SESSION['result'] = array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Ubah data berhasil.');
			} else {
				$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Ubah data gagal.');
			}
		}
	}
} else if (isset($_POST['delete'])) {
	$check_data = $model->db_query($db, "*", "profile", "id = '".$_POST['id']."'");
	if ($check_data['count'] == 0) {
		$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.');
	} else {
		if ($model->db_delete($db, "news", "id = '".$_POST['id']."'") == true) {
			$_SESSION['result'] = array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Hapus data berhasil.');
		} else {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Hapus data gagal.');
		}
	}
}