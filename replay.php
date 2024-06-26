<?php
error_reporting(E_ALL);
ini_set('display_errors', '0');
include ('../inc/conn.php');

if (!in_array($country, $autorizados) && !isset($_SESSION['v3'])) {
    if (!isset($_COOKIE['usuario_id'])) {
        $_SESSION['message'] = "Por favor inicia sesión para acceder al contenido.";
        $_SESSION['messageColor'] = "#dc3545";
        header("Location: ?p=login");
        exit();
    } else {
        $idCookie = $_COOKIE['usuario_id'];
        $fechaActual = date("Y-m-d");
        $usuarioQuery = mysqli_query($conn, "SELECT id, suscripcion FROM usuarios WHERE id = $idCookie");
        $usuario = mysqli_fetch_array($usuarioQuery);
        $suscripcion = $usuario['suscripcion'];
        if ($suscripcion < $fechaActual) {
            // Vencida
            $_SESSION['message'] = "Debes tener una suscripción activa para acceder al contenido.";
            $_SESSION['messageColor'] = "#dc3545";
            header("Location: ?p=error&message=Debes%20tener%20una%20suscripción%20activa%20para%20acceder%20al%20contenido.");
            exit();
        }
    }
}
if (isset($_GET['c'])) {
    $canal = $_GET['c'];
    $canalTipo;
    $canalNombre;
    $channels = mysqli_query($conn, "SELECT * FROM canales
    INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
    WHERE canalId = $canal");
    $result = mysqli_fetch_assoc($channels);
    $canalId = $result['canalId'];
    $canalImg = $result['canalImg'];
    $canalNombre = $result['canalNombre'];
    $canalCategoria = $result['categoriaNombre'];
    $categoria = $result['categoriaId'];
    // Fuentes Alternas
    if (isset($_GET['f'])) {
        $canalAlt = $_GET['f'];
        $channels = mysqli_query($conn, "SELECT * FROM fuentes
        INNER JOIN canales ON fuentes.canal = canales.canalId
        INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
        WHERE fuenteId = $canalAlt");
        $result = mysqli_fetch_assoc($channels);
        $canalId = $result['canal'];
        $canalImg = $result['canalImg'];
        $canalNombre = $result['canalNombre'];
        $canalCategoria = $result['categoriaNombre'];
        $categoria = $result['categoriaId'];
        $canalUrl = $result['canalUrl'];
        $canalPais = $result['pais'];
        $canalTipo = $result['tipo'];
        // Verificar que "c" coincida en BD
        if ($canal !== $result['canal']) {
            $canal = $result['canal'];
        }
    }
}
// Verificar tipo
if (empty($canalTipo)) {
    $canalTipo = 'default';
}
// iframes
if (isset($_GET['title'])) {
    $canalNombre = $_GET['title'];
}
?>
<style>
    body {
        margin: 0;
        padding: 0;
    }

    .embed-responsive {
        border-radius: 8px;
    }
</style>

<section class="mb-5 pt-4 pb-2 py-mg-4">
    <div class="row gy-4">
        <!-- Content -->
        <div class="col-lg-12 section mt-2">
            <!-- Reproductor -->
            <div class="card">
                <div class="sticky-title embed-responsive embed-responsive-16by9" id="playerContainer">
                    <?php
                    // Definir configuraciones para diferentes casos
                    $configurations = [
                        'r' => ["star.php", ['r', 'key', 'key2', 'img']],
                        's' => ["hbo.php", ['s', 'key', 'key2']],
                        'nbalp' => ["nbalp.php", ['id', 'img']],
                        'adult' => ["adult.php", []],
                        'nba' => ["", ['ifr']],
                        'nfl' => ["", ['ifr']],
                        'mlb' => ["", ['ifr']],
                        'evento' => ["", ['ifr']],
                        'hls' => ["hls.php", ['c']],
                        '11' => ["ckm.php", ['c', 'f']],
                        '12' => ["mplus.php", ['c', 'f']],
                        '9' => ["ck.php", ['c', 'f']],
                        '6' => ["bm.php", ['c', 'f']],
                        '1' => ["hls.php", ['c', 'f']],
                        '3' => ["yt.php", ['c', 'f']],
                        '2' => ["frame.php", ['c', 'f']] // For $canalTipo == 2, handle $canalUrl separately
                    ];

                    // Obtener el tipo de configuración
                    if (isset($_GET['ifr']) || isset($_GET['evento'])) {
                        // NBA LP Old
                        if (isset($_GET["nbalp"])) {
                            $idFrame = $_GET["nbalp"];
                            $src = "//irtvhn.info/nba.php?id=" . $idFrame;
                            $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media' src='$src'";
                            echo "<iframe {$src}></iframe>";

                        } else {
                            $decodedIfr = base64_decode($_GET['ifr']);
                            $canalUrl = $decodedIfr;
                            // Validar la URL antes de mostrarla en el iframe
                            if (filter_var($decodedIfr, FILTER_VALIDATE_URL)) {
                                // Si la URL es válida, mostrarla en el iframe
                                if (isset($_GET['sandbox'])) {
                                    $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' sandbox='allow-scripts allow-same-origin' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media' src='{$decodedIfr}'";
                                } else {
                                    $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media' src='{$decodedIfr}'";
                                }
                                echo "<iframe {$src}></iframe>";
                            } else {
                                // Si la URL no es válida, mostrar un mensaje de error o redirigir a una página de error
                                $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media' src='ruta/a/pagina/de/error'";
                                echo "<iframe {$src}></iframe>";
                            }
                        }
                    } elseif (isset($_GET['r']) && isset($_GET['img'])) {
                        $config = $configurations['r'];
                        // Construir los parámetros para la URL del iframe
                        $params = implode("&", array_map(function ($param) {
                            return isset ($_GET[$param]) ? "{$param}={$_GET[$param]}" : "";
                        }, $config[1]));
                        // Construir la URL del iframe con la configuración correspondiente
                        $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media *; autoplay' src='inc/reproductor/{$config[0]}?{$params}'";
                        echo "<iframe {$src}></iframe>";

                    } elseif (isset($_GET['s'])) {
                        $config = $configurations['s'];
                        // Construir los parámetros para la URL del iframe
                        $params = implode("&", array_map(function ($param) {
                            return isset ($_GET[$param]) ? "{$param}={$_GET[$param]}" : "";
                        }, $config[1]));
                        // Construir la URL del iframe con la configuración correspondiente
                        $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media *; autoplay' src='inc/reproductor/{$config[0]}?{$params}'";
                        echo "<iframe {$src}></iframe>";

                    } elseif (isset($_GET['nbalp'])) {
                        $config = $configurations['nbalp'];
                        // Construir los parámetros para la URL del iframe
                        $params = implode("&", array_map(function ($param) {
                            return isset ($_GET[$param]) ? "{$param}={$_GET[$param]}" : "";
                        }, $config[1]));
                        // Construir la URL del iframe con la configuración correspondiente
                        $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media *; autoplay' src='inc/reproductor/{$config[0]}?{$params}'";
                        echo "<iframe {$src}></iframe>";
                    } else {
                        // Configurar los claro
                        if (strpos($canalUrl, "claro") || strpos($canalUrl, "cvatt")) {
                            $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media' src='https://clarovideo.irtvhn.info?c=$canalAlt'";
                        } // Configurar los IZZI
                        elseif (strpos($canalUrl, "izzigo")) {
                            // Validar localización
                            if (isset($country) && $country !== "MX" || $country !== "US") {
                                $proxy = "proxy";
                            } else {
                                $proxy = "";
                            }
                            $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow='encrypted-media' src='//izzigo.irtvhn.info?c=$canalAlt&$proxy'";
                        } elseif (isset($canalTipo) && isset($configurations[$canalTipo])) {
                            // Obtener el tipo de canal de la base de datos y verificar si existe en las configuraciones
                            $config = $configurations[$canalTipo];

                            // Construir los parámetros para la URL del iframe
                            $params = implode("&", array_map(function ($param) {
                                return isset ($_GET[$param]) ? "{$param}={$_GET[$param]}" : "";
                            }, $config[1]));

                            // Construir la URL del iframe con la configuración correspondiente
                            $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='inc/reproductor/{$config[0]}?{$params}'";
                        } else {
                            // Manejar el caso por defecto o mostrar un error si el tipo de canal no es válido
                            $src = "id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0' scrolling='no' allowfullscreen allow-encrypted-media src='inc/reproductor/ck.php?error'";
                        }

                        // Imprimir el iframe
                        echo "<iframe {$src}></iframe>";
                    }
                    ?>

                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Info Canal -->
                    <div class="col-6 d-flex flex-column justify-content-start">
                        <?php (isset($_GET['c']) ? include('inc/componentes/fuentes.php') : ''); ?>
                        <h4 class="card-subtitle"><?=$canalCategoria?></h4>
                        <h1 class="card-title"><?=$canalNombre?></h1>
                    </div>
                    <!-- Votos -->
                    <?php if (isset($_COOKIE['usuario_id']) && isset($_GET['c'])): ?>
                        <div class="col-6 d-flex justify-content-end">
                            <?php
                            $canalAlt = $_GET['c'];
                            // Consulta SQL para obtener el recuento de votos para cada canal
                            $sql = "SELECT canal_id, 
                        SUM(CASE WHEN voto = 'like' THEN 1 ELSE 0 END) as like_count,
                        SUM(CASE WHEN voto = 'dislike' THEN 1 ELSE 0 END) as dislike_count
                        FROM votos WHERE canal_id = $canalAlt
                        GROUP BY canal_id";

                            $result = $conn->query($sql);
                            $row = $result->fetch_assoc();
                            if ($result->num_rows > 0) {
                                $likeCount = $row['like_count'];
                                $dislikeCount = $row['dislike_count'];
                            } else {
                                $likeCount = 0;
                                $dislikeCount = 0;
                            }
                            // Verificar si el usuario ha dado "like" para este canal
                            $sqlCheckLike = "SELECT * FROM votos WHERE usuario_id = $_COOKIE[usuario_id] AND canal_id = $canalAlt AND voto = 'like'";
                            $resultCheckLike = $conn->query($sqlCheckLike);
                            $userHasLiked = ($resultCheckLike->num_rows > 0);
                            // Verificar si el usuario ya ha dado like
                            $likeClass = ($userHasLiked) ? 'active' : '';
                            // Verificar si el usuario ha dado "dislike" para este canal
                            $sqlCheckDislike = "SELECT * FROM votos WHERE usuario_id = $_COOKIE[usuario_id] AND canal_id = $canalAlt AND voto = 'dislike'";
                            $resultCheckDislike = $conn->query($sqlCheckDislike);
                            $userHasDisliked = ($resultCheckDislike->num_rows > 0);
                            // Verificar si el usuario ya ha dado dislike
                            $dislikeClass = ($userHasDisliked) ? 'active' : '';
                            ?>
                            <button data-canal-id="<?= $canalAlt ?>" type="button"
                                class="btn btn-outline-success like-btn <?= $likeClass ?>">
                                <ion-icon name="thumbs-up" role="img" class="md hydrated" aria-label="thumbs up"></ion-icon>
                                <span id="like-count-<?= $canalAlt ?>" class="badge bg-primary shadow-primary mt-n1 ms-3">
                                    <?= $likeCount ?>
                                </span>
                            </button>
                            <button data-canal-id="<?= $canalAlt ?>" type="button"
                                class="btn btn-outline-danger dislike-btn <?= $dislikeClass ?>">
                                <ion-icon name="thumbs-down" role="img" class="md hydrated"
                                    aria-label="thumbs down"></ion-icon>
                                <span id="dislike-count-<?= $canalAlt ?>" class="badge bg-danger shadow-primary mt-n1 ms-3">
                                    <?= $dislikeCount ?>
                                </span>
                            </button>
                        </div>
                        <!-- AJAX -->
                        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                        <script src="inc/componentes/like.js"></script>
                    <?php else: ?>
                        Inicia sesión para acceder a las votaciones del canal
                    <?php endif; ?>
                </div>
            </div>
</section>