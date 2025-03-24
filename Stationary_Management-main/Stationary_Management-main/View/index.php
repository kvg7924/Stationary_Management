<?php
include('../Models/connect.php');
include('../Models/common_functions.php');

session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stationary Online Shop</title>
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/main.css" />
</head>

<body>


    <?php include("../Helpers/execution_time.php"); ?>


    <!-- upper-nav -->
    <div class="upper-nav primary-bg p-2 px-3 text-center text-break">
        <span>Back to School Sale on All Stationery & Free Express Delivery! - OFF 50%! </span>
    </div>
    <!-- upper-nav -->
    <!-- Start NavBar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand fw-bold" href="./index.php">Stationery Shop</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./products.php">Products</a>
                    </li>


                    <?php
                    if (isset($_SESSION['username'])) {
                        echo "
                            <li class='nav-item'>
                            <a class='nav-link' href='./profile.php'>My Account</a>
                        </li>";
                    } else {
                        echo "
                            <li class='nav-item'>
                            <a class='nav-link' href='../Controllers/User_actions/user_registration.php'>Register</a>
                        </li>";
                    }
                    ?>
                </ul>
                <form action="./search_product.php" class="d-flex">

                    <button class="btn btn-outline-primary" type="submit">Search Product</button>
                </form>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="./cart.php"><svg width="28" height="28" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 27C11.5523 27 12 26.5523 12 26C12 25.4477 11.5523 25 11 25C10.4477 25 10 25.4477 10 26C10 26.5523 10.4477 27 11 27Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M25 27C25.5523 27 26 26.5523 26 26C26 25.4477 25.5523 25 25 25C24.4477 25 24 25.4477 24 26C24 26.5523 24.4477 27 25 27Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M3 5H7L10 22H26" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M10 16.6667H25.59C25.7056 16.6667 25.8177 16.6267 25.9072 16.5535C25.9966 16.4802 26.0579 16.3782 26.0806 16.2648L27.8806 7.26479C27.8951 7.19222 27.8934 7.11733 27.8755 7.04552C27.8575 6.97371 27.8239 6.90678 27.7769 6.84956C27.73 6.79234 27.6709 6.74625 27.604 6.71462C27.5371 6.68299 27.464 6.66661 27.39 6.66666H8" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <sup>
                                <?php
                                cart_item();
                                ?>
                            </sup>
                            <span class="d-none">
                                Total Price is:
                                <?php
                                total_cart_price();
                                ?>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" class="d-flex align-items-center gap-1" href="#">
                            <svg width="28" height="28" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24 27V24.3333C24 22.9188 23.5224 21.5623 22.6722 20.5621C21.8221 19.5619 20.669 19 19.4667 19H11.5333C10.331 19 9.17795 19.5619 8.32778 20.5621C7.47762 21.5623 7 22.9188 7 24.3333V27" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16.5 14C18.9853 14 21 11.9853 21 9.5C21 7.01472 18.9853 5 16.5 5C14.0147 5 12 7.01472 12 9.5C12 11.9853 14.0147 14 16.5 14Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <?php
                            if (!isset($_SESSION['username'])) {
                                echo "<span>
                                    Welcome guest
                                </span>";
                            } else {
                                echo "<span>
                                    Welcome " . $_SESSION['username'] . "</span>";
                            }
                            ?>
                        </a>
                    </li>
                    <?php
                    if (!isset($_SESSION['username'])) {
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='../Controllers/User_actions/user_login.php'>
                            Login
                        </a>
                    </li>";
                    } else {
                        echo "<li class='nav-item'>
                        <a class='nav-link' href='../Controllers/User_actions/logout.php'>
                            Logout
                        </a>
                    </li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End NavBar -->

    <!-- Start Landing Section -->
    <div class="landing">
        <div class="container">
            <div class="row m-0">
                <div class="col-lg-3 col-md-3 col-sm-12 col-xs-12 p-md-0 tabs-categ">
                    <ul class="p-md-0 d-flex flex-column gap-3 pt-md-3">
                        <li><b>Our Products</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        </li>
                        <a href="http://localhost/Stationery_git/Stationary_Management-main/Stationary_Management-main/Stationary_Management-main/View/products.php?category=7">
                            <li>Calculator</li>
                        </a>
                        <a href="http://localhost/Stationery_git/Stationary_Management-main/Stationary_Management-main/Stationary_Management-main/View/products.php?category=2">
                            <li>Books</li>
                        </a>
                        <a href="http://localhost/Stationery_git/Stationary_Management-main/Stationary_Management-main/Stationary_Management-main/View/products.php?category=1">
                            <li>Notebooks</li>
                        </a>
                        <a href="http://localhost/Stationery_git/Stationary_Management-main/Stationary_Management-main/Stationary_Management-main/View/products.php?category=8">
                            <li>Pencils</li>
                        </a>
                        <a href="http://localhost/Stationery_git/Stationary_Management-main/Stationary_Management-main/Stationary_Management-main/View/products.php?category=5">
                            <li>Pens</li>
                        </a>
                        <a href="http://localhost/Stationery_git/Stationary_Management-main/Stationary_Management-main/Stationary_Management-main/View/products.php?category=6">
                            <li>Art & Craft</li>
                        </a>

                    </ul>
                </div>
                <div class="col-lg-9 col-md-9 d-none d-sm-none d-md-block pt-md-4">
                    <div class="cover">



                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Landing Secti on -->
    <!-- Start Category  -->
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

                <a href="http://localhost/Stationery_git/Stationary_Management-main/Stationary_Management-main/Stationary_Management-main/View/products.php?category=7">
                    <div class="card">
                        <span>
                            <svg
                                width="60"
                                height="60"
                                viewBox="0 0 55 55"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="14" y="6" width="30" height="44" rx="3" stroke="black" stroke-width="2" />
                                <line x1="25.5" y1="7" x2="31.5" y2="7" stroke="black" stroke-width="3" stroke-linecap="round" />
                                <circle cx="28" cy="44" r="1.5" fill="black" />
                                <line x1="15" y1="39.8" x2="41" y2="39.8" stroke="black" stroke-width="2" />
                            </svg>


                        </span>
                        <span>Calculators</span>
                    </div>
                </a>
                <a href="http://localhost/Stationery_git/Stationary_Management-main/Stationary_Management-main/Stationary_Management-main/View/products.php?category=2">
                    <div class="card">

                        <span>
                            <svg
                                width="60"
                                height="60"
                                viewBox="0 0 55 55"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 8H40C42.21 8 44 9.79 44 12V42C44 44.21 42.21 46 40 46H10" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M10 8V46" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M44 12V42" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <line x1="10" y1="22" x2="44" y2="22" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>


                        </span>
                        <span>Books</span>
                    </div>
                </a>

                <a href="http://localhost/Stationery_git/Stationary_Management-main/Stationary_Management-main/Stationary_Management-main/View/products.php?category=1">
                    <div class="card">
                        <sp>
                            <svg
                                width="60"
                                height="60"
                                viewBox="0 0 55 55"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <rect x="10" y="8" width="30" height="40" rx="3" stroke="black" stroke-width="2" />
                                <line x1="15" y1="8" x2="15" y2="48" stroke="black" stroke-width="2" stroke-linecap="round" />
                                <line x1="20" y1="12" x2="35" y2="12" stroke="black" stroke-width="2" stroke-linecap="round" />
                                <line x1="20" y1="18" x2="35" y2="18" stroke="black" stroke-width="2" stroke-linecap="round" />
                                <line x1="20" y1="24" x2="35" y2="24" stroke="black" stroke-width="2" stroke-linecap="round" />
                            </svg><br>




                            </span>
                            <span>Notebooks</span>
                    </div>
                </a>

                <a href="http://localhost/Stationery_git/Stationary_Management-main/Stationary_Management-main/Stationary_Management-main/View/products.php?category=8">
                    <div class="card">
                        <span>
                            <svg
                                width="60"
                                height="60"
                                viewBox="0 0 55 55"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M10 45L15 50L35 30L30 25L10 45Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M30 25L35 20L40 25L35 30L30 25Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M40 25L45 20L35 10L30 15L40 25Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>

                        </span>
                        <span>Pencils</span>
                    </div>
                </a>
                <a href="http://localhost/Stationery_git/Stationary_Management-main/Stationary_Management-main/Stationary_Management-main/View/products.php?category=5">
                    <div class="card">
                        <span>
                            <svg
                                width="60"
                                height="60"
                                viewBox="0 0 55 55"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M15 40L10 45L15 50L35 30L30 25L15 40Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M30 25L40 15L45 20L35 30L30 25Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M40 15L42 5L50 10L45 20L40 15Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>




                        </span>
                        <span>Pens</span>
                    </div>
                </a>
                <a href="http://localhost/Stationery_git/Stationary_Management-main/Stationary_Management-main/Stationary_Management-main/View/products.php?category=6">
                    <div class="card">
                        <span>
                            <svg
                                width="60"
                                height="60"
                                viewBox="0 0 55 55"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path d="M20 10L10 20L20 30L30 20L20 10Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M35 25L45 15L50 20L40 30L35 25Z" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                <circle cx="27" cy="40" r="6" stroke="black" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>


                        </span>
                        <span>Art & Crafts</span>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- End Category  -->
    <!-- Start Advertise  -->
    <div class="adver">
        <div class="container">

        </div>
    </div>
    <!-- End Advertise  -->
    <!-- Start Products  -->
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
    <!-- End Products  -->

    <script src="./js/bootstrap.bundle.js"></script>
</body>

</html>