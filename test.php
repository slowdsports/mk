<style>
    .embed-responsive {
        border-radius: 8px;
    }
</style>
<div class="section mt-2">
    <div class="card">
        <div class="embed-responsive embed-responsive-16by9" id="playerContainer">
            <iframe id='embed-player' class='embed-responsive-item' width='100%' height='100%' frameborder='0'
                scrolling='no' allowfullscreen allow-encrypted-media src='inc/reproductor/hls.php?c=5&f=32'></iframe>
        </div>
        <div class="card-body">
            <div class="row">
                <!-- Info Canal -->
                <div class="col-6 d-flex flex-column">
                    <h6 class="card-subtitle">Categoría del canal</h6>
                    <h5 class="card-title">Título del canal</h5>
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
                            <ion-icon name="thumbs-down" role="img" class="md hydrated" aria-label="thumbs down"></ion-icon>
                            <span id="dislike-count-<?= $canalAlt ?>" class="badge bg-danger shadow-primary mt-n1 ms-3">
                                <?= $dislikeCount ?>
                            </span>
                        </button>
                    </div>
                    <!-- AJAX -->
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                    <script src="inc/componentes/like.js"></script>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById("appCapsule").removeAttribute("container");;
</script>