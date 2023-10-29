<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');
session_start();
// Código para cerrar sesión
if ($_GET['do'] == "logout") {
    $_SESSION['message'] = "Has cerrado sesión satisfactoriamente. Esperamos verte pronto nuevamente";
    $_SESSION['messageColor'] = "#4044ee";
    // Destruir todas las variables de sesión
    session_destroy();
    header("Location: ?p=home&logout=success");
    // Eliminar las cookies de usuario
    setcookie("usuario_id", "", time() - 3600, "/");
    setcookie("usuario_rol", "", time() - 3600, "/");
    exit();

}
// Redirigir si ya hay sesión
if (isset($_SESSION['usuario_id'])) {
    $_SESSION['message'] = "Ya has iniciado sesión previamente";
    header("Location: ?p=cuenta");
}
?>
<?php if ($_GET['do'] == "registro") { ?>
    <!-- Sign up form -->
    <div class="login-form">
        <div class="section">
            <h1>Registrarse</h1>
            <h4>Rellena el formulario para unirte</h4>
            <?php if (isset($_SESSION['message'])) { ?>
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
            unset($_SESSION['message']); ?>
        </div>
        <div class="section mt-2 mb-5">
            <form method="POST" action="inc/usuario/registro.php" class="needs-validation">

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nombre" required>
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required>
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="password" class="form-control" id="password-confirm" name="password-confirm" placeholder="Contraseña (confirmar)" required>
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class=" mt-1 text-left">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="customChecka1" required>
                        <label class="custom-control-label text-muted" for="customChecka1">Acepto registrarme en la app</label>
                    </div>

                </div>

                <div class="form-button-group">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Register</button>
                </div>

            </form>
            <script>
            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function() {
            'use strict';
            window.addEventListener('load', function() {
                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.getElementsByClassName('needs-validation');
                // Loop over them and prevent submission
                var validation = Array.prototype.filter.call(forms, function(form) {
                form.addEventListener('submit', function(event) {
                    if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
                });
            }, false);
            })();
            </script>
        </div>
    </div>
<?php } else { ?>
    <!-- Log in form -->
    <div class="login-form mt-1">
        <div class="section">
            <img src="assets/img/sample/photo/vector4.png" alt="image" class="form-image">
        </div>
        <div class="section mt-1">
            <h1>Iniciar Sesión</h1>
            <h4>Por favor rellena el formulario</h4>
            <?php if (isset($_SESSION['message'])) { ?>
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
            unset($_SESSION['message']); ?>
        </div>
        <div class="section mt-1 mb-5">
            <form method="POST" action="inc/usuario/login.php" class="needs-validation">
                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-group boxed">
                    <div class="input-wrapper">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña">
                        <i class="clear-input">
                            <ion-icon name="close-circle"></ion-icon>
                        </i>
                    </div>
                </div>

                <div class="form-links mt-2">
                    <div>
                        <a href="?p=login&do=registro">Registrarse</a>
                    </div>
                    <div><a href="?p=login&do=password" class="text-muted">¿Olvidaste tu contraseña?</a></div>
                </div>

                <div class="form-button-group">
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Entrar</button>
                </div>

            </form>
        </div>
    </div>
<?php } ?>