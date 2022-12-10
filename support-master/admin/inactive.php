<?php
    include("../auth_admin.php");
    include("../dbConnect.php");
    $employee_name = $_SESSION['employee_name'];
  	$email = $_SESSION['email'];
  	$phone = $_SESSION['phone'];
  	$employeeid = $_SESSION['id'];


    $id = $_GET['id'];
    $conn = connect();
    $query = mysqli_query($conn, "UPDATE mc_owner_balance SET Operator_Status = 'InActive' WHERE Operator_Id= '".san_sqli(1, $id,$conn)."' ");
    close($conn);
    header("Location:mc_view.php");
?>