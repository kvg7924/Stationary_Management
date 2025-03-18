<?php
// Include database connection and common functions
include("./includes/connect.php");
include("./functions/common_functions.php");

// Start the session
session_start();

// Function to get the number of items in the cart
function get_cart_item_count() {
    // Logic to fetch cart item count from the database or session
    if (isset($_SESSION['cart'])) {
        return count($_SESSION['cart']);
    }
    return 0;
}

// Function to calculate the total price of items in the cart
function calculate_total_cart_price() {
    // Logic to calculate the total price
    $total = 0;
    if (isset($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            $total += $item['price'] * $item['quantity'];
        }
    }
    return $total;
}

// Function to display product details
function viewDetails() {
    // Logic to fetch and display product details
    if (isset($_GET['product_id'])) {
        $product_id = $_GET['product_id'];
        // Fetch product details from the database
        // Display the details
    }
}

// Function to fetch related products
function getProduct($limit) {
    // Logic to fetch related products from the database
    $query = "SELECT * FROM products LIMIT $limit";
    // Execute query and display products
}

// Handle adding items to the cart
function cart() {
    // Logic to add items to the cart
    if (isset($_POST['add_to_cart'])) {
        $product_id = $_POST['product_id'];
        // Add product to the cart session
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