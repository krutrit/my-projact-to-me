<?php
require_once("../../config/connectdb.php");
require_once("../../config/config.inc.php");
date_default_timezone_set("Asia/Bangkok");


if (isset($_POST['key']) && $_POST['key'] == 'delete_reserve'){

    $id = $_POST['id'];


    $sql_dete = "UPDATE `reserve` SET `status` = '0' WHERE `reserve`.`id_reserve` = '$id'";

    if(Database::query($sql_dete)){
        echo "success";
    }else{
        echo "error";
    }
}

if (isset($_POST['key']) && $_POST['key'] == 'success_reserve'){

    $id = $_POST['id'];


    $sql_dete = "UPDATE `reserve` SET `status` = '1' WHERE `reserve`.`id_reserve` = '$id'";

    if(Database::query($sql_dete)){
        echo "success";
    }else{
        echo "error";
    }
}
