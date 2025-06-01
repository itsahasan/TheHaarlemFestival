<?php
require __DIR__ . '/../../services/yummyservice.php';
require __DIR__ . '/../../services/shoppingcartservice.php';

class YummyController
{
    private $yummyservice;
    private $cartService;

    public function __construct()
    {
        $this->yummyservice = new YummyService();
        $this->cartService = new ShoppingCartService();
        session_start();
    }



    /** Session manage method start */
    public function manageSessions()
    {
        $sessions = $this->yummyservice->getSessions();
        require __DIR__ . '/../../views/cms/food/managesessions.php';
    }
    public function editSession()
    {
        $id = htmlspecialchars($_GET["sessionid"]);

        $session = $this->yummyservice->getSessionById($id);
        require __DIR__ . '/../../views/cms/food/editsession.php';
    }
    public function addSession()
    {
        $restaurants = $this->yummyservice->getRestaurants();
        require __DIR__ . '/../../views/cms/food/addsession.php';
    }
    public function deleteSession()
    {
        $this->yummyservice->deleteSession();
        require __DIR__ . '/../../views/cms/food/deletesession.php';
    }
    public function saveSession()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $newSession = new Session();
            $newSession->setId(isset($_POST['id']) ? $_POST['id'] : 0);
            $newSession->setRestaurantid(isset($_POST['restaurantid']) ? $_POST['restaurantid'] : null); //check if information was sent, if so it assigns the value, otherwise sets to null 
            $newSession->setPrice(isset($_POST['price']) ? $_POST['price'] : null);
            $newSession->setReducedprice(isset($_POST['reducedprice']) ? $_POST['reducedprice'] : null);
            $newSession->setStarttime(isset($_POST['starttime']) ? $_POST['starttime'] : null);
            $newSession->setSession_length(isset($_POST['length']) ? $_POST['length'] : null);
            $newSession->setAvailable_seats(isset($_POST['seats']) ? $_POST['seats'] : null);

            $this->yummyservice->saveSession($newSession);
            $this->manageSessions();
        }
    }


    /** Session manage method end */


    /** Restaurants methods start */
    public function manageRestaurants()
    {
        $restaurants = $this->yummyservice->getRestaurants();
        require __DIR__ . '/../../views/cms/food/managerestaurants.php';
    }
    public function editRestaurant()
    {
        $id = htmlspecialchars($_GET["restaurantid"]);

        $restaurant = $this->yummyservice->getRestaurantById($id);
        require __DIR__ . '/../../views/cms/food/editrestaurant.php';
    }
    public function addRestaurant()
    {
        require __DIR__ . '/../../views/cms/food/addrestaurant.php';
    }
    public function deleteRestaurant()
    {
        $this->yummyservice->deleteRestaurant();
        require __DIR__ . '/../../views/cms/food/deleterestaurant.php';
    }
    public function saveRestaurant()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $newRestaurant = new Restaurant();
            $newRestaurant->setId(isset($_POST['id']) ? $_POST['id'] : 0);
            $newRestaurant->setName(isset($_POST['name']) ? $_POST['name'] : null);
            $newRestaurant->setLocation(isset($_POST['location']) ? $_POST['location'] : null);
            $newRestaurant->setDescription(isset($_POST['description']) ? $_POST['description'] : null);
            $newRestaurant->setCuisine(isset($_POST['cuisine']) ? $_POST['cuisine'] : null);
            $newRestaurant->setSeats(isset($_POST['seats']) ? $_POST['seats'] : 0);
            $newRestaurant->setStars(isset($_POST['stars']) ? $_POST['stars'] : 0);
            $newRestaurant->setEmail(isset($_POST['email']) ? $_POST['email'] : null);
            $newRestaurant->setPhonenumber(isset($_POST['phonenumber']) ? $_POST['phonenumber'] : null);

            $restaurant = isset($_POST['id']) ? $this->yummyservice->getRestaurantByIdAlt($_POST['id']) : null;

            if (count($_FILES) > 0) {



                $uploadDir = __DIR__ . '/../../public/uploads/';


                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }


                $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? 'https://' : 'http://';
                $host = $_SERVER['HTTP_HOST'];
                $baseUrl = $protocol . $host;


                if (is_null($restaurant)) {

                    for ($imgnumber = 1; $imgnumber <= 3; $imgnumber++) {
                        if (is_uploaded_file($_FILES['image' . $imgnumber]['tmp_name'])) {
     
                            $fieldName = 'image' . $imgnumber;

                            $extension = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
                            $uniqueFilename = uniqid("img{$imgnumber}_") . '.' . $extension;
                            $destination = $uploadDir . $uniqueFilename;

          

                            $publicUrl =  $uniqueFilename;

                            if (move_uploaded_file($_FILES[$fieldName]['tmp_name'],  $destination)) {

                                $setMethod = "setImage" . $imgnumber;

                                $newRestaurant->$setMethod($this->yummyservice->saveImage($publicUrl));
                            }

                        }
                    }
                }
                else {
                    for ($imgnumber = 1; $imgnumber <= 3; $imgnumber++) {
                        if (is_uploaded_file($_FILES['image' . $imgnumber]['tmp_name'])) {

                            $fieldName = 'image' . $imgnumber;

                            $extension = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
                            $uniqueFilename = uniqid("img{$imgnumber}_") . '.' . $extension;
                            $destination = $uploadDir . $uniqueFilename;
                            echo   $destination ;
                            $publicUrl =  $uniqueFilename;

                            if (move_uploaded_file($_FILES[$fieldName]['tmp_name'], $destination)) {

                                $setMethod = "setImage" . $imgnumber;
                                $getmethod = "getImage" . $imgnumber;

                                $newRestaurant->$setMethod($this->yummyservice->updateImage($publicUrl , $restaurant->$getmethod()));
                            }

            
                        }
                    }
                }
            }

            $this->yummyservice->saveRestaurant($newRestaurant);

            $this->manageRestaurants();
        }
    }


    /** Restaurant method end  */


    
    public function manageReservations()
    {
        $reservations = $this->yummyservice->getReservations();
        require __DIR__ . '/../../views/cms/food/managereservations.php';
    }
    public function deactivateReservation()
    {
        $this->yummyservice->deactivateReservation();
        require __DIR__ . '/../../views/cms/food/deactivatereservation.php';
    }

}
