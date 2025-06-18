<?php
// services/EmailService.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP; // Добавляем для отладки
use PHPMailer\PHPMailer\Exception;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

// Подключаем автозагрузчик Composer
require_once __DIR__ . '/../vendor/autoload.php';

class EmailService {

    public function sendTicketEmail(Order $order, array $orderItems, array $tickets)
    {


        $mail = new PHPMailer(true);
        $writer = new PngWriter();

        try {


            // Настройки сервера
            $mail->isSMTP();
            $mail->Host       = 'smtp.gmail.com';
            $mail->SMTPAuth   = true;

            // НОВЫЕ ДАННЫЕ, КОТОРЫЕ ТЫ ПРЕДОСТАВИЛ
            $mail->Username   = 'skolopendra228@gmail.com';
            $mail->Password   = 'welyfjjtriapcomm'; // Пароль для приложений без пробелов

            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Получатели
            $mail->setFrom('skolopendra228@gmail.com', 'Haarlem project');
            $mail->addAddress($order->getEmailAddress(), $order->getFirstName() . ' ' . $order->getLastName());

            // Контент
            $mail->isHTML(true);
            $mail->Subject = 'Your Tickets for Haarlem Festival - Order #' . $order->getId();

            $body = "<h1>Thank you for your order, " . htmlspecialchars($order->getFirstName()) . "!</h1><p>Here are your unique tickets:</p><hr>";

            $ticketCounter = 0;
            foreach($orderItems as $item) {
                $body .= "<h3>Event: " . htmlspecialchars($item->getEvent_name()) . " (Quantity: " . $item->getQty() . ")</h3>";
                for ($i = 0; $i < $item->getQty(); $i++) {
                    if (isset($tickets[$ticketCounter])) {
                        $ticket = $tickets[$ticketCounter];
                        $qrCode = QrCode::create($ticket->getUuid());
                        $qrImageString = $writer->write($qrCode)->getString();

                        $cid = 'qr_' . $ticket->getUuid();
                        $mail->addStringEmbeddedImage($qrImageString, $cid, 'qrcode.png');
                        $body .= "<p>Ticket " . ($i + 1) . ": <br><img src='cid:{$cid}'></p>";
                        $ticketCounter++;
                    }
                }
                $body .= "<hr>";
            }

            $mail->Body = $body;
            $mail->send();

            // Если все успешно, можно записать в лог
            error_log("Email for order {$order->getId()} sent successfully!");

        } catch (Exception $e) {
            // Выводим ошибку на экран, чтобы увидеть ее в ngrok
            die("EMAIL ERROR: " . $mail->ErrorInfo);
        }
    }
}