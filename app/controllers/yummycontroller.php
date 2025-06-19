<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../services/YummyService.php';
require_once __DIR__ . '/../models/Restaurant.php';
require_once __DIR__ . '/../models/Session.php';
require_once __DIR__ . '/../models/Reservation.php';
require_once __DIR__ . '/../models/ShoppingCartItem.php';

class YummyController extends BaseController
{
    private YummyService $yummyService;

    public function __construct()
    {
        parent::__construct();
        $this->yummyService = new YummyService();
    }

    public function index()
    {
        $restaurants = $this->yummyService->getRestaurants();
        require __DIR__ . '/../views/yummy/index.php';
    }

    public function about()
    {
        $restaurantId = (int)($_GET["restaurantid"] ?? 0);
        $restaurant = $this->yummyService->getRestaurantById($restaurantId);
        if (!$restaurant) {
            $_SESSION['error_message'] = 'Restaurant not found.';
            header('Location: /yummy');
            exit;
        }

        $sessions = $this->yummyService->getSessionsForRestaurant($restaurantId);
        require __DIR__ . '/../views/yummy/restaurantabout.php';
    }

    public function addReservation()
    {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /yummy');
            exit;
        }

        $restaurantId = (int)($_GET['restaurantid'] ?? 0);

        try {
            $sessionData = explode('-', $this->getPost('session'));
            $sessionId = (int)($sessionData[0] ?? 0);
            $seats = (int)$this->getPost('formguestsadult') + (int)$this->getPost('formguestskids');

            if ($seats <= 0) { throw new Exception("You must select at least one guest."); }
            if ($sessionId <= 0) { throw new Exception("Please select a valid time session."); }

            if (!$this->yummyService->checkSeatsAvailable($sessionId, $seats)) {
                throw new Exception("There are not enough available seats for this session.");
            }

            $reservation = new Reservation();
            $reservation->setName($_SESSION['userName'] ?? 'User');
            $reservation->setRestaurantID($restaurantId);
            $reservation->setSessionID($sessionId);
            $reservation->setSeats($seats);
            $reservation->setDate($this->getPost('date') . " " . ($sessionData[1] ?? '00:00'));
            $reservation->setRequest($this->getPost('request') ?: "None");
            $reservation->setPrice($seats * 10);
            $reservation->setStatus(true);

            $newReservation = $this->yummyService->addReservation($reservation);
            if (!$newReservation) {
                throw new Exception("Could not save the reservation.");
            }

            $this->yummyService->decreaseSessionSeats($sessionId, $seats);

            $cartService = new ShoppingCartService();
            $item = new ShoppingCartItem();
            $item->setUserId((int)$_SESSION['userId']);
            $item->setProductId($newReservation->getId());
            $item->setQty(1);

            if ($cartService->addProductToCart($item)) {
                $_SESSION['success_message'] = 'Reservation added to your cart!';
            } else {
                $this->yummyService->deleteReservationById($newReservation->getId());
                throw new Exception("Could not add reservation to your cart.");
            }
        } catch (Exception $e) {
            $_SESSION['error_message'] = $e->getMessage();
        }

