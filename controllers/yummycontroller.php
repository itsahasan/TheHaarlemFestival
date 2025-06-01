<?php
require __DIR__ . '/../services/yummyservice.php';
require __DIR__ . '/../services/shoppingcartservice.php';
require_once __DIR__ . '/../controllers/day_enum.php';


class YummyController
{
    private $yummyservice;
    private $cartService;

    public function __construct()
    {
        $this->yummyservice = new YummyService();
        $this->cartService = new ShoppingCartService();
        session_start();
    }

    public function index()
    {
        $restaurants = $this->yummyservice->getRestaurants();
        require __DIR__ . '/../views/yummy/index.php';
    }
    public function details()
    {
        $dates = Day::cases();

        $id = htmlspecialchars($_GET["restaurantid"]);

        $restaurant = $this->yummyservice->getRestaurantById($id);
        if(is_null($restaurant))
        {
            echo "<script>sessionStorage.setItem('error', 'A restaurant with this ID was not found in the database'); </script>";

            $this->index();
            return;
        }

        $sessions = $this->yummyservice->getSessionsForRestaurant();
        require __DIR__ . '/../views/yummy/restaurantabout.php';
    }


   

    public function addReservation()
    {
        try {
            $restaurantid = htmlspecialchars($_GET['restaurantid']);

            $reservation = new Reservation();

            $sessionData = explode('-', $_POST['session']);
            $selectedsession = $this->yummyservice->getSessionById($sessionData[0]);
            $seats = $_POST['formguestsadult'] + $_POST['formguestskids'];

            if ($selectedsession->getAvailable_seats() < $seats)
                throw new Exception("There are not enough available seats for this session");

            $reservation->setName(htmlspecialchars($_POST['name']));
            $reservation->setRestaurantID($restaurantid);
            $reservation->setSessionID($sessionData[0]);
            $reservation->setSeats($seats);

            $datetime = $_POST['date'] . " " . $sessionData[1];    //'Session' is required for both the session ID and the time of the reservation
            $reservation->setDate($datetime);
            $reservation->setRequest($_POST['request'] != "" ? $_POST['request'] : "None");
            $reservation->setPrice($seats * 10);    //Visitors pay €10 per person when making a reservation, the rest is payed at the restaurant

            $this->yummyservice->addReservation($reservation);

            if (isset($_SESSION['userId'])) {
                $user_id = $_SESSION['userId'];
                $product_id = $this->yummyservice->getReservationIdByName($reservation->getName());
                $qty = $seats;

                $cartItem = new ShoppingCartItem();

                $cartItem->setUser_id($user_id);
                $cartItem->setProduct_id($product_id);
                $cartItem->setQty($qty);
                if ($this->cartService->checkIfProductExistsInCart($user_id, $product_id)) {
                    echo "<script>sessionStorage.setItem('error', 'This product is already in your shopping cart. You can change the quantity in the shopping cart page.'); </script>";

                } else {
                    $this->cartService->addProductToCart($cartItem);
                    $_SESSION['cartcount']++;
                }
            } else {
                echo "<script> sessionStorage.setItem('error', 'You have to be logged in to see your cart.'); window.location.href = '/login/index' </script>";
                
            }
        } catch (Exception $error) {

            echo "<script>sessionStorage.setItem('error', '" . $error->getMessage() . "'); </script>";

        } finally {
            echo "<script>window.location.href = '/yummy'</script>";
        }
    }
}
