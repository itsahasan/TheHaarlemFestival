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
        $id = htmlspecialchars($_GET["restaurantid"] ?? '');
        $restaurant = $this->yummyservice->getRestaurantById($id);
        if (!$restaurant) {
            echo "<script>alert('A restaurant with this ID was not found.')</script>";
            $this->index();
            return;
        }
        $sessions = $this->yummyservice->getSessionsForRestaurant();
        require __DIR__ . '/../views/yummy/restaurantabout.php';
    }


    // ------------------------ CMS: Sessions ------------------------
    public function manageSessions()
    {
        $sessions = $this->yummyservice->getSessions();
        require __DIR__ . '/../views/cms/food/managesessions.php';
    }

    public function editSession()
    {
        $id = htmlspecialchars($_GET["sessionid"] ?? '');
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


        header("Location: /yummy/manageSessions");
        exit;
    }

    public function saveSession()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newSession = new Session();
            $newSession->setId($_POST['id'] ?? 0);
            $newSession->setRestaurantid($_POST['restaurantid'] ?? null);
            $newSession->setPrice($_POST['price'] ?? null);
            $newSession->setReducedprice($_POST['reducedprice'] ?? null);
            $newSession->setStarttime($_POST['starttime'] ?? null);
            $newSession->setSession_length($_POST['length'] ?? null);
            $newSession->setAvailable_seats($_POST['seats'] ?? null);
            $this->yummyservice->saveSession($newSession);
            header("Location: /yummy/manageSessions");
            exit;
        }
    }

    // ------------------------ CMS: Restaurants ------------------------
    public function manageRestaurants()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Удаление
            if (isset($_POST['delete'])) {
                $_GET['restaurantid'] = $_POST['delete'];
                $this->yummyservice->deleteRestaurant();
                header("Location: /yummy/manageRestaurants");
                exit;
            }


            if (isset($_POST['add'])) {
                $this->saveRestaurant();
                exit;
            }


            if (isset($_POST['update'])) {
                $this->saveRestaurant();
                exit;
            }


            if (isset($_POST['edit'])) {
                $restaurantToEdit = $this->yummyservice->getRestaurantByIdAlt($_POST['edit']);
            }
        }

        $restaurants = $this->yummyservice->getRestaurants();
        require __DIR__ . '/../views/cms/food/managerrestaurants.php';
    }

    public function saveRestaurant()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $newRestaurant = new Restaurant();
            $newRestaurant->setId($_POST['id'] ?? 0);
            $newRestaurant->setName($_POST['name'] ?? '');
            $newRestaurant->setLocation($_POST['location'] ?? '');
            $newRestaurant->setDescription($_POST['description'] ?? '');
            $newRestaurant->setCuisine($_POST['cuisine'] ?? '');
            $newRestaurant->setSeats($_POST['seats'] ?? 0);
            $newRestaurant->setStars($_POST['stars'] ?? 0);
            $newRestaurant->setEmail($_POST['email'] ?? '');
            $newRestaurant->setPhonenumber($_POST['phonenumber'] ?? '');
            $newRestaurant->setPrice($_POST['price'] ?? 0.0);

            $existingRestaurant = null;
            if ($newRestaurant->getId() !== 0) {
                $existingRestaurant = $this->yummyservice->getRestaurantByIdAlt($newRestaurant->getId());
            }

            for ($i = 1; $i <= 3; $i++) {
                $setMethod = "setImage{$i}";
                $getMethod = "getImage{$i}";
                if (is_uploaded_file($_FILES["image{$i}"]['tmp_name'])) {
                    $imgData = file_get_contents($_FILES["image{$i}"]['tmp_name']);
                    if ($existingRestaurant) {
                        $oldImageId = $existingRestaurant->$getMethod();
                        $updatedId = $this->yummyservice->updateImage($imgData, (int)$oldImageId);
                        $newRestaurant->$setMethod($updatedId);
                    } else {
                        $newImageId = $this->yummyservice->saveImage($imgData);
                        $newRestaurant->$setMethod($newImageId);
                    }
                } else {
                    if ($existingRestaurant) {
                        $newRestaurant->$setMethod($existingRestaurant->$getMethod());
                    } else {
                        $newRestaurant->$setMethod(1);
                    }
                }
            }

            $this->yummyservice->saveRestaurant($newRestaurant);
            header("Location: /yummy/manageRestaurants");
            exit;
        }
    }

    // ------------------------ CMS: Reservations ------------------------
    public function manageReservations()
    {

        if (isset($_GET['reservationid'])) {
            $this->yummyservice->deactivateReservation();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
            $restaurantid = (int)($_POST['restaurantid'] ?? 0);
            $sessionData  = explode('-', $_POST['session'] ?? '');
            $sessionIdStr = trim($sessionData[0] ?? '0');

            $sessionId    = (int)$sessionIdStr;

            $selectedSession = $this->yummyservice->getSessionById($sessionId);
            $seatsAdult = (int)($_POST['formguestsadult'] ?? 0);
            $seatsKids  = (int)($_POST['formguestskids']   ?? 0);
            $seats      = $seatsAdult + $seatsKids;

            if ($selectedSession && $selectedSession->getAvailable_seats() < $seats) {
                echo "<script>alert('Not enough seats!');</script>";
            } else {
                $reservation = new Reservation();
                $reservation->setName($_POST['name'] ?? '');
                $reservation->setRestaurantID($restaurantid);
                $reservation->setSessionID($sessionId);

                $dateStr = $_POST['date'] ?? '';
                $timeStr = trim($sessionData[1] ?? '');
                $reservation->setDate($dateStr . " " . $timeStr);

                $reservation->setSeats($seats);
                $reservation->setRequest($_POST['request'] ?? 'None');
                $reservation->setPrice($seats * 10);
                $this->yummyservice->addReservation($reservation);

                if (isset($_SESSION['userId'])) {
                    $uId = $_SESSION['userId'];
                    $pId = $this->yummyservice->getReservationIdByName($reservation->getName());
                    $qty = $seats;
                    $cartItem = new ShoppingCartItem();
                    $cartItem->setUser_id($uId);
                    $cartItem->setProduct_id($pId);
                    $cartItem->setQty($qty);
                    if ($this->cartService->checkIfProductExistsInCart($uId, $pId)) {
                        echo "<script>alert('Already in cart');</script>";
                    } else {
                        $this->cartService->addProductToCart($cartItem);
                        $_SESSION['cartcount']++;
                    }
                } else {
                    echo "<script>alert('You must be logged in to add to cart');</script>";
                }
            }
            echo "<script>window.location.href='/yummy/manageReservations'</script>";
            return;
        }


        $reservations = $this->yummyservice->getReservations();
        require __DIR__ . '/../views/cms/food/manageReservations.php';
    }

    public function addReservation()
    {
        try {
            $restaurantid = htmlspecialchars($_GET['restaurantid']);

            $reservation = new Reservation();

            $sessionData = explode('-', $_POST['session']);
            $selectedsession = $this->yummyservice->getSessionById($sessionData[0]);
            $seats = $_POST['formguestsadult'] + $_POST['formguestskids'];

            if ($selectedsession->getAvailable_seats() < $seats) {
                throw new Exception("There are not enough available seats for this session");
            }

            $reservation->setName(htmlspecialchars($_POST['name']));
            $reservation->setRestaurantID($restaurantid);
            $reservation->setSessionID($sessionData[0]);
            $reservation->setSeats($seats);

            $datetime = $_POST['date'] . " " . $sessionData[1];
            $reservation->setDate($datetime);
            $reservation->setRequest($_POST['request'] != "" ? $_POST['request'] : "None");
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
