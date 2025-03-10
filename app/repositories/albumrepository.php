<?php
require __DIR__ . '/../models/album.php';

class AlbumRepository
{
    protected $connection;

    function __construct()
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

    function getAllAlbumsByArtist($artistID)
    {
        try {
            $stmt = $this->connection->prepare("SELECT albums.id, images.image, albums.name, albums.link, albums.artistId 
            FROM albums
            JOIN images ON albums.image=images.id
            WHERE albums.artistId= :id");
            $stmt->bindParam(':id', $artistID);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Album');
            $albums = $stmt->fetchAll();

            return $albums;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
