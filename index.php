<!-- App Capsule -->
<?php
session_start();
// BD
include('../inc/conn.php');
// Guardar referer
if ($_GET['p'] !== "login") {
    $_SESSION['redirect_url'] = $_SERVER['REQUEST_URI'];
}
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
if (isset($_GET['p']) && $_GET['p'] == "tv" && isset($_GET['c']) || isset($_GET['evento']) || isset($_GET['r']) || isset($_GET['f'])) {
    // Validar sesión
    if (isset($_SESSION['usuario_id']) || isset($_COOKIE['usuario_id'])) {
        // Validar suscripción
        $usuario_id = $_SESSION['usuario_id'];
        $query = mysqli_query($conn,"SELECT id, suscripcion FROM usuarios WHERE id = '$usuario_id'");
        $result = mysqli_fetch_assoc($query);
        $suscripcion = new DateTime($result['suscripcion']);
        $actual = new DateTime();
        $restante = $actual -> diff($suscripcion);
        $validez = $restante->days;
        if ($validez > 0){
            $_SESSION['message'] = "Tienes " . $validez . " días restantes de tu suscripción";
            ($validez <= 12 ? $_SESSION['messageColor'] = "#ef4444" : $_SESSION['messageColor'] = "#007bff");
            include('play.php');
            exit();
        } else {
            $_SESSION['message'] = "Debes tener una suscripción activa para acceder a esta sección";
            $_SESSION['messageColor'] = "#ef4444";
            $hiddeElements = "hidden";
            include("error.php");
        }
    } else {
        $_SESSION['message'] = "Inicia sesión para acceder a este canal";
        $_SESSION['messageColor'] = "#ef4444";
        header("Location: ?p=login");
        exit();
    }
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