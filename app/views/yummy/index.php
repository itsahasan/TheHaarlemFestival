<?php
include __DIR__ . '/../header.php';
?>

<head>
    <link rel="stylesheet" href="/css/yummystyle.css">
</head>

<img src="/images/yummybanner.png" class="img-fluid" alt="Loading image...">

<!-- The following text is put in a container to make the allignment match up with the rest of the page -->
<div class="container">
    <h2 class="mt-4">Welcome to yummy!</h2>
    <p>Although Haarlem had not a globally known culinary tradition there are lots of restaurants that are worth your while. Here you
        can find all the restaurants that participate in this festival and their discounted prices! The food varies from Dutch cuisine
        to Indian!</p>
</div>

<!-- Container for the highlighted restaurants section -->
<div class="container pt-4 mt-4">
    <h2 class="text-center">The festival's hottest</h2>
    <div class="row">
        <?php
        for ($i = 0; $i < 3; $i++) {
        ?>
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($restaurants[$i]->getImage1()); ?>" class="card-img-top" alt="Loading image...">
                        <h4><?= $restaurants[$i]->getName() ?></h4>
                        <p><?= $restaurants[$i]->getDescription() ?></p>
                        <h4>Type</h4>
                        <p> <?= $restaurants[$i]->getCuisine() ?></p>
                    </div>
                    <div class="card-footer text-center">
                        <a href="/yummy/about?restaurantid=<?= $restaurants[$i]->getId() ?>" class="btn btn-primary stretched-link"> Learn more</a>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
</div>

<!-- Infocard -->
<div class="container mt-4">
    <div class="card infocard">
        <div class="card-body">
            <h4>Good to know:</h4>
            <div class="row justify-content-between">
                <div class="col-6">
                    <ul>
                        <li>Children under 12 years have 50% off at every restaurant</li>
                        <li>Reservation is mandatory. A reservation fee of €10/person will be charged when a reservation is made on
                            the Haarlem Festival site</li>
                        <li>All restaurants are located in Haarlem, Netherlands</li>
                    </ul>
                </div>
                <div class="col-4">
                    <img src="/images/goodtoknow.png" alt="Loading image..." class="image-fluid" />
                </div>
            </div>
        </div>
    </div>
</div>

<!-- All festival restaurants -->
<div class="container mt-4 pt-4">
    <h3>All restaurants</h3>
    <p>View all the restaurants participating in the yummy event</p>

    <div class="row">
        <?php
        foreach ($restaurants as $restaurant) {
        ?>
            <div class="col-3">
                <div class="card">
                    <div class="card-body">
                        <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($restaurant->getImage1()); ?>" class="card-img-top" alt="Loading image...">
                        <h4><?= $restaurant->getName() ?></h4>
                        <p><?= $restaurant->getDescription() ?></p>
                        <h4>Type</h4>
                        <p> <?= $restaurant->getCuisine() ?></p>
                    </div>
                    <div class="card-footer text-center">
                        <a class="btn btn-primary stretched-link" href="/yummy/about?restaurantid=<?= $restaurant->getId() ?>"> Learn more</a>
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