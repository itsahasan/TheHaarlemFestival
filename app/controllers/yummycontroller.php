<?php
require __DIR__ . '/../services/yummyservice.php';
require __DIR__ . '/../services/shoppingcartservice.php';

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
        foreach ($restaurants as $restaurant) {
            if (method_exists($restaurant, 'getPrice') && $restaurant->getPrice() === null) {
                $restaurant->setPrice(0); // Fallback if uninitialized
            }
        }
        require __DIR__ . '/../views/yummy/index.php';
    }

    public function about()
    {
        $id = htmlspecialchars($_GET["restaurantid"]);

        $restaurant = $this->yummyservice->getRestaurantById($id);
        if (is_null($restaurant)) {
            echo "<script>alert('A restaurant with this ID was not found in the database')</script>";
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
            $reservation->setDate($_POST['date'] . " " . $sessionData[1]);
            $reservation->setRequest($_POST['request'] ?: "None");
            $reservation->setPrice($seats * 10);

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
                    echo "<script>alert('This product is already in your shopping cart. You can change the quantity in the shopping cart page.')</script>";
                } else {
                    $this->cartService->addProductToCart($cartItem);
                    $_SESSION['cartcount']++;
                }
            } else {
                echo "<script>
                    alert('You have to be logged in to add to cart.');
                    window.location.href = '/login/index';
                    </script>";
            }
        } catch (Exception $error) {
            echo "<script>alert('" . $error->getMessage() . "')</script>";
        } finally {
            echo "<script>window.location.href = '/yummy'</script>";
        }
    }
}
