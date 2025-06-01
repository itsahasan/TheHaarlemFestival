<?php
include __DIR__ . '/../header.php';
?>

<head>
    <link rel="stylesheet" href="/css/music_cms_style.css">
</head>

<div class="album py-5">
    <div class="container mb-5">

        <div class="section-title text-center">
            <h2>Haarlem Festival Dance Artists</h2>
        </div>
        <div class="row justify-content-center g-3">
            <?php
            foreach ($model as $artist) {
            ?>
                <div class="col-lg-4 col-md-6 col-sm-10 mb-3">
                    <div class="card shadow-sm">
                        <a href="/artist/danceartistdetails?id=<?= $artist->getId() ?>">
                            <img src="/uploads/<?= htmlspecialchars($artist->getImage()); ?>" style="height:300px;width:350px;object-fit:cover">
                            <div class="card-body">
                                <p class="card-text fw-bold text-center"><?= $artist->getName() ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php
            }
            ?>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/../footer.php';
?>