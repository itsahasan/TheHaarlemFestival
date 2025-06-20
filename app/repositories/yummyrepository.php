<?php
require_once __DIR__ . '/../models/Restaurant.php';
require_once __DIR__ . '/../models/Session.php';
require_once __DIR__ . '/../models/Reservation.php';

class YummyRepository
{
    private \PDO $connection;

    public function __construct()
    {
        $configPath = __DIR__ . '/../config/dbconfig.php';
        if (!file_exists($configPath)) { throw new \RuntimeException("Missing config file"); }
        require $configPath;
        $dsn = sprintf('%s:host=%s;dbname=%s;charset=utf8mb4', $type, $servername, $database);
        try {
            $this->connection = new \PDO($dsn, $username, $password, [\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION]);
        } catch (\PDOException $e) {
            error_log("DB connection failed: " . $e->getMessage());
            throw $e;
        }
    }

    public function getAllRestaurants()
    {
        $stmt = $this->connection->query("SELECT r.*, img1.image AS image1_data, img2.image AS image2_data, img3.image AS image3_data FROM restaurant AS r LEFT JOIN images AS img1 ON r.image1 = img1.id LEFT JOIN images AS img2 ON r.image2 = img2.id LEFT JOIN images AS img3 ON r.image3 = img3.id ORDER BY r.name");
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function getRestaurantById(int $id, bool $asArray = true)
    {
        $stmt = $this->connection->prepare("SELECT r.*, img1.image AS image1_data, img2.image AS image2_data, img3.image AS image3_data FROM restaurant AS r LEFT JOIN images AS img1 ON r.image1 = img1.id LEFT JOIN images AS img2 ON r.image2 = img2.id LEFT JOIN images AS img3 ON r.image3 = img3.id WHERE r.id = :id");
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        if ($asArray) {
            return $stmt->fetch(\PDO::FETCH_ASSOC) ?: null;
        }
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Restaurant::class);
        return $stmt->fetch() ?: null;
    }

    public function createRestaurant(Restaurant $restaurant): bool
    {
        $stmt = $this->connection->prepare("INSERT INTO restaurant (name, location, description, cuisine, seats, stars, email, phonenumber, price, image1, image2, image3) VALUES (:name, :location, :description, :cuisine, :seats, :stars, :email, :phonenumber, :price, :image1, :image2, :image3)");
        return $this->bindRestaurantValues($stmt, $restaurant)->execute();
    }

    public function updateRestaurant(Restaurant $restaurant): bool
    {
        $stmt = $this->connection->prepare("UPDATE restaurant SET name = :name, location = :location, description = :description, cuisine = :cuisine, seats = :seats, stars = :stars, email = :email, phonenumber = :phonenumber, price = :price, image1 = :image1, image2 = :image2, image3 = :image3 WHERE id = :id");
        $stmt->bindValue(':id', $restaurant->getId(), \PDO::PARAM_INT);
        return $this->bindRestaurantValues($stmt, $restaurant)->execute();
    }

    private function bindRestaurantValues(\PDOStatement $stmt, Restaurant $restaurant): \PDOStatement
    {
        $stmt->bindValue(':name', $restaurant->getName());
        $stmt->bindValue(':location', $restaurant->getLocation());
        $stmt->bindValue(':description', $restaurant->getDescription());
        $stmt->bindValue(':cuisine', $restaurant->getCuisine());
        $stmt->bindValue(':seats', $restaurant->getSeats(), \PDO::PARAM_INT);
        $stmt->bindValue(':stars', $restaurant->getStars(), \PDO::PARAM_INT);
        $stmt->bindValue(':email', $restaurant->getEmail());
        $stmt->bindValue(':phonenumber', $restaurant->getPhonenumber());
        $stmt->bindValue(':price', $restaurant->getPrice());
        $stmt->bindValue(':image1', $restaurant->getImage1(), \PDO::PARAM_INT);
        $stmt->bindValue(':image2', $restaurant->getImage2(), \PDO::PARAM_INT);
        $stmt->bindValue(':image3', $restaurant->getImage3(), \PDO::PARAM_INT);
        return $stmt;
    }

