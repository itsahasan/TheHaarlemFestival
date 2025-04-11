<?php

require_once 'BaseController.php';
require __DIR__ . '/../services/artistservice.php';
require __DIR__ . '/../services/albumservice.php';
require __DIR__ . '/../services/eventservice.php';
require __DIR__ . '/../services/shoppingcartservice.php';
include_once __DIR__ . '/../views/getURL.php';

class ArtistController extends BaseController
{
    private $artistService;
    private $albumService;
    private $eventService;
    private $cartService;

    function __construct()
    {
        parent::__construct();
        $this->artistService = new ArtistService();
        $this->albumService = new AlbumService();
        $this->eventService = new EventService();
        $this->cartService = new ShoppingCartService();
    }

    public function danceartists()
    {
        $model = $this->artistService->getAllDanceArtists();
        require __DIR__ . '/../views/dance/artistsoverview.php';
    }

    public function jazzartists()
    {
        $model = $this->artistService->getAllJazzArtists();
        require __DIR__ . '/../views/jazz/artistsoverview.php';
    }

    public function danceartistdetails()
    {
        $this->handleAddToCart($this->cartService);
        $params = $this->getUrlParams();
        $this->loadArtistDetails($params['id'], 'dance');
    }

    public function jazzartistdetails()
    {
        $this->handleAddToCart($this->cartService);
        $params = $this->getUrlParams();
        $this->loadArtistDetails($params['id'], 'jazz');
    }

    private function loadArtistDetails($id, $genre)
    {
        $model = $this->artistService->getOne($id);
        $albums = $this->albumService->getAllAlbumsByArtist($id);
        $events = $this->eventService->getEventsByArtistName('%' . $model->getName() . '%');
        require __DIR__ . "/../views/{$genre}/artistdetails.php";
    }

    public function artistcms()
    {
        if (isset($_POST["delete"])) $this->deleteArtist();
        if (isset($_POST["add"]))    $this->addArtist();
        if (isset($_POST["update"])) $this->updateArtist();

        $updateArtist = null;
        if (isset($_GET['updateID'])) {
            $id = $this->sanitize($_GET['updateID']);
            $updateArtist = $this->artistService->getAnArtist($id);
        }

        $model = $this->getFilteredArtists();
        require __DIR__ . '/../views/cms/music/artist-cms.php';
    }

    private function getFilteredArtists()
    {
        if (isset($_POST["dance"])) {
            return $this->artistService->getAllDanceArtists();
        } elseif (isset($_POST["jazz"])) {
            return $this->artistService->getAllJazzArtists();
        }
        return $this->artistService->getAll();
    }

    public function addArtist()
    {
        $artist = $this->buildArtistFromPost($_POST);
        $this->handleArtistImages($artist);

        $savedArtist = $this->artistService->addArtist($artist);
        $success = $savedArtist instanceof Artist;

        $this->showAlert($success, 'Artist added successfully.', 'Failed to add artist.');
    }

    public function updateArtist()
    {
        $id = $this->sanitize($_GET["updateID"]);

        // Get existing artist (for preserving image IDs)
        $existing = $this->artistService->getAnArtist($id);

        // Build artist and preserve old images
        $artist = $this->buildArtistFromPost($_POST, $existing);

        // Update images if new files are uploaded
        $this->handleArtistImages($artist, $existing);

        $success = $this->artistService->updateArtist($artist, $id) ? true : false;
        $this->showAlert($success, 'Artist updated successfully.', 'Failed to update artist.');
    }

    public function deleteArtist()
    {
        $id = $this->sanitize($_GET["deleteID"]);
        $success = $this->artistService->deleteArtist($id) ?? false;
        $this->showAlert($success, 'Artist deleted successfully.', 'Failed to delete artist.');
    }

    private function buildArtistFromPost($post, $existing = null)
    {
        $artist = new Artist();
        $artist->setName($this->getPost("name", "changedName"));
        $artist->setDescription($this->getPost("description", "changedDescription"));
        $artist->setType($this->getPost("type", "changedType"));
        $artist->setSpotify($this->getPost("spotify", "changedSpotify"));

        if ($existing) {
            $artist->setHeaderImg($existing->getHeaderImg());
            $artist->setThumbnailImg($existing->getThumbnailImg());
            $artist->setLogo($existing->getLogo());
            $artist->setImage($existing->getImage());
        }

        return $artist;
    }

    private function handleArtistImages($artist, $existing = null)
    {
        $fields = [
            'headerImg' => 'setHeaderImg',
            'thumbnailImg' => 'setThumbnailImg',
            'logo' => 'setLogo',
            'image' => 'setImage',
        ];

        foreach ($fields as $field => $setter) {
            $changedField = isset($_FILES["changed{$field}"]) ? "changed{$field}" : $field;
            $existingValue = $existing ? $existing->{"get" . ucfirst($field)}() : null;

            $imagePath = $this->handleImageUpload($changedField, $this->artistService, $existingValue);
            if ($imagePath) {
                $artist->$setter($imagePath);
            }
        }
    }
}
