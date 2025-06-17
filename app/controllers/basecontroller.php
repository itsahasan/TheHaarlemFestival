<?php
// controllers/BaseController.php

class BaseController
{
    /**
     * Start session and initialize cart counter.
     */
    public function __construct()
    {

        // Ensure we have a consistent user‐ID key and cart counter
        if (!isset($_SESSION['userId'])) {
            $_SESSION['userId'] = $_SESSION['userid'] ?? null;  // migrate old key if necessary
        }
        if (!isset($_SESSION['cartCount'])) {
            $_SESSION['cartCount'] = $_SESSION['cartcount'] ?? 0; // migrate old key if necessary
        }
    }

    /**
     * Redirect to login if user not authenticated.
     */
    protected function requireLogin(): void
    {
        if (empty($_SESSION['userId'])) {
            header('Location: /login/index');
            exit;
        }
    }

    /**
     * Escape a string for safe output.
     */
    protected function sanitize(string $data): string
    {
        return htmlspecialchars(trim($data), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Retrieve a POST parameter (with optional alternate key).
     */
    protected function getPost(string $key, ?string $altKey = null): string
    {
        if (isset($_POST[$key])) {
            return $this->sanitize((string)$_POST[$key]);
        }
        if ($altKey !== null && isset($_POST[$altKey])) {
            return $this->sanitize((string)$_POST[$altKey]);
        }
        return '';
    }

    /**
     * Parse URL query string into array.
     */
    protected function getUrlParams(): array
    {
        parse_str($_SERVER['QUERY_STRING'] ?? '', $params);
        return $params;
    }

    /**
     * Show a JS alert.
     */
    protected function showAlert(string $message): void
    {
        echo "<script>alert('" . addslashes($message) . "');</script>";
    }

    /**
     * Handle “Add to cart” form submission.
     *
     * @param ShoppingCartService $cartService
     */
    protected function handleAddToCart($cartService): void
    {
        // The form must use <button name="add_to_cart" ...>
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
            $this->requireLogin();

            $userId    = (int)($_SESSION['userId'] ?? 0);
            $productId = (int)$this->getPost('product_id');
            if ($userId <= 0 || $productId <= 0) {
                return;
            }

            // If already in cart, show error
            if ($cartService->checkIfProductExistsInCart($userId, $productId)) {
                $this->showAlert('This product is already in your cart.');
            } else {
                // Add new item
                require_once __DIR__ . '/../models/ShoppingCartItem.php';
                $item = new ShoppingCartItem();
                $item->setUser_id($userId)
                    ->setProduct_id($productId)
                    ->setQty(1);
                $cartService->addProductToCart($item);

                // Increment our unified counter
                $_SESSION['cartCount']++;
            }

            // Redirect back to avoid resubmission
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }
    }
}
