<?php

require '../mainconfig.php';
require '../lib/check_session.php';
require '../lib/header.php';
?>
	  <?php if (isset($_POST['submit'])) {
		$post_method = $_POST['method'];
		$post_quantity = (int)$_POST['quantity'];
		$no_pengirim = $_POST['nopengirim'];
		$nohp=$no_pengirim;
		if (!preg_match('/[^+0-9]/',trim($nohp))) {
         if (substr(trim($nohp), 0, 3)=='62'){
             $no_pengirim_pulsa = trim($nohp);
         }
         else if (substr(trim($nohp), 0, 1)=='0'){
             $no_pengirim_pulsa = '62'.substr(trim($nohp), 1);
         }
     }
    		if($post_method == "") {
			    $operator = "";
			    $quantity = $post_quantity;
			    $provider = "";
			    $balance_amount = $post_quantity*0.86;
    		} else if($post_method == "087857950513") {
			    $operator = "Pulsa XL";
			    $quantity = $post_quantity;
			    $provider = "TSEL";
			    $balance_amount = $post_quantity*1;
		} else {
			die("Incorrect input!");
		}

$check_data_history = mysql_query("SELECT * FROM history_topup WHERE jumlah_transfer = '$quantity' AND no_pengirim = '$no_pengirim_pulsa' AND date = '$date'");
		if ($post_quantity < 5000) {
			$msg_type = "error";
			$msg_content = "Minimal Deposit Adalah <b>Rp.5.000</b>.";
		} else if(mysql_num_rows($check_data_history) > 0) {
			$msg_type = "error";
			$msg_content = "Anda Tidak Bisa Menggunakan Nomor Yang Sama Untuk Jumlah Pembayaran Yang Sama.";
		} else {
	$kodegen = rand(0000000,9999999);
	$send = mysql_query("UPDATE hof1 SET deposit = deposit+$quantity WHERE username = '$username'");
	$send = mysql_query("UPDATE hof1 SET jumlah = jumlah+1 WHERE username = '$username'");
	$send = mysql_query("INSERT INTO history_topup (kode, provider, amount, jumlah_transfer, username, no_pengirim, date, time, status, type) VALUES ('$kodegen', '$provider', '$balance_amount', '$quantity', '$username', '$no_pengirim_pulsa', '$date', '$time', 'NO', 'WEB')");
if ($send) { ?>
<div class="alert bg-inverse">
<font color="white">
<strong>Request Add Balance berhasil!</strong><br />
Metode Pembayaran : <?php echo $provider; ?><br />
Nomor Pengirim : <?php echo $no_pengirim; ?><br />
Jumlah Transfer : <?php echo $post_quantity; ?><br />
Saldo Didapat: <?php echo $balance_amount; ?><br />
Status: Menunggu Pembayaran<br />
Tanggal : <?php echo $date; ?><br />
<hr>
<h5>Silahkan Transfer Pembayaran Yang Sesuai Ke <b>087857950513</b> Dengan Nominal Transfer <b>Rp <?php echo $post_quantity; ?></b><br />
<h5>Setelah Anda Mentransfer Pembayaran Yang Sesuai, Saldo Akan Otomatis Masuk Pada Akun Anda.</h5>
</div>
<? } else { ?>
Database error!
<? } } } else { ?>
    <!-- Row-->
 <div class="row">
                            <div class="col-md-8">
                                <div class="panel panel-custom panel-border">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Deposit Otomatis</h3>
                                    </div>
                                    <div class="panel-body">
					                    <form class="form-horizontal" role="form" method="POST">
											<div class="form-group">
												<label class="col-md-2 control-label">Metode</label>
												<div class="col-md-10">
													<select class="form-control" name="method" id="depomethod">
														<option value="0">Pilih Metode Pembayaran...</option>
														<option value="082282297528">XL-087857950513</option>
													</select>
													<span class="help-block"></span>
												</div>
											</div>
											<div class="form-group">
												<label class="col-md-2 control-label">Nomor</label>
												<div class="col-md-10">
													<input type="number" name="nopengirim" class="form-control" placeholder="Nomor Pengirim">
													<span class="help-block"></span>
												</div>
											</div>
											<input type="hidden" id="rate" value="0">
											<div class="form-group">
												<label class="col-md-2 control-label">Jumlah Deposit</label>
												<div class="col-md-10">
													<input type="number" name="quantity" class="form-control" placeholder="Minimal 5.000" onkeyup="get_total(this.value).value;">
													<span class="help-block"></span>
												</div>
											</div>
											<input type="hidden" id="rate" value="0">
											<div class="form-group">
                                                <div class="col-md-offset-2 col-md-8">
                                                    <button type="reset" class="btn btn-danger"><i class="fa fa-refresh"></i> Ulangi</button>
						                            <button type="submit" class="btn btn-info btn-bordered waves-effect w-md waves-light" name="submit"><i class="fa fa-send"></i> Deposit</button>
                                                    <span class="help-block"></span>
                                                </div>
                                            </div>
										</form>
									</div>
								</div>
							</div>
                            <div class="col-md-4">
                                <div class="panel panel-custom panel-border">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Informasi</h3>
                                    </div>
                                    <div class="panel-body">
                                    <b>Cara Melakukan Deposit Otomatis</b>:
					                    <ul>
						                    <li>Pilih Metode Pembayaran <b>Pulsa Telkomsel</b>.</li>
						                    <li>Masukan Nomor Pengirim Transfer <b>Contoh: 08xxx</b>.</li>
						                    <li>Masukan Jumlah Pembayaran, Minimal Deposit Adalah <b>5.000</b></li>
						                    <li>Klik <b>Deposit</b>, Maka Permintaan Deposit Anda Akan Diterima. Setelah Itu Akan Muncul Tab Baru Berisi <b>Kode Deposit</b>, <b>Tujuan Pembayaran</b>, Dan <b>Jumlah Yang Harus Dibayar</b>. Segera Lakukan Pembayaran Sesuai Dengan Jumlah Yang Harus Dibayar, Ini Berfungsi Untuk Mempermudah Pembacaan Sistem. Jika Sudah Melakukan Pembayaran Tunggu Hingga Beberapa Detik Maka Saldo Anda Akan Terisi Secara Otomatis.</li>
					                    </ul>
					                <b>Catatan</b>:
					                    <ul>
					                        <li>Anda Hanya Bisa Melakukan Deposit Maksimal 2x Apabila Deposit Belum Selesai.</li>
						                    <li>Jumlah Saldo Yang Didapat Adalah Jumlah Yang Dikalikan Rate.</li>
						                    <li>Jika Deposit Tidak Dibayar Sampai Lebih Dari 24 Jam, Maka Secara Otomatis Sistem Akan Membatalkan Permintaan Deposit Anda.</li>
						                    <li>Apabila Pengguna Terbukti Melakukan Kecurangan Saat Deposit, Kami Akan Menghapus Akun Terkait Secara Permanen Dan Tidak Ada Pengembalian Dana Sepeserpun.</li>
						                    <li>Jika Terjadi Kesalahan Saat Melakukan Deposit, Silahkan Laporkan Ke Admin.</li>
					                    </ul>
                                    </div>
                                </div>
                            </div>
						</div>
<? } ?> 			
                    <!-- Row-->
 
