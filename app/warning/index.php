<?php

require '../mainconfig.php';
session_start();
if(!isset($_SESSION['warData'])){
    exit();
}

$date = date_create($_SESSION['warData']['date']);
$date2 = date_format($date,'Y-m-d H:i');
if($date2 <= date('Y-m-d H:i')){
    if($model->db_update($db, $_SESSION['warData']['table'], array($_SESSION['warData']['rows'] => 0), "id = '1'") == true){
        die(header("Location: ../../../"));
    }else{
    }
}
require '../lib/partials/head-css.php';
require '../lib/partials/title-meta.php';
?>
<body class="authentication-bg">
 <div id="wrapper">
  <div class="mt-5 mb-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
              <div class="card bg-pattern">    
                <div class="text-center">
                    <h2><a href="../../"><img src="../../img/profile1.png" class="rounded-circle avatar-lg img-thumbnail" alt="profile-image"></a></h2>
                    <h3 class="text-dark-50 text-center mt-4"><?php echo $_SESSION['warData']['Title'] ?></h3>
                    <p class="text-muted mb-4"><?php echo $_SESSION['warData']['SubTitle'] ?></p>
                    <div class="row mt-5 justify-content-center">
                        <div class="col-md-8">
                            <div data-countdown="<?php echo $_SESSION['warData']['date'] ?>" class="counter-number text-muted mb-4"></div>
                        </div> <!-- end col-->
                    </div> <!-- end row-->
                </div> <!-- end /.text-center-->
               </div>
            </div> <!-- end col -->
        </div><!-- end row -->
    </div>
  </div>
</div>
<!-- App js -->
<script src="<?php echo $config['web']['base_url'] ?>assets/js/app.min.js"></script>

<!-- Plugins js-->
<script src="<?php echo $config['web']['base_url'] ?>assets/libs/jquery-countdown/jquery.countdown.min.js"></script>

<!-- Countdown js -->
<script src="<?php echo $config['web']['base_url'] ?>assets/js/pages/coming-soon.init.js"></script>
</body>
</html>