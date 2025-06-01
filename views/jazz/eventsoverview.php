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
        <div class="section-title text-center">
            <h2>HF Jazz Events</h2>
            <p>Haarlem Jazz is an important music event for the City of Haarlem. During the Haarlem
                festival, we want to recreate part of this festival by inviting some of the bands that
                previously performed there to play at the Patronaat. On Sunday, some of the bands will take
                to the big stage at the Grote Markt to perform for all visitors for free!</p>
        </div>
            

        <form method="POST" class="d-flex justify-content-center flex-wrap gap-2 mb-4">
            <button type="submit" name="all"
                class="btn mx-2 <?= isset($_POST['all']) ? 'btn-success' : 'btn-outline-success' ?>">All Events</button>

            <?php foreach ($dates as $day): ?>
                <?php
                $date = $day->value;
                $label = $day->name . ' ' . date('d', strtotime($date));
                ?>
                <button type="submit" name="<?= $date ?>"
                    class="btn mx-2 <?= isset($_POST[$date]) ? 'btn-primary' : 'btn-outline-primary' ?>">
                    <?= $label ?>
                </button>
            <?php endforeach; ?>
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
                        <img src="/uploads/<?= htmlspecialchars($event->getImage()); ?>" class="mx-auto d-block img-fluid">
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

        

        <div class="card p-2 bg-light">
            <div class="card-body">
                <ul class="address-list">
                    <li><span class="font-weight-bold d-inline-block me-3">Location:</span><span>Patronaat, Zijlsingel 2 2013 DN Haarlem</span></li>
                    <li><span class="font-weight-bold d-inline-block me-3">Email:</span><span>info@patronaat.nl</span></li>
                    <li><span class="font-weight-bold d-inline-block me-3">Phone:</span><span>023-5175850 (office) - during office hours 10:00 - 17:00 <br>
                    023-5175858 (cash desk/information number)</span></li>
                </ul>
            </div>
        </div>

    </div>
</div>
<?php
include __DIR__ . '/../footer.php';
?>









