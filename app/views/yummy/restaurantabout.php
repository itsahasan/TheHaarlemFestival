<?php
require __DIR__ . '/../header.php';
?>

<head>
    <link rel="stylesheet" href="/css/restaurantaboutstyle.css">
</head>

<html>
<div class="container py-5">
    <!-- Блок 1: описание + основное фото -->
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <h3>Description</h3>
            <p><?= $restaurant->getDescription() ?></p>
        </div>
        <div class="col-md-6 text-center">
            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($restaurant->getImage1()); ?>" class="img-fluid rounded shadow-sm" alt="Restaurant image">
        </div>
    </div>

    <!-- Блок 2: детали + второе фото + контакты -->
    <div class="row mb-5">
        <div class="col-md-4">
            <h4>Details</h4>
            <p><strong>Price:</strong> €<?= $sessions[0]->getPrice() ?></p>
            <p><strong>Cuisine:</strong> <?= $restaurant->getCuisine() ?></p>
            <p><strong>Rating:</strong> <?= $restaurant->getStars() ?> Stars</p>
        </div>
        <div class="col-md-4 text-center">
            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($restaurant->getImage2()); ?>" class="img-fluid rounded shadow-sm" alt="Dish image">
        </div>
        <div class="col-md-4">
            <h4>Contact</h4>
            <p><strong>Address:</strong> <?= $restaurant->getLocation() ?></p>
            <p><strong>Phone:</strong> <?= $restaurant->getPhonenumber() ?></p>
            <p><strong>Email:</strong> <?= $restaurant->getEmail() ?></p>
        </div>
    </div>

    <!-- Блок 3: десерт + форма -->
    <div class="row mb-5">
        <div class="col-md-6 text-center">
            <img src="data:image/jpg;charset=utf8;base64,<?= base64_encode($restaurant->getImage3()); ?>" class="img-fluid rounded shadow-sm" alt="Dessert image">
        </div>
        <div class="col-md-6">
            <div class="card p-4 shadow-sm">
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

                    <div class="mb-3">
                        <label for="date"><strong>Day:</strong></label>
                        <select class="form-select" name="date" id="date">
                            <option value="2023-06-26">Thursday July 26th</option>
                            <option value="2023-06-27">Friday July 27th</option>
                            <option value="2023-06-28">Saturday July 28th</option>
                            <option value="2023-06-29">Sunday July 29th</option>
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

                    <button type="submit" class="btn btn-success w-100">Add reservation</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
require __DIR__ . '/../footer.php';
?>
