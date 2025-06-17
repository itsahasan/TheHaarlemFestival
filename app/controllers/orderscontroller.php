<?php
require __DIR__ . '/../services/ShoppingCartService.php';
require __DIR__ . '/../services/OrdersService.php';
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . '/BaseController.php';

class OrdersController extends BaseController
{
    private $placeorderService;
    private $shoppingcartService;
    private $mollie;

    public function __construct()
    {
        // Сначала вызываем конструктор родителя (BaseController)
        parent::__construct();

        // Теперь инициализируем нужные сервисы
        $this->placeorderService = new OrdersService();
        $this->shoppingcartService = new ShoppingCartService();

        // Код для Mollie здесь больше не нужен, он должен быть в PaymentService
    }

    public function cms()
    {

        //Functionality editing
        if (isset($_POST["edit"])) {
            $id = htmlspecialchars($_GET["updateID"]);
            $updateOrder = $this->placeorderService->getOnePlacedOrder($id);
        }
        //Functionality update
        if (isset($_POST["update"])) {
            $firstName = htmlspecialchars($_POST["changedfirstName"]);
            $lastName = htmlspecialchars($_POST["changedlastName"]);
            $birthdate = htmlspecialchars($_POST["changedbirthdate"]);
            $emailAddress = htmlspecialchars($_POST["changedemailAddress"]);
            $streetAddress = htmlspecialchars($_POST["changedstreetAddress"]);
            $country = htmlspecialchars($_POST["changedcountry"]);
            $zipCode = htmlspecialchars($_POST["changedzipCode"]);
            $phoneNumber = htmlspecialchars($_POST["changedphoneNumber"]);
            $userId = htmlspecialchars($_POST["changeduserId"]);
            $totalprice = htmlspecialchars(($_POST["changedtotalPrice"]));
            $paymentstatus = htmlspecialchars(($_POST["changedpayment"]));

            $placedorder = new Orders();

            $placedorder->setFirstName($firstName);
            $placedorder->setLastName($lastName);
            $placedorder->setBirthDate($birthdate);
            $placedorder->setEmailAddress($emailAddress);
            $placedorder->setStreetAddress($streetAddress);
            $placedorder->setCountry($country);
            $placedorder->setZipCode($zipCode);
            $placedorder->setPhoneNumber($phoneNumber);
            $placedorder->setUserId($userId);
            $placedorder->setTotalPrice($totalprice);
            $placedorder->setPaymentId($paymentstatus);

            $this->placeorderService->updatePlacedOrder($placedorder, $_GET["updateID"]);

            if ($this->placeorderService) {
                echo "<script>alert('Order updated successfully! ')</script>";
            } else {
                echo "<script>alert('Failed to update Order! ')</script>";
            }
        }

        $model = $this->placeorderService->getAllOrders();

        require __DIR__ . '/../views/cms/order/index.php';
    }


    public function checkout()
    {
        if (isset($_SESSION['userId'])) {
            $cartItems = $this->shoppingcartService->getShoppingCartByUserId($_SESSION['userId']);
            $count = $this->shoppingcartService->countProducts($_SESSION['userId']);

            require __DIR__ . '/../views/orders/checkout.php';
        } else {
            echo "<script>
            alert('You have to be logged in to see checkout.');
            window.location.href = '/login/index'
            </script>";
        }

        if (isset($_SESSION['userEmail'])) {
            if (isset($_POST["placeorder"])) {
                $firstName = htmlspecialchars($_POST["firstName"]);
                $lastName = htmlspecialchars($_POST["lastName"]);
                $birthdate = htmlspecialchars($_POST["birthdate"]);
                $emailAddress = $_SESSION['userEmail'];
                $streetAddress = htmlspecialchars($_POST["streetAddress"]);
                $country = htmlspecialchars($_POST["country"]);
                $zipCode = htmlspecialchars($_POST["zipCode"]);
                $phoneNumber = htmlspecialchars($_POST["phoneNumber"]);
                $totalprice = $_SESSION['totalprice'];

                $placeorder = new Orders();

                $placeorder->setFirstName($firstName);
                $placeorder->setLastName($lastName);
                $placeorder->setBirthDate($birthdate);
                $placeorder->setEmailAddress($emailAddress);
                $placeorder->setStreetAddress($streetAddress);
                $placeorder->setCountry($country);
                $placeorder->setZipCode($zipCode);
                $placeorder->setPhoneNumber($phoneNumber);
                $placeorder->setUserId($_SESSION['userId']);
                $placeorder->setTotalPrice((float)$totalprice);

                if ($cartItems > 0) {
                    if (!empty($count)) {
                        if ($this->placeorderService->placeOrder($placeorder)) {
                            // $cartItems = $this->shoppingcartService->getShoppingCartByUserId($_SESSION['userId']);

                            for ($i = 0; $i < count($cartItems); $i++) {
                                $ids = $cartItems[$i]->getId();
                                $qty = $cartItems[$i]->getQty();
                                $price = $cartItems[$i]->getEvent_price();

                                $orderItem = new orderItem();

                                $orderItem->setOrder_id($placeorder->getId());
                                $orderItem->setProduct_id($ids);
                                $orderItem->setQty($qty);
                                $orderItem->setPrice($price * $qty);
                                $orderItem->setUser_id($_SESSION['userId']);


                                $success = $this->placeorderService->updateTicketsAvailable($ids, $qty);
                                if (!$success) {
                                    // Display an error message
                                    echo "<script>alert('Quantity is greater than the tickets availability, please add no more than avaiable tickets/seats!')</script>";
                                    $this->placeorderService->deleteLastInsertedOrder();
                                    echo "<script>window.location = '/shoppingcart'</script>";
                                    //Stop processing the rest of the items if one fails
                                    break;
                                } else {
                                    $this->placeorderService->placeOneOrderItem($orderItem);
                                }
                            }

                            echo "<script>alert('Order placed successfully! ')</script>";

                            $this->shoppingcartService->emptyCartByUserId($_SESSION['userId']);
                            $_SESSION['cartcount'] = 0;

                            $orderId = $placeorder->getId();
                            echo "<script>window.location = '/payment?orderId=$orderId'</script>";
                        } else {
                            echo "<script>alert('Failed to place order. ')</script>";
                        }
                    } else {
                        echo "<script>alert('No products in the shopping cart! Please add products to the cart first!')</script>";
                        echo "<script>window.location = '/event/jazzevents'</script>";
                    }
                }
            }
        }
    }

