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
    <!-- Start NavBar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">A1</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <?php
                    $navLinks = ["Home" => "index.php", "Products" => "products.php", "About" => "#", "Contact" => "#"];
                    foreach ($navLinks as $name => $link) {
                        $activeClass = ($name == 'Products') ? 'active' : '';
                        echo "<li class='nav-item'><a class='nav-link $activeClass' href='./$link'>$name</a></li>";
                    }
                    echo isset($_SESSION['username'])
                        ? "<li class='nav-item'><a class='nav-link' href='./users_area/profile.php'>My Account</a></li>"
                        : "<li class='nav-item'><a class='nav-link' href='./users_area/user_registration.php'>Register</a></li>";
                    ?>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
                </form>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="./cart.php">
                            <svg width="28" height="28" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- Cart Icon -->
                            </svg>
                            <sup><?= get_cart_item_count(); ?></sup>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <svg width="28" height="28" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- User Icon -->
                                </svg>
                            <span><?= isset($_SESSION['username']) ? "Welcome " . $_SESSION['username'] : "Welcome guest"; ?></span>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php
                            if (isset($_SESSION['username'])) {
                                echo "<li><a class='dropdown-item' href='./users_area/profile.php'>Profile</a></li>";
                                echo "<li><a class='dropdown-item' href='./users_area/logout.php'>Logout</a></li>";
                            } else {
                                echo "<li><a class='dropdown-item' href='./users_area/user_login.php'>Login</a></li>";
                            }
                            ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- All Products -->
    <div class="all-prod">
        <div class="container">
            <div class="sub-container pt-4 pb-4">
                <div class="categ-header">
                    <div class="sub-title">
                        <span class="shape"></span>
                        <span class="title">Categories & Brands</span>
                    </div>
                    <h2>Browse By Category & Brand</h2>
                </div>
                <div class="row mx-0">
                    <div class="col-md-2 side-nav p-0">
                    <!-- Sidebar Toggle Button for Mobile -->
                    <button class="btn btn-primary d-md-none mb-3" id="sidebarToggle">
                        Toggle Sidebar
                    </button>
                    <div class="col-md-2 side-nav p-0" id="sideNav">
                        <!-- Brands -->
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item d-flex align-items-center gap-2">
                                <span class="shape"></span>
                                <a href="products.php" class="nav-link fw-bolder nav-title"><h4>Brands</h4></a>
                            </li>
                            <?php getBrands(); ?>
                        </ul>
                        <div class="divider"></div>
                        <!-- Brands -->
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item d-flex align-items-center gap-2">
                                <span class="shape"></span>
                                <a href="products.php" class="nav-link fw-bolder nav-title"><h4>Brands</h4></a>
                            </li>
                            <?php getBrands(); ?>
                        </ul>
                        <div class="divider"></div>       
                        <!-- Categories -->
                        <ul class="navbar-nav me-auto">
                            <li class="nav-item d-flex align-items-center gap-2">
                                <span class="shape"></span>
                                <a href="products.php" class="nav-link fw-bolder nav-title"><h4>Categories</h4></a>
                            </li>
                            <?php getCategories(); ?>
                        </ul>
                    </div>
                    <div class="col-md-10">
                        <!-- Products -->
                        <div class="row">
                            <?php
                            getProduct();
                            filterCategoryProduct();
                            filterBrandProduct();
                            cart();
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./assets/js/bootstrap.bundle.js"></script>
    <script>
        // Toggle sidebar for mobile view
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            const sideNav = document.getElementById('sideNav');
            sideNav.classList.toggle('active');
        });
        // Live search functionality
        document.getElementById('searchBox').addEventListener('input', function() {
            const searchValue = this.value;
            fetch(`./functions/live_search.php?search_data=${searchValue}`)
                .then(response => response.text())
                .then(data => {
                    document.getElementById('product-container').innerHTML = data;
                });
        });
    </script>
</body>
</html>