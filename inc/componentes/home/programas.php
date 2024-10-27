<style>
    .owl-carousel .owl-stage{display: flex;}
    .item-carousel {
        display: flex;
        flex: 1 0 auto;
        height: 70%;
    }
    .owl-item img {
        max-height: 150px;
    }
    .card {
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        align-items: stretch;
    }
</style>
<div class="section mt-2">
    <div class="section-title mb-1">Programas</div>
    <div class="carousel-multiple owl-carousel owl-theme">
        <?php
        // Cargar el JSON
        $jsonFile = '../inc/componentes/guia/json/programacion.json';
        $jsonData = file_get_contents($jsonFile);
        $data = json_decode($jsonData, true);
        // Verificar si el JSON fue cargado y decodificado correctamente
        if ($data === null) {
            die("Error al cargar o decodificar el archivo JSON.");
        }
        ?>
        <?php foreach ($data as $canal => $programas): ?>
            <?php foreach ($programas as $programa): ?>
                <a href="?p=tv&c=<?= $programa['canal']; ?>&f=<?= $programa['id']; ?>">
                <div class="item-carousel">
                    <div class="card">
                        <img src="<?= $programa['imagen']?>" class="card-img-top" alt="image">
                        <div class="card-body">
                            <h6 class="card-subtitle">
                                <i class="flag <?= htmlspecialchars($programa['flag']); ?>"></i>
                                <?= $programa['nombre']; ?>
                            </h6>
                            <h5 class="card-title">
                                <?= $programa['titulo']?>
                            </h5>
                        </div>
                    </div>
                </div>
            </a>
            <?php endforeach; ?>
        <?php endforeach; ?>
    </div>
</div>