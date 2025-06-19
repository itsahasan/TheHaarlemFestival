<?php
declare(strict_types=1);

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../services/EventService.php';
require_once __DIR__ . '/../services/TicketPassService.php';
require_once __DIR__ . '/../services/ShoppingCartService.php';
require_once __DIR__ . '/../models/ShoppingCartItem.php';

class EventController extends BaseController
{
    private EventService $eventService;
    private TicketPassService $ticketpassService;

    public function __construct()
    {
        parent::__construct();
        $this->eventService = new EventService();
        $this->ticketpassService = new TicketPassService();
    }

    public function danceevents()
    {
        $model = $this->filterEventsByDate('dance');
        $passes = $this->ticketpassService->getDancePasses();
        require __DIR__ . '/../views/dance/eventsoverview.php';
    }

    public function jazzevents()
    {
        $model = $this->filterEventsByDate('jazz');
        $passes = $this->ticketpassService->getJazzPasses();
        require __DIR__ . '/../views/jazz/eventsoverview.php';
    }

    public function addToCart()
    {
        $this->requireLogin();
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /');
            exit;
        }

        $productId = (int)$this->getPost('product_id');
        $quantity = (int)($this->getPost('quantity') ?: 1);

        if ($productId <= 0 || $quantity <= 0) {
            $_SESSION['error_message'] = 'Invalid product data.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $cartService = new ShoppingCartService();
        if ($cartService->checkIfProductExistsInCart((int)$_SESSION['userId'], $productId)) {
            $_SESSION['error_message'] = 'This item is already in your cart.';
            header('Location: ' . $_SERVER['HTTP_REFERER']);
            exit;
        }

        $item = new ShoppingCartItem();
        $item->setUserId((int)$_SESSION['userId']);
        $item->setProductId($productId);
        $item->setQty($quantity);

        if ($cartService->addProductToCart($item)) {
            $_SESSION['success_message'] = 'Item added to cart!';
        } else {
            $_SESSION['error_message'] = 'Could not add item to cart.';
        }

        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit;
    }

    private function filterEventsByDate($type)
    {
        $dates = [ 'wednesday' => '2025-07-26', 'thursday'  => '2025-07-27', 'friday'    => '2025-07-28', 'saturday'  => '2025-07-29' ];
        foreach ($dates as $key => $date) {
            if (isset($_POST[$key])) {
                $method = "get" . ucfirst($type) . "EventsByDate";
                return $this->eventService->$method("%$date%");
            }
        }
        $method = "getAll" . ucfirst($type) . "Events";
        return $this->eventService->$method();
    }

    public function eventcms()
    {
        $this->requireLogin();
        echo "<h1>Events CMS</h1><p>This page will be implemented later.</p>";
    }
}