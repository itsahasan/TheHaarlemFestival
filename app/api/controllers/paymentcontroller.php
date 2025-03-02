<?php
require __DIR__ . '/../../services/paymentservice.php';
require __DIR__ . '/../../services/ordersservice.php';
require_once __DIR__ . "/../../vendor/autoload.php";

class PaymentController
{
    private $orderservice;
    private $paymentservice;
    private $mollie; // Add private property for Mollie API client

    function __construct()
    {
        $this->paymentservice = new PaymentService();
        $this->orderservice = new OrdersService();
        $this->mollie = new \Mollie\Api\MollieApiClient();
        $this->mollie->setApiKey("test_5jaAakyFRh8n9cNuC8p8aQR8gF3jp3"); // Set API key here
    }

    public function index()
    {
        if ($_SERVER["REQUEST_METHOD"] == "GET") {
            $this->__construct();

            if (!$this->verifyKey()) {
                http_response_code(401);
                return;
            }

            $paidOrders = $this->orderservice->getPaidOrders();

            if (is_null($paidOrders)) {
                echo "No payment data found";
                return;
            }

            $paymentdata = array();
            $i = 0;
            foreach ($paidOrders as $order) {
                $paymentdata[$i] = $this->mollie->payments->get($order->getPaymentId());
                $i++;
            }
            header('Content-Type: application/json');
            echo json_encode($paymentdata);
        }
    }

    function verifyKey()
    {
        try {
            $enteredKey = htmlspecialchars($_GET['key']);
            $key = $this->paymentservice->getKey($enteredKey);

            if (is_null($key))
                return false;

            return $enteredKey == $key->getApi_key();
        } catch (Exception $e) {
            return false;
        }
    }
}
