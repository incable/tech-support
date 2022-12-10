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
                        Duplicate Type 1
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>COUNT</th>
                                        <th>AGENT_ID</th>
                                        <th>TRAN_ID</th>
                                        <th>CUST_ID</th>
                                        <th>BALANCE</th>
                                        <th>DELETE ACTION</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                        $conn =connect();
                                        $query = mysqli_query($conn,"SELECT count(*) AS COUNT, AGENT_ID, TRAN_ID, CUST_ID, BALANCE from TRAN_DETAILS where insertion_time > '2019-04-01' and  TRAN_ID is not null group by AGENT_ID, TRAN_ID, CUST_ID, BALANCE having count(*) > 1;");
                                        close($conn);
                                        while ($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                                        	echo '<tr>
                                        			  <td>'.$fetch['COUNT'].'</td>
                                        			  <td>'.$fetch['AGENT_ID'].'</td>
                                                      <td>'.$fetch['TRAN_ID'].'</td>
                                                      <td>'.$fetch['CUST_ID'].'</td>
                                        			  <td>'.$fetch['BALANCE'].'</td>
                                                      <td>
                                                        <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target=".bd-example-modal-sm'.$fetch['TRAN_ID'].'" >
                                                             Delete</button>

                                                            <div class="modal fade bd-example-modal-sm'.$fetch['TRAN_ID'].'" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog modal-sm">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title">Delete</h5>
                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <form action="delete_duplicate_type_1.php" method="post">
                                                                            <div class="modal-body">
                                                                                <p>Are you Sure you want to Delete.</p>
                                                                                <input type="hidden" name="tran_id" value="'.$fetch['TRAN_ID'].'">
                                                                                <input type="hidden" name="cust_id" value="'.$fetch['CUST_ID'].'">
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit" class="btn btn-danger float-left" name="delete">Delete</button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
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