<?php
include __DIR__ . '/../header.php';
?>

<head>
    <link rel="stylesheet" href="/css/music_cms_style.css">
</head>

<div style="position: relative; color: white; top:-25px; left: -15px;">
    <img src="/uploads/<?= htmlspecialchars($model->getHeaderImg()); ?>" class="w-100" style="object-fit: cover; height: 400px;">
    <div style="position: relative; bottom: 8px; left: 16px;" class="position-relative bottom-10 start-0 p-4 bg-primary bg-opacity-50 w-100">
        <h4 style="display:inline;"> Jazz </h5>
            <h1 style="display:inline;"> <?= $model->getName() ?></h1>
    </div>
</div>

<a class="fa-solid fa-circle-arrow-left py-5 px-5" href="/venue/jazzvenues" style="text-decoration:none; color:black; position: fixed; font-size: 2em;"></a>

<div class="album py-5">
    <div class="container mb-5">
        <div class="row">
            <div class="col-sm-8">
                <h2 class="card-title">About</h2>
                <p> <?= $model->getDescription() ?></p>
            </div>
            <div class="col-sm-4">
                <img src="/uploads/<?= htmlspecialchars($model->getImage()); ?>" class="img-thumbnail">
            </div>
        </div>

        <h2 class="card-title">HF Jazz Events at this location</h2>
        <div class="row mt-3">

            <?php
            foreach ($events as $event) {
                $date_string = $event->getDatetime();
                $date = new DateTime($date_string);
                $formated = $date->format("l, j F Y h:i A");
            ?>
                <div class="col-md-6 mb-3">
                    <div class="card shadow-sm">
                        <div class="card-header">
                            <img src="/uploads/<?= htmlspecialchars($event->getImage()); ?>" class="mx-auto d-block" height="200px">
                        </div>
                        <div class="card-body">
                            <div class="p-2 text-white bg-primary mb-4">
                            <p class="mb-2 card-text text-center"><?= $event->getName() ?></p>
                            </div>
                            <p class="mb-2 card-text">Time: <?php echo $formated; ?></p>
                            <p class="mb-2 card-text">Location: <?= $model->getName() ?></p>
                            <p class="mb-2 card-text">Price: <?= $event->getTicket_price() ?> &euro;</p>
                            <?php
                            if ($event->getTickets_available() <= 0) {
                            ?>
                                <p class="mb-2 card-text text-danger">Tickets available: Sold out 😢</p>
                            <?php
                            } elseif ($event->getTickets_available() <= 3) {
                            ?>
                                <p class="mb-2 card-text text-danger">Tickets available: Only <?= $event->getTickets_available() ?> left</p>
                            <?php
                            } elseif ($event->getTickets_available() > 3) {
                            ?>
                                <p class="mb-2 card-text">Tickets available: <?= $event->getTickets_available() ?></p>
                            <?php
                            }
                            ?>
                        </div>
                        <div class="card-footer text-center d-flex justify-content-between">
                            <p class="text-center"><a href="/artist/jazzartistdetails?id=<?= $event->getArtist() ?>">Discover more</a></p>

                            <form action="/venue/jazzvenuedetails?id=<?= $model->getId() ?>" method="post">
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