<?php
// Final cleanup: includes, session start, and streamlined code.
include('./includes/connect.php');
include('./functions/common_functions.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Home Page</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css" />
    <link rel="stylesheet" href="./assets/css/main.css" />
</head>
<body>
    <!-- Upper Navigation -->
    <div class="upper-nav primary-bg p-2 px-3 text-center text-break">
        <span>Summer Sale For All Swim Suits And Free Express Delivery - OFF 50%! <a href="#">Shop Now</a></span>
    </div>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">A1</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" 
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link active" href="./index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="./products.php">Products</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                    <?php
                    if(isset($_SESSION['username'])) {                            
                        echo "<li class='nav-item'><a class='nav-link' href='./users_area/profile.php'>My Account</a></li>";
                    } else {
                        echo "<li class='nav-item'><a class='nav-link' href='./users_area/user_registration.php'>Register</a></li>";
                    }
                    ?>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="./cart.php">
                            <svg width="28" height="28" viewBox="0 0 32 32" fill="none">
                                <!-- SVG paths here -->
                            </svg>
                            <sup><?php cart_item(); ?></sup>
                            <span class="d-none">Total Price is: <?php total_cart_price(); ?></span>
                        </a>
                    </li>
                    <?php
                    if(!isset($_SESSION['username'])) {
                        echo "<li class='nav-item'><a class='nav-link' href='./users_area/user_login.php'>Login</a></li>";
                    } else {
                        echo "<li class='nav-item'><a class='nav-link' href='./users_area/logout.php'>Logout</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- Landing Section -->
    <div class="landing">
        <div class="container">
            <div class="row m-0">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-md-0 tabs-categ">
                    <ul class="p-md-0 d-flex flex-column gap-3 pt-md-3">
                        <li>Stationary ></li>
                        <li>Scientific calculator ></li>
                        <li>Pencils ></li>
                        <li>Pens ></li>
                        <li>Books ></li>
                        <li>Sports & Outdoor ></li>
                        <li>Notebooks ></li>
                    </ul>
                </div>
                <div class="col-lg-9 col-md-9 d-none d-sm-none d-md-block pt-md-4">
                    <div class="cover">
                        <!-- Cover content placeholder -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Category Section -->
    <div class="category">
        <div class="container">
            <div class="categ-header">
                <div class="sub-title">
                    <span class="shape"></span>
                    <span class="title">Categories</span>
                </div>
                <h2>Browse By Category</h2>
            </div>
            <div class="cards">
                <div class="card">
                    <span><!-- SVG for Phones --></span>
                    <span>Phones</span>
                </div>
                <div class="card">
                    <span><!-- SVG for Computers --></span>
                    <span>Computers</span>
                </div>
                <div class="card">
                    <span><!-- SVG for SmartWatch --></span>
                    <span>SmartWatch</span>
                </div>
                <div class="card">
                    <span><!-- SVG for Camera --></span>
                    <span>Camera</span>
                </div>
                <div class="card">
                    <span><!-- SVG for Gaming --></span>
                    <span>Gaming</span>
                </div>
                <div class="card">
                    <span><!-- SVG for HeadPhones --></span>
                    <span>HeadPhones</span>
                </div>
            </div>
        </div>
    </div>
    <!-- Advertise Section -->
    <div class="adver">
        <div class="container">
            <div class="cover">
                <button onclick="location.href='#'">Buy Now!</button>
            </div>
        </div>
    </div>
    <!-- Products Section -->
    <div class="products">
        <div class="container">
            <div class="categ-header">
                <div class="sub-title">
                    <span class="shape"></span>
                    <span class="title">Our Products</span>
                </div>
                <h2>Explore Our Products</h2>
            </div>
            <div class="row mb-3">
                <?php
                getProduct(3);
                getIPAddress();
                ?>
            </div>
            <div class="view d-flex justify-content-center align-items-center">
                <button onclick="location.href='./products.php'">View All Products</button>
            </div>
        </div>
    </div>
    <script src="./assets/js/bootstrap.bundle.js"></script>
</body>
</html>
