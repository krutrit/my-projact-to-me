<?php 
require_once("../../config/connectdb.php");
require_once("../../config/config.inc.php");
date_default_timezone_set("Asia/Bangkok");


if (isset($_POST['key']) && $_POST['key'] == 'form-addhai'){
    $value = $_POST['data'];

    $name_hai = $value['name_hai'];
    $tel_hai = $value['tel_hai'];
    $pass_hai = $value['pass_hai'];

    $sql_insert = "INSERT INTO `hairdresser` (`id_hai`, `name_hai`, `tel_hai`, `pass_hai`) 
                                    VALUES (NULL, '$name_hai', '$tel_hai', '$pass_hai');";


    if(Database::query($sql_insert)){
        echo "success";
    }else{
        echo "error";
    }
}


if(isset($_POST['key']) && $_POST['key'] == 'delete_hai'){

    $id = $_POST['id'];

    $sql_insert = "UPDATE `hairdresser` SET `status_hai` = '0' WHERE `hairdresser`.`id_hai` = '$id';";
    // echo $id;
    if(Database::query($sql_insert)){
        echo "success";
    }else{
        echo "error";
    }
}
// form-edit_ser
if(isset($_POST['key']) && $_POST['key'] == 'form-edit_hai'){

    $value = $_POST['data'];

    $id_hai = $value['id_hai'];
    $name_hai = $value['name_hai'];
    $tel_hai = $value['tel_hai'];
    $pass_hai = $value['pass_hai'];


    $sql_insert = "UPDATE `hairdresser` SET `name_hai` = '$name_hai', `tel_hai` = '$tel_hai', `pass_hai` = '$pass_hai' WHERE `hairdresser`.`id_hai` = '$id_hai';";

    // echo $id;
    if(Database::query($sql_insert)){
        echo "success";
    }else{
        echo "error";
    }
}
?>