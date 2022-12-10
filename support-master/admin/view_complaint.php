
<?php include("header.php");
	$id = $_GET['id'];
    $conn = connect();
    $updatestatus = mysqli_query($conn, "UPDATE complaint_to_mobiezy SET complaint_status = 'pending' WHERE complaint_id = '".san_sqli(1, $id, $conn)."'");
    $query = mysqli_query($conn, "SELECT * FROM complaint_to_mobiezy c inner join system_complaint ON c.complaint_of = sys_complaint_id inner join OPERATOR o on c.operator_id = o.operator_id WHERE complaint_id = '".san_sqli(1, $id, $conn)."'");
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
                        Complaint Details
                    </div>
                </div>
                <?php 
                if (isset($_POST['assignsubmit'])) {
                    $assigned = $_POST['assigned'];
                    $complaint = $id;
                    $conn = connect();
                    $update = mysqli_query($conn,"UPDATE complaint_to_mobiezy SET assigned_to = $assigned,complaint_status = 'registered' WHERE complaint_id = '".san_sqli(1, $complaint, $conn)."'");
                    if ($update) {
                        echo '<div class="alert alert-success" role="alert" id="assign">
                                 Assigned Successfuly..!
                              </div>
                              <script>
                                $("#assign").ready(function(){
                                window.location.href = "complaints.php";
                                })
                              </script>';
                    }else{
                        echo '<div class="alert alert-danger" role="alert">
                                 Not Assigned Please Try Again!
                              </div>';
                    }
                }
                ?>
                <?php
                if (isset($_POST['submit'])) {
                    $description = $_POST['description'];
                    $dates = $_POST['dates'];
                    $complaint = $id;
                    $complaint_status = $_POST['statusid'];
                    include('functions.php');
                        $file_name = $_FILES['file']['name'];
                        $file_size = $_FILES['file']['size'];
                        $tmp_file = $_FILES['file']['tmp_name'];
                        $valid_file_formats = array("jpg", "png", "gif", "bmp","jpeg","PNG","JPG","JPEG","GIF","BMP");
                        $file_extension = getFileExtension($file_name);
                        if($file_name) {
                            if(in_array($file_extension,$valid_file_formats)) { 
                                if($file_size < (1024*1024)) {  
                                    include('config.php');              
                                    $new_image_name = time().".".$file_extension;
                                    if($s3->putObjectFile($tmp_file, $bucket , $new_image_name, S3::ACL_PUBLIC_READ)) {
                                        $uploaded_file_path='http://'.$bucket.'.s3.amazonaws.com/'.$new_image_name;
                                        // $file_upload_message .= '<b>Upload File URL:</b>'.$uploaded_file_path."<br/>";
                                        // $file_upload_message .= "<img src='$uploaded_file_path'/>";
                                    } else { 
                                        echo $file_upload_message = "<br>File upload to amazon s3 failed!. Please try again.";               
                                    }   
                                } else {
                                    echo $file_upload_message = "<br>Maximum allowed image upload size is 1 MB.";
                                }
                            } else {
                                echo $file_upload_message = "<br>This file format is not allowed, please upload only image file.";
                            }
                        }
                    $conn = connect();
                    $update = mysqli_query($conn,"UPDATE complaint_to_mobiezy SET mobiezy_comment ='".san_sqli(1, $description,$conn)."', closuredate='".san_sqli(1, $dates, $conn)."', complaint_status ='".san_sqli(1, $complaint_status)."', modified_date = NOW(), source_file = '$uploaded_file_path' WHERE complaint_id = '".san_sqli(1, $complaint, $conn)."'");
                    if ($update) {
                        $select_row =mysqli_query($conn,"SELECT * FROM complaint_to_mobiezy WHERE complaint_id = '".san_sqli(1, $complaint,$conn)."' ");
                        $getrow=mysqli_fetch_array($select_row);
                        if ($getrow['complaint_status'] =='completed') {?>
                            <div class="alert alert-success" role="alert" id="respon">
                                Successfuly Responsed...!
                            </div>
                            <input type="hidden" name="id" id="complaint_id" value="<?php echo $getrow['complaint_id']; ?>">
                            <input type="hidden" name="id" id="conatct_number" value="<?php echo $getrow['conatct_number']; ?>">
                            <input type="hidden" name="id" id="message" value="Dear Operator,Your complaint has been Solved and complaint also Closed. Thanks, Team Mobiezy.">
                            <script type="text/javascript">
                                $("#respon").ready(function(){
                                    window.location.href = "complaints.php";
                                })
                            </script>
                    <?php 
                        }
                    }else{
                        echo '<div class="alert alert-danger" role="alert">
                                 Failed ResponsedPlease Try Again!
                              </div>';
                    }
                } 
                ?>
                <label class="btn btn-info btn-block text-right text-dark font-weight-bold"><?php echo $data['Operator_Comp_name'].' ----> '.$data['operator_id']; ?></label>
                <div class="row mb-3">
                    <div class="col-sm-3">
                        <div class="form-group">
                            <label class="btn btn-secondary btn-block text-left text-white font-weight-bold">Support Team</label>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <form action="" method="POST" class="login-form" enctype="multipart/form-data">
                                    <div class="row">
                                        <div class="col-sm">
                                            <label for="colFormLabelLg" class="col-form-label col-form-label-md">Select Assign Too</label>
                                            <div class="form-group input-group">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text"> <img src="assets/img/complaint1.png" width="20px"> </span>
                                                </div>
                                                <select class="form-control border-primary" name="assigned" id="assigned" required="">
                                                    <option value="" selected>--select--</option>
                                                    <?php
                                                        try { 
                                                            $conn = connect(); 
                                                            $sql_owner = mysqli_query($conn,"SELECT employee_name,id FROM `crm_handel`");
                                                            close($conn);
                                                        } catch (Exception $e){ 
                                                            close($conn);
                                                            errorPage();
                                                        }
                                                        while($row = mysqli_fetch_array($sql_owner,MYSQLI_ASSOC)){       
                                                            echo "<option ";
                                                            if($_REQUEST["employee_name"] == $row["employee_name"])
                                                            echo ' selected = "selected" ';
                                                            echo " value=\"".$row["id"]."\">".$row["employee_name"]."</option>";
                                                        }  
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info btn-block" name="assignsubmit" id="assignsubmit"> Assign Complaint  </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
					<div class="col-sm-3">
						<div class="form-group">
                    		<label class="btn btn-primary btn-block text-left text-dark font-weight-bold">Uploaded Files</label>
                		</div>
					    <div class="card">
					      	<div class="card-body">
					      		<div class="row">
					      			<div class="col-sm">
					      				<p class="card-text"><img src="<?php echo $data['complaint_file'] ?>"class="card-img-top" alt="" /></p>
					      			</div>
					      			<div class="col-sm">
					      				<div class="form-group">
                    						<label class="btn btn-light btn-block text-center text-dark font-weight-bold">View Full Screen</label>
                    						<p class="card-text">
                    							&nbsp
                    						</p>
                    						<p class="card-text">
                    							<a href="<?php echo $data['complaint_file'] ?>"class="btn btn-dark btn-block" alt="">View</a>
                    						</p>
                						</div>
					      			</div>
					      		</div>
					      	</div>
					    </div>
					</div>
					<div class="col-sm-6">
                        <div class="row mb-3">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="btn btn-primary btn-block text-left text-dark font-weight-bold">System Type</label>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-text"><?php  echo $data['system_name'];?></p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label class="btn btn-primary btn-block text-left text-dark font-weight-bold">Complaint Type</label>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <p class="card-text"><?php  echo $data['complaint_type'];?></p>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div class="form-group"  style="color: #FF4500;">
                    		<label class="btn btn-warning btn-block text-left text-dark font-weight-bold" >Description </label>
                		</div>
					    <div class="card">
						  	<div class="card-body">
						    	<p class="card-text"><?php  echo $data['complaint_description'];?></p>
						  	</div>
					    </div>
					</div>
				</div>
				<div class="card mb-3">
                    <div class="card-header bg-info">
                        <i class="fas fa-table"></i>
                        Complaint Response
                    </div>
                </div>
                <form action="" method="POST" class="login-form" enctype="multipart/form-data">
                    <div class="card border-dark mb-3">
                    	<div class="row border-left border-right">
                            <div class="col-md-6">
                                <label for="exampleFormControlTextarea1">Enter Your Complaint Response</label>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <img src="assets/img/notes.png" width="20px"> </span>
                                    </div>
                                    <textarea class="form-control border-warning rounded-0" id="description" rows="4" name="description" required="" placeholder="Describe your answer here..."></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm">
                                        <label for="colFormLabelLg" class="col-form-label col-form-label-md">Upload Files</label>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <label class="custom-file-label border-success" for="inputGroupFile01">Choose file </label> </span>
                                            </div>
                                            <input type="file" name="file" id="file" class="custom-file-input border-success" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" >
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <label for="colFormLabelLg" class="col-form-label col-form-label-md">Date</label>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <img src="assets/img/date.png" width="20px"> </span>
                                            </div>
                                            <input name="dates" class="form-control" placeholder="Record Voice" type="date" id="date" required="">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm">
                                        <div class="form-group input-group">
                                            <select class="form-control border-primary" name="statusid" id="statusid" required="">
                                                <option value="" selected>--Select Status--</option>
                                                <option value="registered">Registered</option>
                                                <option value="pending">Pending</option>
                                                <option value="completed">Completed</option>
                                                <option value="question_not_clear">Question not clear</option>
                                                <option value="other">Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <div class="form-group">
                                            <button type="submit" class="btn btn-secondary btn-block" name="submit" id="submit"> Reply  </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<?php include("footer.php");?>
<script type="text/javascript">
    $(document).ready(function(){
        var p_phone = $("#conatct_number").val();
        var p_sms_text = $("#message").val();
        $.ajax({
            url:"https://www.unicel.in/SendSMS/sendmsg.php?uname=cableguy&pass=v@8Ci$2Z&send=CBLGUY&dest="+p_phone+"&msg="+p_sms_text+"&prty=3&vp=30",
            type:'post',
            success: function (resp) {
                //alert(resp);
                console.log(resp);
            }
        })
    })
</script>