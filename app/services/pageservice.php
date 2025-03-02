<?php
require __DIR__ . '/../repositories/pagerepository.php';

class PageService
{
    private $pageRepository;

    public function __construct()
    {
        $this->pageRepository = new PageRepository();
    }

    public function getOnePage($id)
    {
        return $this->pageRepository->getOnePage($id);
    }

    public function updatePage($page, $id)
    {
        return $this->pageRepository->updatePage($page, $id);
    }
}
