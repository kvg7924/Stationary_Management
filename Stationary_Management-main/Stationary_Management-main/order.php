<?php
include('../includes/connect.php');
include('../functions/common_functions.php');

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];
}

$get_ip_address = getIPAddress();
$total_price = 0;
$cart_query = "SELECT * FROM `card_details` WHERE ip_address= '$get_ip_address'";
$cart_result = mysqli_query($con, $cart_query);
$invoice_number = mt_rand();
$status = "pending";
$count_products = mysqli_num_rows($cart_result);
?>
