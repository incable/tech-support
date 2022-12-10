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
                        View Operators Details
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>OPERATOR ID</th>
                                        <th>COMPANY NAME</th>
                                        <th>LOGIN ID</th>
                                        <th>PASSWORD</th>
                                        <th>NUMBER</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                        $conn =connect();
                                        $query = mysqli_query($conn,"SELECT OPERATOR.Operator_id,Operator_Comp_name,USER_ID,PASSWORD,OPERATOR.Contact_Number FROM ROLE_USER INNER JOIN AGENT ON ROLE_USER.Agent_Id=AGENT.Agent_Id INNER JOIN OPERATOR ON AGENT.Operator_id= OPERATOR.Operator_id where AGENT.USER_TYPE='webadmin' and OPERATOR.MSO_ID<>1;");
                                        close($conn);
                                        while ($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                                          echo '<tr>
                                                  <td>'.$fetch['Operator_id'].'</td>
                                                  <td>'.$fetch['Operator_Comp_name'].'</td>
                                                  <td>'.$fetch['USER_ID'].'</td>
                                                  <td>'.$fetch['PASSWORD'].'</td>
                                                  <td>'.$fetch['Contact_Number'].'</td>
                                                   </tr>';
                                               }
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
