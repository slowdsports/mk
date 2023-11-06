<script src="//ssl.p.jwpcdn.com/player/v/8.24.0/jwplayer.js"></script>
<script>jwplayer.key = 'XSuP4qMl+9tK17QNb+4+th2Pm9AWgMO/cYH8CI0HGGr7bdjo';</script>
<style>
    body {
        background-color: #000;
        color: #fff;
        margin: 0;
        padding: 0;
    }

    h1 {
        text-align: center;
    }

    .container {
        width: 100% !important;
        height: 100vh !important;
    }

    #player,
    #iframe {
        height: 100% !important;
        width: 100% !important;
        border: none;
    }
</style>
<?php
$getUrl = base64_decode($_GET['s']);
$params = explode("&", $getUrl);
$s = "";
$key = "";
$key2 = "";
foreach ($params as $param) {
    list($nombre, $val) = explode("=", $param);
    // Asignar los valores a las variables correspondientes según el nombre del parámetro
    if ($nombre === "key") {
        $key = $val;
    } elseif ($nombre === "key2") {
        $key2 = $val;
    } else {
        // Si el nombre del parámetro no es "key" ni "key2", se asume que es la primera parte de la URL
        $s = $nombre . "=" . $val;
    }
}

//echo $getUrl;
echo '
<script>
var getURL = "' . $s . '";
var getKEY = "' . $key . '";
var getKEY2 = "' . $key2 . '";
var getTYPE = 9;
</script>'; ?>
<div class="container">
    <div id="player"></div>
</div>
<script src="../../../assets/js/reproductores/jw.js"></script>