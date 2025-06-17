<?php include __DIR__ . '/../header.php'; ?>

    <div class="container py-5">
        <h3>Checkout for Order #<?= htmlspecialchars($order->getId()) ?></h3>
        <p>Total Amount: &euro;<?= number_format($order->getTotalPrice() * 1.21, 2) ?> (incl. 21% VAT)</p>
        <hr>
        <div class="row">
            <div class="col-md-6">
                <h4>Billing Address</h4>
                <form method="post" action="/payment/checkout?orderId=<?= $order->getId() ?>">
                    <div class="mb-2">
                        <label for="firstName">First Name</label>
                        <input type="text" name="firstName" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="lastName">Last Name</label>
                        <input type="text" name="lastName" class="form-control" required>
                    </div>
                    <div class="mb-2">
                        <label for="streetAddress">Address</label>
                        <input type="text" name="streetAddress" class="form-control" required>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-lg w-100">Generate Payment QR-Code</button>
                </form>
            </div>
            <div class="col-md-6">
                <?php if (isset($payment) && $payment): ?>
                    <div class="text-center border rounded p-4">
                        <h4>Scan to Pay</h4>
                        <img src="<?= htmlspecialchars($payment->getQrCode()->src) ?>" alt="Scan QR to pay">
                        <p class="mt-3">Or <a href="<?= htmlspecialchars($payment->getCheckoutUrl()) ?>" target="_blank">click here to pay</a>.</p>
                        <p class="small text-muted">Waiting for payment...</p>
                    </div>
                <?php else: ?>
                    <div class="text-center border rounded p-4 bg-light">
                        <p class="m-0">Please fill out your details on the left to generate a payment code.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php include __DIR__ . '/../footer.php'; ?>