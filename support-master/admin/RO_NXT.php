<?php 
    include("../auth_admin.php");
    include("../dbConnect.php");
    $employee_name = $_SESSION['employee_name'];
  	$email = $_SESSION['email'];
  	$phone = $_SESSION['phone'];
  	$employeeid = $_SESSION['id'];
  	
    $start_date = date('Y-m-d');
     $conn = connect();
    $active = "Y";
    if (isset($_POST['submit'])){
	  
			 $oid=$_POST['oid'];
			 $lco_code=$_POST['lco_code'];
			 $lco_id=$_POST['lco_id'];
			  
			  $sql = "UPDATE OPERATOR  SET Merchant_Id='$lco_code',Merchant_Key='$lco_code',Merchant_Salt='$lco_code' WHERE Operator_id='$oid'";
			  echo $sql;

if ($conn->query($sql) === TRUE) {
  echo "Record updated successfully";
    header("Location:full_nxt_details.php");
    close($conn);
} else {
  echo "Error updating record: " . $conn->error;
}

		     
		 
	}

   if (isset($_POST['submit1'])){
    
     
       $sql="INSERT INTO OPERATOR_META(
 operator_id,wallet_balance, updated_time, invoice_template)
select OPERATOR_ID,0.00,now(),1 from OPERATOR WHERE Operator_id NOT IN(select OPERATOR_ID FROM OPERATOR_META)";
      $sql1="INSERT INTO customer_invoice_no (OPERATOR_ID)
select OPERATOR_ID from OPERATOR WHERE OPERATOR_ID NOT IN(select OPERATOR_ID from customer_invoice_no);";       

if ($conn->query($sql) === TRUE && $conn->query($sql1) === TRUE) {
  echo "<script>
window. location. href = 'move_operator_meta.php';
alert('Record updated successfully');
</script>";
  //echo "";
   // header("Location:full_nxt_details.php");
    close($conn);
} else {
  echo "Error updating record: " . $conn->error;
}

         
     
  }
?>