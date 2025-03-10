<?php
require __DIR__ . '/../repositories/ticketrepository.php';

class TicketService
{
    private $ticketRepository;

    public  function __construct()
    {
        $this->ticketRepository = new TicketRepository();
    }

    public function getTicketById($uuid)
    {
        return $this->ticketRepository->getTicketById($uuid);
    }

    public function checkIfTicketWasScanned($uuid)
    {
        return $this->ticketRepository->checkIfTicketWasScanned($uuid);
    }

    public function updateTicketStatus($uuid)
    {
        return $this->ticketRepository->updateTicketStatus($uuid);
    }

    public function createTicket()
    {
        $uuid = $this->generateUuid();
        return $this->ticketRepository->createTicket($uuid);
    }

    public function generateUuid()
    {
        do {
            $uuid = sprintf(
                '%04x%04x%04x%04x%04x%04x%04x%04x',
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0x0fff) | 0x4000,
                mt_rand(0, 0x3fff) | 0x8000,
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff),
                mt_rand(0, 0xffff)
            );
        } while (!$this->ticketRepository->validateUuid($uuid));

        return $uuid;
    }
}
