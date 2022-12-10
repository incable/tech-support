<?php include("header.php");
    // include("../auth_admin.php");
    // include("../dbConnect.php");
    // $employee_name = $_SESSION['employee_name'];
    // $email = $_SESSION['email'];
    // $phone = $_SESSION['phone'];
    // $employeeid = $_SESSION['id'];
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
                        <form action="RO_sign_up.php" method="POST" class="login-form">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Enter Company name</label>
                                        <div class="col-md-9">
                                            <input type="type" class="form-control"  name="c_name" required> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Owner Name</label>
                                        <div class="col-md-9">
                                            <input type="type" class="form-control"  name="o_name" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Mobile No</label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control"  name="mobile" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Email Address</label>
                                        <div class="col-md-9">
                                            <input type="email" class="form-control"  name="email" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>State</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"  name="state" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>City</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"  name="city" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Your Area</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"  name="area" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"  name="address" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Pin Code</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"  name="pin" required> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Billing Type</label>
                                        <div class="col-md-9">
                                            <select class="form-control" name="type_bill" required>
                                                <option value="" disabled selected>Choose your option</option>
                                                <option value="PREPAID">Pre-Paid</option>
                                                <option value="POSTPAID">Post-Paid</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>User Id</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"  name="user_id" required value="">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>User Password</label>
                                        <div class="col-md-9">
                                            <input type="password" class="form-control"  name="user_pass" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Sale Person</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control"  name="sale_person" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Enter GSTNO</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" name="gstno" value=""  id="gstno">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Complaint Mobile Number </label>
                                        <div class="col-md-9">
                                            <input type="number" class="form-control" name="com_number" value="" id="com_number">
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
                                                <option value="29">29 Days</option>
                                                <option value="30">30 Days</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="btn btn-info btn-block" name="submit">Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("footer.php"); ?>