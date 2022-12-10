<?php include("header.php");
    // include("../auth_admin.php");
    // include("../dbConnect.php");
    // $employee_name = $_SESSION['employee_name'];
    // $email = $_SESSION['email'];
    // $phone = $_SESSION['phone'];
    // $employeeid = $_SESSION['id'];
    
    $id = $_GET['id'];
    $conn = connect();
    
    $query = mysqli_query($conn,"SELECT * from OPERATOR WHERE Operator_id = '".san_sqli(1, $id)."'");
    close($conn);
    while ($object = mysqli_fetch_array($query)) {
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
                        Register Operator
                    </div>
                    <div class="card-body">
                        <form action="edit_operator_data.php?id=<?php echo $id;?>" method="POST" class="login-form">
                            <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Enter Company name</label>
                                    <div class="col-md-9">
                                        <input type="type" class="form-control"  name="c_name" value="<?php echo $object['Operator_Comp_name'];?>"> 
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Owner Name</label>
                                    <div class="col-md-9">
                                        <input type="type" class="form-control"  name="o_name" value="<?php echo $object['Contact_Name'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Mobile No</label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control"  name="mobile" value="<?php echo $object['Contact_Number'];?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Email Address</label>
                                    <div class="col-md-9">
                                        <input type="email" class="form-control"  name="email" value="<?php echo $object['OP_Email_Id'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>State</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="state" value="<?php echo $object['OP_STATE'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>City</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="city" value="<?php echo $object['City'];?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Your Area</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="area" value="<?php echo $object['OP_AREA'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Address</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="address" value="<?php echo $object['Operator_Addr'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Pin Code</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="pin" value="<?php echo $object['Pin_code'];?>"> 
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Billing Type: <u style="color: red;"><?php echo $object['Operator_Bill_Type'];?></u></label>
                                    <div class="col-md-9">
                                        <select class="form-control" name="type_bill">
                                            <option value="" disabled selected>Choose your option</option>
                                            <?php if ('PREPAID'==$object['Operator_Bill_Type']){ ?>
                                                <option <?php if ('PREPAID'==$object['Operator_Bill_Type']) echo ' selected="selected"'?>>Pre-Paid</option>
                                                <option value="POSTPAID">Post-Paid</option>
                                            <?php }else{?>
                                                <option value="PREPAID">Pre-Paid</option>
                                                <option <?php if ('POSTPAID'==$object['Operator_Bill_Type']) echo ' selected="selected"'?>>Post-Paid</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>User Id</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control"  name="user_id" value="<?php echo $object['Operator_Login_Id'];?>">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>User Password</label>
                                    <div class="col-md-9">
                                        <input type="password" class="form-control"  name="user_pass" value="<?php echo $object['Operator_Password'];?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Sale Person</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" value="<?php echo $object['Sales_Person'];?>"  name="sale_person" required>
                                    </div>
                                </div>
                            </div>
                           <div class="col-md-4">
                                <div class="form-group">
                                    <label>Enter GSTNO</label>
                                    <div class="col-md-9">
                                        <input type="text" class="form-control" name="gstno" value="<?php echo $object['GSTIN'];?>"  id="gstno">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Complaint Mobile Number </label>
                                    <div class="col-md-9">
                                        <input type="number" class="form-control" name="com_number" value="<?php echo $object['COMPAINT_NUMBER'];?>" id="com_number">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>SMS Enable</label>
                                        <div class="col-md-9">
                                            <input type="checkbox" name="sms_enable" value="uname=cableguy&pass=v@8Ci$2Z&send=CBLGUY&Gateway=unicel&Server=gateway"  id="sms_enable">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>SMS Reminder</label>
                                        <div class="col-md-9">
                                            <input type="checkbox" name="sms_reminder" value="Y" id="sms_reminder">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Billing Cycle</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="type_cycle" required>
                                                <option value="" disabled selected>Choose your option</option>
                                                <?php if ('29'==$object['subscription_cycle']){ ?>
                                                    <option <?php if ('29'==$object['subscription_cycle']) echo ' selected="selected"'?>>29 Days</option>
                                                    <option value="30">30 Days</option>
                                                <?php }else{?>
                                                    <option value="29">29 Days</option>
                                                    <option <?php if ('30'==$object['subscription_cycle']) echo ' selected="selected"'?>>30 Days</option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <button type="submit" class="btn btn-warning btn-block" name="submit"> Update Operator Account  </button>
                                </div> <!-- form-group// -->
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
      </div>
  </div>
</body>
<?php }include("footer.php");?>

