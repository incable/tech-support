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
                        Duplicate Type 2
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
                                    </tr>
                                </thead>
                                <tbody>
                                	<?php 
                                        $conn =connect();
                                        $query = mysqli_query($conn,"SELECT count(*) as COUNT, AGENT_ID, TRAN_ID, CUST_ID, COLLECTED_AMOUNT from TRAN_DETAILS
where insertion_time > '2019-04-01' and TRAN_ID is not null
and TRAN_id not in (select TRAN_ID from TRAN_DETAILS where insertion_time > '2019-04-01' and TRAN_ID is not null
group by AGENT_ID, TRAN_ID, CUST_ID, BALANCE
having count(*) > 1)
group by AGENT_ID, TRAN_ID, CUST_ID, COLLECTED_AMOUNT
having count(*) > 1;");
                                        close($conn);
                                        while ($fetch = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                                        	echo '<tr>
                                        			  <td>'.$fetch['COUNT'].'</td>
                                        			  <td>'.$fetch['AGENT_ID'].'</td>
                                                      <td>'.$fetch['TRAN_ID'].'</td>
                                                      <td>'.$fetch['CUST_ID'].'</td>
                                        			  <td>'.$fetch['COLLECTED_AMOUNT'].'</td>
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