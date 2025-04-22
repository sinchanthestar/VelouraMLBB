<?php
require '../../mainconfig.php';
require '../../lib/check_session.php';
if($_GET){
    if($model->db_update($db, "token", array('serial' => 0, 'slot' => $_GET['limit']), "id = '".$_GET['id']."'") == true){
        $_SESSION['result_msg'] = array('alert' => 'info', 'title' => 'BERHASIL!', 'msg' => 'Token '.$_GET['access_key'].' Telah Direset', 'show' => true);
    }else{
        $_SESSION['result_msg'] = array('alert' => 'danger', 'title' => 'GAGAL!', 'msg' => "Coba Lagi!", 'show' => true);
    }
}
?>
<form name="form" action='' method="POST">
    <div class="form-group">
        DATA TOKEN TELAH DI RESET
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-info">OK</button>
        </div>
    </div>
</form>