<?php
include __DIR__ . '/../header.php';
?>
<head>
    <link rel="stylesheet" href="/css/music_cms_style.css">
</head>

<section class="py-5 bg-light">
    <div class="container">
    <div class="text-center mb-5">
        <div class="section-title">
            <h2 class="text-center">Shopping Cart</h2>
        </div>
    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="shopping-cart mr-4">
                <?php
                $total = 0;
                if ($_SESSION['cartcount'] > 0) {
                    foreach ($cartItems as $cartItem) {
                ?>
                        <div class="border rounded p-3 mb-4 bg-white">
                            <div class="row">
                                <div class="col-md-9">
                                    <h5 class="pt-2 mb-1">Event name: <?= $cartItem->getEvent_name() ?></h5>
                                    <h5 class="pt-2 mb-1">Price per ticket: &euro; <?= $cartItem->getEvent_price() ?></h5>
                                    <h5 class="pt-2 mb-1">Qty: <?= $cartItem->getQty() ?></h5>
                                    <h5 class="pt-2 mb-3">Subtotal: <?= $cartItem->getSubtotal() ?></h5>
                                    <form action="/shoppingcart?action=remove&id=<?= $cartItem->getId() ?>" method="post" class="cart-items product-data mb-1">
                                        <button type="submit" class="btn btn-danger" name="remove">Remove product from cart</button>
                                    </form>
                                </div>
                                <div class="col-md-3 py-5">
                                    <div>
                                        <form class="update-quantity-form" method="post">
                                            <div class="product-id" style="display:none;"><?= $cartItem->getId() ?></div>
                                            <div class="input-group">
                                                <span class="input-group mb-3">Update quantity:</span>
                                                <input type="number" name="quantity" value="<?= $cartItem->getQty() ?>" class="form-control cart-quantity" min="1" />
                                                <span class="input-group-btn ml-2">
                                                    <button class="btn btn-primary update-quantity" type="submit" name="updatemf">Update</button>
                                                </span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                <?php
                        $subtotal = $cartItem->getSubtotal();
                        $total += $subtotal;
                    }
                } else {
                    echo "<h5>Your cart is empty</h5>";
                }
                ?>
            </div>
        </div>
        <div class="col-md-4 bg-white border rounded h-25">
            <div class="pt-4">
                <h4 class="text-center card-title">Order Details</h4>
                <hr>
                <div class="row price-details">
                    <div class="col-md-6">
                        <?php
                        if ($_SESSION['cartcount'] > 0) {
                            $test = $_SESSION['cartcount'];
                            echo "<h6>Price ($test items)</h6>";
                        ?>
                            <h6>Delivery Charges</h6>
                            <hr>
                            <h6>Total Price</h6>
                            <hr>
                    </div>
                    <div class="col-md-6">
                        <h6>&euro; <?php echo $total; ?></h6>
                        <h6 class="text-success"> FREE </h6>
                        <hr>
                        <h6>&euro; <?php echo $total; ?></h6>
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <form method="post">
                            <button class="btn btn-success d-flex justify-content-center mb-3 w-100" name="proceed" type="submit">Proceed to checkout</button>
                            <a class="btn btn-primary d-flex justify-content-center mb-3 btn-share-cart w-100" href="#">Share your shopping cart with a friend</a>
                        </form>
                    </div>
                <?php
                        }
                ?>

                <?php
                if ($_SESSION['cartcount'] <= 0) {
                    echo "<h6>Price (0 items)</h6>";
                ?>
                    <h6>Delivery Charges</h6>
                    <hr>
                    <h6>Total Price</h6>
                    <hr>
                </div>
                <div class="col-md-6">
                    <h6>&euro; <?php echo $total; ?></h6>
                    <h6 class="text-success"> FREE </h6>
                    <hr>
                    <h6>&euro; <?php echo $total; ?></h6>
                    <hr>
                </div>
                <div class="col-md-12">
                    <form method="post">
                        <button class="btn btn-success d-flex justify-content-center mb-3 w-100" name="proceed" type="submit">Proceed to checkout</button>
                        <a class="btn btn-primary d-flex justify-content-center mb-3 btn-share-cart w-100" href="#">Share your shopping cart with a friend</a>
                    </form>
                </div>
            <?php
                }
            ?>
            </div>
        </div>
    </div>
</div>
</div>
</section>

<script>
    $(document).ready(function() {
        $('.update-quantity-form').on('submit', function() {
            var id = $(this).find('.product-id').text();
            var quantity = $(this).find('.cart-quantity').val();

            window.location.href = "/shoppingcart?action=update&id=" + id + "&qty=" + quantity;
            return false;
        });
    });

    $(document).ready(function() {
        $('.btn-share-cart').on('click', function() {
            var cartItems = <?php echo json_encode($cartItems); ?>;
            var shareUrl = 'http://localhost/shoppingcart/sharedCart?';

            if (cartItems.length > 0) {
                for (var i = 0; i < cartItems.length; i++) {
                    var id = cartItems[i]['id'];
                    var qty = cartItems[i]['qty'];

                    console.log(id, qty); // check values of id and qty

                    if (typeof id === 'number' && typeof qty === 'number') {
                        shareUrl += 'id[]=' + id + '&qty[]=' + qty + '&';
                    }
                }
                shareUrl = shareUrl.slice(0, -1); // remove the last '&'

                console.log(shareUrl);
                window.prompt("Copy the link below to share your shopping cart", shareUrl);
            }
        });
    });

</script>

<?php
include __DIR__ . '/../footer.php';
?>