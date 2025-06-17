<?php
// public/index.php
declare(strict_types=1);
error_reporting(E_ALL & ~E_DEPRECATED);


// ДОБАВЬ ЭТИ НАСТРОЙКИ ПЕРЕД session_start()
// Это исправит потерю сессии после редиректа с Mollie
session_set_cookie_params([
    'lifetime' => 86400, // 1 день
    'path' => '/',
    'domain' => $_SERVER['HTTP_HOST'],
    'secure' => true, // Обязательно для SameSite=None
    'httponly' => true,
    'samesite' => 'None' // Самый важный параметр
]);

session_start();

require __DIR__ . '/../routers/patternrouter.php';

$router = new PatternRouter();
$router->route(trim($_SERVER['REQUEST_URI'], '/'));