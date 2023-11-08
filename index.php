<!-- App Capsule -->
<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
// BD
include('../inc/conn.php');
session_start();
// IP + País
if (!isset($_SESSION['ip'])) {
    // Obtenemos IP
    if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // Obtiene la primera dirección IP de la lista
        $ipList = explode(',', $_SERVER['HTTP_X_FORWARDED_FOR']);
        $ip = trim($ipList[0]);
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }
    // API
    $geolocation = file_get_contents("https://ipinfo.io/{$ip}/json");
    $geolocationData = json_decode($geolocation);
    if ($geolocationData !== NULL && isset($geolocationData->country)) {
        $country = $geolocationData->country;
        $city = $geolocationData->city;
        $timezone = $geolocationData->timezone;
        // Variables de sesión
        $_SESSION['ip'] = $ip;
        $_SESSION['country'] = $country;
        $_SESSION['city'] = $city;
        $_SESSION['timezone'] = $timezone;
    }    
} else {
    $ip = $_SESSION['ip'];
    $country = $_SESSION['country'];
    $city = $_SESSION['city'];
    $timezone = $_SESSION['timezone'];
}
// Verificar cookies
if (isset($_COOKIE['usuario_id'])) {
    $usuario_id = $_COOKIE['usuario_id'];
    $query = mysqli_query($conn,"SELECT id, nombre, rol_id FROM usuarios WHERE id = '$usuario_id'");
    $usuario = mysqli_fetch_assoc($query);
    // Establecer las cookies nuevamente con una duración extendida de 7 días más
    setcookie("usuario_id", $_COOKIE['usuario_id'], time() + (86400 * 7), "/");
    setcookie("usuario_nombre", $_COOKIE['usuario_nombre'], time() + (86400 * 7), "/");
    setcookie("usuario_rol", $_COOKIE['usuario_rol'], time() + (86400 * 7), "/");
}
// Guardar referer
if ($_GET['p'] !== "login") {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
}
if (isset($_GET['p']) && $_GET['p'] == "tv" && isset($_GET['c']) || isset($_GET['evento']) || isset($_GET['r']) || isset($_GET['s']) || isset($_GET['f'])) {
    include('play.php');
    exit();
}
// Header
include('inc/header.php');
?>
<div class="container" id="appCapsule">
    <?php
    if (isset($_SESSION['message']) || isset($_GET['logout'])) { ?>
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                Toastify({
                    text: "<?= $_SESSION['message']; ?>",
                    duration: 9000,
                    close: true,
                    gravity: "top",
                    position: "right",
                    backgroundColor: "<?= $_SESSION['messageColor']; ?>",
                    stopOnFocus: true
                }).showToast();
            });
        </script>

    <?php }
    unset($_SESSION['message']);
    // Navegación
    // Parámetro "p" del método GET
    if (isset($_GET['p'])) {
        // Escapar caracteres peligrosos
        $paginaSolicitada = basename($_GET['p']);
        // Ruta al directorio de páginas
        $rutaDirectorio = __DIR__ . '/';
        // Verificar
        if (file_exists($rutaDirectorio . $paginaSolicitada . ".php")) {
            // Si existe, cárgala
            include($rutaDirectorio . $paginaSolicitada . ".php");
        } else {
            // Si no existe, 404.php
            echo "No existe";
            //include("404.php");
        }
    } else {
        // Si no se proporciona ningún parámetro, carga la página predeterminada (index.php)
        include("home.php");
    } ?>
</div>
<?php
// Footer
include('inc/navbar.php');
?>