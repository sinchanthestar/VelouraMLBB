<?php
require '../../mainconfig.php';
require '../../lib/check_session_admin.php';
require 'lib/table-manage.php';
require '../../lib/header_admin.php';
if(isset($_GET['Kend_date'])){
    $status = $model->db_query($db, "keygen", "pgen", "id = '1'")['rows']['keygen'];
    if($status == 1){
        if($model->db_update($db, "pgen", array('Kend' => $_GET['Kend_date']), "id = '1'") == true){
            $_SESSION['result_msg'] = array('alert' => 'success', 'title' => 'SUCCESS!', 'msg' => "KeyGen End Date has been set ".$_GET['Kend_date'], 'show' => true);
        }else{
            $_SESSION['result_msg'] = array('alert' => 'danger', 'title' => 'ERROR!', 'msg' => "Can't Get KeyGen Status!!!", 'show' => true);
        }
    }else{
        $_SESSION['result_msg'] = array('alert' => 'danger', 'title' => 'FAILED!', 'msg' => "KeyGen Status Is Running!!", 'show' => true);
    }
}

if(isset($_GET['Send_date'])){
    $status = $model->db_query($db, "maintenance", "pgen", "id = '1'")['rows']['maintenance'];
    if($status == 1){
        if($model->db_update($db, "pgen", array('Mend' => $_GET['Send_date']), "id = '1'") == true){
            $_SESSION['result_msg'] = array('alert' => 'success', 'title' => 'SUCCESS!', 'msg' => "Server End Date has been set ".$_GET['Send_date'], 'show' => true);
        }else{
            $_SESSION['result_msg'] = array('alert' => 'danger', 'title' => 'ERROR!', 'msg' => "Can't Get Server Status!!!", 'show' => true);
        }
    }else{
        $_SESSION['result_msg'] = array('alert' => 'danger', 'title' => 'FAILED!', 'msg' => "Server Status Is Running!!", 'show' => true);
    }
}

?>
						<div class="row">
						    <div class="col-lg-6">
								<div class="card-box">
								    <h4 class="m-t-0 m-b-30 header-title"><i class="fa fa-list"></i>Server End Date</h4>
									<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
										<div class="row">
                                        	<div class="form-group col-lg-9">
												<input type="date" id="basic-datepicker" class="form-control" name="Send_date" value="<?php echo (isset($_GET['end_date'])) ? $_GET['end_date'] : date('Y-m-d') ?>">
											</div>
                                        	<div class="form-group col-lg-3">
                                        		<button type="submit" class="btn btn-block btn-dark">Set Date</button>
                                        	</div>
                                        </div>
								    </form>
								</div>
							</div>
							<div class="col-lg-6">
								<div class="card-box">
								    <h4 class="m-t-0 m-b-30 header-title"><i class="fa fa-list"></i>KeyGen End Date</h4>
									<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
										<div class="row">
                                        	<div class="form-group col-lg-9">
												<input type="text" id="datetime-datepicker" class="form-control" name="Kend_date" value="<?php echo (isset($_GET['end_date'])) ? $_GET['end_date'] : date('Y-m-d H:i') ?>">
											</div>
                                        	<div class="form-group col-lg-3">
                                        		<button type="submit" class="btn btn-block btn-dark">Set Date</button>
                                        	</div>
                                        </div>
								    </form>
								</div>
							</div>
							<div class="col-lg-12">
								<div class="card-box">
									<h4 class="m-t-0 m-b-30 header-title"><i class="fa fa-list"></i>Server Settings</h4>
										<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover" id="datatable">
											<thead>
												<tr>
													<th "max-width: 50px;"> Server </th>
													<th style="max-width: 50px;">KeyGen</th>
													<th>AKSI</th>
												</tr>
											</thead>
											<tbody>
											<?php
											while ($data_query = mysqli_fetch_assoc($new_query)) {
											    function Bool2Str($bool){
											        if($bool == 1){
											            return "Maintenance";
											        }else{
											            return "Running";
											        }
											    }
											?>
												<tr>
													<td><?php echo Bool2Str($data_query['maintenance']) ?></td>
													<td><?php echo Bool2Str($data_query['keygen']) ?></td>
													<td><a href="javascript:;" onclick="modal_open('edit', '<?php echo $config['web']['base_url'] ?>admin/news/lib/edit-manage.php?id=1')" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a></td>
												</tr>
											<?php
											}
											?>
											</tbody>	
										</table>
										<?php include("../../lib/pagination.php"); ?>
										</div>
									</div>
								</div>
							</div>
						</div>
<script>
$(document).ready(function() {
	$('#datatable').DataTable( {
		"order": [[0, 'desc']],
		"processing": true,
		"serverSide": true,
		"columnDefs": [
			{ "targets": [3], "orderable": false, "searchable": false } // action
		],
		"ajax": "<?php echo $config['web']['base_url'] ?>admin/news/table-manage.php"
	});
});
</script>
<?php
require '../../lib/footer.php';
?>