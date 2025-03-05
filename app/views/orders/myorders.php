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
        <h2 class="text-center">My Orders</h2>
    </div>
    <?php
    $ordercount = 1;
    foreach ($myOrders as $myOrder) {
    ?>
        <ul class="list-group mb-3">
            <li class="list-group-item d-flex justify-content-between lh-sm">
                <div class="col-md-6">
                    <h5 class="mb1">Order Item: <?= $ordercount ?></h5>
                    <small class="pt-2">
                        <p>Event name: <?= $myOrder->getEvent_name() ?></p>
                        <p> Qty: <?= $myOrder->getQty() ?></p>
                    </small>
                </div>
                <span class="muted">Total: &euro;<?= $myOrder->getEvent_price() ?></span>
                <?php
                $foundPaymentStatus = false;
                foreach ($orderStatus as $status) {
                    $paymnet = $this->mollie->payments->get($status->getPaymentId());
                    $status = $paymnet->status;
                    if ($status && !$foundPaymentStatus) {
                        $foundPaymentStatus = true;
                ?>
                        <span class="muted">Payment status: <?= $status ?></span>
                <?php
                    }
                }
                ?>
            </li>
        </ul>
    <?php
        $ordercount++;
    }
    ?>
</div>

<?php
include __DIR__ . '/../footer.php';
?>