<div class="section mt-2">
    <div class="">
        <div id="channelsList" class="row">
            <!-- Más canales IPTV -->
            <div class="col-12 mycard 11">
                <a href="?p=iptv">
                    <div class="card product-card liga-card canal-card">
                        <div class="card-body">
                            <center>
                                <img width="48px" src="https://i.ibb.co/w0qg9JF/trans.png"
                                    style="background-image: url('../assets/img/tv.svg'); background-size: contain; background-repeat: no-repeat;"
                                    class="image" alt="product image">
                                <h2 class="title text-center">
                                    Canales TDT </h2>
                            </center>
                        </div>
                    </div>
                </a>
            </div>
            <?php
            function mostrarCanalesFromJson($jsonData, $categoriaFiltro = null, $limit = null)
            {
                $canales = json_decode($jsonData, true);
                $count = 0;
                foreach ($canales as $canal) {
                    if ($categoriaFiltro && $canal['categoriaNombre'] !== $categoriaFiltro) {
                        continue;
                    }

                    // Verificar el límite de canales a mostrar
                    if ($limit && $count >= $limit) {
                        break;
                    }

                    $canalId = $canal['canal'];
                    $fuenteId = $canal['fuenteId'];
                    $canalImg = $canal['canalImg'];
                    $canalNombre = $canal['fuenteNombre'];
                    $canalCategoria = $canal['canalCategoria'];
                    $pais = $canal['paisNombre'];
                    ?>
                    <div class="col-6 col-md-4 col-lg-3 col-xl-2 mycard <?= $canalCategoria ?>"
                        data-category="<?= $canalCategoria ?>">
                        <a href="?p=tv&c=<?= $canalId ?>&f=<?= $fuenteId ?>">
                            <div class="card product-card liga-card canal-card">
                                <div class="card-body">
                                    <center>
                                    <h6 class="card-subtitle">
                                        <i class="flag <?= $pais ?>"></i>
                                        (<?= strtoupper($pais) ?>)
                                    </h6>
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
                    <?php
                    $count++;
                }
            }
            // Sección de Canales
            // Leer datos desde el archivo JSON
            $jsonData = file_get_contents('../canales.json');

            // Sección de Canales
            if (isset($_GET['p']) && $_GET['p'] == "tv") {
                mostrarCanalesFromJson($jsonData);
            } else {
                mostrarCanalesFromJson($jsonData, 'Deportes', 18);
            }
            ?>
        </div>
    </div>