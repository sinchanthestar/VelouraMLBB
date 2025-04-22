<?php 
require 'app/mainconfig.php';


if (check_input($_POST, array('host')) == false) {
	$result = array('status' => false, 'data' => array('msg' => 'Permintaan tidak sesuai'));
} else {
    $cek1 = $model->db_query($db, "*", "domainList", "domain='".$_POST['host']."'");
	if($cek1['count'] != 0){
	    if($cek1['rows']['status'] == 0){
	        $result = array("status" => true, "data" => array("owner" => $cek['rows']['owner']), "msg" => "Success");
	    }else{
	        $result = array("status" => false, "data" => array("owner" => $cek['rows']['owner']), "msg" => "Your Domain Is Disable");
	    }
	}else{
	    $result = array("status" => false, "data" => array("owner" => "unknow"), "msg" => "Domain Not Register");
	}
}
print(json_encode($result, JSON_PRETTY_PRINT));


?>