<!-- App Capsule -->
<?php
session_start();
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
if (isset($_GET['p']) && $_GET['p'] == "tv" && isset($_GET['c']) || isset($_GET['evento']) || isset($_GET['r']) || isset($_GET['f'])) {
    include('play.php');
    exit();
}
// BD
include('../inc/conn.php');
// Header
include('inc/header.php');
?>
<div id="appCapsule">
    <?php
    if (isset($_SESSION['message'])) { ?>
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