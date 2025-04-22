<?php

require 'mainconfig.php';

if (!isset($_SESSION)) {
    session_start();
}
if (!isset($_SESSION['login'])) {
exit(header("Location: ".$config['web']['base_url']."auth/login.php"));
}

$profile = $model->db_query($db, "*", "users", "id='".$_SESSION['login']."'");

require 'lib/header.php';

?>
<div class="row">
  <div class="col-md-6 col-xl-3">
    <div class="card-box">
      <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Show Your Profit on Our Service"></i>
      <h4 class="mt-0 font-16">Income Status</h4>
      <h2 class="text-primary my-3 text-center">Rp.<?php echo number_format($model->db_query($db, "SUM(price) as total", "orders WHERE user_id = '".$_SESSION['login']."'")['rows']['total'],0,',','.') ?></h2>
      <p class="text-muted mb-0">Total Transaction: <?php echo number_format($model->db_query($db, "*", "orders WHERE user_id = '".$_SESSION['login']."'")['count'],0,',','.') ?> <span class="float-right"><i class="fa fa-caret-up text-success mr-1"></i>Veloura </span></p>
    </div>
  </div>
  <div class="col-md-6 col-xl-3">
    <div class="card-box">
      <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Primary Server Status"></i>
      <h4 class="mt-0 font-16">Server Status</h4>
      <h2 class="text-success my-3 text-center">Normal</h2>
      <p class="text-muted mb-0">Response : 200<span class="float-right"><i class="fa fa-caret-up text-success mr-1"></i>Veloura</span></p>
    </div>
  </div>
  <div class="col-md-6 col-xl-3">
    <div class="card-box">
      <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Total Deposit on our Panel"></i>
      <h4 class="mt-0 font-16">Deposits Status</h4>
      <h2 class="text-primary my-3 text-center">Rp.<?php echo number_format($model->db_query($db, "SUM(amount) as total", "deposits WHERE user_id = '".$_SESSION['login']."'")['rows']['total'],0,',','.') ?></h2>
      <p class="text-uted mb-0">Total Transaction:  <?php echo number_format($model->db_query($db, "*","deposits WHERE user_id = '".$_SESSION['login']."'")['count'],0,',','.') ?><span class="float-right"><i class="fa fa-caret-up text-success mr-1"></i>3.64%</span></p>
    </div>
  </div>

  <div class="col-md-6 col-xl-3">
    <div class="card-box">
      <i class="fa fa-info-circle text-muted float-right" data-toggle="tooltip" data-placement="bottom" title="" data-original-title="Your Balance"></i>
      <h4 class="mt-0 font-16">Total Balance</h4>
      <h2 class="text-primary my-3 text-center">Rp.<?php echo number_format($login['balance'],0,',','.'); ?></h2>
      <p class="text-muted mb-0">Wanna add more Balance? <span class="float-right">Chat Owner</span></p>
    </div>
  </div>
</div>

<div class="row">
    <div class="col-lg-12 text-center" style="margin: 15px 0;">
        <h3 class="text-uppercase"><i class="fa fa-user-circle-o fa-fw"></i> Informasi Akun</h3>
    </div>
  <div class="col-lg-4 col-xl-4">
    <div class="card-box text-center">
      <img src="../img/profile1.png" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image">
      <h4 class="mb-0">Veloura MLBB</h4>
      <div class="text-left mt-3">
        <p class="text-muted mb-2 font-13"><strong>Name :</strong> <span class="ml-2"><?php echo $profile['rows']['full_name']; ?></span></p>
        <p class="text-muted mb-2 font-13"><strong>Role :</strong><span class="ml-2"><?php echo $profile['rows']['level']; ?></span></p>
        <p class="text-muted mb-1 font-13"><strong>API  :</strong> <span class="ml-2"><?php echo $profile['rows']['api_key']; ?></span></p>
      </div>
    </div> <!-- end card-box -->
  </div> <!-- end col-->
  <div class="col-lg-8">
    <div class="card-box">
      <h4 class="m-t-0 m-b-30 header-title"><i class="fa fa-area-chart"></i> Grafik Pesanan & Deposit 7 Hari Terakhir</h4>
      <div id="last-order-chart" style="height: 200px;"></div>
    </div>
  </div>
</div>
<div class="row">
    <div class="col-lg-12 text-center" style="margin: 15px 0;">
        <h3 class="text-uppercase"><i class="fa fa-bullhorn fa-fw"></i> Informasi Webiste</h3>
    </div>
    <div class="col-12">
        <div class="card-box">
            <h4 class="m-t-0 m-b-30 header-title"><i class="fa fa-info-circle"></i> 5 Informasi Terbaru</h4>
            <div class="table-responsive">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 250px;">TANGGAL/WAKTU</th>
                            <th>KONTEN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $news = $model->db_query($db, "*", "news", null, "id DESC", "LIMIT 5"); if ($news['count'] == 1) {
                        ?>
                        <tr>
                            <td><?php echo format_date(substr($news['rows']['created_at'], 0, -9)).", ".substr($news['rows']['created_at'], -8) ?></td>
                            <td><?php echo nl2br($news['rows']['content']) ?></td>
                        </tr>
                        <?php
                        } else {
                        foreach ($news['rows'] as $key => $value) {
                        ?>
                        <tr>
                            <td><?php echo format_date(substr($value['created_at'], 0, -9)).", ".substr($value['created_at'], -8) ?></td>
                            <td><?php echo nl2br($value['content']) ?></td>
                        </tr>
                        <?php
                        }
                    }
                    if ($news['count'] >= 5) {
                    ?>
                        <tr>
                            <td colspan="3" align="center">
                                <a href="<?php echo $config['web']['base_url'] ?>news">Lihat semua...</a>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
Morris.Area({
	element: 'last-order-chart',
	data: [
<?php
$date_list = array();
for ($i = 6; $i > -1; $i--) {
	$date_list[] = date('Y-m-d', strtotime('-'.$i.' days'));
}
for ($i = 0; $i < count($date_list); $i++) {
	$get_order = $model->db_query($db, "*", "orders", "user_id = '".$login['id']."' AND DATE(created_at) = '".$date_list[$i]."'");
	$get_deposit = $model->db_query($db, "*", "deposits", "user_id = '".$login['id']."' AND DATE(created_at) = '".$date_list[$i]."' AND status = 'Success'");
	print("{ y: '".format_date($date_list[$i])."', a: ".$get_order['count'].", b: ".$get_deposit['count']." }, ");
}
?>
	],
	xkey: 'y',
	ykeys: ['a', 'b'],
	labels: ['Pesanan', 'Deposit'],
	lineColors: ['#02c0ce', '#53c68c'],
	gridLineColor: '#eef0f2',
	pointSize: 0,
	lineWidth: 0,
	resize: true,
	parseTime: false
});
</script>
<?php
require 'lib/footer.php';
?>