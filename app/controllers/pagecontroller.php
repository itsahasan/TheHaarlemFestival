<?php
require __DIR__ . '/../services/pageservice.php';
require __DIR__ . '/../services/pagecardservice.php';

require __DIR__ . '/../services/eventservice.php';
require __DIR__ . '/../services/historyeventservice.php';

class PageController
{
    private $pageService;
    private $pageCardService;
    private $eventService;
    private $historyEventService;


    function __construct()
    {
        $this->pageService = new PageService();
        $this->pageCardService = new PageCardService();
        $this->eventService = new EventService();
        $this->historyEventService = new HistoryEventService();
        session_start();
    }

    public function index()
    {
        $page = $this->pageService->getOnePage(2);
        $pagecards = $this->pageCardService->getAllCardsByPageId(2);
        $events = $this->eventService->getAll();
        $historyEvents = $this->historyEventService->getAll();
        require __DIR__ . '/../views/visithaarlem/homepage.php';
    }

    // public function festival()
    // {
    //     $page = $this->pageService->getOnePage(2);
    //     $pagecards = $this->pageCardService->getAllCardsByPageId(2);
    //     $events = $this->eventService->getAll();
    //     $historyEvents = $this->historyEventService->getAll();

    //     require __DIR__ . '/../views/visithaarlem/festivalhomepage.php';
    // }

    public function history()
    {
        $page = $this->pageService->getOnePage(3);
        $pagecards = $this->pageCardService->getAllCardsByPageId(3);

        require __DIR__ . '/../views/visithaarlem/history.php';
    }

    public function museum()
    {
        $page = $this->pageService->getOnePage(4);
        $pagecards = $this->pageCardService->getAllCardsByPageId(4);

        require __DIR__ . '/../views/visithaarlem/museum.php';
    }

    public function theater()
    {
        $id = 5;
        if (isset($_POST['save'])) {
            // Get the edited content from the form
            $newTitle = htmlspecialchars($_POST['title']);
            $newDescription = htmlspecialchars($_POST['description']);
            //$newHeaderImage
            $page = new Page();

            $page->setHeaderImg(339);
            $page->setTitle($newTitle);
            $page->setDescription($newDescription);

            $this->pageService->updatePage($page, $id);
        }

        $page = $this->pageService->getOnePage($id);
        $pagecards = $this->pageCardService->getAllCardsByPageId($id);

        require __DIR__ . '/../views/visithaarlem/theater.php';
    }

    public function music()
    {
        $id = 6;
        if (isset($_POST['save'])) {
            // Get the edited content from the form
            $newTitle = htmlspecialchars($_POST['title']);
            $newDescription = htmlspecialchars($_POST['description']);
            //$newHeaderImage
            $page = new Page();

            $page->setHeaderImg(338);
            $page->setTitle($newTitle);
            $page->setDescription($newDescription);

            $this->pageService->updatePage($page, $id);
        }

        $page = $this->pageService->getOnePage($id);
        $pagecards = $this->pageCardService->getAllCardsByPageId($id);

        require __DIR__ . '/../views/visithaarlem/music.php';
    }
    public function food()
    {
        $page = $this->pageService->getOnePage(7);
        $pageCards = $this->pageCardService->getAllCardsByPageId(7);

        require __DIR__ . '/../views/visithaarlem/food.php';
    }
    public function updateMusicPage()
    {
        $title = htmlspecialchars($_POST["title"]);
        $description = htmlspecialchars($_POST["description"]);

        $page = new Page();

        $page->setHeaderImg('');
        $page->setTitle($title);
        $page->setDescription($description);

        $this->pageService->updatePage($page, 6);
    }

    public function savePage()
    {
        $contents = $_POST["contents"];
        echo $contents;
    }
}
