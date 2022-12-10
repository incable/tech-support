<?php 
include("../auth_admin.php");
include("../dbConnect.php");
$status           = $_POST['status'];
$sale_id          = $_POST['sale_id'];
//echo "his";

$conn =connect();
$query = mysqli_query($conn, "UPDATE cableguy2_sales SET status = '".san_sqli(1, $status,$conn)."' WHERE id = '".san_sqli(1, $sale_id,$conn)."'");
close($conn);   
?>