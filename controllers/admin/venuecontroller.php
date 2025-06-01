<?php

require_once __DIR__ . '/../basecontroller.php';
require __DIR__ . '/../../services/venueservice.php';
require __DIR__ . '/../../services/eventservice.php';
require __DIR__ . '/../../services/shoppingcartservice.php';
include_once __DIR__ . '/../../views/getURL.php';

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

    

    public function list()
    {
        $this->requireAdmin();

        $model = $this->getFilteredVenues($this->venueService);
        $type = null;
        if (isset($_POST["dance"])) $type = "dance";
        if (isset($_POST["jazz"])) $type = "jazz";
        $createUrl =   $type ?  '/admin/venue/create?type='. $type : '/admin/venue/create' ;
        
        require __DIR__ . '/../../views/cms/music/venue-cms.php';
    }

    public function create() {


        $type = isset($_GET["type"]) ? $_GET["type"] : NULL;
        require __DIR__ . '/../../views/cms/music/venue-create.php';

    }


    public function store(){

        $venue = $this->buildVenueFromPost($_POST);
        $this->handleVenueImages($venue, $this->venueService);
        $success = $this->venueService->addVenue($venue);
        $this->showAlert(true, 'Venue added successfully.', 'Failed to add venue.','/admin/venue/list');

    }


    public function edit(){

        $id = $this->sanitize($_GET["updateID"]);
        $updateVenue = $this->venueService->getOne($id);
    
        require __DIR__ . '/../../views/cms/music/venue-edit.php';

    }


    public function update(){

        $id = $this->sanitize($_GET["updateID"]);
        $venue = $this->buildVenueFromPost($_POST, true);
        $existing = $this->venueService->getAVenue($id);
        $this->handleVenueImages($venue, $this->venueService, $existing);
        $success = $this->venueService->updateVenue($venue, $id);
        $this->showAlert($success, 'Venue updated successfully.', 'Failed to update venue.','/admin/venue/list');

    }


    public  function delete() {

        $id = $this->sanitize($_GET["deleteID"]);
        $success = $this->venueService->deleteVenue($id);

        $this->showAlert(true, 'Venue deleted successfully.', 'Failed to delete venue.' , '/admin/venue/list');

    }


}