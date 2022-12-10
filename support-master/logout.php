<?php
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
	session_start();
	
	// destroy the session 	
	session_destroy();
	// remove all session variables
	session_unset(); 

header('Location: index.php');
?> 
