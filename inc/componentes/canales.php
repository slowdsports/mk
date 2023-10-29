<div class="section mt-2">
    <div class="">
        <div id="channelsList" class="row">
            <?php
            function mostrarCanales($query)
            {
                global $conn;
                $channels = mysqli_query($conn, $query);
                while ($result = mysqli_fetch_assoc($channels)) {
                    $canalId = $result['canalId'];
                    $fuenteId = $result['fuenteId'];
                    $canalImg = $result['canalImg'];
                    $canalNombre = $result['fuenteNombre'];
                    $canalCategoria = $result['canalCategoria'];
                    ?>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2 mycard <?= $canalCategoria ?>" data-category="<?= $canalCategoria ?>">
                        <a href="?p=tv&c=<?= $canalId ?>&f=<?= $fuenteId ?>">
                            <div class="card product-card liga-card canal-card">
                                <div class="card-body">
                                    <center>
                                        <img width="48px" src="https://i.ibb.co/w0qg9JF/trans.png"
                                            style="background-image: url('../assets/img/canales/<?= $canalImg ?>.png'); background-size: contain; background-repeat: no-repeat;"
                                            class="image" alt="product image" />
                                        <h2 class="title text-center">
                                            <?= $canalNombre ?>
                                        </h2>
                                    </center>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php }
            } ?>
    <?php
    // Sección de Canales
    if (isset($_GET['p']) && $_GET['p'] == "tv") {
        $query = "SELECT canales.canalId, canales.canalNombre, canales.epg, canales.canalImg, canales.canalCategoria, fuentes.fuenteId, fuentes.fuenteNombre, fuentes.canalUrl, fuentes.key, fuentes.key2, fuentes.pais, fuentes.tipo, categorias.categoriaNombre
        FROM canales
        INNER JOIN fuentes ON canales.canalId = fuentes.canal
        INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId";
        mostrarCanales($query);
    } else {
        $query = "SELECT canales.canalId, canales.canalNombre, canales.epg, canales.canalImg, canales.canalCategoria, fuentes.fuenteId, fuentes.fuenteNombre, fuentes.canalUrl, fuentes.key, fuentes.key2, fuentes.pais, fuentes.tipo, categorias.categoriaNombre
        FROM canales
        INNER JOIN fuentes ON canales.canalId = fuentes.canal
        INNER JOIN categorias ON canales.canalCategoria = categorias.categoriaId
        WHERE canales.canalCategoria = 11
        ORDER BY RAND()
        LIMIT 18";
        mostrarCanales($query);
    }
    ?>
    </div>
</div>