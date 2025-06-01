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
            echo "<script> sessionStorage.setItem('error', 'You have to be logged in to perform this action'); window.location.href = '/login/index' </script>";
            exit;
        }
    }

    protected function requireAdmin(): void
    {
        if (!isset($_SESSION['role']) || $_SESSION['role'] != 1) {
            echo "<script>sessionStorage.setItem('error', 'Access denied. Admins only.'); window.location.href = '/'; </script>";
            exit;
        }
    }

    // Messaging
    protected function showAlert(bool $condition, string $successMsg, string $failMsg , string $redirectUrl =  ''): void
    {
        $msg = $condition ? $successMsg : $failMsg;

        $alertType = $condition ? 'success' : 'error';

        echo "<script>sessionStorage.setItem('$alertType', '$msg'); window.location = '$redirectUrl';</script>";
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

            $uploadDir = __DIR__ . '/../public/uploads/';


            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }

            $extension = pathinfo($_FILES[$field]['name'], PATHINFO_EXTENSION);
            $uniqueFilename = uniqid("img_") . '.' . $extension;
            $destination = $uploadDir . $uniqueFilename;

            
            $publicUrl =  $uniqueFilename;
            if (move_uploaded_file($_FILES[$field]['tmp_name'],  $destination)) {

                return $existingImage
                ? $service->updateImage($publicUrl, $existingImage)
                : $service->saveImage($publicUrl);


            }

        }
        
        return null;
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
            'image1',
            $service,
            $existingVenue?->getImage()
        );



        if ($image) $venue->setImage($image);

        $header = $this->handleImageUpload(
            'headerImg',
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
