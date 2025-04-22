<?php
require '../../mainconfig.php';
require '../../lib/check_session.php';

if ($_GET) {
    if($model->db_delete($db, "token", "id = '".$_GET['id']."'") == true){
?>
<div id="modal-result" class="row"></div>
<form class="form-horizontal" method="POST" id="form">
	DATA SUDAH DI HAPUS </br>
	REFRESH PAGE UNTUK MELIHAT HASIL
</form>
<?php
    }else{
?>
<div id="modal-result" class="row"></div>
<form class="form-horizontal" method="POST" id="form">
	DATA GAGAL DI HAPUS </br>
	REFRESH PAGE UNTUK MELIHAT HASIL
</form>
<?php
    }
    
} 

?>