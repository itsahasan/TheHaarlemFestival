<?php
include __DIR__ . '/../header.php';
?>
<head>
    <link rel="stylesheet" href="/css/music_cms_style.css">
</head>

<div class="album py-5">
    <div class="container mb-5">
        <div class="section-title text-center">
            <h2>HF Jazz Artists</h2>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            foreach ($model as $artist) {
            ?>
                <div class="row col mb-3">
                    <div class="card shadow-sm rounded-4">
                        <a href="/artist/jazzartistdetails?id=<?= $artist->getId() ?>">
                            <img src="/uploads/<?php echo htmlspecialchars($artist->getImage()); ?>" height="300px" width="348px">
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