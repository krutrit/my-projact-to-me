<?php 
require_once("../../config/connectdb.php");
require_once("../../config/config.inc.php");
date_default_timezone_set("Asia/Bangkok");



if(isset($_POST['key']) && $_POST['key'] == 'form-addServices'){

    $value = $_POST['data'];

    $name_style = $value['name_style'];
    $price_style = $value['price_style'];
    $time_ok = $value['time_ok'];

    $sql_insert = "INSERT INTO `hairstyle` (`id_style`, `name_style`, `price_style`, `time_ok`, `status`) VALUES 
    (NULL, '$name_style', '$price_style', '$time_ok', '1');";
    // print_r($value);

    if(Database::query($sql_insert)){
        echo "success";
    }else{
        echo "error";
    }
}

if(isset($_POST['key']) && $_POST['key'] == 'delete_services'){

    $id = $_POST['id'];

    $sql_insert = "UPDATE `hairstyle` SET `status` = '0' WHERE `hairstyle`.`id_style` = '$id';";

    // echo $id;
    if(Database::query($sql_insert)){
        echo "success";
    }else{
        echo "error";
    }
}
// form-edit_ser
if(isset($_POST['key']) && $_POST['key'] == 'form-edit_ser'){

    $value = $_POST['data'];

    $id_style = $value['id_style'];
    $name_style = $value['name_style'];
    $price_style = $value['price_style'];
    $time_ok = $value['time_ok'];


    $sql_insert = "UPDATE `hairstyle` SET `name_style` = '$name_style', `price_style` = '$price_style', `time_ok` = '$time_ok' WHERE `hairstyle`.`id_style` = '$id_style';";

    // echo $id;
    if(Database::query($sql_insert)){
        echo "success";
    }else{
        echo "error";
    }
}
?>