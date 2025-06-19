<?php
// services/EmailService.php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;

require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../config/app.php';
require_once __DIR__ . '/../models/Order.php';
 // Добавляем модель User

class EmailService {

    private function configureMailer(): PHPMailer
    {
        $mail = new PHPMailer(true);
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER; // Раскомментируй, если нужно отладить
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'skolopendra228@gmail.com';
        $mail->Password   = 'mrpoaainjxftnpnm';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;
        $mail->setFrom('skolopendra228@gmail.com', 'Haarlem Festival');
        return $mail;
    }

    public function sendTicketEmail(Order $order, array $orderItems, array $tickets): bool
    {
        $mail = $this->configureMailer();
        $writer = new PngWriter();
        try {
            $mail->addAddress($order->getEmailAddress(), $order->getFirstName() . ' ' . $order->getLastName());
            $mail->isHTML(true);
            $mail->Subject = 'Your Tickets for Haarlem Festival - Order #' . $order->getId();

            $body = "<h1>Thank you for your order!</h1><p>Here are your tickets. Please show the QR code at the entrance.</p><hr>";

            $ticketCounter = 0;
            foreach($orderItems as $item) {
                $body .= "<h3>Event: " . htmlspecialchars($item->getEventName()) . " (Quantity: " . $item->getQty() . ")</h3>";
                for ($i = 0; $i < $item->getQty(); $i++) {
                    if (isset($tickets[$ticketCounter])) {
                        $ticket = $tickets[$ticketCounter];

                        // ИЗМЕНЕНО ЗДЕСЬ: Создаем полную ссылку для сканирования
                        $scanUrl = BASE_URL . "/qr/scan?uuid=" . $ticket->getUuid();
                        $qrCode = QrCode::create($scanUrl);

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
            return true;

        } catch (Exception $e) {
            error_log("EMAIL ERROR: " . $mail->ErrorInfo);
            return false;
        }
    }
    /**
     * ИСПРАВЛЕНО: Добавлена полная реализация метода
     */
    public function sendPasswordResetEmail(User $user, int $code): bool
    {
        $mail = $this->configureMailer();
        try {
            $mail->addAddress($user->getEmail(), $user->getUsername());
            $mail->isHTML(true);
            $mail->Subject = 'Password Reset Request - Haarlem Festival';

            $resetLink = BASE_URL . "/login/verifyCode?code=" . $code;
            $mail->Body = "
                <h1>Password Reset</h1>
                <p>We received a request to reset your password. Please click the link below to proceed:</p>
                <p><a href='{$resetLink}'>Reset Your Password</a></p>
                <p>If you did not request this, please ignore this email.</p>
            ";

            $mail->send();
            return true;
        } catch (Exception $e) {
            error_log("Password reset email could not be sent. Mailer Error: {$mail->ErrorInfo}");
            return false;
        }
    }
}