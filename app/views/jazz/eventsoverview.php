<?php
include __DIR__ . '/../header.php';

function getButtonClass($key) {
    if (isset($_POST[$key])) return 'btn-success';
    if (!isset($_POST['thursday']) && !isset($_POST['friday']) && !isset($_POST['saturday']) && $key === 'events') return 'btn-success';
    return 'btn-primary';
}
?>

<head>
    <link rel="stylesheet" href="/css/music_cms_style.css">
</head>

<div class="album py-5">
    <div class="container mb-5">
        <h2 class="text-dark text-center mb-3">HF Jazz Events</h2>

        <p class="text-center">Haarlem Jazz is an important music event for the City of Haarlem. During the Haarlem
            festival, we want to recreate part of this festival by inviting some of the bands that
            previously performed there to play at the Patronaat. On Sunday, some of the bands will take
            to the big stage at the Grote Markt to perform for all visitors for free!</p>
            

        <form method="POST" class="text-center my-3">
            <button type="submit" name="events" class="btn <?= getButtonClass('events') ?> mx-2">All Events</button>
            <button type="submit" name="wednesday" class="btn <?= getButtonClass('wednesday') ?> mx-2">Wednesday 26</button>
            <button type="submit" name="thursday" class="btn <?= getButtonClass('thursday') ?> mx-2">Thursday 27</button>
            <button type="submit" name="friday" class="btn <?= getButtonClass('friday') ?> mx-2">Friday 28</button>
            <button type="submit" name="saturday" class="btn <?= getButtonClass('saturday') ?> mx-2">Saturday 29</button>
        </form>

        <div class="row my-3">
            <?php
            foreach ($model as $event) {
                $date_string = $event->getDatetime();
                $date = new DateTime($date_string);
                $formated = $date->format("l, j F Y h:i A");
            ?>
                <div class="col-md-3 card">
                    <div class="card-header text-light bg-dark">
                        <p class="card-text text-center"><?= $event->getName() ?></p>
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($event->getImage()); ?>" class="mx-auto d-block img-fluid">
                    </div>
                    <div class="card-body text-light bg-dark">
                        <p class="card-text">Time: <?php echo $formated; ?></p>
                        <p class="card-text">Location: <?= $event->getVenue() ?></p>
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
                        <p class="text-center"><a href="/artist/jazzartistdetails?id=<?= $event->getArtist() ?>">Discover more</a></p>
                        <form action="/event/jazzevents" method="post">
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
            <?php
            }
            ?>
        </div>

        <div class="row my-3">
            <?php
            foreach ($passes as $pass) {
            ?>
                <div class="col-md-3 card">
                    <div class="card-header">
                        <p class="card-text text-center"><?= $pass->getName() ?></p>
                    </div>
                    <div class="card-body">
                        <p><?= $pass->getName() ?></p>
                        <p>Time: <?= $pass->getDatetime() ?></p>
                        <p>Price: &euro; <?= $pass->getPrice() ?></p>
                    </div>
                    <div class="card-footer text-center">
                        <form action="/event/jazzevents" method="post">
                            <button class="btn btn-secondary" name="add-to-cart">Add to cart</button>
                            <input type="hidden" name="product_id" value="<?= $pass->getId() ?>">
                        </form>
                    </div>
                </div>
            <?php } ?>
        </div>

        <p class="text-center my-3">Location:
            Patronaat, Zijlsingel 2 2013 DN Haarlem
            Email: info@patronaat.nl
            Phone:
            023-5175850 (office) - during office hours 10:00 - 17:00
            023-5175858 (cash desk/information number)
        </p>

    </div>
</div>
<?php
include __DIR__ . '/../footer.php';
?>