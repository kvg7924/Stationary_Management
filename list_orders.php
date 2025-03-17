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
       </thead>
                <tbody>
                    <?php
                    //get Category info
                    // $get_order_query = "SELECT * FROM `user_orders`";
                    // $get_order_result = mysqli_query($con, $get_order_query);
                    // $row_count = mysqli_num_rows($get_order_result);
                    if ($row_count == 0) {
                        echo "<h2 class='text-center text-light p-2 bg-dark'>No orders yet</h2>";
                    } else {
                        $id_number = 1;
                        while ($row_fetch_orders = mysqli_fetch_array($get_order_result)) {
                            $order_id = $row_fetch_orders['order_id'];
                            $amount_due = $row_fetch_orders['amount_due'];
                            $invoice_number = $row_fetch_orders['invoice_number'];
                            $total_products = $row_fetch_orders['total_products'];
                            $order_date = $row_fetch_orders['order_date'];
                            $order_status = $row_fetch_orders['order_status'];
                            $order_complete = $row_fetch_orders['order_status'] == 'paid'? 'Complete' : 'Incomplete';
                            echo "
                            <tr>
                            <td>$id_number</td>
                            <td>$amount_due</td>
                            <td>$invoice_number</td>
                            <td>$total_products</td>
                            <td>$order_date</td>
                            <td>$order_status</td>
                            <td>$order_complete</td>
                        </tr>
                            ";

                            $id_number++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</body>                 
</html>                    