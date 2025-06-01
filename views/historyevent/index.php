<?php
include __DIR__ . '/../header.php';
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css"
    integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<head>
    <link rel="stylesheet" href="/css/music_cms_style.css">
</head>


<section class="pt-5 pb-5" style="min-height:60vh">
    <div class="section-title text-center">
        <h2>History Events</h2>
    </div>

    <div class="row container mx-auto" style="max-width: 1000px;">
        <div>
            <div class="my-3 text-center">
                <form method="POST" class="d-inline-block">
                    <input type="submit" name="all" value="All Events" class="btn  mx-3 filterbtn <?= isset($_POST['all']) ? 'btn-success' : 'btn-outline-success' ?>">
                </form>

                <?php foreach ($dates as $day): ?>
                    <?php
                    $date = $day->value;
                    $label = $day->name . ' ' . date('d', strtotime($date));
                    $isActive = isset($_POST[$date]) ? 'btn-primary' : 'btn-outline-primary';
                    ?>
                    <form method="POST" class="d-inline-block">
                        <input type="submit" name="<?= $date ?>" value="<?= $label ?>"
                            class="btn mx-3 filterbtn <?= $isActive ?>">
                    </form>
                <?php endforeach; ?>
            </div>


            <?php
            foreach ($model as $historyevent) {
                ?>
                <div class="card mt-3">
                    <div class="card-header">
                        <h5 class="text-start mb-4" style="color: darkred;">Guide Group:
                            <?= $historyevent->getTourguideName() ?></h5>
                        <div class="row align-items-center">
                            <div class="col-md-6">
                                <div class="card-text">
                                    <h5 class="card-title">Description</h5><?= $historyevent->getTourguideDescription() ?>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <img class="card-img" style="opacity: 70%;"
                                    src="/uploads/<?php echo htmlspecialchars($historyevent->getImage()); ?>">
                            </div>
                        </div>
                        <div class="card-body">
                            <?php
                            if ($historyevent->getTicketsAvailable() <= 0) {
                                ?>
                                <h4 class="text-secondary fw-bold">SOLD OUT 😢</h4>
                                <?php
                            } elseif ($historyevent->getTicketsAvailable() <= 3) {
                                ?>
                                <h6 class="text-danger fw-bold mb-3">Only <?= ucfirst($historyevent->getTicketsAvailable()) ?>
                                    tickets left!</h6>
                                <div class="card-button">
                                    <form action="/historyevent" method="post">
                                        <button class="btn btn-info" name="add-to-cart">Add to cart for
                                            <?= $historyevent->getPrice() ?>€</button>
                                        <input type="hidden" name="product_id" value="<?= $historyevent->getId() ?>">
                                    </form>
                                </div>
                                <?php
                            } elseif ($historyevent->getTicketsAvailable() > 3) {
                                ?>
                                <h6 class="text-success fw-bold mb-3">Seats available:
                                    <?= ucfirst($historyevent->getTicketsAvailable()) ?></h6>
                                <div class="card-button col-xs-1">
                                    <form action="/historyevent" method="post">
                                        <button class="btn btn-info" name="add-to-cart">Add to cart for
                                            <?= $historyevent->getPrice() ?>€</button>
                                        <input type="hidden" name="product_id" value="<?= $historyevent->getId() ?>">
                                    </form>
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                    <div class="card-footer text-center">
                        <div class="row">
                            <div class="row-2">
                                <div class="col-md-12">
                                    <p class="text-muted">Location:</p>
                                </div>
                            </div>
                            <div class="col-ml-1">
                                <small class="text-muted">at</small>
                            </div>
                            <div class="col-md-3" style="padding-right: 50px;">
                                <small class="text-muted font-weight-bold"><?= $historyevent->getLocation() ?></small>
                            </div>
                            <div class="col-2-md-3" style="padding-right: 50px;">
                                <small class="text-muted">on</small>
                            </div>
                            <div class="col-1-md-3">
                                <small class="text-muted font-weight-bold"><?= $historyevent->getFormattedDate() ?></small>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>
        </div>
    </div>
</section>

<script>
    document.getElementById('show-adding-form').addEventListener('click', function () {
        document.getElementById('form-add-container').style.display = 'block';
    });
</script>
<?php include __DIR__ . '/../footer.php'; ?>