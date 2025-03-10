<?php
require __DIR__ . '/../models/ticket.php';

class TicketRepository
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

    function getTicketById($uuid)
    {
        try {
            // Convert the string to binary
            $uuid_binary = hex2bin(str_replace('0x', '', $uuid));

            $stmt = $this->connection->prepare("SELECT * FROM ticket WHERE uuid = :uuid");
            $stmt->bindParam(":uuid", $uuid_binary, PDO::PARAM_LOB);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Ticket');
            $ticket = $stmt->fetch();

            if (!$ticket) {
                echo "Ticket not found for xUUID: " . $uuid . "<br>";
            }

            return $ticket;
        } catch (PDOException $e) {
            echo "Error fetching ticket for xUUID " . $uuid . ": " . $e->getMessage();
        }
    }


    function checkIfTicketWasScanned($uuid)
    {
        try {
            $uuid_binary = hex2bin(str_replace('0x', '', $uuid));

            $stmt = $this->connection->prepare("SELECT * FROM ticket WHERE uuid=:uuid AND status='not scanned'");

            // $uuid = htmlspecialchars(strip_tags($uuid));
            // $status = htmlspecialchars(strip_tags($status));

            $stmt->bindParam(":uuid", $uuid_binary, PDO::PARAM_LOB);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'Ticket');
            $ticket = $stmt->fetch();

            return $ticket;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function updateTicketStatus($uuid)
    {
        try {
            $uuid_binary = hex2bin(str_replace('0x', '', $uuid));

            $stmt = $this->connection->prepare("UPDATE ticket SET status = 'scanned' WHERE uuid = :uuid");
            $stmt->bindParam(":uuid", $uuid_binary);
            if ($stmt->execute()) {
                return true;
            }

            return false;
        } catch (PDOException $e) {
            echo $e;
        }
    }

    function createTicket($uuid)
    {
        try {
            $uuid_binary = hex2bin(str_replace('0x', '', $uuid));

            $stmt = $this->connection->prepare("INSERT INTO ticket (uuid, status) VALUES (:uuid, 'not scanned')");
            $stmt->bindParam(":uuid", $uuid_binary);
            $stmt->execute();

            $ticket = new Ticket();
            $ticket->setUuid($uuid);

            return $ticket;
        } catch (PDOException $e) {
            echo "Error creating ticket with xUUID " . $uuid . ": " . $e->getMessage();
        }
    }

    function validateUuid($uuid)
    {
        try {
            $uuid_binary = hex2bin(str_replace('0x', '', $uuid));

            $stmt = $this->connection->prepare("SELECT COUNT(*) FROM ticket WHERE uuid = :uuid");
            $stmt->bindParam(":uuid", $uuid_binary);
            $stmt->execute();

            $count = $stmt->fetchColumn();
            if ($count > 0) {
                return false; //uuid exists
            }
            return true;
        } catch (PDOException $e) {
            echo "Error creating ticket with xUUID " . $uuid . ": " . $e->getMessage();
        }
    }
}
