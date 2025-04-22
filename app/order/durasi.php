<?php
require '../mainconfig.php';
require '../lib/check_session_admin.php';
function GetUplink($uid){
    $var1 = $model->db_query($db,"*", "users", "id ='".$uid."'");
    return $var1['rows']['username'];
}
if(isset($_POST['action'])){
    if($_POST['action'] == "delete"){
        if($model->db_delete($db, "token", "access_key = '".$_POST['access_key']."'") == true){
            if($model->db_delete($db, "sList", "access_key = '".$_POST['access_key']."'") == true){
                $_SESSION['result_msg'] = array('alert' => 'info', 'title' => 'BERHASIL!', 'msg' => 'Token '.$_POST['access_key'].' Telah Dihapus', 'show' => true);
            }else{
                $_SESSION['result_msg'] = array('alert' => 'danger', 'title' => 'GAGAL!', 'msg' => "Coba Lagi!", 'show' => true);
            }
        }else{
            $_SESSION['result_msg'] = array('alert' => 'danger', 'title' => 'GAGAL!', 'msg' => "Coba Lagi!", 'show' => true);
        }
    }
}
if (isset($_POST['jam'])) {
    $query_list_key = "SELECT * FROM token WHERE active LIKE '1' ORDER BY cheat_exp DESC";
    $new_query_key = mysqli_query($db, $query_list_key);
    while ($data_query_key = mysqli_fetch_assoc($new_query_key)) {
        $date1 = $data_query_key['cheat_exp'];
        $date2 = date_create($date1);
        $inter = date_interval_create_from_date_string($_POST['jam']." hours");
        $add = date_add($date2,$inter);
        $date = date_format($add,'Y-m-d H:i:s');
        if($model->db_update($db, "token", array('cheat_exp' =>$date), "access_key = '".$data_query_key['access_key']."'") == true){
            $_SESSION['result_msg'] = array('alert' => 'info', 'title' => 'Play Durasi!', 'msg' => "Kompensasi Durasi Selama ".$_POST['jam']."jam Berhasil", 'show' => true);
        }else{
            $_SESSION['result_msg'] = array('alert' => 'danger', 'title' => 'Error!', 'msg' => "Coba Lagi!", 'show' => true);
        }
    }
}

if (isset($_POST['id'])) {
    if (isset($_POST['day'])) {
        require '../lib/is_login.php';
        $dbs = $model->db_query($db, "*", "token", "id = '".$_POST['id']."'");
        $kalkulasi = $dbs['rows']['durasi'] + $_POST['day'];
        $date1 = $dbs['rows']['start'];
        $date2 = date_create($date1);
        $inter = date_interval_create_from_date_string($kalkulasi." days");
        $add = date_add($date2,$inter);
        $date = date_format($add,'Y-m-d H:i:s');
        $cost = 5000 * $_POST['day'];
        if($login['balance'] < $cost){
            $_SESSION['result_msg'] = array('alert' => 'danger', 'title' => 'GAGAL!', 'msg' => "Saldo Pada Akun Anda Kurang!", 'show' => true);
        }else{
            if($model->db_update($db, "users", array('balance' => $login['balance'] - $cost), "id = '".$_SESSION['login']."'")){
                if($model->db_update($db, "token", array('durasi' =>$kalkulasi, 'cheat_exp' =>$date), "id = '".$_POST['id']."'") == true){
                    $model->db_insert($db, "balance_logs", array('user_id' => $_SESSION['login'], 'type' => 'minus', 'amount' => $cost, 'note' => 'Perpanjang Token ID: '.$_GET['id'].'.', 'created_at' => date('Y-m-d H:i:s')));
                    $_SESSION['result_msg'] = array('alert' => 'success', 'title' => 'BERHASIL!', 'msg' => "Durasi Telah Di Tambah Selama ".$_POST['day']."Hari </br> Harga : Rp.".number_format($cost,0,',','.')."</br> Saldo : Rp.".number_format($login['balance']-$cost,0,',','.')."</br>", 'show' => true);
                }else{
                    $_SESSION['result_msg'] = array('alert' => 'danger', 'title' => 'GAGAL!', 'msg' => "Gagal Mengupdate Data Token!", 'show' => true);
                }
            }else{
                $_SESSION['result_msg'] = array('alert' => 'danger', 'title' => 'GAGAL!', 'msg' => "Gagal Mengupdate Data Seller!", 'show' => true);
            }
        }
    }
    
}
if ($_GET) {
	if (!empty($_GET['search']) AND !empty($_GET['status'])) {
		$query_list = "SELECT * FROM token WHERE access_key LIKE '%".protect_input($_GET['search'])."%' AND games LIKE '%".protect_input($_GET['status'])."%' ORDER BY id DESC";
	} else if (!empty($_GET['search'])) {
		$query_list = "SELECT * FROM token WHERE access_key LIKE '%".protect_input($_GET['search'])."%' ORDER BY id DESC";
	} else if (!empty($_GET['status'])) {
		$query_list = "SELECT * FROM token WHERE games LIKE '%".protect_input($_GET['status'])."%' ORDER BY id DESC";
	} else {
		$query_list = "SELECT * FROM token ORDER BY id DESC";
	}
} else {
	$query_list = "SELECT * FROM token ORDER BY id DESC";
}

