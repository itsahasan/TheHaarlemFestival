<?php
// repositories/PaymentRepository.php

require_once __DIR__ . '/OrdersRepository.php';

// ИСПРАВЛЕНО: Имя класса в PascalCase
class PaymentRepository
{
    private OrdersRepository $ordersRepo;

    public function __construct()
    {
        $this->ordersRepo = new OrdersRepository();
    }

    public function addPayment(int $orderId, string $paymentId): bool
    {
        return $this->ordersRepo->addPayment($orderId, $paymentId);
    }

    // ИСПРАВЛЕНО: тип возвращаемого значения и логика (не создаем новый репозиторий)
    public function getOrder(int $orderId): ?Order
    {
        return $this->ordersRepo->getById($orderId);
    }
}