<?php
require __DIR__ . '/../../services/shoppingcartservice.php';
require __DIR__ . '/../../services/ordersservice.php';
require_once __DIR__ . '/../../vendor/autoload.php';
require __DIR__ . '/../../services/ticketservice.php';
require __DIR__ . '/../../controllers/pdfcontroller.php';

class OrdersController
{
    private $placeorderService;
    private $shoppingcartService;
    private $mollie;

    private $ticketService;

    function __construct()
    {
        $this->mollie = new \Mollie\Api\MollieApiClient();
        $this->mollie->setApiKey("test_5jaAakyFRh8n9cNuC8p8aQR8gF3jp3");

        $this->placeorderService = new OrdersService();
        $this->shoppingcartService = new ShoppingCartService();
        $this->ticketService = new TicketService();
        session_start();
    }

    public function list()
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
                echo "<script>sessionStorage.setItem('success', 'Order updated successfully!'); </script>";
            } else {
                echo "<script>sessionStorage.setItem('error', 'Failed to update Order!'); </script>";
            }
        }

        $model = $this->placeorderService->getAllOrders();

        require __DIR__ . '/../../views/cms/order/index.php';
    }




    public function edit(): void
    {

        $id = htmlspecialchars($_GET["updateID"]);
        $updateOrder = $this->placeorderService->getOnePlacedOrder($id);

        require __DIR__ . '/../../views/cms/order/edit.php';

    }



    public function update(): void
    {


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



        $this->placeorderService->updatePlacedOrder($placedorder, $_POST["updateID"]);

        if ($this->placeorderService) {

            echo "<script>sessionStorage.setItem('success', 'Order updated successfully!'); window.location = '/admin/orders/list';</script>";

        } else {

            echo "<script>sessionStorage.setItem('error', ''Failed to update Order! '); window.location = '/admin/orders/list';</script>";
        }



    }
}
