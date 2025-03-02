<?php
require __DIR__ . '/../repositories/keysrepository.php';

class KeysService
{
    private $keysrepository;

    function __construct()
    {
        $this->keysrepository = new KeysRepository();
    }
    public function getAllKeys()
    {
        return $this->keysrepository->getAllKeys();
    }
    public function addKey($jwt)
    {
        $this->keysrepository->addKey($jwt);
    }
    public function deactivateKey($keyid) {
        $this->keysrepository->deactivateKey($keyid);
    }
}
