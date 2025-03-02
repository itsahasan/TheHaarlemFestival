<?php
require __DIR__ . '/../models/reservation.php';
require __DIR__ . '/repository.php';
require __DIR__ . '/../models/api_key.php';

class KeysRepository extends Repository
{

    public function getAllKeys() {
        $stmt = $this->connection->prepare("SELECT id, api_key FROM `Api_keys` ");
        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_CLASS, 'api_key');
        $keys = $stmt->fetchAll();
        return $keys;
    }
    public function addKey($api_key)
    {
        $stmt = $this->connection->prepare("INSERT INTO `Api_keys` (api_key) VALUES (:api_key) ");
        $stmt->bindValue(':api_key', $api_key);

        $stmt->execute();
    }
    public function deactivateKey($keyid) {
        $stmt = $this->connection->prepare("DELETE FROM `Api_keys` WHERE id = :id");
        $stmt->bindParam(':id', $keyid);
        $stmt->execute();
    }
    
}
