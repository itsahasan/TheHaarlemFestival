<?php

require_once 'BaseController.php';
require __DIR__ . '/../services/eventservice.php';
require __DIR__ . '/../services/artistservice.php';
require __DIR__ . '/../services/venueservice.php';
require __DIR__ . '/../services/ticketpassservice.php';
require __DIR__ . '/../services/shoppingcartservice.php';
include_once __DIR__ . '/../views/getURL.php';

class EventController extends BaseController
{
    private $eventService;
    private $artistService;
    private $venueService;
    private $ticketpassService;
    private $cartService;

    function __construct()
    {
        parent::__construct();
        $this->eventService = new EventService();
        $this->artistService = new ArtistService();
        $this->venueService = new VenueService();
        $this->ticketpassService = new TicketPassService();
        $this->cartService = new ShoppingCartService();
    }

    public function danceevents()
    {
        var_dump($_POST);
        $this->handleAddToCart($this->cartService);
        $model = $this->filterEventsByDate('dance');
        $passes = $this->ticketpassService->getDancePasses();
        require __DIR__ . '/../views/dance/eventsoverview.php';
    }

    public function jazzevents()
    {
        $this->handleAddToCart($this->cartService);
        $model = $this->filterEventsByDate('jazz');
        $passes = $this->ticketpassService->getJazzPasses();
        require __DIR__ . '/../views/jazz/eventsoverview.php';
    }

    private function filterEventsByDate($type)
{
    $dates = [
        'wednesday' => '2025-07-26',
        'thursday'  => '2025-07-27',
        'friday'    => '2025-07-28',
        'saturday'  => '2025-07-29',
    ];

    foreach ($dates as $key => $date) {
        if (isset($_POST[$key])) {
            $method = "get" . ucfirst($type) . "EventsByExactDate";
            return $this->eventService->$method($date); 
        }
    }

    $method = "getAll" . ucfirst($type) . "Events";
    return $this->eventService->$method();
}

    public function eventcms()
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
            echo "<script>alert('Access denied. Admins only.'); window.location.href = '/';</script>";
            exit();
        }

        if (isset($_POST["delete"])) {
            $this->deleteEvent();
        }
        if (isset($_POST["add"])) {
            $this->addEvent();
        }
        if (isset($_POST["update"])) {
            $this->updateEvent();
        }

        $model = $this->filterEventsByType();
        $artists = $this->artistService->getAll();
        $venues = $this->venueService->getAll();

        require __DIR__ . '/../views/cms/music/musicevent-cms.php';
    }

    private function filterEventsByType()
    {
        if (isset($_POST["dance"])) {
            return $this->eventService->getAllDanceEvents();
        } elseif (isset($_POST["jazz"])) {
            return $this->eventService->getAllJazzEvents();
        }
        return $this->eventService->getAll();
    }

    public function addEvent()
    {
        $event = $this->buildEventFromPost($_POST);
        $success = $this->eventService->addEvent($event);
        $this->showAlert($success, 'Event added successfully.', 'Failed to add event.');
    }

    public function updateEvent()
    {
        $id = $this->sanitize($_GET["updateID"]);
        $event = $this->buildEventFromPost($_POST, true);
        $success = $this->eventService->updateEvent($event, $id);
        $this->showAlert($success, 'Event updated successfully.', 'Failed to update event.');
    }

    public function deleteEvent()
    {
        $id = $this->sanitize($_GET["deleteID"]);
        $success = $this->eventService->deleteEvent($id);
        $this->showAlert($success, 'Event deleted successfully.', 'Failed to delete event.');
    }

    private function buildEventFromPost($post, $isUpdate = false)
    {
        $event = new Music_Event();
        $event->setType($this->getPost("type", "updatedType"));
        $event->setArtist($this->getPost("artistName", "updatedArtistName"));
        $event->setVenue($this->getPost("venueName", "updatedVenueName"));
        $event->setTicket_price($this->getPost("price", "updatedPrice"));
        $event->setTickets_available($this->getPost("stock", "updatedStock"));
        $event->setDatetime($this->getPost("datetime", "updatedDatetime"));
        $event->setImage(1);
        $event->setName($event->getArtist());
        return $event;
    }
}
