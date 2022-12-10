<?php
include("db.php");
//$opid = $_POST["opid"];
//$salt = $_POST["salt"];

if(isset($_POST['opid']) && $_POST['opid'] != ''){ 
    $opid = $_POST["opid"];
    
    $sql = "select CUST_NUM,NAME from CUSTOMER where OPERATOR_ID = $opid";
    $result = mysqli_query($conn,$sql);
     $count = mysqli_num_rows($result);
    // Generate HTML of state options list 
    if($count > 0){ 
        echo '<option value="">Select State</option>'; 
        while($row = mysqli_fetch_assoc($result)){  
            echo '<option value="'.$row['CUST_NUM'].'">'.$row['NAME'].'</option>'; 
        } 
    }

}


if(isset($_POST['salt']) && $_POST['salt'] != ''){ 
    $salt = $_POST["salt"];
    
    $sql = "select Merchant_Salt from OPERATOR where Operator_id = $salt";
    $result = mysqli_query($conn,$sql);
     
    // Generate HTML of state options list 
   $res = mysqli_fetch_assoc($result);
   echo $res['Merchant_Salt'];

}


?>