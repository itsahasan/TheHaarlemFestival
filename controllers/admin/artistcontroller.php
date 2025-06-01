<?php

require_once __DIR__ . '/../basecontroller.php';
require __DIR__ . '/../../services/artistservice.php';
require __DIR__ . '/../../services/albumservice.php';
require __DIR__ . '/../../services/eventservice.php';
require __DIR__ . '/../../services/shoppingcartservice.php';
include_once __DIR__ . '/../../views/getURL.php';

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

  


    public function list()
    {

        $model = $this->getFilteredArtists();
        $type = null;
        if (isset($_POST["dance"])) $type = "dance";
        if (isset($_POST["jazz"])) $type = "jazz";
        $createUrl =   $type ?  '/admin/artist/create?type='. $type : '/admin/artist/create' ;
        require __DIR__ . '/../../views/cms/music/artist-cms.php';
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



    public function create(){
        $type = isset($_GET["type"]) ? $_GET["type"] : NULL;
        require __DIR__ . '/../../views/cms/music/artist-create.php';
    }

    public function store(){

        $artist = $this->buildArtistFromPost($_POST);
        $this->handleArtistImages($artist);
        $success = $this->artistService->addArtist($artist);
        echo "<script>sessionStorage.setItem('success', 'Artist added successfully.'); window.location = '/admin/artist/list';</script>";

    }


    public function edit(){


        $id = $_GET['updateID'];


        $updateArtist = $this->artistService->getAnArtist(    $id );
        require __DIR__ . '/../../views/cms/music/artist-edit.php';

    }


    public function update(){


        $id = $this->sanitize($_GET["updateID"]);
        $artist = $this->buildArtistFromPost($_POST);
        $existing = $this->artistService->getAnArtist($id);
        $this->handleArtistImages($artist, $existing);
        $success = $this->artistService->updateArtist($artist, $id) ? true : false;

        $this->showAlert(true, 'Artist updated successfully.', 'Failed to update artist.' , '/admin/artist/list');

    }



    public function delete(){


        $id = $this->sanitize($_GET["deleteID"]);
        $success = $this->artistService->deleteArtist($id);

        echo "<script>sessionStorage.setItem('success', 'Artist deleted successfully'); window.location = '/admin/artist/list';</script>";


    }

    public function addArtist()
    {
        $artist = $this->buildArtistFromPost($_POST);
        $this->handleArtistImages($artist);
        $success = $this->artistService->addArtist($artist);
        $this->showAlert($success, 'Artist added successfully.', 'Failed to add artist.');
    }

    public function updateArtist()
    {
        $id = $this->sanitize($_GET["updateID"]);
        $artist = $this->buildArtistFromPost($_POST);
        $existing = $this->artistService->getAnArtist($id);
        $this->handleArtistImages($artist, $existing);
        $success = $this->artistService->updateArtist($artist, $id) ? true : false;
        $this->showAlert($success, 'Artist updated successfully.', 'Failed to update artist.');
    }

    public function deleteArtist()
    {
        $id = $this->sanitize($_GET["deleteID"]);
        $success = $this->artistService->deleteArtist($id);
        $this->showAlert($success, 'Artist deleted successfully.', 'Failed to delete artist.');
    }

    private function buildArtistFromPost($post)
    {
        $artist = new Artist();
        $artist->setName($this->getPost("name", "changedName"));
        $artist->setDescription($this->getPost("description", "changedDescription"));
        $artist->setType($this->getPost("type", "changedType"));
        $artist->setSpotify(spotify: $this->getPost("spotify", "changedSpotify"));
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

            $imagePath = $this->handleImageUpload($changedField, $this->artistService, $existing ? $existing->{"get" . ucfirst($field)}() : null);

            if ($imagePath) {
                $artist->$setter($imagePath);
            }
        }



        
    }
}
