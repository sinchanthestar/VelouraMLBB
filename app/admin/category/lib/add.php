<?php
require '../../../mainconfig.php';
require '../../../lib/check_session_admin.php';
?>
<div id="modal-result" class="row"></div>
<form class="form-horizontal" method="POST" id="form-add">
	<div class="form-group">
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fa fa-key"></i></span>
			</div>
			<input class="form-control" type="text" name="game" placeholder="Masukkan Nama Game Contoh: MLBB">
		</div>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fa fa-user"></i></span>
			</div>
			<input class="form-control" type="text" name="name" placeholder="Masukkan Nama Brand Contoh: D5STUDIO">
		</div>
		<div class="input-group">
			<div class="input-group-prepend">
				<span class="input-group-text"><i class="fa fa-clock"></i></span>
			</div>
			<input class="form-control" type="number" name="time" placeholder="2 = 2 jam/hours">
		</div>
	</div>
	<div class="form-group text-right">
		<button class="btn btn-danger" type="reset"><i class="fa fa-undo"></i> Reset</button>
		<button class="btn btn-success" name="add" type="submit"><i class="fa fa-check"></i> Submit</button>
	</div>
</form>