<?php
if (isset($_GET['search'])) {
	if (!empty($_GET['search'])) {
		$query_list = "SELECT * FROM app WHERE name LIKE '%".protect_input($_GET['search'])."%' ORDER BY id DESC";
	} else {
		$query_list = "SELECT * FROM app ORDER BY id DESC";
	}
} else {
	$query_list = "SELECT * FROM app ORDER BY id DESC";
}

$records_per_page = 30;
$starting_position = 0;
if(isset($_GET["page"])) {
	$starting_position = ($_GET["page"]-1) * $records_per_page;
}
$new_query = $query_list." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query); 
if (isset($_POST['edit'])) {
	$input_name = array('name','vip','free');
	if (check_input($_POST, $input_name) == false) {
		$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak sesuai.');
	} else {
		$input_post = array(
		    'name' => $_POST['name'],
			'url' => $_POST['vip'],
			'purl' => $_POST['free'],
		);
		if (check_empty($input_post) == true) {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak boleh kosong.');
		} else {
			if ($model->db_update($db, "app", $input_post, "id = '".$_POST['id']."'") == true) {
				$_SESSION['result'] = array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Ubah data berhasil.');
			} else {
				$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Ubah data gagal.');
			}
		}
	}
} else if (isset($_POST['delete'])) {
	$check_data = $model->db_query($db, "*", "app", "id = '".$_POST['id']."'");
	if ($check_data['count'] == 0) {
		$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.');
	} else {
		if ($model->db_delete($db, "app", "id = '".$_POST['id']."'") == true) {
			$_SESSION['result'] = array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Hapus data berhasil.');
		} else {
			$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Hapus data gagal.');
		}
	}
}