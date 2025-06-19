<?php
// controllers/QRController.php
declare(strict_types=1);

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../services/TicketService.php';

class QRController extends BaseController
{
    private TicketService $ticketService;

    public function __construct()
    {
        parent::__construct();
        $this->ticketService = new TicketService();
    }

    /**
     * Обрабатывает переход по ссылке из QR-кода
     */
    public function scan()
    {
        $uuid = $_GET['uuid'] ?? '';

        if (empty($uuid)) {
            die("Invalid Request: No ticket specified.");
        }

        // Пытаемся найти билет, который еще не был отсканирован
        $ticket = $this->ticketService->checkIfTicketWasScanned($uuid);

        if ($ticket) {
            // Если билет найден и не отсканирован, обновляем его статус
            $this->ticketService->updateTicketStatus($uuid);
            // И перенаправляем на сайт Харлема в знак успеха
            header('Location: https://www.visithaarlem.com/');
            exit;
        } else {
            // Если билет не найден или уже был отсканирован, выводим сообщение
            // Можно создать красивую страницу для этого
            die("Ticket is invalid or has already been used.");
        }
    }
}