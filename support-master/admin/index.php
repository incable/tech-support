<!DOCTYPE html>
<html lang="en">

<head>
	<title>MobiCable | Login</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="vk_assets/favicon.png" />
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
	<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css1/util.css">
	<link rel="stylesheet" type="text/css" href="css1/main.css">
	<!--===============================================================================================-->
	<style>
		.login100-pic img {
			max-width: 100%;
			margin-top: 50px;
			margin-left: 8px;
		}

		@media (max-width: 768px) {
			.logo1 {
				/* display: none; */
				padding-bottom: 15px;
			}
		}

		@media (min-width: 769px) {
			.logo1 {
				display: none;

			}
		}

		@media (max-width: 768px) {
			.login100-form-title {
				display: none !important;

			}
		}

		.wrap-login100 {
			/* background-image: url("images/aaa.gif"); */
			background: #e1e1e1;
			/* background: rgba(255, 255, 255, 0.145); */
			/* backdrop-filter: saturate(180%) blur(10px); */
		}

		.container-login100 {
			background-image: url("images/back.jpg");
			background-size: 1000px 800px;
		}
	</style>
</head>
<?php
         session_start();
		 $msg='';
		 if(isset($_SESSION['nouser'])){
			 $msg = 'Invalid Username or Password';
			 unset($_SESSION['nouser']);
		 }
?>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="post" action="check_login.php">
					<span class="login100-form-title" id="title">
						Member Login
					</span>
                    <h5 class="text-center mb-4" style="color: #fb0000;"><?php echo $msg; ?></h5>
					<div class="logo1" data-tilt>
						<center>
							<img src="images/img-01.png" class="img-fluid" alt="IMG">
						</center>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Valid Username is required">
						<input class="input100" type="text" name="username" autocomplete="off" id="username" placeholder="Username" value="<?php if (isset($_COOKIE["username"])) {
																																				echo $_COOKIE["username"];
																																			} ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="pass" autocomplete="off" id="pass" placeholder="Password" value="<?php if (isset($_COOKIE["pass"])) {
																																			echo $_COOKIE["pass"];
																																		} ?>">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					   <style type="text/css">
            
          .a {
    margin-top: -5px;
}       
         .b{
          font-size: 12px;
         }
          </style>
   <div class="flex-sb-m w-full a">
            <div class="contact100-form-checkbox">
              <input class="input-checkbox100" id="ckb3" type="checkbox" name="APP" value="Yes" checked required oninvalid="this.setCustomValidity('Please agree to Terms & Conditions')">
              <label class="label-checkbox100 b" for="ckb3">
               I have read and agree to the <a href="https://mobicollector.com/mobicableterms.html" style="font-size: 12px;">terms of service</a>
              </label>
            </div>
          </div>
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Login
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt1">
							Forgot
						</span>
						<a class="txt2" href="#">
							Username / Password?
						</a>
					</div>

					<!-- <div class="text-center p-t-136">
						<a class="txt2" href="#">
							Create your Account
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div> -->
				</form>
			</div>
		</div>
	</div>




	<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
	<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script>
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
	<!--===============================================================================================-->
	<script>
		$(document).ready(function() {
			/*----------------------------------------------------------------------
				add spinner icon to submit button
			----------------------------------------------------------------------*/




			$('button[type="submit"], button.submit').on("click", function(e) {
				/*-------------------------------
				  prevent submit (for TEST only) */

				//-------------------------------
				if ($("#username").val() !== "" || $("#pass").val() !== "") {
					if ($(this).find("span.submit-now").length !== 0) {
						e.preventDefault();
						e.stopPropagation()
						// $(this).find('span.submit-now').remove()
					} else {
						$(this).prepend(
							'<span class="submit-now"><i class="fa fa-refresh fa-spin fa-fw"></i>&nbsp;</span>'
						);
					}


				}

			});


		});
	</script>
	<script src="js/main.js"></script>

</body>

</html>