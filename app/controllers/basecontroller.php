<?php

class BaseController
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Access Control
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

    protected function requireAdmin(): void
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
            echo "<script>alert('Access denied. Admins only.'); window.location.href = '/';</script>";
            exit;
        }
    }

    // Messaging
    protected function showAlert(bool $condition, string $successMsg, string $failMsg): void
    {
        $msg = $condition ? $successMsg : $failMsg;
        echo "<script>alert('$msg');</script>";
    }

    // Input
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

    // Uploads
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

    // Cart
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

    // Generic Date Filter
    protected function filterByDate(array $dates, callable $dateCallback, callable $defaultCallback)
    {
        foreach ($dates as $key => $date) {
            if (isset($_POST[$key])) {
                return $dateCallback($date);
            }
        }
        return $defaultCallback();
    }

    // VENUE-Specific Helpers
    protected function buildVenueFromPost(array $post, bool $isUpdate = false): Venue
    {
        $venue = new Venue();
        $venue->setName($this->getPost($isUpdate ? "changedName" : "name"));
        $venue->setDescription($this->getPost($isUpdate ? "changedDescription" : "description"));
        $venue->setType($this->getPost($isUpdate ? "changedType" : "type"));
        return $venue;
    }

    protected function handleVenueImages(Venue $venue, $service, ?Venue $existingVenue = null): void
    {
        $image = $this->handleImageUpload(
            $existingVenue ? 'changedImage' : 'image1',
            $service,
            $existingVenue?->getImage()
        );
        if ($image) $venue->setImage($image);

        $header = $this->handleImageUpload(
            $existingVenue ? 'changedHeaderImage' : 'headerImg',
            $service,
            $existingVenue?->getHeaderImg()
        );
        if ($header) $venue->setHeaderImg($header);
    }

    protected function getFilteredVenues($service): array
    {
        if (isset($_POST["dance"])) {
            return $service->getAllDanceVenues();
        } elseif (isset($_POST["jazz"])) {
            return $service->getAllJazzVenues();
        }
        return $service->getAll();
    }

    // HISTORY EVENT-Specific Helper
    protected function buildHistoryEventFromPost(array $post, bool $isUpdate = false): HistoryEvent
    {
        $event = new HistoryEvent();
        $event->setTicketsAvailable($this->getPost("tickets_available", "changedTickets_available"));
        $event->setPrice($this->getPost("price", "changedPrice"));
        $event->setDateTime($this->getPost("datetime", "changedDatetime"));
        $event->setLocation($this->getPost("location", "changedLocation"));
        $event->setTourguideID($this->getPost("tourguideID", "changedTourguideID"));
        return $event;
    }
}
