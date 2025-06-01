<?php
include __DIR__ . '/../header.php';

function getButtonClass($key)
{
    if (isset($_POST[$key]))
        return 'btn-success';
    if (!isset($_POST['thursday']) && !isset($_POST['friday']) && !isset($_POST['saturday']) && $key === 'events')
        return 'btn-success';
    return 'btn-primary';
}
?>

<head>
    <link rel="stylesheet" href="/css/music_cms_style.css">
    <style>
        .card:hover {
            transform: scale(1.02);
            transition: 0.3s ease;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<div class="album py-5">
    <div class="container mb-5">
        <div class="section-title text-center">
            <h2>Haarlem Festival Dance Events</h2>
            <p class="text-center">A new addition to the festival is Haarlem Dance in which the latest dance, house,
                techno
                and trance is central. Six of the top Dj’s in the world will entertain their audience in
                Back2Backsessions(multipleacts,largerstage,longer sessions) as well as in
                smaller experimental (club) sessions.</p>
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
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <img src="/uploads/<?= htmlspecialchars($event->getImage()); ?>" class="mx-auto d-block img-fluid"
                            style="height: 200px; object-fit: cover;">
                        <div class="card-header text-light bg-primary">
                            <p class="card-text text-center"><?= $event->getName() ?></p>
                        </div>
                        <div class="card-body">
                            <p class="card-text">Time: <?= $formated; ?></p>
                            <p class="card-text">Location: <?= $event->getVenue() ?></p>
                            <p class="card-text">Price: <?= $event->getTicket_price() ?> &euro;</p>
                            <?php
                            if ($event->getTickets_available() <= 0) {
                                ?>
                                <p class="card-text text-danger">Tickets available: Sold out 😢</p>
                                <?php
                            } elseif ($event->getTickets_available() <= 3) {
                                ?>
                                <p class="card-text text-danger">Tickets available: Only <?= $event->getTickets_available() ?>
                                    left</p>
                                <?php
                            } elseif ($event->getTickets_available() > 3) {
                                ?>
                                <p class="card-text">Tickets available: <?= $event->getTickets_available() ?></p>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="p-3 text-center d-flex justify-content-between align-items-center">
                            <p class="text-center"><a
                                    href="/artist/danceartistdetails?id=<?= $event->getArtist() ?>">Discover more</a></p>

                            <form action="/event/danceevents" method="post">
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

       

        <div class="card bg-light">
            <div class="card-body">
                <p class="text-center my-3">The capacity of the Club sessions is very limited. <b>Availability for
                        All-Access pas holders can not be guaranteed due to safety regulations.</b>
                    Tickets available represents total capacity. (90% is sold as single tickets. 10% of total capacity
                    is left for Walk ins / All-Access passholders). TiestoWorld
                    is a special session spanning his careers work. There will also be some special guests.</p>
            </div>
        </div>

    </div>
</div>
<?php
include __DIR__ . '/../footer.php';
?>