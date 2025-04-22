<?php
require '../mainconfig.php';
require '../lib/check_session_admin.php';
require '../lib/header_admin.php';
?>
<div class="row">
    <div class="col-lg-12">
        <div class="col-12">
            <div class="widget-rounded-circle card-box bg-pattern">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="avatar-lg rounded-circle bg-success">
                            <i class="fe-shopping-cart font-24 avatar-title"> </i>
                        </div>
                    </div>
                    <div class="col">
                        <p class="card-category">
                            Total Pesanan
                        </p>
                        <h5 class="card-title">
                            Rp
                            <?php echo number_format($model->db_query($db, "SUM(price) as total", "orders")['rows']['total'],0,',','.') ?> (<?php echo number_format($model->db_query($db, "*", "orders")['count'],0,',','.') ?>)
                        </h5>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="widget-rounded-circle card-box bg-pattern">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="avatar-lg rounded-circle bg-warning">
                            <i class="fe-credit-card font-24 avatar-title"> </i>
                        </div>
                    </div>
                    <div class="col">
                        <p class="card-category">
                            Total Deposit
                        </p>
                        <h5 class="card-title">
                            Rp
                            <?php echo number_format($model->db_query($db, "SUM(amount) as total", "deposits")['rows']['total'],0,',','.') ?> (<?php echo number_format($model->db_query($db, "*", "deposits")['count'],0,',','.') ?>)
                        </h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12">
            <div class="widget-rounded-circle card-box bg-pattern">
                <div class="row align-items-center">
                    <div class="col-auto">
                        <div class="avatar-lg rounded-circle bg-info">
                            <i class="fe-user font-24 avatar-title"> </i>
                        </div>
                    </div>
                    <div class="col">
                        <p class="card-category">
                            Saldo Pengguna
                        </p>
                        <h5 class="card-title">
                            Rp
                            <?php echo number_format($model->db_query($db, "SUM(balance) as total", "users")['rows']['total'],0,',','.') ?> (<?php echo number_format($model->db_query($db, "*", "users")['count'],0,',','.') ?>)
                        </h5>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
					
<?php
require '../lib/footer.php';
?>