<?php
//require_once ('vendor/autoload.php'); // if you use Composer
require_once('ultramsg.class.php'); // if you download ultramsg.class.php

print_r('enviado mensaje');
$token="cgasvi7nhgko66ei"; // Ultramsg.com token
$instance_id="69750"; // Ultramsg.com instance id
$client = new UltraMsg\WhatsAppApi($token,$instance_id);
print_r('creado la instancia');
    
$to="5548591688"; 
$body="Hello world"; 
$api=$client->sendChatMessage($to,$body);
print_r($api);


require '../config/conexion.php';
$query = "select tipoVacuna as title, fechaProxima as start, fechaProxima as end, pa.nombrePaciente as paciente, po.nombre as propietario, po.telefono, idPacie from programavacunacion inner join paciente as pa on pa.idpaciente = idPacie inner join propietario po on po.idPaciente = idPacie";
$result = mysqli_query($conexion, $query) or die('Query failed: ' . mysql_error());

$events = array();
while ($row = mysqli_fetch_assoc($result)) {
    $row['title'] = 'Vacuna vs '.$row['title'];
    $row['propietario'] = 'Propietario '.$row['propietario'].'; télefono '.$row['telefono'];
    $row['paciente'] ='Paciente '.$row['paciente'];
    $row['backgroundColor'] = 'red';
    $row['url'] = 'http://localhost/inventario/views/editarPaciente.php?idpaciente='.$row['idPacie'];
    $events[] = $row;
}
echo json_encode($events);
?>