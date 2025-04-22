<?php
require '../../../mainconfig.php';
require '../../../lib/check_session_admin.php';

if (!isset($_GET['id'])) {
	$result_msg = array('alert' => 'danger', 'title' => 'Gagal!', 'msg' => 'Permintaan tidak diterima.');
} else {
	$data_target = $model->db_query($db, "*", "profile", "id = '".mysqli_real_escape_string($db, $_GET['id'])."'");
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
		<label>NAME</label>
		<textarea class="form-control" name="nama" rows="1"><?php echo $data_target['rows']['name'] ?></textarea>
		<label>URL YOUTUBE</label>
		<textarea class="form-control" name="yt" rows="1"><?php echo $data_target['rows']['url_yt'] ?></textarea>
		<label>URL TELEGRAM</label>
		<textarea class="form-control" name="tele" rows="1"><?php echo $data_target['rows']['url_tele'] ?></textarea>
		<label>URL INSTRAGRAM</label>
		<textarea class="form-control" name="ig" rows="1"><?php echo $data_target['rows']['url_ig'] ?></textarea>
		<label>DANA</label>
		<textarea class="form-control" name="dana" rows="1"><?php echo $data_target['rows']['dana'] ?></textarea>
		<label>GOPAY</label>
		<textarea class="form-control" name="gopay" rows="1"><?php echo $data_target['rows']['gopay'] ?></textarea>
		<label>OVO</label>
		<textarea class="form-control" name="ovo" rows="1"><?php echo $data_target['rows']['ovo'] ?></textarea>
		<label>GAME</label>
		<textarea class="form-control" name="game1" rows="1"><?php echo $data_target['rows']['game1'] ?></textarea>
		<textarea class="form-control" name="game2" rows="1"><?php echo $data_target['rows']['game2'] ?></textarea>
		<textarea class="form-control" name="game3" rows="1"><?php echo $data_target['rows']['game3'] ?></textarea>
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