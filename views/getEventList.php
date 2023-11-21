<?php
require '../config/conexion.php';
$query = "select tipoVacuna as title, fechaProxima as start, fechaProxima as end from programavacunacion";
$result = mysqli_query($conexion, $query) or die('Query failed: ' . mysql_error());

$events = array();
while ($row = mysqli_fetch_assoc($result)) {
    $events[] = $row;
}
echo json_encode($events);
?>