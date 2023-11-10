<?php
session_start();
require '../config/conexion.php';
setlocale(LC_ALL, 'en_US');


     
if(isset($_POST['guardar_paciente']))
{
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $raza = mysqli_real_escape_string($conexion, $_POST['raza']);
    $color = mysqli_real_escape_string($conexion, $_POST['color']);
    $especie = mysqli_real_escape_string($conexion, $_POST['especie']);
    $sexo = mysqli_real_escape_string($conexion, $_POST['sexo']);
    $fechaNacimiento = $_POST['fechaNacimiento'];     
    
    
    $query = "INSERT INTO paciente (nombre,raza,color,especie,sexo,fechaNacimiento)
    VALUES ('$nombre','$raza','$color','$especie','$sexo','$fechaNacimiento')";
  
    $query_run = mysqli_query($conexion, $query);
    if($query_run)
    {
        $lastid = mysqli_insert_id($conexion); 

        echo "Ultimo ID : ".$lastid; 

        $nombrePropietario = mysqli_real_escape_string($conexion, $_POST['nombreP']);
        $apellidos = mysqli_real_escape_string($conexion, $_POST['apellidos']);
        $direccion = mysqli_real_escape_string($conexion, $_POST['direccion']);
        $telefono = mysqli_real_escape_string($conexion, $_POST['telefono']);
        $email = mysqli_real_escape_string($conexion, $_POST['email']);

        $query2 = "INSERT INTO propietario (nombre,apellidos,direccion,telefono,email,idpaciente)
        VALUES ('$nombrePropietario','$apellidos','$direccion','$telefono','$email','$lastid')";

        $query_run = mysqli_query($conexion, $query2);

        for($i = 0; $i < count($_POST["tipoVacuna"]); $i++)
        {
            $tipoVacu = mysqli_real_escape_string($conexion, $_POST['tipoVacuna'][$i]);            
            $fechaVacu = $_POST['fechaProxima'][$i];  
    
            $query3 = "INSERT INTO programavacunacion (tipoVacuna,fechaProxima,idPacie)
            VALUES ('$tipoVacu','$fechaVacu','$lastid')";
    
            $query_run = mysqli_query($conexion, $query3); 
        }

            if($query_run)
            {
                $_SESSION['message'] = "Student Created Successfully";
                header("Location: paciente.php");
                exit(0);
            }        
            }
            else
            { 
        $_SESSION['message'] = "Student Not Created";
        header("Location: paciente.php");
        exit(0);
    }
}

?>