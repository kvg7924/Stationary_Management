<?php
$username_session = $_SESSION['username'];
$delete_query = "DELETE FROM `user_table` WHERE username='$username_session'";
$delete_result = mysqli_query($con, $delete_query);
if ($delete_result) {
    session_destroy();
    echo "<script>window.alert('Account deleted successfully');</script>";
    echo "<script>window.open('../index.php','_self');</script>";
}
?>
