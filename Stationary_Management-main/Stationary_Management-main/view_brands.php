<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Brands Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <div class="categ-header">
            <div class="sub-title">
                <span class="shape"></span>
                <h2>All Brands</h2>
            </div>
        </div>
        <div class="table-data">
            <table class="table table-bordered table-hover table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>Brand No.</th>
                        <th>Brand Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include Database Connection
                    include 'db_connection.php';

                    // Get Brand Info
                    $get_brand_query = "SELECT * FROM `brands`";
                    $get_brand_result = mysqli_query($con, $get_brand_query);

                    if (mysqli_num_rows($get_brand_result) == 0) {
                        echo "<tr><td colspan='4' class='text-center text-danger'>No Brands Found</td></tr>";
                    } else {
                        $id_number = 1;
                        while ($row_fetch_brands = mysqli_fetch_array($get_brand_result)) {
                            $brand_id = $row_fetch_brands['brand_id'];
                            $brand_title = $row_fetch_brands['brand_title'];
                            echo "
                            <tr>
                                <td>$id_number</td>
                                <td>$brand_title</td>
                                <td>
                                    <a href='index.php?edit_brand=$brand_id' class='btn btn-warning btn-sm'>
                                        <i class='fas fa-edit'></i> Edit
                                    </a>
                                </td>
                                <td>
                                    <a href='index.php?delete_brand=$brand_id' class='btn btn-danger btn-sm'>
                                        <i class='fas fa-trash'></i> Delete
                                    </a>
                                </td>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
