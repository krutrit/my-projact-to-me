<?php 
session_start();

unlink($_SESSION['key']);
session_destroy();


header("Location: ../index");

?>