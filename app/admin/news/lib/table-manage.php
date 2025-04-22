<?php
if (isset($_GET['search'])) {
	if (!empty($_GET['search'])) {
		$query_list = "SELECT * FROM pgen WHERE name LIKE '%".protect_input($_GET['search'])."%' ORDER BY id DESC";
	} else {
		$query_list = "SELECT * FROM pgen ORDER BY id DESC";
	}
} else {
	$query_list = "SELECT * FROM pgen ORDER BY id DESC";
}

$records_per_page = 30;
$starting_position = 0;
if(isset($_GET["page"])) {
	$starting_position = ($_GET["page"]-1) * $records_per_page;
}
$new_query = $query_list." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query); 
if (isset($_POST['edit'])) {
	$input_name = array('server','keygen');
	if (check_input($_POST, $input_name) == false) {
		$_SESSION['result_msg'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak sesuai.');
	} else {
		$input_post = array(
			'maintenance' => $_POST['server'],
			'keygen' => $_POST['keygen'],
		);
		if (check_empty($input_post) == true) {
			$_SESSION['result_msg'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Input tidak boleh kosong.');
		} else {
			if ($model->db_update($db, "pgen", $input_post, "id = '".$_POST['id']."'") == true) {
				$_SESSION['result_msg'] = array('alert' => 'success', 'title' => 'Berhasil!', 'msg' => 'Ubah data berhasil.');
			} else {
				$_SESSION['result_msg'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Ubah data gagal.');
			}
		}
	}
}