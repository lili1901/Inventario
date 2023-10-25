<?php
session_start();
require '../config/conexion.php';
setlocale(LC_ALL, 'en_US');
    
if(isset($_POST['guardar_accesorio']))
{
    $name = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);
    $tamanio = mysqli_real_escape_string($conexion, $_POST['tamanio']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $figura = mysqli_real_escape_string($conexion, $_POST['figura']);     
    $fechaSave = $_POST['fechaEntrada'];
    
    $query = "INSERT INTO accesorios (cantidad,figura,nombre,precio,tamanio,fechaEntrada) VALUES ('$cantidad','$figura','$name','$precio','$tamanio','$fechaSave')";
    echo " hola";
    $query_run = mysqli_query($conexion, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: accesorios.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Created";
        header("Location: accesorios.php");
        exit(0);
    }
}
?>


