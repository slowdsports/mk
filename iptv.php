<?php
// Reproductor
if (isset($_GET['c'])) {
    include('play.php');
    //echo "Debe ir al reproductor";
} else {
    include('inc/componentes/iptv.php');
} ?>