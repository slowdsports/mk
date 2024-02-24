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
    <h2>Star+ <small>Eventos Programados</small></h2>
    <div class="wide-block pt-2 pb-2">
        <div id="eventos" class="row">
            <!-- <script src="inc/eventos/star.js"></script> -->
            <script>
                function eventos() {
                    var x = Math.random().toString(36).substring(7);

                    $.ajax({
                        url: "https://api.codetabs.com/v1/proxy/?quest=https://futbollibre.app/star-plus/eventos.json?" + x,
                        //url: "https://corsproxy.io/?https://maindota2.co/json/datos.json?" + x,
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
                                    // Obtener el proxy
                                    var proxy = "<?= $proxy ?>";
                                    // Hacer split en partes usando "&"
                                    var urlParts = decodedUrl.split("&");
                                    // Ordenar las partes
                                    var m3u8 = proxy + urlParts[0];
                                    console.log(m3u8);
                                    // Encriptar la imagen a MD5
                                    var imagen = urlParts[1] + "&" + urlParts[2] + "&" + urlParts[3];
                                    imagen = imagen.replace("img=", "");
                                    var key1 = urlParts[4];
                                    key1 = key1.replace("key=", "")
                                    var key2 = urlParts[5];
                                    key2 = key2.replace("key2=", "");
                                    console.log(key1)
                                    // Reemplazar la URL
                                    url = btoa(m3u8) + "&img=" + imagen + "&key=" + btoa(key1) + "&key2=" + btoa(key2);
                                }


                                if (obj['status'] == "EN VIVO")
                                    content += `
                        <div class="col-6 col-md-4 col-lg-3 evento">
                            <a href="?p=tv&r=${url}">
                            <div class="card product-card">
                                <img src="https://prod-ripcut-delivery.disney-plus.net/v1/variant/star/${obj['img']}/scale?width=900&aspectRatio=1.78&format=jpeg" alt="${obj['title']}" class="image">
                                <div class="card-body">
                                <h2 class="title">${obj['title']}</h2>
                                <p class="text">${obj['league']}</p>
                                <a href="?p=tv&r=${url}" class="btn btn-sm btn-light live-text btn-block">
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
                            <a href="?p=tv&r=${url}">
                            <div class="card product-card">
                                <img src="https://prod-ripcut-delivery.disney-plus.net/v1/variant/star/${obj['img']}/scale?width=900&aspectRatio=1.78&format=jpeg" alt="${obj['title']}" class="image">
                                <div class="card-body">
                                <h2 class="title">${obj['title']}</h2>
                                <p class="text">${obj['league']}</p>
                                <a href="?p=tv&r=${url}" class="btn btn-sm btn-light live-text btn-block">
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
                                <img src="https://prod-ripcut-delivery.disney-plus.net/v1/variant/star/${obj['img']}/scale?width=900&aspectRatio=1.78&format=jpeg" alt="${obj['title']}" class="image">
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
</div>