<script type="text/javascript">
function send()

function getcut(quantity){
 var rate = $("#rate").val();
 var hasil = eval(quantity) * rate;
 $('#cutbalance').val(hasil);
} 

function getbal(quantity){
var method = $("#method").val();

 if (method== "085392246300"){
  var hasil = eval(quantity);
  $('#getbalance').val(hasil);
 }

}

$(document).ready(function() {
	function get_methods(payment, type) {
		$.ajax({
			type: "POST",
			url: "<?php echo $config['web']['base_url'] ?>ajax/deposit-get-method.php",
			data: "payment=" + payment + "&type=" + type,
			dataType: "html",
			success: function(data) {
				$('#method').html(data);
			}, error: function() {
				$('#ajax-result').html('<font color="red">Terjadi kesalahan! Silahkan refresh halaman.</font>');
			}
		});
	}
	$('input[type=radio][name=type]').change(function() {
		get_methods($('#payment').val(), this.value);
	});
	$('#payment').change(function() {
		get_methods($('#payment').val(), $('input[type=radio][name=type]:checked').val());
		if ($('#payment').val() == 'pulsa') {
			$('#phone').removeClass('hide');
		} else {
			$('#phone').addClass('hide');
		}
	});
	$('#method').change(function() {
		var method = $('#method').val();
		$.ajax({
			type: "POST",
			url: "<?php echo $config['web']['base_url'] ?>ajax/deposit-select-method.php",
			data: "method=" + method,
			dataType: "html",
			success: function(data) {
				$('#min-amount').html(data);
			}, error: function() {
				$('#ajax-result').html('<font color="red">Terjadi kesalahan! Silahkan refresh halaman.</font>');
			}
		});
	});
	$('#post-amount').keyup(function() {
		var method = $('#method').val();
		var amount = $('#post-amount').val();
		$.ajax({
			type: "POST",
			url: "<?php echo $config['web']['base_url'] ?>ajax/deposit-get-amount.php",
			data: "method=" + method + "&amount=" + amount,
			dataType: "html",
			success: function(data) {
				$('#amount').val(data);
			}, error: function() {
				$('#ajax-result').html('<font color="red">Terjadi kesalahan! Silahkan refresh halaman.</font>');
			}
		});
	});
});
</script>
<?php
require '../lib/footer.php';
?>

</script>