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
                        FeedBack
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Company Name</th>
                                        <th>Contact Name</th>
                                        <th>Phone No</th>
                                        <th>Experience</th>
                                        <th>Comments</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $conn = connect();
                                        $fetchfeedback = mysqli_query($conn, "SELECT f.feedback_id,o.Operator_Comp_name,o.Contact_Name,o.Contact_Number,f.experience,f.comments from feedback f inner join OPERATOR o on f.operator_id = o.operator_id");
                                        while ($data = mysqli_fetch_array($fetchfeedback,MYSQLI_ASSOC)) {?>
                                            <tr>
                                                <td> <?php echo $data['feedback_id']; ?> </td>
                                                <td> <?php echo $data['Operator_Comp_name']; ?> </td>
                                                <td> <?php echo $data['Contact_Name']; ?> </td>
                                                <td> <?php echo $data['Contact_Number']; ?> </td>
                                                <td> <?php echo $data['experience']; ?> </td>
                                                <td> <?php echo $data['comments']; ?> </td>
                                            </tr>
                                        <?php } 
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
      </div>
  </div>
</body>
<?php include("footer.php"); ?>