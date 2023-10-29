<?php
// Reproductor
if (isset($_GET['c']) || isset($_GET['r']) || isset($_GET['s']) || isset($_GET['v']) || isset($_GET['key']) || isset($_GET['evento']) || isset($_GET['ifr']) || isset($_GET['m3u'])) {
    include('play.php');
    //echo "Debe ir al reproductor";
} else {
    include('inc/componentes/canales.php');
} ?>