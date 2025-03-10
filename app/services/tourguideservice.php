<?php
require __DIR__ . '/../repositories/tourguiderepository.php';

class TourGuideService
{
    private $tourguideRepository;

    function __construct()
    {
        $this->tourguideRepository = new TourGuideRepository();   
    }

    public function getAll()
    {
        // retrieve data
        return $this->tourguideRepository->getAll();
    }

    public function getOne($id)
    {
        return $this->tourguideRepository->getOne($id);
    }

    public function getOneTourguideByName($name)
    {
        return $this->tourguideRepository->getOneTourguideByName($name);
    }

    public function addTourguide(TourGuide $tourguides)
    {
        return $this->tourguideRepository->addTourguide($tourguides);
    }

    public function updateTourguide($tourguides, $id)
    {
        return $this->tourguideRepository->updateTourguide($tourguides, $id);
    }

    public function deleteTourguide($id)
    {
        return $this->tourguideRepository->deleteTourguide($id);
    }

    public function saveImage($imgInfo)
    {
        return $this->tourguideRepository->saveImage($imgInfo);
    }

    public function updateImage($imgInfo, $id)
    {
        return $this->tourguideRepository->updateImage($imgInfo, $id);
    }

    public function getATourguide($id)
    {
        return $this->tourguideRepository->getATourguide($id);
    }
}
