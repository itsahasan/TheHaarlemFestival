<?php
// app/repositories/YummyRepository.php

require_once __DIR__ . '/../models/Restaurant.php';
require_once __DIR__ . '/../models/Session.php';
require_once __DIR__ . '/../models/Reservation.php';

class YummyRepository
{
    private \PDO $connection;

    public function __construct()
    {
        // Database connection logic from your original file
        $configPath = __DIR__ . '/../config/dbconfig.php';
        if (!file_exists($configPath)) { throw new \RuntimeException("Missing config file: $configPath"); }
        require $configPath;
        $dsn = sprintf('%s:host=%s;dbname=%s;charset=utf8mb4', $type, $servername, $database);
        try {
            $this->connection = new \PDO($dsn, $username, $password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
        } catch (\PDOException $e) {
            error_log("DB connection failed: " . $e->getMessage());
            throw $e;
        }
    }

    // ## Public user methods ##

    public function getAllRestaurants(): array
    {
        try {
            $stmt = $this->connection->query("
                SELECT 
                    r.*, 
                    img1.image AS image1_data
                FROM restaurant AS r
                LEFT JOIN images AS img1 ON r.image1 = img1.id
                ORDER BY r.name
            ");
            // Возвращаем результат как массив ассоциативных массивов
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("getAllRestaurants error: " . $e->getMessage());
            return [];
        }
    }

    public function getRestaurantById(int $id): ?array
    {
        try {
            $stmt = $this->connection->prepare("
                SELECT 
                    r.*, 
                    img1.image AS image1_data, 
                    img2.image AS image2_data, 
                    img3.image AS image3_data
                FROM restaurant AS r
                LEFT JOIN images AS img1 ON r.image1 = img1.id
                LEFT JOIN images AS img2 ON r.image2 = img2.id
                LEFT JOIN images AS img3 ON r.image3 = img3.id
                WHERE r.id = :id
            ");
            $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
        } catch (PDOException $e) {
            error_log("getRestaurantById error: " . $e->getMessage());
            return null;
        }
    }

    public function getSessionsForRestaurant(int $restaurantId): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM food_session WHERE restaurantid = :id ORDER BY starttime");
        $stmt->bindValue(':id', $restaurantId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Session::class);
    }

    public function getSessionById(int $id): ?Session
    {
        $stmt = $this->connection->prepare("SELECT * FROM food_session WHERE id = :id");
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Session::class);
        return $stmt->fetch() ?: null;
    }

    public function checkSeatsAvailable(int $sessionId, int $requestedSeats): bool
    {
        try {
            $stmt = $this->connection->prepare("SELECT available_seats FROM food_session WHERE id = :sessionId");
            $stmt->bindValue(':sessionId', $sessionId, PDO::PARAM_INT);
            $stmt->execute();
            $availableSeats = $stmt->fetchColumn();

            if ($availableSeats === false) { return false; } // Session not found
            return (int)$availableSeats >= $requestedSeats;
        } catch (PDOException $e) {
            error_log("YummyRepository::checkSeatsAvailable error: " . $e->getMessage());
            return false;
        }
    }

    public function addReservation(Reservation $reservation): ?Reservation
    {
        try {
            $stmt = $this->connection->prepare(
                "INSERT INTO reservation (name, restaurantID, sessionID, seats, date, request, price, status) 
                 VALUES (:name, :restaurantID, :sessionID, :seats, :date, :request, :price, :status)"
            );
            $stmt->bindValue(':name', $reservation->getName());
            $stmt->bindValue(':restaurantID', $reservation->getRestaurantID(), PDO::PARAM_INT);
            $stmt->bindValue(':sessionID', $reservation->getSessionID(), PDO::PARAM_INT);
            $stmt->bindValue(':seats', $reservation->getSeats(), PDO::PARAM_INT);
            $stmt->bindValue(':date', $reservation->getDate());
            $stmt->bindValue(':request', $reservation->getRequest());
            $stmt->bindValue(':price', $reservation->getPrice());
            $stmt->bindValue(':status', $reservation->getStatus(), PDO::PARAM_BOOL);
            $stmt->execute();

            $reservation->setId((int)$this->connection->lastInsertId());
            return $reservation;
        } catch (PDOException $e) {
            error_log("YummyRepository::addReservation error: " . $e->getMessage());
            return null;
        }
    }

    public function deleteReservationById(int $id): bool
    {
        $stmt = $this->connection->prepare("DELETE FROM reservation WHERE id = :id");
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }
}