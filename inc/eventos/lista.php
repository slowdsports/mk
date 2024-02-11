<div class="header-large-title container">
    <h1 class="title"><?= ucwords($_GET['tipo']) ?></h1>
</div>
<div class="section mt-2">
    <div class="row">
        <div class="col-6 col-sm-4 col-md-3 mycard hidden">
            <a href="../star.php">
                <div class="card product-card liga-card">
                    <div class="card-body">
                        <center>
                            <img width="48px" src="../../../img/canales/starplus.png" class="image" alt="product image" />
                            <h2 class="title text-center">Star +</h2>
                        </center>
                    </div>
                </div>
            </a>
        </div>
        <?php
        $tipo = $_GET['tipo'];
        $ligas = mysqli_query($conn, "SELECT * FROM ligas");
        while ($result = mysqli_fetch_array($ligas)):
            // Cantidad de Juegos
            $liga_id = $result['ligaId'];
            $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE liga = $liga_id AND tipo='$tipo'");
            $totalGames = mysqli_num_rows($queryQty);
            if ($totalGames > 0) { ?>
                <div class="col-6 col-sm-4 col-md-3 mycard show">
                    <a href="?p=eventos&tipo=<?= $_GET['tipo'] ?>&liga=<?= $liga_id ?>">
                        <div class="card product-card liga-card">
                            <div class="card-body">
                                <center>
                                    <img src="https://api.codetabs.com/v1/proxy/?quest=https://api.sofascore.app/api/v1/unique-tournament/<?= $liga_id ?>/image" class="image liga-img" alt="<?= $result['ligaNombre'] ?>" />
                                    <h2 class="title text-center"><?= $result['ligaNombre'] ?></h2>
                                </center>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } else {
            }
        endwhile;?>
    </div>
</div>