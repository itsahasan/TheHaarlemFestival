<?php
require __DIR__ . '/../header.php';
?>




<section class="pt-5 pb-5 restaurant-details" style="min-height:60vh">
    <div class="container">
        <!-- Description Card -->
        <div class="card mb-4 shadow-sm border-0 rounded-lg overflow-hidden">
            <div class="card-body p-0">
                <div class="row no-gutters">
                    <div class="col-md-8 p-4 bg-light">
                        <h3 class="mb-3 text-primary border-bottom pb-2">About the Restaurant</h3>
                        <p class="lead"><?= $restaurant->getDescription() ?></p>
                    </div>
                    <div class="col-md-4 d-flex align-items-center bg-light">
                        <img src="/uploads/<?php echo htmlspecialchars($restaurant->getImage1()); ?>"
                            class="img-fluid w-100 h-100 object-cover" alt="Restaurant Image"
                            style="object-fit: cover; min-height: 250px;">
                    </div>
                </div>
            </div>
        </div>

        <!-- Details Card -->
        <div class="card mb-5 shadow-sm border-0 rounded-lg overflow-hidden">
            <div class="card-body p-0">
                <div class="row no-gutters">
                    <div class="col-md-4 d-flex align-items-center p-0">
                        <img src="/uploads/<?php echo htmlspecialchars($restaurant->getImage2()); ?>"
                            class="img-fluid w-100 h-100" alt="Restaurant Interior"
                            style="object-fit: cover; min-height: 250px;">
                    </div>
                    <div class="col-md-4 p-4 bg-light">
                        <h3 class="mb-3 text-primary border-bottom pb-2">Details</h3>
                        <div class="detail-item d-flex align-items-center mb-3">
                            <i class="fas fa-tag mr-2 text-muted"></i>
                            <p class="mb-0"><strong>Price:</strong> <span
                                    class="badge badge-success p-2"><?= $sessions[0]->getPrice() ?></span></p>
                        </div>
                        <div class="detail-item d-flex align-items-center mb-3">
                            <i class="fas fa-utensils mr-2 text-muted"></i>
                            <p class="mb-0"><strong>Cuisine:</strong> <?= $restaurant->getCuisine() ?></p>
                        </div>
                        <div class="detail-item d-flex align-items-center">
                            <i class="fas fa-star mr-2 text-warning"></i>
                            <p class="mb-0"><strong>Rating:</strong>
                                <span class="rating">
                                    <?php
                                    $stars = $restaurant->getStars();
                                    for ($i = 0; $i < $stars; $i++) {
                                        echo '<i class="fas fa-star text-warning"></i>';
                                    }
                                    for ($i = $stars; $i < 5; $i++) {
                                        echo '<i class="far fa-star text-warning"></i>';
                                    }
                                    ?>
                                </span>
                            </p>
                        </div>
                    </div>

                    <div class="col-md-4 p-4 bg-light">
                        <h3 class="mb-3 text-primary border-bottom pb-2">Contact</h3>
                        <div class="contact-item d-flex align-items-center mb-3">
                            <i class="fas fa-map-marker-alt mr-2 text-danger"></i>
                            <p class="mb-0"><strong>Address:</strong> <?= $restaurant->getLocation() ?></p>
                        </div>
                        <div class="contact-item d-flex align-items-center mb-3">
                            <i class="fas fa-phone mr-2 text-primary"></i>
                            <p class="mb-0"><strong>Phone:</strong> <?= $restaurant->getPhonenumber() ?></p>
                        </div>
                        <div class="contact-item d-flex align-items-center">
                            <i class="fas fa-envelope mr-2 text-info"></i>
                            <p class="mb-0"><strong>Email:</strong> <?= $restaurant->getEmail() ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Reservation Section -->
        <div class="row">
            <div class="col-md-4 mb-4 mb-md-0">
                <div class="booking-image-wrapper rounded-lg overflow-hidden shadow-sm h-100">
                    <img src="/uploads/<?php echo htmlspecialchars($restaurant->getImage3()); ?>"
                        class="img-fluid w-100 h-100" alt="Restaurant Food"
                        style="object-fit: cover; min-height: 400px;">
                </div>
            </div>
            <div class="col-md-8">
                <div class="card p-2 shadow-sm rounded-lg bg-light">
                    <div class="card-header bg-primary text-white py-4">
                        <h3 class="card-title mb-0"><i class="fas fa-calendar-alt mr-2"></i> Make a Reservation</h3>
                    </div>
                    <div class="card-body p-4">
                        <div class="alert alert-danger" role="alert" id="reservation-alert" style="display: none"></div>
                        <form action="/yummy/addReservation?restaurantid=<?= $restaurant->getId() ?>" method="POST">
                            <div class="form-group">
                                <label for="name" class="font-weight-bold">Name:</label>
                                <input type="text" class="form-control " required name="name" id="name"
                                    placeholder="Enter your full name">
                            </div>

                            <div class="form-row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="font-weight-bold">Adults:</label>
                                    <select name="formguestsadult" class="form-control  custom-select">
                                        <option value="1" selected="true">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="font-weight-bold">Children:</label>
                                    <select name="formguestskids" class="form-control  custom-select">
                                        <option value="0" selected="true">None</option>
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-row mb-3">
                                <div class="col-md-6 mb-3 mb-md-0">
                                    <label class="font-weight-bold">Day:</label>
                                    <select name="date" class="form-control custom-select">
                                        <?php foreach ($dates as $day): ?>
                                            <?php
                                            $value = $day->value;
                                            $label = $day->name . ' ' . date('F jS', strtotime($value)); // 'Friday July 28th'
                                            $selected = (isset($_POST['date']) && $_POST['date'] === $value) ? 'selected' : '';
                                            ?>
                                            <option value="<?= $value ?>" <?= $selected ?>><?= $label ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>

                                <div class="col-md-6">
                                    <label class="font-weight-bold">Time:</label>
                                    <select name="session" id="time-select" class="form-control  custom-select">
                                        <?php
                                        $i = 1;
                                        foreach ($sessions as $session) {
                                            $date_input = strtotime($session->getStarttime());
                                            $time = date('H:i', $date_input);
                                            ?>
                                            <option value="<?= $session->getId() ?>-<?= $time ?>"><?= $time ?></option>
                                            <?php
                                            $i++;
                                        } ?>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="request" class="font-weight-bold"> Special requests:</label>
                                <textarea class="form-control" name="request" id="request" rows="3"
                                    placeholder="Any dietary requirements or special occasions?"></textarea>
                            </div>

                            <button type="submit" class="btn btn-success btn-lg btn-block" name="add-to-cart">
                                <i class="fas fa-check-circle mr-2"></i> Confirm Reservation
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php
require __DIR__ . '/../footer.php';
?>