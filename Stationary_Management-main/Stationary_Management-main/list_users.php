<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Users Page</title>
    <style>
        .user-img {
            width: 50px;
            height: 50px;
            object-fit: cover;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="categ-header">
            <div class="sub-title">
                <span class="shape"></span>
                <h2>All Users</h2>
            </div>
        </div>
        <div class="table-data">
            <table class="table table-bordered table-hover table-striped text-center">
                <thead class="table-dark">
                    <?php
                    // Database Connection (Ensure this file is included or create a connection)
                    include 'db_connection.php'; 

                    $get_user_query = "SELECT * FROM `user_table`";
                    $get_user_result = mysqli_query($con, $get_user_query);
                    $row_count = mysqli_num_rows($get_user_result);

                    if ($row_count > 0) {
                        echo "
                        <tr>
                            <th>User No.</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Image</th>
                            <th>Address</th>
                            <th>Mobile</th>
                            <th>Delete</th>
                        </tr>
                        </thead>
                        <tbody>
                        ";

                        $counter = 1;
                        while ($row = mysqli_fetch_assoc($get_user_result)) {
                            echo "
                            <tr>
                                <td>{$counter}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['email']}</td>
                                <td><img src='{$row['image']}' alt='User Image' class='user-img'></td>
                                <td>{$row['address']}</td>
                                <td>{$row['mobile']}</td>
                                <td><a href='delete_user.php?id={$row['id']}' class='btn btn-danger'>Delete</a></td>
                            </tr>
                            ";
                            $counter++;
                        }

                        echo "</tbody>";
                    } else {
                        echo "<tr><td colspan='7'>No users found.</td></tr>";
                    }
                    ?>
            </table>
        </div>
    </div>
</body>

</html>
