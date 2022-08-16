<?php 
require_once("../../config/connectdb.php");
require_once("../../config/config.inc.php");
date_default_timezone_set("Asia/Bangkok");





if(isset($_POST['key']) && $_POST['key'] == 'delete_user'){

    $id = $_POST['id'];

    $sql_insert = "UPDATE `user` SET `status_user` = '0' WHERE `user`.`id_user` = '$id';";
    // echo $id;
    if(Database::query($sql_insert)){
        echo "success";
    }else{
        echo "error";
    }
}
// form-edit_ser
if(isset($_POST['key']) && $_POST['key'] == 'form-edit_user'){

    $value = $_POST['data'];

    $id_user = $value['id_user'];
    $name_user = $value['name_user'];
    $lastname_user = $value['lastname_user'];
    $tel_user = $value['tel_user'];
    $pass_user = $value['pass_user'];
    $e_mail = $value['e_mail'];


    $sql_insert = "UPDATE `user` SET `name_user` = '$name_user', `lastname_user` = '$lastname_user', `tel_user` = '$tel_user', `pass_user` = '$pass_user', `e_mail` = '$e_mail' WHERE `user`.`id_user` = '$id_user';";

    // echo $id;
    if(Database::query($sql_insert)){
        echo "success";
    }else{
        echo "error";
    }
}
?>