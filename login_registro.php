<?php

include("datos.php");
include("funciones.php");

session_start();

$conexion=conectarBD($host,$usuario,$password,$bd,$puerto);

if ($conexion){
    echo "Conexión exitosa.";
}else{
    echo "Error de conexión.";
}

if($_POST){
    $usuario=$_POST["usuario"];
    $password=$_POST["password"];
}

if (validarUsuario($conexion, $usuario, $password)) {
    $_SESSION["usuario"]=$usuario;
    echo "Logueado como: $usuario.";
} else {
    if (crearUsuario($conexion, $usuario, $password)) {
        echo "Usuario $usuario creado con éxito.";
    } else {
        echo "Error al loguear o crear usuario.";
    }
}


?>



<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login y Registro</title>
    <link rel="stylesheet" href="./estilos.css">
</head>
<body>
    <h1>Formulario de Login y Registro</h1>

    <form method="POST" action="">
        <label for="usuario">Usuario:</label>
        <input type="text" name="usuario" id="usuario" required>

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit">Entrar o registrarse</button>
    </form>
</body>
</html>
