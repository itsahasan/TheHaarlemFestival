<?php
require __DIR__ . '/../header.php';
?>

<head>
    <link rel="stylesheet" href="/css/restaurantaboutstyle.css">
</head>

<div class="container py-5" style="background-color: #ffffff; border-radius: 10px; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
    <!-- Название ресторана -->
    <h2 class="text-center mb-4" style="font-weight: bold;">Restaurant <?= htmlspecialchars($restaurant->getName()) ?></h2>

    <!-- Контактная информация + главное изображение -->
    <div class="row mb-5 align-items-start">
        <div class="col-md-4">
            <div class="p-3 border border-danger mb-3">
                <h5><strong>Contact information</strong></h5>
                <p><strong>Location:</strong><br> <?= $restaurant->getLocation() ?></p>
                <p><strong>Phone:</strong><br> <?= $restaurant->getPhonenumber() ?></p>
                <p><strong>Email:</strong><br> <?= $restaurant->getEmail() ?></p>
            </div>
            <div class="p-3 border border-danger mb-3">
                <h6>Opening Hours:</h6>
                <ul class="mb-0" style="padding-left: 1rem;">
                    <li>Lunch: Friday–Monday 12:00–14:00</li>
                    <li>Dinner: Thursday–Monday 18:00–22:00</li>
                </ul>
            </div>
            <div class="p-3 border border-danger">
                <p><strong>Rating:</strong> <?= $restaurant->getStars() ?> stars</p>
            </div>
        </div>

        <div class="col-md-8">
            <div class="row g-3">
                <div class="col-12 text-center">
                    <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($restaurant->getImage1()); ?>" class="img-fluid rounded shadow-sm" alt="Restaurant">
                </div>
                <div class="col-md-6 text-center">
                    <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($restaurant->getImage2()); ?>" class="img-fluid rounded shadow-sm" alt="Dish 1">
                </div>
                <div class="col-md-6 text-center">
                    <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($restaurant->getImage3()); ?>" class="img-fluid rounded shadow-sm" alt="Dish 2">
                </div>
            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="mb-5">
        <h4 class="text-center">Description</h4>
        <p class="text-center mx-auto" style="max-width: 700px;">
            <?= $restaurant->getDescription() ?>
        </p>
    </div>

    <!-- Inclusivity Info -->
    <div class="mb-5">
        <h4 class="text-center">Inclusivity</h4>
        <div class="bg-danger text-white p-3 rounded text-center" style="max-width: 900px; margin: 0 auto;">
            Restaurant <?= htmlspecialchars($restaurant->getName()) ?> is generally accommodating to dietary needs and offers a welcoming atmosphere. If you have allergies, please contact the restaurant directly at <strong><?= $restaurant->getPhonenumber() ?></strong>.
        </div>
    </div>

    <!-- Бронирование -->
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm p-4">
                <div class="alert alert-danger" role="alert" id="reservation-alert" style="display: none"></div>
                <h4 class="mb-3">Make a reservation</h4>
                <form action="/yummy/addReservation?restaurantid=<?= $restaurant->getId() ?>" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label"><strong>Name:</strong></label>
                        <input type="text" class="form-control" required name="name" id="name">
                    </div>

                    <p class="mb-2"><strong>Guests</strong></p>
                    <div class="row mb-3" id="guests-select">
                        <div class="col">
                            <label for="formguestsadult"><strong>Adults:</strong></label>
                            <select class="form-select" name="formguestsadult" id="formguestsadult">
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <option value="<?= $i ?>" <?= $i === 1 ? 'selected' : '' ?>><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                        <div class="col">
                            <label for="formguestskids"><strong>Children:</strong></label>
                            <select class="form-select" name="formguestskids" id="formguestskids">
                                <option value="0" selected>None</option>
                                <?php for ($i = 1; $i <= 5; $i++): ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                <?php endfor; ?>
                            </select>
                        </div>
                    </div>

                    <?php
                    $date1 = new DateTime('2025-07-25');
                    $date2 = new DateTime('2025-07-26');
                    $date3 = new DateTime('2025-07-27');
                    $date4 = new DateTime('2025-07-28');
                    $dates = [$date1, $date2, $date3, $date4];
                    ?>

                    <div class="mb-3">
                        <label for="date"><strong>Day:</strong></label>
                        <select class="form-select" name="date" id="date">
                            <?php foreach ($dates as $date): ?>
                                <option value="<?= $date->format('Y-m-d') ?>">
                                    <?= $date->format('l jS \o\f F') ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="time-select"><strong>Time:</strong></label>
                        <select class="form-select" name="session" id="time-select">
                            <?php foreach ($sessions as $session): ?>
                                <?php $time = date('H:i', strtotime($session->getStarttime())); ?>
                                <option value="<?= $session->getId() ?>-<?= $time ?>"><?= $time ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="request" class="form-label"><strong>Special requests:</strong></label>
                        <input type="text" class="form-control" name="request" id="request">
                    </div>

                    <button type="submit" class="btn btn-danger w-100">Make a reservation</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require __DIR__ . '/../footer.php';
?>
