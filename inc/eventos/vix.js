document.addEventListener("DOMContentLoaded", () => {
    const jsonUrl = "https://corsproxy.io/?https://librefutboltv.com/vix-plus/eventos.json";
    const filtroInput = document.getElementById("filtroInput");
    const eventosContainer = document.getElementById("eventos");

    filtroInput.addEventListener("input", () => {
        const filtro = filtroInput.value.toLowerCase();
        const tarjetas = eventosContainer.querySelectorAll(".evento");

        tarjetas.forEach((tarjeta) => {
            const titulo = tarjeta.querySelector("h3").textContent.toLowerCase();
            tarjeta.style.display = titulo.includes(filtro) ? "block" : "none";
        });
    });

    // Desencriptar y modificar la URL del evento
    function procesarURL(url) {
        // Verificar si el URL es "#"
        if (url.trim() === "#") {
            // Devolver el URL original sin modificaciones
            return url;
        }

        // Eliminar la parte inicial de la URL
        var parteDespreciable = "/embed/eventos/?r=";
        var urlSinParteDespreciable = url.replace(parteDespreciable, '');

        // Desencriptar URL en base64
        var desencriptada = atob(urlSinParteDespreciable);

        // Reemplazar parte de la cadena si es necesario
        //desencriptada = desencriptada.replace(/https:\/\/\S*\/star_jwp\.html\?get=/, '');
        url = btoa(desencriptada);
        //desencriptada = desencriptada.replace('oldpart', 'newpart');

        return url;
    }


    fetch(jsonUrl)
        .then((response) => response.json())
        .then((data) => {
            data.forEach((evento) => {
                const card = document.createElement("div");
                card.className = "col pb-1 pb-lg-3 mb-4 evento";
                const eventoUrl = procesarURL(evento.url);
                console.log(eventoUrl)
                // Modificar el contenido de acuerdo al status del evento
                var contenidoExtra = "";
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
                // Verificar si el evento tiene una hora específica
                var $remaining = "";
                if (evento.status.includes(":")) {
                    // Calcular la diferencia de tiempo entre ahora y el evento
                    var eventTime = new Date();
                    var eventParts = evento.status.split(":");
                    eventTime.setHours(parseInt(eventParts[0], 10));
                    eventTime.setMinutes(parseInt(eventParts[1], 10));
                    eventTime.setSeconds(0);
                    // Función para actualizar el contador regresivo
                    function updateCountdown() {
                        var now = new Date();
                        var timeDiff = eventTime - now;
                        // Calcular horas, minutos y segundos
                        var hours = Math.floor(timeDiff / (1000 * 60 * 60));
                        var minutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((timeDiff % (1000 * 60)) / 1000);
                        // Actualizar el contenido del contador regresivo
                        card.innerHTML = `
                        <article class="card border-primary card-hover h-100 border-0 shadow-sm card-hover">
                            <div class="position-relative">
                                <a href="?p=tv&evento&ifr=${eventoUrl}&title=${evento.title}" class="d-block position-absolute w-100 h-100 top-0 start-0" aria-label="${evento.title}">
                                </a>
                                    ${contenidoExtra}
                                <img src="${evento.img}" class="card-img-top" alt="${evento.league}">
                            </div>
                            <div class="card-body pb-3">
                                <h3 class="h5 mb-2">
                                    <a href="?p=tv&evento&ifr=${eventoUrl}&title=${evento.title}">
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
                        // Actualizar el contador cada segundo
                        setTimeout(updateCountdown, 1000);
                    }
                    // Iniciar el contador regresivo
                    updateCountdown();
                } else {
                    // Si no hay hora específica, mostrar el evento sin contador
                    $remaining = `${evento.status}`;
                }

                card.innerHTML = `
                <article class="card border-primary card-hover h-100 border-0 shadow-sm card-hover">
                    <div class="position-relative">
                        <a href="?p=tv&evento&ifr=${eventoUrl}&title=${evento.title}" class="d-block position-absolute w-100 h-100 top-0 start-0" aria-label="Course link">
                        </a>
                            ${contenidoExtra}
                        <img src="${evento.img}" class="card-img-top" alt="${evento.league}">
                    </div>
                    <div class="card-body pb-3">
                        <h3 class="h5 mb-2">
                            <a href="?p=tv&evento&ifr=${eventoUrl}&title=${evento.title}">${evento.title}</a>
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
                eventosContainer.appendChild(card);
            });
        })
        .catch((error) => {
            console.error("Error al obtener el JSON:", error);
        });
});
