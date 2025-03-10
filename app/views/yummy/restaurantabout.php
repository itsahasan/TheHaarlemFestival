<?php
require __DIR__ . '/../header.php';
?>

<head>
    <link rel="stylesheet" href="/css/restaurantaboutstyle.css">
</head>

<html>
<div class="container-fluid">
    <div class="row justify-content-around">

        <div class="col-4">
            <h3>Description</h3>
            <p><?= $restaurant->getDescription() ?></p>
        </div>
        <div class="col-4">
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($restaurant->getImage1()); ?>" class="image-fluid" alt="Loading image...">
        </div>
    </div>
    <div class="row justify-content-around">
        <div class="col-2">
            <h3>Details</h3>
            <p>Price: <?= $sessions[0]->getPrice() ?></p>
            <p>Cuisine: <?= $restaurant->getCuisine() ?> </p>
            <p>Rating: <?= $restaurant->getStars() ?> Stars</p>
        </div>
        <div class="col-3">
            <image src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($restaurant->getImage2()); ?>" class="image-fluid" alt="Loading image..." />
        </div>
        <div class="col-3">
            <h3><b>Contact</b></h3>
            <p><b>Address:</b> <?= $restaurant->getLocation() ?> </p>
            <p><b>Phone:</b> <?= $restaurant->getPhonenumber() ?> </p>
            <p><b>Email: </b> <?= $restaurant->getEmail() ?> </p>
        </div>
    </div>
    <div class="row justify-content-around">
        <div class="col-4">
            <image src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($restaurant->getImage3()); ?>" class="image-fluid" alt="Loading image..." />
        </div>
        <div class="col-5">
            <div class="alert alert-danger" role="alert" id="reservation-alert" style="display: none"></div>
            <h3>Make a reservation</h3>
            <form action="/yummy/addReservation?restaurantid=<?= $restaurant->getId() ?>" method="POST">
                <div class="form-field">
                    <div class="mb-3">
                        <label for="name" class="form-label"><b>Name:</b></label>
                        <input type="text" class="form-control" required name="name" id="name">
                    </div>
                    <p><b>Guests</b></p>
                    <div class="row" id="guests-select">
                        <div class="col">
                            <label><b>Adults:</b> </label>
                            <select name="formguestsadult">
                                <option value="1" selected="true">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div class="col">
                            <label><b>Children:</b> </label>
                            <select name="formguestskids">
                                <option value="0" selected="true">None</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-field">
                    <label><b>Day:</b> </label>
                    <select name="date">
                        <option value="2023-06-26">Thursday July 26th</option>
                        <option value="2023-06-27">Friday July 27th</option>
                        <option value="2023-06-28">Saturday July 28th</option>
                        <option value="2023-06-29">Sunday July 29th</option>
                    </select>
                </div>
                <div class="form-field">
                    <label><b>Time:</b> </label>
                    <select name="session" id="time-select">
                        <?php
                        $i = 1;
                        foreach ($sessions as $session) {
                            $date_input = strtotime($session->getStarttime());
                            $time = date('H:i', $date_input);
                        ?>
                            <option value="<?= $session->getId() ?>-<?= $time?>"><?= $time ?></option>
                        <?php
                            $i++;
                        } ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="request" class="form-label"><b>Special requests:</b></label>
                    <input type="text" class="form-control" name="request" id="request">
                </div>
                <button type="submit" class="btn btn-success" name="add-to-cart">Add reservation</button>
            </form>
        </div>
    </div>

</div>


<?php
require __DIR__ . '/../footer.php';
?>