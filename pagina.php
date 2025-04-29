<?php

session_start();

include("datos.php");
include("funciones.php");


if (isset($_GET['accion']) && $_GET['accion'] == 'salir') {
    session_unset();
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/');
    header("Location: login_registro.php");
    exit();
}

if (!isset($_SESSION["usuario"])){
    header("Location: login_registro.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pagina principal</title>
    <link rel="stylesheet" href="./estilos.css">
</head>
<body>
<div class="menu">
    <a href="pagina.php">Inicio</a>
    <a href="consultas_modificar.php">Consultar o modificar la base de datos</a>
    <a href="pagina.php?accion=salir" style="float:right">Cerrar sesión</a>
</div>
<div class="intro">Bienvenido a la web de gestión de la base de datos de SOUNDER, aqui podrás consultar los datos de los usuarios, de los productos y añadir o modificar los productos de la tienda.</div>

</body>
</html>