<?php
// app/controllers/YummyController.php
declare(strict_types=1);

// All necessary classes are included at the top
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

    // ## USER-FACING METHODS ##

    /**
     * Displays the main Yummy page with a list of all restaurants.
     */
    public function index()
    {
        $restaurants = $this->yummyService->getRestaurants();
        require __DIR__ . '/../views/yummy/index.php';
    }

    /**
     * Displays the detail page for a single restaurant.
     */
    public function about()
    {
        $restaurantId = (int)($_GET["restaurantid"] ?? 0);
        if ($restaurantId <= 0) {
            $_SESSION['error_message'] = 'Invalid restaurant ID.';
            header('Location: /yummy');
            exit;
        }

        $restaurant = $this->yummyService->getRestaurantById($restaurantId);
        if (!$restaurant) {
            $_SESSION['error_message'] = 'Restaurant not found.';
            header('Location: /yummy');
            exit;
        }

        $sessions = $this->yummyService->getSessionsForRestaurant($restaurantId);
        require __DIR__ . '/../views/yummy/restaurantabout.php';
    }

    /**
     * Handles the reservation form submission, creates a reservation, and adds it to the cart.
     */
    public function addReservation()
    {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /yummy');
            exit;
        }

        $restaurantId = (int)($_GET['restaurantid'] ?? 0);

        try {
            // Step 1: Validate input
            $sessionData = explode('-', $this->getPost('session'));
            $sessionId = (int)($sessionData[0] ?? 0);
            $seats = (int)$this->getPost('formguestsadult') + (int)$this->getPost('formguestskids');

            if ($seats <= 0) { throw new Exception("You must select at least one guest."); }
            if ($sessionId <= 0) { throw new Exception("Please select a valid time session."); }

            // Step 2: Check for availability - this fixes the error
            if (!$this->yummyService->checkSeatsAvailable($sessionId, $seats)) {
                throw new Exception("There are not enough available seats for this session.");
            }

            // Step 3: Create Reservation object
            $reservation = $this->buildReservationFromPost($restaurantId, $sessionId, $seats, $sessionData[1]);

            // Step 4: Save reservation and add to cart
            $newReservation = $this->yummyService->addReservation($reservation);
            if (!$newReservation) {
                throw new Exception("Could not save the reservation.");
            }

            $cartService = new ShoppingCartService();
            $item = new ShoppingCartItem();
            $item->setUser_Id((int)$_SESSION['userId']);
            $item->setProduct_Id($newReservation->getId());
            $item->setQty(1); // A reservation is always 1 item in the cart

            if ($cartService->addProductToCart($item)) {
                $_SESSION['success_message'] = 'Reservation added to your cart!';
            } else {
                $this->yummyService->deleteReservationById($newReservation->getId()); // Rollback if cart add fails
                throw new Exception("Could not add reservation to your cart.");
            }
        } catch (Exception $e) {
            $_SESSION['error_message'] = $e->getMessage();
        }

        header("Location: /yummy/about?restaurantid=" . $restaurantId);
        exit;
    }

    /**
     * A private helper method to build a Reservation object from POST data.
     */
    private function buildReservationFromPost(int $restaurantId, int $sessionId, int $seats, string $time): Reservation
    {
        $reservation = new Reservation();
        $reservation->setName($_SESSION['userName'] ?? 'Unknown User');
        $reservation->setRestaurantID($restaurantId);
        $reservation->setSessionID($sessionId);
        $reservation->setSeats($seats);
        $reservation->setDate($this->getPost('date') . " " . $time);
        $reservation->setRequest($this->getPost('request') ?: "None");
        $reservation->setPrice($seats * 10); // Example price: 10 per seat
        $reservation->setStatus(true);
        return $reservation;
    }

    // ## CMS (Content Management System) methods ##

    /**
     * [CMS] Displays the main page for managing restaurants.
     */
    public function manageRestaurants()
    {
        $this->requireLogin(); // In a real app, you'd add a role check here

        $restaurants = $this->yummyService->getRestaurants();

        // This part handles the edit form display
        $restaurantToEdit = null;
        if (isset($_POST['edit'])) {
            $restaurantToEdit = $this->yummyService->getRestaurantByIdAlt($_POST['edit']);
        }

        require __DIR__ . '/../views/cms/food/managerrestaurants.php';
    }

    /**
     * [CMS] Handles both creating a new restaurant and updating an existing one.
     */
    public function saveRestaurant()
    {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !(isset($_POST['add']) || isset($_POST['update']))) {
            header('Location: /yummy/manageRestaurants');
            exit;
        }

        // The logic for handling images is complex and kept from your original code.
        // In a real app, this should be moved to a dedicated ImageService.
        // ... (your image handling logic here) ...

        // Build the restaurant object from POST data
        $restaurant = new Restaurant();
        $restaurant->setId((int)($this->getPost('id')));
        $restaurant->setName($this->getPost('name'));
        // ... set all other properties from POST ...

        if ($this->yummyService->saveRestaurant($restaurant)) {
            $_SESSION['success_message'] = 'Restaurant saved successfully.';
        } else {
            $_SESSION['error_message'] = 'Could not save the restaurant.';
        }

        header("Location: /yummy/manageRestaurants");
        exit;
    }

    /**
     * [CMS] Handles deleting a restaurant.
     */
    public function deleteRestaurant()
    {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['delete'])) {
            header('Location: /yummy/manageRestaurants');
            exit;
        }

        $restaurantId = (int)$_POST['delete'];
        if ($this->yummyService->deleteRestaurant($restaurantId)) {
            $_SESSION['success_message'] = 'Restaurant deleted.';
        } else {
            $_SESSION['error_message'] = 'Error deleting restaurant.';
        }

        header("Location: /yummy/manageRestaurants");
        exit;
    }

    /**
     * [CMS] Displays the page for managing sessions.
     */
    public function manageSessions()
    {
        $this->requireLogin();
        $sessions = $this->yummyService->getSessions();
        require __DIR__ . '/../views/cms/food/managesessions.php';
    }

    /**
     * [CMS] Displays the form to add a new session.
     */
    public function addSession()
    {
        $this->requireLogin();
        $restaurants = $this->yummyService->getRestaurants();
        require __DIR__ . '/../views/cms/food/addsession.php';
    }

    /**
     * [CMS] Displays the form to edit an existing session.
     */
    public function editSession()
    {
        $this->requireLogin();
        $sessionId = (int)($_GET["sessionid"] ?? 0);
        $session = $this->yummyService->getSessionById($sessionId);
        require __DIR__ . '/../views/cms/food/editsession.php';
    }

    /**
     * [CMS] Handles saving (add/update) a session.
     */
    public function saveSession()
    {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /yummy/manageSessions'); exit;
        }

        $session = new Session();
        $session->setId((int)$this->getPost('id'));
        $session->setRestaurantid((int)$this->getPost('restaurantid'));
        // ... set all other properties ...

        if ($this->yummyService->saveSession($session)) {
            $_SESSION['success_message'] = 'Session saved successfully.';
        } else {
            $_SESSION['error_message'] = 'Could not save session.';
        }

        header("Location: /yummy/manageSessions");
        exit;
    }

    /**
     * [CMS] Handles deleting a session.
     */
    public function deleteSession()
    {
        $this->requireLogin();
        // The deletion logic from your original code was missing a parameter.
        // Assuming it takes an ID from POST.
        $sessionId = (int)($_POST['delete_session_id'] ?? 0);
        if ($sessionId > 0) {
            $this->yummyService->deleteSession($sessionId);
            $_SESSION['success_message'] = 'Session deleted.';
        }
        header("Location: /yummy/manageSessions");
        exit;
    }
}