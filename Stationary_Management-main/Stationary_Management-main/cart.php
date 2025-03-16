<?php
include('./includes/connect.php');
include('./functions/common_functions.php');
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce Cart Details Page</title>
    <link rel="stylesheet" href="./assets/css/bootstrap.css" />
    <link rel="stylesheet" href="./assets/css/main.css" />
</head>

<body>
    <!-- Start NavBar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand fw-bold" href="#">A1</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active"  href="./index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./products.php">Products</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contact</a>
                    </li>
                    <?php
                    $currentPage = basename($_SERVER['PHP_SELF']);
                    $navLinks = ["Home" => "index.php", "Products" => "products.php", "About" => "#", "Contact" => "#"];
                    foreach ($navLinks as $name => $link) {
                        $activeClass = ($currentPage == $link) ? 'active' : '';
                        echo "<li class='nav-item'><a class='nav-link $activeClass' href='./$link'>$name</a></li>";
                    }
                        if(isset($_SESSION['username'])){                            
                            echo "
                            <li class='nav-item'>
                            <a class='nav-link' href='./users_area/profile.php'>My Account</a>
                        </li>";
                        }
                        else{
                            echo "
                            <li class='nav-item'>
                            <a class='nav-link' href='./users_area/user_registration.php'>Register</a>
                        </li>";
                        }
                    ?>
                </ul>
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-primary" type="submit">Search</button>
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
                                get_cart_item_count();
                                ?>
                            </sup>
                            <span class="d-none">
                                Total Price is: 
                                <?php
                                calculate_total_cart_price();
                                ?>
                            </span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">
                            <svg width="28" height="28" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24 27V24.3333C24 22.9188 23.5224 21.5623 22.6722 20.5621C21.8221 19.5619 20.669 19 19.4667 19H11.5333C10.331 19 9.17795 19.5619 8.32778 20.5621C7.47762 21.5623 7 22.9188 7 24.3333V27" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M16.5 14C18.9853 14 21 11.9853 21 9.5C21 7.01472 18.9853 5 16.5 5C14.0147 5 12 7.01472 12 9.5C12 11.9853 14.0147 14 16.5 14Z" stroke="black" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            <?php echo isset($_SESSION['username']) ? "<span>Welcome " . $_SESSION['username'] . "</span>" : "<span>Welcome guest</span>"; ?>
                        </a>
                    </li>
                    <?php
                    if (!isset($_SESSION['username'])) {
                        echo "<li class='nav-item'><a class='nav-link' href='./users_area/user_login.php'>Login</a></li>";
                    } else {
                        echo "<li class='nav-item'><a class='nav-link' href='./users_area/logout.php'>Logout</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End NavBar -->

    <!-- Start Table Section -->
    <<div class="landing">
        <div class="container">
                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
                    <table class="table table-bordered table-hover table-striped table-group-divider text-center">
                        <?php
                        $user_ip = getIPAddress();
                        $total_price = 0;
                        $cart_query = "SELECT * FROM `card_details` WHERE ip_address='$getIpAddress'";
                        $cart_result = mysqli_query($con, $cart_query);
                        $cart_item_count = mysqli_num_rows($cart_result);
                        if ($cart_item_count > 0) {
                            echo "<thead><tr><th>Product Title</th><th>Product Image</th><th>Quantity</th><th>Total Price</th><th>Remove</th><th colspan='2'>Operations</th></tr></thead><tbody>";
                            while ($row = mysqli_fetch_array($cart_result)) {
                                $product_id = $row['product_id'];
                                $product_quantity = $row['quantity'];
                                $select_product_query = "SELECT * FROM `products` WHERE product_id=$product_id";
                                $select_product_result = mysqli_query($con, $select_product_query);
                                while ($row_product_price = mysqli_fetch_array($select_product_result)) {
                                    $price_table = $row_product_price['product_price'];
                                    $product_title = $row_product_price['product_title'];
                                    $product_image_one = $row_product_price['product_image_one'];
                                    $total_price += $price_table * $product_quantity;
                                    echo "
                                    <tr>
                                        <td>$product_title</td>
                                        <td><img src='./admin/product_images/$product_image_one' class='img-thumbnail' alt='$product_title'></td>
                                        <td><input type='number' class='form-control w-50 mx-auto' min='1' name='qty_$product_id' value='$product_quantity'></td>
                                        <td>$price_table</td>
                                        <td><input type='checkbox' name='removeitem[]' value='$product_id'></td>
                                        <td><input type='submit' value='Update' class='btn btn-dark' name='update_cart'></td>
                                        <td><input type='submit' value='Remove' class='btn btn-primary' name='remove_cart'></td>
                                    </tr>";
                                }
                            }
                        } else {
                            echo "<h2 class='text-center text-danger'>Your cart is empty</h2>";
                        }
                        ?>
                        </tbody>
                    </table>
                    <?php
                    if ($cart_item_count > 0) {
                        echo "
                        <div class='d-flex align-items-center gap-4 flex-wrap'>
                            <h4>Sub-Total: <strong class='text-2'>$total_price</strong></h4>
                            <input type='submit' value='Continue Shopping' class='btn btn-dark' name='continue_shopping'>
                            <input type='submit' value='Checkout' class='btn btn-dark' name='checkout'>
                        </div>";
                    }
                    ?>
                </form>
                <?php
                if (isset($_POST['remove_cart'])) {
                    foreach ($_POST['removeitem'] as $remove_id) {
                        $delete_query = "DELETE FROM `card_details` WHERE product_id=$remove_id";
                        mysqli_query($con, $delete_query);
                    }
                    echo "<script>window.open('cart.php','_self');</script>";
                }
                ?>
            </div>
        </div>
    </div>

    <script src="./assets/js/bootstrap.bundle.js"></script>
</body>
</html>
