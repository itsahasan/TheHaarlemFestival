<?php

require_once __DIR__ . '/../basecontroller.php';
require __DIR__ . '/../../services/historyeventservice.php';
require __DIR__ . '/../../services/shoppingcartservice.php';
include_once __DIR__ . '/../../views/getURL.php';
require __DIR__ . '/../../services/tourguideservice.php';
class HistoryEventController extends BaseController
{
    private $historyeventService;
    private $cartService;
    private $tourguideService;

    function __construct()
    {
        parent::__construct();
        $this->historyeventService = new HistoryEventService();
        $this->cartService = new ShoppingCartService();
        $this->tourguideService = new TourGuideService();

    }

    public function cms()
    {


        $model = $this->historyeventService->getAll();
        require __DIR__ . '/../../views/cms/historyevent/index.php';
    }



    public function create()
    {
        $tourGuides = $this->tourguideService->getAll();
    
        require __DIR__ . '/../../views/cms/historyevent/create.php';
    }


    
    public function store()
    {
    
        $tickets_available = htmlspecialchars($_POST["tickets_available"]);
        $price = htmlspecialchars($_POST["price"]);
        $datetime = htmlspecialchars($_POST["datetime"]);
        $location = htmlspecialchars($_POST["location"]);
        $tourguideID = htmlspecialchars($_POST["tourguideID"]);

        $historyeventcms = new HistoryEvent();

        $historyeventcms->setTicketsAvailable($tickets_available);
        $historyeventcms->setPrice($price);
        $historyeventcms->setDateTime($datetime);
        $historyeventcms->setLocation($location);
        $historyeventcms->setTourguideID($tourguideID);



        if (count($_FILES) > 0) {
            if ( is_uploaded_file($_FILES['image']['tmp_name'])){

                $uploadDir = __DIR__ . '/../../public/uploads/';


                $fieldName = 'image';

                $extension = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
                $uniqueFilename = uniqid("img_") . '.' . $extension;
                $destination = $uploadDir . $uniqueFilename;


                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $publicUrl =  $uniqueFilename;
                if (move_uploaded_file($_FILES[$fieldName]['tmp_name'],  $destination)) {
                    $historyeventcms->setImage($this->historyeventService->saveImage($publicUrl));
                }

            }
        } else {
            echo "Problem Occured! ";
        }

        $this->historyeventService->addHistoryEvent($historyeventcms);

        if ($this->historyeventService) {

            echo "<script>sessionStorage.setItem('success', 'History Event added successfully! '); window.location = '/admin/historyevent/cms';</script>";
        } else {

            echo "<script>sessionStorage.setItem('error', 'Failed to add History Event. '); window.location = '/admin/historyevent/cms';</script>";

        }
    }



    public function edit()
    {

        $tourGuides = $this->tourguideService->getAll();

        $id = htmlspecialchars($_GET["updateID"]);
        $updateHistoryEvent = $this->historyeventService->getOne($id);
        require __DIR__ . '/../../views/cms/historyevent/edit.php';
    }


    public function update()
    {
    

        $tickets_available = htmlspecialchars($_POST["changedTickets_available"]);
        $price = htmlspecialchars($_POST["changedPrice"]);
        $datetime = htmlspecialchars($_POST["changedDateTime"]);
        $location = htmlspecialchars($_POST["changedLocation"]);
        $tourguideID = htmlspecialchars($_POST["changedTourguideID"]);



        $historyeventcms = new HistoryEvent();

        $historyeventcms->setTicketsAvailable($tickets_available);
        $historyeventcms->setPrice($price);
        $historyeventcms->setDateTime($datetime);
        $historyeventcms->setLocation($location);
        $historyeventcms->setTourguideID($tourguideID);

        $theHistoryEvent = $this->historyeventService->getAHistoryEvent($_GET["updateID"]);
        if (count($_FILES) > 0) {
            if ( $_FILES['changeImage']['tmp_name'] &&  is_uploaded_file($_FILES['changeImage']['tmp_name'])) {


                $uploadDir = __DIR__ . '/../../public/uploads/';


                $fieldName = 'changeImage';

                $extension = pathinfo($_FILES[$fieldName]['name'], PATHINFO_EXTENSION);
                $uniqueFilename = uniqid("img_") . '.' . $extension;
                $destination = $uploadDir . $uniqueFilename;


                if (!file_exists($uploadDir)) {
                    mkdir($uploadDir, 0755, true);
                }

                $publicUrl =  $uniqueFilename;
                if (move_uploaded_file($_FILES[$fieldName]['tmp_name'],  $destination)) {

                    $historyeventcms->setImage($this->historyeventService->updateImage($publicUrl, $theHistoryEvent->getImage()));
                }



            }
        } else {
            echo "Problem Occured!";
        }

        $this->historyeventService->updateHistoryEvent($historyeventcms, $_GET["updateID"]);

        if ($this->historyeventService) {


            echo "<script>sessionStorage.setItem('success', 'History Event updated successfully!'); window.location = '/admin/historyevent/cms';</script>";

        } else {


            echo "<script>sessionStorage.setItem('error', 'Failed to update History Event.'); window.location = '/admin/historyevent/cms';</script>";
        }



    }



    public function delete()
    {

        $id = htmlspecialchars($_GET["deleteID"]);
        $this->historyeventService->deleteHistoryEvent($id);

        if ($this->historyeventService) {
            echo "<script>sessionStorage.setItem('success', 'History Event deleted successfully!'); window.location = '/admin/historyevent/cms';</script>";
        } else {
            echo "<script>sessionStorage.setItem('error', 'Failed to delete History Event. '); window.location = '/admin/historyevent/cms';</script>";
        }
    }









   



}
