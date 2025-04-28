<?php

session_start();

if (!isset($_SESSION["usuario"])){
    header("Location: login_registro.php");
    exit();
}



?>