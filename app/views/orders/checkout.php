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
                            <!-- First name: letters only, 2–50 chars -->
                            <div class="col-sm-6">
                                <label for="firstName" class="form-label">First name</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id="firstName"
                                        name="firstName"
                                        required
                                        pattern="^[A-Za-z]+$"
                                        title="First name can only contain letters"
                                        minlength="2"
                                        maxlength="50"
                                >
                            </div>

                            <!-- Last name: letters only, 2–50 chars -->
                            <div class="col-sm-6">
                                <label for="lastName" class="form-label">Last name</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id="lastName"
                                        name="lastName"
                                        required
                                        pattern="^[A-Za-z]+$"
                                        title="Last name can only contain letters"
                                        minlength="2"
                                        maxlength="50"
                                >
                            </div>

                            <!-- Email: starts empty, valid email format -->
                            <div class="col-12">
                                <label for="emailAddress" class="form-label">Email Address</label>
                                <input
                                        type="email"
                                        class="form-control"
                                        id="emailAddress"
                                        name="emailAddress"
                                        placeholder="you@example.com"
                                        required
                                >
                            </div>

                            <!-- Birthdate: max ensures user is at least 16 -->
                            <div class="col-12">
                                <label for="birthdate" class="form-label">Birth Date</label>
                                <input
                                        type="date"
                                        class="form-control"
                                        id="birthdate"
                                        name="birthdate"
                                        required
                                        max="<?= date('Y-m-d', strtotime('-16 years')) ?>"
                                >
                            </div>

                            <!-- Street address: free-form -->
                            <div class="col-12">
                                <label for="streetAddress" class="form-label">Address</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id="streetAddress"
                                        name="streetAddress"
                                        placeholder="1234 Main St"
                                        required
                                        maxlength="100"
                                >
                            </div>

                            <!-- Country: letters and spaces only -->
                            <div class="col-sm-6">
                                <label for="country" class="form-label">Country</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id="country"
                                        name="country"
                                        required
                                        pattern="^[A-Za-z\s]+$"
                                        title="Country can only contain letters and spaces"
                                        maxlength="56"
                                >
                            </div>

                            <!-- Zip code: digits only, 4-10 chars -->
                            <div class="col-sm-6">
                                <label for="zipCode" class="form-label">Zip Code</label>
                                <input
                                        type="text"
                                        class="form-control"
                                        id="zipCode"
                                        name="zipCode"
                                        required
                                        title="Zip code must be 4–10 digits"
                                >
                            </div>

                            <!-- Phone: digits, spaces, +, - only -->
                            <div class="col-12">
                                <label for="phoneNumber" class="form-label">Phone Number</label>
                                <input
                                        type="tel"
                                        class="form-control"
                                        id="phoneNumber"
                                        name="phoneNumber"
                                        required
                                        pattern="^[0-9+\-\s()]{7,20}$"
                                        title="Phone can contain digits, spaces, parentheses, + and -"
                                >
                            </div>
                        </div>

                        <hr class="my-4">

                        <button type="submit" class="btn btn-primary w-100 btn-lg">
                            Place Order and Proceed to Payment
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php
include __DIR__ . '/../footer.php';
?>
