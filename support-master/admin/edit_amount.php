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
                        Edit Operators Amount
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>OPERATOR ID</th>
                                        <th>COMPANY NAME</th>
                                        <th>STATUS</th>
                                        <th>PHONE</th>
                                        <th>BALANCE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                        $conn =connect();
                                        $query = mysqli_query($conn,"SELECT operator_id, customer_name, bcy_balance, Operator_Status,phone from mc_owner_balance");
                                        close($conn);
                                        while ($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                                        	echo '<tr>
                                        			  <td>'.$fetch['operator_id'].'</td>
                                        			  <td>'.$fetch['customer_name'].'</td>
                                                      <td>'.$fetch['Operator_Status'].'</td>
                                        			  <td>'.$fetch['phone'].'</td>
                                                      <td>
                                                            <div class="container">
                                                              <button type="button" class="btn" data-toggle="modal" data-target="#myModal'.$fetch['operator_id'].'">'.$fetch['bcy_balance'].'</button>
                                                              <div class="modal fade" id="myModal'.$fetch['operator_id'].'" role="dialog">
                                                                <div class="modal-dialog">
                                                                  <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h4 class="modal-title">Edit Amount</h4>
                                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <form action="edit_amount.php" method="post">
                                                                            <div class="row">
                                                                                <div class="col-md-6">
                                                                                    <div class="form-group">
                                                                                        <label>Amount:</label>
                                                                                        <div class="col-md-6">
                                                                                            <input type="hidden" class="form-control" id="op_id" name="opid" value="'.$fetch['operator_id'].'">
                                                                                            <input type="number" name="edit_amount">
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="col-md-6">
                                                                                  <div class="form-group float-right">
                                                                                    <label>&nbsp</label>
                                                                                    <div class="col-md-6">
                                                                                      <button type="submit" name="submit" class="btn btn-info">Submit</button>
                                                                                    </div>
                                                                                  </div>
                                                                                </div>
                                                                              </div>
                                                                            </form>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                    </div>
                                                                  </div>
                                                                  
                                                                </div>
                                                              </div>
                                                            </div>
                                                      </td>
                                        	      </tr>';
                                        }
                                    ?>
                                </tbody>
                            </table>
                            <?php 
                            try {
                                $opid = $_POST['opid'];
                                $edit_amount = $_POST['edit_amount'];
                                $conn = connect();
                                
                                $query = mysqli_query($conn,"UPDATE mc_owner_balance SET bcy_balance = '".san_sqli(1, $edit_amount, $conn)."' WHERE operator_id = '".san_sqli(1, $opid,$conn)."'");
                                 header("Location:edit_amount.php");
                                close($conn);
                            } catch (Exception $e) {
                                close($conn);
                                errorPage();
                            }
                             ?>
                        </div>
                    </div>
                </div>
            </div>
      </div>
  </div>
</body>
<?php include("footer.php"); ?>
    <!-- if ($query) {
    echo    '<div class="alert alert-success" role="alert" id="respon">
                Successfuly Responsed...!
            </div>
            <script type="text/javascript">
                $("#respon").ready(function(){
                    window.location.href = "edit_amount.php";
                })
            </script>';
        } -->