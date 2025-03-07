<?php
require __DIR__ . '/../services/artistservice.php';
require __DIR__ . '/../services/albumservice.php';
require __DIR__ . '/../services/eventservice.php';
require __DIR__ . '/../services/shoppingcartservice.php';


class ArtistController
{
    private $artistService;
    private $albumService;
    private $eventService;
    private $cartService;

    function __construct()
    {
        $this->artistService = new ArtistService();
        $this->albumService = new AlbumService();
        $this->eventService = new EventService();
        $this->cartService = new ShoppingCartService();
        session_start();
    }

    public function danceartists()
    {
        $model = $this->artistService->getAllDanceArtists();

        require __DIR__ . '/../views/dance/artistsoverview.php';
    }

    public function jazzartists()
    {
        ini_set('memory_limit', '1024M');
        $model = $this->artistService->getAllJazzArtists();

        require __DIR__ . '/../views/jazz/artistsoverview.php';
    }

    function addToCart()
    {
        
    }

    public function danceartistdetails()
    {
        $this->addToCart();

        $url = getURL();
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $model = $this->artistService->getOne($params['id']);
        $albums = $this->albumService->getAllAlbumsByArtist($params['id']);
        $events = $this->eventService->getEventsByArtistName('%' . $model->getName() . '%');

        require __DIR__ . '/../views/dance/artistdetails.php';
    }

    public function jazzartistdetails()
    {
        $this->addToCart();

        $url = getURL();
        $url_components = parse_url($url);
        parse_str($url_components['query'], $params);

        $model = $this->artistService->getOne($params['id']);
        $albums = $this->albumService->getAllAlbumsByArtist($params['id']);
        $events = $this->eventService->getEventsByArtistName('%' . $model->getName() . '%');

        require __DIR__ . '/../views/jazz/artistdetails.php';
    }

    // cms part
    public function addArtist()
    {
       
    }

    public function updateArtist()
    {
        
    }

    public function deleteArtist()
    {
        
    }

    public function artistcms()
    {
       
    }
}
