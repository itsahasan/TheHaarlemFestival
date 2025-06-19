<?php
// public/index.php
// public/index.php
declare(strict_types=1);
ini_set('display_errors', 1);
error_reporting(E_ALL);


error_reporting(E_ALL & ~E_DEPRECATED);


// ДОБАВЬ ЭТИ НАСТРОЙКИ ПЕРЕД session_start()
// Это должно исправить потерю сессии после редиректа с внешних сайтов
session_set_cookie_params([
    'lifetime' => 86400, // 1 день
    'path' => '/',
    'samesite' => 'None', // Самый важный параметр
    'secure' => true,     // Обязательно для SameSite=None
    'httponly' => true,
]);

// ЗАПУСКАЕМ СЕССИЮ ОДИН РАЗ ЗДЕСЬ И БОЛЬШЕ НИГДЕ
session_start();

// Подключаем роутер
require_once __DIR__ . '/../routers/patternrouter.php';

$router = new PatternRouter();
$router->route(trim($_SERVER['REQUEST_URI'], '/'));