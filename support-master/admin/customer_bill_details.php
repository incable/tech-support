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
                        View Customer Bill Details
                    </div>
                </div>
                <div class="card mb-3">
                    <div class="card-body">
                        <form method="post" action="customer_bill_details.php">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Operator Id</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control"  name="opid">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Zero to Bill Total</label>
                                        <div class="col-md-12">
                                            <input type="text" class="form-control"  name="zero_bill_total">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group float-right">
                                        <label>&nbsp</label>
                                        <div class="col-md-12">
                                            <!-- <button type="submit" name="submit" class="btn btn-info">Search Operator</button> -->
                                            <button type="button" class="btn btn-primary btn-md" data-toggle="modal" data-target="#exampleModal">
  Search Operator & Zero Bill Total
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-sm" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h6 class="modal-title" id="exampleModalLabel">Are you sure you want to continue</h6>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="submit" class="btn btn-info float-right">Click Next</button>
      </div>
    </div>
  </div>
</div>
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
                                        <th>CUSTOMER NUMBER</th>
                                        <th>CUSTOMER ID</th>
                                        <th>OPERATOR ID</th>
                                        <th>AGENT ID</th>
                                        <th>NAME</th>
                                        <th>cust_mnth_bill_amnt</th>
                                        <th>cust_due_amnt</th>
                                        <th>rebate_amnt</th>
                                        <th>tax_amnt</th>
                                        <th>bill_total</th>
                                        <th>amnt_coll</th>
                                        <th>last_paid_time</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        try {
                                            $conn = connect();
                                            $opid = $_POST['opid'];
                                            $zero_bill_total = $_POST['zero_bill_total'];
                                            if ($opid != '' && $zero_bill_total !='') {
                                                $update_zero_bill_total = mysqli_query($conn,"UPDATE cust_bill_detail inner join CUSTOMER on cust_uniq_id = cust_num SET bill_total ='".san_sqli(1, $zero_bill_total,$conn)."' where operator_id = '".san_sqli(1, $opid,$conn)."'");
                                                
                                                $query = mysqli_query($conn,"SELECT cust_num,CUSTOMER_ID,OPERATOR_ID,AGENT_ID,NAME,cust_mnth_bill_amnt,cust_due_amnt,rebate_amnt,tax_amnt,bill_total,amnt_coll,last_paid_time from cust_bill_detail inner join CUSTOMER on cust_uniq_id = cust_num where operator_id = '".san_sqli(1, $opid,$conn)."' ");
                                                close($conn);
                                                while ( $data = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                                                    echo '<tr>
                                                          <td>'.$data['cust_num'].'</td>
                                                          <td>'.$data['CUSTOMER_ID'].'</td>
                                                          <td>'.$data['OPERATOR_ID'].'</td>
                                                          <td>'.$data['AGENT_ID'].'</td>
                                                          <td>'.$data['NAME'].'</td>
                                                          <td>'.$data['cust_mnth_bill_amnt'].'</td>
                                                          <td>'.$data['cust_due_amnt'].'</td>
                                                          <td>'.$data['rebate_amnt'].'</td>
                                                          <td>'.$data['tax_amnt'].'</td>
                                                          <td>'.$data['bill_total'].'</td>
                                                          <td>'.$data['amnt_coll'].'</td>
                                                          <td>'.$data['last_paid_time'].'</td>
                                                      </tr>';
                                                }
                                            }elseif ($opid != '' && $zero_bill_total =='') {
                                                $query = mysqli_query($conn,"SELECT cust_num,CUSTOMER_ID,OPERATOR_ID,AGENT_ID,NAME,cust_mnth_bill_amnt,cust_due_amnt,rebate_amnt,tax_amnt,bill_total,amnt_coll,last_paid_time from cust_bill_detail inner join CUSTOMER on cust_uniq_id = cust_num where operator_id = '".san_sqli(1, $opid,$conn)."' ");
                                                close($conn);
                                                while ( $data = mysqli_fetch_array($query,MYSQLI_ASSOC)) {
                                                    echo '<tr>
                                                          <td>'.$data['cust_num'].'</td>
                                                          <td>'.$data['CUSTOMER_ID'].'</td>
                                                          <td>'.$data['OPERATOR_ID'].'</td>
                                                          <td>'.$data['AGENT_ID'].'</td>
                                                          <td>'.$data['NAME'].'</td>
                                                          <td>'.$data['cust_mnth_bill_amnt'].'</td>
                                                          <td>'.$data['cust_due_amnt'].'</td>
                                                          <td>'.$data['rebate_amnt'].'</td>
                                                          <td>'.$data['tax_amnt'].'</td>
                                                          <td>'.$data['bill_total'].'</td>
                                                          <td>'.$data['amnt_coll'].'</td>
                                                          <td>'.$data['last_paid_time'].'</td>
                                                      </tr>';
                                                }
                                            }
                                        } catch (Exception $e) {
                                            close($conn);
                                            errorPage();
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