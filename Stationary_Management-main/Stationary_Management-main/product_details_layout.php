<?php
include("./includes/connect.php");
include("./functions/common_functions.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Products</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css" />
    <link rel="stylesheet" href="./assets/css/main.css" />
</head>

<body>
    <!-- Loading Spinner -->
    <div class="loading-spinner" id="loadingSpinner">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Upper Navigation -->
    <div class="upper-nav primary-bg p-2 px-3 text-center text-break">
        <span>Summer Sale For All Swim Suits And Free Express Delivery - OFF 50%! <a>Shop Now</a></span>
    </div>

    <!-- Start NavBar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand fw-bold" href="#">A1</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
            <li class="nav-item"><a class="nav-link" href="./index.php">Home</a></li>
            <li class="nav-item"><a class="nav-link active" href="./products.php">Products</a></li>
            <li class="nav-item"><a class="nav-link" href="#">About</a></li>
            <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
            <?php
            if (isset($_SESSION['username'])) {
                echo "<li class='nav-item'><a class='nav-link' href='./users_area/profile.php'>My Account</a></li>";
            } else {
                echo "<li class='nav-item'><a class='nav-link' href='./users_area/user_registration.php'>Register</a></li>";
            }
            ?>
        </ul>

        <form class="d-flex">
            <input class="form-control me-2" type="search" placeholder="Search">
            <button class="btn btn-outline-primary" type="submit">Search</button>
        </form>

        <ul class="navbar-nav mb-2 mb-lg-0">
            <li class="nav-item">
                <a class="nav-link" href="./cart.php">
                    🛒 Cart <sup><?php echo get_cart_item_count(); ?></sup>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    👤 <?php echo isset($_SESSION['username']) ? "Welcome " . $_SESSION['username'] : "Welcome guest"; ?>
                </a>
            </li>
            <?php
            if (isset($_SESSION['username'])) {
                echo "<li><a class='dropdown-item' href='./users_area/profile.php'>Profile</a></li>";
                echo "<li><a class='dropdown-item' href='./users_area/logout.php'>Logout</a></li>";
            } else {
                echo "<li><a class='dropdown-item' href='./users_area/user_login.php'>Login</a></li>";
            }
            ?>
        </ul>
    </nav>
