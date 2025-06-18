<?php
// app/services/YummyService.php

require_once __DIR__ . '/../repositories/YummyRepository.php';

class YummyService
{
    private YummyRepository $yummyRepository;

    public function __construct() {
        $this->yummyRepository = new YummyRepository();
    }

    public function getRestaurants(): array
    {
        return $this->yummyRepository->getAllRestaurants();
    }

    public function getRestaurantById(int $id): ?array
    {
        return $this->yummyRepository->getRestaurantById($id);
    }

    public function getSessionsForRestaurant(int $restaurantId): array
    {
        return $this->yummyRepository->getSessionsForRestaurant($restaurantId);
    }

    public function getSessionById(int $id): ?Session
    {
        return $this->yummyRepository->getSessionById($id);
    }

    public function checkSeatsAvailable(int $sessionId, int $seats): bool
    {
        return $this->yummyRepository->checkSeatsAvailable($sessionId, $seats);
    }

    public function addReservation(Reservation $reservation): ?Reservation
    {
        return $this->yummyRepository->addReservation($reservation);
    }

    public function deleteReservationById(int $id): bool
    {
        return $this->yummyRepository->deleteReservationById($id);
    }

    // Add other CMS pass-through methods here if needed
}