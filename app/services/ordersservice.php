<?php
// services/OrdersService.php

require_once __DIR__ . '/../repositories/OrdersRepository.php';
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/OrderItem.php';

class OrdersService
{
    private OrdersRepository $orderRepository;

    public function __construct()
    {
        $this->orderRepository = new OrdersRepository();
    }

    public function placeOrder(Order $order): ?Order
    {
        return $this->orderRepository->placeOrder($order);
    }

    public function placeOneOrderItem(OrderItem $orderItem): ?OrderItem
    {
        return $this->orderRepository->placeOneOrderItem($orderItem);
    }

    public function updateTicketsAvailable(int $product_id, int $qty): bool
    {
        return $this->orderRepository->updateTicketsAvailable($product_id, $qty);
    }

    // Ты можешь добавить сюда другие методы, если они нужны,
    // например, для получения истории заказов
    public function getMyOrdersByUserId(int $userId): array
    {
        // return $this->orderRepository->getMyOrdersByUserId($userId);
        return []; // Пока оставим пустым, чтобы не было ошибок
    }
}