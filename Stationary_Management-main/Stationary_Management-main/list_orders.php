<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Orders Page</title>
</head>

<body>
    <div class="container">
        <div class="categ-header">
            <div class="sub-title">
                <span class="shape"></span>
                <h2>All Orders</h2>
            </div>
        </div>
        <div class="table-data">
            <table class="table table-bordered table-hover table-striped text-center">
                <thead class="table-dark">
                    <?php
                    $get_order_query = "SELECT * FROM `user_orders`";
                    $get_order_result = mysqli_query($con, $get_order_query);
                    $row_count = mysqli_num_rows($get_order_result);
                    if($row_count!=0){
                        echo "
                        <tr>
                        <th>Order No.</th>
                        <th>Due Amount</th>
                        <th>Invoice Number</th>
                        <th>Total Products</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Complete/Incomplete</th>
                        <th>Delete</th>
                    </tr>
                    ";
                    }
                    ?>

</html>                    