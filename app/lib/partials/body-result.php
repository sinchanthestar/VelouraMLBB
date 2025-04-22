<?php
if (isset($_SESSION['result'])) {
?>
<div class="alert alert-<?php echo $_SESSION['result']['alert'] ?> alert-dismissible fade show" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
    <b><?php echo $_SESSION['result']['title'] ?></b> <?php echo $_SESSION['result']['msg'] ?>
</div>
<?php
unset($_SESSION['result']);
}
?>
