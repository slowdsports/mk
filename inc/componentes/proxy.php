<?php
// URL del servidor remoto que contiene el JSON de los canales
if ($_GET['p'] == 'iptv') {
    $remoteUrl = "https://www.tdtchannels.com/lists/tv.json";
} else {
    $remoteUrl = "https://www.tdtchannels.com/lists/radio.json";
}

// Hacer la solicitud al servidor remoto
$response = file_get_contents($remoteUrl);

// Establecer las cabeceras para permitir solicitudes desde cualquier origen
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Devolver los datos al cliente
echo $response;
