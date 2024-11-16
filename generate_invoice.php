<?php
require_once('tcpdf/tcpdf.php');
include 'connection.php'; 

$orderId = $_GET['order_id'];

$query = "SELECT p.order_id, p.payment_method, p.payment_status, p.delivery_id, p.order_status, p.order_creation_date, p.order_information,
            c.total_price AS total_price, c.quantity, c.total_price AS item_price, pr.name AS product_name, pr.product_images, 
            cat.category_name
            FROM payment p
            JOIN cart c ON p.cart_id = c.cart_id
            JOIN products pr ON c.product_id = pr.product_id
            JOIN category cat ON pr.category_id = cat.category_id
            WHERE p.order_id = ?
            GROUP BY c.cart_id";

$stmt = $conn->prepare($query);
$stmt->bind_param("i", $orderId);
$stmt->execute();
$result = $stmt->get_result();

$totalPrice = 0;

$pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Liriko');
$pdf->SetTitle('Invoice Receipt');
$pdf->SetSubject('Invoice Receipt');
$pdf->SetKeywords('Invoice, Receipt, TCPDF, PHP');
$pdf->SetMargins(10, 0, 10);
$pdf->SetHeaderMargin(0);
$pdf->SetFooterMargin(0);
$pdf->setPrintHeader(false);
$pdf->AddPage();
$pdf->SetFont('helvetica', '', 10);
$imagePath = 'Images\Logo\Edumart Black Logo.png';
$pdf->Image($imagePath, 10, 5, 50, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false);

if ($row = $result->fetch_assoc()) {
    $invoiceContent = <<<EOT
    <style>
        .invoice-header {
            background-color: #f2f2f2;
            padding: 10px;
            text-align: center;
            margin-bottom 0;
        }
        .order-details th {
            background-color: #f2f2f2;
            padding: 5px;
            Text-align: center;
            border: 1px solid #dddddd;
        }
        .order-details td {
            padding: 5px;
            border: 1px solid #dddddd;
            text-align: center; /* Center align text in table cells */
            vertical-align: middle; /* Align text vertically in table cells */
        }
        .order-details img {
            max-width: 80px; /* Limit image width */
            max-height: 80px; /* Limit image height */
            display: block; /* Prevent images from overlapping table border */
            margin: 0 auto; /* Center align images */
        }
    </style>
    <div class="invoice-header">
        <h1 class="mb-4"></h1>
    </div>
    <h2 class="mt-4">Buyer Details</h2>
        <p><strong>Order ID:</strong> {$row['order_id']}</p>
        <p><strong>Order Creation Date:</strong> {$row['order_creation_date']}</p>
        <p><strong>Payment Method:</strong> {$row['payment_method']}</p>
        <p><strong>Payment Status:</strong> {$row['payment_status']}</p>
        <p><strong>Delivery ID:</strong> {$row['delivery_id']}</p>
       <p><strong>Order Status:</strong> {$row['order_status']}</p>
    EOT;
    $info = json_decode($row['order_information'], true);

    if (!empty($info)) {
        $invoiceContent .= <<<EOT
            <p><strong>Recipient's Name:</strong> {$info['firstname']} {$info['lastname']}</p>
            <p><strong>Contact Number:</strong> {$info['contactnumber']}</p>
            <p><strong>Recipient's Address:</strong> {$info['address']} {$info['regionstate']} {$info['country']} {$info['postcode']}</p>
            <p><strong>Note of Buyer:</strong> {$info['note']}</p>
        EOT;
    }

    $invoiceContent .= <<<EOT
    <hr>
    <div class="invoice-section">
        <h2 class="mt-4"> Order Details </h2>
        <table class="table table-bordered order-details">
            <thead>
                <tr>
                    <th> Product Image </th>
                    <th> Category </th>
                    <th> Product Name </th>
                    <th> Quantity </th>
                    <th> Item Price </th>
                </tr>
            </thead>
            <tbody>

    EOT;
do {
    $imageNames = json_decode($row['product_images'], true);
    
    if (is_array($imageNames) && !empty($imageNames)) {
        $imageName = $imageNames[0];
        $imagePath = 'admin/php-addons/productimages/' . $imageName;
        
        if (file_exists($imagePath)) {
            list($width, $height) = getimagesize($imagePath);
            $newWidth = 80;
            $newHeight = intval($height * ($newWidth / $width));
            $invoiceContent .= <<<EOT
            <tr>
                <td> <img src="{$imagePath}" width="{$newWidth}" height="{$newHeight}"> </td>
                <td> {$row['category_name']} </td>
                <td> {$row['product_name']} </td>
                <td> {$row['quantity']} </td>
                <td> {$row['item_price']} </td>
            </tr>
            EOT;
        } else {

            $invoiceContent .= <<<EOT
            <tr>
                <td>No Image Available</td>
                <td>{$row['category_name']}</td>
                <td>{$row['product_name']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['item_price']}</td>
            </tr>
            EOT;
        }
    } else {

        $invoiceContent .= <<<EOT
        <tr>
            <td>No Image Available</td>
            <td> {$row['category_name']} </td>
            <td> {$row['product_name']} </td>
            <td> {$row['quantity']} </td>
            <td> {$row['item_price']} </td>
        </tr>
        EOT;
    }

    $totalPrice += $row['total_price'];
} while ($row = $result->fetch_assoc());

    $invoiceContent .= <<<EOT
            <tr>
                <td colspan="4" style="text-align:right;"><strong>      Total Price:    </strong></td>
                <td>{$totalPrice}</td> 
            </tr>
        </tbody>
    </table>
</div>
EOT;
}

$pdf->writeHTML($invoiceContent, true, false, true, false, '');


$pdf->SetFont('helvetica', 'B,I', 8); 
$pdf->Cell(0, 10, 'Copyright ©2024. Edumart Philippines. All Rights Reserved.', 0, false, 'C', 0, '', 0, false, 'T', 'M');

$pdf->Output('invoice_receipt.pdf', 'I');
?>
