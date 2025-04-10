<?php

require_once 'BaseController.php';
require __DIR__ . '/../services/historyeventservice.php';
require __DIR__ . '/../services/shoppingcartservice.php';
include_once __DIR__ . '/../views/getURL.php';

class HistoryEventController extends BaseController
{
    private $historyeventService;
    private $cartService;

    function __construct()
    {
        parent::__construct();
        $this->historyeventService = new HistoryEventService();
        $this->cartService = new ShoppingCartService();
    }

    public function index()
    {
        $this->handleAddToCart($this->cartService);
        $model = $this->filterEventsByDate();
        require __DIR__ . '/../views/historyevent/index.php';
    }

    public function historyEventDetails()
    {
        $params = $this->getUrlParams();
        $model = $this->historyeventService->getOne($params['id']);
        require __DIR__ . '/../views/cms/historyevent/index.php';
    }

    public function cms()
    {
        $this->requireAdmin();

        if (isset($_POST["delete"])) $this->deleteHistoryEvent();
        if (isset($_POST["add"]))    $this->addHistoryEvent();
        if (isset($_POST["update"])) $this->updateHistoryEvent();

        $model = $this->historyeventService->getAll();
        require __DIR__ . '/../views/cms/historyevent/index.php';
    }

    private function filterEventsByDate()
    {
        $dates = [
            'friday'   => '2025-07-28',
            'saturday' => '2025-07-29',
            'sunday'   => '2025-07-30',
            'monday'   => '2025-07-31',
        ];

        return $this->filterByDate(
            $dates,
            fn($date) => $this->historyeventService->getHistoryEventsByDate("%$date%"),
            fn() => $this->historyeventService->getAllInfo()
        );
    }

    private function deleteHistoryEvent()
    {
        $id = $this->sanitize($_GET["deleteID"]);
        $success = $this->historyeventService->deleteHistoryEvent($id);
        $this->showAlert($success, 'History Event deleted successfully!', 'Failed to delete History Event.');
    }

    private function addHistoryEvent()
    {
        $event = $this->buildHistoryEventFromPost($_POST);
        $event->setImage($this->handleImageUpload('image', $this->historyeventService));
        $success = $this->historyeventService->addHistoryEvent($event);
        $this->showAlert($success, 'History Event added successfully!', 'Failed to add History Event.');
    }

    private function updateHistoryEvent()
    {
        $id = $this->sanitize($_GET["updateID"]);
        $event = $this->buildHistoryEventFromPost($_POST, true);
        $existing = $this->historyeventService->getAHistoryEvent($id);

        $updatedImage = $this->handleImageUpload('changeImage', $this->historyeventService, $existing->getImage());
        if ($updatedImage) {
            $event->setImage($updatedImage);
        }

        $success = $this->historyeventService->updateHistoryEvent($event, $id);
        $this->showAlert($success, 'History Event updated successfully!', 'Failed to update History Event.');
    }
}
