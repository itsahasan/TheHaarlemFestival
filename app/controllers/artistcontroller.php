<?php
require __DIR__ . '/../services/artistservice.php';
require __DIR__ . '/../services/albumservice.php';
require __DIR__ . '/../services/eventservice.php';
require __DIR__ . '/../services/shoppingcartservice.php';

include_once __DIR__ . '/../views/getURL.php';

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
        $name = htmlspecialchars($_POST["name"]);
        $description = htmlspecialchars($_POST["description"]);
        $type = htmlspecialchars($_POST["type"]);
        $spotify = htmlspecialchars($_POST["spotify"]);

        $artist = new Artist();

        $artist->setName($name);
        $artist->setDescription($description);
        $artist->setType($type);
        $artist->setSpotify($spotify);

        if (count($_FILES) > 0) {
            if (is_uploaded_file($_FILES['headerImg']['tmp_name'])) {
                $headerImage = file_get_contents($_FILES['headerImg']['tmp_name']);
                $artist->setHeaderImg($this->artistService->saveImage($headerImage));
            }
            if (is_uploaded_file($_FILES['thumbnailImg']['tmp_name'])) {
                $thumbnailImage = file_get_contents($_FILES['thumbnailImg']['tmp_name']);
                $artist->setThumbnailImg($this->artistService->saveImage($thumbnailImage));
            }
            if (is_uploaded_file($_FILES['logo']['tmp_name'])) {
                $logo = file_get_contents($_FILES['logo']['tmp_name']);
                $artist->setLogo($this->artistService->saveImage($logo));
            }
            if (is_uploaded_file($_FILES['image']['tmp_name'])) {
                $image = file_get_contents($_FILES['image']['tmp_name']);
                $artist->setImage($this->artistService->saveImage($image));
            }
        } else {
            echo "problem";
        }

        $this->artistService->addArtist($artist);

        if ($this->artistService) {
            echo "<script>alert('Artist addedd successfully. ')</script>";
        } else {
            echo "<script>alert('Failed to add Artist. ')</script>";
        }
    }

    public function updateArtist()
    {
        $name = htmlspecialchars($_POST["changedName"]);
        $description = htmlspecialchars($_POST["changedDescription"]);
        $type = htmlspecialchars($_POST["changedType"]);
        $spotify = htmlspecialchars($_POST["changedSpotify"]);

        $artist = new Artist();

        $artist->setName($name);
        $artist->setDescription($description);
        $artist->setType($type);
        $artist->setSpotify($spotify);

        $thisArtist = $this->artistService->getAnArtist($_GET["updateID"]);
        if (count($_FILES) > 0) {
            if (is_uploaded_file($_FILES['changedHeaderImg']['tmp_name'])) {
                $headerImage = file_get_contents($_FILES['changedHeaderImg']['tmp_name']);
                $artist->setHeaderImg($this->artistService->updateImage($headerImage, $thisArtist->getHeaderImg()));
            }
            if (is_uploaded_file($_FILES['changedThumbnailImg']['tmp_name'])) {
                $thumbnailImage = file_get_contents($_FILES['changedThumbnailImg']['tmp_name']);
                $artist->setThumbnailImg($this->artistService->updateImage($thumbnailImage, $thisArtist->getThumbnailImg()));
            }
            if (is_uploaded_file($_FILES['changedLogo']['tmp_name'])) {
                $logo = file_get_contents($_FILES['changedLogo']['tmp_name']);
                $artist->setLogo($this->artistService->updateImage($logo, $thisArtist->getLogo()));
            }
            if (is_uploaded_file($_FILES['changedImage']['tmp_name'])) {
                $image = file_get_contents($_FILES['changedImage']['tmp_name']);
                $artist->setImage($this->artistService->updateImage($image, $thisArtist->getImage()));
            }
        } else {
            echo "problem";
        }

        $this->artistService->updateArtist($artist, $_GET["updateID"]);

        if ($this->artistService) {
            echo "<script>alert('Artist updated successfully. ')</script>";
        } else {
            echo "<script>alert('Failed to update Artist. ')</script>";
        }
    }

    public function deleteArtist()
    {
        $id = htmlspecialchars($_GET["deleteID"]);
        $this->artistService->deleteArtist($id);

        if ($this->artistService) {
            echo "<script>alert('Artist deleted successfully. ')</script>";
        } else {
            echo "<script>alert('Failed to delete Artist. ')</script>";
        }
    }

    public function artistcms()
    {
        if (isset($_POST["delete"])) {
            $this->deleteArtist();
        }
        if (isset($_POST["add"])) {
            $this->addArtist();
        }
        if (isset($_POST["edit"])) {
            $id = htmlspecialchars($_GET["updateID"]);
            $updateArtist = $this->artistService->getOne($id);
        }
        if (isset($_POST["update"])) {
            $this->updateArtist();
        }

        //sort artists by type dance or jazz
        if (isset($_POST["dance"])) {
            $model = $this->artistService->getAllDanceArtists();
        } else if (isset($_POST["jazz"])) {
            $model = $this->artistService->getAllJazzArtists();
        } else {
            $model = $this->artistService->getAll();
        }

        require __DIR__ . '/../views/cms/music/artist-cms.php';
    }
}
