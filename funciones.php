<?php

include("datos.php");

function conectarBD($host,$usuario,$password,$bd,$puerto){

    $conexionBD = mysqli_connect($host,$usuario,$password,$bd,$puerto);

    if ($conexionBD){
        return $conexionBD;
    }else{
        return false;
    }
}

function validarUsuario($conexion,$usuario,$password){

    $consultarUsuario="SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$password'";
    $datosUsuario=mysqli_query($conexion,$consultarUsuario);

    if(mysqli_num_rows($datosUsuario)>0){
        $usuarioEncontrado=mysqli_fetch_assoc($datosUsuario);
    
        if ($password === $usuarioEncontrado['password']){
            return true;
        }
        }else{
            return false;
        }

}

function crearUsuario($conexion, $usuario, $password){
    $consultarUsuario = "SELECT * FROM usuarios WHERE usuario='$usuario'";
    $resultadoConsulta = mysqli_query($conexion, $consultarUsuario);
    
    if(mysqli_num_rows($resultadoConsulta) > 0){
        return false; 
    }

    $nuevoUsuario = "INSERT INTO usuarios (usuario, password) VALUES ('$usuario', '$password')";
    $resultado = mysqli_query($conexion, $nuevoUsuario);

    if ($resultado) {
        return true;
    } else {
        return false; 
    }
}





?>