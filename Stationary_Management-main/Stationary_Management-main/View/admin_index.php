<?php
    include('../Models/connect.php');
    include('../Models/common_functions.php');
    session_start();
    if(isset($_SESSION['admin_username'])){
        $admin_name = $_SESSION['admin_username'];
        $get_admin_data = "SELECT * FROM `admin_table` WHERE admin_name = '$admin_name'";
        $get_admin_result = mysqli_query($con,$get_admin_data);
        $row_fetch_admin_data = mysqli_fetch_array($get_admin_result);
        $admin_name = $row_fetch_admin_data['admin_name'];
        $admin_image = $row_fetch_admin_data['admin_image'];
    }else{
        echo "<script>window.open('../Controllers/Admin_actions/admin_login.php','_self');</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory specialist Dashboard</title>
    <link rel="stylesheet" href="./css/bootstrap.css" />
    <link rel="stylesheet" href="./css/main.css" />
</head>

<body>
<?php include("../Helpers/execution_time.php"); ?>
    <!-- upper-nav -->
    <div class="upper-nav primary-bg p-2 px-3 text-center text-break">
        <span>Inventory specialist Dashboard And Free Express Delivery</span>
    </div>
    <!-- upper-nav -->
    <!-- Start NavBar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand fw-bold" href="./admin_index.php">Stationery Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContentad" aria-controls="navbarSupportedContentad" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContentad">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Welcome <?php echo $admin_name;?></a>
                    </li>
                    <li class="nav-item">
                    <button class="btn btn-primary p-0 px-1">
                            <a href="../Controllers/Admin_actions/admin_logout.php" class="nav-link text-light">Logout</a>
                        </button>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>
    <!-- End NavBar -->
    <!-- Start Control Buttons -->
    <div class="control">
        <div class="container pt-4 pb-0">
            <div class="categ-header">
                <div class="sub-title">
                    <span class="shape"></span>
                    <span class="title">Admin Dashboard</span>
                </div>
                <h2>Manage Details Of Ecommerce</h2>
            </div>
            <div class="row align-items-center">
                <div class="col-md-2">
                    <div class="admin-image">
                        <a href="./admin_index.php"><img src="../Helpers/images/admin_images/<?php echo $admin_image;?>" class="img-thumbnail" alt="Admin Photo"></a>
                        <p><?php echo $admin_name;?></p>
                    </div>
                </div>
                <div class="col-md-10">
                    <div class="buttons">
                        <button class="btn btn-outline-primary m-2">
                            <a href="../Controllers/Admin_actions/insert_product.php" class="nav-link">Insert Products</a>
                        </button>
                        <button class="btn btn-outline-primary m-2">
                            <a href="./admin_index.php?view_products" class="nav-link">View Products</a>
                        </button>
                        <button class="btn btn-outline-primary m-2">
                            <a href="./admin_index.php?insert_category" class="nav-link">Insert Categories</a>
                        </button>
                        <button class="btn btn-outline-primary m-2">
                            <a href="./admin_index.php?view_categories" class="nav-link">View Categories</a>
                        </button>
                        <button class="btn btn-outline-primary m-2">
                            <a href="./admin_index.php?insert_brand" class="nav-link">Insert Brands</a>
                        </button>
                        <button class="btn btn-outline-primary m-2">
                            <a href="./admin_index.php?view_brands" class="nav-link">View Brands</a>
                        </button>
                        <button class="btn btn-outline-primary m-2">
                            <a href="./admin_index.php?list_orders" class="nav-link">All Orders</a>
                        </button>
                        <button class="btn btn-outline-primary m-2">
                            <a href="./admin_index.php?list_payments" class="nav-link">All Payments</a>
                        </button>
                        <button class="btn btn-outline-primary m-2">
                            <a href="./admin_index.php?list_users" class="nav-link">List Users</a>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Control Buttons -->
        <!-- divider  -->
    <div class="container">
        <div class="divider"></div>
    </div>
    <!-- divider  -->
    <!-- Start Changed Page  -->
    <div class="change-page">
        <div class="container">
            <?php
            if(isset($_GET['insert_category'])){
                include('../Controllers/Admin_actions/insert_categories.php');
            }
            if(isset($_GET['insert_brand'])){
                include('../Controllers/Admin_actions/insert_brands.php');
            }
            if(isset($_GET['view_products'])){
                include('./view_products.php');
            }
            if(isset($_GET['edit_product'])){
                include('../Controllers/Admin_actions/edit_product.php');
            }
            if(isset($_GET['delete_product'])){
                include('../Controllers/Admin_actions/delete_product.php');
            }
            if(isset($_GET['view_categories'])){
                include('./view_categories.php');
            }
            if(isset($_GET['edit_category'])){
                include('../Controllers/Admin_actions/edit_category.php');
            }
            if(isset($_GET['delete_category'])){
                include('../Controllers/Admin_actions/delete_category.php');
            }
            if(isset($_GET['view_brands'])){
                include('./view_brands.php');
            }
            if(isset($_GET['edit_brand'])){
                include('../Controllers/Admin_actions/edit_brand.php');
            }
            if(isset($_GET['delete_brand'])){
                include('../Controllers/Admin_actions/delete_brand.php');
            }
            if(isset($_GET['list_orders'])){
                include('../Controllers/Admin_actions/list_orders.php');
            }
            if(isset($_GET['delete_order'])){
                include('../Controllers/Admin_actions/delete_order.php');
            }
            if(isset($_GET['list_payments'])){
                include('../Controllers/Admin_actions/list_payments.php');
            }
            if(isset($_GET['delete_payment'])){
                include('../Controllers/Admin_actions/delete_payment.php');
            }
            if(isset($_GET['list_users'])){
                include('../Controllers/Admin_actions/list_users.php');
            }

            ?>
        </div>
    </div>
    <!-- End Changed Page  -->








    <script src="./js/bootstrap.bundle.js"></script>
</body>

</html>