<?php
require __DIR__ . '/../repositories/ticketpassrepository.php';

class TicketPassService
{
    private $ticketpassRepository;

    public function __construct()
    {
        $this->ticketpassRepository = new TicketPassRepository();
    }

    public function getDancePasses()
    {
        return $this->ticketpassRepository->getDancePasses();
    }

    public function getJazzPasses()
    {
        return $this->ticketpassRepository->getJazzPasses();
    }
}
