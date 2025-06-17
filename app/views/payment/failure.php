<?php
// views/payment/failure.php
include __DIR__ . '/../header.php';
?>

<div class="container py-5">
    <div class="alert alert-danger text-center">
        <h3>Payment Failed!</h3>
        <p>Unfortunately your payment did not go through.</p>
    </div>

    <div class="d-flex justify-content-center mb-4">
        <a href="/payment/paylater?orderId=<?= htmlspecialchars($order->getId()) ?>"
           class="btn btn-primary me-3">
            Pay Later
        </a>
        <a href="/orders/cancel" class="btn btn-secondary">
            Cancel Order
        </a>
    </div>
</div>

<?php
include __DIR__ . '/../footer.php';
?>
