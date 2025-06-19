<?php
// views/payment/shopping-cart.php
include __DIR__ . '/../header.php';
?>

    <div class="container-fluid py-5">
        <div class="text-center mb-5">
            <h2>Shopping Cart</h2>
        </div>

        <div class="row px-5">
            <div class="col-md-7 mt-4">
                <div class="shopping-cart">
                    <?php if (!empty($cartItems)): ?>
                        <?php foreach ($cartItems as $cartItem): ?>
                            <div class="row border border-dark rounded mb-2 align-items-center p-2">
                                <div class="col-md-6">
                                    <h5 class="pt-2">Event name: <?= htmlspecialchars($cartItem->getEventname()) ?></h5>
                                    <p class="mb-1">Price per ticket: &euro; <?= number_format($cartItem->getEventprice(), 2) ?></p>
                                    <p class="mb-1">Qty: <?= $cartItem->getQty() ?></p>
                                    <p class="mb-1"><strong>Subtotal: &euro; <?= number_format($cartItem->getQty() * $cartItem->getEventprice(), 2) ?></strong></p>

                                    <form action="/shoppingcart/remove" method="post" class="mt-2">
                                        <input type="hidden" name="productId" value="<?= htmlspecialchars($cartItem->getProductid()) ?>">
                                        <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </div>

                                <div class="col-md-6">
                                    <form action="/shoppingcart/update" method="post">
                                        <input type="hidden" name="productId" value="<?= htmlspecialchars($cartItem->getProductid()) ?>">
                                        <div class="input-group">
                                            <span class="input-group-text">Update quantity:</span>
                                            <input type="number" name="quantity" value="<?= $cartItem->getQty() ?>" class="form-control" min="1">
                                            <button class="btn btn-secondary" type="submit">Update</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <h5>Your cart is empty</h5>
                    <?php endif; ?>
                </div>
            </div>

            <div class="col-md-5 mt-4">
                <div class="border rounded p-4">
                    <h6 class="text-center mb-3">Order Details</h6>
                    <p>Price (<?= $_SESSION['cartcount'] ?? 0 ?> items):
                        &euro; <?= number_format($total, 2) ?>
                    </p>
                    <p>Delivery Charges: FREE</p>
                    <hr>
                    <p><strong>Total: &euro; <?= number_format($total, 2) ?></strong></p>
                </div>

                <hr class="my-4">

                <?php if (!empty($cartItems)): ?>
                    <form action="/orders/checkout" method="post">
                        <div class="mt-4">
                            <button type="submit" class="btn btn-success w-100 btn-lg">
                                Proceed to checkout
                            </button>
                        </div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>

<?php
include __DIR__ . '/../footer.php';
?>