<?php

$host = "localhost";
$user = "root";
$pass = "123456789";
$db = "veteri";

$conexion = new mysqli($host, $user, $pass,$db);

if (!$conexion) {
    echo 'CONEXION FALLIDA';
}
?>
