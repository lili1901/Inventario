<?php
session_start();
require '../config/conexion.php';
setlocale(LC_ALL, 'en_US');

if(isset($_POST['eliminar_alimento']))
{
    $id_alimento = mysqli_real_escape_string($conexion, $_POST['eliminar_alimento']);

    $query = "DELETE FROM alimento WHERE idalimento='$id_alimento' ";
    $query_run = mysqli_query($conexion, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: alimento.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Deleted";
        header("Location: alimento.php");
        exit(0);
    }
}


if(isset($_POST['update_alimento']))
{
    $id_alimento = mysqli_real_escape_string($conexion, $_POST['idalimento']);

    $lote = mysqli_real_escape_string($conexion, $_POST['lote']);
    $name = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $especie = mysqli_real_escape_string($conexion, $_POST['especie']);
    $edad = mysqli_real_escape_string($conexion, $_POST['edad']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);
    $fechaCaducidad = $_POST['fechaCaducidad'];     
    $fechaEntrada = $_POST['fechaEntrada'];
    

    $query = "UPDATE alimento SET
     nombre='$name', cantidad='$cantidad', lote='$lote', precio='$precio',edad= '$edad',especie= '$especie',fechaCaducidad= '$fechaCaducidad',fechaEntrada= '$fechaEntrada'
      WHERE idalimento='$id_alimento' ";
    $query_run = mysqli_query($conexion, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Updated Successfully";
        header("Location: alimento.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Updated";
        header("Location: alimento.php");
        exit(0);
    }

}

     
if(isset($_POST['guardar_alimento']))
{
    $lote = mysqli_real_escape_string($conexion, $_POST['lote']);
    $name = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $especie = mysqli_real_escape_string($conexion, $_POST['especie']);
    $edad = mysqli_real_escape_string($conexion, $_POST['edad']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);
    $fechaCaducidad = $_POST['fechaCaducidad'];     
    $fechaEntrada = $_POST['fechaEntrada'];
    
    $query = "INSERT INTO alimento (lote,nombre,especie,edad,precio,cantidad,fechaCaducidad,fechaEntrada)
     VALUES ('$lote','$name','$especie','$edad','$precio','$cantidad','$fechaCaducidad','$fechaEntrada')";
  
    $query_run = mysqli_query($conexion, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: alimento.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Created";
        header("Location: alimento.php");
        exit(0);
    }
}
?>
