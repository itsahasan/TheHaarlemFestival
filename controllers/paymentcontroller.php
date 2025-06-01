<?php

declare(strict_types=1);

use chillerlan\QRCode\QRCode;
use chillerlan\QRCode\QROptions;
use PHPMailer\Mailer;

require __DIR__ . '/../utils/mailer.php';
require __DIR__ . '/../utils/qr-generator.php';
require_once __DIR__ . "/../vendor/autoload.php";
require __DIR__ . '/../services/ordersservice.php';
require __DIR__ . '/../services/ticketservice.php';
require __DIR__ . '/../controllers/pdfcontroller.php';


class PaymentController
{
    private $orderService;
    private $ticketService;
    private $mollie;
    private $mailer;
    private $baseUrl;
    function __construct()
    {
        session_start();
        $this->mollie = new \Mollie\Api\MollieApiClient();
        $this->mollie->setApiKey("
        test_5jaAakyFRh8n9cNuC8p8aQR8gF3jp3");
        $this->orderService = new OrdersService();
        $this->ticketService = new TicketService();
        $this->mailer = new Mailer();

        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https" : "http";
        //$host = $_SERVER['HTTP_HOST'];
        $host = "localhost";
        $this->baseUrl = "$protocol://$host";

        
    }

    public function index()
    {
        try {
            $orderId = $_GET['orderId'];
            $order = $this->orderService->getOnePlacedOrder($orderId);
            $total = $order->getTotalPrice();
            $subtotal = ($total * 0.21) + $total;
            $baseUrl = $this->baseUrl;

            $formatted_amount = number_format((float) $subtotal, 2, '.', '');

            /*
             * Payment parameters:
             *   amount        Amount in EUROs. This example creates a € 10,- payment.
             *   description   Description of the payment.
             *   redirectUrl   Redirect location. The customer will be redirected there after the payment.
             *   webhookUrl    Webhook location, used to report when the payment changes state.
             *   metadata      Custom metadata that is stored with the payment.
             */
            $payment = $this->mollie->payments->create([
                "amount" => [
                    "currency" => "EUR",
                    "value" => (string) $formatted_amount,
                ],
                "description" => "Order #{$orderId}",
                "redirectUrl" => "$baseUrl\payment\status?orderId=$orderId",
                "webhookUrl" => "$baseUrl\payment\status?orderId=$orderId",
                "metadata" => [
                    "order_id" => $orderId,
                ],
            ]);

            $this->orderService->addPayment($orderId, $payment->id);
            header("Location: " . $payment->getCheckoutUrl(), true, 303);
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            // echo "API call failed: " . htmlspecialchars($e->getMessage());

            echo "<script>sessionStorage.setItem('error', 'API call failed: Invalid redirect url'); window.location = '/orders/checkout';</script>";

        }
    }

    public function status()
    {
        //add check to avoid mail re-sending when page refresh.
        $orderId = $_GET['orderId'];

        //If userid matches from session userid proceed
        $order = $this->orderService->getById($orderId);

        try {
            $payment = $this->mollie->payments->get($order->getPaymentId());
            $status = $payment->status;
        } catch (\Exception $e) {
            $status = 'Unknown';
        }

        //hide email
        $email = $order->getEmailAddress();
        $hiddenEmail = substr_replace($email, str_repeat('*', strpos($email, '@') - 2), 2, strpos($email, '@') - 2); //replaces after first 2 chars with *, until the @ sign.

        if (!$payment->isPaid()) {
            //if payment is older than 24hr cancel it straight away.
            $paymentDateTime = new DateTime($payment->createdAt);
            $currentDateTime = new DateTime();
            $timeDiff = $currentDateTime->getTimestamp() - $paymentDateTime->getTimestamp();

            if ($timeDiff > 86400) {
                echo "<script>sessionStorage.setItem('error', 'Payment expired'); window.location = '/orders/cancel'; </script>";
            }
            require __DIR__ . '/../views/payment/paylater.php';
        } else {
            //prepare email
            $receiver = $email;
            $receiver_name = $order->getFirstName() . " " . $order->getLastName();
            //invoice
            $subject = "Invoice - Haarlem Festival Support";
            $body_string = 'Thank you for your order, you will find the invoice attached to this email.';

            $pdfController  = new Pdfcontroller();
            $pdf        = $pdfController->createInvoice($order);
            $invoice    = $pdf->Output('invoice_' . $orderId . '.pdf', 'S');

            //tickets
            $subject2 = "Tickets - Haarlem Festival Support";
            $body_string2   = 'Thank you for your order, you will find the tickets attached to this email.';
            $pdf        = $pdfController->createTickets($order);
            $tickets    = $pdf->Output('ticket_' . $orderId . '.pdf', 'S');

            require __DIR__ . '/../views/payment/paymentsuccessful.php';

            try {

                $this->mailer->sendEmail($receiver, $receiver_name, $subject, $body_string, $invoice, "invoice");
                $this->mailer->sendEmail($receiver, $receiver_name, $subject2, $body_string2, $tickets, "tickets");
            } catch (\Exception $ex) {
                
            }

        }
    }

    public function paylater()
    {
        $baseUrl = $this->baseUrl;

        try {
            $orderId = $_GET['orderId'];
            $order = $this->orderService->getById($orderId);
            $payment = $this->mollie->payments->get($order->getPaymentId());
            $payment->description = "Order #" . $orderId;
            $payment->redirectUrl = "$baseUrl\payment\status?orderId=$orderId";
            $payment->webhookUrl = "$baseUrl\payment\status?orderId=$orderId";
            $payment->metadata = ["order_id" => $orderId];

            $payment = $payment->update();
            header("Location: " . $payment->getCheckoutUrl(), true, 303);
        } catch (\Mollie\Api\Exceptions\ApiException $e) {
            echo "API call failed: " . htmlspecialchars($e->getMessage());
        }
    }
}
