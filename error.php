<div id="appCapsule">
    <div class="error-page">
        <div class="icon-box text-danger">
            <ion-icon name="alert-circle" role="img" class="md hydrated" aria-label="alert circle"></ion-icon>
        </div>
        <h1 class="title">Error</h1>
        <div class="text mb-5">
            <?= $_SESSION['message']; ?>
        </div>

        <div class="fixed-footer">
            <div class="row">
                <div class="col-12">
                    <a href="javascript:;" class="btn btn-primary btn-lg btn-block goBack">Regresar</a>
                </div>
            </div>
        </div>
    </div>
</div>