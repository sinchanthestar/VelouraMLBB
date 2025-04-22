<?php
require '../../mainconfig.php';
require '../../lib/check_session_admin.php';
require 'lib/table.php';
require '../../lib/header_admin.php';
?>
						<div class="row">
							<div class="col-lg-12">
								<div class="card-box">
									<h4 class="m-t-0 m-b-30 header-title"><i class="fa fa-list"></i> Data Profile PAGE</h4>
										<div class="table-responsive">
										<table class="table table-striped table-bordered table-hover" id="datatable">
											<thead>
												<tr>
													<th style="max-width: 50px;">NAME</th>
													<th style="max-width: 50px;">TOKEN</th>
													<th style="max-width: 50px;">URL YT</th>
													<th style="max-width: 50px;">URL TELE</th>
													<th style="max-width: 50px;">URL IG</th>
													<th>AKSI</th>
												</tr>
											</thead>
											<tbody>
											<?php
											while ($data_query = mysqli_fetch_assoc($new_query)) {
											?>
												<tr>
													<td><?php echo $data_query['name'] ?></td>
													<td><?php echo $data_query['token_key'] ?></td>
													<td><?php echo $data_query['url_yt'] ?></td>
													<td><?php echo $data_query['url_tele'] ?></td>
													<td><?php echo $data_query['url_ig'] ?></td>
													<td><a href="javascript:;" onclick="modal_open('edit', '<?php echo $config['web']['base_url'] ?>admin/news/lib/edit-2.php?id=<?php echo $data_query['id'] ?>')" class="btn btn-sm btn-warning"><i class="fa fa-edit"></i></a></td>
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
		"ajax": "<?php echo $config['web']['base_url'] ?>admin/news/table.php"
	});
});
</script>
<?php
require '../../lib/footer.php';
?>