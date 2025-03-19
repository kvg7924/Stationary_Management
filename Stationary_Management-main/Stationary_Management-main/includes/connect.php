<?php 
// $con=mysqli_connect('localhost','root','','ecommerce_1');
$conn = new mysqli("localhost", "root", "", "ecommerce_1");

if(!$conn){
    die(mysqli_error($conn));
}




?>