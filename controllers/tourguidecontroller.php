<?php
require_once 'basecontroller.php';
require __DIR__ . '/../services/tourguideservice.php';
include_once __DIR__ . '/../views/getURL.php';


class Tourguidecontroller extends BaseController 
{
    private $tourguideService;

    function __construct()
    {
        $this->tourguideService = new TourGuideService();
        session_start();
    }

    public function index(){
        $tourguides = $this->tourguideService->getAll();
        require __DIR__ . '/../views/historyevent/tourguidesoverview.php';
    }

    public function tourguidedetails()
    {
        $params = $this->getUrlParams();
        $model = $this->tourguideService->getOne($params['id']);
        require __DIR__ . '/../views/historyevent/tourguidedetails.php';
    }
}

