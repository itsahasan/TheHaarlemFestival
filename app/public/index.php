<?php
//session_start();
require __DIR__ . '/../routers/patternrouter.php';
if (isset($_SESSION['loggedin'])) {
    header('Location: /login/index');
}
$uri = trim($_SERVER['REQUEST_URI'], '/');

$router = new PatternRouter();
$router->route($uri);
