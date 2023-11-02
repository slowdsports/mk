<?php
// Reproductor
if (isset($_GET['c'])) {
    include('play.php');
    //echo "Debe ir al reproductor";
} else {
    $solicitaJson = 'iptv';
    include('inc/componentes/iptv.php');
} ?>