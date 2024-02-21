<div class="header-large-title">
    <h1 class="title">
        Vix +
    </h1>
    <h4 class="subtitle">
        <small>Eventos Programados</small>
    </h4>
</div>
<div class="section full mt-2 mb-2">
    <div class="wide-block pt-2 pb-2">
        <div class="row" id="eventos"></div>
        <script>
            function eventos() {
                var x = Math.random().toString(36).substring(7);

                $.ajax({
                    url: "https://corsproxy.io/?url=https://deportestvhd2.com/vix.json?" + x,
                    //url: "datos.json?" + x,
                    type: "get",
                    success: function (arr) {
                        // Ordenar los eventos según su status
                        arr.sort(function (a, b) {
                            if (a.status === "EN VIVO") return -1;
                            if (b.status === "EN VIVO") return 1;

                            // Ordenar por formato "hora:minuto" si es aplicable
                            if (a.status.match(/^\d{1,2}:\d{2}$/) && b.status.match(/^\d{1,2}:\d{2}$/)) {
                                return new Date("1970-01-01T" + a.status) - new Date("1970-01-01T" + b.status);
                            }

                            // Si no es EN VIVO ni formato "hora:minuto", ordenar por FINALIZADO
                            if (a.status === "FINALIZADO") return 1;
                            if (b.status === "FINALIZADO") return -1;

                            // Otros casos
                            return 0;
                        });
                        var content = '';

                        for (var i = 0; i < arr.length; i++) {

                            var obj = arr[i];

                            // Integrar lógicas aquí
                            var url = obj['url'];
                            if (url !== "#") {
                                url = url.replace("/embed/eventos/?r=", "")
                                var decodedUrl = atob(url);
                            }
                            

                            if (obj['status'] == "EN VIVO")
                                content += `
                        <div class="col-6 col-md-4 col-lg-3 evento">
                            <a href="?p=tv&evento&ifr=${url}">
                            <div class="card product-card">
                                <img src="${obj['img']}" alt="${obj['title']}" class="image">
                                <div class="card-body">
                                <h2 class="title">${obj['title']}</h2>
                                <p class="text">${obj['league']}</p>
                                <a href="?p=tv&evento&ifr=${url}" class="btn btn-sm btn-light live-text btn-block">
                                    <ion-icon class="faa-flash animated md hydrated" name="ellipse" role="img" aria-label="ellipse"></ion-icon>
                                    ${obj['status']}
                                </a>
                                </div>
                            </div>
                            </a>
                        </div>
                        `;

                            else if (obj['status'] == "FINALIZADO")
                                content += `
                        <div class="col-6 col-md-4 col-lg-3 evento">
                            <a>
                            <div class="card product-card">
                                <img src="${obj['img']}" alt="${obj['title']}" class="image">
                                <div class="card-body">
                                <h2 class="title">${obj['title']}</h2>
                                <p class="text">${obj['league']}</p>
                                <a href="?p=tv&r=${url}" class="disabled btn btn-sm btn-light live-text btn-block">
                                    <ion-icon class="md hydrated" name="time-outline" role="img" aria-label="time-outline"></ion-icon>
                                    ${obj['status']}
                                </a>
                                </div>
                            </div>
                            </a>
                        </div>
                        `;

                            else
                                content += `
                        <div class="col-6 col-md-4 col-lg-3 evento">
                            <a>
                            <div class="card product-card">
                                <img src="${obj['img']}" alt="${obj['title']}" class="image">
                                <div class="card-body">
                                <h2 class="title">${obj['title']}</h2>
                                <p class="text">${obj['league']}</p>
                                <a href="?p=tv&r=${url}" class="disabled btn btn-sm btn-light live-text btn-block">
                                    <ion-icon class="md hydrated" name="calendar-outline" role="img" aria-label="calendar-outline"></ion-icon>
                                    <span class="t">${obj['status']}</span> hs
                                </a>
                                </div>
                            </div>
                            </a>
                        </div>
                        `;
                        }

                        $("#eventos").html(content);

                        guardaHorario();
                        dT();
                    }
                })
            }

            eventos();

            window.setInterval(function () {
                eventos();
            }, 60000);
        </script>
    </div>
</div>
