<?php
// controllers/PaymentController.php

declare(strict_types=1);

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../services/PaymentService.php';
require_once __DIR__ . '/../repositories/PaymentRepository.php';
require_once __DIR__ . '/../repositories/OrdersRepository.php';
require_once __DIR__ . '/../models/Order.php';

class PaymentController extends BaseController
{
    private PaymentService $paymentService;
    private PaymentRepository $paymentRepo; // ИСПРАВЛЕНО: имя свойства
    private OrdersRepository $ordersRepo;

    public function __construct()
    {
        parent::__construct();
        $this->paymentService = new PaymentService();
        $this->paymentRepo = new PaymentRepository(); // ИСПРАВЛЕНО: имя класса
        $this->ordersRepo = new OrdersRepository();
    }

    /**
     * GET /payment/checkout?orderId=...
     * Показывает страницу оплаты с QR-кодом
     */
    public function checkout(): void
    {
        $this->requireLogin();
        $orderId = isset($_GET['orderId']) ? intval($_GET['orderId']) : 0;
        $order = $this->paymentRepo->getOrder($orderId);

        if (!$order || $order->getUserId() !== (int)$_SESSION['userId']) {
            http_response_code(404); echo "Order not found or access denied"; return;
        }

        // Если у заказа еще нет ID платежа, создаем его
        if (!$order->getPaymentId()) {
            $this->createMolliePayment($order); // Метод сам сделает редирект
        }

        // Если ID платежа уже есть, получаем его статус
        $molliePayment = $this->paymentService->getPaymentStatus($order->getPaymentId());

        // Показываем View с QR-кодом
        require __DIR__ . '/../views/payment/checkout.php';
    }

    private function createMolliePayment(Order $order): void
    {
        // Вставляем твой публичный адрес от ngrok
        $baseUrl = "https://3d7f-77-162-121-113.ngrok-free.app";

        $redirectUrl = "{$baseUrl}/payment/status?orderId={$order->getId()}";
        $webhookUrl = "{$baseUrl}/payment/webhook";

        try {
            $payment = $this->paymentService->createPayment($order, $redirectUrl, $webhookUrl);
            $this->paymentRepo->addPayment($order->getId(), $payment->id);

            // Перенаправляем пользователя на страницу оплаты Mollie
            header("Location: " . $payment->getCheckoutUrl());
            exit;

        } catch (\Exception $e) {
            http_response_code(500);
            echo "Error creating payment: " . htmlspecialchars($e->getMessage());
            exit;
        }
    }

    /**
     * GET /payment/status?orderId=...
     * Страница, куда пользователь возвращается после попытки оплаты.
     */
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
            require __DIR__ . '/../views/payment/success.php';
        } else {
            require __DIR__ . '/../views/payment/failure.php';
        }
    }

    /**
     * POST /payment/webhook
     * Сюда Mollie присылает фоновые уведомления о смене статуса платежа.
     */
    public function webhook(): void
    {
        $paymentId = $_POST['id'] ?? null;
        if (!$paymentId) {
            http_response_code(400);
            return;
        }

        try {
            $payment = $this->paymentService->getPaymentStatus($paymentId);
            $orderId = (int)$payment->metadata->order_id;

            $order = $this->paymentRepo->getOrder($orderId);

            if ($payment->isPaid() && $order->getPaymentStatus() !== 'paid') {
                $this->paymentService->finalizeOrder($order);
                $this->ordersRepo->markAsPaid($orderId);
            }
            http_response_code(200);

        } catch (\Exception $e) {
            error_log('Webhook processing failed: ' . $e->getMessage());
            http_response_code(200);
        }
    }
}