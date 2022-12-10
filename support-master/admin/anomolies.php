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
                        Anomolies (Duplicates)
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="col-lg-12" style="margin-top:15%; ">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="card-header">
                                    <center>
                                        <a href="duplicate_type_1.php" type="submit" name="submit" class="btn btn-defult btn-block" style="padding:60px;border:none;">
                                            Type 1: Duplicates without CBD change
                                        </a>
                                    </center>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="card-header">
                                    <center>
                                        <a href="duplicate_type_2.php" type="submit" name="submit" class="btn btn-defult btn-block" style="padding:60px;">
                                            Type 2: Duplicates with CBD change:
                                        </a>
                                    </center>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<?php include("footer.php"); ?>