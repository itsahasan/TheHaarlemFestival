<?php
include __DIR__ . '/../header.php';
?>

    <head>
        <link rel="stylesheet" href="/css/yummystyle.css">
    </head>

    <img src="/images/yummybanner.png" class="banner-img" alt="Loading image...">

    <div class="container main-intro">
        <h2>Culinary sightseeings of Haarlem</h2>
        <p>Do you like eating delicious dishes? During the Festival you will have such an opportunity. On this page you can see a list of the Restaurants that take a part in the Festival and in which you can spend time in a good atmosphere with delicious meals, and reserve a table in a restaurant you like.</p>
    </div>

    <div class="restaurant-section">
        <?php foreach ($restaurants as $restaurant) { ?>
            <div class="restaurant-card">
                <div class="restaurant-info">
                    <h3><?= htmlspecialchars($restaurant['name']) ?></h3>
                    <div class="info-block">
                        <strong>Location:</strong> <?= htmlspecialchars($restaurant['location']) ?>
                    </div>
                    <div class="info-block">
                        <strong>Price:</strong> €<?= htmlspecialchars($restaurant['price']) ?>; €<?= htmlspecialchars($restaurant['price'] / 2) ?> for children
                    </div>
                    <div class="info-block">
                        <strong>Type:</strong> <?= htmlspecialchars($restaurant['cuisine']) ?>
                    </div>
                    <a class="btn-find-more" href="/yummy/about?restaurantid=<?= $restaurant['id'] ?>">Find more</a>
                </div>
                <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($restaurant['image1_data']); ?>" alt="<?= htmlspecialchars($restaurant['name']) ?> image" class="restaurant-img">
            </div>
        <?php } ?>
    </div>

<?php
include __DIR__ . '/../footer.php';
?>