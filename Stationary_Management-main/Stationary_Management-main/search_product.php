<?php
// Include database connection and common functions
include("./includes/connect.php");
include("./functions/common_functions.php");

// Start the session
session_start();

function get_cart_item_count() {
    if (isset($_SESSION['cart'])) {
        return count($_SESSION['cart']);
    }
    return 0;
}

function calculate_total_cart_price() {
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    }
    return $total;
}

function viewDetails() {
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
    }
}

// Function to fetch related products
function getProduct($limit) {
    $query = "SELECT * FROM products LIMIT $limit";
}

// Handle adding items to the cart
function cart() {
    if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
    }
}

// Function to get total number of products for pagination
function getTotalProducts() {
    global $con;
    $query = "SELECT COUNT(*) as total FROM products";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
    return $row['total'];
}
?>