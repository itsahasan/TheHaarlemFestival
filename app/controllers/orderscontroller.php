<?php
require __DIR__ . '/../services/shoppingcartservice.php';
require __DIR__ . '/../services/ordersservice.php';
require_once __DIR__ . "/../vendor/autoload.php";

class OrdersController
{
    private $placeorderService;
    private $shoppingcartService;
    private $mollie;

    function __construct()
    {
        $this->mollie = new \Mollie\Api\MollieApiClient();
        $this->mollie->setApiKey("
        test_5jaAakyFRh8n9cNuC8p8aQR8gF3jp3");

        $this->placeorderService = new OrdersService();
        $this->shoppingcartService = new ShoppingCartService();
        session_start();
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

                                $orderItem = new OrdersItem();

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
}
