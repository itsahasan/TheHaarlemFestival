<?php
include __DIR__ . '/../header.php';
?>




<div class="album py-5" style="min-height: 60vh">
    <div class="container mb-5">
        <div class="row">
            <div class="col-sm-8">
                <h2 class="card-title">About</h2>
                <p><?= $model->getDescription() ?></p>
            </div>
            <div class="col-sm-4">
                <img src="/uploads/<?= htmlspecialchars($model->getImage()); ?>" class="img-thumbnail">
            </div>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/../footer.php';
?>