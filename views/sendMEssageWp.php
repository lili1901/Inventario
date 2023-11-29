<?php
    //require_once ('vendor/autoload.php'); // if you use Composer
    require_once('ultramsg.class.php'); // if you download ultramsg.class.php

    // Get the data from the AJAX request
    $data = json_decode(file_get_contents("php://input"));

    // Do something with the data (e.g., execute PHP code based on the event ID)
    $eventId = $data->eventId;
    $date = $data->date;
    $paciente = $data->paciente;
    $vacuna = $data->vacuna;

    $token="yobai5z03gmwht80"; // Ultramsg.com token
    $instance_id="instance70015"; // Ultramsg.com instance id
    $client = new UltraMsg\WhatsAppApi($token,$instance_id);
        
    $to=$eventId; 
    $body="Tienes una proxima vacuna para ".$paciente." el ".$date." de ".$vacuna; 
    $api=$client->sendChatMessage($to,$body);
    print_r($api);
    echo json_encode(['message' => 'Success']);
?>