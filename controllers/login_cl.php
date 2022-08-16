<?php

require_once("../config/config.inc.php");
require_once("../config/connectdb.php");
session_start();

if (isset($_POST['key']) && $_POST['key'] == 'form-login') {
    $value = $_POST['data'];

    $tel_user = $value['tel_user'];
    $pass_user = $value['pass_user'];

    // echo $tel_user.$pass_user;

    $sql_search_user = "SELECT * FROM `user` WHERE  tel_user = '$tel_user' AND pass_user = '$pass_user' AND status_user != 0 ";
    $row_user = Database::query($sql_search_user, PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);

    // print_r($row_user);
    if ($row_user != null) {
        if ($tel_user == $row_user->tel_user && $pass_user == $row_user->pass_user) {
            $_SESSION['name'] = $row_user->name_user . "  " . $row_user->lastname_user;
            $_SESSION['key'] = 'user';
            $_SESSION['id'] = $row_user->id_user;
            echo "login-user";
        } else {
        }
    } else {
        $sql_search_hai  = "SELECT * FROM `hairdresser` WHERE tel_hai = '$tel_user' AND pass_hai = '$pass_user' AND status_hai != 0";
        $row_hai  = Database::query($sql_search_hai, PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);
        // echo "กรอกข้อมูลหรือรหัสผ่านไม่ถูกต้อง";

        if ($row_hai != null) {
            if ($tel_user == $row_hai->tel_hai && $pass_user == $row_hai->pass_hai) {
                $_SESSION['name'] = $row_hai->name_hai;
                $_SESSION['key'] = 'hai';
                $_SESSION['id'] = $row_hai->id_hai;
                echo "login-hai";
            } else {

            }
        } else {
            $sql_search_admin  = "SELECT * FROM `admin` WHERE tel_ad = '$tel_user' AND pass_ad = '$pass_user'";
            $row_admin  = Database::query($sql_search_admin, PDO::FETCH_OBJ)->fetch(PDO::FETCH_OBJ);
            // echo "กรอกข้อมูลหรือรหัสผ่านไม่ถูกต้อง";

            if ($row_admin != null) {
                if ($tel_user == $row_admin->tel_ad && $pass_user == $row_admin->pass_ad) {
                    $_SESSION['name'] = $row_admin->name_ad;
                    $_SESSION['key'] = 'admin';
                    $_SESSION['id'] = $row_admin->id_ad;
                    echo "login-admin";
                } else {

                }
            } else {
                echo "กรอกข้อมูลหรือรหัสผ่านไม่ถูกต้อง";
            }
        }
    }
}
