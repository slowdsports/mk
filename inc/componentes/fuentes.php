<div class="dropdown">
    <button class="btn btn-secondary dropdown-toggle show" type="button" data-bs-toggle="dropdown" aria-expanded="true">
        Example
    </button>
    <div class="dropdown-menu show"
        style="position: absolute; inset: 0px auto auto 0px; margin: 0px; transform: translate(0px, 42px);"
        data-popper-placement="bottom-start">
        <a class="dropdown-item" href="#aaaa">Copy</a>
        <a class="dropdown-item" href="#aaaaaaaaaa">Save</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="#">Delete</a>
    </div>
</div>


<div class="col-6">
    <div class="d-flex justify-content-start">
        <!-- Dropend -->
        <div class="btn-group dropdown">
            <button type="button" class="btn btn-outline-secondary dropdown-toggle" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-loader-circle fs-5 lh-1 me-1"></i>
                Fuente
            </button>
            <div class="dropdown-menu mx-1">
                <a href="javascript:void(0)" class="dropdown-item">
                    Fuentes:
                    <?= $canalNombre ?>
                </a>
                <hr class="dropdown-divider">
                <?php
                $fuentes = mysqli_query($conn, "SELECT * FROM fuentes
                INNER JOIN paises ON fuentes.pais = paises.paisId
                WHERE canal = $canal");
                while ($result = mysqli_fetch_assoc($fuentes)):
                    $fuenteId = $result['fuenteId'];
                    $fuenteNombre = $result['fuenteNombre'];
                    $canalId = $result['canal'];
                    $paisNombre = $result['paisNombre'];
                    // Conteo
                    $totalFuentes = mysqli_num_rows($fuentes);
                    if ($totalFuentes > 0):
                        ?>
                        <a href="?p=replay&c=<?= $canalId ?>&f=<?= $fuenteId ?>"
                            class="dropdown-item <?= (isset($_GET['f']) && $_GET['f'] == $fuenteId) ? "active" : ""; ?>">
                            <i class="flag <?= $paisNombre ?>"></i>
                            <?= $fuenteNombre ?>
                        </a>
                    <?php endif; endwhile; ?>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>