    public function myorders()
    {
        if (isset($_SESSION['userId'])) {

            $cartItems = $this->shoppingcartService->getShoppingCartByUserId($_SESSION['userId']);
            $count = $this->shoppingcartService->countProducts($_SESSION['userId']);

            $myOrders = $this->placeorderService->getMyOrdersByUserId($_SESSION['userId']);

            $orderStatus = $this->placeorderService->getAllOrders();

            require __DIR__ . '/../views/orders/myorders.php';
        } else {
            echo "<script>
                alert('You have to be logged in to see checkout.');
                window.location.href = '/login/index'
                </script>";
        }
    }

    public function cancel()
    {
        $userId = $_SESSION['userId'];
        //delete order and orderitems from shopping cart and db
        if ($this->placeorderService->cancelOrder($userId)) {
            echo "<script>alert('Order Was cancelled successfully'); window.location = '/';</script>";
        }
    }

    public function create()
    {
        $this->requireLogin();

        // Проверяем, что это POST запрос
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /orders/checkout');
            exit;
        }

        $userId = (int)$_SESSION['userId'];
        $cartItems = $this->shoppingcartService->getShoppingCartByUserId($userId);

        if (empty($cartItems)) {
            header('Location: /shoppingcart'); // Если корзина пуста, возвращаем
            exit;
        }

        // Подсчитываем общую сумму
        $total = 0;
        foreach ($cartItems as $ci) {
            $total += $ci->getQty() * $ci->getEvent_price();
        }

        // Создаем объект заказа СО ВСЕМИ ДАННЫМИ из формы
        $order = new Order();
        $order->setUserId($userId);
        $order->setEmailAddress($_SESSION['userEmail']);
        $order->setTotalPrice($total);

        // Данные из POST
        $order->setFirstName($this->getPost('firstName'));
        $order->setLastName($this->getPost('lastName'));
        $order->setBirthDate($this->getPost('birthdate'));
        $order->setStreetAddress($this->getPost('streetAddress'));
        $order->setCountry($this->getPost('country'));
        $order->setZipCode($this->getPost('zipCode'));
        $order->setPhoneNumber($this->getPost('phoneNumber'));

        // Помещаем заказ в базу данных
        $placedOrder = $this->placeorderService->placeOrder($order);

        if ($placedOrder) {
            // Сохраняем позиции заказа
            foreach ($cartItems as $ci) {
                $orderItem = new OrderItem();
                $orderItem->setOrder_id($placedOrder->getId());
                $orderItem->setProduct_id($ci->getProduct_id());
                $orderItem->setQty($ci->getQty());
                $orderItem->setPrice($ci->getEvent_price() * $ci->getQty());
                $this->placeorderService->placeOneOrderItem($orderItem);
                $this->placeorderService->updateTicketsAvailable($ci->getProduct_id(), $ci->getQty());
            }

            // Очищаем корзину
            $this->shoppingcartService->emptyCartByUserId($userId);
            $_SESSION['cartCount'] = 0;

            // Все успешно! Перенаправляем на страницу ОПЛАТЫ
            header('Location: /payment/checkout?orderId=' . $placedOrder->getId());
            exit;
        } else {
            // Если по какой-то причине заказ все равно не создался, показываем ошибку
            // (теперь это маловероятно)
            echo "A critical error occurred while creating the order. Please contact support.";
        }
    }


}
