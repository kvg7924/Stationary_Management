<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Payments Page</title>
</head>

<body>
    <div class="container">
        <div class="categ-header">
            <div class="sub-title">
                <span class="shape"></span>
                <h2>All Payments</h2>
            </div>
        </div>
        <div class="table-data">
            <table class="table table-bordered table-hover table-striped text-center">
                <thead class="table-dark">
                    <?php
                    $get_payment_query = "SELECT * FROM `user_payments`";
                    $get_payment_result = mysqli_query($con, $get_payment_query);
                    $row_count = mysqli_num_rows($get_payment_result);
                    if($row_count!=0){
                        echo "
                        <tr>
                        <th>Payment No.</th>
                        <th>Order Id</th>
                        <th>Invoice Number</th>
                        <th>Due Amount</th>
                        <th>Payment Method</th>
                        <th>Payment Date</th>
                        <th>Delete</th>
                    </tr>
                    ";
                    }
                    ?>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>