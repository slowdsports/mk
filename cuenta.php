<?php
session_start();
if (!isset($_SESSION["usuario_id"])) {
    // Verificar cookie
    if (isset($_COOKIE["usuario_id"])) {
        if ($_SESSION["usuario_id"] == $_COOKIE["usuario_id"]) {
            $_SESSION["usuario_id"] = $_COOKIE["usuario_id"];
        } else {
            $_SESSION["message"] = "Hay un error con tu usuario, por favor inicia sesión nuevamente.";
            $_SESSION["messageColor"] = "#ef4444";
            header("Location: ?p=login&do=logout");
            exit();
        }
    }
} else {
    $usuario_id = $_SESSION['usuario_id'];
    // Credenciales de bd
    $queryUsuario = mysqli_query($conn, "SELECT * FROM usuarios WHERE id='$usuario_id'");
    $result = mysqli_fetch_array($queryUsuario);
}
?>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        Toastify({
            text: "Continuamos trabajando en esta sección",
            duration: 9000,
            close: true,
            gravity: "bottom",
            position: "center",
            backgroundColor: "#1E74FD",
            stopOnFocus: true
        }).showToast();
    });
</script>
<div class="section mt-2">
    <div class="profile-head">
        <div class="avatar">
            <img src="assets/img/sample/avatar/avatar1.jpg" alt="avatar" class="imaged w64 rounded">
        </div>
        <div class="in">
            <h3 class="name">
                <?= ucfirst($result['nombre']) ?>
            </h3>
            <h5 class="subtext">
                <?= $result['email'] ?>
            </h5>
        </div>
    </div>
</div>

<div class="section full mt-2">
    <div class="profile-stats pl-2 pr-2">
        <a href="#" class="item">
            <strong>XX</strong>Elementos Guardados
        </a>
        <a href="#" class="item">
            <strong>XX</strong>Días Restantes
        </a>
        <a href="#" class="item">
            <strong>XX</strong>Canales Favoritos
        </a>
    </div>
</div>

<div class="section mt-1 mb-2">
    <div class="profile-info">
        <div class=" bio">
            <?php
            if ($result['bio'] == 'null' || $result['bio'] == "") {
                ?>
                Parece que no hay nada en tu biografía, este podría ser un buen momento para comenzar a escribir sobre tus
                intereses o preferencias para que se pueda mostrar algo en esta sección.
            <?php } else {
                echo $result['bio'];
            } ?>
        </div>
        <div class="link">
            <a href="#">Madrid</a>,
            <a href="#">España</a>
        </div>
    </div>
</div>

<div class="section full">
    <div class="wide-block transparent p-0">
        <ul class="nav nav-tabs lined iconed" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#canales-favoritos" role="tab">
                    <ion-icon name="tv-outline"></ion-icon>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#eventos-guardados" role="tab">
                    <ion-icon name="bookmark-outline"></ion-icon>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#preferencias" role="tab">
                    <ion-icon name="settings-outline"></ion-icon>
                </a>
            </li>
        </ul>
    </div>
</div>


<!-- tab content -->
<div class="section full mb-2">
    <div class="tab-content">
        <!--  canales-favoritos -->
        <div class="tab-pane fade show active" id="canales-favoritos" role="tabpanel">
            <ul class="listview image-listview media flush transparent pt-1">
                <li>
                    <a href="#" class="item">
                        <div class="imageWrapper">
                            <img src="assets/img/sample/photo/1.jpg" alt="image" class="imaged w64">
                        </div>
                        <div class="in">
                            <div>
                                Birds
                                <div class="text-muted">62 photos</div>
                            </div>
                            <span class="badge badge-primary">5</span>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="item">
                        <div class="imageWrapper">
                            <img src="assets/img/sample/photo/2.jpg" alt="image" class="imaged w64">
                        </div>
                        <div class="in">
                            <div>
                                Street Photos
                                <div class="text-muted">15 photos</div>
                            </div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="item">
                        <div class="imageWrapper">
                            <img src="assets/img/sample/photo/3.jpg" alt="image" class="imaged w64">
                        </div>
                        <div class="in">
                            <div>
                                Dogs
                                <div class="text-muted">97 photos</div>
                            </div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>

        <!-- eventos-guardados -->
        <div class="tab-pane fade" id="eventos-guardados" role="tabpanel">
            <div class="mt-2 pr-2 pl-2">
                <div class="row">
                    <div class="col-4 mb-2">
                        <img src="assets/img/sample/photo/1.jpg" alt="image" class="imaged w-100">
                    </div>
                    <div class="col-4 mb-2">
                        <img src="assets/img/sample/photo/2.jpg" alt="image" class="imaged w-100">
                    </div>
                    <div class="col-4 mb-2">
                        <img src="assets/img/sample/photo/3.jpg" alt="image" class="imaged w-100">
                    </div>
                    <div class="col-4 mb-2">
                        <img src="assets/img/sample/photo/4.jpg" alt="image" class="imaged w-100">
                    </div>
                    <div class="col-4 mb-2">
                        <img src="assets/img/sample/photo/5.jpg" alt="image" class="imaged w-100">
                    </div>
                    <div class="col-4 mb-2">
                        <img src="assets/img/sample/photo/6.jpg" alt="image" class="imaged w-100">
                    </div>
                    <div class="col-4 mb-2">
                        <img src="assets/img/sample/photo/1.jpg" alt="image" class="imaged w-100">
                    </div>
                    <div class="col-4 mb-2">
                        <img src="assets/img/sample/photo/2.jpg" alt="image" class="imaged w-100">
                    </div>
                    <div class="col-4 mb-2">
                        <img src="assets/img/sample/photo/3.jpg" alt="image" class="imaged w-100">
                    </div>
                    <div class="col-4 mb-2">
                        <img src="assets/img/sample/photo/4.jpg" alt="image" class="imaged w-100">
                    </div>
                    <div class="col-4 mb-2">
                        <img src="assets/img/sample/photo/5.jpg" alt="image" class="imaged w-100">
                    </div>
                    <div class="col-4 mb-2">
                        <img src="assets/img/sample/photo/6.jpg" alt="image" class="imaged w-100">
                    </div>
                </div>
            </div>
            <div class="pr-2 pl-2">
                <a href="#" class="btn btn-primary btn-block">More Photo</a>
            </div>
        </div>
        <!-- * eventos-guardados -->

        <!-- * bookmarks -->
        <!-- preferencias -->
        <div class="tab-pane fade" id="preferencias" role="tabpanel">
            <ul class="listview image-listview text flush transparent pt-1">
                <li>
                    <div class="item">
                        <div class="in">
                            <div>
                                Mute
                                <footer>Disabled notifications from this person</footer>
                            </div>
                            <div class="custom-control custom-switch">
                                <input type="checkbox" class="custom-control-input" id="customSwitch1">
                                <label class="custom-control-label" for="customSwitch1"></label>
                            </div>
                        </div>
                    </div>
                </li>
                <li>
                    <a href="#" class="item">
                        <div class="in">
                            <div class="text-danger">Block</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="item">
                        <div class="in">
                            <div>Report</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="item">
                        <div class="in">
                            <div>Share This Profile</div>
                        </div>
                    </a>
                </li>
                <li>
                    <a href="#" class="item">
                        <div class="in">
                            <div>Send a Message</div>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <!-- * preferencias -->
    </div>
</div>
<!-- * tab content -->