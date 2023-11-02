<?php
session_start();
require '../config/conexion.php';
setlocale(LC_ALL, 'en_US');

if(isset($_POST['eliminar_medicamento']))
{
    $id_medicamento = mysqli_real_escape_string($conexion, $_POST['eliminar_medicamento']);

    $query = "DELETE FROM medicamento WHERE idmedicamento='$id_medicamento' ";
    $query_run = mysqli_query($conexion, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Deleted Successfully";
        header("Location: medicamentos.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Deleted";
        header("Location: medicamentos.php");
        exit(0);
    }
}

if(isset($_POST['update_medicamento']))
{
    $id_medicamento = mysqli_real_escape_string($conexion, $_POST['idmedicamento']);

    $name = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);
    $lote = mysqli_real_escape_string($conexion, $_POST['lote']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $viaAdmon = mysqli_real_escape_string($conexion, $_POST['viaadmon']);
    $fechaCaducidad = $_POST['fechaCaducidad'];     
    $fechaEntrada = $_POST['fechaEntrada'];
    
    

    $query = "UPDATE medicamento SET 
    nombre='$name', cantidad='$cantidad', lote='$lote', precio='$precio',viaadmon= '$viaAdmon',fechaCaducidad= '$fechaCaducidad',fechaEntrada= '$fechaEntrada'  
    WHERE idmedicamento='$id_medicamento' ";
    $query_run = mysqli_query($conexion, $query);

    if($query_run)
    {
        $_SESSION['message'] = "Student Updated Successfully";
        header("Location: medicamentos.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Updated";
        header("Location: medicamentos.php");
        exit(0);
    }

}

    
if(isset($_POST['guardar_medicamento']))
{
    $name = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $cantidad = mysqli_real_escape_string($conexion, $_POST['cantidad']);
    $lote = mysqli_real_escape_string($conexion, $_POST['lote']);
    $precio = mysqli_real_escape_string($conexion, $_POST['precio']);
    $viaAdmon = mysqli_real_escape_string($conexion, $_POST['viaadmon']);
    $fechaCaducidad = $_POST['fechaCaducidad'];     
    $fechaEntrada = $_POST['fechaEntrada'];
    
    $query = "INSERT INTO medicamento (lote,nombre,viaadmon,precio,cantidad,fechaCaducidad,fechaEntrada)
                             VALUES ('$lote','$name','$viaAdmon','$precio','$cantidad','$fechaCaducidad','$fechaEntrada')";

    $query_run = mysqli_query($conexion, $query);
    if($query_run)
    {
        $_SESSION['message'] = "Student Created Successfully";
        header("Location: medicamentos.php");
        exit(0);
    }
    else
    {
        $_SESSION['message'] = "Student Not Created";
        header("Location: medicamentos.php");
        exit(0);
    }
}
?>
