<?php
	//Start session
	session_start();
	//Check whether the session variable SESS_MEMBER_ID is present or not
	if(!isset($_SESSION['employee_name']) && !isset($_SESSION['email']) && !isset($_SESSION['password'])) {
		header("location: ../login_failed.php");
		exit();
	}

?>