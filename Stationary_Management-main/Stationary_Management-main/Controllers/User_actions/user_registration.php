<?php
include('../includes/connect.php');
include('../functions/common_functions.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ecommerce User Registration Page</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.css" />
    <link rel="stylesheet" href="../assets/css/main.css" />
</head>

<body>
    <div class="register">
        <div class="container py-3">
            <h2 class="text-center mb-4">New User Registration</h2>
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <form action="" method="post" enctype="multipart/form-data" class="d-flex flex-column gap-4" onsubmit="return validateForm()">
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
                            <small class="text-muted">Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be at least 8 characters long.</small>
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
                        <!-- education verification checkbox -->
                        <div class="form-outline">
                            <label for="is_student" class="form-label">Are you a student?</label>
                            <div>
                                <input type="checkbox" name="is_student" id="is_student" value="1" required> Yes
                            </div>
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
    <script>
    // JavaScript function to validate form
    function validateForm() {
        var password = document.getElementById("user_password").value;
        var confirmPassword = document.getElementById("conf_user_password").value;

        // Regex to check for at least one uppercase, one lowercase, one digit, one special character, and minimum length of 8
        var regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;

        if (!regex.test(password)) {
            alert("Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be at least 8 characters long.");
            return false;
        }

        if (password !== confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }

        // Check if the user is a student
        var isStudent = document.getElementById("is_student").checked;
        if (!isStudent) {
            alert("You must be a student to register.");
            return false;
        }

        return true;
    }
    </script>
</body>

</html>

<!-- PHP Code -->
<?php
if (isset($_POST['user_register'])) {
    $user_username = $_POST['user_username'];
    $user_email = $_POST['user_email'];
    $user_password = $_POST['user_password'];
    $conf_user_password = $_POST['conf_user_password'];
    $user_address = $_POST['user_address'];
    $user_mobile = $_POST['user_mobile'];
    $user_image = $_FILES['user_image']['name'];
    $user_image_tmp = $_FILES['user_image']['tmp_name'];
    $user_ip = getIPAddress();
    $is_student = isset($_POST['is_student']) ? 1 : 0; // 1 if checked, 0 if not

    // Function to validate password strength
    function isPasswordStrong($password) {
        $regex = "/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/";
        return preg_match($regex, $password);
    }

    // Check if user exists
    $select_query = "SELECT * FROM `user_table` WHERE username='$user_username' OR user_email='$user_email'";
    $select_result = mysqli_query($con, $select_query);
    $rows_count = mysqli_num_rows($select_result);

    if ($rows_count > 0) {
        echo "<script>window.alert('Username | Email already exist');</script>";
    } else if ($user_password != $conf_user_password) {
        echo "<script>window.alert('Passwords do not match');</script>";
    } else if (!isPasswordStrong($user_password)) {
        echo "<script>window.alert('Password must contain at least one uppercase letter, one lowercase letter, one digit, one special character, and be at least 8 characters long.');</script>";
    } else if (!$is_student) {
        echo "<script>window.alert('You must be a student to register.');</script>";
    } else {
        // Hash the password
        $hash_password = password_hash($user_password, PASSWORD_DEFAULT);

        // Move uploaded image to the server
        move_uploaded_file($user_image_tmp, "./user_images/$user_image");

        // Insert user into the database
        $insert_query = "INSERT INTO `user_table` (username, user_email, user_password, user_image, user_ip, user_address, user_mobile) 
                         VALUES ('$user_username', '$user_email', '$hash_password', '$user_image', '$user_ip', '$user_address', '$user_mobile')";
        $insert_result = mysqli_query($con, $insert_query);

        if ($insert_result) {
            echo "<script>
                window.alert('User added successfully');
                window.location.href = 'user_login.php'; // Redirect to login page
            </script>";
        } else {
            die(mysqli_error($con));
        }
    }
}
?>