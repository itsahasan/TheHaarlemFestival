<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . '/../services/ordersservice.php';
require_once __DIR__ . '/../services/ticketservice.php';

class Pdfcontroller
{
    private $orderService;
    private $ticketService;
    private $mollie;

    function __construct()
    {
        $this->mollie = new \Mollie\Api\MollieApiClient();
        $this->mollie->setApiKey("
        test_5jaAakyFRh8n9cNuC8p8aQR8gF3jp3");
        $this->orderService = new OrdersService();
        $this->ticketService = new TicketService();
    }


    public function downloadinvoice()
    {
        $id = htmlspecialchars($_POST['invoicedownload']);

        $order = $this->orderService->getOnePlacedOrder($id);

        if (!$order) {
            echo "<script>sessionStorage.setItem('error', 'Can not find order data to export! '); window.location = '/admin/orders/list';</script>";
        }

        $pdf = $this->createInvoice($order);
        $pdf->Output('invoice_' . $id . '.pdf', 'D');
        exit;
    }

    public function downloadticket()
    {
        $id = htmlspecialchars($_POST['invoicedownload']);

        $order = $this->orderService->getOnePlacedOrder($id);

        if (!$order) {
            echo "<script>sessionStorage.setItem('error', 'Can not find order data to export! '); window.location = '/admin/orders/list';</script>";
        }

        $pdf = $this->createTickets($order);
        $pdf->Output('ticket_' . $id . '.pdf', 'D');
        exit;
    }

    public function createInvoice($order)
    {

        // Get payment status
        try {
            $payment = $this->mollie->payments->get($order->getPaymentId());
            $status = $payment->status;
        } catch (\Exception $e) {
            $status = 'Unknown';
        }

        // Define "From" information variables
        $companyName = 'Orders CMS';
        $companyAddress = '123 Business Street';
        $companyCity = 'City, Country, 12345';
        $companyEmail = 'info@orderscms.com';
        $companyPhone = '+123-456-7890';

        // Prepare QR code data
        $qrData = [
            'Email' => $order->getEmailAddress(),
            'Name' => $order->getFirstName() . ' ' . $order->getLastName(),
            'Order ID' => $order->getId(),
            'Total Price' => number_format($order->getTotalPrice(), 2) . ' €',
            'Payment Status' => $status,
            'Invoice Date' => date('Y-m-d')
        ];
        $qrCodeString = implode("\n", array_map(function ($key, $value) {
            return "$key: $value";
        }, array_keys($qrData), $qrData));

        // Include TCPDF library
        require_once __DIR__ . '/../vendor/tecnickcom/tcpdf/tcpdf.php';

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Orders CMS');
        $pdf->SetTitle('Invoice #' . $order->getId());
        $pdf->SetSubject('Order Invoice');
        $pdf->SetKeywords('Invoice, Order, PDF');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->SetMargins(10, 5, 10);
        $pdf->SetAutoPageBreak(true, 10); // Enable auto page break to handle long content

        $pdf->SetFont('helvetica', '', 9);

        $pdf->AddPage();

        // Calculate tax (21% VAT)
        $total = $order->getTotalPrice();
        $tax = $total * 0.21;
        $subtotal = $total; // Subtotal is total without tax
        $totalWithTax = $total + $tax;

        $id = (string)$order->getId();

        $html = '<div style="width: 100%; max-width: 600px; margin: 0 auto; color: #1e293b; background-color: white; padding: 20px;">
            <!-- Header -->
            <div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0;">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="width: 50%;">
                            <h1 style="font-size: 22px; font-weight: 700; color: #2563eb; margin: 0;">Invoice</h1>
                        </td>
                        <td style="width: 50%; text-align: right; font-size: 9px; color: #64748b;">
                            <div style="font-size: 12px; font-weight: 600; margin-bottom: 3px;">Invoice #' . htmlspecialchars($id) . '</div>
                            <div>Date: ' . date('Y-m-d') . '</div>
                            <div>Order ID: ' . htmlspecialchars($id) . '</div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Info Sections -->
            <div style="margin-bottom: 15px;">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <!-- Company Information -->
                        <td style="width: 50%; vertical-align: top; padding-right: 10px;">
                            <div style="font-size: 12px; font-weight: 600; color: #2563eb; margin-bottom: 8px; padding-bottom: 3px; border-bottom: 1px solid #dbeafe;">From</div>
                            <p style="font-size: 9px; line-height: 1.4; margin: 0 0 8px 0;">
                                <strong style="color: #1e293b; font-weight: 600;">' . htmlspecialchars($companyName) . '</strong><br>
                                ' . htmlspecialchars($companyAddress) . '<br>
                                ' . htmlspecialchars($companyCity) . '<br>
                                Email: ' . htmlspecialchars($companyEmail) . '<br>
                                Phone: ' . htmlspecialchars($companyPhone) . '
                            </p>
                        </td>
                        <!-- Customer Information -->
                        <td style="width: 50%; vertical-align: top; padding-left: 10px;">
                            <div style="font-size: 12px; font-weight: 600; color: #2563eb; margin-bottom: 8px; padding-bottom: 3px; border-bottom: 1px solid #dbeafe;">Bill To</div>
                            <p style="font-size: 9px; line-height: 1.4; margin: 0 0 8px 0;">
                                <strong style="color: #1e293b; font-weight: 600;">' . htmlspecialchars($order->getFirstName() . ' ' . $order->getLastName()) . '</strong><br>
                                ' . htmlspecialchars($order->getStreetAddress()) . '<br>
                                ' . htmlspecialchars($order->getCountry() . ', ' . $order->getZipCode()) . '<br>
                                Email: ' . htmlspecialchars($order->getEmailAddress()) . '<br>
                                Phone: ' . htmlspecialchars($order->getPhoneNumber()) . '
                            </p>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Order Details -->
            <div style="margin: 15px 0;">
                <div style="font-size: 12px; font-weight: 600; color: #2563eb; margin-bottom: 8px; padding-bottom: 3px; border-bottom: 1px solid #dbeafe;">Order Details</div>
                <table style="width: 100%; border-collapse: collapse;">
                    <tr>
                        <th style="border: 1px solid #e2e8f0; padding: 6px 10px; font-size: 9px; background-color: #dbeafe; color: #2563eb; font-weight: 600; text-align: left;">Description</th>
                        <th style="border: 1px solid #e2e8f0; padding: 6px 10px; font-size: 9px; background-color: #dbeafe; color: #2563eb; font-weight: 600; text-align: left;">Details</th>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #e2e8f0; padding: 6px 10px; font-size: 9px; vertical-align: top;">Order ID</td>
                        <td style="border: 1px solid #e2e8f0; padding: 6px 10px; font-size: 9px; vertical-align: top;">' . htmlspecialchars($id) . '</td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #e2e8f0; padding: 6px 10px; font-size: 9px; vertical-align: top;">User ID</td>
                        <td style="border: 1px solid #e2e8f0; padding: 6px 10px; font-size: 9px; vertical-align: top;">' . htmlspecialchars($id) . '</td>
                    </tr>
                    
                    <tr>
                        <td style="border: 1px solid #e2e8f0; padding: 6px 10px; font-size: 9px; vertical-align: top;">Subtotal</td>
                        <td style="border: 1px solid #e2e8f0; padding: 6px 10px; font-size: 9px; vertical-align: top;"><strong>' . htmlspecialchars(number_format($subtotal, 2)) . ' €</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #e2e8f0; padding: 6px 10px; font-size: 9px; vertical-align: top;">VAT (21%)</td>
                        <td style="border: 1px solid #e2e8f0; padding: 6px 10px; font-size: 9px; vertical-align: top;"><strong>' . htmlspecialchars(number_format($tax, 2)) . ' €</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #e2e8f0; padding: 6px 10px; font-size: 9px; vertical-align: top;">Total</td>
                        <td style="border: 1px solid #e2e8f0; padding: 6px 10px; font-size: 9px; vertical-align: top;"><strong>' . htmlspecialchars(number_format($totalWithTax, 2)) . ' €</strong></td>
                    </tr>
                    <tr>
                        <td style="border: 1px solid #e2e8f0; padding: 6px 10px; font-size: 9px; vertical-align: top;">Payment Status</td>
                        <td style="border: 1px solid #e2e8f0; padding: 6px 10px; font-size: 9px; vertical-align: top;">
                            <span style="display: inline-block; padding: 3px 8px; border-radius: 12px; background-color: #dbeafe; color: #2563eb; font-weight: 600; font-size: 8px;">' . htmlspecialchars($status) . '</span>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- QR Code Section -->
            <div style="margin: 15px 0; text-align: center; height: 200px;">
                <div style="font-size: 12px; font-weight: 600; color: #2563eb; margin-bottom: 8px; padding-bottom: 3px; ">Invoice QR Code</div>
                <p style="font-size: 9px; color: #64748b; margin: 0 0 8px 0;">Scan to view invoice details</p>
            </div>

            <!-- Footer -->
            <div style="text-align: center; margin-top: 100px; padding-top: 200px; font-size: 9px; color: #64748b;">
                <p style="margin: 3px 0; font-weight: 600; color: #2563eb;">Thank you for your business!</p>
                <p style="margin: 3px 0;">For inquiries, please contact us at ' . htmlspecialchars($companyEmail) . '</p>
                <p style="margin: 3px 0;">' . htmlspecialchars($companyName) . ' © ' . date('Y') . '</p>
            </div>
        </div>';

        // Write HTML content to PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Add QR code (centered horizontally, placed below QR Code section)
        $pdf->write2DBarcode($qrCodeString, 'QRCODE,H', 85, 140, 40, 40, [
            'border' => false,
            'padding' => 0,
            'fgcolor' => [0, 0, 0],
            'bgcolor' => [255, 255, 255]
        ], 'N');

        return $pdf;

    }


    public function createTickets($order)
    {
        // Get payment status
        try {
            $payment = $this->mollie->payments->get($order->getPaymentId());
            $status = $payment->status;
        } catch (\Exception $e) {
            $status = 'Unknown';
        }

        $companyName = 'Orders CMS';
        $companyAddress = '123 Business Street';
        $companyCity = 'City, Country, 12345';
        $companyEmail = 'info@orderscms.com';
        $companyPhone = '+123-456-7890';

        $id = (string)$order->getId();

        $orderItems = $this->orderService->getOrderItemsByOrderId($id);

        require_once __DIR__ . '/../vendor/tecnickcom/tcpdf/tcpdf.php';

        $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Orders CMS');
        $pdf->SetTitle('Ticket #' . $id);
        $pdf->SetSubject('Order Ticket');
        $pdf->SetKeywords('Ticket, Order, PDF');

        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        $pdf->SetMargins(10, 5, 10);
        $pdf->SetAutoPageBreak(true, 10); // Enable auto page break to handle long content

        $pdf->SetFont('helvetica', '', 9);

        $pdf->AddPage();

        $html = '<div style="width: 100%; max-width: 600px; margin: 0 auto; color: #1e293b; background-color: white; padding: 20px;">
            <!-- Header -->
            <div style="margin-bottom: 15px; padding-bottom: 10px; border-bottom: 1px solid #e2e8f0;">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="width: 50%;">
                            <h1 style="font-size: 22px; font-weight: 700; color: #2563eb; margin: 0;">Tickets</h1>
                        </td>
                        <td style="width: 50%; text-align: right; font-size: 9px; color: #64748b;">
                            <div style="font-size: 12px; font-weight: 600; margin-bottom: 3px;">Ticket #' . htmlspecialchars($id) . '</div>
                            <div>Date: ' . date('Y-m-d') . '</div>
                            <div>Order ID: ' . htmlspecialchars($id) . '</div>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Info Sections -->
            <div style="margin-bottom: 15px;">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <!-- Company Information -->
                        <td style="width: 50%; vertical-align: top; padding-right: 10px;">
                            <div style="font-size: 12px; font-weight: 600; color: #2563eb; margin-bottom: 8px; padding-bottom: 3px; border-bottom: 1px solid #dbeafe;">From</div>
                            <p style="font-size: 9px; line-height: 1.4; margin: 0 0 8px 0;">
                                <strong style="color: #1e293b; font-weight: 600;">' . htmlspecialchars($companyName) . '</strong><br>
                                ' . htmlspecialchars($companyAddress) . '<br>
                                ' . htmlspecialchars($companyCity) . '<br>
                                Email: ' . htmlspecialchars($companyEmail) . '<br>
                                Phone: ' . htmlspecialchars($companyPhone) . '
                            </p>
                        </td>
                        <!-- Customer Information -->
                        <td style="width: 50%; vertical-align: top; padding-left: 10px;">
                            <div style="font-size: 12px; font-weight: 600; color: #2563eb; margin-bottom: 8px; padding-bottom: 3px; border-bottom: 1px solid #dbeafe;">Bill To</div>
                            <p style="font-size: 9px; line-height: 1.4; margin: 0 0 8px 0;">
                                <strong style="color: #1e293b; font-weight: 600;">' . htmlspecialchars($order->getFirstName() . ' ' . $order->getLastName()) . '</strong><br>
                                ' . htmlspecialchars($order->getStreetAddress()) . '<br>
                                ' . htmlspecialchars($order->getCountry() . ', ' . $order->getZipCode()) . '<br>
                                Email: ' . htmlspecialchars($order->getEmailAddress()) . '<br>
                                Phone: ' . htmlspecialchars($order->getPhoneNumber()) . '
                            </p>
                        </td>
                    </tr>
                </table>
            </div>

            <!-- Ticket Details -->
            <div style="margin: 15px 0;">
                <div style="font-size: 12px; font-weight: 600; color: #2563eb; margin-bottom: 8px; padding-bottom: 3px; border-bottom: 1px solid #dbeafe;">Ticket Details</div>';

        foreach ($orderItems as $index => $item) {
            $ticket = $this->orderService->getProductInfo($item->getProduct_id());
            $eventName = $ticket[0]['event_name'];
            $eventDateTime = $ticket[0]['event_datetime'];

            // Generate UUID for QR code (using the first ticket for a single QR code)
            if ($index === 0) {
                $registry = $this->ticketService->createTicket();
                $uuid = $registry->getUuid();

                // Prepare QR code data
                $qrData = [
                    'Email' => $order->getEmailAddress(),
                    'Name' => $order->getFirstName() . ' ' . $order->getLastName(),
                    'Order ID' => $id,
                    'Event Name' => $eventName,
                    'Event Date' => $eventDateTime,
                    'Ticket UUID' => $uuid
                ];
                $qrCodeString = implode("\n", array_map(function ($key, $value) {
                    return "$key: $value";
                }, array_keys($qrData), $qrData));
            }

            // Add ticket details to HTML
            $html .= '<div style="margin-bottom: 20px;">
                    <p style="font-size: 9px; line-height: 1.4; margin: 0 0 4px 0;"><strong>Event Name:</strong> ' . htmlspecialchars($eventName) . '</p>
                    <p style="font-size: 9px; line-height: 1.4; margin: 0 0 4px 0;"><strong>Date & Time:</strong> ' . htmlspecialchars($eventDateTime) . '</p>
                    <p style="font-size: 9px; line-height: 1.4; margin: 0 0 4px 0;"><strong>Ticket UUID:</strong> ' . htmlspecialchars($uuid ?? '') . '</p>
                  </div>';

            // Add separator line
            if ($index < count($orderItems) - 1) {
                $html .= '<hr style="border: 1px solid #e2e8f0; margin: 15px 0;">';
            }


        }

        $html .= '</div>

            <!-- Footer -->
            <div style="text-align: center; margin-top: 15px; padding-top: 10px; border-top: 1px solid #e2e8f0; font-size: 9px; color: #64748b;">
                <p style="margin: 3px 0; font-weight: 600; color: #2563eb;">Enjoy the Event!</p>
                <p style="margin: 3px 0;">For inquiries, please contact us at ' . htmlspecialchars($companyEmail) . '</p>
                <p style="margin: 3px 0;">' . htmlspecialchars($companyName) . ' © ' . date('Y') . '</p>
            </div>
        </div>';


        // Write HTML content to PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Add QR code at bottom left beside Ticket Details
        $currentY = $pdf->getY();
        $pdf->write2DBarcode($qrCodeString, 'QRCODE,H', 150, $currentY - 80, 30, 30, [
            'border' => 2,
            'vpadding' => 'auto',
            'hpadding' => 'auto',
            'fgcolor' => [0, 0, 0],
            'bgcolor' => false,
            'module_width' => 1,
            'module_height' => 1
        ], 'N');

        return $pdf;
    }


    /**
     * Summary of createinvoicecsv
     * @return never
     */
    public function createinvoicecsv()
    {
        $orders = $this->orderService->getAllOrders();

        if (empty($orders)) {
            echo "<script>sessionStorage.setItem('error', 'Can not find order data to export!'); window.location = '/admin/orders/list';</script>";
            exit;
        }

        header('Content-Type: text/csv; charset=utf-8');
        header('Content-Disposition: attachment; filename="orders_invoice_' . date('Ymd_His') . '.csv"');
        header('Cache-Control: no-cache, no-store, must-revalidate');
        header('Pragma: no-cache');
        header('Expires: 0');

        $output = fopen('php://output', 'w');

        fprintf($output, chr(0xEF) . chr(0xBB) . chr(0xBF));

        $headers = [
            'ID',
            'First Name',
            'Last Name',
            'Email Address',
            'Street Address',
            'Country',
            'Zip Code',
            'Phone Number',
            'User ID',
            'Total Price',
            'Payment Status'
        ];

        fputcsv($output, $headers, ',', '"', '\\');

        foreach ($orders as $order) {
            try {
                $payment = $this->mollie->payments->get($order->getPaymentId());
                $status = $payment->status;
            } catch (\Exception $e) {
                $status = 'Unknown';
            }

            $row = [
                $order->getId(),
                $order->getFirstName(),
                $order->getLastName(),
                $order->getEmailAddress(),
                $order->getStreetAddress(),
                $order->getCountry(),
                $order->getZipCode(),
                $order->getPhoneNumber(),
                $order->getUserId(),
                $order->getTotalPrice(),
                $status
            ];

            fputcsv($output, $row, ',', '"', '\\');

        }

        fclose($output);
        exit;
    }

}