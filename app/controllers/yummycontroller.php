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
        require __DIR__ . '/../views/yummy/index.php';
    }
    public function about()
    {
        $id = htmlspecialchars($_GET["restaurantid"]);

        $restaurant = $this->yummyservice->getRestaurantById($id);
        if(is_null($restaurant))
        {
            echo "<script>alert('A restaurant with this ID was not found in the database')</script>";
            $this->index();
            return;
        }

        $sessions = $this->yummyservice->getSessionsForRestaurant();
        require __DIR__ . '/../views/yummy/restaurantabout.php';
    }

    //--------------------------------------------CMS functionality---------------------------------------------------------------------

    public function manageSessions()
    {
        $sessions = $this->yummyservice->getSessions();
        require __DIR__ . '/../views/cms/food/managesessions.php';
    }
    public function editSession()
    {
        $id = htmlspecialchars($_GET["sessionid"]);

        $session = $this->yummyservice->getSessionById($id);
        require __DIR__ . '/../views/cms/food/editsession.php';
    }
    public function addSession()
    {
        $restaurants = $this->yummyservice->getRestaurants();
        require __DIR__ . '/../views/cms/food/addsession.php';
    }
    public function deleteSession()
    {
        $this->yummyservice->deleteSession();
        require __DIR__ . '/../views/cms/food/deletesession.php';
    }
    public function saveSession()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newSession = new Session();
            $newSession->setId(isset($_POST['id']) ? $_POST['id'] : 0);
            $newSession->setRestaurantid(isset($_POST['restaurantid']) ? $_POST['restaurantid'] : null); //check if information was sent, if so it assigns the value, otherwise sets to null 
            $newSession->setPrice(isset($_POST['price']) ? $_POST['price'] : null);
            $newSession->setReducedprice(isset($_POST['reducedprice']) ? $_POST['reducedprice'] : null);
            $newSession->setStarttime(isset($_POST['starttime']) ? $_POST['starttime'] : null);
            $newSession->setSession_length(isset($_POST['length']) ? $_POST['length'] : null);
            $newSession->setAvailable_seats(isset($_POST['seats']) ? $_POST['seats'] : null);

            $this->yummyservice->saveSession($newSession);
            $this->manageSessions();
        }
    }

    public function manageRestaurants()
    {
        $restaurants = $this->yummyservice->getRestaurants();
        require __DIR__ . '/../views/cms/food/managerestaurants.php';
    }
    public function editRestaurant()
    {
        $id = htmlspecialchars($_GET["restaurantid"]);

        $restaurant = $this->yummyservice->getRestaurantById($id);
        require __DIR__ . '/../views/cms/food/editrestaurant.php';
    }
    public function addRestaurant()
    {
        require __DIR__ . '/../views/cms/food/addrestaurant.php';
    }
    public function deleteRestaurant()
    {
        $this->yummyservice->deleteRestaurant();
        require __DIR__ . '/../views/cms/food/deleterestaurant.php';
    }
    public function saveRestaurant()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newRestaurant = new Restaurant();
            $newRestaurant->setId(isset($_POST['id']) ? $_POST['id'] : 0);
            $newRestaurant->setName(isset($_POST['name']) ? $_POST['name'] : null);
            $newRestaurant->setLocation(isset($_POST['location']) ? $_POST['location'] : null);
            $newRestaurant->setDescription(isset($_POST['description']) ? $_POST['description'] : null);
            $newRestaurant->setCuisine(isset($_POST['cuisine']) ? $_POST['cuisine'] : null);
            $newRestaurant->setSeats(isset($_POST['seats']) ? $_POST['seats'] : null);
            $newRestaurant->setStars(isset($_POST['stars']) ? $_POST['stars'] : null);
            $newRestaurant->setEmail(isset($_POST['email']) ? $_POST['email'] : null);
            $newRestaurant->setPhonenumber(isset($_POST['phonenumber']) ? $_POST['phonenumber'] : null);

            $restaurant = $this->yummyservice->getRestaurantByIdAlt($_POST['id']);
            if (count($_FILES) > 0) {
                if (is_null($restaurant)) {

                    for ($imgnumber = 1; $imgnumber <= 3; $imgnumber++) {
                        if (is_uploaded_file($_FILES['image' . $imgnumber]['tmp_name'])) {
                            $imgData = file_get_contents($_FILES['image' . $imgnumber]['tmp_name']);
                            $setMethod = "setImage" . $imgnumber;
                            $newRestaurant->$setMethod($this->yummyservice->saveImage($imgData));
                        }
                    }
                }
                else {
                    for ($imgnumber = 1; $imgnumber <= 3; $imgnumber++) {
                        if (is_uploaded_file($_FILES['image' . $imgnumber]['tmp_name'])) {
                            $imgData = file_get_contents($_FILES['image' . $imgnumber]['tmp_name']);
                            $setMethod = "setImage" . $imgnumber;
                            $getmethod = "getImage" . $imgnumber;
                            $newRestaurant->$setMethod($this->yummyservice->updateImage($imgData, $restaurant->$getmethod()));
                        }
                    }
                }
            }

            $this->yummyservice->saveRestaurant($newRestaurant);

            $this->manageRestaurants();
        }
    }
    public function manageReservations()
    {
        $reservations = $this->yummyservice->getReservations();
        require __DIR__ . '/../views/cms/food/managereservations.php';
    }
    public function deactivateReservation()
    {
        $this->yummyservice->deactivateReservation();
        require __DIR__ . '/../views/cms/food/deactivatereservation.php';
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
        } catch (Exception $error) {

            echo "<script>alert('" . $error->getMessage() . "')</script>";
        } finally {
            echo "<script>window.location.href = '/yummy'</script>";
        }
    }
}
