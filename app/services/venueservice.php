<?php
require __DIR__ . '/../repositories/venuerepository.php';

class VenueService
{
    private $venueRepository;

    public function __construct()
    {
        $this->venueRepository = new VenueRepository();
    }

    public function getAll()
    {
        return $this->venueRepository->getAll();
    }

    public function getAllDanceVenues()
    {
        return $this->venueRepository->getAllDanceVenues();
    }

    public function getAllJazzVenues()
    {
        return $this->venueRepository->getAllJazzVenues();
    }

    public function getOne($id)
    {
        return $this->venueRepository->getOne($id);
    }

    public function addVenue(Venue $venue)
    {
        return $this->venueRepository->addVenue($venue);
    }

    public function updateVenue($venue, $id)
    {
        return $this->venueRepository->updateVenue($venue, $id);
    }

    public function deleteVenue($id)
    {
        return $this->venueRepository->deleteVenue($id);
    }

    public function saveImage($imgData)
    {
        return $this->venueRepository->saveImage($imgData);
    }

    public function updateImage($imgData, $id)
    {
        return $this->venueRepository->updateImage($imgData, $id);
    }

    public function getAVenue($id)
    {
        return $this->venueRepository->getAVenue($id);
    }
}
