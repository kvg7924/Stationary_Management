<?php
include('../../Models/connect.php');
include('../../Models/common_functions.php');

// Include PHPMailer
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../../Helpers/PHPMailer/src/Exception.php';
require '../../Helpers/PHPMailer/src/PHPMailer.php';
require '../../Helpers/PHPMailer/src/SMTP.php';

if (isset($_GET['user_id'])) {
    $user_id = $_GET['user_id'];
}

$get_ip_address = getIPAddress();
$total_price = 0;
$cart_query = "SELECT * FROM `card_details` WHERE ip_address= '$get_ip_address'";
$cart_result = mysqli_query($con, $cart_query);

if (!$cart_result) {
    die("Error fetching cart details: " . mysqli_error($con));
}

$invoice_number = mt_rand();
$status = "pending";
$count_products = mysqli_num_rows($cart_result);

while ($row_price = mysqli_fetch_array($cart_result)) {
    $product_id = $row_price['product_id'];
    $product_quantity = $row_price['quantity']; // quantity of each product
    $select_product = "SELECT * FROM `products` WHERE product_id= $product_id";
    $select_product_result = mysqli_query($con, $select_product);

    if (!$select_product_result) {
        die("Error fetching product details: " . mysqli_error($con));
    }

    // Calculate total price
    while ($row_product_price = mysqli_fetch_array($select_product_result)) {
        $product_price = array($row_product_price['product_price']);
        $product_values = array_sum($product_price) * $product_quantity;
        $total_price += $product_values;
        echo "Product Values: " . $product_values . "<br/>";
        echo "Total Price: " . $total_price . "<br/>";
        echo "Quantity: " . $product_quantity . "<br/>";
    }

    // Insert into orders_pending
    $insert_pending_order_query = "INSERT INTO `orders_pending` (user_id, invoice_number, product_id, quantity, order_status) VALUES ($user_id, $invoice_number, $product_id, $product_quantity, '$status')";
    $insert_pending_order_result = mysqli_query($con, $insert_pending_order_query);

    if (!$insert_pending_order_result) {
        die("Error inserting pending order: " . mysqli_error($con));
    }
}

// Insert into user_orders
$insert_order_query = "INSERT INTO `user_orders` (user_id, amount_due, invoice_number, total_products, order_date, order_status) VALUES ($user_id, $total_price, $invoice_number, $count_products, NOW(), '$status')";
$insert_order_result = mysqli_query($con, $insert_order_query);

if ($insert_order_result) {
    // Fetch user email
    $user_email_query = "SELECT user_email FROM `user_table` WHERE user_id = $user_id";
    $user_email_result = mysqli_query($con, $user_email_query);

    if (!$user_email_result) {
        die("Error fetching user email: " . mysqli_error($con));
    }

    $user_email_row = mysqli_fetch_assoc($user_email_result);
    $user_email = $user_email_row['user_email'];

    // Prepare email content
    $subject = "Order Confirmation - Invoice #$invoice_number";
    $body = "
        <h1>Thank you for your order!</h1>
        <p>Your order has been successfully placed. Below are the details:</p>
        <ul>
            <li><strong>Invoice Number:</strong> $invoice_number</li>
            <li><strong>Total Amount:</strong> $$total_price</li>
            <li><strong>Total Products:</strong> $count_products</li>
            <li><strong>Order Status:</strong> $status</li>
        </ul>
        <p>We will process your order shortly.</p>
    ";

    // Send email using PHPMailer
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host       = 'mail.stationerypro.online'; // Outgoing SMTP server
        $mail->SMTPAuth   = true; // Enable SMTP authentication
        $mail->Username   = 'stationerypro@stationerypro.online'; // Your cPanel email address
        $mail->Password   = 'rw@+r&.5Vg~a'; // Your cPanel email password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; // Use SSL/TLS encryption
        $mail->Port       = 465; // SMTP port for SSL/TLS

        // Recipients
        $mail->setFrom('stationerypro@stationerypro.online', 'StationeryPro');
        $mail->addAddress($user_email); // Add a recipient

        // Content
        $mail->isHTML(true); // Set email format to HTML
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
        echo "<script>window.alert('Orders are submitted successfully. Confirmation email sent.');</script>";
    } catch (Exception $e) {
        echo "<script>window.alert('Orders are submitted successfully, but email could not be sent. Error: " . $e->getMessage() . "');</script>";
    }

    echo "<script>window.open('../../View/profile.php','_self');</script>";
} else {
    die("Error inserting order: " . mysqli_error($con));
}

// Delete items from cart
$empty_cart = "DELETE FROM `card_details` WHERE ip_address='$get_ip_address'";
$empty_cart_result = mysqli_query($con, $empty_cart);

if (!$empty_cart_result) {
    die("Error emptying cart: " . mysqli_error($con));
}
?>