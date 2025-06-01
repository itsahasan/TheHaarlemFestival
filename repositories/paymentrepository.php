<?php
require __DIR__ . '/../repositories/repository.php';
require __DIR__ . '/../models/reservation.php';
require __DIR__ . '/../models/api_key.php';

class PaymentRepository extends Repository
{
    public function getKey(string $key)
    {
        try {
            $stmt = $this->connection->prepare("SELECT id, api_key FROM `Api_keys` WHERE api_key = :api_key ");
            $stmt->bindParam(':api_key', $key);
            $stmt->execute();

            $stmt->setFetchMode(PDO::FETCH_CLASS, 'api_key');
            $keys = $stmt->fetchAll();

            if (is_null($keys) || empty($keys))
                return null;

            return $keys[0];
        } catch (PDOException $e) {
            echo $e;
        }
    }
}
