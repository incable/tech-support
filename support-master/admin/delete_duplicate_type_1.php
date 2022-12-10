<?php 
	include("../auth_admin.php");
    include("../dbConnect.php");
    $employee_name = $_SESSION['employee_name'];
  	$email = $_SESSION['email'];
  	$phone = $_SESSION['phone'];
  	$employeeid = $_SESSION['id'];
  	$tran_id = $_POST['tran_id'];
  	$cust_id = $_POST['cust_id'];
  	$conn = connect();
  	$delete_row = mysqli_query($conn,"DELETE n1 FROM TRAN_DETAILS n1, TRAN_DETAILS n2 WHERE n1.uniq_id > n2.uniq_id AND n1.cust_id = n2.cust_ID AND n1.AGENT_ID = n2.AGENT_ID  AND n1.tran_id= n2.tran_id AND n2.collection_date > '2019-06-01' AND n1.TRAN_ID ='".san_sqli(1, $tran_id,$conn)."' AND n1.CUST_ID = '".san_sqli(1, $cust_id,$conn)."'");
  	header("Location:duplicate_type_1.php");
 ?>