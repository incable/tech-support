<?php 
    include("../auth_admin.php");
    include("../dbConnect.php");
    $employee_name = $_SESSION['employee_name'];
    $email = $_SESSION['email'];
    $phone = $_SESSION['phone'];
    $employeeid = $_SESSION['id'];
    try {
        $date = $_POST['date'];
        $r = $_POST['opid'];
        $conn =connect();
        $query = mysqli_query($conn, "UPDATE mc_owner_balance SET disabled_on = '".san_sqli(1, $date,$conn)."',Operator_Status='Active' WHERE Operator_Id = $r");
        header("Location:mc_view.php");
        close($conn);   
            
    } catch (Exception $e) {
        close($conn);
        errorPage();
    }
?>