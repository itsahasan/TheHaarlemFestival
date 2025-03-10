<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../utils/qr-generator.php';

require __DIR__ . '/../services/ticketservice.php';

use Zxing\QrReader;

class QrController
{
    private $ticketService;

    function __construct()
    {
        session_start();
        $this->ticketService = new TicketService();
    }
    public function index()
    {
        require __DIR__ . '/../views/qr.php';
    }

    public function generateQr($uuid)
    {
        $qr = new QRGenerator();
        //pass ticket id to generate QR
        $qrcode = $qr->generateQR($uuid);
        return $qrcode;
    }

    public function scan()
    {
        if (isset($_SESSION['loggedin'])) {
            $uuid = $_GET['qrCodeData'];
            $ticket = $this->ticketService->checkIfTicketWasScanned($uuid);
            if (!$ticket) {
                //ticket was scanned or not existent in db.
                echo "<script>alert('Ticket is invalid or was already scanned'); window.location = '/qr';</script>";
            }
            $this->ticketService->updateTicketStatus($uuid); //change status to scanned
            echo "<script>alert('Ticket scanned successfully'); window.location = '/qr';</script>";
        } else {
            echo "<script>alert('You must be logged in to access this page!'); window.location = '/';</script>";
        }
    }
}
