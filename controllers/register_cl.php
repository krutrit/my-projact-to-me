<?php 


require_once("../config/config.inc.php");
require_once("../config/connectdb.php");


if(isset($_POST['key']) && $_POST['key'] == 'form-signup'){
    $value = $_POST['data'];

    $name_user = $value['name_user'];
    $lastname_user = $value['lastname_user'];
    $tel_user = $value['tel_user'];
    $pass_user = $value['pass_user'];
    $e_mail = $value['e_mail'];

    $sql_search = "SELECT * FROM `user` WHERE  tel_user = '$tel_user' ";

    $row =  Database::query($sql_search,PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);

    if($row == null) {
        $sql_insert = "INSERT INTO `user` (`id_user`, `name_user`, `lastname_user`, `tel_user`, `pass_user`, `e_mail`) VALUES 
                                        (NULL, '$name_user', '$lastname_user', '$tel_user', '$pass_user', '$e_mail');";

    if(Database::query($sql_insert)){
        echo "success";
    }else{
        echo "error";
    }
    }else{
        echo "x541";
    }



    

}

?>