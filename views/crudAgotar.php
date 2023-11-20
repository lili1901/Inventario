<?php
session_start();
require '../config/conexion.php';
setlocale(LC_ALL, 'en_US');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $lote = $_POST["lote"];
    $cantidad_a_descontar = $_POST["cantidad_a_descontar"];

    // Conexión a la base de datos
    //$conn = new mysqli("localhost", "root", "123456789", "veteri");

    if ($conn->connect_error) {
        die("Error de conexión a la base de datos: " . $conn->connect_error);
    }

    // Consulta SQL para obtener la cantidad disponible del lote
    $sql = "SELECT cantidad FROM alimento WHERE lote = '$lote'";
    //$result = $conn->query($sql);
    $query_run = mysqli_query($conn, $sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $cantidad_disponible = $row['cantidad'];
        
        if ($cantidad_disponible >= $cantidad_a_descontar) {
            // Realizar el descuento
            $nueva_cantidad = $cantidad_disponible - $cantidad_a_descontar;
            
            // Actualizar la cantidad en la base de datos
            $update_sql = "UPDATE alimento SET cantidad = $nueva_cantidad WHERE lote = '$lote'";    
            
            if ($conn->query($update_sql) === TRUE) {  
                echo "
                Descuento exitoso. Cantidad restante: $nueva_cantidad "  ;
            } else {
                echo "Error al actualizar la cantidad: " . $conn->error;
            }
        } else {
            echo "No hay suficiente cantidad disponible para descontar.";
        }
    } else {
        echo "El lote no existe en la base de datos.";
    }
    }
    // Cierra la conexión a la base de datos
    ?>
