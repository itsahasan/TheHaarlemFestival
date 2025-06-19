<?php
// controllers/ShoppingcartController.php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../services/ShoppingCartService.php';
require_once __DIR__ . '/../services/OrdersService.php';
require_once __DIR__ . '/../models/Order.php';
require_once __DIR__ . '/../models/OrderItem.php';

class ShoppingcartController extends BaseController
{
    private ShoppingCartService $cartService;
    private OrdersService       $orderService;

    public function __construct()
    {
        parent::__construct();                  // старт сессии и базовые методы
        $this->cartService  = new ShoppingCartService();
        $this->orderService = new OrdersService();
    }

    public function index(): void
    {

        $this->requireLogin();                  // проверяем, что пользователь залогинен

        $userId    = $_SESSION['userId'];
        $cartItems = $this->cartService->getShoppingCartByUserId($userId);


        // Пересчёт общей суммы
        $total = 0;
        foreach ($cartItems as $ci) {
            $total += $ci->getQty() * $ci->getEventprice();
        }

        // Обработка отправки формы "Proceed to checkout"
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['placeorder'])) {
            // Собираем и сохраняем заказ
            $order = new Order();
            $order->setFirstName(   $this->getPost('firstName') );
            $order->setLastName(    $this->getPost('lastName') );
            $order->setBirthDate(   $this->getPost('birthdate') );
            $order->setEmailAddress($_SESSION['userEmail']);
            $order->setStreetAddress($this->getPost('streetAddress'));
            $order->setCountry(     $this->getPost('country') );
            $order->setZipCode(     $this->getPost('zipCode') );
            $order->setPhoneNumber( $this->getPost('phoneNumber'));
            $order->setUserId(      $userId);
            $order->setTotalPrice(  $total);

            $placedOrder = $this->orderService->placeOrder($order);
            if ($placedOrder) {
                // Сохраняем каждую позицию из корзины
                foreach ($cartItems as $ci) {
                    $oi = new orderItem();
                    $oi->setOrder_id(   $placedOrder->getId() );
                    $oi->setProduct_id( $ci->getId());
                    $oi->setQty(        $ci->getQty());
                    $oi->setPrice(      $ci->getEvent_price());
                    $this->orderService->placeOneOrderItem($oi);
                    $this->orderService->updateTicketsAvailable($ci->getId(), $ci->getQty());
                }
                // Очищаем корзину
                $this->cartService->emptyCartByUserId($userId);
                unset($_SESSION['cartcount']);

                // Редирект на оплату
                header('Location: /payment/checkout?orderId=' . $placedOrder->getId());
                exit;
            }
        }

        // Подключаем правильный шаблон
        require __DIR__ . '/../views/payment/shopping-cart.php';
    }

    public function update()
    {
        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = (int)($_POST['productId'] ?? 0);
            $quantity = (int)($_POST['quantity'] ?? 1);
            $userId = (int)$_SESSION['userId'];

            if ($productId > 0 && $quantity > 0) {
                $this->cartService->updateProductQty($productId, $userId, $quantity);
            }
        }
        // Возвращаем пользователя обратно в корзину
        header('Location: /shoppingcart');
        exit;
    }

    public function remove()
    {
        $this->requireLogin();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = (int)($_POST['productId'] ?? 0);
            $userId = (int)$_SESSION['userId'];

            if ($productId > 0) {
                $this->cartService->removeProductFromCart($productId, $userId);
            }
        }
        // Возвращаем пользователя обратно в корзину
        header('Location: /shoppingcart');
        exit;
    }
}
