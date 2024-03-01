<!-- Recomendados Slider -->
<div class="section full mt-3 mb-3">
    <div class="carousel-multiple owl-carousel owl-theme">
        <?php
        // Obtener y tratar fecha
        date_default_timezone_set('Europe/Madrid');
        $date = date('Y/m/d H:i:s');
        $mm_0 = substr($date, 5, 2);
        $dd_0 = substr($date, 8, 2);
        $hh_0 = substr($date, 11, 2);
        $m_0 = substr($date, 14, 2);
        $partidos = mysqli_query($conn, "SELECT p.id, p.local, p.visitante, p.liga, p.fecha_hora, p.tipo, p.starp, p.vix, 
            e1.equipoId AS id_local, e1.equipoNombre AS equipo_local,
            e2.equipoId AS id_visitante, e2.equipoNombre AS equipo_visitante,
            e3.ligaNombre AS partido_liga,
            f1.fuenteId AS id_canal1, f1.fuenteNombre AS nombre_canal1, f1.canal AS canal_canal1,
            p1.paisNombre AS pais_canal1,
            f2.fuenteId AS id_canal2, f2.fuenteNombre AS nombre_canal2, f2.canal AS canal_canal2,
            p2.paisNombre AS pais_canal2,
            f3.fuenteId AS id_canal3, f3.fuenteNombre AS nombre_canal3, f3.canal AS canal_canal3,
            p3.paisNombre AS pais_canal3,
            f4.fuenteId AS id_canal4, f4.fuenteNombre AS nombre_canal4, f4.canal AS canal_canal4,
            p4.paisNombre AS pais_canal4,
            f5.fuenteId AS id_canal5, f5.fuenteNombre AS nombre_canal5, f5.canal AS canal_canal5,
            p5.paisNombre AS pais_canal5,
            f6.fuenteId AS id_canal6, f6.fuenteNombre AS nombre_canal6, f6.canal AS canal_canal6,
            p6.paisNombre AS pais_canal6,
            f7.fuenteId AS id_canal7, f7.fuenteNombre AS nombre_canal7, f7.canal AS canal_canal7,
            p7.paisNombre AS pais_canal7,
            f8.fuenteId AS id_canal8, f8.fuenteNombre AS nombre_canal8, f8.canal AS canal_canal8,
            p8.paisNombre AS pais_canal8,
            f9.fuenteId AS id_canal9, f9.fuenteNombre AS nombre_canal9, f9.canal AS canal_canal9,
            p9.paisNombre AS pais_canal9,
            f10.fuenteId AS id_canal10, f10.fuenteNombre AS nombre_canal10, f10.canal AS canal_canal10,
            p10.paisNombre AS pais_canal10
            FROM partidos p
            JOIN equipos e1 ON p.local = e1.equipoId
            JOIN equipos e2 ON p.visitante = e2.equipoId
            JOIN ligas e3 ON p.liga = e3.ligaId
            LEFT JOIN fuentes f1 ON p.canal1 = f1.fuenteId
            LEFT JOIN paises p1 ON f1.pais = p1.paisId
            LEFT JOIN fuentes f2 ON p.canal2 = f2.fuenteId
            LEFT JOIN paises p2 ON f2.pais = p2.paisId
            LEFT JOIN fuentes f3 ON p.canal3 = f3.fuenteId
            LEFT JOIN paises p3 ON f3.pais = p3.paisId
            LEFT JOIN fuentes f4 ON p.canal4 = f4.fuenteId
            LEFT JOIN paises p4 ON f4.pais = p4.paisId
            LEFT JOIN fuentes f5 ON p.canal5 = f5.fuenteId
            LEFT JOIN paises p5 ON f5.pais = p5.paisId
            LEFT JOIN fuentes f6 ON p.canal6 = f6.fuenteId
            LEFT JOIN paises p6 ON f6.pais = p6.paisId
            LEFT JOIN fuentes f7 ON p.canal7 = f7.fuenteId
            LEFT JOIN paises p7 ON f7.pais = p7.paisId
            LEFT JOIN fuentes f8 ON p.canal8 = f8.fuenteId
            LEFT JOIN paises p8 ON f8.pais = p8.paisId
            LEFT JOIN fuentes f9 ON p.canal9 = f9.fuenteId
            LEFT JOIN paises p9 ON f9.pais = p9.paisId
            LEFT JOIN fuentes f10 ON p.canal10 = f10.fuenteId
            LEFT JOIN paises p10 ON f10.pais = p10.paisId
            ORDER BY
            fecha_hora ASC
            ");
        while ($result = mysqli_fetch_array($partidos)):
            // Teams
            $index = $result['id'];
            $local = $result['equipo_local'];
            $local_id = $result['id_local'];
            $visitante = $result['equipo_visitante'];
            $visitante_id = $result['id_visitante'];
            $liga_id = $result['liga'];
            $liga = $result['partido_liga'];
            $fecha = $result['fecha_hora'];
            $hora = substr($fecha, 11, 5);
            $tipo = $result['tipo'];
            $starp = $result['starp'];
            $vix = $result['vix'];
            // Obtener y tratar fecha de JSON
            $mm_1 = substr($fecha, 5, 2);
            $dd_1 = substr($fecha, 8, 2);
            $hh_1 = substr($fecha, 11, 2);
            $m_1 = substr($fecha, 14, 2);
            // Calculamos que los juegos sean para hoy y los mostramos
            if ($mm_0 === $mm_1):
                if ($dd_0 === $dd_1):
                    // Canales
                    $canal1_id = $result['id_canal1'];
                    $canal1_nombre = $result['nombre_canal1'];

                    $canal2_id = $result['id_canal2'];
                    $canal2_nombre = $result['nombre_canal2'];

                    $canal3_id = $result['id_canal3'];
                    $canal3_nombre = $result['nombre_canal3'];

                    $canal4_id = $result['id_canal4'];
                    $canal4_nombre = $result['nombre_canal4'];

                    $canal5_id = $result['id_canal5'];
                    $canal5_nombre = $result['nombre_canal5'];

                    $canal6_id = $result['id_canal6'];
                    $canal6_nombre = $result['nombre_canal6'];

                    $canal7_id = $result['id_canal7'];
                    $canal7_nombre = $result['nombre_canal7'];

                    $canal8_id = $result['id_canal8'];
                    $canal8_nombre = $result['nombre_canal8'];

                    $canal9_id = $result['id_canal9'];
                    $canal9_nombre = $result['nombre_canal9'];

                    $canal10_id = $result['id_canal10'];
                    $canal10_nombre = $result['nombre_canal10'];
                    ?>
                    <a href="?p=eventos&tipo=<?= $tipo ?>&liga=<?= $liga_id ?>&juego=<?= $index ?>">
                        <div class="item">
                            <div class="card">
                                <div class="mini-league">
                                    <img width="25px"
                                        src="../assets/img/ligas/sf/<?= $liga_id ?>.png" alt="">
                                    <h5>
                                        <?= $liga ?>
                                    </h5>
                                </div>
                                <div class="main-event">
                                    <div class="match">
                                        <div class="team">
                                            <img src="../assets/img/equipos/sf/<?= $local_id ?>.png" class="image"
                                                alt="image">
                                            <h4><?= ucfirst($local) ?></h4>
                                        </div>
                                        <h6 class="vs">vs</h6>
                                        <div class="team">
                                            <img src="../assets/img/equipos/sf/<?= $visitante_id ?>.png"
                                                class="image" alt="image">
                                            <h4><?= ucfirst($visitante) ?></h4>
                                        </div>
                                    </div>
                                </div>
                                <p class="lead counter cntdwn-<?= $index ?>"></p>
                                <script>
                                    var yyyy = 2024;
                                    var mm = '<?= $mm_1 - 1 ?>';
                                    var dd = '<?= $dd_1 ?>';
                                    var hh = '<?= $hh_1 ?>';
                                    var m = '<?= $m_1 ?>';

                                    var textLive = "<p class='live-text'>En Vivo <ion-icon class='faa-flash animated' name='ellipse'></ion-icon></p>";
                                    var textEnd = "Finalizó";



                                    // Set the date we're counting down to
                                    // Year, Month ( 0 for January ), Day, Hour, Minute, Second, , Milliseconds
                                    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
                                    //::::::::::::                                       ::::::::::::
                                    //::::::::::::              12:00 AM                  ::::::::::::
                                    //::::::::::::                                       ::::::::::::
                                    //:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::
                                    //                                              (AAAA, MM, DD, HH, MM, SS));
                                    var countDownDate<?= $index ?> = new Date(Date.UTC(yyyy, mm, dd, hh, m, 00));

                                    // Update the count down every 1 second
                                    var x<?= $index ?> = setInterval(function () {

                                        // Get todays date and time
                                        var now<?= $index ?> = new Date().getTime();

                                        // Find the distance between now an the count down date
                                        // GMT/UTC Adjustment at the end of the function. 0 = GMT/UTC+0; 1 = GMT/UTC+1.
                                        var distance<?= $index ?> = countDownDate<?= $index ?> - now<?= $index ?> - (3600000 * 0);

                                        // Time calculations for days, hours, minutes and seconds
                                        var days<?= $index ?> = Math.floor(distance<?= $index ?> / (1000 * 60 * 60 * 24));
                                        var hours<?= $index ?> = Math.floor((distance<?= $index ?> % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                                        var minutes<?= $index ?> = Math.floor((distance<?= $index ?> % (1000 * 60 * 60)) / (1000 * 60));
                                        var seconds<?= $index ?> = Math.floor((distance<?= $index ?> % (1000 * 60)) / 1000);

                                        // Output the result in an element with id="demo"
                                        if (days<?= $index ?> > 0) {
                                            for (const ele of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                                ele.innerHTML = (days<?= $index ?> + "d " + hours<?= $index ?> + "h "
                                                    + minutes<?= $index ?> + "m " + seconds<?= $index ?> + "s")
                                            }
                                        } else if (hours<?= $index ?> == 0) {
                                            for (const ele of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                                ele.innerHTML = (minutes<?= $index ?> + "m " + seconds<?= $index ?> + "s")
                                            }
                                        } else if (minutes<?= $index ?> == 0) {
                                            for (const ele of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                                ele.innerHTML = (seconds<?= $index ?> + "s")
                                            }
                                        } else {
                                            for (const ele of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                                ele.innerHTML = (hours<?= $index ?> + "h "
                                                    + minutes<?= $index ?> + "m " + seconds<?= $index ?> + "s")
                                            }
                                        }
                                        // If the count down is over, write some text
                                        if (distance<?= $index ?> < 0) {
                                            for (const ele of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                                ele.innerHTML = textLive;
                                            }
                                            if (distance<?= $index ?> + 10800000 < 0) {
                                                for (const allEllements of document.getElementsByClassName("cntdwn-<?= $index ?>")) {
                                                    allEllements.innerHTML = textEnd;
                                                }
                                            }
                                        }
                                    }, //1000
                                        1000);
                                </script>
                            </div>
                        </div>
                    </a>
                <?php endif; endif; endwhile; ?>
    </div>
</div>
<!-- End Slider -->