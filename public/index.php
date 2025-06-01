<?php
// session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require __DIR__ . '/../routers/patternrouter.php';
if (isset($_SESSION['loggedin'])) {
    header('Location: /login/index');
}
$uri = trim($_SERVER['REQUEST_URI'], '/');

$router = new PatternRouter();
$router->route($uri);
