<?php
// services/PaymentService.php

// Убедись, что эти пути и имена файлов верные
require_once __DIR__ . '/../config/mollie.php';
require_once __DIR__ . '/../repositories/PaymentRepository.php';
require_once __DIR__ . '/../models/Order.php';
// Эти утилиты должны существовать, если нет - нужно будет их создать/добавить
// require_once __DIR__ . '/../utils/mailer.php';
// require_once __DIR__ . '/../utils/qr-generator.php';
require_once __DIR__ . '/../vendor/autoload.php'; // Mollie client & TCPDF

class PaymentService
{
    private \Mollie\Api\MollieApiClient $mollie;
    private PaymentRepository $repo;

    public function __construct()
    {
        $this->mollie = new \Mollie\Api\MollieApiClient();
        // Убедись, что константа MOLLIE_API_KEY определена в mollie.php
        $this->mollie->setApiKey(MOLLIE_API_KEY);

        $this->repo = new PaymentRepository();
    }

    /**
     * Create a Mollie payment.
     * ИСПРАВЛЕНО: тип аргумента с Orders на Order
     */
    public function createPayment(Order $order, string $redirectUrl, string $webhookUrl): \Mollie\Api\Resources\Payment
    {
        // Рассчитываем VAT 21%
        $amountInclVat = round($order->getTotalPrice() * 1.21, 2);

        $payment = $this->mollie->payments->create([
            "amount"      => [
                "currency" => "EUR",
                "value"    => number_format($amountInclVat, 2, '.', ''),
            ],
            "description" => "Order #" . $order->getId(),
            "redirectUrl" => $redirectUrl,
            "webhookUrl"  => $webhookUrl,
            "metadata"    => [
                "order_id" => $order->getId(),
            ],
            "method" => "ideal", // Можно добавить конкретные методы, например iDEAL
        ]);

        return $payment;
    }

    /**
     * Fetch Mollie payment status.
     */
    public function getPaymentStatus(string $paymentId): \Mollie\Api\Resources\Payment
    {
        return $this->mollie->payments->get($paymentId);
    }

    /**
     * Check if the payment is older than 24h.
     */
    public function isExpired(\DateTime $createdAt): bool
    {
        $now = new \DateTime();
        return ($now->getTimestamp() - $createdAt->getTimestamp()) > 86400; // 24 часа
    }

    /**
     * After a successful payment: generate & email invoice and tickets.
     * ИСПРАВЛЕНО: тип аргумента с Orders на Order
     */
    public function finalizeOrder(Order $order): void
    {
        // Заглушка, так как Mailer и PDF генератор могут быть не реализованы
        // В реальном проекте здесь будет логика отправки
        error_log("Order {$order->getId()} finalized. Sending email to {$order->getEmailAddress()}.");

        /*
        // Пример реальной логики
        $mailer   = new Mailer(); // Предполагается, что класс Mailer существует
        $receiver = $order->getEmailAddress();
        $name     = "{$order->getFirstName()} {$order->getLastName()}";

        // Invoice
        $invoicePdf = $this->createInvoicePdf($order);
        $mailer->sendEmail(
            $receiver,
            $name,
            "Invoice - Haarlem Festival",
            "Thank you for your order. Your invoice is attached.",
            $invoicePdf,
            "invoice.pdf"
        );
        */
    }

    /**
     * Generate invoice PDF and return raw data.
     * ИСПРАВЛЕНО: тип аргумента с Orders на Order
     */
    private function createInvoicePdf(Order $order): string
    {
        $pdf = new \TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        // ... здесь должна быть логика генерации PDF ...
        $pdf->AddPage();
        $pdf->Write(0, 'Invoice for Order #' . $order->getId());
        return $pdf->Output('invoice.pdf', 'S'); // 'S' возвращает PDF как строку
    }
}