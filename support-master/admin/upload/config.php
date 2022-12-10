<?php
// Bucket Name

session_start();
$bucket="mobiezysupportportal";
require_once('S3.php');			
//AWS access info
$awsAccessKey =  $_SESSION['awsAccessKey'];
$awsSecretKey = $_SESSION['awsSecretKey'];
//instantiate the class
$s3 = new S3($awsAccessKey, $awsSecretKey);
$s3->putBucket($bucket, S3::ACL_PUBLIC_READ);
?>