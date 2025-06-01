<?php
require __DIR__ . '/../vendor/autoload.php';

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

class QRGenerator
{
    function __construct()
    {
    }

    function generateQR($uid)
    {
        $qr = QrCode::create($uid);
        $writer = new PngWriter();
        $result = $writer->write($qr);
        return $result;

        // (C1) SAVE TO FILE
        //$result->saveToFile(__DIR__ . "/qr.png");

        // (C2) DIRECT OUTPUT
        //header("Content-Type: " . $result->getMimeType());
        //echo $result->getString();

        // (C3) GENERATE DATA URI
        //echo "<img src='{$result->getDataUri()}'>";
    }
}
