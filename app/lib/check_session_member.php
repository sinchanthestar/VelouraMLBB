<?php

if (!isset($_SESSION['login'])) {
	$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Otentikasi dibutuhkan!', 'msg' => 'Silahkan masuk terlebih dahulu.');
	exit(header("Location: ".$config['web']['base_url']."logout.php"));
}
if ($model->db_query($db, "*", "users", "id = '".$_SESSION['login']."' AND level = 'Member'")['count'] == 0) {
	exit(header("Location: ".$config['web']['base_url']."logout.php"));
}