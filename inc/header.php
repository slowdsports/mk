<!doctype html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport"
        content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, viewport-fit=cover" />
    <meta name="apple-mobile-web-app-capable" content="yes" />
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#000000">
    <title>iRaffle TV App</title>
    <meta name="description" content="iRaffle TV App">
    <meta name="keywords" content="Deportes y televisión premium en vivo" />
    <link rel="icon" type="image/png" href="../assets/img/favicon.png" sizes="32x32">
    <link rel="apple-touch-icon" sizes="180x180" href="../assets/img/favicon.png">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/flags.css">
    <link rel="stylesheet" href="assets/css/toastify.min.css">
    <link rel="stylesheet" href="assets/css/<?= ($_GET['p'] == "home" || !isset($_GET['p']) ? "slider" : "events" ) ?>.css">
    <?php if (isset($_GET['p']) && $_GET["p"] == "star" || $_GET["p"] == "starn" || $_GET["p"] == "vix" || $_GET["p"] == "nbalp"): ?>
    <script src="assets/js/lib/horario.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <?php endif; ?>
</head>
<style>
    /* Estilos para botones con enfoque visual */
    a:focus, div:focus, .section:focus, .product-card:focus, ul>li:focus {
    outline: 2px solid #6366f1!important;
    }
    div.row a:focus {
        outline: none;
        box-shadow: 2px #6366f1;
    }
</style>

<body>
    <!-- loader -->
    <div id="loader">
        <div class="spinner-border text-primary" role="status"></div>
    </div>
    <!-- * loader -->
    <!-- top -->
    <a href="#" class="button goTop show">
        <ion-icon name="arrow-up-outline" role="img" class="md hydrated" aria-label="arrow up outline"></ion-icon>
    </a>
    <!-- * top -->

    <?php
    // Evitar la carga del header
    if (isset($_GET['p']) && $_GET["p"] == "iptv" ) {} else { ?>

    <?php if (isset($_GET["p"]) && $_GET["p"] == "tv") { ?>
    <!-- App Header -->
    <div class="appHeader bg-primary scrolled">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
            <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
            <a href="#" class="headerButton toggle-searchbox">
                <ion-icon name="search-outline" role="img" class="md hydrated" aria-label="search outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            Televisión
        </div>
        <div class="right">
            <div id="category-select" class="dropdown">
                <a class="headerButton dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
                    <ion-icon name="funnel-outline"></ion-icon>
                </a>
                <div class="dropdown-menu">
                    <a class="dropdown-item" href="#" data-category="all">Todo</a>
                    <?php
                    $ccf = mysqli_query($conn, "SELECT categoriaId, categoriaNombre FROM categorias");
                    while ($rrf = mysqli_fetch_array($ccf)):
                    $catId = $rrf['categoriaId']; $catNombre = $rrf['categoriaNombre'];
                    $ccfn = mysqli_query($conn, "SELECT * FROM canales WHERE canalCategoria = $catId");
                    $ttc = mysqli_num_rows($ccfn);
                    if ($ttc > 0) {
                    ?>
                    <a class="dropdown-item" href="#" data-category="<?=$catId?>"><?=$catNombre?></a>
                    <?php
                    }
                    endwhile;
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- * App Header -->

    <?php
    } elseif (!isset($_GET["p"]) || $_GET["p"] == "home" || $_GET["p"] == "star" || $_GET["p"] == "vix") {
    ?>
    <!-- App Header -->
    <div class="appHeader bg-primary scrolled">
        <div class="left">
            <a href="#" class="headerButton" data-toggle="modal" data-target="#sidebarPanel">
                <ion-icon name="menu-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            iRaffle TV
        </div>
        <div class="right">
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input dark-mode-switch" id="darkmodeswitch">
                <label class="custom-control-label" for="darkmodeswitch"></label>
            </div>
            <a href="javascript:;" class="hidden headerButton toggle-searchbox">
                <ion-icon name="search-outline"></ion-icon>
            </a>
        </div>
    </div>
    <!-- * App Header -->
    <?php
    } else { ?>
    <!-- App Header -->
    <div class="appHeader bg-primary scrolled text-light">
        <div class="left">
            <a href="javascript:;" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class="pageTitle">
            <?= ucfirst($_GET['p']) ?>
        </div>
        <div class="right">
            <a href="?p=cuenta" class="hidden headerButton">
                <ion-icon name="people-outline"></ion-icon>
            </a>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input dark-mode-switch" id="darkmodeswitch">
                <label class="custom-control-label" for="darkmodeswitch"></label>
            </div>
        </div>
    </div>
    <!-- * App Header -->
    <?php } ?>

    <!-- Search Component -->
    <div id="search" class="appHeader">
        <form class="search-form">
            <div class="form-group searchbox">
                <input id="<?= (isset($_GET['p']) || $_GET['p'] == "star" || $_GET['p'] == "vix") ? "filtroInput" : "channelSearch" ?>" type="text" class="form-control" placeholder="Buscar...">
                <i class="input-icon">
                    <ion-icon name="search-outline"></ion-icon>
                </i>
                <a href="javascript:;" class="ml-1 close toggle-searchbox">
                    <ion-icon name="close-circle"></ion-icon>
                </a>
            </div>
        </form>
    </div>
    <!-- * Search Component -->
    <?php } ?>