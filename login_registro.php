<?php

session_start();

include("datos.php");
include("funciones.php");


$conexion=conectarBD($host,$usuario,$password,$bd,$puerto);

if (!$conexion) {
    echo "Error al conectar a la base de datos";
    exit();
}

if ($_POST) {
    $usuario = $_POST["usuario"];
    $password = $_POST["password"];

    if (validarUsuario($conexion, $usuario, $password)) {
        $_SESSION["usuario"] = $usuario;
        header("Location: pagina.php");
        exit();
    } else {
        if (crearUsuario($conexion, $usuario, $password)) {
            $_SESSION["usuario"] = $usuario; 
            header("Location: pagina.php");
            exit();
        } else {
            echo "El nombre de usuario ya existe.";
        }
    }
} else {
    echo "Error al conectar la BBDD.";
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

