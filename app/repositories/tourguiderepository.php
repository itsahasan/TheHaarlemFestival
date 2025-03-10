<?php
require __DIR__ . '/../models/tourguide.php';

class TourGuideRepository
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
            $stmt = $this->connection->prepare("SELECT tourguide.id, tourguide.name, tourguide.description, images.image 
                                                        FROM tourguide
                                                        JOIN images ON tourguide.image=images.id");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'TourGuide');
            $tourguides = $stmt->fetchAll();

            return $tourguides;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT tourguide.id, tourguide.name, tourguide.description, images.image
                                                      FROM tourguide
                                                      JOIN images ON tourguide.image=images.id
                                                      WHERE tourguide.id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'TourGuide');
            $tourguidescms = $stmt->fetch();

            return $tourguidescms;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOneTourguideByName($name)
    {
        try {
            $stmt = $this->connection->prepare("SELECT tourguide.id, tourguide.name, tourguide.description, images.image
                                                      FROM tourguide
                                                      JOIN images ON tourguide.image=images.id
                                                      WHERE tourguide.name = :name");
            $stmt->bindParam(':name', $name);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'TourGuide');
            $tourguidescms = $stmt->fetch();

            return $tourguidescms;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    //Adding Tour Guides by using the CMS
    function addTourguide(TourGuide $tourguides)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO tourguide (name, description, image) VALUES (:name, :description, :image)");

            $stmt->bindValue(':name', $tourguides->getName());
            $stmt->bindValue(':description', $tourguides->getDescription());
            $stmt->bindValue(':image', $tourguides->getImage());

            $stmt->execute();

            $tourguides->setId($this->connection->lastInsertId());

            return $this->getOne($tourguides->getId());
        } catch (PDOException $e) {
            echo $e;
        }
    }

    //Updating the Tour Guides by using the CMS
    function updateTourguide($tourguides, $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE tourguide SET name = ?, description = ?, image = ? WHERE id = ?");
            $stmt->execute([$tourguides->getName(), $tourguides->getDescription(), $tourguides->getImage(), $id]);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    //Deleting the Tour Guides by using CMS
    function deleteTourguide($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE t, img 
                                                FROM tourguide AS t, images AS img 
                                                WHERE t.id=:id AND img.id=t.image");
            
            $stmt->bindParam(':id', $id);
            $stmt->execute();
        } catch (PDOException $e) {
            echo $e;
        }
        return true;
    }

    function saveImage(string $imgInfo)
    {
        try {
            $stmt = $this->connection->prepare('INSERT INTO images (image) VALUES (:image)');

            $stmt->bindParam(':image', $imgInfo);
            $stmt->execute();

            return $this->connection->lastInsertId();
        } catch (Exception $e) {
            echo $e;
        }
    }

    function updateImage($imgInfo, $id)
    {
        try {
            $stmt = $this->connection->prepare('UPDATE images SET image = :image WHERE id = :id');
            $stmt->bindValue(':image', $imgInfo);
            $stmt->bindValue(':id', $id);
            $stmt->execute();

            return $id;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getATourguide($id)
    {
        try {
            $stmt = $this->connection->prepare('SELECT * FROM tourguide WHERE id = :id');
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'TourGuide');
            $tourguidescms = $stmt->fetch();

            return $tourguidescms;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
