<?php

//empezamos todas las paginas iniciando la sesion del usuario para que permanezca en todas las paginas e incluimos las paginas de datos y funciones
//para su correcto funcionamiento

session_start();

include("datos.php");
include("funciones.php");

//aqui hacemos que si se pincha en el enlace "cerrar sesion", se borre la sesion actual y la cookie que php crea por defecto con las sesiones
//devolviendote a la pagina de login
if (isset($_GET['accion']) && $_GET['accion'] == 'salir') {
    session_unset();
    session_destroy();
    setcookie(session_name(), '', time() - 3600, '/');
    header("Location: login_registro.php");
    exit();
}

//comprobamos que la sesion del usuario siga activa, en caso contrario nos devuelve al login
if (!isset($_SESSION["usuario"])){
    header("Location: login_registro.php");
    exit();
}

?>
<!-- Aqui tenemos el html de la pagina principal, con el menu de navegación que estara en el resto de paginas y una pequeña descripcion de la web,
  ha quedado un poco seco pero no sabia que mas añadir aqui -->
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