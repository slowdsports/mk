<div class="section mt-2">
    <div class="mt-5">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card text-center">
                    <img id="emisora-imagen" class="card-img-top" alt="Carátula de Emisora">
                    <div class="card-body">
                        <h6 class="card-subtitle"></h6>
                        <h5 class="card-title"></h5>
                        <audio id="radioPlayer" class="w-100" controls></audio>
                    </div>
                </div>
                <div class="wide-block pt-2 pb-2">
                    <form class="search-form">
                        <div class="form-group searchbox">
                            <input type="text" id="filtro" class="form-control mt-4" placeholder="Buscar emisora">
                        </div>
                    </form>
                </div>
                <ul class="listview image-listview mt-2" id="lista-emisoras"></ul>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const listaEmisoras = document.getElementById('lista-emisoras');
        const filtro = document.getElementById('filtro');
        const radioPlayer = document.getElementById('radioPlayer');
        const tarjetaImagen = document.getElementById('emisora-imagen');
        // Obtener datos JSON a través del servidor PHP
        fetch("inc/componentes/proxy.php")
            .then(function (response) {
                return response.json();
            })
            .then(function (data) {
                var emisoras = [];

                // Iterar a través de los ámbitos y las emisoras para obtener una lista plana de emisoras
                data.countries.forEach(function (country) {
                    country.ambits.forEach(function (ambit) {
                        emisoras = emisoras.concat(ambit.channels);
                    });
                });

                // Función para mostrar emisoras en el formato solicitado
                function showEmisoras(emisoras) {
                    var listaEmisoras = document.getElementById('lista-emisoras');
                    listaEmisoras.innerHTML = '';

                    emisoras.forEach(function (emisora) {
                        var listItem = document.createElement('li');
                        listItem.innerHTML = `
                            <a href="#" class="item">
                                <img src="${emisora.logo}" alt="image" class="image">
                                <div class="in">
                                    <div>${emisora.name}</div>
                                    <span class="text-muted">a</span>
                                </div>
                            </a>
                        `;
                        listItem.addEventListener('click', function () {
                            document.getElementById('emisora-imagen').src = emisora.logo;
                            document.getElementById('radioPlayer').src = emisora.options[0].url; // Selecciona la primera opción de streaming por defecto
                            document.getElementById('radioPlayer').play();
                        });
                        listaEmisoras.appendChild(listItem);
                    });
                }

                // Mostrar todas las emisoras al inicio
                showEmisoras(emisoras);

                // Filtrar emisoras
                var filtro = document.getElementById('filtro');
                filtro.addEventListener('input', function () {
                    var filtroTexto = filtro.value.toLowerCase();
                    var emisorasFiltradas = emisoras.filter(function (emisora) {
                        return emisora.name.toLowerCase().includes(filtroTexto);
                    });
                    showEmisoras(emisorasFiltradas);
                });
            })
            .catch(function (error) {
                console.error('Error al obtener datos:', error);
            });


    });

</script>