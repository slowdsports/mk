<?php
// Evitar la carga del navbar
if (isset($_GET['p']) && $_GET['p'] == "notificaciones" ) {}
else {
    (isset($_GET['p']) && $_GET['p'] == "login" || $_GET['p'] == "error" ? $hiddeElements = "hidden" : "");
?>
<!-- app footer -->
<div class="<?=$hiddeElements?> appFooter">
    <img id="iconFooter" src alt="icon" class="footer-logo mb-2">
    <div class="footer-title">
        Copyright © iRaffle TV <?= date('Y') ?>. Derechos Reservados.
    </div>
    <div>Nada del contenido que se muesra en esta app es de la autoría de los creadores/administradores.</div>
    Todo a lo que se puede acceder en la misma es fácilmente indexable en internet.
</div>
<br><br>
<!-- * app footer -->
<!-- App Bottom Menu -->
<div class="<?=$hiddeElements?> appBottomMenu">
    <a href="?p=home" class="item <?= (!isset($_GET['p']) || $_GET['p'] == "home" ? "active" : "") ?>">
        <div class="col">
            <ion-icon name="home-outline"></ion-icon>
        </div>
    </a>
    <a href="?p=eventos&tipo=football" class="item <?= ($_GET['p'] == "football" ? "active" : "") ?>">
        <div class="col">
            <ion-icon name="football-outline"></ion-icon>
        </div>
    </a>
    <a href="?p=notificaciones" class="item <?= ($_GET['p'] == "notificaciones" ? "active" : "") ?>">
        <div class="col">
            <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
            <span class="badge badge-danger">5</span>
        </div>
    </a>
    <a href="?p=tv" class="item <?= ($_GET['p'] == "tv" || $_GET['p'] == "iptv"  ? "active" : "") ?>">
        <div class="col">
            <ion-icon name="tv-outline"></ion-icon>
        </div>
    </a>
    <a href="?p=radio" class="item <?= ($_GET['p'] == "radio" ? "active" : "") ?>">
        <div class="col">
            <ion-icon name="radio-outline"></ion-icon>
        </div>
    </a>
    <a href="?p=cuenta" class="item <?= ($_GET['p'] == "cuenta" ? "active" : "") ?>">
        <div class="col">
            <ion-icon name="people-outline"></ion-icon>
        </div>
    </a>
    <a href="javascript:;" class="item" data-toggle="modal" data-target="#sidebarPanel">
        <div class="col">
            <ion-icon name="menu-outline"></ion-icon>
        </div>
    </a>
</div>
<!-- * App Bottom Menu -->

<!-- App Sidebar -->
<div class="modal fade panelbox panelbox-left" id="sidebarPanel" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <?php if (isset($_SESSION['usuario_id'])) { ?>
                <!-- profile box -->
                <div class="profileBox">
                    <div class="image-wrapper">
                        <img src="../assets/img/account/brady-avatar.png" alt="image" class="imaged rounded">
                    </div>
                    <div class="in">
                        <strong><?= ucfirst($_SESSION['usuario_nombre']) ?></strong>
                        <div class="text-muted">
                            <ion-icon name="location"></ion-icon>
                            California
                        </div>
                    </div>
                    <a href="javascript:;" class="close-sidebar-button" data-dismiss="modal">
                        <ion-icon name="close"></ion-icon>
                    </a>
                </div>
                <!-- * profile box -->
                <?php } ?>

                <ul class="listview flush transparent no-line image-listview mt-2">
                    <li>
                        <a href="?p=home" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="home-outline"></ion-icon>
                            </div>
                            <div class="in">
                                Inicio
                            </div>
                        </a>
                    </li>
                    <?php
                    $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE tipo='football'");
                    $totalGames = mysqli_num_rows($queryQty);
                    if ($totalGames > 0) { ?>
                    <li>
                        <a href="?p=eventos&tipo=football" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="football-outline" role="img" class="md hydrated"
                                    aria-label="football outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Fútbol</div>
                                <span class="badge badge-danger"><?=$totalGames?></span>
                            </div>
                        </a>
                    </li>
                    <?php } ?>
                    <?php
                    $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE tipo='basketball'");
                    $totalGames = mysqli_num_rows($queryQty);
                    if ($totalGames > 0) { ?>
                    <li>
                        <a href="?p=eventos&tipo=basketball" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="basketball-outline" role="img" class="md hydrated"
                                    aria-label="basketball outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Basketball</div>
                                <span class="badge badge-danger"><?=$totalGames?></span>
                            </div>
                        </a>
                    </li>
                    <?php } ?>

                    <?php
                    $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE tipo='american-football'");
                    $totalGames = mysqli_num_rows($queryQty);
                    if ($totalGames > 0) { ?>
                    <li>
                        <a href="?p=eventos&tipo=american-football&liga=9464" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="american-football-outline" role="img" class="md hydrated"
                                    aria-label="american football outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>NFL</div>
                                <span class="badge badge-danger"><?=$totalGames?></span>
                            </div>
                        </a>
                    </li>
                    <?php } ?>

                    <?php
                    $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE tipo='baseball'");
                    $totalGames = mysqli_num_rows($queryQty);
                    if ($totalGames > 0) { ?>
                    <li>
                        <a href="?p=eventos&tipo=baseball" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="baseball-outline" role="img" class="md hydrated"
                                    aria-label="baseball outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Baseball</div>
                                <span class="badge badge-danger"><?=$totalGames?></span>
                            </div>
                        </a>
                    </li>
                    <?php } ?>

                    <?php
                    $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE tipo='tennis'");
                    $totalGames = mysqli_num_rows($queryQty);
                    if ($totalGames > 0) { ?>
                    <li>
                        <a href="?p=eventos&tipo=tennis" class="item">
                            <div class="icon-box bg-primary">
                                <i class="mdi mdi-tennis" aria-hidden="true"></i>
                            </div>
                            <div class="in">
                                <div>Tennis</div>
                                <span class="badge badge-danger"><?=$totalGames?></span>
                            </div>
                        </a>
                    </li>
                    <?php } ?>

                    <?php
                    $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE tipo='ice-hockey'");
                    $totalGames = mysqli_num_rows($queryQty);
                    if ($totalGames > 0) { ?>
                    <li>
                        <a href="?p=eventos&tipo=ice-hockey&liga=234" class="item">
                            <div class="icon-box bg-primary">
                                <i class="mdi mdi-hockey-sticks" aria-hidden="true"></i>
                            </div>
                            <div class="in">
                                <div>NHL</div>
                                <span class="badge badge-danger"><?=$totalGames?></span>
                            </div>
                        </a>
                    </li>
                    <?php } ?>

                    <?php
                    $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE tipo='handball'");
                    $totalGames = mysqli_num_rows($queryQty);
                    if ($totalGames > 0) { ?>
                    <li>
                        <a href="?p=eventos&tipo=handaball" class="item">
                            <div class="icon-box bg-primary">
                                <i class="mdi mdi-handball" aria-hidden="true"></i>
                            </div>
                            <div class="in">
                                <div>Balonmano</div>
                                <span class="badge badge-danger"><?=$totalGames?></span>
                            </div>
                        </a>
                    </li>
                    <?php } ?>

                    <?php
                    $queryQty = mysqli_query($conn, "SELECT * FROM canales");
                    $totalGames = mysqli_num_rows($queryQty);
                    if ($totalGames > 0) { ?>
                    <li>
                        <a href="?p=tv" class="item">
                            <div class="icon-box bg-primary disabled">
                                <ion-icon name="tv-outline" role="img" class="md hydrated"
                                    aria-label="tv outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>TV 24/7</div>
                                <span class="badge badge-danger"><?=$totalGames?></span>
                            </div>
                        </a>
                    </li>
                    <?php } ?>
                    <li>
                        <a href="?p=radio" class="item">
                            <div class="icon-box bg-primary disabled">
                                <i class="mdi mdi-radio"></i>
                            </div>
                            <div class="in">
                                <div>Radio</div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="https://t.me/+uyWDSC69RzFlNWE5" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="share-social-outline" role="img" class="md hydrated"
                                    aria-label="share social outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Contactar</div>
                            </div>
                        </a>
                    </li>
                </ul>

                <div class="listview-title mt-2 mb-1">
                    <span>Cuenta y Preferencias</span>
                </div>
                <ul class="listview image-listview flush transparent no-line">
                    <li>
                        <div class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="moon-outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Dark Mode</div>
                                <div class="custom-control custom-switch">
                                    <input type="checkbox" class="custom-control-input dark-mode-switch"
                                        id="darkmodesidebar">
                                    <label class="custom-control-label" for="darkmodesidebar"></label>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="?p=notificaciones" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="chatbubble-ellipses-outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Notificaciones</div>
                                <span class="badge badge-danger">5</span>
                            </div>
                        </a>
                    </li>
                    <li>
                        <a href="?p=cuenta" class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="person-outline"></ion-icon>
                            </div>
                            <div class="in">
                                <div>Cuenta</div>
                            </div>
                        </a>
                    </li>
                </ul>

            </div>

            <!-- sidebar buttons -->
            <div class="sidebar-buttons">
                <a href="?p=cuenta" class="button">
                    <ion-icon name="person-outline"></ion-icon>
                </a>
                <a href="?p=guardados" class="button">
                    <ion-icon name="archive-outline"></ion-icon>
                </a>
                <a href="?p=preferencias" class="button">
                    <ion-icon name="settings-outline"></ion-icon>
                </a>
                <a href="<?= (!isset($_SESSION['usuario_id'])) ? "?p=login" : "?p=login&do=logout" ?>" class="button">
                    <ion-icon name="log-<?= (!isset($_SESSION['id'])) ? "in" : "out" ?>-outline"></ion-icon>
                </a>
            </div>
            <!-- * sidebar buttons -->
        </div>
    </div>
</div>
<!-- * App Sidebar -->

<!-- welcome notification  -->
<div id="notification-welcome" class="hidden notification-box">
    <div class="notification-dialog android-style">
        <div class="notification-header">
            <div class="in">
                <img src="assets/img/icon/72x72.png" alt="image" class="imaged w24">
                <strong>Mobilekit</strong>
                <span>just now</span>
            </div>
            <a href="#" class="close-button">
                <ion-icon name="close"></ion-icon>
            </a>
        </div>
        <div class="notification-content">
            <div class="in">
                <h3 class="subtitle">Welcome to Mobilekit</h3>
                <div class="text">
                    Mobilekit is a PWA ready Mobile UI Kit Template.
                    Great way to start your mobile websites and pwa projects.
                </div>
            </div>
        </div>
    </div>
</div>
<!-- * welcome notification -->
<?php } ?>
<!-- ///////////// Js Files ////////////////////  -->
<!-- Jquery -->
<script src="assets/js/lib/jquery-3.4.1.min.js"></script>
<!-- Bootstrap-->
<script src="assets/js/lib/popper.min.js"></script>
<script src="assets/js/lib/bootstrap.min.js"></script>
<script src="assets/js/lib/toastify.min.js"></script>
<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.0.0/dist/ionicons/ionicons.js"></script>
<!-- Owl Carousel -->
<script src="assets/js/plugins/owl-carousel/owl.carousel.min.js"></script>
<!-- jQuery Circle Progress -->
<script src="assets/js/plugins/jquery-circle-progress/circle-progress.min.js"></script>
<!-- Base Js File -->
<script src="assets/js/base.js"></script>
<?php if (isset($_GET['p']) && $_GET['p'] == "iptv"){} else {?>
<script src="assets/js/filter.js"></script>
<?php } ?>


<script>
    setTimeout(() => {
        notification('notification-welcome', 5000);
    }, 2000);
</script>

</body>

</html>