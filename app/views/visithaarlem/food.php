<?php
require __DIR__ . '/../navbar.php';
?>

<head>
    <link rel="stylesheet" href="/css/foodstyle.css">
</head>

<div class="container-fluid">
    <h3 class="text-center click2edit"><?= $page->getTitle() ?></h3>
    <p class="click2edit"><?= $page->getDescription() ?></p>

    <button id="edit" class="btn btn-primary" onclick="edit()" type="button">Edit EVERYTHING</button>
    <button id="save" class="btn btn-primary" onclick="save()" type="button">Save ALL</button>
</div>

<!-- Page id 7, card id's 35 and up -->
<!-- Haarlem food -->
<div class="container-fluid">
    <div class="row" id="35">
        <div class="col">
            <h4 class="click2edit"><?= $pageCards[0]->getTitle(); ?></h4>
            <p class="click2edit"> <?= $pageCards[0]->getDescription() ?></p>

        </div>
        <div class="col">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[0]->getImage()) ?>" alt="Loading image..." class="image-fluid click2edit">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[1]->getImage()) ?>" alt="Loading image..." class="image-fluid click2edit">
        </div>
        <div class="col">
            <h4 class="click2edit"><?= $pageCards[1]->getTitle() ?></h4>
            <p class="click2edit"><?= $pageCards[1]->getDescription() ?>
            </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h4 class="click2edit"><?= $pageCards[2]->getTitle() ?></h4>
            <p class="click2edit"><?= $pageCards[2]->getDescription() ?></p>

            <p class="click2edit"><?= $pageCards[2]->getLink() ?></p>
        </div>
        <div class="col">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2435.5192238179534!2d4.634674315670638!3d52.37913717978769!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5ef6a3768f6c5%3A0x3e4a878bf70895c2!2sKleine%20Houtstraat%2013%2C%202011%20DD%20Haarlem!5e0!3m2!1snl!2snl!4v1681154941790!5m2!1snl!2snl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</div>

<!-- International -->

<h3 class="text-center"> <?= $pageCards[3]->getTitle() ?> </h3>

<div class="container-fluid ">
    <div class="row">
        <div class="col">
            <p class="click2edit"><?= $pageCards[3]->getDescription() ?> </p>
        </div>
        <div class="col">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[3]->getImage()) ?>" alt="Loading image..." class="image-fluid click2edit">
        </div>
    </div>
</div>
<div class="container-fluid">
    <h4 class="text-center click2edit"><b>International food</b></h4>
    <div class="row ">

        <div class="col">
            <div class="card">
                <div class="card-body">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[4]->getImage()) ?>" alt="Loading image..." class="card-img-top click2edit">
                    <h5 class="click2edit"><b><?= $pageCards[4]->getTitle() ?></b></h5>
                    <p class="click2edit"><?= $pageCards[4]->getDescription() ?></p>
                </div>
                <div class="card-footer">
                    <p class="click2edit"><?= $pageCards[4]->getLink() ?></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[5]->getImage()) ?>" alt="Loading image..." class="card-img-top click2edit">
                    <h5 class="click2edit"><b><?= $pageCards[5]->getTitle() ?></b></h5>
                    <p class="click2edit"><?= $pageCards[5]->getDescription() ?></p>
                </div>
                <div class="card-footer">
                    <p class="click2edit"><?= $pageCards[5]->getLink() ?></p>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[6]->getImage()) ?>" alt="Loading image..." class="card-img-top click2edit">
                    <h5 class="click2edit"><b><?= $pageCards[6]->getTitle() ?></b></h5>
                    <p class="click2edit"><?= $pageCards[6]->getDescription() ?></p>
                </div>
                <div class="card-footer">
                    <p class="click2edit"><?= $pageCards[6]->getLink() ?></p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Jopen bier -->
<h3 class="text-center">Nothing says Haarlem more than a nice glass of Jopen 🍺</h3>
<div class="container-fluid">
    <div class="row">
        <div class="col">
            <h4><b><?= $pageCards[7]->getTitle() ?></b></h4>
            <p><?= $pageCards[7]->getDescription() ?> </p>
        </div>
        <div class="col">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[7]->getImage()) ?>" alt="Loading image..." class="image-fluid">
        </div>
    </div>
    <div class="row">
        <div class="col">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[8]->getImage()) ?>" alt="Loading image..." class="image-fluid">
        </div>
        <div class="col">
            <h4><b><?= $pageCards[8]->getTitle() ?></b></h4>
            <p><?= $pageCards[8]->getDescription() ?> </p>
        </div>
    </div>
    <div class="row">
        <div class="col">
            <h4><b><?= $pageCards[9]->getTitle() ?></b></h4>
            <ul>
                <?= $pageCards[9]->getDescription() ?>
            </ul>
        </div>
        <div class="col">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($pageCards[9]->getImage()) ?>" alt="Loading image..." class="image-fluid">
        </div>
        
    </div>
    <div class="row">
        <div class="col">
            <h4><b><?= $pageCards[10]->getTitle() ?></b></h4>
            <p><?= $pageCards[10]->getDescription() ?></p>
            <p><?= $pageCards[10]->getLink() ?></p>
        </div>
        <div class="col" >
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2435.4046466912273!2d4.627542815670747!3d52.381214479788134!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c5ef14ed768603%3A0x5ff6ab7a87061c90!2sJopenkerk%20Haarlem!5e0!3m2!1snl!2snl!4v1681155061017!5m2!1snl!2snl" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
require __DIR__ . '/../footer.php';
?>