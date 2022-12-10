<?php 
error_reporting(0);
define("MYSQL_CONN_ERROR", "Unable to connect to database."); 
session_start();
// Ensure reporting is setup correctly 
mysqli_report(MYSQLI_REPORT_STRICT); 

// Connect function for database access 
function connect() { 
   try { 

    $conn=new mysqli('rupayee.c1cxf42d2qm3.us-west-2.rds.amazonaws.com','cableguy','Cb1gu7#$62','rupayee'); 
    $connected = true; 
    // Change character set to utf8
    $sSQL = 'SET CHARACTER SET utf8';

    mysqli_set_charset($conn,$sSQL);
    return $conn;
    } 
    catch (mysqli_sql_exception $e) { 
      throw $e; 
      return null;
    }  
} 

function close($conn){
    try{
        mysqli_close($conn);
      //  echo 'closed';
     
    }
    catch(mysqli_sql_exception $e){
        //echo $e;
        
    }
}

function errorPage(){

    echo "<script>location.assign('serverError.php')</script>";
}

// try { 
//   connect(); 
//   echo 'Connected to database'; 
// } catch (Exception $e) { 
//   echo $e->errorMessage(); 
// } 
?>