$records_per_page = 30;
$starting_position = 0;
if(isset($_GET["page"])) {
	$starting_position = ($_GET["page"]-1) * $records_per_page;
}
$new_query = $query_list." LIMIT $starting_position, $records_per_page";
$new_query = mysqli_query($db, $new_query);
require '../lib/header.php';
?>
						<div class="row">
							<div class="col-lg-12">
                    			<div class="card-box">
                        		<h4 class="m-t-0 m-b-30 header-title"><i class="fa fa-history"></i> Key List</h4>
									<form method="get" action="<?php echo $_SERVER['PHP_SELF']; ?>">
										<div class="row">
										    <div class="form-group col-lg-5">
                                        		<label>Filter Game</label>
                                        		<select class="form-control" name="status">
                                        			<option value="">Semua</option>
                                        			<option value="PEPELO" >PEPELO</option>
                                                   	<option value="MLBB" >MLBB</option>
                                                    <option value="CODM" >CODM</option>
                                                    <option value="PUBGM" >PUBGM</option>
                                        		</select>
                                        	</div>
                                        	<div class="form-group col-lg-5">
                                        		<label>Access Key</label>
                                        		<input type="text" class="form-control" name="search" placeholder="Kata Kunci..." value="">
                                        	</div>
                                        	<div class="form-group col-lg-2">
                                        		<label>Submit</label>
                                        		<button type="submit" class="btn btn-block btn-dark">Filter</button>
                                        	</div>
                                        </div>
								    </form>
								    <a href="javascript:;" onclick="modal_open('detail', '<?php echo $config['web']['base_url']; ?>order/detail/subs.php?id=<?php echo $_SESSION['login'] ?>')" class="btn btn-block btn-dark">KOMPENSASI MEMBER</a>
									<div class="table-responsive">
                                        <table class="table table-bordered table-hover">
											<thead>
												<tr>
													<th>ID</th>
													<th>NAMA</th>
													<th>SELLER</th>
													<th style="max-width: 100px;">TOKEN</th>
													<th>DURASI</th>
													<th>DEVICE</th>
													<th>GAME</th>
													<th>ACTION</th>
													<th>DURASI</th>
												</tr>
											</thead>
											<?php	
											while ($data_query = mysqli_fetch_assoc($new_query)) {
											$time1 = new DateTime(date("Y-m-d H:i:s"));
											$time2 = new DateTime($data_query['cheat_exp']);
											$interval = $time1->diff($time2)->format("%r%a");
											$jam = $time1->diff($time2)->format("%r%h");
											$sisa = "$interval hari $jam jam";
											if($data_query['serial'] == 0) {
											    $serial = 'BELUM LOGIN';
											}else{
											    $serial = 'HIDDEN DATA';
											}
											if($data_query['active'] == 0){
											    $dur = 'BELUM BERJALAN';
											}else{
											    if(date("Y-m-d H:i:s") > $data_query['cheat_exp']){
											        $dur = 'EXPIRED!!';
											        if($model->db_delete($db, "token", "access_key = '".$data_query['access_key']."'")){
											            $model->db_delete($db, "sList", "access_key = '".$data_query['access_key']."'");
											        }
											        
											    }else{
											        $dur = $sisa;
											    }
											}
											?>
											<tbody>
												<tr>
													<td><a href="javascript:;" onclick="modal_open('detail', '<?php echo $config['web']['base_url']; ?>order/detail/sosmed2.php?T_id=<?php echo $data_query['id'] ?>')" class="badge badge-info">#<?php echo $data_query['id']; ?></a></td>
													<td><?php echo $data_query['data'] ?></td>
													<td><?php echo $model->db_query($db,"username", "users", "id ='".$data_query['uid']."'")['rows']['username'] ?></td>
													<td><?php echo $data_query['access_key'] ?></td>
													<td><?php echo $dur ?></td>
													<td><?php echo $serial ?></td>
													<td><span class="badge badge-info"><?php echo $data_query['games'] ?></span></td>
													<td>
													    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
													        <div class="form-group">
													            <input type="hidden" name="action" value="delete">
													            <input type="hidden" name="access_key" value="<?php echo $data_query['access_key'] ?>">
													            <button type="submit" class="btn btn-block btn-danger">DELETE</button>
													       </div>
													   </form>
													</td>
													<td><a href="javascript:;" onclick="modal_open('edit', '<?php echo $config['web']['base_url']; ?>order/detail/subs_durasi.php?id=<?php echo $data_query['id'] ?>')" class="btn btn-block btn-success">ADD</a></td>
												</tr>
                                            </tbody>
											<?php
											}
											?>
										</table>
										<?php
                                        require '../lib/pagination.php';
                                        ?>
										</div>
									</div>
								</div>
							</div>
						</div>
<?php
require '../lib/footer.php';
?>