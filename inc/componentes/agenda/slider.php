<!-- Recomendados Slider -->
<div class="section full mt-3 mb-3">
    <div class="section-title mb-1">Agenda</div>
    <div class="carousel-multiple owl-carousel owl-theme">
        <?php
        // Consumir el JSON
        $jsonData = file_get_contents('../inc/componentes/guia/json/partidos.json');
        $partidos = json_decode($jsonData, true);

        // Obtener y tratar fecha actual
        date_default_timezone_set('Europe/Madrid');
        $date = date('Y/m/d H:i:s');
        $mm_0 = substr($date, 5, 2);
        $dd_0 = substr($date, 8, 2);
        // Iterar sobre los partidos del JSON
        foreach ($partidos as $result):
            // Equipos y datos del partido
            $index = $result['id'];
            $local = $result['equipo_local'];
            $local_id = $result['id_local'];
            $visitante = $result['equipo_visitante'];
            $visitante_id = $result['id_visitante'];
            $liga_id = $result['id_liga'];
            $liga = $result['liga'];
            $fecha = $result['fecha_hora'];
            $hora = substr($fecha, 11, 5);
            $tipo = $result['tipo'];
            $starp = $result['starp'];
            $vix = $result['vix'];
            // Obtener y tratar fecha del partido
            $mm_1 = substr($fecha, 5, 2);
            $dd_1 = substr($fecha, 8, 2);
            $hh_1 = substr($fecha, 11, 2);
            $m_1 = substr($fecha, 14, 2);
            // Verificar si el partido es de hoy
            if ($mm_0 === $mm_1 && $dd_0 === $dd_1):
            ?>
            <a href="?p=eventos&tipo=<?= $tipo ?>&liga=<?= $liga_id ?>&juego=<?= $index ?>">
                <div class="item">
                    <div class="card">
                        <div class="mini-league">
                            <img width="25px" src="../assets/img/ligas/sf/<?= $liga_id ?>.png" alt="">
                            <h5>
                                <?= $liga ?>
                            </h5>
                        </div>
                        <div class="main-event">
                            <div class="match">
                                <div class="team">
                                    <img src="../assets/img/equipos/sf/<?= $local_id ?>.png" class="image" alt="image">
                                    <h4>
                                        <?= ucfirst($local) ?>
                                    </h4>
                                </div>
                                <h6 class="vs">vs</h6>
                                <div class="team">
                                    <img src="../assets/img/equipos/sf/<?= $visitante_id ?>.png" class="image" alt="image">
                                    <h4>
                                        <?= ucfirst($visitante) ?>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        <p class="lead counter cntdwn-<?= $index ?>"></p>
                        <?php include('../inc/componentes/timer.php'); ?>
                    </div>
                </div>
            </a>
            <?php endif; endforeach; ?>
        </div>
    </div>
<!-- End Slider -->