    public function deleteRestaurant(int $id): bool
    {
        $stmt = $this->connection->prepare("DELETE FROM restaurant WHERE id = :id");
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function saveImage(string $imageData): int
    {
        $stmt = $this->connection->prepare('INSERT INTO images (image) VALUES (:image)');
        $stmt->bindParam(':image', $imageData, \PDO::PARAM_LOB);
        $stmt->execute();
        return (int)$this->connection->lastInsertId();
    }

    public function updateImage(string $imageData, int $imageId): bool
    {
        $stmt = $this->connection->prepare('UPDATE images SET image = :image WHERE id = :id');
        $stmt->bindParam(':image', $imageData, \PDO::PARAM_LOB);
        $stmt->bindValue(':id', $imageId, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getAllSessions(): array
    {
        $stmt = $this->connection->query("SELECT s.*, r.name as restaurantName FROM food_session s JOIN restaurant r ON s.restaurantid = r.id ORDER BY s.id");
        return $stmt->fetchAll(PDO::FETCH_CLASS, Session::class);
    }

    public function getSessionById(int $id): ?Session
    {
        $stmt = $this->connection->prepare("SELECT * FROM food_session WHERE id = :id");
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Session::class);
        return $stmt->fetch() ?: null;
    }

    public function saveSession(Session $session): bool
    {
        if ($session->getId() > 0) {
            $stmt = $this->connection->prepare("UPDATE food_session SET restaurantid = :restaurantid, price = :price, reducedprice = :reducedprice, starttime = :starttime, session_length = :session_length, available_seats = :available_seats WHERE id = :id");
            $stmt->bindValue(':id', $session->getId());
        } else {
            $stmt = $this->connection->prepare("INSERT INTO food_session (restaurantid, price, reducedprice, starttime, session_length, available_seats) VALUES (:restaurantid, :price, :reducedprice, :starttime, :session_length, :available_seats)");
        }
        $stmt->bindValue(':restaurantid', $session->getRestaurantid());
        $stmt->bindValue(':price', $session->getPrice());
        $stmt->bindValue(':reducedprice', $session->getReducedprice());
        $stmt->bindValue(':starttime', $session->getStarttime());
        $stmt->bindValue(':session_length', $session->getSession_length());
        $stmt->bindValue(':available_seats', $session->getAvailable_seats());
        return $stmt->execute();
    }

    public function deleteSession(int $id): bool
    {
        $stmt = $this->connection->prepare("DELETE FROM food_session WHERE id = :id");
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getSessionsForRestaurant(int $restaurantId): array
    {
        $stmt = $this->connection->prepare("SELECT * FROM food_session WHERE restaurantid = :restaurantid ORDER BY starttime");
        $stmt->bindValue(':restaurantid', $restaurantId, \PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_CLASS, Session::class);
    }


    public function checkSeatsAvailable(int $sessionId, int $seats): bool
    {
        $session = $this->getSessionById($sessionId);
        if ($session) {
            return $session->getAvailable_seats() >= $seats;
        }
        return false;
    }

    public function addReservation(Reservation $reservation): ?Reservation
    {
        $stmt = $this->connection->prepare(
            "INSERT INTO reservation (name, restaurantID, sessionID, seats, date, request, price, status) 
             VALUES (:name, :restaurantID, :sessionID, :seats, :date, :request, :price, :status)"
        );
        $stmt->bindValue(':name', $reservation->getName());
        $stmt->bindValue(':restaurantID', $reservation->getRestaurantID(), \PDO::PARAM_INT);
        $stmt->bindValue(':sessionID', $reservation->getSessionID(), \PDO::PARAM_INT);
        $stmt->bindValue(':seats', $reservation->getSeats(), \PDO::PARAM_INT);
        $stmt->bindValue(':date', $reservation->getDate());
        $stmt->bindValue(':request', $reservation->getRequest());
        $stmt->bindValue(':price', $reservation->getPrice());
        $stmt->bindValue(':status', $reservation->getStatus(), \PDO::PARAM_BOOL);
        if ($stmt->execute()) {
            $reservation->setId((int)$this->connection->lastInsertId());
            return $reservation;
        }
        return null;
    }

    public function decreaseSessionSeats(int $sessionId, int $seats): bool
    {
        $stmt = $this->connection->prepare("UPDATE food_session SET available_seats = available_seats - :seats WHERE id = :sessionId");
        $stmt->bindValue(':seats', $seats, \PDO::PARAM_INT);
        $stmt->bindValue(':sessionId', $sessionId, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    public function getAllReservations(): array
    {
        $stmt = $this->connection->query("
      SELECT r.*, rs.name AS restaurantName, s.starttime AS sessionTime
        FROM reservation r
        JOIN restaurant rs ON r.restaurantID = rs.id
        JOIN food_session s ON r.sessionID = s.id
        ORDER BY r.id
    ");
        return $stmt->fetchAll(PDO::FETCH_CLASS, Reservation::class);
    }

    public function getReservationById(int $id): ?Reservation
    {
        $stmt = $this->connection->prepare("SELECT * FROM reservation WHERE id = :id");
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
        $stmt->setFetchMode(\PDO::FETCH_CLASS, Reservation::class);
        return $stmt->fetch() ?: null;
    }


    public function updateReservation(Reservation $reservation): bool
    {
        $stmt = $this->connection->prepare("
        UPDATE reservation
           SET name         = :name,
               restaurantID = :restaurantID,
               sessionID    = :sessionID,
               seats        = :seats,
               date         = :date,
               request      = :request,
               price        = :price,
               status       = :status
         WHERE id = :id
    ");
        $stmt->bindValue(':id',             $reservation->getId(),           PDO::PARAM_INT);
        $stmt->bindValue(':name',           $reservation->getName());
        $stmt->bindValue(':restaurantID',   $reservation->getRestaurantID(), PDO::PARAM_INT);
        $stmt->bindValue(':sessionID',      $reservation->getSessionID(),    PDO::PARAM_INT);
        $stmt->bindValue(':seats',          $reservation->getSeats(),        PDO::PARAM_INT);
        $stmt->bindValue(':date',           $reservation->getDate());
        $stmt->bindValue(':request',        $reservation->getRequest());
        $stmt->bindValue(':price',          $reservation->getPrice());
        $stmt->bindValue(':status',         $reservation->getStatus(),       PDO::PARAM_BOOL);
        return $stmt->execute();
    }


    public function deleteReservationById(int $id): bool
    {
        $stmt = $this->connection->prepare("DELETE FROM reservation WHERE id = :id");
        $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }




}