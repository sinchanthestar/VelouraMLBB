<?php
require '../../../mainconfig.php';
require '../../../lib/check_session_admin.php';

if (!isset($_GET['id']) OR !isset($_GET['status'])) {
	$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Permintaan tidak diterima.');
} else {
	$data_target = $model->db_query($db, "*", "users", "id = '".mysqli_real_escape_string($db, $_GET['id'])."'");
	if ($data_target['count'] == 0) {
		$_SESSION['result'] = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.');
	} else {
?>
<div id="modal-result" class="row"></div>
<form class="form-horizontal" method="POST" id="form">
	<div class="form-group">
		<input type="hidden" class="form-control" name="id" value="<?php echo $data_target['rows']['id'] ?>" readonly>
        <input type="hidden" class="form-control" name="status" value="<?php echo $_GET['status'] ?>" readonly>
	</div>
	Yakin ingin mengubah data ini?
	<div class="form-group text-right">
			<button class="btn btn-danger" type="reset"><i class="fa fa-undo"></i> Reset</button>
			<button class="btn btn-success" name="change" type="submit"><i class="fa fa-check"></i> Submit</button>
	</div>
</form>
<?php
	}
}
require '../../../lib/result.php';