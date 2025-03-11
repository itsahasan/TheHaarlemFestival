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
        if (isset($_POST['add-to-cart'])) {
        if (isset($_SESSION['userId'])) {
            $user_id = $_SESSION['userId'];
            $product_id = htmlspecialchars($_POST["product_id"]);
            $qty = 1;

            $cartItem = new ShoppingCartItem();

            $cartItem->setUser_id($user_id);
            $cartItem->setProduct_id($product_id);
            $cartItem->setQty($qty);
            if ($this->cartService->checkIfProductExistsInCart($user_id, $product_id)) {
                echo "<script>alert('This product is already in your shopping cart. You can change the quantity in the shopping cart page.')</script>";
            } else {
                $this->cartService->addProductToCart($cartItem);
                $_SESSION['cartcount']++;
            }
        } else {
            echo "<script>
            alert('You have to be logged in to add to cart.');
            window.location.href = '/login/index'
            </script>";
        }
    }
        
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
