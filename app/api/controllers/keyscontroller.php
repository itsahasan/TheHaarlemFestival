<?php
require __DIR__ . '/../../services/KeysService.php';

class KeysController
{
    private $keysService;

    function __construct()
    {
        $this->keysService = new KeysService();
        session_start();
    }

    public function index()
    { 
        $keys = $this->keysService->getAllKeys();

        require __DIR__ . '/../../views/api/manageapikeys.php';
    }

    public function createKey()
    {
        $key = $this->getGUID();
        $this->keysService->addKey($key);

        header('location: /api/keys');
    }

    function getGUID()
    {
        if (function_exists('com_create_guid')) {
            return trim(com_create_guid(), '{}');
        } else {
            mt_srand((float)microtime() * 10000); //optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45); // "-"
            $uuid = substr($charid, 0, 8) . $hyphen
                . substr($charid, 8, 4) . $hyphen
                . substr($charid, 12, 4) . $hyphen
                . substr($charid, 16, 4) . $hyphen
                . substr($charid, 20, 12);
            return $uuid;
        }
    }

    public function deactivateKey() {
        $keyid = htmlspecialchars($_GET['keyid']);
        $this->keysService->deactivateKey($keyid);

        header('location: /api/keys');
    }
}
