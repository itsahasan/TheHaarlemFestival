<?php
// views/orders/checkout.php
include __DIR__ . '/../header.php';
?>

    <div class="container py-5">
        <div class="text-center mb-4">
            <h2>Checkout</h2>
            <p>Please enter your details to complete the order.</p>
        </div>

        <form action="/orders/create" method="post">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Billing Address
                        </div>
                        <div class="card-body">
                            <div class="row g-3">
                                <div class="col-sm-6">
                                    <label for="firstName" class="form-label">First name</label>
                                    <input type="text" class="form-control" id="firstName" name="firstName" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="lastName" class="form-label">Last name</label>
                                    <input type="text" class="form-control" id="lastName" name="lastName" required>
                                </div>
                                <div class="col-12">
                                    <label for="emailAddress" class="form-label">Email Address</label>
                                    <input type="email" class="form-control" id="emailAddress" name="emailAddress" value="<?= htmlspecialchars($_SESSION['userEmail'] ?? '') ?>" required>
                                </div>


                                <div class="col-12">
                                    <label for="birthdate" class="form-label">Birth Date</label>
                                    <input type="date" class="form-control" id="birthdate" name="birthdate" required max="<?= date('2007-12-30') ?>">
                                </div>
                                <div class="col-12">
                                    <label for="streetAddress" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="streetAddress" name="streetAddress" placeholder="1234 Main St" required>
                                </div>
                                <div class="col-sm-6">
                                    <label for="country" class="form-label">Country</label>
                                    <input type="text" class="form-control" id="country" name="country" required>
                                </div>

                                <div class="col-sm-6">
                                    <label for="zipCode" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" id="zipCode" name="zipCode" required>
                                </div>
                                <div class="col-12">
                                    <label for="phoneNumber" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
                                </div>
                            </div>

                            <hr class="my-4">

                            <button type="submit" class="btn btn-primary w-100 btn-lg">Place Order and Proceed to Payment</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

<?php
include __DIR__ . '/../footer.php';
?>