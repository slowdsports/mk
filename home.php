<div class="header-large-title">
    <h1 class="title">
        <?= (isset($_COOKIE['usuario_nombre'])) ? ucfirst($_COOKIE['usuario_nombre']) : "Invitado" ?>
    </h1>
    <h4 class="subtitle">
        <?= (isset($_COOKIE['usuario_nombre'])) ? "¡Qué bueno mirarte nuevamente!" : "¡Bienvenido a iRaffle TV!" ?>
    </h4>
</div>
<!-- Slider -->
<?php include('inc/componentes/agenda/slider.php'); ?>
<!-- Secciones -->
<?php include('inc/componentes/home/secciones.php'); ?>
<!-- Programas -->
<?php include('inc/componentes/home/programas.php'); ?>
