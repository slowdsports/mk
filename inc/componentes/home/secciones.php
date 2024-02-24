<div class="section mt-2">
    <div class="row">
        <?php
        $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE tipo='football'");
        $totalGames = mysqli_num_rows($queryQty);
        if ($totalGames > 0) { ?>
            <div class="col-6 col-sm-4 col-md-3 mycard">
                <a href="?p=eventos&tipo=football" tabindex="1">
                    <div class="card product-card">
                        <div class="card-body">
                            <img width="48px" height="48px" src="../assets/img/futbol.svg" class="image"
                                alt="product image">
                            <h2 class="title text-center">Fútbol</h2>
                            <p class="text text-center">PREMIUM</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>

        <?php
        $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE tipo='basketball'");
        $totalGames = mysqli_num_rows($queryQty);
        if ($totalGames > 0) { ?>
            <div class="col-6 col-sm-4 col-md-3 mycard">
                <a href="?p=eventos&tipo=basketball" tabindex="2">
                    <div class="card product-card">
                        <div class="card-body">
                            <img width="48px" height="48px" src="../assets/img/basket.svg" class="image"
                                alt="product image">
                            <h2 class="title text-center">Basket</h2>
                            <p class="text text-center">GRATIS</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>

        <?php
        $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE tipo='american-football'");
        $totalGames = mysqli_num_rows($queryQty);
        if ($totalGames > 0) { ?>
            <div class="col-6 col-sm-4 col-md-3 mycard">
                <a href="?p=eventos&tipo=american-football&liga=9464">
                    <div class="card product-card">
                        <div class="card-body">
                            <img width="48px" height="48px" src="../assets/img/nfl.svg" class="image" alt="product image">
                            <h2 class="title text-center">NFL</h2>
                            <p class="text text-center">GRATIS</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>

        <div class="col-6 col-sm-4 col-md-3 mycard">
            <a href="?p=tv">
                <div class="card product-card">
                    <div class="card-body">
                        <img width="48px" height="48px" src="../assets/img/tv.svg" class="image" alt="product image">
                        <h2 class="title text-center">TV</h2>
                        <p class="text text-center">PREMIUM</p>
                    </div>
                </div>
            </a>
        </div>

        <div class="col-6 col-sm-4 col-md-3 mycard">
            <a href="?p=radio">
                <div class="card product-card">
                    <div class="card-body">
                        <img width="48px" height="48px" src="../assets/img/radio.svg" class="image" alt="product image">
                        <h2 class="title text-center">Radio</h2>
                        <p class="text text-center">GRATIS</p>
                    </div>
                </div>
            </a>
        </div>

        <?php
        $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE tipo='baseball'");
        $totalGames = mysqli_num_rows($queryQty);
        if ($totalGames > 0) { ?>
            <div class="col-6 col-sm-4 col-md-3 mycard">
                <a href="?p=eventos&tipo=baseball">
                    <div class="card product-card">
                        <div class="card-body">
                            <img width="48px" height="48px" src="../assets/img/mlb.svg" class="image" alt="product image">
                            <h2 class="title text-center">Baseball</h2>
                            <p class="text text-center">GRATIS</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>

        <?php
        $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE tipo='ufc'");
        $totalGames = mysqli_num_rows($queryQty);
        if ($totalGames > 0) { ?>
            <div class="col-6 col-sm-4 col-md-3 mycard">
                <a href="?p=eventos&tipo=ufc">
                    <div class="card product-card">
                        <div class="card-body">
                            <img width="48px" height="48px" src="../assets/img/ufc.svg" class="image" alt="product image">
                            <h2 class="title text-center">UFC</h2>
                            <p class="text text-center">GRATIS</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>

        <?php
        $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE tipo='f1'");
        $totalGames = mysqli_num_rows($queryQty);
        if ($totalGames > 0) { ?>
            <div class="col-6 col-sm-4 col-md-3 mycard">
                <a href="?p=eventos&tipo=f1">
                    <div class="card product-card">
                        <div class="card-body">
                            <img width="48px" height="48px" src="../assets/img/formula1.svg" class="image"
                                alt="product image">
                            <h2 class="title text-center">F1</h2>
                            <p class="text text-center">GRATIS</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>

        <?php
        $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE tipo='motogp'");
        $totalGames = mysqli_num_rows($queryQty);
        if ($totalGames > 0) { ?>
            <div class="col-6 col-sm-4 col-md-3 mycard">
                <a href="?p=eventos&tipo=motogp">
                    <div class="card product-card">
                        <div class="card-body">
                            <img width="48px" height="48px" src="../assets/img/motogp.svg" class="image"
                                alt="product image">
                            <h2 class="title text-center">MotoGP</h2>
                            <p class="text text-center">GRATIS</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>

        <?php
        $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE tipo='tennis'");
        $totalGames = mysqli_num_rows($queryQty);
        if ($totalGames > 0) { ?>
            <div class="col-6 col-sm-4 col-md-3 mycard">
                <a href="?p=eventos&tipo=tennis">
                    <div class="card product-card">
                        <div class="card-body">
                            <img width="48px" height="48px" src="../assets/img/tenis.svg" class="image" alt="product image">
                            <h2 class="title text-center">Tennis</h2>
                            <p class="text text-center">PREMIUM</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>

        <?php
        $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE tipo='ice-hockey'");
        $totalGames = mysqli_num_rows($queryQty);
        if ($totalGames > 0) { ?>
            <div class="col-6 col-sm-4 col-md-3 mycard">
                <a href="?p=eventos&tipo=ice-hockey&liga=234">
                    <div class="card product-card">
                        <div class="card-body">
                            <img width="48px" height="48px" src="../assets/img/nhl.svg" class="image" alt="product image">
                            <h2 class="title text-center">NHL</h2>
                            <p class="text text-center">GRATIS</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>

        <?php
        $queryQty = mysqli_query($conn, "SELECT * FROM partidos WHERE tipo='handball'");
        $totalGames = mysqli_num_rows($queryQty);
        if ($totalGames > 0) { ?>
            <div class="col-6 col-sm-4 col-md-3 mycard">
                <a href="?p=eventos&tipo=handball">
                    <div class="card product-card">
                        <div class="card-body">
                            <img width="48px" height="48px" src="../assets/img/balonmano.svg" class="image"
                                alt="product image">
                            <h2 class="title text-center">Balonmano</h2>
                            <p class="text text-center">GRATIS</p>
                        </div>
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>