<?php
    include('../includes/connect.php');
    include('../functions/common_functions.php');
    session_start();
    
    if(isset($_SESSION['admin_username'])){
        $admin_name = $_SESSION['admin_username'];
        $get_admin_data = "SELECT * FROM `admin_table` WHERE admin_name = '$admin_name'";
        $get_admin_result = mysqli_query($con,$get_admin_data);
        $row_fetch_admin_data = mysqli_fetch_array($get_admin_result);
        $admin_name = $row_fetch_admin_data['admin_name'];
        $admin_image = $row_fetch_admin_data['admin_image'];
    }else{
        echo "<script>window.open('./admin_login.php','_self');</script>";
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory specialist Dashboard</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
</head>

<body>
<?php include("../execution_time.php"); ?>
    <!-- upper-nav -->
    <div class="upper-nav primary-bg p-2 px-3 text-center text-break">
        <span>Inventory specialist Dashboard And Free Express Delivery</span>
    </div>
    <!-- upper-nav -->
    <!-- Start NavBar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand fw-bold" href="./index.php">Stationery Store</a>
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
                            <a href="./admin_logout.php" class="nav-link text-light">Logout</a>
                        </button>
                    </li>
                </ul>
                
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="divider"></div>
    </div>
    <!-- divider  -->
    <!-- Start Changed Page  -->
    <div class="change-page">
        <div class="container">
            <?php
            if(isset($_GET['insert_category'])){
                include('./insert_categories.php');
            }
            if(isset($_GET['insert_brand'])){
                include('./insert_brands.php');
            }
            if(isset($_GET['view_products'])){
                include('./view_products.php');
            }
            if(isset($_GET['edit_product'])){
                include('./edit_product.php');
            }
            if(isset($_GET['delete_product'])){
                include('./delete_product.php');
            }
            if(isset($_GET['view_categories'])){
                include('./view_categories.php');
            }
            if(isset($_GET['edit_category'])){
                include('./edit_category.php');
            }
            if(isset($_GET['delete_category'])){
                include('./delete_category.php');
            }
            if(isset($_GET['view_brands'])){
                include('./view_brands.php');
            }
            if(isset($_GET['edit_brand'])){
                include('./edit_brand.php');
            }
            if(isset($_GET['delete_brand'])){
                include('./delete_brand.php');
            }
            if(isset($_GET['list_orders'])){
                include('./list_orders.php');
            }
            if(isset($_GET['delete_order'])){
                include('./delete_order.php');
            }
            if(isset($_GET['list_payments'])){
                include('./list_payments.php');
            }
            if(isset($_GET['delete_payment'])){
                include('./delete_payment.php');
            }
            if(isset($_GET['list_users'])){
                include('./list_users.php');
            }

            ?>
        </div>
    </div>
    <!-- End Changed Page  -->








    <script src="../assets/js/bootstrap.bundle.js"></script>
</body>

</html>