<?php
// views/orders/myorders.php
include __DIR__ . '/../header.php';
?>

    <div class="container py-5">
        <h2 class="text-center mb-4">My Orders</h2>

        <?php if (empty($orders)): ?>
            <div class="alert alert-info">You have no orders yet.</div>
        <?php else: ?>
            <div class="list-group">
                <?php foreach ($orders as $order): ?>
                    <div class="list-group-item list-group-item-action flex-column align-items-start mb-3 border">
                        <div class="d-flex w-100 justify-content-between">
                            <h5 class="mb-1">Order #<?= $order->getId() ?></h5>
                            <small>Date: <?= (new DateTime($order->getCreatedAt()))->format('Y-m-d H:i') ?></small>
                        </div>
                        <p class="mb-1">
                            <strong>Total Price:</strong> &euro;<?= number_format($order->getTotalPrice(), 2) ?><br>
                            <strong>Status:</strong> <span class="badge bg-success text-white"><?= htmlspecialchars($order->getPaymentStatus()) ?></span>
                        </p>
                        <small>Recipient: <?= htmlspecialchars($order->getFirstName() . ' ' . $order->getLastName()) ?></small>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>

<?php
include __DIR__ . '/../footer.php';
?>