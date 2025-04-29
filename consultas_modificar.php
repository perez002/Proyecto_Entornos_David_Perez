<?php

session_start();

include("datos.php");
include("funciones.php");

if (!isset($_SESSION["usuario"])) {
    header("Location: login_registro.php");
    exit();
}


$conexion = conectarBD($host, $usuario, $password, $bd, $puerto);


?>