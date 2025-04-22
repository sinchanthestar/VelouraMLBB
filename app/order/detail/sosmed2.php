<?php
require '../../mainconfig.php';
require '../../lib/check_session.php';
	if (isset($_GET['T_id'])) {
		$data_query = $model->db_query($db, "*", "token",  "id = '".$_GET['T_id']."'");
		$time1 = new DateTime(date("Y-m-d H:i:s"));
		$time2 = new DateTime($data_query['rows']['cheat_exp']);
		$interval = $time1->diff($time2)->format("%r%a");
		$jam = $time1->diff($time2)->format("%r%h");
		$sisa = "$interval hari $jam jam";
		if($data_query['rows']['serial'] == 0) {
		    $serial = 'BELUM LOGIN';
		}else{
		    $serial = 'SERIAL DISEMBUNYKAN';
		}
		if($data_query['rows']['active'] == 0){
		    $dur = 'BELUM BERJALAN';
		}else{
		    $dur = $sisa;
		}
?>
										
		    <div class="row">
		    	<div class="col-md-12">
                            <div class="ibox float-e-margins">
                                <div class="ibox-content">
                	                    <div class="table-responsive">
                                            <table class="table table-stripped" data-page-size="8" data-filter=#filter>
                                                <tr>
													<td><b>ID</b></td>
													<td><?php echo $data_query['rows']['id'] ?></td>
												<tr>
												<tr>
													<td><b>NAME</b></td>
													<td><?php echo $data_query['rows']['data'] ?></td>
												<tr>
												<tr>
													<td><b>KEY</b></td>
													<td><?php echo $data_query['rows']['access_key'] ?></td>
												<tr>
												<tr>
													<td><b>GAME</b></td>
													<td><?php echo $data_query['rows']['games'] ?></td>
												<tr>
												<tr>
													<td><b>LAYANAN</b></td>
													<td><?php echo $data_query['rows']['cheat_name'] ?></td>
												<tr>
												<tr>
													<td><b>SLOT</b></td>
													<td><?php echo $data_query['rows']['slot'].' DEVICE' ?></td>
												<tr>
												<tr>
													<td><b>SERIAL</b></td>
													<td><?php echo $serial ?> </td>
												<tr>
												<tr>
													<td><b>SISA DURASI</b></td>
													<td><?php echo $dur ?></td>
												<tr>
												<tr>
													<td><b>RESET SERIAL</b></td>
													<td><a href="javascript:;" onclick="modal_open('reset', '<?php echo $config['web']['base_url']; ?>order/libs/del.php?id=<?php echo $data_query['rows']['id'] ?>&limit=<?php echo $data_query['rows']['cheat_slot'] ?>&access_key=<?php echo $data_query['rows']['access_key'] ?>')" class="btn btn-block btn-warning">#<?php echo 'RESET'; ?>#</a></td>
												<tr>
					                    </div>
					                    
                                    </div>
                                    
                    </div>
                    
                </div>
                
            </div>
<?php
	}
?>