<?php
include __DIR__ . '/../header.php';
?>

<head>
    <link rel="stylesheet" href="/css/yummystyle.css">
</head>

<div class="yummy-banner-section">
    <div class="content">
        <h2>Welcome to yummy!</h2>
        <p>Although Haarlem had not a globally known culinary tradition there are lots of restaurants that are worth your while. Here you
            can find all the restaurants that participate in this festival and their discounted prices! The food varies from Dutch cuisine
            to Indian!</p>   
    </div>
    <img src="/images/yummybanner.png" class="yummy-banner-img" alt="Loading image...">

</div>

<!-- The following text is put in a container to make the allignment match up with the rest of the page -->


<!-- Container for the highlighted restaurants section -->
 <section class="pt-5">
     <div class="container">
        <div class="section-title text-center ">
            <h2 class="">The festival's hottest</h2>
        </div>
         <div class="row">
             <?php
             for ($i = 0; $i < 3; $i++) {
                 if(!isset($restaurants[$i])){
                     break;
                 }
             ?>
                 <div class="col">
                     <div class="product-card">
                         <div class="image">
                             <img src="/uploads/<?php echo htmlspecialchars($restaurants[$i]->getImage1()); ?>" class="card-img-top" alt="Loading image...">
                         </div>
                         <div class="content">
                             <h4><?= $restaurants[$i]->getName() ?></h4>
                             <p><?= $restaurants[$i]->getDescription() ?></p>
                             <h4>Type</h4>
                             <p> <?= $restaurants[$i]->getCuisine() ?></p>
                             <div class="mt-4">
                                 <a href="/yummy/details?restaurantid=<?= $restaurants[$i]->getId() ?>" class="btn btn-primary stretched-link"> Learn more</a>
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

<!-- Infocard -->
 <section class="pt-5">
     <div class="container">
         <div class="card infocard">
             <div class="card-body">
                 <h3 class="mb-4 fs-20">Good to know:</h3>
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
 </section>

<!-- All festival restaurants -->
<section class="pt-5 pb-5" style="min-height:60vh">
    <div class="container">
        <div class="section-title text-center ">
            <h2>All restaurants</h2>
            <p>View all the restaurants participating in the yummy event</p>
        </div>
    
        <div class="row">
            <?php
            foreach ($restaurants as $restaurant) {
            ?>
                <div class="col-4">
                    <div class="product-card">
                        <div class="image">
                            <img src="/uploads/<?php echo htmlspecialchars($restaurant->getImage1()); ?>"  class="card-img-top" alt="Loading image...">
                        </div>
                        <div class="content">
                            <h4><?= $restaurant->getName() ?></h4>
                            <p><?= $restaurant->getDescription() ?></p>
                            <h4>Type</h4>
                            <p> <?= $restaurant->getCuisine() ?></p>
                            <div class="mt-4">
                                <a class="btn btn-primary stretched-link" href="/yummy/details?restaurantid=<?= $restaurant->getId() ?>"> Learn more</a>
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


<?php
include __DIR__ . '/../footer.php';
?>