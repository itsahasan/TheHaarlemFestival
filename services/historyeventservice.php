<?php

require __DIR__ . '/../repositories/historyeventrepository.php';

class HistoryEventService
{
    private $historyeventRepository;

    function __construct()
    {
        $this->historyeventRepository = new HistoryEventRepository();
    }

    public function getAllInfo()
    {
        //retrieve data
        return $this->historyeventRepository->getAllInfo();
    }

    public function getAll()
    {
        return $this->historyeventRepository->getAll();
    }

    public function getOne($id)
    {
        return $this->historyeventRepository->getOne($id);
    }

    public function addHistoryEvent(HistoryEvent $historyevent)
    {
        return $this->historyeventRepository->addHistoryEvent($historyevent);
    }

    public function updateHistoryEvent($historyevent, $id)
    {
        return $this->historyeventRepository->updateHistoryEvent($historyevent, $id);
    }

    public function deleteHistoryEvent($id)
    {
        return $this->historyeventRepository->deleteHistoryEvent($id);
    }

    public function saveImage($imgInfo)
    {
        return $this->historyeventRepository->saveImage($imgInfo);
    }

    public function updateImage($imgInfo, $id)
    {
        return $this->historyeventRepository->updateImage($imgInfo, $id);
    }

    public function getAHistoryEvent($id)
    {
        return $this->historyeventRepository->getAHistoryEvent($id);
    }

    public function getHistoryEventsByDate($datetime)
    {
        return $this->historyeventRepository->getHistoryEventsByDate($datetime);
    }
}
