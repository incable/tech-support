<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login Page | Mobiezy.Tech.Support</title>
<link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> 
<style type="text/css">
  body {
    color: #4e4e4e;
    background: #e2e2e2;
    font-family: 'Roboto', sans-serif;
  }
  .form-control {
        font-size: 16px;
    background: #f2f2f2;
    box-shadow: none !important;
    border-color: transparent;
  }
  .form-control:focus {
    border-color: #d3d3d3;
  }
    .form-control, .btn {        
        border-radius: 2px;
    }
  .login-form {
    width: 350px;
    margin: 0 auto;
  }
  .login-form h2 {    
        margin: 0;
    padding: 50px 0;
        font-size: 30px;
        color: #3f545e;
    }
  .login-form .avatar {
    margin: 0 auto 30px;
    width: 100px;
    height: 100px;
    border-radius: 50%;
    z-index: 9;
    background: #ef3b3a;
    padding: 15px;
    box-shadow: 0px 0px 6px 6px rgba(0, 0, 0, 0.1);
  }
  .login-form .avatar img {
    width: 100%;
  }
    .login-form form {
    color: #7a7a7a;
    /*border-radius: 4px;*/
    margin-bottom: 15px;
    
    box-shadow: 0px 2px 10px 6px rgba(0, 0, 0, 0.57);
    padding: 30px;
} 
    .login-form .btn {
        font-weight: bold;
    background: #ef3b3a;
    border: none;
    /*margin-bottom: 20px;*/
    }
  .login-form .btn:hover, .login-form .btn:focus {
    background: #ed2121;
    outline: none !important;
  }
  .login-form a {
    color: #ef3b3a;
  } 
  .login-form form a {
    color: #ef3b3a;
  }
  .login-form a:hover, .login-form form a:hover {
    text-decoration: underline;
  }
  .hint-text {
    color: #999;
    text-align: center;
  }
  .form-footer {
    padding-bottom: 15px;
    text-align: center;
    }
</style>
</head>
<body>
<div class="login-form">
  <h2 class="text-center">CableGuy Tech Support</h2>
  <form action="auth_check.php" method="post" onsubmit="return validateFormOnLogin(this)" class="login-form">
    <div class="avatar">
      <img src="assets/img/avatar.png" alt="Avatar">
    </div>           
    <div class="form-group">
      <input type="text" class="form-control input-lg" name="username" id="textfield1" placeholder="Employee Name" required="required" autofocus>
    </div>
    <div class="form-group">
      <input type="password" class="form-control input-lg" name="password" id="textfield2" placeholder="Password" required="required">
    </div>        
    <div class="form-group">
      <button type="submit" class="btn btn-primary btn-lg btn-block login-btn">Sign in</button>
    </div>
    <!-- <p class="hint-text">Don't have an account? <a href="#">Sign up here</a></p> -->
  </form>
  <!-- <div class="form-footer"><a href="#">Forgot Your Password?</a></div> -->
</div>
<script type="text/javascript" src="validate_sf.js"></script>
</body>
</html>                            