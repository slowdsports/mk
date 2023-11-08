<?php  if (isset($country) && $country == "ES" || strpos($timezone, "Europe")) { $proxy = "https://slowdus.herokuapp.com/"; echo "Estás usando proxy en" . $country . " " . $timezone; } else { $proxy = ""; echo "No estás usando proxy en " .$country . " " . $timezone; } ?>
<div class="section mt-2">
    <h2>Star+ <small>Eventos Programados</small></h2>
    <div id="eventos" class="row row-cols-2 row-cols-sm-2 row-cols-lg-3 gx-3 gx-md-4 mt-n2 mt-sm-0">
        <!-- <script src="inc/eventos/star.js"></script> -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                var jsonUrl = "https://corsproxy.io/?https://elcdn.realintic.online/eventos.json";
                var filtroInput = document.getElementById("filtroInput");
                var eventosContainer = document.getElementById("eventos");

                filtroInput.addEventListener("input", function () {
                    var filtro = filtroInput.value.toLowerCase();
                    var tarjetas = eventosContainer.querySelectorAll(".evento");

                    tarjetas.forEach(function (tarjeta) {
                        var titulo = tarjeta.querySelector("h3").textContent.toLowerCase();
                        tarjeta.style.display = titulo.includes(filtro) ? "block" : "none";
                    });
                });

                function procesarURL(url) {
                    if (url.trim() === "#") {
                        return url;
                    }

                    var parteDespreciable = "/embed/eventos/?r=";
                    var urlSinParteDespreciable = url.replace(parteDespreciable, "");
                    var desencriptada = atob(urlSinParteDespreciable);
                    //desencriptada = desencriptada.replace(/https:\/\/\S*\/star_jwp\.html\?get=/, "");
                    //desencriptada = desencriptada.replace(/^https:\/\/cdn\.sfndeportes\.net\/star_wspp\?get=/, "");
                    // Intenta reemplazar el primer regex
                    if (/https:\/\/\S*\/star_jwp\.html\?get=/.test(desencriptada)) {
                        desencriptada = desencriptada.replace(/https:\/\/\S*\/star_jwp\.html\?get=/, "");
                    } else if (/^https:\/\/cdn\.sfndeportes\.net\/star_wspp\?get=/.test(desencriptada)) {
                        // Si el primer regex no coincide, intenta el segundo regex
                        desencriptada = desencriptada.replace(/^https:\/\/cdn\.sfndeportes\.net\/star_wspp\?get=/, "");
                    }
                    //console.log(desencriptada)

                    return desencriptada;
                }

                function encriptarContenido(eventoUrl) {
                    if (eventoUrl.trim() !== "#") {
                        var partes = eventoUrl.split("&");
                        var urlEncriptada = partes
                            .map(function (part) {
                                if (part.startsWith("key=") || part.startsWith("key2=") || part.startsWith("img=")) {
                                    var igualIndex = part.indexOf("=");
                                    var clave = part.substring(0, igualIndex + 1);
                                    var valor = part.substring(igualIndex + 1);

                                    if (clave === "img=") {
                                        return clave + valor;
                                    } else {
                                        return clave + btoa(valor);
                                    }
                                }
                                return part;
                            })
                            .join("&");

                        var partesURL = urlEncriptada.split("&");
                        var proxy = "<?= $proxy ?>";
                        var primeraParte = partesURL[0];
                        console.log(primeraParte)
                        var primeraParteEncriptada = btoa(proxy + primeraParte);
                        console.log(primeraParteEncriptada)
                        urlEncriptada = urlEncriptada.replace(primeraParte, primeraParteEncriptada);
                        console.log(urlEncriptada)

                        return urlEncriptada;
                    }

                    return eventoUrl;
                }

                function crearTarjeta(evento) {
                    var card = document.createElement("div");
                    card.className = "col-lg-3 col-md-4 col-sm-6 evento";
                    var eventoUrl = procesarURL(evento.url);
                    var urlEncriptada = encriptarContenido(eventoUrl);

                    var contenidoExtra = "";
                    var contenidoIcon = "";

                    if (evento.status === "EN VIVO") {
                        contenidoExtra = '<span class="badge bg-success position-absolute top-0 start-0 zindex-2 mt-3 ms-3">En Vivo</span>';
                        contenidoIcon = "bx bxs-circle bx-flashing";
                    } else if (evento.status === "FINALIZADO") {
                        contenidoExtra = '<span class="badge bg-danger position-absolute top-0 start-0 zindex-2 mt-3 ms-3">Finalizado</span>';
                        contenidoIcon = "bx bx-timer";
                    } else {
                        contenidoExtra = `<span class="badge bg-info position-absolute top-0 start-0 zindex-2 mt-3 ms-3">${evento.status}</span>`;
                        contenidoIcon = "bx bxs-time";
                    }

                    var $remaining = "";

                    if (evento.status.includes(":")) {
                        var eventTime = new Date();
                        var eventParts = evento.status.split(":");
                        eventTime.setHours(parseInt(eventParts[0], 10));
                        eventTime.setMinutes(parseInt(eventParts[1], 10));
                        eventTime.setSeconds(0);

                        function updateCountdown() {
                            var now = new Date();
                            var timeDiff = eventTime - now;
                            var hours = Math.floor(timeDiff / (1000 * 60 * 60));
                            var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
                            card.innerHTML = `
                <article class="card border-primary card-hover h-100 border-0 shadow-sm card-hover">
                    <div class="position-relative">
                        <a href="?p=tv&r=${urlEncriptada}&title=${evento.title}" class="d-block position-absolute w-100 h-100 top-0 start-0" aria-label="${evento.title}">
                        </a>
                            ${contenidoExtra}
                        <img src="https://prod-ripcut-delivery.disney-plus.net/v1/variant/star/${evento.img}/scale?width=900&aspectRatio=1.78&format=jpeg" class="card-img-top" alt="${evento.league}">
                    </div>
                    <div class="card-body pb-3">
                        <h3 class="h5 mb-2">
                            <a href="?p=tv&r=${urlEncriptada}&title=${evento.title}">
                                ${evento.title}
                            </a>
                        </h3>
                        <p class="fs-sm mb-2">${evento.league}</p>
                    </div>
                    <div class="card-footer d-flex align-items-center fs-sm text-muted py-4">
                        <div class="d-flex align-items-center me-4">
                            <i class="${contenidoIcon} fs-xl me-1"></i>
                                ${hours}h ${minutes}m ${seconds}s
                        </div>
                    </div>
                </article>`;
                            setTimeout(updateCountdown, 1000);
                        }

                        updateCountdown();
                    } else {
                        $remaining = `${evento.status}`;
                    }

                    card.innerHTML = `
        <article class="card border-primary card-hover h-100 border-0 shadow-sm card-hover">
            <div class="position-relative">
                <a href="?p=tv&r=${urlEncriptada}&title=${evento.title}" class="d-block position-absolute w-100 h-100 top-0 start-0" aria-label="Course link">
                </a>
                    ${contenidoExtra}
                <img src="https://prod-ripcut-delivery.disney-plus.net/v1/variant/star/${evento.img}/scale?width=900&aspectRatio=1.78&format=jpeg" class="card-img-top" alt="${evento.league}">
            </div>
            <div class="card-body pb-3">
                <h3 class="h5 mb-2">
                    <a href="?p=tv&r=${urlEncriptada}&title=${evento.title}">${evento.title}</a>
                </h3>
                <p class="fs-sm mb-2">${evento.league}</p>
            </div>
            <div class="card-footer d-flex align-items-center fs-sm text-muted py-4">
                <div class="d-flex align-items-center me-4">
                    <i class="${contenidoIcon} fs-xl me-1"></i>
                        ${evento.status}
                </div>
            </div>
        </article>`;

                    return card;
                }

                fetch(jsonUrl)
                    .then((response) => response.json())
                    .then((data) => {
                        data.forEach((evento) => {
                            var tarjeta = crearTarjeta(evento);
                            eventosContainer.appendChild(tarjeta);
                        });
                    })
                    .catch((error) => {
                        console.error("Error al obtener el JSON:", error);
                    });
            });
        </script>
    </div>
</div>