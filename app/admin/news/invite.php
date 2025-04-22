<?php
require '../../mainconfig.php';
require '../../lib/check_session_admin.php';
require 'lib/atable.php';
require '../../lib/header_admin.php';
?>
						<div class="row">
							<div class="col-lg-12">
							<a href="javascript:;" onclick="modal_open('add', '<?php echo $config['web']['base_url'] ?>admin/news/lib/add-inv.php?uid=<?php echo $login['id'] ?>&sisa=<?php echo $login['balance'] ?>&nama=<?php echo $login['username'] ?>')" class="btn btn-success" style="margin-bottom: 15px"><i class="fa fa-plus-square"></i> Tambah</a>
								<div class="card-box">
									<h4 class="m-t-0 m-b-30 header-title"><i class="fa fa-list"></i> Invite Code</h4>
										<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover" id="datatable">
											<thead>
												<tr>
													<th>ID</th>
													<th style="max-width: 100px;">CODE INVITE</th>
													<th style="max-width: 100px;">SALDO</th>
													<th>STATUS</th>
													<th>AKSI</th>
												</tr>
											</thead>
											<tbody>
											<?php
											while ($data_query = mysqli_fetch_assoc($new_query)) {
											    $status ='';
											    if($data_query['isUse'] == 1){
											        $status = 'SUDAH TERPAKAI';
											    }else{
											        $status = 'BELUM TERPAKAI';
											    }
											?>
												<tr>
													<td><?php echo $data_query['id'] ?></td>
													<td><?php echo $data_query['code'] ?></td>
													<td><?php echo $data_query['saldo'] ?></td>
													<td><?php echo $status ?></td>
													<td><a href="javascript:;" onclick="modal_open('delete', '<?php echo $config['web']['base_url'] ?>admin/news/lib/del.php?id=<?php echo $data_query['id'] ?>')" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a></td>
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
		"ajax": "<?php echo $config['web']['base_url'] ?>admin/news/atable.php"
	});
});
</script>
<?php
require '../../lib/footer.php';
?>