<div id="appCapsule">
    <div class="error-page">
        <div class="icon-box text-danger">
            <ion-icon name="alert-circle" role="img" class="md hydrated" aria-label="alert circle"></ion-icon>
        </div>
        <h1 class="title">Error</h1>
        <div class="text mb-5">
            <?= (isset($_SESSION['message']) ? $_SESSION['message'] : $_GET['message']); ?>
        </div>

        <div class="fixed-footer">
            <div class="row">
                <div class="col-6">
                    <a href="javascript:;" class="btn btn-secondary btn-lg btn-block goBack">Regresar</a>
                </div>
                <div class="col-6">
                    <a href="?p=home" class="btn btn-primary btn-lg btn-block goBack">Inicio</a>
                </div>
            </div>
        </div>
    </div>
</div>