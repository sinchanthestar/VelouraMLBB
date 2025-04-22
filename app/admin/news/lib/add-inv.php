<?php
require '../../../mainconfig.php';
require '../../../lib/check_session_admin.php';
?>
<div id="modal-result" class="row"></div>
<form class="form-horizontal" method="POST" id="form-add">
	<div class="form-group">
	    <input type="text" class="form-control" name="nama" value=<?php echo $_GET['nama'] ?> readonly>
		<label>Saldo</label>
		<input class="form-control" type="number" id="saldo" name="saldo" step="1000">
		<input type="hidden" class="form-control" name="uid" value=<?php echo $_GET['uid'] ?> readonly>
		<input type="hidden" class="form-control" name="sisa" value=<?php echo $_GET['sisa'] ?> readonly>
	</div>
	<div class="form-group text-right">
		<button class="btn btn-danger" type="reset"><i class="fa fa-undo"></i> Reset</button>
		<button class="btn btn-success" name="add" type="submit"><i class="fa fa-check"></i> Submit</button>
	</div>
</form>