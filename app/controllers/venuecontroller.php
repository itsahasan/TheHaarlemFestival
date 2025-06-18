<?php
// controllers/VenueController.php
declare(strict_types=1);

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../services/VenueService.php';
require_once __DIR__ . '/../services/EventService.php';


class VenueController extends BaseController
{
    private VenueService $venueService;
    private EventService $eventService;

    public function __construct()
    {
        parent::__construct();
        $this->venueService = new VenueService();
        $this->eventService = new EventService();
    }

    // Displays the overview page for Dance venues
    public function dancevenues()
    {
        $model = $this->venueService->getAllDanceVenues();
        require __DIR__ . '/../views/dance/venuesoverview.php';
    }

    // Displays the overview page for Jazz venues
    public function jazzvenues()
    {
        $model = $this->venueService->getAllJazzVenues();
        require __DIR__ . '/../views/jazz/venuesoverview.php';
    }

    // Displays the detail page for a Dance venue
    public function dancevenuedetails()
    {
        $id = (int)($_GET['id'] ?? 0);
        $this->loadVenueDetails($id);
    }

    // Displays the detail page for a Jazz venue
    public function jazzvenuedetails()
    {
        $id = (int)($_GET['id'] ?? 0);
        $this->loadVenueDetails($id);
    }

    // Private helper to load data for any venue detail page
    private function loadVenueDetails(int $id)
    {
        if ($id <= 0) {
            header('Location: /');
            exit;
        }
        $model = $this->venueService->getOne($id);
        $events = $this->eventService->getEventsByVenueID($id);
        require __DIR__ . '/../views/dance/venuedetails.php'; // Assuming layout is the same for jazz/dance
    }

    // ## CMS Methods ##

    public function venuecms()
    {
        $this->requireLogin(); // Add admin role check

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST["delete"])) {
                $this->deleteVenue();
            }
            if (isset($_POST["add"])) {
                $this->addVenue();
            }
            if (isset($_POST["update"])) {
                $this->updateVenue();
            }
        }

        $model = $this->venueService->getAll();
        require __DIR__ . '/../views/cms/music/venue-cms.php';
    }

    private function addVenue()
    {
        // This is a basic implementation. You should add validation.
        $venue = new Venue();
        $venue->setName($this->getPost("name"));
        $venue->setDescription($this->getPost("description"));
        $venue->setType($this->getPost("type"));

        // Image handling logic would go here
        // ...

        if ($this->venueService->addVenue($venue)) {
            $_SESSION['success_message'] = 'Venue added successfully.';
        } else {
            $_SESSION['error_message'] = 'Failed to add venue.';
        }
        header('Location: /venue/venuecms');
        exit;
    }

    private function updateVenue()
    {
        $id = (int)$this->getPost("updateID");
        // ... Logic to build Venue object from POST ...
        // $this->venueService->updateVenue($venue, $id);
        $_SESSION['success_message'] = 'Venue updated successfully.';
        header('Location: /venue/venuecms');
        exit;
    }

    private function deleteVenue()
    {
        $id = (int)$this->getPost("deleteID");
        // $this->venueService->deleteVenue($id);
        $_SESSION['success_message'] = 'Venue deleted successfully.';
        header('Location: /venue/venuecms');
        exit;
    }
}