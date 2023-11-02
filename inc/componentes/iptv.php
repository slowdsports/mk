<style>
    .canal-card {
        cursor: pointer;
        margin-bottom: 10px;
        transition: all 0.3s ease;
        border-radius: 10px;
    }

    .embed-responsive {
        background-color: #000;
        position: relative;
        box-shadow: 2px 2px 8px 2px #6366f1;
        transition: all 0.3s ease;
        border-radius: 10px;
        height: 50vh;
        overflow: hidden;
        text-align: center;
        float: center;
    }

    #player {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 50vh;
    }

    #channelsList {
        max-height: 400px;
        overflow-y: auto;
    }
</style>
<script src="//ssl.p.jwpcdn.com/player/v/8.24.0/jwplayer.js"></script>
<script>jwplayer.key = 'XSuP4qMl+9tK17QNb+4+th2Pm9AWgMO/cYH8CI0HGGr7bdjo';</script>
<div class="section mt-2">
    <div class="embed-responsive">
        <div id="player">Selecciona un canal para cargar el reproductor</div>
    </div>
    <hr>
    <div class="row">
        <div class="col-6">
            <form class="search-form">
                <div class="form-group searchbox">
                    <input id="searchInput" type="text" class="form-control" placeholder="Buscar...">
                    <i class="input-icon">
                        <ion-icon name="search-outline" role="img" class="md hydrated"
                            aria-label="search outline"></ion-icon>
                    </i>
                </div>
            </form>
        </div>
        <div class="col-6">
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <select class="form-control form-select" id="sourcesSelect">
                    </select>
                </div>
            </div>
        </div>
    </div>
    <h2 id="nombreCanal">Selecciona un canal:</h2>
    <div id="channelsList" class="row">
    </div>

    <div class="container mt-4">
        <div class="slider">
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var player = jwplayer('player');
        var channelsList = document.getElementById('channelsList');
        var sourcesSelect = document.getElementById('sourcesSelect');
        var channelNameText = document.getElementById('nombreCanal');
        // Ocultar select
        sourcesSelect.classList.add('hidden');

        // Obtener datos JSON a través del servidor PHP
        fetch("inc/componentes/proxy.php?p=iptv")
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                // Obtener canales disponibles
                var channels = data.countries.reduce(function (acc, country) {
                    return acc.concat(country.ambits.reduce(function (ambitAcc, ambit) {
                        return ambitAcc.concat(ambit.channels);
                    }, []));
                }, []);

                // Mostrar todos los canales al inicio
                showChannels(channels);
            });

        // Función para mostrar los canales en el DOM
        function showChannels(channels) {
            channelsList.innerHTML = ''; // Limpiar el contenido existente
            channels.forEach(function (channel) {
                var card = document.createElement('div');
                card.className = 'col-4 col-md-3 col-lg-2 mycard canal-card';
                card.setAttribute("data-name", channel.name);
                card.innerHTML = `
                <div class="card product-card liga-card">
                    <div class="card-body">
                        <center>
                            <img width="48px" src="${channel.logo}" style="background-size: contain; background-repeat: no-repeat;" class="image" alt="${channel.name}" />
                            <h2 class="title text-center">${channel.name}</h2>
                        </center>
                    </div>
                </div>
            `;
                card.addEventListener('click', function () {
                    // Eliminar container general
                    //var gralContainer = document.getElementById('appCapsule');
                    //gralContainer.classList.remove('container');
                    // Mostrar select
                    sourcesSelect.classList.remove('hidden');
                    // Limpiar las opciones del select antes de llenarlo de nuevo
                    sourcesSelect.innerHTML = '';
                    // Obtener las URLs de video del canal
                    var videoSources = channel.options.map(function (option) {
                        return {
                            file: option.url,
                            label: option.format
                        };
                    });
                    // Llenar el select con las opciones de las fuentes del canal
                    videoSources.forEach(function (source, index) {
                        console.log("source : " + JSON.stringify(source));
                        var option = document.createElement('option');
                        option.value = index;
                        option.textContent = "Opción (" + source.label + ")";
                        sourcesSelect.appendChild(option);
                        // Imprimir nombre del canal
                        channelNameText.textContent = channel.name;
                    });
                    // Verificar si hay una fuente de Twitch
                    var twitchSource = videoSources.find(function (source) {
                        return source.label === "stream";
                    });
                    var youtubeSource = videoSources.find(function (source) {
                        return source.label === "youtube";
                    });
                    if (twitchSource) {
                        player = jwplayer('player');
                        player.remove();
                        sourcesSelect.classList.add('hidden');
                        player = document.getElementById("player");
                        var twitchIframe = document.createElement('iframe');
                        twitchIframe.src = twitchSource.file + "&parent=127.0.0.1&parent=irtvhn.info";
                        twitchIframe.width = '100%';
                        twitchIframe.height = '100%';
                        player.appendChild(twitchIframe);
                    } else if (youtubeSource) {
                        player = jwplayer('player');
                        player.remove();
                        sourcesSelect.classList.add('hidden');
                        player = document.getElementById("player");
                        var youtubeIframe = document.createElement('iframe');
                        youtubeIframe.src = youtubeSource.file; // La URL de YouTube debe ser la URL embebida del video
                        youtubeIframe.width = '100%';
                        youtubeIframe.height = '100%';
                        youtubeIframe.allowfullscreen = true; // Permite que el iframe se expanda a pantalla completa
                        player.appendChild(youtubeIframe);
                    }
                    else {
                        player = jwplayer('player');
                        // Cargar el primer video en el reproductor como predeterminado
                        player.setup({
                            sources: videoSources,
                            width: '100%',
                            height: '50vh',
                            autostart: true,
                            mute: false,
                            displaytitle: true,
                            controls: true
                        });
                    }
                });
                channelsList.appendChild(card);
                // Agrega un evento de entrada al elemento de entrada
                var input = document.getElementById('searchInput');
                var canales = document.querySelectorAll('.mycard');
                input.addEventListener('input', function () {
                    var searchTerm = input.value.toLowerCase();
                    // Filtro
                    canales.forEach(function (card) {
                        var cardName = card.getAttribute('data-name').toLowerCase();
                        if (cardName.includes(searchTerm) || searchTerm === '') {
                            card.style.display = 'block';
                        } else {
                            card.style.display = 'none';
                        }
                    });
                });
            });
        }
        // Manejar el cambio de fuente al seleccionar una opción del select
        sourcesSelect.addEventListener('change', function () {
            var selectedIndex = sourcesSelect.value;
            player.load(player.getConfig().sources[selectedIndex]);
        });
    });
</script>