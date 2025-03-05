<?php

require __DIR__ . '/../services/historyeventservice.php';
require __DIR__ . '/../services/shoppingcartservice.php';


class HistoryEventController
{

    private $historyeventService;
    private $cartService;

    function __construct()
    {
        $this->historyeventService = new HistoryEventService();
        $this->cartService = new ShoppingCartService();
        session_start();
    }

    public function index()
    {
        if (isset($_POST['add-to-cart'])) {
            if (isset($_SESSION['userId'])) {
                $user_id = $_SESSION['userId'];
                $product_id = htmlspecialchars($_POST["product_id"]);
                $qty = 1;

                $cartItem = new ShoppingCartItem();

                $cartItem->setUser_id($user_id);
                $cartItem->setProduct_id($product_id);
                $cartItem->setQty($qty);
                if ($this->cartService->checkIfProductExistsInCart($user_id, $product_id)) {
                    echo "<script>alert('This product is already in your shopping cart. You can change the quantity in the shopping cart page.')</script>";
                } else {
                    $this->cartService->addProductToCart($cartItem);
                    $_SESSION['cartcount']++;
                }
            } else {
                echo "<script>
                alert('You have to be logged in to add to cart.');
                window.location.href = '/login/index'
                </script>";
            }
        }

        if (isset($_POST["friday"])) {
            $model = $this->historyeventService->getHistoryEventsByDate('%2023-07-28%');
        } else if (isset($_POST["saturday"])) {
            $model = $this->historyeventService->getHistoryEventsByDate('%2023-07-29%');
        } else if (isset($_POST["sunday"])) {
            $model = $this->historyeventService->getHistoryEventsByDate('%2023-07-30%');
        } else if (isset($_POST["monday"])) {
            $model = $this->historyeventService->getHistoryEventsByDate('%2023-07-31%');
        } else {
            $model = $this->historyeventService->getAllInfo();
        }

        require __DIR__ . '/../views/historyevent/index.php';
    }

    public function historyEventDetails()
    {
        $url = getURL();
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $model = $this->historyeventService->getOne($params['id']);

        require __DIR__ . '/../views/cms/historyevent/index.php';
    }


    public function cms()
    {

        //Functionality delete
        if (isset($_POST["delete"])) {
            $id = htmlspecialchars($_GET["deleteID"]);
            $this->historyeventService->deleteHistoryEvent($id);

            if ($this->historyeventService) {
                echo "<script>alert('History Event deleted successfully! ')</script>";
            } else {
                echo "<script>alert('Failed to delete History Event. ')</script>";
            }
        }
        //Functionality Add
        if (isset($_POST["add"])) {

            $tickets_available = htmlspecialchars($_POST["tickets_available"]);
            $price = htmlspecialchars($_POST["price"]);
            $datetime = htmlspecialchars($_POST["datetime"]);
            $location = htmlspecialchars($_POST["location"]);
            $tourguideID = htmlspecialchars($_POST["tourguideID"]);

            $historyeventcms = new HistoryEvent();

            $historyeventcms->setTicketsAvailable($tickets_available);
            $historyeventcms->setPrice($price);
            $historyeventcms->setDateTime($datetime);
            $historyeventcms->setLocation($location);
            $historyeventcms->setTourguideID($tourguideID);

            if (count($_FILES) > 0) {
                if (is_uploaded_file($_FILES['image']['tmp_name'])){
                    $image = file_get_contents($_FILES['image']['tmp_name']);
                    $historyeventcms->setImage($this->historyeventService->saveImage($image));
                }
            } else {
                echo "Problem Occured! ";
            }

            $this->historyeventService->addHistoryEvent($historyeventcms);

            if ($this->historyeventService) {
                echo "<script>alert('History Event added successfully! ')</script>";
            } else {
                echo "<script>alert('Failed to add History Event. ')</script>";
            }
        }
        //Functionality editing
        if (isset($_POST["edit"])) {
            $id = htmlspecialchars($_GET["updateID"]);
            $updateHistoryEvent = $this->historyeventService->getOne($id);
        }
        //Functionality update
        if (isset($_POST["update"])) {
            $tickets_available = htmlspecialchars($_POST["changedTickets_available"]);
            $price = htmlspecialchars($_POST["changedPrice"]);
            $datetime = htmlspecialchars($_POST["changedDatetime"]);
            $location = htmlspecialchars($_POST["changedLocation"]);
            $tourguideID = htmlspecialchars($_POST["changedTourguideID"]);

            $historyeventcms = new HistoryEvent();

            $historyeventcms->setTicketsAvailable($$tickets_available);
            $historyeventcms->setPrice($price);
            $historyeventcms->setDateTime($datetime);
            $historyeventcms->setLocation($location);
            $historyeventcms->setTourguideID($tourguideID);

            $theHistoryEvent = $this->historyeventService->getAHistoryEvent($_GET["updateID"]);
            if (count($_FILES) > 0) {
                if (is_uploaded_file($_FILES['changeImage']['tmp_name'])) {
                    $image = file_get_contents($_FILES['changeImage']['tmp_name']);
                    $historyeventcms->setImage($this->historyeventService->updateImage($image, $theHistoryEvent->getImage()));
                }
            } else {
                echo "Problem Occured!";
            }

            $this->historyeventService->updateHistoryEvent($historyeventcms, $_GET["updateID"]);

            if ($this->historyeventService) {
                echo "<script>alert('History Event updated successfully! ')</script>";
            } else {
                echo "<script>alert('Failed to update History Event. ')</script>";
            }
        }
        $model = $this->historyeventService->getAll();


        require __DIR__ . '/../views/cms/historyevent/index.php';
    }

}
