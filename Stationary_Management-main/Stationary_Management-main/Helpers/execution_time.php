<?php
if (!isset($con)) {
    include("../Models/connect.php");
}

$start_time = microtime(true);
$query_start_time = microtime(true);
$query = "SELECT * FROM products LIMIT 10";
$result = mysqli_query($con, $query);
$query_end_time = microtime(true);

$query_execution_time = $query_end_time - $query_start_time;
$end_time = microtime(true);
$total_execution_time = $end_time - $start_time;

echo "<p style='background-color: black; color: white; padding: 10px; text-align: center; font-family: Arial, sans-serif;'>
      Page loaded in <strong>" . number_format($total_execution_time, 5) . "</strong> seconds | 
      Database query executed in <strong>" . number_format($query_execution_time, 5) . "</strong> seconds.
      </p>";
?>
