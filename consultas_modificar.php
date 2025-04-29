<?php

//empezamos todas las paginas iniciando la sesion del usuario para que permanezca en todas las paginas e incluimos las paginas de datos y funciones
//para su correcto funcionamiento

session_start();

include("datos.php");
include("funciones.php");

$conexion = conectarBD($host, $usuario, $password, $bd, $puerto);

// Consultar usuarios si pinchamos el boton de consultar usuarios
if (isset($_POST['consulta_usuarios'])) {
    $consultaUsuarios = "SELECT id, usuario FROM usuarios";
    $result = mysqli_query($conexion, $consultaUsuarios);
    $usuarios = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Consultar productos si pinchamos el boton de consultar productos
if (isset($_POST['consulta_productos'])) {
    $consultaProductos = "SELECT id, nombre, precio FROM productos";
    $result = mysqli_query($conexion, $consultaProductos);
    $productos = mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Añadir producto con los datos indicados al pinchar el boton añadir
if (isset($_POST['añadir_producto'])) {
    $nombre = $_POST['nombre_producto'];
    $precio = $_POST['precio_producto'];
    $insertar = "INSERT INTO productos (nombre, precio) VALUES ('$nombre', $precio)";
    mysqli_query($conexion, $insertar);
}

// Modificar producto introduciendo el id, nombre y precio que queramos
if (isset($_POST['modificar_producto'])) {
    $id = $_POST['id_modificar'];
    $nuevo_nombre = $_POST['nuevo_nombre'];
    $nuevo_precio = $_POST['nuevo_precio'];
    $actualizar = "UPDATE productos SET nombre='$nuevo_nombre', precio=$nuevo_precio WHERE id=$id";
    mysqli_query($conexion, $actualizar);
}

// Borrar producto intriduciendo unicamente su id
if (isset($_POST['borrar_producto'])) {
    $id_borrar = $_POST['id_borrar'];
    $borrar = "DELETE FROM productos WHERE id=$id_borrar";
    mysqli_query($conexion, $borrar);
}

?>
<!-- Aqui tenemos el html con el menu como en el resto y los formularios para rellenar segun escojamos una opcion u otra,
     o ver los usuarios/productos si se pincha el boton de cada uno, mostrandlos en tablas-->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultas y Modificaciones</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="menu">
    <a href="pagina.php">Inicio</a>
    <a href="consultas_modificar.php">Consultar o modificar la base de datos</a>
    <a href="pagina.php?accion=salir" style="float:right">Cerrar sesión</a>
</div>
    <h1>Gestión de Usuarios y Productos</h1>

    <form method="POST">
        <button type="submit" name="consulta_usuarios">Consultar Usuarios</button>
        <button type="submit" name="consulta_productos">Consultar Productos</button>
    </form>

    <h2 class="alinear-izquierda">Añadir Producto</h2>
    <form method="POST">
        <input type="text" name="nombre_producto" placeholder="Nombre" required>
        <input type="number" name="precio_producto" placeholder="Precio" required>
        <button type="submit" name="añadir_producto">Añadir</button>
    </form>

    <h2 class="alinear-izquierda">Modificar Producto</h2>
    <form method="POST">
        <input type="number" name="id_modificar" placeholder="ID del producto" required>
        <input type="text" name="nuevo_nombre" placeholder="Nuevo nombre" required>
        <input type="number" name="nuevo_precio" placeholder="Nuevo precio" required>
        <button type="submit" name="modificar_producto">Modificar</button>
    </form>

    <h2 class="alinear-izquierda">Borrar Producto</h2>
    <form method="POST">
        <input type="number" name="id_borrar" placeholder="ID del producto" required>
        <button type="submit" name="borrar_producto">Borrar</button>
    </form>

    <div>
        <?php
        if (isset($usuarios)) {
            echo "<h2>Usuarios Consultados</h2>";
            echo "<table border='1'><tr><th>ID</th><th>Usuario</th></tr>";
            foreach ($usuarios as $u) {
                echo "<tr><td>{$u['id']}</td><td>{$u['usuario']}</td></tr>";
            }
            echo "</table>";
        }

        if (isset($productos)) {
            echo "<h2>Productos Consultados</h2>";
            echo "<table border='1'><tr><th>ID</th><th>Nombre</th><th>Precio</th></tr>";
            foreach ($productos as $p) {
                echo "<tr><td>{$p['id']}</td><td>{$p['nombre']}</td><td>{$p['precio']}</td></tr>";
            }
            echo "</table>";
        }
        ?>
    </div>
</body>
</html>
