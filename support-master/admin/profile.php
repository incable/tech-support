<?php include("header.php");
$conn = connect();
$query = mysqli_query($conn,"SELECT * FROM crm_handel WHERE id = '$employeeid'");
close($conn);
$data = mysqli_fetch_array($query,MYSQLI_ASSOC);
?>
<body id="page-top">
    <div id="wrapper">
    	<?php include("sidemenu.php");?>
        <div id="content-wrapper">
            <div class="container-fluid">
                <div class="card mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        View Profile 
                    </div>
                    <div class="row">
			            <div class="col-md-6 mb-3">
			            	<div class="column">
			            		<img src="assets/img/mobiezy-logo.png" class="img-fluid" alt="Responsive image">
			            	</div>
			            </div>
	                    <div class="col-md-6">
	                    	<form action="" method="POST" class="login-form">
			                	<div class="text-dark bg-white">
				                    <label for="colFormLabelLg" class="col-form-label col-form-label-md">Name</label>
				                    <div class="form-group input-group">
				                        <div class="input-group-prepend">
				                            <span class="input-group-text">
				                            	<img src="assets/img/person.png" width="20px">
				                            </span>
				                        </div>
				                        <input class="form-control font-weight-bold" type="text" name="name" placeholder="Name" id="Name" value="<?php echo $data['employee_name']; ?>">
				                    </div>
				                    <label for="colFormLabelLg" class="col-form-label col-form-label-md">Email</label>
				                    <div class="form-group input-group">
				                        <div class="input-group-prepend">
				                            <span class="input-group-text">
				                               	<img src="assets/img/email.png" width="20px">
				                            </span>
				                        </div>
				                        <input class="form-control font-weight-bold" type="text" placeholder="Email" value="<?php echo $data['email']; ?>" id="account_number" name="email">
				                    </div>
				                    <label for="colFormLabelLg" class="col-form-label col-form-label-md">Phone</label>
				                    <div class="form-group input-group">
				                        <div class="input-group-prepend">
				                            <span class="input-group-text">
				                            	<img src="assets/img/phone.png" width="20px">
				                            </span>
				                        </div>
				                        <input class="form-control font-weight-bold" type="text" name="phone" placeholder="Operator Name" value="<?php echo $data['phone']; ?>" id="demo">
				                    </div>
				                    <label for="colFormLabelLg" class="col-form-label col-form-label-md">Old Password</label>
				                    <div class="form-group input-group">
				                        <div class="input-group-prepend">
				                            <span class="input-group-text">
				                            	<img src="assets/img/ifsc.png" width="20px">
				                            </span>
				                        </div>
				                        <input class="form-control font-weight-bold" type="text" name="password" placeholder="password" value="<?php echo $data['password']; ?>" id="password">
				                    </div>
				                    <div class="row">
				                    	<div class="col-6">					                    
				                    		<label for="colFormLabelLg" class="col-form-label col-form-label-md">New Password</label>
						                    <div class="form-group input-group">
						                        <div class="input-group-prepend">
						                            <span class="input-group-text">
						                            	<img src="assets/img/repass.png" width="20px">
						                            </span>
						                        </div>
						                        <input class="form-control font-weight-bold" type="text" name="newpassword" placeholder="New password" id="new_password">
						                    </div>
						                </div>
						                <div class="col-6">
						                    <label for="colFormLabelLg" class="col-form-label col-form-label-md">Re-enter Password</label>
						                    <div class="form-group input-group">
						                        <div class="input-group-prepend">
						                            <span class="input-group-text">
						                            	<img src="assets/img/repass.png" width="20px">
						                            </span>
						                        </div>
						                        <input class="form-control font-weight-bold" type="text" name="re_enter_password" placeholder="re_enter_password" id="re_enter_password">
						                   	</div>
						                </div>
					                </div>
				                    <div class="form-group">
			                        	<button type="submit" class="btn btn-primary btn-block" name="submit" id="submit">Edit Profile</button>
			                    	</div>
				                </div>
			            	</form>
			            	<?php 
			            	if (isset($_POST['submit'])) {
			            		$password = $_POST['password'];
			            		$newpassword = $_POST['newpassword'];
			            		$re_enter_password = $_POST['re_enter_password'];
			            		$conn = connect();
			            		$query = mysqli_query($conn,"SELECT * FROM crm_handel WHERE id = '$employeeid'");
			            		close($conn);
			            		$data = mysqli_fetch_array($query,MYSQLI_ASSOC);
			            		$oldpassword =$data['password'];
			            		if ($oldpassword == $password) {
			            			if ($newpassword == $re_enter_password) {
			            				$conn = connect();
			            				$queryupdate = mysqli_query($conn, "UPDATE crm_handel SET password = '$newpassword' WHERE id = '$employeeid'");
			            				close($conn);
			            			}else{
			            				echo "Please Enter Correct Password...!";
			            			}
			            		}
			            	}
			            	?>
			            </div>
			            <a href="https://api.whatsapp.com/send?phone=9739996326&text=I'm%20interested%20in%20your%20services" target="_blank">	Click to WhatsApp Chat</a>
			        </div>
	            </div>
            </div>
        </div>
    </div>
</body>
<?php include("footer.php");?>