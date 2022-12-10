<?php 
    include("../auth_admin.php");
    include("../dbConnect.php");
    $employee_name = $_SESSION['employee_name'];
    $email = $_SESSION['email'];
    $phone = $_SESSION['phone'];
    $employeeid = $_SESSION['id'];

    if (isset($_POST['change'])) {
    $id = $_GET['id'];
    $active = $_POST['status'];
    $conn = connect();
    $query = mysqli_query($conn,"UPDATE OPERATOR SET Active = '".san_sqli(1, $active,$conn)."' WHERE Operator_id = '".san_sqli(1, $id,$conn)."'");
    close($conn);
    header("Location:full_operator_details.php");
    }
    
?>