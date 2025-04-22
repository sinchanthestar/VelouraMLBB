<?php
require '../../mainconfig.php';
require '../../lib/check_session_member.php';
?>
<div id="modal-result" class="row"></div>
<form class="form-horizontal" method="POST" id="form-add">
    <div class="form-group">
        <label>Saldo</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <span class="input-group-text"><i class="fa fa-dollar"> Rp.</i></span>
            </div>
            <input type="number" class="form-control" name="amount" placeholder="1000" id="amount"></input>
	    </div>
	</div>
	<div class="form-group text-right">
		<button class="btn btn-danger" type="reset"><i class="fa fa-undo"></i> Reset</button>
		<button class="btn btn-success" name="add" type="submit"><i class="fa fa-check"></i> Submit</button>
	</div>
</form>