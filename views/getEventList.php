<?php
require '../config/conexion.php';
$query = "select tipoVacuna as title, fechaProxima as start, fechaProxima as end, pa.nombrePaciente as paciente, po.nombre as propietario, po.telefono from programavacunacion inner join paciente as pa on pa.idpaciente = idPacie inner join propietario po on po.idPaciente = idPacie";
$result = mysqli_query($conexion, $query) or die('Query failed: ' . mysql_error());

$events = array();
while ($row = mysqli_fetch_assoc($result)) {
    $row['title'] = 'Vacuna vs '.$row['title'];
    $row['propietario'] = 'Propietario '.$row['propietario'].'; télefono '.$row['telefono'];
    $row['paciente'] ='Paciente '.$row['paciente'];
    $row['backgroundColor'] = 'red';
    $events[] = $row;
}
echo json_encode($events);
?>