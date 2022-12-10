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
                        <form action="RO_NXT.php" method="POST" class="login-form">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>OPERATOR ID</label>
                                        <div class="col-md-9">
                                            <input type="type" class="form-control"  name="oid" required> 
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                          
                            <div class="row">
                                <div class="col-md-12">
                                             <button type="submit" class="btn btn-info btn-block" name="submit1">Update Other Info</button>
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