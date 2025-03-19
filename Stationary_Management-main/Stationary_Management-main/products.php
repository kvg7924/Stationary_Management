<?php
include("./includes/connect.php");
include("./functions/common_functions.php");
include("./navbar.php"); // Include the navbar
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css">
    <link rel="stylesheet" href="./assets/css/main.css">
</head>

<body>

<!-- Products Section -->
<div class="all-prod">
        <div class="sub-container pt-4 pb-4">
            <div class="categ-header">
                <div class="sub-title">
                    <span class="shape"></span>
                    <span class="title">Categories & Brands</span>
                </div>
                <h2>Explore Categories & Brands</h2>
            </div>

            <div class="row mx-0">
                <!-- Sidebar with Categories and Brands -->
                <div class="col-md-3 side-nav p-0">
                    <button class="btn btn-primary d-md-none mb-3" id="sidebarToggle">Toggle Sidebar</button>
                    <div class="side-nav-content" id="sideNav">
                        <!-- Brands -->
                        <h4 class="fw-bolder">Brands</h4>
                        <?php getBrands(); ?>
                        <div class="divider"></div>

                        <!-- Categories -->
                        <h4 class="fw-bolder">Categories</h4>
                        <?php getCategories(); ?>
                    </div>
                </div>

                <!-- Products Grid -->
                <div class="col-md-9">
                <div class="d-flex justify-content-between mb-3">
                    <!-- Sort Dropdown -->
                    <select id="sortProducts" class="form-select w-25">
                        <option value="default">Sort By</option>
                        <option value="price_low">Price: Low to High</option>
                        <option value="price_high">Price: High to Low</option>
                        <option value="latest">Latest</option>
                    </select>
                </div>

                <div class="row" id="product-container">
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

<!-- Scripts -->
<script src="./assets/js/bootstrap.bundle.js"></script>
<script>
    // Toggle Sidebar
    document.getElementById('sidebarToggle').addEventListener('click', () => {
        document.getElementById('sideNav').classList.toggle('active');
    });

    // Live Search
    document.getElementById('searchBox').addEventListener('input', function () {
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
