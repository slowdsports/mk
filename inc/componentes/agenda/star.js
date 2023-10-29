document.addEventListener("DOMContentLoaded", function () {
    var jsonUrl = "https://corsproxy.io/?https://elcdn.realintic.online/eventos.json";
    var carrusel = document.querySelector('.carousel-multiple .owl-stage');

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
        console.log(desencriptada)

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
            var primeraParte = partesURL[0];
            var primeraParteEncriptada = btoa(primeraParte);
            urlEncriptada = urlEncriptada.replace(primeraParte, primeraParteEncriptada);

            return urlEncriptada;
        }

        return eventoUrl;
    }

    function crearTarjeta(evento) {
        var card = document.createElement("div");
        card.className = "item";
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
                <div class="item">
                    <div class="card">
                        <img src="https://prod-ripcut-delivery.disney-plus.net/v1/variant/star/${evento.img}/scale?width=900&aspectRatio=1.78&format=jpeg" class="card-img-top star-img" alt="image">
                        <div class="card-body pt-2">
                            <h4 class="mb-0">${evento.league}</h4>
                        </div>
                    </div>
                </div>`;
                setTimeout(updateCountdown, 1000);
            }

            updateCountdown();
        } else {
            $remaining = `${evento.status}`;
        }

        card.innerHTML = `
        <div class="item">
                    <div class="card">
                        <img src="https://prod-ripcut-delivery.disney-plus.net/v1/variant/star/${evento.img}/scale?width=900&aspectRatio=1.78&format=jpeg" class="card-img-top star-img" alt="image">
                        <div class="card-body pt-2">
                            <h4 class="mb-0">${evento.league}</h4>
                        </div>
                    </div>
                </div>`;

        return card;
    }

    fetch(jsonUrl)
        .then((response) => response.json())
        .then((data) => {
            data.forEach((evento) => {
                var tarjeta = crearTarjeta(evento);
                var carruselItem = document.createElement('div');
                carruselItem.className = 'owl-item';
                carruselItem.appendChild(tarjeta);
                carrusel.appendChild(carruselItem);
            });
            // Reinicializa el carrusel de Owl Carousel después de agregar las tarjetas
            $('.carousel-multiple').owlCarousel({
                // Configuración de Owl Carousel si es necesario
                // ...
            });
        })
        .catch((error) => {
            console.error("Error al obtener el JSON:", error);
        });
});