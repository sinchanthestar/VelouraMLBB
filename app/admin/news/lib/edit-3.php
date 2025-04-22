<?php
require '../../../mainconfig.php';
require '../../../lib/check_session_admin.php';

if (!isset($_GET['id'])) {
	$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Permintaan tidak diterima.');
} else {
	$data_target = $model->db_query($db, "*", "mod_data", "id = '".mysqli_real_escape_string($db, $_GET['id'])."'");
	if ($data_target['count'] == 0) {
		$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.');
		require '../../lib/result.php';
		exit();
	} else {
?>
<div id="modal-result" class="row"></div>
<form class="form-horizontal" method="POST" id="form-add">
	<div class="form-group">
		<input type="hidden" class="form-control" name="id" value="<?php echo $data_target['rows']['id'] ?>" readonly>
	</div>
	<div class="form-group">
		<label>MOD NAME</label>
		<textarea class="form-control" name="nama" rows="1"><?php echo $data_target['rows']['name'] ?></textarea>
		<label>VERSION</label>
		<textarea class="form-control" name="v" rows="1"><?php echo $data_target['rows']['version'] ?></textarea>
		<label>FLOATING TEXT</label>
		<textarea class="form-control" name="yt" rows="1"><?php echo $data_target['rows']['text'] ?></textarea>
		<label>STATUS</label>
		<select class="form-control" id="tele" name="tele">
		<option value="Safe">Safe</option>
		<option value="risk">risk</option>
		<option value="maintenance">MT</option>
		</select>
	</div>
	<div class="form-group text-right">
			<button class="btn btn-danger" type="reset"><i class="fa fa-undo"></i> Reset</button>
			<button class="btn btn-success" name="edit" type="submit"><i class="fa fa-check"></i> Submit</button>
	</div>
</form>
<?php
	}
}
require '../../../lib/result.php';