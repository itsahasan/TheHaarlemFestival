<?php
require_once __DIR__ . '/../repositories/YummyRepository.php';

class YummyService
{
    private YummyRepository $yummyRepository;

    public function __construct() {
        $this->yummyRepository = new YummyRepository();
    }

    public function getRestaurants(): array {
        return $this->yummyRepository->getAllRestaurants();
    }

    public function getRestaurantById(int $id, bool $asArray = true) {
        return $this->yummyRepository->getRestaurantById($id, $asArray);
    }

    public function getSessionsForRestaurant(int $restaurantId): array {
        return $this->yummyRepository->getSessionsForRestaurant($restaurantId);
    }

    public function getSessionById(int $id): ?Session {
        return $this->yummyRepository->getSessionById($id);
    }

    public function checkSeatsAvailable(int $sessionId, int $seats): bool {
        return $this->yummyRepository->checkSeatsAvailable($sessionId, $seats);
    }

    public function addReservation(Reservation $reservation): ?Reservation {
        return $this->yummyRepository->addReservation($reservation);
    }

    public function deleteReservationById(int $id): bool {
        return $this->yummyRepository->deleteReservationById($id);
    }

    public function decreaseSessionSeats(int $sessionId, int $seats): bool {
        return $this->yummyRepository->decreaseSessionSeats($sessionId, $seats);
    }

    public function saveImage(string $imageData): int {
        return $this->yummyRepository->saveImage($imageData);
    }

    public function updateImage(string $imageData, int $imageId): bool {
        return $this->yummyRepository->updateImage($imageData, $imageId);
    }

    public function deleteRestaurant(int $id): bool {
        return $this->yummyRepository->deleteRestaurant($id);
    }

    public function getAllSessions(): array {
        return $this->yummyRepository->getAllSessions();
    }

    public function saveSession(Session $session): bool {
        return $this->yummyRepository->saveSession($session);
    }

    public function deleteSession(int $id): bool {
        return $this->yummyRepository->deleteSession($id);
    }

    public function saveRestaurant(Restaurant $restaurant): bool
    {
        if ($restaurant->getId() > 0) {
            return $this->yummyRepository->updateRestaurant($restaurant);
        } else {
            return $this->yummyRepository->createRestaurant($restaurant);
        }
    }
}