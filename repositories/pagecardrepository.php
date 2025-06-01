<?php
require __DIR__ . '/../models/pagecard.php';

class PageCardRepository
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

    function getAllCardsByPageId($id)
    {
        try {
            $stmt = $this->connection->prepare("SELECT pagecard.id, pagecard.title, pagecard.opening_time, pagecard.closing_time, pagecard.location, pagecard.location, pagecard.rating, pagecard.adult_price, pagecard.kids_price, images.image as image, pagecard.link, pagecard.description, pagecard.pageId 
            FROM pagecard
            JOIN images ON pagecard.image=images.id
            WHERE pagecard.pageId=:id");
            $stmt->bindParam(':id', $id);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'PageCard');
            $pageCards = $stmt->fetchAll();

            return $pageCards;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
