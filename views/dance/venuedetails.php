<?php
include __DIR__ . '/../header.php';
?>

<div style="position: relative; color: white; top:-25px; left: -15px;">
    <img src="/uploads/<?= htmlspecialchars($model->getHeaderImg()); ?>" style="width: 101.6%; height: 400px; object-fit: cover;">
    <div style="position: absolute; bottom: 8px; left: 16px;" class="position-relative bottom-10 start-0 p-4 bg-primary bg-opacity-50 w-100">
        <h4 style="display:inline;"> Dance </h5>
            <h1 style="display:inline;"> <?= $model->getName() ?></h1>
    </div>
</div>

<a class="fa-solid fa-circle-arrow-left py-5 px-5" href="/venue/dancevenues" style="text-decoration:none; color:black; position: fixed; font-size: 2em;"></a>

<div class="album py-5">
    <div class="container mb-5">
        <div class="row">
            <div class="col-sm-8">
                <h2 class="my-3 card-title">About</h2>
                <p><?= $model->getDescription() ?></p>
            </div>
            <div class="col-sm-4">
                <img src="/uploads/<?= htmlspecialchars($model->getImage()); ?>" class="img-thumbnail">
            </div>
        </div>

        <h2 class="my-3 card-title">HF Dance Events at this location</h2>
        <div class="row mt-3">

            <?php
            foreach ($events as $event) {
                $date_string = $event->getDatetime();
                $date = new DateTime($date_string);
                $formated = $date->format("l, j F Y h:i A");
            ?>
                <div class="col-lg-6 col-md-6 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <img src="/uploads/<?= htmlspecialchars($event->getImage()); ?>" class="mx-auto d-block" height="150px">
                        </div>
                        <div class="card-body">
                        <p class="card-text text-center bg-primary text-white p-2 mb-4"><?= $event->getName() ?></p>
                            <p class="card-text mb-2">Time: <?= $formated; ?></p>
                            <p class="card-text mb-2">Location: <?= $model->getName() ?></p>
                            <p class="card-text mb-2">Price: <?= $event->getTicket_price() ?> &euro;</p>
                            <?php
                            if ($event->getTickets_available() <= 0) {
                            ?>
                                <p class="card-text mb-2 text-danger">Tickets available: Sold out 😢</p>
                            <?php
                            } elseif ($event->getTickets_available() <= 3) {
                            ?>
                                <p class="card-text mb-2 text-danger">Tickets available: Only <?= $event->getTickets_available() ?> left</p>
                            <?php
                            } elseif ($event->getTickets_available() > 3) {
                            ?>
                                <p class="card-text">Tickets available: <?= $event->getTickets_available() ?></p>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="p-3 text-center d-flex justify-content-between align-items-center">
                            <p class="text-center"><a href="/artist/danceartistdetails?id=<?= $event->getArtist() ?>">Discover more</a></p>

                            <form action="/venue/dancevenuedetails?id=<?= $model->getId() ?>" method="post">
                                <?php
                                if ($event->getTickets_available() == 0) {
                                ?>
                                    <button class="btn btn-info" name="add-to-cart" disabled>Add to cart</button>
                                <?php
                                } else {
                                ?>
                                    <button class="btn btn-info" name="add-to-cart">Add to cart</button>
                                <?php
                                }
                                ?>
                                <input type="hidden" name="product_id" value="<?= $event->getId() ?>">
                            </form>
                        </div>
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