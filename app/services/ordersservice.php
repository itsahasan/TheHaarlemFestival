<?php

require __DIR__ . '/../repositories/ordersrepository.php';

class OrdersService
{
    private $orderRepository;

    public function __construct()
    {
        $this->orderRepository = new OrdersRepository();
    }

    public function getAllOrders()
    {
        return $this->orderRepository->getAllOrders();
    }
    public function getPaidOrders()
    {
        return $this->orderRepository->getPaidOrders();
    }
    public function getOnePlacedOrder($id)
    {
        return $this->orderRepository->getOnePlacedOrder($id);
    }

    public function updatePlacedOrder($placedorder, $id)
    {
        return $this->orderRepository->updatePlacedOrder($placedorder, $id);
    }

    public function placeOrder(Orders $placeorder)
    {
        return $this->orderRepository->placeOrder($placeorder);
    }

    public function placeOneOrderItem($orderItem)
    {
        return $this->orderRepository->placeOneOrderItem($orderItem);
    }

    public function updateTicketsAvailable($product_id, $qty)
    {
        return $this->orderRepository->updateTicketsAvailable($product_id, $qty);
    }

    public function getMyOrdersByUserId($user_id)
    {
        return $this->orderRepository->getMyOrdersByUserId($user_id);
    }

    public function countMyOrders($product_id)
    {
        return $this->orderRepository->countMyOrders($product_id);
    }

    public function getById($orderId)
    {
        return $this->orderRepository->getById($orderId);
    }

    public function addPayment($orderId, $paymentId)
    {
        return $this->orderRepository->addPayment($orderId, $paymentId);
    }

    public function getOrderItemsByOrderId($orderId)
    {
        return $this->orderRepository->getOrderItemsByOrderId($orderId);
    }

    public function cancelOrder($userId)
    {
        return $this->orderRepository->cancelOrder($userId);
    }

    public function getProductInfo($productId)
    {
        return $this->orderRepository->getProductInfo($productId);
    }

    public function deleteLastInsertedOrder()
    {
        return $this->orderRepository->deleteLastInsertedOrder();
    }
}
