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
                        View Usage Details
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <form method="post" action="view_usage_details.php">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Selete Month</label>
                                        <select class="form-control" name="month" required>
                                            <option value="" disabled selected>Choose your option</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Operator Id</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control"  name="opid">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group float-right">
                                        <label>&nbsp</label>
                                        <div class="col-md-12">
                                            <button type="submit" name="month1" class="btn btn-warning">Month to Search</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>&nbsp</label>
                                        <div class="col-md-12">
                                            <button type="submit" name="submit" class="btn btn-primary">Month + Operator</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>OPERATOR ID</th>
                                        <th>NO ACTIVE</th>
                                        <th>NO TRANSACTIONS</th>
                                        <th>COLLECTED</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        if (isset($_POST['submit'])) {
                                            if (isset($_POST['opid'])) {
                                                if (isset($_POST['month'])) {
                                                    $month = $_POST['month'];
                                                    $opid = $_POST['opid'];
                                                    $conn = connect();
                                                    $query = mysqli_query($conn,"SELECT CUST.Operator_Id,CUST.ACTIVE, CNT.TRAN_COUNT,CNT.collected from (SELECT Count(*) ACTIVE, OPERATOR_ID from CUSTOMER where SERVICE_STATUS = 'Active' group by OPERATOR_ID) CUST,(SELECT count(*) as TRAN_COUNT, sum(COLLECTED_AMOUNT) as collected, OPERATOR_ID from ALL_COLLECTION_REPORT where SYNC_MONTH = '".san_sqli(1, $month,$conn)."' group by OPERATOR_ID) CNT where CUST.OPERATOR_ID = CNT.OPERATOR_ID and CUST.OPERATOR_ID = '".san_sqli(1, $opid,$conn)."'");
                                                    close($conn);
                                                    while ($data = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                                                        echo '<tr>
                                                                <td>'.$data['Operator_Id'].'</td>
                                                                <td>'.$data['ACTIVE'].'</td>
                                                                <td>'.$data['TRAN_COUNT'].'</td>
                                                                <td>'.$data['collected'].'</td>
                                                              </tr>';
                                                    }
                                                }
                                            }
                                        }

                                        if (isset($_POST['month1'])) {
                                            echo '<a href="excel/usage_details.php?id='.san_out($_POST['month']).'" class="btn btn-danger float-right" style="margin-left:10px;"> Download</a>';
                                            if (isset($_POST['month'])) {

                                                $month = $_POST['month'];
                                                $conn = connect();
                                                $query = mysqli_query($conn,"SELECT CUST.Operator_Id,CUST.ACTIVE, CNT.TRAN_COUNT,CNT.collected from (SELECT Count(*) ACTIVE, OPERATOR_ID from CUSTOMER where SERVICE_STATUS = 'Active' group by OPERATOR_ID) CUST,(SELECT count(*) as TRAN_COUNT, sum(COLLECTED_AMOUNT) as collected, OPERATOR_ID from ALL_COLLECTION_REPORT where SYNC_MONTH = '".san_sqli(1, $month,$conn)."'");
                                                close($conn);
                                                while ($data = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                                                    echo '<tr>
                                                            <td>'.$data['Operator_Id'].'</td>
                                                            <td>'.$data['ACTIVE'].'</td>
                                                            <td>'.$data['TRAN_COUNT'].'</td>
                                                            <td>'.$data['collected'].'</td>
                                                          </tr>';
                                                }
                                            }
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
