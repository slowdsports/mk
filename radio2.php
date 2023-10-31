<div class="section mt-2">
    <audio src="algo.mp3" controls></audio>
    <div id="channelsList" class="row">
        <?php
        // URL del archivo JSON
        $json_url = "https://www.tdtchannels.com/lists/radio.json";

        // Obtener el contenido del archivo JSON
        $json_data = file_get_contents($json_url);

        // Decodificar el JSON a un array asociativo
        $data = json_decode($json_data, true);

        // Acceder a la información y mostrarla
        $countries = $data['countries'];

        foreach ($countries as $country) {
            $ambits = $country['ambits'];
            foreach ($ambits as $ambit) {
                $channels = $ambit['channels'];
                foreach ($channels as $channel) {
                    // Información Adicional
                    $extra_info = $channel['extra_info'];
                    if (!empty($extra_info)) {
                        foreach ($extra_info as $info) {
                        }
                    }
                    // Opciones de transmisión
                    $options = $channel['options'];
                    foreach ($options as $option) {
                        ?>
                        <div class="col-6 col-md-4 col-lg-3 col-xl-2 mycard <?= $ambit['name'] ?>"
                        data-category="<?= $ambit['name'] ?>">
                        <a href="?p=radio&source=<?= base64_encode($option['url']) ?>&format=<?= $option['format'] ?>">
                            <div class="card product-card liga-card canal-card">
                                <div class="card-body">
                                    <center>
                                        <img width="48px" src="https://i.ibb.co/w0qg9JF/trans.png"
                                            style="background-image: url('<?= $channel['logo'] ?>'); background-size: contain; background-repeat: no-repeat;"
                                            class="image" alt="product image" />
                                        <h2 class="title text-center">
                                            <?= $channel['name'] ?>
                                        </h2>
                                    </center>
                                </div>
                            </div>
                        </a>
                    </div>
                        <?php
                    }
                }
            }
        }
        ?>
    </div>
</div>