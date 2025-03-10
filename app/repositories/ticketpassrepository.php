<?php
require __DIR__ . '/../models/ticketpass.php';

class TicketPassRepository
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

    function getDancePasses()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM `ticketpass` WHERE type = 'dance'");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'TicketPass');
            $ticketpasses = $stmt->fetchAll();

            return $ticketpasses;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function getJazzPasses()
    {
        try {
            $stmt = $this->connection->prepare("SELECT * FROM `ticketpass` WHERE type = 'jazz'");
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'TicketPass');
            $ticketpasses = $stmt->fetchAll();

            return $ticketpasses;
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