        header("Location: /yummy/about?restaurantid=" . $restaurantId);
        exit;
    }

    public function manageRestaurants()
    {
        $this->requireLogin();

        $restaurantToEdit = null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit'])) {
            $restaurantToEdit = $this->yummyService->getRestaurantById((int)$_POST['edit'], false);
        }

        $restaurants = $this->yummyService->getRestaurants();
        require __DIR__ . '/../views/cms/food/managerrestaurants.php';
    }

    public function saveRestaurant()
    {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /yummy/manageRestaurants'); exit;
        }

        $isUpdate = !empty($this->getPost('id'));
        $restaurant = new Restaurant();
        $restaurant->setId((int)$this->getPost('id'));
        $restaurant->setName($this->getPost('name'));
        $restaurant->setLocation($this->getPost('location'));
        $restaurant->setDescription($this->getPost('description'));
        $restaurant->setCuisine($this->getPost('cuisine'));
        $restaurant->setSeats((int)$this->getPost('seats'));
        $restaurant->setStars((int)$this->getPost('stars'));
        $restaurant->setEmail($this->getPost('email'));
        $restaurant->setPhonenumber($this->getPost('phonenumber'));
        $restaurant->setPrice((float)$this->getPost('price'));

        $existingRestaurant = $isUpdate ? $this->yummyService->getRestaurantById($restaurant->getId(), false) : null;

        for ($i = 1; $i <= 3; $i++) {
            $setMethod = "setImage" . $i;
            $getMethod = "getImage" . $i;
            $fileKey = 'image' . $i;

            if (isset($_FILES[$fileKey]) && is_uploaded_file($_FILES[$fileKey]['tmp_name'])) {
                $imageData = file_get_contents($_FILES[$fileKey]['tmp_name']);
                if ($isUpdate && $existingRestaurant && $existingRestaurant->$getMethod() > 0) {
                    $this->yummyService->updateImage($imageData, $existingRestaurant->$getMethod());
                    $restaurant->$setMethod($existingRestaurant->$getMethod());
                } else {
                    $restaurant->$setMethod($this->yummyService->saveImage($imageData));
                }
            } elseif ($isUpdate && $existingRestaurant) {
                $restaurant->$setMethod($existingRestaurant->$getMethod());
            }
        }

        if ($this->yummyService->saveRestaurant($restaurant)) {
            $_SESSION['success_message'] = 'Restaurant saved successfully.';
        } else {
            $_SESSION['error_message'] = 'Could not save restaurant.';
        }
        header("Location: /yummy/manageRestaurants");
        exit;
    }

    public function deleteRestaurant()
    {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['delete_id'])) {
            header('Location: /yummy/manageRestaurants');
            exit;
        }

        $idToDelete = (int)$this->getPost('delete_id');
        if ($idToDelete > 0) {
            if ($this->yummyService->deleteRestaurant($idToDelete)) {
                $_SESSION['success_message'] = 'Restaurant deleted.';
            } else {
                $_SESSION['error_message'] = 'Error deleting restaurant.';
            }
        }
        header("Location: /yummy/manageRestaurants");
        exit;
    }

    public function manageSessions()
    {
        $this->requireLogin();
        $sessions = $this->yummyService->getAllSessions();
        require __DIR__ . '/../views/cms/food/managesessions.php';
    }

    public function addSession()
    {
        $this->requireLogin();
        $restaurants = $this->yummyService->getRestaurants();
        require __DIR__ . '/../views/cms/food/addsession.php';
    }

    public function editSession()
    {
        $this->requireLogin();
        $id = (int)($_GET["sessionid"] ?? 0);
        $session = $this->yummyService->getSessionById($id);
        $restaurants = $this->yummyService->getRestaurants();
        require __DIR__ . '/../views/cms/food/editsession.php';
    }

    public function saveSession()
    {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /yummy/manageSessions');
            exit;
        }

        $session = new Session();
        $session->setId((int)$this->getPost('id'));
        $session->setRestaurantid((int)$this->getPost('restaurantid'));
        $session->setPrice((float)$this->getPost('price'));
        $session->setReducedprice((float)$this->getPost('reducedprice'));
        $session->setStarttime($this->getPost('starttime'));
        $session->setSession_length((float)$this->getPost('length'));
        $session->setAvailable_seats((int)$this->getPost('seats'));

        if ($this->yummyService->saveSession($session)) {
            $_SESSION['success_message'] = 'Session saved successfully.';
        } else {
            $_SESSION['error_message'] = 'Could not save session.';
        }
        header("Location: /yummy/manageSessions");
        exit;
    }

    public function deleteSession()
    {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['delete_session_id'])) {
            header('Location: /yummy/manageSessions');
            exit;
        }

        $sessionId = (int)$this->getPost('delete_session_id');
        if ($sessionId > 0) {
            if ($this->yummyService->deleteSession($sessionId)) {
                $_SESSION['success_message'] = 'Session deleted.';
            } else {
                $_SESSION['error_message'] = 'Could not delete session.';
            }
        }
        header("Location: /yummy/manageSessions");
        exit;
    }
}