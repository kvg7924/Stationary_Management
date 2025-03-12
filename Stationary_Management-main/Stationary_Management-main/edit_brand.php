<?php
    // fetch all data
    if(isset($_GET['edit_brand'])){
        $edit_id = $_GET['edit_brand'];
        $get_data_query = "SELECT * FROM `brands` WHERE brand_id = $edit_id";
        $get_data_result = mysqli_query($con,$get_data_query);
        $row_fetch_data = mysqli_fetch_array($get_data_result);
        $brand_id = $row_fetch_data['brand_id'];
        $brand_title = $row_fetch_data['brand_title'];
    }