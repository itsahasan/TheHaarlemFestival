<?php
include __DIR__ . '/../header.php';
?>

 <style>
    .payment-success-card {
      max-width: 500px;
      margin: 50px auto;
      border: 1px solid #e9ecef;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .payment-success-card .card-body {
      padding: 2rem;
      text-align: center;
    }
    .payment-success-card .fa-check-circle {
      font-size: 3rem;
      color: #28a745;
      margin-bottom: 1rem;
    }
    .payment-success-card h2 {
      font-size: 1.75rem;
      margin-bottom: 3rem;
    }
    .payment-success-card p {
      font-size: 1rem;
      color: #343a40;
    }
    .success-content{
        background:rgb(255, 235, 184);
        border-radius: 8px;
    }
  </style>
<div class="container py-5" style="min-height:60vh">
    <div class="container mt-5">
        <div class="payment-success-card card border">
            <div class="card-body">
                <i class="fas fa-check-circle"></i>
                <h2 class="text-success">Payment Successful!</h2>
                <div class="p-4 success-content">
                    <p class="mb-3  ">Thank you, <strong><?php echo $order->getFirstName() . " " . $order->getLastName(); ?></strong>for your payment.</p>
                    <p>Your tickets and invoice have been sent to: <strong><?php echo $hiddenEmail; ?></strong>.</p>
                </div>
                <div class="d-flex justify-content-center mt-4">
                    <a href="/" class="btn btn-primary mx-2">Return to Home</a>
                    <a href="/orders/myorders" class="btn btn-secondary mx-2">View My Orders</a>
                </div>
            </div>
        </div>

    </div>
</div>
<?php
include __DIR__ . '/../footer.php';
?>