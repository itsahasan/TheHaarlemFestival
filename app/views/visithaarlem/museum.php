<?php
//incl new navbar
include __DIR__ . '/../navbar.php';
?>

<div style="position: relative; text-align: center; color: white;" class="click2edit">
    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($page->getHeaderImg()); ?>" width="100%" height="auto">
    <div style="position: absolute; bottom: 8px; left: 16px;">
        <h4 style="display:inline;"> Experience </h5>
            <h1 style="display:inline;" class="click2edit"> <?= $page->getTitle() ?></h1>
    </div>
</div>

<div class="album py-5">
    <div class="container mb-5">
        <div class="row">
            <div class="col-sm-12">
                <h5 class="text-center click2edit"><?= $page->getDescription() ?></h5>
            </div>
        </div>

        <button id="edit" class="btn btn-primary" onclick="edit()" type="button">Edit EVERYTHING</button>
        <button id="save" class="btn btn-primary" onclick="save()" type="button">Save ALL</button>

        <div class="row" style="display:flex; justify-content:center;">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3">
                <?php
                foreach ($pagecards as $card) {
                ?>
                    <div class="d-flex justify-content-center align-items-center">
                        <div class="card my-4">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="image-container" style="height: 300px; width: 400px;">
                                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($card->getImage()); ?>" class="rounded float-right ml-2" style="width: 100%; height: 100%;">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <div class="card-body" style="padding-left: 170px;">
                                        <h5 class="card-title"><?= $card->getTitle() ?></h5>
                                        <p class="card-text"><?= $card->getOpening_time() ?> until <?= $card->getClosing_time() ?></p>
                                        <p class="card-text"><i class="fa-solid fa-euro-sign"></i> Price: <?= $card->getAdult_price() ?> €</p>
                                        <p class="card-text"><i class="fa-solid fa-euro-sign"></i> Kids Price: <?= $card->getKids_price() ?> €</p>
                                        <p class="card-text"><i class="fa-regular fa-star"></i> <?= $card->getRating() ?>/10</p>
                                        <p class="card-text"><i class="fa-solid fa-location-dot"></i> <?= $card->getLocation() ?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>
    var edit = function() {
        $('.click2edit').each(function() {
            $(this).summernote({
                focus: true
            });
        })
    };

    var save = function() {
        $('.click2edit').each(function() {
            $(this).summernote('code');
            $(this).summernote('destroy');
        });
    };
</script>

<?php
include __DIR__ . '/../footer.php';
?>