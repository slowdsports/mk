<?php
$id = intval($_GET['id']);

// Cargar el contenido del archivo JSON
$jsonData = file_get_contents('blog.json');

// Decodificar el JSON en un array asociativo
$articles = json_decode($jsonData, true);
//var_dump($articles);

// Inicializar el artículo como un array vacío
$article = [];

// Verificar si el índice existe en el arreglo
if (array_key_exists($id, $articles)) {
    $article = $articles[$id];
    $title = $article['title'];
    $poster = $article['poster'];
    $date = $article['date'];
    $description = $article['description'];
    $content = $article['content'];
    $image = $article['image'];
    $extraTitle = $article['extraTitle'];
    $extra = $article['extra'];
    $video = $article['video'];
}
?>
<script src="//ssl.p.jwpcdn.com/player/v/8.24.0/jwplayer.js"></script>
<script>jwplayer.key = 'XSuP4qMl+9tK17QNb+4+th2Pm9AWgMO/cYH8CI0HGGr7bdjo';</script>
<div class="blog-post">
    <div class="mb-2">
        <?php if (isset($video)) { ?>
            <div class="imaged square w-100">
                <div style="border-radius:5px" id="player"></div>
            </div>
        <?php } else { ?>
            <img src="<?= $poster ?>" alt="image" class="imaged square w-100">
        <?php } ?>
    </div>
    <h1 class="title">
        <?= $title ?>
    </h1>

    <div class="post-header">
        <div>
            <a href="#">
                <img src="../assets/img/favicon.png" alt="avatar" class="imaged w24 rounded me-05">
                iRaffle TV
            </a>
        </div>
        <?= $date ?>
    </div>
    <div class="post-body">
        <p>
            <?= $description ?>
        </p>
        <p>
            <?= $content ?>
        </p>
        <img src="<?= $image ?>" alt="image">
        <h2>
            <?= $extraTitle ?>
        </h2>
        <p>
            <?= $extra ?>
        </p>
    </div>
</div>


<div class="section mt-4">
    <button type="button" class="btn btn-outline-primary btn-block" data-bs-toggle="offcanvas"
        data-bs-target="#actionSheetShare">
        <ion-icon name="share-outline" role="img" class="md hydrated" aria-label="share outline"></ion-icon>
        Compartir Artículo
    </button>
</div>

<div class="divider mt-4 mb-3"></div>
<script>
    var playerInstance = jwplayer("player");
    playerInstance.setup({
        playlist: [
            {
                sources: [
                    {
                        default: false,
                        type: "hls",
                        file: "<?=$video?>",
                        label: "0",
                    },
                ],
            },
        ],
        height: "100%",
        width: "100%",
        aspectratio: "16:9",
        stretching: "bestfit",
        mediaid: "player",
        mute: true,
        autostart: true,
        language: "es",
        logo: {
            file: "https://eduveel1.github.io/baleada/img/iRTVW_PLAYER.png",
            hide: "false",
            position: "top-left"
        }
    });
</script>