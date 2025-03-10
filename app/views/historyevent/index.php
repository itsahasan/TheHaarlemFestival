<?php
include __DIR__ . '/../header.php';
?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">


<div class="bg-light p-5 rounded-lg" style="height: 300px;
    text-align:center;
    display:table;
    width:100%;
    background-size: cover;
    background-position: bottom;">
    <h1 class="display-4" style="    font-size: 110px;
    text-align: center;
    display: table-cell;
    vertical-align: middle;
    color: gray;">History Events</h1>
</div>

<div class="row container mx-auto" style="max-width: 1000px;">
    <div class="mt-4">
        <div class="my-3 text-center">
            <form method="POST" class="d-inline-block">
                <input type="submit" name="events" value="All Events" class="btn btn-success mx-3 filterbtn"></a>
            </form>
            <form method="POST" class="d-inline-block">
                <input type="submit" name="friday" value="Friday 28" class="btn btn-primary mx-3 filterbtn"></a>
            </form>
            <form method="POST" class="d-inline-block">
                <input type="submit" name="saturday" value="Saturday 29" class="btn btn-primary mx-3 filterbtn"></a>
            </form>
            <form method="POST" class="d-inline-block">
                <input type="submit" name="sunday" value="Sunday 30" class="btn btn-primary mx-3 filterbtn"></a>
            </form>
            <form method="POST" class="d-inline-block">
                <input type="submit" name="monday" value="Monday 31" class="btn btn-primary mx-3 filterbtn"></a>
            </form>
        </div>

        <?php
        foreach ($model as $historyevent) {
        ?>
            <div class="card mt-3">
                <div class=" card-header">
                    <h1 class="text-center" style="color: darkred;">Guide Group: <?= $historyevent->getTourguideName() ?></h1>
                    <div class="row">
                        <div class="col-md-6">
                            <img class="card-img" style="opacity: 70%;" src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($historyevent->getImage()); ?>">
                        </div>
                        <div class="col-md-6">
                            <h4 class="card-text">
                                <h3 class="card-title">Description</h3><?= $historyevent->getTourguideDescription() ?>
                            </h4>
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
                            <h4 class="text-danger fw-bold">Only <?= ucfirst($historyevent->getTicketsAvailable()) ?> tickets left!</h4>
                            <div class="card-button">
                                <form action="/historyevent" method="post">
                                    <button class="btn btn-secondary" name="add-to-cart">Add to cart for <?= $historyevent->getPrice() ?>€</button>
                                    <input type="hidden" name="product_id" value="<?= $historyevent->getId() ?>">
                                </form>
                            </div>
                        <?php
                        } elseif ($historyevent->getTicketsAvailable() > 3) {
                        ?>
                            <h4 class="text-success fw-bold">Seats available: <?= ucfirst($historyevent->getTicketsAvailable()) ?></h4>
                            <div class="card-button col-xs-1">
                                <form action="/historyevent" method="post">
                                    <button class="btn btn-secondary" name="add-to-cart">Add to cart for <?= $historyevent->getPrice() ?>€</button>
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
                            <small class="text-muted"><?= $historyevent->getLocation() ?></small>
                        </div>
                        <div class="col-2-md-3" style="padding-right: 50px;">
                            <small class="text-muted">on</small>
                        </div>
                        <div class="col-1-md-3">
                            <small class="text-muted"><?= $historyevent->getFormattedDate() ?></small>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<?php
include __DIR__ . '/../footer.php';
?>