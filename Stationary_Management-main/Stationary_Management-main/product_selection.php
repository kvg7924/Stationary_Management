<?php
// Include the backend logic file
include("search_product.php");
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
                    <li class="nav-item">
                        <a class="nav-link" href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <?php if (isset($_SESSION['username'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./users_area/profile.php">My Account</a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./users_area/user_registration.php">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
                <form class="d-flex" id="search-form" method="get">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search_data">
                    <input type="submit" value="Search" class="btn btn-outline-primary" name="search_data_btn">
                </form>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="./cart.php">
                            <svg width="28" height="28" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- SVG Path for Cart Icon -->
                            </svg>
                            <sup><?= get_cart_item_count(); ?></sup>
                            <span class="total-price d-none">
                                Total Price: <?= calculate_total_cart_price(); ?>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <svg width="28" height="28" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <!-- SVG Path for User Icon -->
                            </svg>
                            <?= isset($_SESSION['username']) ? "<span>Welcome " . $_SESSION['username'] . "</span>" : "<span>Welcome guest</span>"; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <?php if (!isset($_SESSION['username'])): ?>
                                <li><a class="dropdown-item" href="./users_area/user_login.php">Login</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="./users_area/logout.php">Logout</a></li>
                            <?php endif; ?>
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
                        <div class="row" id="product-container">
                            <?php
                            search_product();
                            filterCategoryProduct();
                            ?>
                        </div>
                        <!-- Pagination -->
                        <nav aria-label="Page navigation">
                            <ul class="pagination" id="pagination">
                                <?php
                                $items_per_page = 6; // Number of items per page
                                $total_items = getTotalProducts(); // Function to get total number of products
                                $total_pages = ceil($total_items / $items_per_page);

                                for ($i = 1; $i <= $total_pages; $i++) {
                                    echo "<li class='page-item'><a class='page-link' href='products.php?page=$i'>$i</a></li>";
                                }
                                ?>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="./assets/js/bootstrap.bundle.js"></script>
    <script>
        document.getElementById('search-form').addEventListener('submit', function (e) {
            e.preventDefault();
            const searchValue = document.querySelector('input[name="search_data"]').value;
            fetch(`./functions/live_search.php?search_data=${searchValue}`)
                .then(response => response.text())
                .then(data => document.getElementById('product-container').innerHTML = data);
        });
    </script>
</body>
</html>