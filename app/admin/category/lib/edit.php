<?php
require '../../../mainconfig.php';
require '../../../lib/check_session_admin.php';

if (!isset($_GET['id'])) {
	$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Permintaan tidak diterima.');
} else {
	$data_target = $model->db_query($db, "*", "categories", "id = '".mysqli_real_escape_string($db, $_GET['id'])."'");
	if ($data_target['count'] == 0) {
		$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Data tidak ditemukan.');
	} else {
?>
<div id="modal-result" class="row"></div>
<form class="form-horizontal" method="POST" id="form-add">
	<div class="form-group">
		<input type="hidden" class="form-control" name="id" value="<?php echo $data_target['rows']['id'] ?>" readonly>
	</div>
	<div class="form-group">
		<label>Game Name</label>
		<input type="text" class="form-control" name="name" value="<?php echo $data_target['rows']['name'] ?>">
        <label>Version</label>
		<input type="text" class="form-control" name="versi" value="<?php echo $data_target['rows']['appver'] ?>">
        <lable>Status</lable>
        <select class="custom-select " name="stat">
          <option selected>Select Status</option>
          <option value="1">Safe</option>
          <option value="2">Maintenance</option>
      </select>
	  <label>Free Key Expired</label>
		<input type="text" class="form-control" name="time" value="<?php echo $data_target['rows']['time'] ?>">
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