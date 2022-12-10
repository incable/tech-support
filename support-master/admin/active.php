<?php 
    include("../auth_admin.php");
    include("../dbConnect.php");
    $employee_name = $_SESSION['employee_name'];
    $email = $_SESSION['email'];
    $phone = $_SESSION['phone'];
    $employeeid = $_SESSION['id'];
    $employee_name=$_SESSION['employee_name'];
    try {
        $date = $_POST['date'];
        $r = $_POST['opid'];
        //echo $date;
        //echo "<br>";
         $next_due_date = date('Y-m-d', strtotime('+ ' . $date . ' days'));
        //echo $next_due_date;
        $conn =connect();
        $query = mysqli_query($conn, "UPDATE mc_owner_balance SET disabled_on = '$next_due_date',Operator_Status='Active', modified_by='$employee_name',comments=comments-1 WHERE Operator_Id = $r");
        header("Location:mc_view.php");
        close($conn);   
            
    } catch (Exception $e) {
        close($conn);
        errorPage();
    }
?>