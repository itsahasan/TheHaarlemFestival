<?php
include __DIR__ . '/../header.php';
?>

<style>
    .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
    }

    @media (min-width: 768px) {
        .bd-placeholder-img-lg {
            font-size: 3.5rem;
        }
    }

    .b-example-divider {
        height: 3rem;
        background-color: rgba(0, 0, 0, .1);
        border: solid rgba(0, 0, 0, .15);
        border-width: 1px 0;
        box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
    }

    .b-example-vr {
        flex-shrink: 0;
        width: 1.5rem;
        height: 100vh;
    }

    .bi {
        vertical-align: -.125em;
        fill: currentColor;
    }

    .nav-scroller {
        position: relative;
        z-index: 2;
        height: 2.75rem;
        overflow-y: hidden;
    }

    .nav-scroller .nav {
        display: flex;
        flex-wrap: nowrap;
        padding-bottom: 1rem;
        margin-top: -1px;
        overflow-x: auto;
        text-align: center;
        white-space: nowrap;
        -webkit-overflow-scrolling: touch;
    }

    #productImg {
        width: 100px;
    }
</style>

<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="text-center">Checkout form</h2>
    </div>
    <form action="" method="post">
        <div class="row g-5">
            <div class="col-md-5 col-lg-4 order-md-last">
                <h4 class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-primary">Your cart</span>
                    <span class="badge bg-white rounded-pill">
                        <span class="text-black">
                            <?php
                            if ($count > 0) {
                                echo "$count";
                            } else {
                                echo "0";
                            }
                            ?>
                        </span>
                    </span>
                </h4>
                <?php
                $subtotal = 0;
                $total = 0;
                if ($count > 0) {
                    foreach ($cartItems as $cartItem) {
                ?>
                        <ul class="list-group mb-3">
                            <li class="list-group-item d-flex justify-content-between lh-sm">
                                <div class="col-md-6">
                                    <small class="pt-2">
                                        <p>Event name: <?= $cartItem->getEvent_name() ?></p>
                                        <p> Qty: <?= $cartItem->getQty() ?></p>
                                        <p> Subtotal: &euro; <?= $cartItem->getSubtotal() ?></p>
                                    </small>
                                </div>
                                <span class="muted">&euro;<?= $cartItem->getEvent_price() ?></span>
                            </li>
                    <?php
                        $subtotal += $cartItem->getSubtotal();
                        $total = $subtotal + ($subtotal * (21 / 100));
                        $_SESSION['totalprice'] = number_format($subtotal, 2, '.');
                    }
                }
                    ?>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Subtotal (EUR)</span>
                        <strong>&euro;<?php echo number_format($subtotal, 2, '.'); ?> </strong>
                    </li>
                    <li class="list-group-item d-flex justify-content-between">
                        <span>Total(incl. VAT 21%) (EUR)</span>
                        <strong>&euro;<?php echo number_format($total, 2, '.'); ?> </strong>
                    </li>
                        </ul>
            </div>
            <div class="col-md-7 col-lg-8">
                <h4 class="mb-3">Billing address</h4>
                <div class="row g-3">
                    <div class="col-sm-6">
                        <label for="firstName" class="form-label">First name</label>
                        <input type="text" class="form-control" name="firstName" id="firstName" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            Valid first name is required.
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="lastName" class="form-label">Last name</label>
                        <input type="text" class="form-control" name="lastName" id="lastName" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            Valid last name is required.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Birth Date</label>
                        <input type="date" class="form-control datepicker" data-date-format="dd/mm/yyyy" name="birthdate" id="birthdate">
                        <div class="invalid-feedback">
                            Please enter your birth date.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" name="emailAddress" id="emailAddress" value="<?= $_SESSION['userEmail']; ?>" readonly>
                        <div class="invalid-feedback">
                            Please enter a valid email address for shipping updates.
                        </div>
                    </div>
                    <div class="col-12">
                        <label for="address" class="form-label">Address</label>
                        <input type="text" class="form-control" name="streetAddress" id="streetAddress" placeholder="1234 Main St" required>
                        <div class="invalid-feedback">
                            Please enter your shipping address.
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="country" class="form-label">Country</label>
                        <input type="text" class="form-control" name="country" id="country" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            Valid country is required.
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="zipCode" class="form-label">Zip Code</label>
                        <input type="text" class="form-control" name="zipCode" id="zipCode" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            Valid zip code is required.
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <label for="phoneNumber" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phoneNumber" id="phoneNumber" placeholder="" value="" required>
                        <div class="invalid-feedback">
                            Valid phone number is required.
                        </div>
                    </div>

                </div>
                <hr class="my-4">
                <form method="post" class="needs-validation">
                    <button class="w-100 btn btn-primary btn-lg" type="submit" name="placeorder">Pay Now</button>
                </form>
            </div>
        </div>
    </form>

    <?php
    include __DIR__ . '/../footer.php';
    ?>