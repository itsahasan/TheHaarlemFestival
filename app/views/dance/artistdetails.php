<?php
include __DIR__ . '/../header.php';
?>

<!-- Header Image with Overlay -->
<div class="position-relative text-white">
    <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($model->getHeaderImg()); ?>" class="img-fluid w-100" style="object-fit: cover; max-height: 500px;">
    <div class="position-absolute bottom-0 start-0 p-4 bg-dark bg-opacity-50 w-100">
        <h1 class="d-inline ms-2"><?= htmlspecialchars($model->getName()) ?></h1>
    </div>
</div>

<!-- Back Button -->
<div class="container mt-4">
    <a class="btn btn-outline-dark mb-3" onclick="history.back()"><i class="fa-solid fa-circle-arrow-left me-2"></i>Back</a>

    <!-- About Section -->
    <div class="row mb-5 align-items-center">
        <div class="col-md-8">
            <h2>About</h2>
            <p><?= htmlspecialchars($model->getDescription()) ?></p>
        </div>
        <div class="col-md-4 text-center">
            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($model->getLogo()); ?>" class="img-fluid" alt="Artist Logo">
        </div>
    </div>

    <!-- Banner Image -->
    <div class="mb-5">
        <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($model->getImage()); ?>" class="img-fluid w-100" alt="Artist Image">
    </div>

    <!-- Albums Section -->
    <h2 class="mb-4">Important Albums and Singles</h2>
    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-5">
        <?php foreach ($albums as $album): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <a href="<?= $album->getLink(); ?>" target="_blank">
                        <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($album->getImage()); ?>" class="card-img-top img-fluid" alt="Album">
                        <div class="card-body bg-dark text-light text-center">
                            <p class="fw-bold"><?= htmlspecialchars($album->getName()); ?></p>
                        </div>
                    </a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Events & Tracks Section -->
    <div class="row mb-5">
        <div class="col-md-7">
            <h2 class="mb-3">Events Participating In</h2>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php foreach ($events as $event): ?>
                    <?php
                        $date = new DateTime($event->getDatetime());
                        $formatted = $date->format("l, j F Y h:i A");
                    ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-dark text-white text-center">
                                <h5><?= htmlspecialchars($event->getName()) ?></h5>
                            </div>
                            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($event->getImage()); ?>" class="card-img-top" height="150" style="object-fit: cover;">
                            <div class="card-body bg-dark text-light">
                                <p>Time: <?= $formatted ?></p>
                                <p>Location: <?= htmlspecialchars($event->getVenue()) ?></p>
                                <p>Price: <?= htmlspecialchars($event->getTicket_price()) ?> &euro;</p>
                                <?php if ($event->getTickets_available() <= 0): ?>
                                    <p class="text-danger">Tickets available: Sold out 😢</p>
                                <?php elseif ($event->getTickets_available() <= 3): ?>
                                    <p class="text-danger">Tickets available: Only <?= htmlspecialchars($event->getTickets_available()) ?> left</p>
                                <?php else: ?>
                                    <p>Tickets available: <?= htmlspecialchars($event->getTickets_available()) ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="card-footer bg-dark text-center">
                                <form action="/artist/danceartistdetails?id=<?= $model->getId() ?>" method="post">
                                    <button class="btn btn-secondary" name="add-to-cart" <?= $event->getTickets_available() == 0 ? 'disabled' : '' ?>>Add to cart</button>
                                    <input type="hidden" name="product_id" value="<?= $event->getId() ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Spotify & Image -->
        <div class="col-md-5">
            <h2 class="mb-3">Try Their Tracks</h2>
            <iframe class="w-100 mb-4" height="352" style="border-radius:12px" src="<?= htmlspecialchars($model->getSpotify()); ?>" frameBorder="0" allowfullscreen allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
        </div>
    </div>
</div>

<?php
include __DIR__ . '/../footer.php';
?>