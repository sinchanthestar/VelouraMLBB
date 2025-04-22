<?php 
require 'app/mainconfig.php';


if (check_input($_POST, array('ACTION','IP','HWID')) == false) {
	$result = array('status' => false, 'data' => array('msg' => 'Permintaan tidak sesuai'));
} else {
    $cek = $model->db_query($db, "*", "protect", "device='".$_POST['HWID']."'");
    $count = $cek['count'];
    if($_POST['ACTION'] == 'verif'){
        if($count < 1){
            if($model->db_insert($db, "protect", array('ip' => $_POST['IP'], 'device' => $_POST['HWID'], 'status' => 1)) == true){
                $result = array("status" => false, "data" => array("owner" => $_POST['HWID']), "msg" => "success");
            }else{
                $result = array("status" => false, "data" => array("owner" => "unknow"), "msg" => "Not Register");
            }
        }else{
            if($cek['rows']['status'] == 0){
                $result = array("status" => false, "data" => array("owner" => "unknow"), "msg" => "Banned Device!!");
            }else{
                $result = array("status" => false, "data" => array("owner" => $_POST['HWID']), "msg" => "success");
            }
        }
    }else{
        if($_POST['ACTION'] == 'banned'){
            if($count < 1){
                if($model->db_insert($db, "protect", array('ip' => $_POST['IP'], 'device' => $_POST['HWID'], 'status' => 0)) == true){
                    $result = array("status" => false, "data" => array("owner" => $_POST['HWID']), "msg" => "Banned!!");
                }else{
                    $result = array("status" => false, "data" => array("owner" => "unknow"), "msg" => "Not Register");
                }
            }else{
                if($model->db_update($db, "protect", array('status' => 0) , "device = '".$_POST['HWID']."'") == true){
                    $result = array("status" => false, "data" => array("owner" => $_POST['HWID']), "msg" => "Banned!!");
                }else{
                    $result = array("status" => false, "data" => array("owner" => "unknow"), "msg" => "Not Register");
                }
            }
        }else{
            $result = array("status" => false, "data" => array("owner" => "unknow"), "msg" => "Service Not Register");
        }
    }
	
}
print(json_encode($result, JSON_PRETTY_PRINT));


?>