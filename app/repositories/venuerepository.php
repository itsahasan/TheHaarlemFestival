<?php
require __DIR__ . '/../models/venue.php';

class VenueRepository
{
    protected $connection;

    public function __construct()
    {
        require __DIR__ . '/../config/dbconfig.php';

        try {
            $this->connection = new PDO("$type:host=$servername;dbname=$database", $username, $password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }

    function getAll()
    {
        try {
            $stmt = $this->connection->prepare("SELECT venue.id, venue.name, venue.description, venue.type, img1.image AS image, img2.image AS headerImg  
            FROM venue 
            JOIN images as img1 ON venue.image=img1.id
            JOIN images as img2 ON venue.headerImg=img2.id");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Venue');
            $venues = $stmt->fetchAll();

            return $venues;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getAllDanceVenues()
    {
        try {
            $stmt = $this->connection->prepare("SELECT venue.id, venue.name, venue.description, venue.type, img1.image AS image, img2.image AS headerImg  
            FROM venue 
            JOIN images as img1 ON venue.image=img1.id
            JOIN images as img2 ON venue.headerImg=img2.id
            WHERE venue.type='dance'");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Venue');
            $venues = $stmt->fetchAll();

            return $venues;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getAllJazzVenues()
    {
        try {
            $stmt = $this->connection->prepare("SELECT venue.id, venue.name, venue.description, venue.type, img1.image AS image, img2.image AS headerImg  
            FROM venue 
            JOIN images as img1 ON venue.image=img1.id
            JOIN images as img2 ON venue.headerImg=img2.id
            WHERE venue.type='jazz'");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Venue');
            $venues = $stmt->fetchAll();

            return $venues;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT venue.id, venue.name, venue.description, venue.type, img1.image AS image, img2.image AS headerImg  
            FROM venue 
            JOIN images as img1 ON venue.image=img1.id
            JOIN images as img2 ON venue.headerImg=img2.id 
            WHERE venue.id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Venue');
            $venue = $stmt->fetch();

            return $venue;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function addVenue(Venue $venue)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO venue (name, description, type, image, headerImg) VALUES (:name, :description, :type, :image, :headerImg)");

            $stmt->bindValue(':name', $venue->getName());
            $stmt->bindValue(':description', $venue->getDescription());
            $stmt->bindValue(':type', $venue->getType());
            $stmt->bindValue(':image', $venue->getImage());
            $stmt->bindValue(':headerImg', $venue->getHeaderImg());

            $stmt->execute();

            $venue->setId($this->connection->lastInsertId());

            return $this->getOne($venue->getId());
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function updateVenue($venue, $id)
{
    try {
        $stmt = $this->connection->prepare("UPDATE venue SET name = ?, description = ?, type = ?, image = ?, headerImg = ? WHERE id = ?");
        $stmt->execute([
            $venue->getName(),
            $venue->getDescription(),
            $venue->getType(),
            $venue->getImage(),
            $venue->getHeaderImg(),
            $id
        ]);

        return $stmt->rowCount() > 0; 
    } catch (PDOException $e) {
        echo $e;
        return false; 
    }
}


function deleteVenue($id)
{
    try {
        $stmt = $this->connection->prepare("DELETE v, i, i2
            FROM venue AS v
            JOIN images AS i ON i.id = v.image
            JOIN images AS i2 ON i2.id = v.headerImg
            WHERE v.id = :id");

        $stmt->bindValue(':id', $id);
        return $stmt->execute(); // ✅ returns true/false
    } catch (PDOException $e) {
        error_log("❌ Venue delete failed: " . $e->getMessage());
        return false;
    }
}


    function saveImage(string $imgData)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO images (image) VALUES (:image)');

            $stmt->bindParam(':image', $imgData);
            $stmt->execute();

            return $this->connection->lastInsertId();
        } catch (Exception $e) {
            echo $e;
        }
    }

    function updateImage($imgData, $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE images SET image = :image WHERE id = :id");
            $stmt->bindValue(':image', $imgData);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $id;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getAVenue($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM venue WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Venue');
            $venue = $stmt->fetch();

            return $venue;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
