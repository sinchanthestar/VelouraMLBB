<?php
require '../../mainconfig.php';
require '../../lib/check_session.php';
if (isset($_GET['id'])) {
	$data_query = $model->db_query($db, "*", "users",  "id = '".$_GET['id']."'");
?>
<div class="row">
	<div class="col-md-12">
        <div class="ibox float-e-margins">
            <div class="ibox-content">
                <form class="form-horizontal" method="POST" id="form-add">
                    <div class="form-group">
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-user"></i></span>
                            </div>
                            <input type="text" class="form-control" name="id" id="id" value="<?php echo $_GET['id'] ?>" readonly></input>
                        </div>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fa fa-clock"></i></span>
                            </div>
                            <input type="number" class="form-control" name="day" placeholder="1 = 1 hari" id="day"></input>
                        </div>
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-danger" type="reset"><i class="fa fa-undo"></i> Reset</button>
                        <button class="btn btn-success" name="add" type="submit"><i class="fa fa-check"></i> Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
    
}
?>