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
            <h2 class="my-3">HF Dance Events at this location</h2>
            <div class="row mt-3">
                <?php foreach ($events as $event): ?>
                    <div class="col mb-3">
                        <div class="card shadow-sm">
                            <div class="card-footer text-light bg-dark text-center">
                                <p class="text-center"><a href="/artist/danceartistdetails?id=<?= $event->getArtist() ?>">Discover more</a></p>
                                <form action="/event/addToCart" method="post">
                                    <?php if ($event->getTickets_available() == 0): ?>
                                        <button class="btn btn-secondary" name="add-to-cart" disabled>Add to cart</button>
                                    <?php else: ?>
                                        <button class="btn btn-secondary" name="add-to-cart">Add to cart</button>
                                    <?php endif; ?>
                                    <input type="hidden" name="product_id" value="<?= $event->getId() ?>">
                                </form>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>

<?php
include __DIR__ . '/../footer.php';
?>