<?php include __DIR__ . '/../header.php'; ?>

<div class="position-relative text-white mb-5">
    <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($model->getHeaderImg()); ?>" class="w-100" style="object-fit: cover; height: 400px;">
    <div class="position-absolute bottom-0 start-0 p-4 bg-dark bg-opacity-50 w-100">
        <h4 class="d-inline text-warning">Jazz</h4>
        <h1 class="d-inline ms-2"><?= $model->getName() ?></h1>
    </div>
</div>

<a class="fa-solid fa-circle-arrow-left py-3 px-4" style="text-decoration:none; color:black; font-size: 2em; position: fixed; top: 20px; left: 20px;" onclick="history.back()"></a>

<div class="container mb-5">
    <div class="row mb-4">
        <div class="col-md-8">
            <h2 class="my-3">About</h2>
            <p><?= $model->getDescription() ?></p>
        </div>
        <div class="col-md-4 text-center">
            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($model->getLogo()); ?>" class="img-fluid" alt="Artist Logo">
        </div>
    </div>

    <div class="mb-4">
        <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($model->getImage()); ?>" class="img-fluid w-100 rounded" alt="Artist Image">
    </div>

    <?php if (!empty($albums)) : ?>
        <h2 class="my-4">Important Albums and Singles</h2>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
            <?php foreach ($albums as $album) : ?>
                <div class="col">
                    <div class="card h-100 shadow-sm">
                        <a href="<?= $album->getLink() ?>" target="_blank">
                            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($album->getImage()); ?>" class="card-img-top" alt="Album Cover">
                            <div class="card-body bg-dark text-light text-center">
                                <p class="fw-bold"><?= $album->getName() ?></p>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <div class="row my-5">
        <div class="col-md-6">
            <h2 class="mb-3">Events Participating In</h2>
            <?php foreach ($events as $event) :
                $formatted = (new DateTime($event->getDatetime()))->format("l, j F Y h:i A");
            ?>
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-dark text-white text-center">
                        <h5 class="mb-2"><?= $event->getName() ?></h5>
                        <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($event->getImage()); ?>" class="img-fluid" height="150" alt="Event Image">
                    </div>
                    <div class="card-body bg-dark text-light">
                        <p><strong>Time:</strong> <?= $formatted ?></p>
                        <p><strong>Location:</strong> <?= $event->getVenue() ?></p>
                        <p><strong>Price:</strong> €<?= $event->getTicket_price() ?></p>
                        <?php if ($event->getTickets_available() <= 0) : ?>
                            <p class="text-danger">Tickets available: Sold out 😢</p>
                        <?php elseif ($event->getTickets_available() <= 3) : ?>
                            <p class="text-warning">Tickets available: Only <?= $event->getTickets_available() ?> left!</p>
                        <?php else : ?>
                            <p>Tickets available: <?= $event->getTickets_available() ?></p>
                        <?php endif; ?>
                    </div>
                    <div class="card-footer bg-dark text-center">
                        <form action="/artist/jazzartistdetails?id=<?= $model->getId() ?>" method="post">
                            <input type="hidden" name="product_id" value="<?= $event->getId() ?>">
                            <button class="btn btn-secondary" name="add-to-cart" <?= $event->getTickets_available() <= 0 ? 'disabled' : '' ?>>
                                Add to Cart
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="col-md-6">
            <h2 class="mb-3">Try Their Tracks</h2>
            <iframe style="border-radius:12px" src="<?= $model->getSpotify() ?>" width="100%" height="352" frameborder="0" allow="autoplay; clipboard-write; encrypted-media; fullscreen; picture-in-picture" loading="lazy"></iframe>
            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($model->getThumbnailImg()); ?>" class="img-fluid mt-3 rounded" height="350" alt="Artist Thumbnail">
        </div>
    </div>
</div>

<?php include __DIR__ . '/../footer.php'; ?>
