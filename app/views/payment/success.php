<?php
// views/payment/success.php
include __DIR__ . '/../header.php';
?>

<div class="container py-5">
    <div class="text-center mb-4">
        <h2 class="text-success">Payment Successful!</h2>
        <p>Thank you, <strong><?= htmlspecialchars($order->getFirstName() . ' ' . $order->getLastName()) ?></strong>,
            your payment has been received.</p>
        <p>Tickets and invoice have been sent to <strong><?= htmlspecialchars($hiddenEmail) ?></strong>.</p>
    </div>

    <div class="d-flex justify-content-center">
        <a href="/" class="btn btn-primary me-3">Return Home</a>
        <a href="/orders/myorders" class="btn btn-secondary">View My Orders</a>
    </div>
</div>

<?php
include __DIR__ . '/../footer.php';
?>
