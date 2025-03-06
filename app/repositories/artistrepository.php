<?php
require __DIR__ . '/../models/artist.php';

class ArtistRepository
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
            $stmt = $this->connection->prepare("SELECT artist.id, artist.name, artist.description, artist.type,  img1.image AS headerImg, img2.image AS thumbnailImg, img3.image AS logo, artist.spotify, img4.image AS image 
            FROM artist 
            JOIN images as img1 ON artist.headerImg=img1.id 
            JOIN images as img2 ON artist.thumbnailImg=img2.id
            JOIN images as img3 ON artist.logo=img3.id
            JOIN images as img4 ON artist.image=img4.id");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Artist');
            $artists = $stmt->fetchAll();

            return $artists;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getAllDanceArtists()
    {
        try {
            $stmt = $this->connection->prepare("SELECT artist.id, artist.name, artist.description, artist.type,  img1.image AS headerImg, img2.image AS thumbnailImg, img3.image AS logo, artist.spotify, img4.image AS image 
            FROM artist 
            JOIN images as img1 ON artist.headerImg=img1.id 
            JOIN images as img2 ON artist.thumbnailImg=img2.id
            JOIN images as img3 ON artist.logo=img3.id
            JOIN images as img4 ON artist.image=img4.id
            WHERE artist.type = 'dance'");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Artist');
            $artists = $stmt->fetchAll();

            return $artists;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getAllJazzArtists()
    {
        try {
            $stmt = $this->connection->prepare("SELECT artist.id, artist.name, artist.description, artist.type,  img1.image AS headerImg, img2.image AS thumbnailImg, img3.image AS logo, artist.spotify, img4.image AS image 
            FROM artist 
            JOIN images as img1 ON artist.headerImg=img1.id 
            JOIN images as img2 ON artist.thumbnailImg=img2.id
            JOIN images as img3 ON artist.logo=img3.id
            JOIN images as img4 ON artist.image=img4.id
            WHERE artist.type = 'jazz'");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Artist');
            $artists = $stmt->fetchAll();

            return $artists;
        } catch (PDOException $e) {
            echo $e;
        }
    }


    function getOneArtistByName($name)
    {
        try {
            $stmt = $this->connection->prepare("SELECT artist.id, artist.name, artist.description, artist.type,  img1.image AS headerImg, img2.image AS thumbnailImg, img3.image AS logo, artist.spotify, img4.image AS image 
            FROM artist 
            JOIN images as img1 ON artist.headerImg=img1.id 
            JOIN images as img2 ON artist.thumbnailImg=img2.id
            JOIN images as img3 ON artist.logo=img3.id
            JOIN images as img4 ON artist.image=img4.id
            WHERE artist.name = :name");
            $stmt->bindParam(':name', $name);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Artist');
            $artist = $stmt->fetch();

            return $artist;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getOne($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT artist.id, artist.name, artist.description, artist.type,  img1.image AS headerImg, img2.image AS thumbnailImg, img3.image AS logo, artist.spotify, img4.image AS image 
            FROM artist 
            JOIN images as img1 ON artist.headerImg=img1.id 
            JOIN images as img2 ON artist.thumbnailImg=img2.id
            JOIN images as img3 ON artist.logo=img3.id
            JOIN images as img4 ON artist.image=img4.id
            WHERE artist.id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Artist');
            $artist = $stmt->fetch();

            return $artist;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function addArtist(Artist $artist)
    {
        try {
            $stmt = $this->connection->prepare("INSERT INTO artist (name, description, type, headerImg, thumbnailImg, logo, spotify, image) VALUES (:name, :description, :type, :headerImg, :thumbnailImg, :logo, :spotify, :image)");

            $stmt->bindValue(':name', $artist->getName());
            $stmt->bindValue(':description', $artist->getDescription());
            $stmt->bindValue(':type', $artist->getType());
            $stmt->bindValue(':headerImg', $artist->getHeaderImg());
            $stmt->bindValue(':thumbnailImg', $artist->getThumbnailImg());
            $stmt->bindValue(':logo', $artist->getLogo());
            $stmt->bindValue(':spotify', $artist->getSpotify());
            $stmt->bindValue(':image', $artist->getImage());

            $stmt->execute();

            $artist->setId($this->connection->lastInsertId());

            return $this->getOne($artist->getId());
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function updateArtist($artist, $id)
    {
        try {
            $stmt = $this->connection->prepare("UPDATE artist SET name = ?, description = ?, type = ?, headerImg = ?, thumbnailImg = ?, logo = ?, spotify = ?, image = ? WHERE id = ?");
            $stmt->execute([$artist->getName(), $artist->getDescription(), $artist->getType(), $artist->getHeaderImg(), $artist->getThumbnailImg(), $artist->getLogo(), $artist->getSpotify(), $artist->getImage(), $id]);
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function deleteArtist($id)
    {
        try {
            $stmt = $this->connection->prepare("DELETE a, i, i1, i2, i3
            FROM artist as a, images as i, images as i1, images as i2, images as i3
            WHERE a.id=:id AND i.id=a.headerImg AND i1.id=a.thumbnailImg AND i2.id=a.logo AND i3.id=a.image");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            return;
        } catch (PDOException $e) {
            echo $e;
        }
        return true;
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

    function getAnArtist($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM artist WHERE id = :id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Artist');
            $artist = $stmt->fetch();

            return $artist;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
