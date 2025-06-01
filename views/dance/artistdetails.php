<?php
include __DIR__ . '/../header.php';
?>

<!-- Header Image with Overlay -->
<div class="position-relative text-white">
    <img src="/uploads/<?= htmlspecialchars($model->getHeaderImg()); ?>" class="img-fluid w-100"
        style="object-fit: cover; max-height: 400px;">
    <div class="position-relative bottom-10 start-0 p-4 bg-primary bg-opacity-50 w-100">
        <h1 class="d-inline ms-2"><?= htmlspecialchars($model->getName()) ?></h1>
    </div>
</div>

<!-- Back Button -->
<div class="container pt-5">
    <a class="btn btn-outline-dark mb-3" onclick="history.back()"><i
            class="fa-solid fa-circle-arrow-left me-2"></i>Back</a>

    <!-- About Section -->
    <div class="row mb-5 align-items-center">
        <div class="col-md-8">
            <h2 class="card-title">About</h2>
            <p><?= htmlspecialchars($model->getDescription()) ?></p>
        </div>
        <div class="col-md-4 text-center">
            <img src="/uploads/<?= htmlspecialchars($model->getLogo()); ?>" class="img-fluid rounded-md"
                alt="Artist Logo">
        </div>
    </div>

    <!-- Banner Image -->
    <div class="mb-5">
        <img src="/uploads/<?= htmlspecialchars($model->getImage()); ?>" class="img-fluid w-100" alt="Artist Image">
    </div>

    <!-- Albums Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="card-title">Important Albums and Singles</h2>
        <a target="_blank" class="btn btn-info btn-md" href="<?= htmlspecialchars($model->getSpotify()); ?>"><i
                class="fa-solid fa-link"></i> visit</a>
    </div>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-4 mb-5">
        <?php foreach ($albums as $album): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <a href="<?= $album->getLink(); ?>" target="_blank">
                        <img src="/uploads/<?= htmlspecialchars($album->getImage()); ?>" class="card-img-top img-fluid"
                            alt="Album">
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
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="mb-3 card-title">Events Participating In</h2>
            </div>
            <div class="row row-cols-1 row-cols-md-2 g-4">
                <?php foreach ($events as $event): ?>
                    <?php
                    $date = new DateTime($event->getDatetime());
                    $formatted = $date->format("l, j F Y h:i A");
                    ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <div class="card-header bg-primary text-white text-center">
                                <h5><?= htmlspecialchars($event->getName()) ?></h5>
                            </div>
                            <img src="/uploads/<?= htmlspecialchars($event->getImage()); ?>" class="card-img-top"
                                height="150" style="object-fit: cover;">
                            <div class="card-body">
                                <p class="mb-2">Time: <?= $formatted ?></p>
                                <p class="mb-2">Location: <?= htmlspecialchars($event->getVenue()) ?></p>
                                <p class="mb-2">Price: <?= htmlspecialchars($event->getTicket_price()) ?> &euro;</p>
                                <?php if ($event->getTickets_available() <= 0): ?>
                                    <p class="text-danger">Tickets available: Sold out 😢</p>
                                <?php elseif ($event->getTickets_available() <= 3): ?>
                                    <p class="text-danger">Tickets available: Only
                                        <?= htmlspecialchars($event->getTickets_available()) ?> left</p>
                                <?php else: ?>
                                    <p>Tickets available: <?= htmlspecialchars($event->getTickets_available()) ?></p>
                                <?php endif; ?>
                            </div>
                            <div class="p-3 text-center">
                                <form action="/artist/danceartistdetails?id=<?= $model->getId() ?>" method="post">
                                    <button class="btn btn-info" name="add-to-cart" <?= $event->getTickets_available() == 0 ? 'disabled' : '' ?>>Add to cart</button>
                                    <input type="hidden" name="product_id" value="<?= $event->getId() ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>



        
    </div>
</div>

<?php
include __DIR__ . '/../footer.php';
?>