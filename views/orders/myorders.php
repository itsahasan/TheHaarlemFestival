<?php
include __DIR__ . '/../header.php';
?>

<head>
    <link rel="stylesheet" href="/css/music_cms_style.css">
</head>

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

<div class="container py-5" style="min-height:60vh">
    <div class="section-title text-center">
        <h2>My Orders</h2>
    </div>
    <?php
    $ordercount = 1;
    foreach ($myOrders as $myOrder) {
        ?>
        <ul class="list-group mb-3">
            <li class="list-group-item bg-light p-4">
                <div class="row">

                    <div class="col-md-6">
                        <h4 class="font-weight-bold mb-3">Order #<?= $ordercount ?></h4>
                        <p class="mb-3"><strong>Event:</strong> <?= $myOrder->getEvent_name() ?></p>
                        <p class="mb-0"><strong>Quantity:</strong> <?= $myOrder->getQty() ?></p>
                    </div>

                    <div class="col-md-6 text-md-right mt-3 mt-md-0">
                        <p class="mb-4"><strong>Total:</strong> &euro;<?= $myOrder->getEvent_price() ?></p>
                        <?php
                        $foundPaymentStatus = false;
                        $orderStatus = $this->placeorderService->getOnePlacedOrder($myOrder->getOrder_id());
                        try {
                            $payment = $this->mollie->payments->get($orderStatus->getPaymentId());
                        } catch (\Exception $e) {
                        }
                        $status = $payment->status;

                        if ($status && !$foundPaymentStatus) {
                            $foundPaymentStatus = true;
                        ?>
                            <span class="badge p-2 badge-<?= $status === 'paid' ? 'success' : 'secondary' ?>">
                                Payment: <?= ucfirst($status) ?>
                            </span>

                            
                        <?php } ?>
                    </div>
                </div>
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