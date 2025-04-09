<?php

// BaseController.php
class BaseController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    protected function requireLogin(): void
    {
        if (!isset($_SESSION['userId'])) {
            echo "<script>
                    alert('You have to be logged in to perform this action.');
                    window.location.href = '/login/index';
                  </script>";
            exit;
        }
    }

    protected function showAlert(bool $condition, string $successMsg, string $failMsg): void
    {
        $msg = $condition ? $successMsg : $failMsg;
        echo "<script>alert('$msg');</script>";
    }

    protected function sanitize(string $data): string
    {
        return htmlspecialchars(trim($data));
    }

    protected function getPost(string $key, ?string $altKey = null): string
    {
        return $this->sanitize($_POST[$key] ?? ($_POST[$altKey] ?? ""));
    }

    protected function getUrlParams(): array
    {
        $url = getURL();
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);
        return $params;
    }

    protected function handleImageUpload(string $field, $service, ?string $existingImage = null): ?string
    {
        if (isset($_FILES[$field]) && is_uploaded_file($_FILES[$field]['tmp_name'])) {
            $image = file_get_contents($_FILES[$field]['tmp_name']);
            return $existingImage
                ? $service->updateImage($image, $existingImage)
                : $service->saveImage($image);
        }

        return null;
    }

    protected function handleAddToCart($cartService): void
    {
        if (isset($_POST['add-to-cart'])) {
            $this->requireLogin();
            $user_id = $_SESSION['userId'];
            $product_id = $this->getPost("product_id");
            $qty = 1;

            if ($cartService->checkIfProductExistsInCart($user_id, $product_id)) {
                $this->showAlert(false, '', 'This product is already in your shopping cart.');
            } else {
                $cartItem = new ShoppingCartItem();
                $cartItem->setUser_id($user_id);
                $cartItem->setProduct_id($product_id);
                $cartItem->setQty($qty);
                $cartService->addProductToCart($cartItem);
                $_SESSION['cartcount']++;
            }
        }
    }

    protected function filterEventsByDateMap(array $map, callable $getEventsByDate, callable $getAllCallback): mixed
    {
        foreach ($map as $key => $date) {
            if (isset($_POST[$key])) {
                return $getEventsByDate("%$date%");
            }
        }
        return $getAllCallback();
    }
}
