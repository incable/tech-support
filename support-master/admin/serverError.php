<?php
     require_once('../auth_admin.php');
     include('../dbConnect.php');
     $id=$_SESSION['id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Login Page | Mobiezy</title>
<!-- Tell the browser to be responsive to screen width -->
<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.3.5 -->
<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
<!-- Ionicons -->
<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<!-- Select2 -->
<link rel="stylesheet" href="plugins/select2/select2.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="dist/css/AdminLTE.min.css">
<!-- AdminLTE Skins. Choose a skin from the css/skins
    folder instead of downloading all of them to reduce the load. -->
<link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

</head>

    <body style="background:#3333;">
        <div class="container" >
            <section class="content">
        
                <div>
                    <h1 class="text-red">500 Error Page</h1>
                    <div class="error-content">
                        <br><br>
                        <h1><i class="fa fa-warning text-red"></i> Oops! Something went wrong.</h1>
                        <p>
                            Please Check Your Internet Connection  or   &nbsp;  <a href="dashboard.php"><img src="../img/right-arrow.png"> &nbsp;<strong> Return to Dashboard</a></strong>
                        </p>
                    </div>
                </div><!-- /.error-page -->
            </section> 
        
        </div>
    </body>
</html>
