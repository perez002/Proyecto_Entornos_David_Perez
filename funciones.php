<?php

include("datos.php");

function conectarBD($host,$usuario,$password,$bd,$puerto){

    $conexionBD = mysqli_connect($host,$usuario,$password,$bd,$puerto);

    if ($conexionBD){
        return $conexionBD;
    }else{
        echo "Error al conectar con la base de datos";
        return false;
    }
}

function validarUsuario($conexion,$usuario,$password){

    $consultarUsuario="SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$password'";
    $datosUsuario=mysqli_query($conexion,$consultarUsuario);

    if(mysqli_num_rows($datosUsuario)>0){
        $usuarioEncontrado=mysqli_fetch_assoc($datosUsuario);
    
        if ($password === $usuarioEncontrado['password']){
            echo "Logueado con éxito.";
        }
        }else{
        echo "Usuario o contraseña incorrecto.";
        }

}

function crearUsuario($conexion,$usuario,$password){
    $nuevoUsuario="INSERT INTO usuarios (usuario,password) VALUES ('$usuario', '$password')";
    $resultado=mysqli_query($conexion,$nuevoUsuario);

    if ($resultado){
        echo "Usuario creado con éxito.";

    }else{
        echo "Error al crear el usuario.";
    }
}





?>