<?php

if (isset($result_msg)) {
?>
<div class="alert alert-<?php echo $result_msg['alert'] ?> alert-dismissible" role="alert">
	<b><?php echo $result_msg['title'] ?></b> <?php echo $result_msg['msg'] ?>
</div>
                    <?php
                    if ($result_msg['alert'] == "danger") {
                    ?>
                    <script>
                      Swal.fire({
                        icon: 'error',
                        title: '<?php echo $result_msg['title'] ?>',
                        text: '<?php echo $result_msg['msg'] ?>',
                        footer: '<a href="">Why do I have this issue?</a>'
                      });
                    </script>
                    <?php
                    } else {
                    ?>
                    <script>
                        Swal.fire({
                            type: "success",
                            title: "<?php echo $result_msg['title'] ?>",
                            html: "<?php echo $result_msg['msg'] ?>",
                            confirmButtonClass: "btn btn-confirm mt-2"
                        });
                    </script>
                    <?php
                    }
                    ?>
<?php
}