<?php
// controllers/PaymentController.php
declare(strict_types=1);

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../services/PaymentService.php';
require_once __DIR__ . '/../repositories/PaymentRepository.php';
require_once __DIR__ . '/../repositories/OrdersRepository.php';
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../services/TicketService.php';
require_once __DIR__ . '/../services/EmailService.php';


class PaymentController extends BaseController
{
    private PaymentService $paymentService;
    private PaymentRepository $paymentRepo;
    private OrdersRepository $ordersRepo;


    public function __construct()
    {
        parent::__construct();
        $this->paymentService = new PaymentService();
        $this->paymentRepo = new PaymentRepository();
        $this->ordersRepo = new OrdersRepository();
    }

    public function checkout(): void
    {
        $this->requireLogin();
        $orderId = isset($_GET['orderId']) ? intval($_GET['orderId']) : 0;
        $order = $this->paymentRepo->getOrder($orderId);

        if (!$order || $order->getUserId() !== (int)$_SESSION['userId']) {
            http_response_code(404); echo "Order not found or access denied"; return;
        }

        if (!$order->getPaymentId()) {
            $this->createMolliePayment($order);
        }

        $molliePayment = $this->paymentService->getPaymentStatus($order->getPaymentId());

        if ($molliePayment->isOpen()) {
            header("Location: " . $molliePayment->getCheckoutUrl());
            exit;
        }

        // Если статус другой (paid, failed, expired), показываем страницу статуса
        require __DIR__ . '/../views/payment/status_page.php'; // Можно создать такой view
    }

    private function createMolliePayment(Order $order): void
    {
        $baseUrl = BASE_URL;
        $redirectUrl = "{$baseUrl}/payment/status?orderId={$order->getId()}";
        $webhookUrl = "{$baseUrl}/payment/webhook";

        try {
            $payment = $this->paymentService->createPayment($order, $redirectUrl, $webhookUrl);
            $this->paymentRepo->addPayment($order->getId(), $payment->id);
            header("Location: " . $payment->getCheckoutUrl());
            exit;
        } catch (\Exception $e) {
            http_response_code(500);
            echo "Error creating payment: " . htmlspecialchars($e->getMessage());
            exit;
        }
    }

    public function status(): void
    {
        $this->requireLogin();
        $orderId = isset($_GET['orderId']) ? intval($_GET['orderId']) : 0;
        $order = $this->paymentRepo->getOrder($orderId);

        if (!$order || !$order->getPaymentId()) {
            require __DIR__ . '/../views/payment/failure.php';
            return;
        }

        $payment = $this->paymentService->getPaymentStatus($order->getPaymentId());

        if ($payment->isPaid()) {
            // ИСПРАВЛЕНО: Добавляем логику для $hiddenEmail
            $email = $order->getEmailAddress();
            $hiddenEmail = substr($email, 0, 2) . str_repeat('*', strpos($email, '@') - 2) . substr($email, strpos($email, '@'));

            require __DIR__ . '/../views/payment/success.php';
        } else {
            require __DIR__ . '/../views/payment/failure.php';
        }
    }

    public function webhook(): void
    {
        try {
            $paymentId = $_POST['id'] ?? null;
            if (!$paymentId) { http_response_code(400); return; }

            $payment = $this->paymentService->getPaymentStatus($paymentId);
            $orderId = (int)$payment->metadata->order_id;
            $order = $this->paymentRepo->getOrder($orderId);

            // Проверяем, что платеж прошел и мы еще не обработали этот заказ
            if ($payment->isPaid() && $order->getPaymentStatus() !== 'paid') {
                // 1. Отмечаем заказ как оплаченный
                $this->ordersRepo->markAsPaid($orderId);

                // 2. Получаем все позиции этого заказа
                $orderItems = $this->ordersRepo->getOrderItemsByOrderId($orderId);

                // 3. Создаем уникальные билеты для каждой позиции
                $ticketService = new TicketService();
                $allTickets = [];
                foreach ($orderItems as $item) {
                    for ($i = 0; $i < $item->getQty(); $i++) {
                        $newTicket = $ticketService->createTicket($item->getId());
                        if ($newTicket) {
                            $allTickets[] = $newTicket;
                        }
                    }
                }

                // 4. Отправляем письмо со всеми билетами
                if (!empty($allTickets)) {
                    $emailService = new EmailService();
                    $emailService->sendTicketEmail($order, $orderItems, $allTickets);
                }
            }
        } catch (\Exception $e) {
            error_log('Webhook processing failed: ' . $e->getMessage());
        }
        // Всегда отвечаем 200 OK, чтобы Mollie не слал вебхуки повторно
        http_response_code(200);
    }
}