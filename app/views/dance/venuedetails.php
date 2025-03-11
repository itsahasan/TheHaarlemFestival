<?php
include __DIR__ . '/../header.php';
?>

<div style="position: relative; color: white; top:-25px; left: -15px;" class="img-fluid">
    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($model->getHeaderImg()); ?>" style="width: 101.6%; height: 100%; object-fit: cover;">
    <div style="position: absolute; bottom: 8px; left: 16px;">
        <h4 style="display:inline;"> Dance </h5>
            <h1 style="display:inline;"> <?= $model->getName() ?></h1>
    </div>
</div>

<a class="fa-solid fa-circle-arrow-left py-5 px-5" href="/venue/dancevenues" style="text-decoration:none; color:black; position: fixed; font-size: 2em;"></a>

<div class="album py-5">
    <div class="container mb-5">
        <div class="row">
            <div class="col-sm-8">
                <h2 class="my-3">About</h2>
                <p><?= $model->getDescription() ?></p>
            </div>
            <div class="col-sm-4">
                <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($model->getImage()); ?>" class="img-thumbnail">
            </div>
        </div>

        <h2 class="my-3">HF Dance Events at this location</h2>
        <div class="row mt-3">

            <?php
            foreach ($events as $event) {
                $date_string = $event->getDatetime();
                $date = new DateTime($date_string);
                $formated = $date->format("l, j F Y h:i A");
            ?>
                <div class="col mb-3">
                    <div class="card shadow-sm">
                        <div class="card-header text-light bg-dark">
                            <p class="card-text text-center"><?= $event->getName() ?></p>
                            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($event->getImage()); ?>" class="mx-auto d-block" height="150px">
                        </div>
                        <div class="card-body text-light bg-dark">
                            <p class="card-text">Time: <?php echo $formated; ?></p>
                            <p class="card-text">Location: <?= $model->getName() ?></p>
                            <p class="card-text">Price: <?= $event->getTicket_price() ?> &euro;</p>
                            <?php
                            if ($event->getTickets_available() <= 0) {
                            ?>
                                <p class="card-text text-danger">Tickets available: Sold out 😢</p>
                            <?php
                            } elseif ($event->getTickets_available() <= 3) {
                            ?>
                                <p class="card-text text-danger">Tickets available: Only <?= $event->getTickets_available() ?> left</p>
                            <?php
                            } elseif ($event->getTickets_available() > 3) {
                            ?>
                                <p class="card-text">Tickets available: <?= $event->getTickets_available() ?></p>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="card-footer text-light bg-dark text-center">
                            <p class="text-center"><a href="/artist/danceartistdetails?id=<?= $event->getArtist() ?>">Discover more</a></p>

                            <form action="/venue/dancevenuedetails?id=<?= $model->getId() ?>" method="post">
                                <?php
                                if ($event->getTickets_available() == 0) {
                                ?>
                                    <button class="btn btn-secondary" name="add-to-cart" disabled>Add to cart</button>
                                <?php
                                } else {
                                ?>
                                    <button class="btn btn-secondary" name="add-to-cart">Add to cart</button>
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