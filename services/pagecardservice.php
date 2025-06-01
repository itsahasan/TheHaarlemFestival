<?php
require __DIR__ . '/../repositories/pagecardrepository.php';

class PageCardService
{
    private $pageCardRepository;

    public function __construct()
    {
        $this->pageCardRepository = new PageCardRepository();
    }

    public function getAllCardsByPageId($id)
    {
        return $this->pageCardRepository->getAllCardsByPageId($id);
    }
}
