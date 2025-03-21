<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Categories Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-4">
        <div class="categ-header mb-3">
            <div class="sub-title">
                <h2>All Categories</h2>
            </div>
        </div>
        <div class="table-data">
            <table class="table table-bordered table-hover table-striped text-center">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Category Title</th>
                        <th>Edit</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        // Get Category info
                        include 'db_connection.php';
                        $get_category_query = "SELECT * FROM `categories`";
                        $get_category_result = mysqli_query($con, $get_category_query);
                        $id_number = 1;

                        if(mysqli_num_rows($get_category_result) == 0) {
                            echo "<tr><td colspan='4' class='text-danger'>No categories found.</td></tr>";
                        } else {
                            while($row = mysqli_fetch_assoc($get_category_result)) {
                                $category_id = $row['category_id'];
                                $category_title = $row['category_title'];
                                echo "
                                <tr>
                                    <td>$id_number</td>
                                    <td>$category_title</td>
                                    <td>
                                        <a href='index.php?edit_category=$category_id' class='btn btn-warning btn-sm'>Edit</a>
                                    </td>
                                    <td>
                                        <a href='index.php?delete_category=$category_id' class='btn btn-danger btn-sm'>Delete</a>
                                    </td>
                                </tr>";
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
