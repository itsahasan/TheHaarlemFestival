<?php
require __DIR__ . '/../repositories/eventrepository.php';

class EventService
{
    private $eventRepository;

    public function __construct()
    {
        $this->eventRepository = new EventRepository();
    }

    public function getAll()
    {
        return $this->eventRepository->getAll();
    }

    public function getAllDanceEvents()
    {
        return $this->eventRepository->getAllDanceEvents();
    }

    public function getAllJazzEvents()
    {
        return $this->eventRepository->getAllJazzEvents();
    }

    public function getOne($id)
    {
        return $this->eventRepository->getOne($id);
    }

    public function getDanceEventsByDate($datetime)
    {
        return $this->eventRepository->getDanceEventsByDate($datetime);
    }

    public function getJazzEventsByDate($datetime)
    {
        return $this->eventRepository->getJazzEventsByDate($datetime);
    }

    public function getEventsByArtistName($artistID)
    {
        return $this->eventRepository->getEventsByArtistName($artistID);
    }

    public function getEventsByVenueID($venueID)
    {
        return $this->eventRepository->getEventsByVenueID($venueID);
    }

    public function addEvent($event)
    {
        return $this->eventRepository->addEvent($event);
    }

    public function updateEvent($event, $id)
    {
        return $this->eventRepository->updateEvent($event, $id);
    }

    public function deleteEvent($id)
    {
        return $this->eventRepository->deleteEvent($id);
    }
}
