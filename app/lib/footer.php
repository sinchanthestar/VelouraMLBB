<!-- Footer Start -->
<footer class="footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                Copyright &copy;
                <b>
                    <a style="color: blue;" href="javascript:void(0);">
                        <?php echo $config['web']['meta']['author'] ?>
                    </a>
                </b>
                <?php echo date( "Y"); ?>
            </div>
            <div class="col-md-6">
                <div class="text-md-right">
                    <?php echo micro_time(); ?>
                </div>
                <!--<div class="text-md-right footer-links d-none d-sm-block">
                <a href="javascript:void(0);">About Us</a>
                <a href="javascript:void(0);">Help</a>
                <a href="javascript:void(0);">Contact Us</a>
</div>-->
            </div>
        </div>
    </div>
</footer>
<!-- End Footer -->

<!-- Right bar overlay-->
<div class="rightbar-overlay"></div>
<!-- App js -->
<script src="<?php echo $config['web']['base_url'] ?>assets/js/app.min.js"></script>

<script src="<?php echo $config['web']['base_url'] ?>assets/js/clipboard.js"></script>

<script src="<?php echo $config['web']['base_url'] ?>assets/libs/select2/js/select2.min.js"></script>

<!-- Plugins js-->
<script src="<?php echo $config['web']['base_url'] ?>assets/libs/flatpickr/flatpickr.min.js"></script>
<script src="<?php echo $config['web']['base_url'] ?>assets/libs/bootstrap-colorpicker/bootstrap-colorpicker.min.js"></script>
<script src="<?php echo $config['web']['base_url'] ?>assets/libs/clockpicker/bootstrap-clockpicker.min.js"></script>
<script src="<?php echo $config['web']['base_url'] ?>assets/libs/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>

<!-- Init js -->
<script src="<?php echo $config['web']['base_url'] ?>assets/js/pages/form-advanced.init.js"></script>
<!-- Init js-->
<script src="<?php echo $config['web']['base_url'] ?>assets/js/pages/form-pickers.init.js"></script>

<!-- Sweet Alerts js -->
<script src="<?php echo $config['web']['base_url'] ?>assets/libs/sweetalert2/sweetalert2.min.js"></script>

<!-- Sweet alert init js-->
<script src="<?php echo $config['web']['base_url'] ?>assets/js/pages/sweet-alerts.init.js"></script>

<!-- Magnific Popup-->
<script src="<?php echo $config['web']['base_url'] ?>assets/libs/magnific-popup/jquery.magnific-popup.min.js"></script>

<!-- Gallery Init-->
<script src="<?php echo $config['web']['base_url'] ?>assets/js/pages/gallery.init.js"></script>

<!-- Countdown js -->
<script src="assets/js/pages/coming-soon.init.js"></script>

<?php
  if (isset($_SESSION['result_msg'])) {
    if ($_SESSION['result_msg']['alert'] == "danger") {
?>
<script>
Swal.fire(
  '<?php echo $_SESSION['result_msg']['title'] ?>',
  '<?php echo $_SESSION['result_msg']['msg'] ?>',
  'error'
).then((result) => {
  if (result.isConfirmed) {
    <?php unset($_SESSION['result_msg']) ?>
  }
})
</script>
?>
<?php
    } else {
?>
<script>
Swal.fire(
  '<?php echo $_SESSION['result_msg']['title'] ?>',
  '<?php echo $_SESSION['result_msg']['msg'] ?>',
  'success'
).then((result) => {
  if (result.isConfirmed) {
    <?php unset($_SESSION['result_msg']); ?>
  }
})
</script>
<?php
      }
  }
?>

</body>

</html>