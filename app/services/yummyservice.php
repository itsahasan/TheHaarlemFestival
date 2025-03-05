<?php
require __DIR__ . '/../repositories/yummyrepository.php';

class YummyService
{
    private $yummyrepository;

    public function __construct()
    {
        $this->yummyrepository = new YummyRepository();
    }
    public function getFoodPageContent()
    {
        return $this->yummyrepository->getFoodPageContent();
    }
    public function getFoodPageCards()
    {
        return $this->yummyrepository->getFoodPageCards();
    }
    public function getRestaurants()
    {
        return $this->yummyrepository->getRestaurants();
    }
    public function getRestaurantById($id)
    {
        return $this->yummyrepository->getRestaurantById($id);
    }
    public function getRestaurantByIdAlt($id) {
        return $this->yummyrepository->getRestaurantByIdAlt($id);
    }
    public function getSessionsForRestaurant()
    {
        return $this->yummyrepository->getSessionsForRestaurant();
    }
    public function getSessions()
    {
        return $this->yummyrepository->getSessions();
    }
    public function getSessionById($id)
    {
        return $this->yummyrepository->getSessionById($id);
    }
    public function saveSession(Session $session)
    {
        $this->yummyrepository->saveSession($session);
    }
    public function deleteSession()
    {
        $this->yummyrepository->deleteSession();
    }
    public function saveRestaurant(Restaurant $restaurant)
    {
        $this->yummyrepository->saveRestaurant($restaurant);
    }
    public function saveImage(string $imgData)
    {
        return $this->yummyrepository->saveImage($imgData);
    }
    public function updateImage(string $imgData, int $id) {
        return $this->yummyrepository->updateImage($imgData, $id);
    }
    public function deleteRestaurant()
    {
        $this->yummyrepository->deleteRestaurant();
    }
    public function getReservations()
    {
        return $this->yummyrepository->getReservations();
    }
    public function deactivateReservation()
    {
        $this->yummyrepository->deactivateReservation();
    }
    public function addReservation(Reservation $reservation)
    {
        $this->yummyrepository->addReservation($reservation);
    }
    public function getReservationIdByName($name)
    {
        return $this->yummyrepository->getReservationIdByName($name);
    }
}
