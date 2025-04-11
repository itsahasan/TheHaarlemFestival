<?php

require_once 'BaseController.php';
require __DIR__ . '/../services/venueservice.php';
require __DIR__ . '/../services/eventservice.php';
require __DIR__ . '/../services/shoppingcartservice.php';
include_once __DIR__ . '/../views/getURL.php';

class VenueController extends BaseController
{
    private $venueService;
    private $eventService;
    private $cartService;

    function __construct()
    {
        parent::__construct();
        $this->venueService = new VenueService();
        $this->eventService = new EventService();
        $this->cartService = new ShoppingCartService();
    }

    public function dancevenues()
    {
        $model = $this->venueService->getAllDanceVenues();
        require __DIR__ . '/../views/dance/venuesoverview.php';
    }

    public function jazzvenues()
    {
        $model = $this->venueService->getAllJazzVenues();
        require __DIR__ . '/../views/jazz/venuesoverview.php';
    }

    public function dancevenuedetails()
    {
        $this->handleAddToCart($this->cartService);
        $params = $this->getUrlParams();
        $model = $this->venueService->getOne($params['id']);
        $events = $this->eventService->getEventsByVenueID($params['id']);
        require __DIR__ . '/../views/dance/venuedetails.php';
    }

    public function jazzvenuedetails()
    {
        $this->handleAddToCart($this->cartService);
        $params = $this->getUrlParams();
        $model = $this->venueService->getOne($params['id']);
        $events = $this->eventService->getEventsByVenueID($params['id']);
        require __DIR__ . '/../views/jazz/venuedetails.php';
    }

    public function addVenue()
{
    $venue = $this->buildVenueFromPost($_POST);
    $this->handleVenueImages($venue, $this->venueService);
    
    $savedVenue = $this->venueService->addVenue($venue);

    // ✅ Convert to boolean: true if venue object was returned, false otherwise
    $success = $savedVenue instanceof Venue;

    $this->showAlert($success, 'Venue added successfully.', 'Failed to add venue.');
}


    public function updateVenue()
    {
        $id = $this->sanitize($_GET["updateID"]);
        $venue = $this->buildVenueFromPost($_POST, true);
        $existing = $this->venueService->getAVenue($id);
        $this->handleVenueImages($venue, $this->venueService, $existing);
        $success = $this->venueService->updateVenue($venue, $id);
        $this->showAlert($success, 'Venue updated successfully.', 'Failed to update venue.');
    }

    public function deleteVenue()
{
    $id = $this->sanitize($_GET["deleteID"]);
    $success = $this->venueService->deleteVenue($id) ?? false;
    $this->showAlert($success, 'Venue deleted successfully.', 'Failed to delete venue.');
}


    public function venuecms()
    {
        $this->requireAdmin();

        if (isset($_POST["delete"])) $this->deleteVenue();
        if (isset($_POST["add"]))    $this->addVenue();
        if (isset($_POST["update"])) $this->updateVenue();

        if (isset($_POST["edit"])) {
            $id = $this->sanitize($_GET["updateID"]);
            $updateVenue = $this->venueService->getOne($id);
        }

        $model = $this->getFilteredVenues($this->venueService);
        require __DIR__ . '/../views/cms/music/venue-cms.php';
    }
}
