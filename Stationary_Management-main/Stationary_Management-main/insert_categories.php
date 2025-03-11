<?php
include('../includes/connect.php');
if (isset($_POST['insert_categ_title'])) {
    $category_title = $_POST['categ_title'];
    $select_query = "SELECT * FROM `categories` WHERE category_title = '$category_title'";
    $select_result = mysqli_query($con,$select_query);
    $numOfResults = mysqli_num_rows($select_result);
    if ($numOfResults > 0) {
        echo "<script>alert('Category is already in Database');</script>";
    } else {

        $insert_query = "INSERT INTO `categories` (category_title) VALUES ('$category_title')";
        $insert_result = mysqli_query($con, $insert_query);
        if ($insert_result){
            echo "<script>alert('Category has been inserted successfully');</script>";
        }
    }
}
?>

<div class="categ-header">
            <div class="sub-title">
                <span class="shape"></span>
                <h2>Insert Categories</h2>
            </div>
        </div>
