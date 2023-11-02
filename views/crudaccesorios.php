<?php
session_start();
require '../config/conexion.php';
setlocale(LC_ALL, 'en_US');

if(isset($_POST['eliminar_accesorio']))
{
    $idaccesorios = mysqli_real_escape_string($conexion, $_POST['eliminar_accesorio']);

    $query = "DELETE FROM accesorios WHERE idaccesorios='$idaccesorios' ";
    $query_run = mysqli_query($conexion, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: accesorios.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Deleted";
        header("Location: accesorios.php");
        exit(0);
    }
}


if(isset($_POST['update_accesorios']))
{
    $idaccesorios = mysqli_real_escape_string($conexion, $_POST['idaccesorios']);

    $name = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);
    $tamanio = mysqli_real_escape_string($conexion, $_POST['tamanio']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $figura = mysqli_real_escape_string($conexion, $_POST['figura']);     
    $fechaSave = $_POST['fechaEntrada'];
    

    $query = "UPDATE accesorios SET nombre='$name', cantidad='$cantidad', tamanio='$tamanio', precio='$precio',figura= '$figura',fechaEntrada= '$fechaSave' WHERE idaccesorios='$idaccesorios' ";
    $query_run = mysqli_query($conexion, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Updated Successfully";
        header("Location: accesorios.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Updated";
        header("Location: accesorios.php");
        exit(0);
    }

}
    
if(isset($_POST['guardar_accesorio']))
{
    $name = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);
    $tamanio = mysqli_real_escape_string($conexion, $_POST['tamanio']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $figura = mysqli_real_escape_string($conexion, $_POST['figura']);     
    $fechaSave = $_POST['fechaEntrada'];
    
    $query = "INSERT INTO accesorios (cantidad,figura,nombre,precio,tamanio,fechaEntrada) VALUES ('$cantidad','$figura','$name','$precio','$tamanio','$fechaSave')";
  
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




