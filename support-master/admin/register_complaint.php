<?php include("header.php");
    // include("../auth_admin.php");
    // include("../dbConnect.php");
    // $employee_name = $_SESSION['employee_name'];
    // $email = $_SESSION['email'];
    // $phone = $_SESSION['phone'];
    // $employeeid = $_SESSION['id'];

    $id = $_GET['id'];
    $conn = connect();
    $query = mysqli_query($conn, "SELECT * FROM OPERATOR WHERE Operator_Id = '".san_sqli(1, $id,$conn)."'");
    close($conn);
    while ($data = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
        
?>
<body id="page-top">
    <div id="wrapper">
    	<?php include("sidemenu.php");?>
        <div id="content-wrapper">
            <div class="container-fluid">
                <!-- DataTables Example -->
                <div class="card text-dark bg-light mb-3">
                    <div class="card-header">
                        <i class="fas fa-table"></i>
                        Add Complaint 
                    </div>
                </div>
                <div class="form-group"  style="color: #FF4500;">
                    <label class="btn btn-warning btn-block text-right text-dark font-weight-bold" > Operator <?php echo $data['Operator_id'].' '.$data['Operator_Comp_name']; ?> Details </label>
                </div>
                <div class="card border-dark mb-3">
                    <div class="row border-left border-right">
                        <div class="col-md-4">
                            <label for="colFormLabelLg" class="col-form-label col-form-label-md">STATE</label>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <img src="assets/img/person.png" width="20px"> </span>
                                </div>
                                <input class="form-control border-success font-weight-bold" placeholder="state" id="state" value="<?php echo $data['OP_STATE']; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="colFormLabelLg" class="col-form-label col-form-label-md">COMPANY NAME</label>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <img src="assets/img/company-name.png" width="20px"> </span>
                                </div>
                                <input class="form-control font-weight-bold" placeholder="Company Name" value="<?php echo $data['Operator_Comp_name']; ?>" id="account_number">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="colFormLabelLg" class="col-form-label col-form-label-md">OPERATOR NAME</label>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <img src="assets/img/operator.png" width="20px"> </span>
                                </div>
                                <input class="form-control font-weight-bold" placeholder="Operator Name" value="<?php echo $data['Contact_Name']; ?>" id="demo">
                            </div>
                        </div>
                    </div>
                    <div class="row border-left border-right">
                        <div class="col-md-4">
                            <label for="colFormLabelLg" class="col-form-label col-form-label-md ">MOBILE NO</label>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <img src="assets/img/phone.png" width="20px"> </span>
                                </div>
                                <input class="form-control border-danger font-weight-bold" placeholder="Mobile Number" id="operator_id" value="<?php echo $data['Contact_Number']; ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="colFormLabelLg" class="col-form-label col-form-label-md">EMAIL ID</label>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <img src="assets/img/email.png" width="20px"> </span>
                                </div>
                                <input class="form-control border-danger font-weight-bold" placeholder="Company Name" value="<?php echo $data['OP_Email_Id']; ?>" id="account_number">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label for="colFormLabelLg" class="col-form-label col-form-label-md">ACTIVE</label>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <img src="assets/img/status.png" width="20px"> </span>
                                </div>
                                <input class="form-control border-danger font-weight-bold" placeholder="Operator Name" value="<?php echo $data['Active']; ?>" id="demo">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group"  style="color: #FF4500;">
                    <label class="btn btn-info btn-block text-left text-dark"> Register Complaint Of Operator <?php echo $data['Operator_id'].' '.$data['Operator_Comp_name']; ?>  </label>
                </div>
                <form action="" method="POST" class="login-form" enctype="multipart/form-data">
                    <div class="card border-dark mb-3">
                        <div class="row border-left border-right">
                            <div class="col-md-3">
                                <label for="colFormLabelLg" class="col-form-label col-form-label-md">Select System Complaint</label>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <img src="assets/img/complaint1.png" width="20px"> </span>
                                    </div>
                                    <input type="hidden" class="form-control border-success font-weight-bold" placeholder="state" id="operator_id" name="operator_id" value="<?php echo $data['Operator_id']; ?>">
                                     <select class="form-control border-primary" required="" name="System_Complaint" id="System_Complaint">
                                        <option value="" selected>--select--</option>
                                        <?php
                                            try { 
                                                $conn = connect(); 
                                                $sql_owner = mysqli_query($conn,"SELECT system_name,sys_complaint_id FROM `system_complaint`");
                                                close($conn);
                                            } catch (Exception $e){ 
                                                close($conn);
                                                errorPage();
                                            }
                                            while($row = mysqli_fetch_array($sql_owner,MYSQLI_ASSOC)){       
                                                echo "<option ";
                                                if($_REQUEST["system_name"] == $row["system_name"])
                                                echo ' selected = "selected" ';
                                                echo " value=\"".$row["sys_complaint_id"]."\">".$row["system_name"]."</option>";
                                            }  
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label for="colFormLabelLg" class="col-form-label col-form-label-md">Select Complaint Type</label>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <img src="assets/img/complaint1.png" width="20px"> </span>
                                    </div>
                                     <select class="form-control border-primary"  name="Complaint_Type" id="Complaint_Type" >
                                        
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
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
                            <div class="col-md-3">
                                <label for="colFormLabelLg" class="col-form-label col-form-label-md">Select Complaint Priority </label>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <img src="assets/img/Priority.png" width="20px"> </span>
                                    </div>
                                     <select class="form-control border-primary" name="priority" id="priority" required="">
                                        <option value="" selected="" disebled="">--select--</option>
                                        <option value="high">High</option>
                                        <option value="medium">Medium</option>
                                        <option value="low">Low</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row border-left border-right">
                            <div class="col-md-6">
                                <label for="exampleFormControlTextarea1">Enter Your Complaint in Text</label>
                                <div class="form-group input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <img src="assets/img/notes.png" width="20px"> </span>
                                    </div>
                                    <textarea class="form-control border-warning rounded-0" id="description" rows="6" name="description">Write Something......</textarea>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-sm">
                                        <label for="colFormLabelLg" class="col-form-label col-form-label-md">Upload Screen Picture</label>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <label class="custom-file-label border-success" for="inputGroupFile01">Choose file </label> </span>
                                            </div>
                                            <input type="file" name="file" id="file" class="custom-file-input border-success" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01" accept="image/x-png,image/gif,image/jpeg" >
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
                                        <label for="colFormLabelLg" class="col-form-label col-form-label-md">Phone</label>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <img src="assets/img/phone.png" width="20px"> </span>
                                            </div>
                                            <input name="phone" class="form-control" placeholder="Phone Number" required="" type="number" id="number" value="<?php echo $data['Contact_Number']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-sm">
                                        <label for="colFormLabelLg" class="col-form-label col-form-label-md">Email</label>
                                        <div class="form-group input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <img src="assets/img/email.png" width="20px"> </span>
                                            </div>
                                            <input name="email" class="form-control" placeholder="Email Id" type="email" id="email" value="<?php echo $data['OP_Email_Id']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-danger btn-block" name="submit" id="submit"> Register Complaint  </button>
                    </div>
                </form>
                <?php
                    if (isset($_POST['submit'])) {
                        $operator_id = $_POST['operator_id'];
                        $System_Complaint = $_POST['System_Complaint'];
                        $description = $_POST['description'];
                        $dates = $_POST['dates'];
                        $Complaint_Type = $_POST['Complaint_Type'];
                        $assigned = $_POST['assigned'];
                        $phone = $_POST['phone'];
                        $email = $_POST['email'];
                        $priority = $_POST['priority'];
                        $source = 'Support Portal';
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
                        $insert_complaints = mysqli_query($conn, "INSERT INTO complaint_to_mobiezy(operator_id, complaint_of, complaint_description, complaint_file, complaint_date, complaint_type, assigned_to, conatct_number, email, priority,created_date,source) VALUES('$operator_id', '$System_Complaint', '$description', '$uploaded_file_path', '$dates', '$Complaint_Type', '$assigned', '$phone', '$email', '$priority',NOW(),'$source')");
                        if ($insert_complaints) {
                            $select_row =mysqli_query($conn,"SELECT * FROM complaint_to_mobiezy ORDER BY complaint_id DESC LIMIT 1");
                            $getrow=mysqli_fetch_array($select_row);
                            if ($getrow['complaint_id']) {?>
                                <input type="hidden" name="id" id="complaint_id" value="<?php echo $getrow['complaint_id']; ?>">
                                <input type="hidden" name="id" id="conatct_number" value="<?php echo $getrow['conatct_number']; ?>">
                                <input type="hidden" name="id" id="message" value="Dear Operator,Your complaint has been registered. Complaint Id is <?php echo $getrow['complaint_id']; ?>.We will look into it and get back to you. Thanks, Team Mobiezy.">
                     <?php }
                       }else{
                            echo "string";
                        }
                        close($conn);
                    }
                ?>
            </div>
        </div>
    </div>
</body>
<?php include("footer.php");?>
<?php } ?>

<script type="text/javascript">
    $(document).ready(function() {
        $('#System_Complaint').change(function(){
            var system_id = $("#System_Complaint").val();
            $.ajax({
                url:'complaint_list.php',
                method:'post',
                data:'system_id='+system_id,
                success:function(results){
                    result = JSON.parse(results);
                    console.log(result)
                    $('#Complaint_Type').empty();
                    Array.prototype.forEach.call(result, names => {
                        $('#Complaint_Type').append('<option>' + names.name + '</option>')
                    });
                }
            })
        })
    })
    $(document).ready(function(){
            var p_phone = $("#conatct_number").val();
            var p_sms_text = $("#message").val();
            $.ajax({
                url:"https://www.unicel.in/SendSMS/sendmsg.php?uname=cableguy&pass=v@8Ci$2Z&send=CBLGUY&dest="+p_phone+"&msg="+p_sms_text+"&prty=3&vp=30",
                type:'post',
                success: function (resp) {
                    alert(resp);
                }
            })
    })
</script>