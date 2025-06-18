<?php
// controllers/BaseController.php

require_once __DIR__ . '/../services/ShoppingCartService.php';

class BaseController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_set_cookie_params([
                'lifetime' => 86400, 'path' => '/', 'samesite' => 'None',
                'secure' => true, 'httponly' => true,
            ]);
            session_start();
        }

        if (isset($_SESSION['userId'])) {
            $cartService = new ShoppingCartService();
            // Используем единый стиль cartCount
            $_SESSION['cartCount'] = $cartService->countProducts((int)$_SESSION['userId']);
        } else {
            $_SESSION['cartCount'] = 0;
        }
    }

    protected function requireLogin(): void
    {
        if (empty($_SESSION['userId'])) {
            header('Location: /login');
            exit;
        }
    }

    protected function sanitize(string $data): string
    {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    protected function getPost(string $key): string
    {
        return isset($_POST[$key]) ? $this->sanitize((string)$_POST[$key]) : '';
    }
}