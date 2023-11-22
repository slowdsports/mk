<?php
if (isset($country) && $country == "ES" || strpos($timezone, "rope")) {
    $proxy = "https://slowdus.herokuapp.com/";
    $_SESSION['message'] = "Estás usando proxy en " . $timezone . ". Si crees que es un error, contáctanos mediante el chat";
    $_SESSION['color'] = "28a745";
} else {
    $proxy = "";
    $_SESSION['message'] = "No estás usando proxy en " . $timezone . ". Si crees que es un error, contáctanos mediante el chat";
    $_SESSION['color'] = "28a745";
}
?>
<div class="section full mt-2 mb-2">
    <h2>Vix+ <small>Eventos Programados</small></h2>
    <div class="wide-block pt-2 pb-2">
        <div id="eventos" class="row">
            <!-- <script src="inc/eventos/star.js"></script> -->
            <script>
                document.addEventListener("DOMContentLoaded", function () {
                    // Eliminar container
                    var basuraContain = document.getElementById('appCapsule');
                    basuraContain.classList.remove("container");
                    var jsonUrl = "https://corsproxy.io/?https://futbolplaytvhd.com/vix.json";
                    var eventosContainer = document.getElementById("eventos");

                    // Sortear
                    function compararStatus(a, b) {
                        var statusOrden = {
                            "EN VIVO": 0,
                            "FINALIZADO": 2
                        };
                        if (a.status in statusOrden && b.status in statusOrden) {
                            return statusOrden[a.status] - statusOrden[b.status];
                        } else if (a.status in statusOrden) {
                            return -1;
                        } else if (b.status in statusOrden) {
                            return 1;
                        } else if (a.status.match(/^\d{2}:\d{2}$/) && b.status.match(/^\d{2}:\d{2}$/)) {
                            // Ambos están en formato HH:MM
                            var [aHours, aMinutes] = a.status.split(':').map(Number);
                            var [bHours, bMinutes] = b.status.split(':').map(Number);
                            if (aHours !== bHours) {
                                return aHours - bHours;
                            } else {
                                return aMinutes - bMinutes;
                            }
                        } else {
                            return 0;
                        }
                    }

                    function procesarURL(url) {
                        if (url.trim() === "#") {
                            return url;
                        }

                        var parteDespreciable = "/embed/eventos/?r=";
                        var urlSinParteDespreciable = url.replace(parteDespreciable, "");
                        var desencriptada = atob(urlSinParteDespreciable);
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
                            var primeraParteEncriptada = btoa(primeraParte);
                            urlEncriptada = urlEncriptada.replace(primeraParte, primeraParteEncriptada);
                            console.log(urlEncriptada)
                            return urlEncriptada;
                        }
                        return eventoUrl;
                    }

                    function crearTarjeta(evento) {
                        var card = document.createElement("div");
                        card.className = "col-6 col-sm-4 col-md-3 evento";
                        var eventoUrl = procesarURL(evento.url);
                        var urlEncriptada = encriptarContenido(eventoUrl);

                        var contenidoExtra = "";
                        var contenidoIcon = "";
                        var contenidoFlash = "";

                        if (evento.status === "EN VIVO") {
                            contenidoExtra = 'En Vivo';
                            contenidoIcon = "ellipse";
                            contenidoFlash = "faa-flash animated";
                            contenidoColor = "light live-text";
                        } else if (evento.status === "FINALIZADO") {
                            contenidoExtra = 'Finalizado';
                            contenidoIcon = "time-outline";
                            contenidoColor = "primary";
                        } else {
                            contenidoExtra = `${evento.status}`;
                            contenidoIcon = "hourglass-outline";
                            contenidoColor = "success";
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
                                <a href="?p=tv&evento&ifr=${urlEncriptada}&title=${evento.title}" aria-label="${evento.title}">
                                    <div class="card product-card">
                                        <div class="card-body">
                                            <img src="${evento.img}" class="image" alt="${evento.league}">
                                            <h2 class="title">
                                                ${evento.title}
                                            </h2>
                                            <div class="price">
                                                <ion-icon class='${contenidoFlash}' name='${contenidoIcon}'></ion-icon>
                                                ${hours}h ${minutes}m ${seconds}s
                                            </div>
                                            <a href="?p=tv&evento&ifr=${urlEncriptada}&title=${evento.title}" aria-label="${evento.league}" class="btn btn-sm btn-${contenidoColor} btn-block">
                                                ${contenidoExtra}
                                            </a>
                                        </div>
                                    </div>
                                </a>`;
                                setTimeout(updateCountdown, 1000);
                            }

                            updateCountdown();
                        } else {
                            $remaining = `${evento.status}`;
                        }

                        card.innerHTML = `
                        <a href="?p=tv&evento&ifr=${urlEncriptada}&title=${evento.title}" aria-label="${evento.league}">                        
                            <div class="card product-card">
                                <div class="card-body">
                                    <img src="${evento.img}" class="image" alt="${evento.league}">
                                    <h2 class="title">
                                        ${evento.title}
                                    </h2>
                                    <p class="text">
                                        ${evento.league}
                                    </p>
                                    <a href="?p=tv&evento&ifr=${urlEncriptada}&title=${evento.title}" aria-label="${evento.league}" class="btn btn-sm btn-${contenidoColor} btn-block">
                                        <ion-icon class='${contenidoFlash}' name='${contenidoIcon}'></ion-icon>
                                        ${evento.status}
                                    </a>
                                </div>
                            </div>
                        </a>`;

                        return card;
                    }

                    fetch(jsonUrl)
                        .then((response) => response.json())
                        .then((data) => {
                            data.sort(compararStatus);
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
</div>