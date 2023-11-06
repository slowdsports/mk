<div class="header-large-title">
    <h1 class="title">
        <?= (isset($_COOKIE['usuario_nombre'])) ? ucfirst($_COOKIE['usuario_nombre']) : "Invitado" ?>
    </h1>
    <h4 class="subtitle">
        <?= (isset($_COOKIE['usuario_nombre'])) ? "¡Qué bueno mirarte nuevamente!" : "¡Bienvenido a iRaffle TV!" ?>
    </h4>
</div>
<!-- Theme Toggle -->
<div class="section mt-3 mb-3">
    <div class="card">
        <div class="card-body d-flex justify-content-between align-items-end">
            <div>
                <h6 class="card-subtitle">¡Novedad!</h6>
                <h5 class="card-title mb-0 d-flex align-items-center justify-content-between">
                    Modo Oscuro
                </h5>
            </div>
            <div class="custom-control custom-switch">
                <input type="checkbox" class="custom-control-input dark-mode-switch" id="darkmodeswitch">
                <label class="custom-control-label" for="darkmodeswitch"></label>
            </div>

        </div>
    </div>
</div>
<!-- Slider -->
<?php include('inc/componentes/agenda/slider.php'); ?>
<!-- Secciones -->
<?php include('inc/componentes/home/secciones.php'); ?>
