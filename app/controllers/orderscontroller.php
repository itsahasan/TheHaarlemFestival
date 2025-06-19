<?php
// controllers/OrdersController.php
declare(strict_types=1);

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../services/ShoppingCartService.php';
require_once __DIR__ . '/../services/OrdersService.php';
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/OrderItem.php';

class OrdersController extends BaseController
{
    private OrdersService $ordersService;
    private ShoppingCartService $shoppingCartService;

    public function __construct()
    {
        parent::__construct();
        $this->ordersService = new OrdersService();
        $this->shoppingCartService = new ShoppingCartService();
    }

    /**
     * Показывает страницу оформления заказа
     */
    public function checkout()
    {
        $this->requireLogin();
        require __DIR__ . '/../views/orders/checkout.php';
    }

    public function cms()
    {
        $this->requireLogin(); // и роль админа
        echo "<h1>Orders CMS</h1><p>This page will be implemented later.</p>";
    }

    /**
     * Обрабатывает форму, создает заказ и перенаправляет на оплату
     */
    public function create()
    {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /orders/checkout');
            exit;
        }

        // 1. Валидация
        $birthdate = new DateTime($this->getPost('birthdate'));
        if ($birthdate > new DateTime()) {
            $_SESSION['error_message'] = "Error: Birth date cannot be in the future.";
            header('Location: /orders/checkout');
            exit;
        }

        // 2. Проверка наличия билетов
        $cartItems = $this->shoppingCartService->getShoppingCartByUserId((int)$_SESSION['userId']);
        if (empty($cartItems)) {
            header('Location: /shoppingcart');
            exit;
        }

        // ИСПРАВЛЕНО: Раскомментировал проверку, теперь она должна работать
        foreach ($cartItems as $ci) {
            if (!$this->ordersService->checkTicketsAvailable($ci->getProductId(), $ci->getQty())) {
                $errorMessage = "Sorry, '" . htmlspecialchars($ci->getEventName()) . "' is sold out or not available in the requested quantity.";
                $_SESSION['error_message'] = $errorMessage;
                header('Location: /shoppingcart');
                exit;
            }
        }

        // 3. Создание заказа
        $total = 0;
        foreach ($cartItems as $ci) {
            $total += $ci->getQty() * $ci->getEventPrice();
        }

        $order = new Order();
        $order->setUserId((int)$_SESSION['userId']);
        $order->setEmailAddress($this->getPost('emailAddress'));
        $order->setTotalPrice($total);
        $order->setFirstName($this->getPost('firstName'));
        $order->setLastName($this->getPost('lastName'));
        $order->setBirthDate($this->getPost('birthdate'));
        $order->setStreetAddress($this->getPost('streetAddress'));
        $order->setCountry($this->getPost('country'));
        $order->setZipCode($this->getPost('zipCode'));
        $order->setPhoneNumber($this->getPost('phoneNumber'));

        $placedOrder = $this->ordersService->placeOrder($order);

        if ($placedOrder) {
            foreach ($cartItems as $ci) {
                $this->ordersService->updateTicketsAvailable($ci->getProductId(), $ci->getQty());

                $orderItem = new OrderItem();
                $orderItem->setOrderid($placedOrder->getId());
                $orderItem->setProductId($ci->getProductId());
                $orderItem->setQty($ci->getQty());
                $orderItem->setPrice($ci->getEventPrice() * $ci->getQty());
                $this->ordersService->placeOneOrderItem($orderItem);
            }

            $this->shoppingCartService->emptyCartByUserId((int)$_SESSION['userId']);

            header('Location: /payment/checkout?orderId=' . $placedOrder->getId());
            exit;
        } else {
            $_SESSION['error_message'] = "A critical error occurred while creating your order.";
            header('Location: /orders/checkout');
            exit;
        }
    }

    public function myorders()
    {
        $this->requireLogin();
        $orders = $this->ordersService->getOrdersByUserId((int)$_SESSION['userId']);
        require __DIR__ . '/../views/orders/myorders.php';
    }

    public function cancel()
    {
        $this->requireLogin();
        echo "<h1>Order Cancelled</h1><p>This logic will be implemented later.</p>";
    }
}