<?php
include __DIR__ . '/../header.php';
?>
<div class="container py-5">
    <div class="container mt-5">
        <h2 class="text-success">Payment Successful!</h2>
        <p>Thank you, <strong><?php echo $order->getFirstName() . " " . $order->getLastName(); ?></strong>, for your payment. Your tickets and invoice have been sent to: <strong><?php echo $hiddenEmail; ?></strong>.</p>

        <!-- Button to return to home -->
        <a href="/" class="btn btn-primary">Return to Home</a>

        <!-- Button to view orders -->
        <a href="/orders/myorders" class="btn btn-secondary ml-2">View My Orders</a>
    </div>
</div>
<?php
include __DIR__ . '/../footer.php';
?>