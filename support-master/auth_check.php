<?php
include('includes_wap/wap.php');

	include("dbConnect.php");
	if (isset($_POST['username'])) {
		$name = $_POST['username'];
		// $_SESSION = $name;
	}
	if (isset($_POST['password'])) {
		$password = $_POST['password'];
	}
	
	try { 
		
		$conn = connect(); 
		// echo mysqli_real_escape_string($conn,$name);
		// echo san_sqli(1, $name, $conn);
		// die();
		$sql="SELECT id,employee_name,email,phone,password,image,created_on,role,MOBIEZY_HIDDEN.* FROM crm_handel,MOBIEZY_HIDDEN WHERE employee_name = '".san_sqli(1, $name, $conn)."' OR email ='".san_sqli(1,$name,$conn)."' AND password = '".san_sqli(1, $password, $conn)."'";
		// echo $sql;
		// die();
		$result=mysqli_query($conn,$sql);
		
		close($conn);

	} catch (Exception $e) { 
		//echo $e->errorMessage(); 
		close($conn);
		errorPage();
	}
	  	// Associative array
		$data = mysqli_fetch_assoc($result);
		// print_r($data);
	    // echo $data['employee_name'];
		// die();
	if(count(array($data)) > 0) 
	{
		$_SESSION['id'] = $data['id'];
		$_SESSION['employee_name'] = $data['employee_name'];
		$_SESSION['email'] = $data['email'];
		$_SESSION['phone'] = $data['phone'];
		$_SESSION['password']=$data['password'];
		$_SESSION['image']=$data['image'];                                            
		$_SESSION['created_on']=$data['created_on'];
		$_SESSION['role']=$data['role'];
		$_SESSION['awsAccessKey']=$data['awsAccessKey'];
		$_SESSION['awsSecretKey']=$data['awsSecretKey'];
		$_SESSION['basis_enc_key']=$data['basis_enc_key'];
		$_SESSION['basis_access_key']=$data['basis_access_key'];

		$_SESSION['91z8byyrzi_xapi_key']=$data['91z8byyrzi_xapi_key'];
		$_SESSION['hubspot_key']=$data['hubspot_key'];
		$_SESSION['razor_username']=$data['razor_username'];
		$_SESSION['razor_password']=$data['razor_password'];
		$_SESSION['razor_account_create']=$data['razor_account_create'];

		if(($name==$_SESSION['employee_name'] || $name==$_SESSION['email'] )&& $password==$_SESSION['password'])
		{
			echo "<script>location.assign('admin/dashboard.php')</script>";
		}
		else 
		{
			echo "<script>location.assign('login_failed.php')</script>";
			exit();
		}
	}
	else
	{
		echo "<script>location.assign('login_failed.php')</script>";
		exit();
	}
?>