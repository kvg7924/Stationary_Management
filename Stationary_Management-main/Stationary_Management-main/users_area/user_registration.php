<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce User Registeration Page</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
</head>

<body>

    <div class="register">
        <div class="container py-3">
            <h2 class="text-center mb-4">New User Registration</h2>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form action="" method="post" enctype="multipart/form-data" class="d-flex flex-column gap-4">
                        <!-- username field  -->
                        <div class="form-outline">
                            <label for="user_username" class="form-label">Username</label>
                            <input type="text" placeholder="Enter your username" autocomplete="off" required="required" name="user_username" id="user_username" class="form-control">
                        </div>
                        <!-- email field  -->
                        <div class="form-outline">
                            <label for="user_email" class="form-label">Email</label>
                            <input type="email" placeholder="Enter your email" autocomplete="off" required="required" name="user_email" id="user_email" class="form-control">
                        </div>
                        <!-- image field  -->
                        <div class="form-outline">
                            <label for="user_image" class="form-label">User Image</label>
                            <input type="file" required="required" name="user_image" id="user_image" class="form-control">
                        </div>
                        <!-- password field  -->
                        <div class="form-outline">
                            <label for="user_password" class="form-label">Password</label>
                            <input type="password" placeholder="Enter your password" autocomplete="off" required="required" name="user_password" id="user_password" class="form-control">
                        </div>
                        <!-- confirm password field  -->
                        <div class="form-outline">
                            <label for="conf_user_password" class="form-label">Confirm Password</label>
                            <input type="password" placeholder="Confirm your password" autocomplete="off" required="required" name="conf_user_password" id="conf_user_password" class="form-control">
                        </div>
                        <!-- address field  -->
                        <div class="form-outline">
                            <label for="user_address" class="form-label">Address</label>
                            <input type="text" placeholder="Enter your address" autocomplete="off" required="required" name="user_address" id="user_address" class="form-control">
                        </div>
                        <!-- mobile field  -->
                        <div class="form-outline">
                            <label for="user_mobile" class="form-label">Mobile</label>
                            <input type="text" placeholder="Enter your mobile" autocomplete="off" required="required" name="user_mobile" id="user_mobile" class="form-control">
                        </div>
                        <div>
                            <input type="submit" value="Register" class="btn btn-primary mb-2" name="user_register">
                            <p>
                                Already have an account? <a href="user_login.php" class="text-primary text-decoration-underline"><strong>Login</strong></a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="./assets//js/bootstrap.bundle.js"></script>
</body>

<?php
if (isset($_POST['user_register'])) {
    $user_ip = getIPAddress();

    // Select cart items and check if user has items in the cart
    $select_cart_items = "SELECT * FROM `card_details` WHERE ip_address='$user_ip'";
    $select_cart_items_result = mysqli_query($con, $select_cart_items);
    $rows_count_cart_items = mysqli_num_rows($select_cart_items_result);

    if ($rows_count_cart_items > 0) {
        $_SESSION['username'] = $user_username;
        echo "<script>window.alert('You have items in your cart');</script>";
        echo "<script>window.open('checkout.php','_self');</script>";
    } else {
        echo "<script>window.open('../index.php','_self');</script>";
    }
}
?>
