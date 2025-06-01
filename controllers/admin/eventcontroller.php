<?php

require_once __DIR__ . '/../basecontroller.php';
require __DIR__ . '/../../services/eventservice.php';
require __DIR__ . '/../../services/artistservice.php';
require __DIR__ . '/../../services/venueservice.php';
require __DIR__ . '/../../services/ticketpassservice.php';
require __DIR__ . '/../../services/shoppingcartservice.php';
include_once __DIR__ . '/../../views/getURL.php';

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

    public function list()
    {

        $this->requireAdmin();

        // $updateEvent = null;


        $model = $this->filterEventsByType();
        $artists = $this->artistService->getAll();
        $venues = $this->venueService->getAll();

        $type = null;
        if (isset($_POST["dance"])) $type = "dance";
        if (isset($_POST["jazz"])) $type = "jazz";

        $createUrl =   $type ?  '/admin/event/create?type='. $type : '/admin/event/create' ;


        require __DIR__ . '/../../views/cms/music/musicevent-cms.php';
    }



    public function create(){


        $artists = $this->artistService->getAll();
        $venues = $this->venueService->getAll();
        
        $type = isset($_GET["type"]) ? $_GET["type"] : NULL;

        require __DIR__ . '/../../views/cms/music/musicevent-create.php';
    }
    public function store(){


        $event = $this->buildEventFromPost($_POST);
        $created = $this->eventService->addEvent($event);

        $this->showAlert($created !== null, 'Event added successfully.', 'Failed to add event.' , '/admin/event/list');

    }


    public function edit(){

        $id = $this->sanitize($_GET["updateID"]);
        $updateEvent = $this->eventService->getOne($id);
        $artists = $this->artistService->getAll();
        $venues = $this->venueService->getAll();
        
        require __DIR__ . '/../../views/cms/music/musicevent-edit.php';

    }


    public function update(){


        $id = $this->sanitize($_GET["updateID"]);
        $event = $this->buildEventFromPost($_POST, true);
        $success = $this->eventService->updateEvent($event, $id);

        $this->showAlert($success, 'Event updated successfully.', 'Failed to update event.' ,'/admin/event/list');

    }



    public function delete(){


        $id = $this->sanitize($_GET["deleteID"]);
        $success = $this->eventService->deleteEvent($id);



        $this->showAlert($success, 'Event deleted successfully.', 'Failed to delete event.' , '/admin/event/list');

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

 

    private function buildEventFromPost($post, $isUpdate = false)
    {
        $event = new Music_Event();
        $event->setType($this->getPost("type", "updatedType"));
        $event->setArtist($this->getPost("artistName", "updatedArtistName"));
        $event->setVenue($this->getPost("venueName", "updatedVenueName"));

        $rawPrice = $this->getPost("price", "updatedPrice");
        $event->setTicket_price((int) preg_replace('/[^\d]/', '', $rawPrice)); // ensures int

        $event->setTickets_available($this->getPost("stock", "updatedStock"));
        $event->setDatetime($this->getPost("datetime", "updatedDatetime"));


        $image = $this->handleImageUpload(
                    'image',
                    $this->eventService,

                );
        if($image){
            $event->setImage($image); 
        }

        $event->setName($event->getArtist());
        return $event;
    }


}
