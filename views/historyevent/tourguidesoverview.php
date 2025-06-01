<?php
include __DIR__ . '/../header.php';
?>

<head>
    <link rel="stylesheet" href="/css/tourguide.css">
</head>

<div class="album py-5" style="min-height: 60vh">
    <div class="container mb-5">
        <div class="section-title text-center">
            <h2>Tour Guides</h2>
        </div>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php
            foreach ($tourguides as $guide) {
            ?>
                <div class="row col mb-3">
                    <div class="card shadow-sm rounded-2 overflow-hidden">
                        <a href="/tourguide/tourguidedetails?id=<?= $guide->getId() ?>">
                            <img src="/uploads/<?= htmlspecialchars($guide->getImage()); ?>" height="300px" width="348px">
                            <div class="card-body">
                                <p class="card-text fw-bold text-center"><?= $guide->getName() ?></p>
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