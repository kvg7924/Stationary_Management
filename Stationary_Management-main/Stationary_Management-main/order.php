<?php
include('../includes/connect.php');
include('../functions/common_functions.php');

if(isset($_GET['user_id'])){
    $user_id = $_GET['user_id'];

}

$get_ip_address = getIPAddress();
$total_price = 0;
$cart_query = "SELECT * FROM `card_details` WHERE ip_address= '$get_ip_address'";
$cart_result = mysqli_query($con,$cart_query);
$invoice_number = mt_rand();
$status = "pending";
$count_products = mysqli_num_rows($cart_result);
while($row_price=mysqli_fetch_array($cart_result)){
    $product_id = $row_price['product_id'];
    $product_quantity = $row_price['quantity']; // quantity of each product 
    $select_product = "SELECT * FROM `products` WHERE product_id= $product_id";
    $select_product_result = mysqli_query($con,$select_product);
    // getting total sum of all products
    while($row_product_price=mysqli_fetch_array($select_product_result)){
        $product_price = array($row_product_price['product_price']);
        $product_values = array_sum($product_price) * $product_quantity;
        $total_price+=$product_values;
        echo "Product Values" .  $product_values."<br/>";
        echo "Total Price" .  $total_price."<br/>";
        echo "Qauntity" .  $product_quantity."<br/>";
    }
    //Ordes Pending
    $insert_pending_order_query = "INSERT INTO `orders_pending` (user_id,invoice_number,product_id,quantity,order_status) VALUES ($user_id,$invoice_number,$product_id,$product_quantity,'$status')";
    $insert_pending_order_result = mysqli_query($con,$insert_pending_order_query);
}